### Create new module

```bash
nest g module auth
```

### Create controller and service

```bash
nest g controller auth --no-spec && nest g service auth --no-spec
```

### Create a user entity

```typescript
// src/auth/user.entity.ts

import { BaseEntity, Column, Entity, PrimaryGeneratedColumn } from "typeorm";

@Entity()
export class UserEntity extends BaseEntity {
  @PrimaryGeneratedColumn()
  id: number;

  @Column()
  username: string;

  @Column()
  password: string;
}
```

### Create UserRepository

```typescript
// src/auth/user.repository.ts

import { Repository } from "typeorm";
import { UserEntity } from "./user.entity";
import { Injectable } from "@nestjs/common";

@Injectable()
export class UserRepository extends Repository<UserEntity> {}
```

inject it in AuthModule and register the entity

```typescript
// src/auth/auth.module.ts
@Module({
  imports: [TypeOrmModule.forFeature([UserEntity])],
  controllers: [AuthController],
  providers: [AuthService, UserRepository]
})
```

### inject UserRepository in AuthService

```typescript
@Injectable()
export class AuthService {
  constructor(@InjectRepository(UserRepository) private userRepository: UserRepository) {}
}
```

### Create DTOs for user registration and login

```typescript
// src/auth/dto/auth-credentials.dto.ts

export class AuthCredentialsDto {
  username: string;
  password: string;
}
```

### signUp in repository

```typescript
// src/auth/user.repository.ts
async signUp(authCredentialsDto: AuthCredentialsDto): Promise<void> {
  const {username, password} = authCredentialsDto;
  const user = new UserEntity();
  user.username = username;
  user.password = password;
  await user.save();
}
```

### signUp in service

```typescript
// src/auth/auth.service.ts

export class AuthService {
  constructor(@InjectRepository(UserRepository) private userRepository: UserRepository) {}

  async signUp(authCredentialsDto: AuthCredentialsDto): Promise<void> {
    return this.userRepository.signUp(authCredentialsDto);
  }
}
```

### validation for authCredentialsDto

```typescript
// src/auth/dto/auth-credentials.dto.ts

import { IsString, MaxLength, MinLength } from "class-validator";

export class AuthCredentialsDto {
  @IsString()
  @MinLength(4)
  @MaxLength(20)
  username: string;

  @IsString()
  @MinLength(8)
  @MaxLength(20)
  @Matches(/(?:(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*)/, {
    message:
      "password must contain at least one uppercase letter, one lowercase letter, and one number",
  })
  password: string;
}
```

### signUp in controller

```typescript
// src/auth/auth.controller.ts

export class AuthController {
  constructor(private authService: AuthService) {}

  @Post("/signup")
  async signUp(@Body() authCredentialsDto: AuthCredentialsDto): Promise<void> {
    return this.authService.signUp(authCredentialsDto);
  }
}
```

### user repository with orm

```typescript
// src/auth/user.repository.ts

constructor(private dataSource: DataSource) {
    super(UserEntity, dataSource.createEntityManager());
}
```

### auth service get all

```typescript
// src/auth/auth.service.ts
  async getAllUsers(): Promise<UserEntity[]> {
    return this.userRepository.find();
  }
```

### auth controller get all

```typescript
// src/auth/auth.controller.ts
  @Get('/users')
  async getAllUsers(): Promise<UserEntity[]> {
    return this.authService.getAllUsers();
  }
```

### delete user in auth service

```typescript

  async deleteUser(id: number): Promise<void> {
    await this.userRepository.delete(id);
  }
```

### delete user in auth controller

```typescript
  @Delete('/user/:id')
  async deleteUser(@Param('id', ParseIntPipe) id: number): Promise<void> {
    return this.authService.deleteUser(id);
  }
```

### auth service signUp unique username

```typescript
// src/auth/user.repository.ts

  async signUp(authCredentialsDto: AuthCredentialsDto): Promise<void> {
    const { username, password } = authCredentialsDto;
    const user = new UserEntity();
    user.username = username;
    user.password = password;
    try {
      await user.save();
    } catch (error) {
      if ('code' in error && error.code === '23505') {
        throw new ConflictException('Username already exists');
      }
      throw new InternalServerErrorException();
    }
  }
```

