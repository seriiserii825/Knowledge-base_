# NestJS: авторизация access/refresh token (JWT + httpOnly cookie)

Код ниже — дословно из `nest-teashop-angular` (фронт — `ng-teashop`, см. `Knowledge-base_/angular/ang-auth.md`). Открытые проблемы — в конце.

## Идея флоу

- **accessToken** — короткоживущий (`JWT_ACCESS_EXPIRES_IN=1h`), отдаётся в теле ответа, на фронте хранится в памяти (`AuthService`), летает в заголовке `Authorization: Bearer <token>`.
- **refreshToken** — долгоживущий (`JWT_REFRESH_EXPIRES_IN=7d`), кладётся в `httpOnly` cookie, недоступен из JS, браузер шлёт его сам при запросах с `withCredentials: true`.
- Логин/регистрация выдают обе пары. Когда accessToken протухает — фронт стучится на `POST /auth/login/access-token`, сервер читает refreshToken из cookie и выдаёт новую пару.
- Logout — cookie с refreshToken затирается (`expires: new Date(0)`).
- Google OAuth — та же пара токенов, accessToken передаётся на фронт через redirect `CLIENT_URL/google-callback?accessToken=...`.

## Эндпоинты

```text
POST /auth/login               → { user, accessToken } + Set-Cookie refreshToken
POST /auth/register            → { user, accessToken } + Set-Cookie refreshToken
POST /auth/login/access-token  → { user, accessToken } + новый Set-Cookie   (refresh)
POST /auth/logout              → { message } + cookie затирается
GET  /auth/google              → редирект на Google
GET  /auth/google/callback     → Set-Cookie + redirect CLIENT_URL/google-callback?accessToken=...
```

## 1. Зависимости

```bash
npm i @nestjs/jwt @nestjs/passport @nestjs/config passport passport-jwt passport-google-oauth20 argon2 cookie-parser ms
npm i -D @types/passport-jwt @types/passport-google-oauth20 @types/cookie-parser @types/ms
```

## 2. .env

```
PORT=5000

CLIENT_URL=http://localhost:4200
SERVER_URL=http://localhost:5000

# домен cookie. Для api.teacoder.ru будет .teacoder.ru
SERVER_DOMAIN=localhost

JWT_SECRET=long_random_string
JWT_ACCESS_EXPIRES_IN=1h
JWT_REFRESH_EXPIRES_IN=7d

GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
```

