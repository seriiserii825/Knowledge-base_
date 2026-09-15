# NestJS: авторизация access/refresh token (JWT + httpOnly cookie)

Собрано по образцу `nest-teashop-angular`, с исправлением найденных в нём багов (см. раздел «Баги в исходном проекте» в конце — обязательно прочитать).

## Идея флоу

- **accessToken** — короткоживущий (например 1h), отдаётся в теле ответа, кладётся на фронте в память/стор, летает в заголовке `Authorization: Bearer <token>`.
- **refreshToken** — долгоживущий (например 7d), кладётся в `httpOnly` cookie, недоступен из JS, летает сам браузером при запросах с `credentials: 'include'`.
- Логин/регистрация выдают обе пары. Когда accessToken протухает — фронт стучится на `POST /auth/login/access-token`, сервер читает refreshToken из cookie и выдаёт новую пару.
- Logout — cookie с refreshToken затирается (`expires: new Date(0)`).

## 1. Зависимости

```bash
npm i @nestjs/jwt @nestjs/passport passport passport-jwt argon2 cookie-parser
npm i -D @types/passport-jwt @types/cookie-parser
# опционально, для Google OAuth:
npm i passport-google-oauth20
npm i -D @types/passport-google-oauth20
```

## 2. .env

```
JWT_SECRET=long_random_string
JWT_ACCESS_EXPIRES_IN=1h
JWT_REFRESH_EXPIRES_IN=7d
SERVER_DOMAIN=localhost   # домен, на который ставится cookie
CLIENT_URL=http://localhost:5173
```