### hashed password

```bash
bun add bcrypt
```

user entity added salt and drop db, to recreate it

```typescript
// src/auth/user.entity.ts

@Column()
salt: string;
```

auth repository added salt and save to db

```typescript
// src/auth/user.repository.ts

import * as bcrypt from "bcrypt";

@Injectable()
export class UserRepository extends Repository<UserEntity> {
  constructor(private dataSource: DataSource) {
    super(UserEntity, dataSource.createEntityManager());
  }

  async signUp(authCredentialsDto: AuthCredentialsDto): Promise<void> {
    const { username, password } = authCredentialsDto;
    const user = new UserEntity();
    const salt = await bcrypt.genSalt();
    user.salt = salt;
    user.username = username;
    user.password = await this.hashPassword(password, salt);
    try {
      await user.save();
    } catch (error) {
      if ("code" in error && error.code === "23505") {
        throw new ConflictException("Username already exists");
      }
      throw new InternalServerErrorException();
    }
  }

  private async hashPassword(password: string, salt: string): Promise<string> {
    return bcrypt.hash(password, salt);
  }
}
```

### validate user password

user entity method

```typescript
// src/auth/user.entity.ts

  @Column()
  salt: string;

  async validatePassword(password: string): Promise<boolean> {
    const hashedPassword = await bcrypt.hash(password, this.salt);
    return hashedPassword === this.password;
  }
```

auth repository validate user

```typescript
// src/auth/user.repository.ts

async validateUserPassword( authCredentialsDto: AuthCredentialsDto,): Promise<string | null> {
    const { username, password } = authCredentialsDto;
    const user = await this.findOne({ where: { username } });
    if (user && await user.validatePassword(password)) {
      return user.username;
    } else {
      return null;
    }
}

```

### signIn method in auth service

```typescript
// src/auth/auth.service.ts

  async signIn( authCredentialsDto: AuthCredentialsDto,): Promise<string | null> {
    const username = await this.userRepository.validateUserPassword(authCredentialsDto);
    if (!username) {
      throw new UnauthorizedException('Invalid credentials');
    }
    return username;
  }
```

controller

```typescript
// src/auth/auth.controller.ts

  @Post('/signin')
  async signIn( @Body() authCredentialsDto: AuthCredentialsDto,): Promise<string | null> {
    return this.authService.signIn(authCredentialsDto);
  }
```

### JWT setup

```bash
bun add @nestjs/jwt @nestjs/passport passport passport-jwt
```

### JWT module configure jwt and passport

```typescript
// src/auth/auth.module.ts

import { JwtModule } from '@nestjs/jwt';
import {PassportModule} from '@nestjs/passport';

@Module({
  imports: [
    TypeOrmModule.forFeature([UserEntity]),
    PassportModule.register({ defaultStrategy: 'jwt' }),
    JwtModule.register({
      secret: 'your_jwt_secret_key',
      signOptions: { expiresIn: '1h' },
    }),
  ],
  controllers: [AuthController],
  providers: [AuthService, UserRepository],
})
export class AuthModule {}
```

### JWT signInt

create interface for payload in auth folder

```typescript
// src/auth/interfaces/jwt-payload.interface.ts
export interface JwtPayload {
  username: string;
}
```

create interface signInResponse in auth folder

```typescript
// src/auth/interfaces/sign-in-response.interface.ts
export interface ISignInResponse {
  accessToken: string;
}
```

in auth service signIn method

```typescript
// src/auth/auth.service.ts

  async signIn(
    authCredentialsDto: AuthCredentialsDto,
  ): Promise<ISignInResponse | null> {
    const username =
      await this.userRepository.validateUserPassword(authCredentialsDto);
    if (!username) {
      throw new UnauthorizedException('Invalid credentials');
    }

    const payload: IJwtPayload = { username };
    const accessToken = this.jwtService.sign(payload);
    return { accessToken };
  }
```

auth controller signIn method

```typescript
// src/auth/auth.controller.ts

  @Post('/signin')
  async signIn(
    @Body() authCredentialsDto: AuthCredentialsDto,
  ): Promise<ISignInResponse | null> {
    return this.authService.signIn(authCredentialsDto);
  }
```