- `JWT_*_EXPIRES_IN` — строки в формате [ms](https://github.com/vercel/ms) (`1h`, `7d`, `15m`...), их понимают и `jwt.sign`, и `ms()`.
- `CLIENT_URL` — origin фронта: CORS + куда редиректить после Google.
- `SERVER_URL` — адрес бэка: из него собирается `callbackURL` для Google.

## 3. `src/main.ts`

```ts
import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module.js';

import { ValidationPipe } from '@nestjs/common';
import cookieParser from 'cookie-parser';
import { setupSwagger } from './config/swagger.config.js';

async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  app.use(cookieParser());
  setupSwagger(app);
  app.useGlobalPipes(new ValidationPipe({ whitelist: true }));
  app.enableCors({
    origin: process.env.CLIENT_URL ?? 'http://localhost:5173',
    credentials: true,
  });
  await app.listen(process.env.PORT ?? 3000);
}
await bootstrap();
```

- `cookieParser()` — без него `req.cookies` будет `undefined` и refresh не прочитает cookie.
- `whitelist: true` — ValidationPipe выкидывает из body поля, которых нет в DTO.
- `credentials: true` (именно так, не `credential`) — иначе браузер не отправит/не сохранит cookie при кросс-origin запросах. На фронте запросы с `withCredentials: true`.

## 4. `src/config/jwt.config.ts`

```ts
import { ConfigService } from '@nestjs/config';
import { JwtModuleOptions } from '@nestjs/jwt';

export const getJwtConfig = async (
  configService: ConfigService,
): Promise<JwtModuleOptions> => ({
  secret: configService.get<string>('JWT_SECRET'),
});
```

## 5. `src/auth/auth.module.ts`

```ts
import { Module } from '@nestjs/common';
import { ConfigModule, ConfigService } from '@nestjs/config';
import { JwtModule } from '@nestjs/jwt';
import { getJwtConfig } from '../config/jwt.config.js';
import { UserModule } from '../user/user.module.js';
import { AuthController } from './auth.controller.js';
import { AuthService } from './auth.service.js';
import { GoogleStrategy } from './strategies/google.strategy.js';
import { JwtStrategy } from './strategies/jwt.strategy.js';

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
  providers: [AuthService, GoogleStrategy, JwtStrategy],
})
export class AuthModule {}
```

## 6. `src/auth/dto/auth.dto.ts`

```ts
import { ApiProperty } from '@nestjs/swagger';
import { IsEmail, IsOptional, IsString, MinLength } from 'class-validator';

export class AuthDto {
  @ApiProperty({
    description: 'The name of the user',
    example: 'John Doe',
  })
  @IsOptional()
  @IsString()
  name?: string;

  @ApiProperty({
    description: 'The email of the user',
    example: 'test@mail.com',
  })
  @IsEmail()
  @IsString()
  email: string;

  @ApiProperty({
    description: 'The password of the user',
    example: 'password123',
  })
  @MinLength(6)
  @IsOptional()
  @IsString()
  password?: string;
}
```

`password` помечен `@IsOptional()`, потому что этот же DTO используется в `UserService.create` для Google-пользователей (у них пароля нет). Побочный эффект — см. «Открытые проблемы» п.1.

`src/auth/dto/auth-response.dto.ts` — ответ login/register/refresh (для Swagger):

```ts
import { ApiProperty } from '@nestjs/swagger';
import { UserDto } from '../../user/dto/user.dto.js';

export class AuthResponseDto {
  @ApiProperty({ type: () => UserDto })
  user: UserDto;

  @ApiProperty({
    description: 'JWT access token. The refresh token is set as an httpOnly cookie.',
  })
  accessToken: string;
}
```

## 7. User: пароль скрыт по умолчанию

`src/user/entities/user.entity.ts`:

```ts
  @ApiHideProperty()
  @Column({ type: 'varchar', nullable: true, select: false })
  password: string | null;
```

`select: false` — пароль НЕ возвращается обычными `find*`. Поэтому:

- для проверки пароля нужен отдельный `findByEmailWithPassword` (через `addSelect`);
- в ответ клиенту отдаём пользователя, перечитанного через `findOne` — без хэша.

`src/user/user.service.ts` (методы, которые использует auth):

```ts
  async create(dto: AuthDto): Promise<User> {
    const user = await this.userRepository.save({
      ...dto,
      password: dto.password ? await hash(dto.password) : null,
    });
    return this.findOne(user.id);
  }

  async findOne(id: string): Promise<User> {
    const user = await this.userRepository.findOne({
      where: { id },
      relations: { stores: true, favorites: true, orders: true, reviews: true },
    });
    if (!user) {
      throw new NotFoundException(`User with id ${id} not found`);
    }
    return user;
  }

  async findByEmail(email: string): Promise<User | null> {
    const user = await this.userRepository.findOne({
      where: { email },
      relations: { stores: true, favorites: true, orders: true, reviews: true },
    });
    if (!user) {
      return null;
    }
    return user;
  }

  async findByEmailWithPassword(email: string): Promise<User | null> {
    return this.userRepository
      .createQueryBuilder('user')
      .addSelect('user.password')
      .where('user.email = :email', { email })
      .getOne();
  }
```

Хэширование пароля (`argon2.hash`) — здесь, в `UserService.create`, а НЕ в `AuthService.register`. Если захэшировать и там, и там — пароль захэшируется дважды и логин перестанет работать.

## 8. `src/auth/auth.service.ts`

```ts
import {
  BadRequestException,
  Injectable,
  NotFoundException,
  UnauthorizedException,
} from '@nestjs/common';
import { JwtService } from '@nestjs/jwt';
import { verify } from 'argon2';
import { UserService } from '../user/user.service.js';
import { ConfigService } from '@nestjs/config';
import { AuthDto } from './dto/auth.dto.js';
import { Response } from 'express';
import { User } from '../user/entities/user.entity.js';
import ms from 'ms';

interface Tokens {
  accessToken: string;
  refreshToken: string;
}

interface AuthResult extends Tokens {
  user: User;
}

@Injectable()
export class AuthService {
  REFRESH_TOKEN_NAME = 'refreshToken';

  constructor(
    private jwt: JwtService,
    private userService: UserService,
    private configService: ConfigService,
  ) {}

  async login(dto: AuthDto): Promise<AuthResult> {
    const validatedUser = await this.validateUser(dto);
    const user = await this.userService.findOne(validatedUser.id);
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  async register(dto: AuthDto): Promise<AuthResult> {
    const oldUser = await this.userService.findByEmail(dto.email);
    if (oldUser) {
      throw new BadRequestException('User already exists');
    }
    const user = await this.userService.create(dto);
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  async getNewTokens(refreshToken: string): Promise<AuthResult> {
    let result: { id: string };
    try {
      result = await this.jwt.verifyAsync(refreshToken);
    } catch {
      throw new UnauthorizedException('Invalid refresh token');
    }
    const user = await this.userService.findOne(result.id);
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  generateTokens(userId: string): Tokens {
    const data = { id: userId };

    const accessToken = this.jwt.sign(data, {
      expiresIn: this.configService.getOrThrow('JWT_ACCESS_EXPIRES_IN'),
    });

    const refreshToken = this.jwt.sign(data, {
      expiresIn: this.configService.getOrThrow('JWT_REFRESH_EXPIRES_IN'),
    });
    return { accessToken, refreshToken };
  }

  private async validateUser(dto: AuthDto): Promise<User> {
    const user = await this.userService.findByEmailWithPassword(dto.email);
    if (!user) {
      throw new NotFoundException('User not found');
    }
    if (!user.password || !dto.password || !(await verify(user.password, dto.password))) {
      throw new UnauthorizedException('Invalid credentials');
    }
    return user;
  }

  async validateOAuthLogin(req: any): Promise<AuthResult> {
    let user = await this.userService.findByEmail(req.user.email);
    if (!user) {
      user = await this.userService.create({
        email: req.user.email,
        name: req.user.name,
      });
    }
    const tokens = this.generateTokens(user.id);
    return { user, ...tokens };
  }

  addRefreshTokenToResponse(res: Response, refreshToken: string): void {
    const expiresIn = new Date(
      Date.now() + ms(this.configService.getOrThrow('JWT_REFRESH_EXPIRES_IN')),
    );

    res.cookie(this.REFRESH_TOKEN_NAME, refreshToken, {
      httpOnly: true,
      domain: this.configService.getOrThrow('SERVER_DOMAIN'),
      expires: expiresIn,
      secure: true,
      sameSite: 'none', // for production use 'lax'
    });
  }

  removeRefreshTokenFromResponse(res: Response): void {
    res.cookie(this.REFRESH_TOKEN_NAME, '', {
      httpOnly: true,
      domain: this.configService.getOrThrow('SERVER_DOMAIN'),
      expires: new Date(0),
      secure: true,
      sameSite: 'none', // for production use 'lax'
    });
  }
}
```

Ключевые моменты:

- `validateUser` берёт пользователя через `findByEmailWithPassword` и сверяет `argon2.verify`. Обычный `findByEmail` не подойдёт — там `password === undefined` (`select: false`).
- `login` после проверки перечитывает пользователя через `findOne`, чтобы хэш пароля не попал в ответ.
- `getNewTokens` — невалидный/протухший refresh → `UnauthorizedException` (401), фронт по нему уходит на `/login`.
- Срок cookie — `ms(JWT_REFRESH_EXPIRES_IN)`, тот же, что у самого JWT.
- `validateOAuthLogin(req)` — Google-профиль лежит в `req.user` (его туда кладёт `GoogleStrategy.validate`). Если пользователя нет — создаётся без пароля.

## 9. `src/auth/auth.controller.ts`

```ts
import {
  Body,
  Controller,
  Get,
  HttpCode,
  Post,
  Req,
  Res,
  UnauthorizedException,
  UseGuards,
} from '@nestjs/common';
import type { Request, Response } from 'express';
import {
  ApiExcludeEndpoint,
  ApiCreatedResponse,
  ApiOkResponse,
  ApiOperation,
  ApiTags,
  ApiUnauthorizedResponse,
} from '@nestjs/swagger';
import { AuthService } from './auth.service.js';
import { AuthDto } from './dto/auth.dto.js';
import { AuthResponseDto } from './dto/auth-response.dto.js';
import { MessageResponseDto } from '../common/dto/message-response.dto.js';
import { AuthGuard } from '@nestjs/passport';
import { ConfigService } from '@nestjs/config';

@ApiTags('auth')
@Controller('auth')
export class AuthController {
  constructor(
    private readonly authService: AuthService,
    private readonly configService: ConfigService,
  ) {}

  @ApiOperation({ summary: 'Log in with email and password' })
  @ApiOkResponse({
    description: 'Returns an access token and the authenticated user.',
    type: AuthResponseDto,
  })
  @HttpCode(200)
  @Post('login')
  async login(
    @Body() dto: AuthDto,
    @Res({ passthrough: true }) res: Response,
  ): Promise<AuthResponseDto> {
    const { refreshToken, ...response } = await this.authService.login(dto);
    this.authService.addRefreshTokenToResponse(res, refreshToken);
    return response;
  }

  @ApiOperation({ summary: 'Exchange the refresh token cookie for a new access token' })
  @ApiOkResponse({
    description: 'Returns a new access token and the authenticated user.',
    type: AuthResponseDto,
  })
  @ApiUnauthorizedResponse({ description: 'Refresh token missing or invalid.' })
  @HttpCode(200)
  @Post('login/access-token')
  async getNewTokens(
    @Req() req: Request,
    @Res({ passthrough: true }) res: Response,
  ): Promise<AuthResponseDto> {
    const refreshTokenFromCookie =
      req.cookies[this.authService.REFRESH_TOKEN_NAME];

    if (!refreshTokenFromCookie) {
      this.authService.removeRefreshTokenFromResponse(res);
      throw new UnauthorizedException('Refresh token not found');
    }

    const { refreshToken, ...response } = await this.authService.getNewTokens(
      refreshTokenFromCookie,
    );

    this.authService.addRefreshTokenToResponse(res, refreshToken);
    return response;
  }

  @ApiOperation({ summary: 'Register a new user' })
  @ApiCreatedResponse({
    description: 'Returns an access token and the created user.',
    type: AuthResponseDto,
  })
  @HttpCode(201)
  @Post('register')
  async register(
    @Body() dto: AuthDto,
    @Res({ passthrough: true }) res: Response,
  ): Promise<AuthResponseDto> {
    const { refreshToken, ...response } = await this.authService.register(dto);
    this.authService.addRefreshTokenToResponse(res, refreshToken);
    return response;
  }

  @ApiOperation({ summary: 'Log out and clear the refresh token cookie' })
  @ApiOkResponse({
    description: 'Logged out successfully.',
    type: MessageResponseDto,
  })
  @HttpCode(200)
  @Post('logout')
  async logout(@Res({ passthrough: true }) res: Response): Promise<MessageResponseDto> {
    this.authService.removeRefreshTokenFromResponse(res);
    return { message: 'Logged out successfully' };
  }

  @ApiExcludeEndpoint()
  @Get('google')
  @UseGuards(AuthGuard('google'))
  async googleAuth(@Req() req: Request) {
    // Initiates the Google OAuth2 login flow
  }

  @ApiExcludeEndpoint()
  @Get('google/callback')
  @UseGuards(AuthGuard('google'))
  async googleAuthCallback(
    @Req() req: any,
    @Res({ passthrough: true }) res: Response,
  ) {
    const { refreshToken, ...response } =
      await this.authService.validateOAuthLogin(req);
    this.authService.addRefreshTokenToResponse(res, refreshToken);

    return res.redirect(
      `${this.configService.get('CLIENT_URL')}/google-callback?accessToken=${response.accessToken}`,
    );
  }
}
```

- `@Res({ passthrough: true })` — даёт поставить cookie и при этом вернуть обычный `return` (Nest сам сериализует ответ). В `google/callback` вместо `return response` делается `res.redirect`.
- `@ApiExcludeEndpoint()` — Google-эндпоинты не показываются в Swagger (их нельзя вызвать через fetch, это редиректы).

## 10. `src/auth/strategies/jwt.strategy.ts`

```ts
import { Injectable, UnauthorizedException } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { PassportStrategy } from '@nestjs/passport';
import { ExtractJwt, Strategy } from 'passport-jwt';
import { UserService } from '../../user/user.service.js';

@Injectable()
export class JwtStrategy extends PassportStrategy(Strategy) {
  constructor(
    configService: ConfigService,
    private userService: UserService,
  ) {
    super({
      jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),
      ignoreExpiration: false,
      secretOrKey: configService.getOrThrow<string>('JWT_SECRET'),
    });
  }
  async validate(payload: { id: string }) {
    const user = await this.userService.findOne(payload.id).catch(() => null);
    if (!user) {
      throw new UnauthorizedException('User not found');
    }
    return user;
  }
}
```

Обязательно `UnauthorizedException`, а не голый `Error` — иначе Nest вернёт 500 вместо 401 (например, если токен валиден, а пользователь удалён).

## 11. Guard + декораторы

`src/auth/guards/jwt-auth.guard.ts`:

```ts
import { AuthGuard } from '@nestjs/passport';

export class JwtAuthGuard extends AuthGuard('jwt') {}
```

`src/auth/decorators/auth.decorator.ts`:

```ts
import { UseGuards } from '@nestjs/common';
import { JwtAuthGuard } from '../guards/jwt-auth.guard.js';

export const Auth = () => UseGuards(JwtAuthGuard);
```

`src/user/decorators/user.decorator.ts`:

```ts
import { createParamDecorator, ExecutionContext } from '@nestjs/common';
import { User } from '../entities/user.entity.js';

export const CurrentUser = createParamDecorator(
  (data: keyof User, ctx: ExecutionContext) => {
    const request = ctx.switchToHttp().getRequest();
    const user = request.user as User;
    return data ? user?.[data] : user;
  },
);
```

Использование на защищённом роуте:

```ts
@Auth()
@Get('me')
getMe(@CurrentUser() user: User) {
  return user;
}
```

## 12. Google OAuth

`src/auth/strategies/google.strategy.ts`:

```ts
import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { PassportStrategy } from '@nestjs/passport';
import { Profile, Strategy, VerifyCallback } from 'passport-google-oauth20';

@Injectable()
export class GoogleStrategy extends PassportStrategy(Strategy, 'google') {
  constructor(configService: ConfigService) {
    super({
      clientID: configService.getOrThrow<string>('GOOGLE_CLIENT_ID'),
      clientSecret: configService.getOrThrow<string>('GOOGLE_CLIENT_SECRET'),
      callbackURL:
        configService.getOrThrow<string>('SERVER_URL') +
        '/auth/google/callback',
      scope: ['email', 'profile'],
    });
  }
  async validate(
    _accessToken: string,
    _refreshToken: string,
    profile: Profile,
    done: VerifyCallback,
  ) {
    const { displayName, emails, photos } = profile;
    const user = {
      email: emails?.[0].value,
      name: displayName,
      picture: photos?.[0].value,
    };
    done(null, user);
  }
}
```

Флоу:

```text
Angular: window.location.href = SERVER_URL/auth/google
↓
GET /auth/google            (AuthGuard('google') → редирект на Google)
↓
Google (пользователь логинится)
↓
GET /auth/google/callback   (AuthGuard('google') → GoogleStrategy.validate → req.user)
↓
validateOAuthLogin(req)     (найти или создать пользователя)
↓
Set-Cookie: refreshToken
↓
redirect CLIENT_URL/google-callback?accessToken=...
↓
Angular GoogleCallbackPage: setAccessToken → /dashboard
```

Два разных callback'а — не путать:

```text
Google → backend    SERVER_URL/auth/google/callback   ← Authorized redirect URI в Google Console
                                                        (= callbackURL в google.strategy.ts)
backend → Angular   CLIENT_URL/google-callback        ← обычный res.redirect в auth.controller.ts,
                                                        Google про него не знает
```

Менять фронтовый путь (`/dashboard` → `/google-callback`) можно без Google Console.

Минус способа — accessToken в URL может осесть в истории браузера/логах. На фронте смягчается `navigateByUrl(..., { replaceUrl: true })`. Строже — не передавать токен в URL, а после редиректа сделать на фронте `POST /auth/login/access-token` по уже поставленной cookie.

## 13. Cookie: sameSite / secure / domain

```ts
secure: true,
sameSite: 'none',
domain: SERVER_DOMAIN,
```

- `sameSite: 'none'` требует `secure: true`. На `localhost` Chrome считает http безопасным контекстом, поэтому работает и без https.
- `localhost:4200` и `localhost:5000` — один **site** (порт не учитывается), поэтому локально хватило бы и `'lax'`.
- В проде `teacoder.ru` + `api.teacoder.ru` — тоже один site → `'lax'` + `SERVER_DOMAIN=.teacoder.ru`. `'none'` нужен, только если фронт и API на совсем разных доменах.

---

## Открытые проблемы

1. **Регистрация без пароля.** `password` в `AuthDto` — `@IsOptional()`, поэтому `POST /auth/register` с `{ email }` без пароля создаёт пользователя с `password: null`. Войти по паролю в него нельзя, но email занят — настоящий владелец не сможет зарегистрироваться обычным способом (только через Google). Решение: отдельный `RegisterDto` с обязательным `password` для `register`/`login`, а для Google — свой тип в `UserService.create`.
2. **access и refresh токены не различаются.** Оба подписываются одним `JWT_SECRET` с одинаковым payload `{ id }`. accessToken можно подсунуть как refreshToken (и наоборот). Сейчас не эксплуатируется (refresh читается только из httpOnly cookie), но стоит добавить `{ id, type: 'refresh' }` и проверять `type`, либо разные секреты.
3. **Нет отзыва refresh-токенов.** Токены stateless — принудительно разлогинить (смена пароля, кража токена) нельзя, только ждать истечения. Если важно — хранить refreshToken (или его хэш/jti) в БД и сверять при рефреше.
4. **`jwt.config.ts` — `configService.get`**, а не `getOrThrow`. При пустом `JWT_SECRET` сервер стартует и упадёт только на первом `jwt.sign`. `getOrThrow` уронит его сразу при старте.
5. **Комментарий `// for production use 'lax'`** в `addRefreshTokenToResponse` верен только если фронт и API на одном site (см. п.13).

### Уже исправлено (было в исходнике)

- [x] `argon2.verify` на логине (раньше пароль не проверялся вообще)
- [x] `findByEmailWithPassword` + `select: false` — хэш не утекает в ответ
- [x] `credentials: true` в `enableCors` (было `credential`)
- [x] убран несуществующий `expandHeaders: 'set-cookie'`
- [x] `ms()` вместо `parseInt()` для срока жизни cookie
- [x] `UnauthorizedException` в `JwtStrategy.validate` (было `new Error` → 500)
- [x] `whitelist: true` в `ValidationPipe`
