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