`JWT_ACCESS_EXPIRES_IN` / `JWT_REFRESH_EXPIRES_IN` — строки в формате [ms](https://github.com/vercel/ms) (`1h`, `7d`, `15m`...), их понимает `jwt.sign`.

## 3. `src/config/jwt.config.ts`

```ts
import { ConfigService } from "@nestjs/config";
import { JwtModuleOptions } from "@nestjs/jwt";

export const getJwtConfig = async (configService: ConfigService): Promise<JwtModuleOptions> => ({
  secret: configService.getOrThrow<string>("JWT_SECRET"),
});
```

## 4. `src/auth/dto/auth.dto.ts`

```ts
import { IsEmail, IsOptional, IsString, MinLength } from "class-validator";

export class AuthDto {
  @IsOptional()
  @IsString()
  name?: string;

  @IsEmail()
  email: string;

  @MinLength(6)
  @IsString()
  password: string;
}
```

Важно: `password` обязателен для обычного логина/регистрации (не `@IsOptional`). Опциональным он может быть только для отдельного OAuth-флоу — там его лучше вообще не пропускать через этот DTO.

## 5. `src/auth/auth.module.ts`

```ts
import { Module } from "@nestjs/common";
import { ConfigModule, ConfigService } from "@nestjs/config";
import { JwtModule } from "@nestjs/jwt";
import { getJwtConfig } from "../config/jwt.config.js";
import { UserModule } from "../user/user.module.js";
import { AuthController } from "./auth.controller.js";
import { AuthService } from "./auth.service.js";
import { JwtStrategy } from "./strategies/jwt.strategy.js";

@Module({
  imports: [
    UserModule,
    ConfigModule,
    JwtModule.registerAsync({
      imports: [ConfigModule],
      inject: [ConfigService],
      useFactory: getJwtConfig,
    }),
  ],
  controllers: [AuthController],
  providers: [AuthService, JwtStrategy],
})
export class AuthModule {}
```

## 6. `src/auth/auth.service.ts`

Ключевые моменты по сравнению с исходником:

- логин **обязан** сверять пароль через `argon2.verify`, иначе это не авторизация, а угадывание email;
- срок жизни cookie считается через `ms()`, а не `parseInt()` от строки вида `"7d"`.

```ts
import {
  BadRequestException,
  Injectable,
  NotFoundException,
  UnauthorizedException,
} from "@nestjs/common";
import { JwtService } from "@nestjs/jwt";
import { ConfigService } from "@nestjs/config";
import { Response } from "express";
import { hash, verify } from "argon2";
import ms from "ms";
import { UserService } from "../user/user.service.js";
import { AuthDto } from "./dto/auth.dto.js";
import { User } from "../user/entities/user.entity.js";

interface Tokens {
  accessToken: string;
  refreshToken: string;
}

interface AuthResult extends Tokens {
  user: User;
}

@Injectable()
export class AuthService {
  REFRESH_TOKEN_NAME = "refreshToken";

  constructor(
    private jwt: JwtService,
    private userService: UserService,
    private configService: ConfigService,
  ) {}

  async login(dto: AuthDto): Promise<AuthResult> {
    const user = await this.validateUser(dto);
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  async register(dto: AuthDto): Promise<AuthResult> {
    const oldUser = await this.userService.findByEmail(dto.email);
    if (oldUser) {
      throw new BadRequestException("User already exists");
    }
    const user = await this.userService.create({
      ...dto,
      password: await hash(dto.password),
    });
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  async getNewTokens(refreshToken: string): Promise<AuthResult> {
    const result = await this.jwt.verifyAsync(refreshToken).catch(() => null);
    if (!result) {
      throw new UnauthorizedException("Invalid refresh token");
    }
    const user = await this.userService.findOne(result.id);
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  generateTokens(userId: string): Tokens {
    const data = { id: userId };

    const accessToken = this.jwt.sign(data, {
      expiresIn: this.configService.getOrThrow("JWT_ACCESS_EXPIRES_IN"),
    });

    const refreshToken = this.jwt.sign(data, {
      expiresIn: this.configService.getOrThrow("JWT_REFRESH_EXPIRES_IN"),
    });
    return { accessToken, refreshToken };
  }

  private async validateUser(dto: AuthDto): Promise<User> {
    const user = await this.userService.findByEmail(dto.email);
    if (!user || !user.password) {
      throw new NotFoundException("User not found");
    }
    const isValid = await verify(user.password, dto.password);
    if (!isValid) {
      throw new UnauthorizedException("Invalid credentials");
    }
    return user;
  }

  async validateOAuthLogin(profile: { email: string; name: string }): Promise<AuthResult> {
    let user = await this.userService.findByEmail(profile.email);
    if (!user) {
      user = await this.userService.create({
        email: profile.email,
        name: profile.name,
      });
    }
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  addRefreshTokenToResponse(res: Response, refreshToken: string): void {
    const expiresIn = new Date(
      Date.now() + ms(this.configService.getOrThrow("JWT_REFRESH_EXPIRES_IN")),
    );

    res.cookie(this.REFRESH_TOKEN_NAME, refreshToken, {
      httpOnly: true,
      domain: this.configService.getOrThrow("SERVER_DOMAIN"),
      expires: expiresIn,
      secure: true,
      sameSite: "none", // на локальной разработке без https — 'lax' и secure: false
    });
  }

  removeRefreshTokenFromResponse(res: Response): void {
    res.cookie(this.REFRESH_TOKEN_NAME, "", {
      httpOnly: true,
      domain: this.configService.getOrThrow("SERVER_DOMAIN"),
      expires: new Date(0),
      secure: true,
      sameSite: "none",
    });
  }
}
```

`ms` — пакет `npm i ms` (+ `@types/ms`), либо посчитать вручную по regex `/(\d+)([dhm])/`.

## 7. `src/auth/auth.controller.ts`

```ts
import { Body, Controller, HttpCode, Post, Req, Res, UnauthorizedException } from "@nestjs/common";
import type { Request, Response } from "express";
import { AuthService } from "./auth.service.js";
import { AuthDto } from "./dto/auth.dto.js";

@Controller("auth")
export class AuthController {
  constructor(private readonly authService: AuthService) {}

  @HttpCode(200)
  @Post("login")
  async login(@Body() dto: AuthDto, @Res({ passthrough: true }) res: Response) {
    const { refreshToken, ...response } = await this.authService.login(dto);
    this.authService.addRefreshTokenToResponse(res, refreshToken);
    return response;
  }

  @HttpCode(200)
  @Post("login/access-token")
  async getNewTokens(@Req() req: Request, @Res({ passthrough: true }) res: Response) {
    const refreshTokenFromCookie = req.cookies[this.authService.REFRESH_TOKEN_NAME];

    if (!refreshTokenFromCookie) {
      this.authService.removeRefreshTokenFromResponse(res);
      throw new UnauthorizedException("Refresh token not found");
    }

    const { refreshToken, ...response } =
      await this.authService.getNewTokens(refreshTokenFromCookie);

    this.authService.addRefreshTokenToResponse(res, refreshToken);
    return response;
  }

  @HttpCode(201)
  @Post("register")
  async register(@Body() dto: AuthDto, @Res({ passthrough: true }) res: Response) {
    const { refreshToken, ...response } = await this.authService.register(dto);
    this.authService.addRefreshTokenToResponse(res, refreshToken);
    return response;
  }

  @HttpCode(200)
  @Post("logout")
  async logout(@Res({ passthrough: true }) res: Response) {
    this.authService.removeRefreshTokenFromResponse(res);
    return { message: "Logged out successfully" };
  }
}
```

## 8. `src/auth/strategies/jwt.strategy.ts`

Обязательно кидать `UnauthorizedException`, а не голый `Error` — иначе Nest вернёт 500 вместо 401.

```ts
import { Injectable, UnauthorizedException } from "@nestjs/common";
import { ConfigService } from "@nestjs/config";
import { PassportStrategy } from "@nestjs/passport";
import { ExtractJwt, Strategy } from "passport-jwt";
import { UserService } from "../../user/user.service.js";

@Injectable()
export class JwtStrategy extends PassportStrategy(Strategy) {
  constructor(
    configService: ConfigService,
    private userService: UserService,
  ) {
    super({
      jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),
      ignoreExpiration: false,
      secretOrKey: configService.getOrThrow<string>("JWT_SECRET"),
    });
  }

  async validate(payload: { id: string }) {
    const user = await this.userService.findOne(payload.id).catch(() => null);
    if (!user) {
      throw new UnauthorizedException("User not found");
    }
    return user;
  }
}
```

## 9. Guard + декораторы

`src/auth/guards/jwt-auth.guard.ts`:

```ts
import { AuthGuard } from "@nestjs/passport";

export class JwtAuthGuard extends AuthGuard("jwt") {}
```

`src/auth/decorators/auth.decorator.ts`:

```ts
import { UseGuards } from "@nestjs/common";
import { JwtAuthGuard } from "../guards/jwt-auth.guard.js";

export const Auth = () => UseGuards(JwtAuthGuard);
```

`src/user/decorators/user.decorator.ts`:

```ts
import { createParamDecorator, ExecutionContext } from "@nestjs/common";
import { User } from "../entities/user.entity.js";

export const CurrentUser = createParamDecorator((data: keyof User, ctx: ExecutionContext) => {
  const request = ctx.switchToHttp().getRequest();
  const user = request.user as User;
  return data ? user?.[data] : user;
});
```

Использование на защищённом роуте:

```ts
@Auth()
@Get('me')
getMe(@CurrentUser() user: User) {
  return user;
}
```

## 10. `src/main.ts`

```ts
import { NestFactory } from "@nestjs/core";
import { ValidationPipe } from "@nestjs/common";
import cookieParser from "cookie-parser";
import { AppModule } from "./app.module.js";

async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  app.use(cookieParser());
  app.useGlobalPipes(new ValidationPipe());
  app.enableCors({
    origin: process.env.CLIENT_URL ?? "http://localhost:5173",
    credentials: true, // именно "credentials", не "credential"
  });
  await app.listen(process.env.PORT ?? 3000);
}
await bootstrap();
```

На фронте запросы должны идти с `credentials: 'include'` (fetch) или `withCredentials: true` (axios), иначе браузер не пришлёт/не сохранит cookie с refreshToken.

## 11. (Опционально) Google OAuth поверх этой же схемы

`src/auth/strategies/google.strategy.ts` в `validate()` формирует профиль пользователя и вызывает `done(null, profile)`, обработчик `GET google/callback` в `src/auth/auth.controller.ts` получает `req.user`, зовёт `authService.validateOAuthLogin(req.user)`, ставит cookie с refreshToken и редиректит на фронт с `accessToken` в query-параметре (`?accessToken=...`).

Минус такого способа — accessToken в URL может осесть в истории браузера/логах. Если это критично — вместо query-параметра лучше отдать одноразовый код через query, а сам accessToken выдать отдельным запросом с фронта на бэк по этому коду.

---

## Баги в исходном проекте (nest-teashop-angular), которые НЕ надо копировать

1. **Критично — вход без проверки пароля.** В `src/auth/auth.service.ts` метод `validateUser()` только ищет пользователя по email и ничего не сравнивает с `dto.password`. Пароль при регистрации хешируется (`argon2.hash`), но при логине никогда не проверяется (`argon2.verify` нигде не вызывается). Итог: `POST /auth/login` пускает по любому паролю (или вообще без него, т.к. `password` в DTO помечен `@IsOptional()`), лишь бы email существовал. В Postman это будет "работать", потому что баг именно в том, что сервер вообще не проверяет пароль. Нужно добавить `argon2.verify(user.password, dto.password)` и сделать `password` обязательным полем в `AuthDto`.
2. **CORS: `credential: true` вместо `credentials: true`.** Опции у `enableCors`/пакета `cors` нет поля `credential` — валидное имя `credentials`. Из-за опечатки браузер не получит заголовок `Access-Control-Allow-Credentials: true`, и при кросс-доменных запросах с `sameSite: 'none'` cookie с refreshToken не будет ни отправляться, ни приниматься. Через Postman это не проявляется, потому что Postman не соблюдает CORS.
3. **`expandHeaders: 'set-cookie'`** — не существующая опция у `cors` (там есть `exposedHeaders`). Скорее всего просто мёртвый код, но если задумывалось "открыть" заголовок `Set-Cookie` для JS на фронте — эта опция ничего не делает (и для httpOnly-cookie это в любом случае не нужно, браузер сам их обрабатывает).
4. **Расчёт срока жизни cookie через `parseInt(EXPIRE_DAY_REFRESH_TOKEN)`.** Работает случайно, пока `JWT_REFRESH_EXPIRES_IN="7d"` (parseInt возьмёт "7" и прибавит как дни). Если это значение поменяют на `"12h"` или `"30m"`, `parseInt` всё равно вернёт "12"/"30" и они будут прибавлены как **дни**, а не часы/минуты — cookie проживёт совсем не тот срок, что сам JWT. Нужно парсить через `ms()` или явную единицу измерения.
5. **`src/auth/strategies/jwt.strategy.ts` — `validate()` кидает `new Error(...)`** вместо `UnauthorizedException`. Passport не оборачивает произвольный `Error` в 401 — Nest вернёт 500 Internal Server Error вместо ожидаемого 401, если токен валиден, а пользователь уже удалён из базы.
6. **access и refresh токены не различаются.** Оба подписываются одним секретом с одинаковым payload `{ id }`, без поля-метки типа токена. Это значит, что accessToken технически можно подсунуть как refreshToken (и наоборот) в `getNewTokens`/`jwtFromRequest`. Не критично при текущей архитектуре (refresh читается только из httpOnly cookie, а не из тела/заголовка), но при малейшем изменении флоу это станет дырой. Стоит добавлять `{ id, type: 'refresh' }` и проверять `type` при рефреше.
7. **Нет отзыва refresh-токенов.** Токены полностью stateless — разлогинить пользователя "принудительно" (например, при смене пароля или краже токена) нельзя, только подождать истечения срока действия. Если это важно для проекта — нужно хранить refreshToken (или его хэш/jti) в БД и сверять при рефреше.

### Чеклист для нового проекта

- [ ] `argon2.verify` на логине, `password` обязателен в DTO
- [x] `credentials: true` в `enableCors` (не `credential`) — исправлено в `src/main.ts`
- [x] `ms()` вместо `parseInt()` для срока жизни cookie — исправлено в `src/auth/auth.service.ts`
- [x] `UnauthorizedException` в `JwtStrategy.validate` — исправлено в `src/auth/strategies/jwt.strategy.ts`
- [ ] `type: 'access' | 'refresh'` в payload токенов + проверка при рефреше
- [ ] (опционально) хранение refresh-токенов в БД для возможности отзыва
