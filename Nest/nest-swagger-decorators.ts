import { applyDecorators } from "@nestjs/common";
import { ApiResponse } from "@nestjs/swagger";

export function ApiUnauthorizedResponse() {
  return applyDecorators(
    ApiResponse({
      status: 401,
      description: "Unauthorized",
      schema: {
        example: {
          message: "Unauthorized",
          statusCode: 401,
        },
      },
    }),
  );
}

// user.entity.ts
import { ApiProperty } from "@nestjs/swagger";

export class User {
  @ApiProperty({ example: 1 })
  id: number;

  @ApiProperty({ example: "john.doe@example.com" })
  email: string;

  @ApiProperty({ example: "John Doe" })
  name: string;

  @ApiProperty({ example: "hashed_password_here" })
  password: string;

  @ApiProperty({ example: "active", enum: ["active", "inactive", "banned"] })
  status: string;

  @ApiProperty({ example: "2024-01-01T00:00:00Z" })
  createdAt: Date;

  @ApiProperty({ example: "2024-01-01T00:00:00Z" })
  updatedAt: Date;
}

// dto/create-user.dto.ts
import { OmitType } from "@nestjs/swagger";
import { User } from "../user.entity";
import { IsEmail, IsString, MinLength, IsEnum, IsOptional } from "class-validator";

export class CreateUserDto extends OmitType(User, ["id", "createdAt", "updatedAt"] as const) {
  @IsEmail()
  email: string;

  @IsString()
  @MinLength(2)
  name: string;

  @IsString()
  @MinLength(8)
  password: string;

  @IsEnum(["active", "inactive", "banned"])
  @IsOptional()
  status: string;
}

// dto/update-user.dto.ts
import { PartialType, OmitType } from "@nestjs/swagger";
import { CreateUserDto } from "./create-user.dto";

// Делаем все поля опциональными и исключаем пароль из обновления
export class UpdateUserDto extends PartialType(OmitType(CreateUserDto, ["password"] as const)) {}

// dto/user-response.dto.ts
import { OmitType } from "@nestjs/swagger";
import { User } from "../user.entity";

// Исключаем пароль из ответа
export class UserResponseDto extends OmitType(User, ["password"] as const) {}

// dto/query-users.dto.ts
import { ApiPropertyOptional } from "@nestjs/swagger";
import { IsOptional, IsInt, Min, Max, IsEnum, IsString } from "class-validator";
import { Type } from "class-transformer";

export class QueryUsersDto {
  @ApiPropertyOptional({ example: 1, minimum: 1 })
  @IsOptional()
  @Type(() => Number)
  @IsInt()
  @Min(1)
  page?: number = 1;

  @ApiPropertyOptional({ example: 10, minimum: 1, maximum: 100 })
  @IsOptional()
  @Type(() => Number)
  @IsInt()
  @Min(1)
  @Max(100)
  limit?: number = 10;

  @ApiPropertyOptional({ example: "active", enum: ["active", "inactive", "banned"] })
  @IsOptional()
  @IsEnum(["active", "inactive", "banned"])
  status?: string;

  @ApiPropertyOptional({ example: "john" })
  @IsOptional()
  @IsString()
  search?: string;
}

// dto/paginated-response.dto.ts
import { ApiProperty } from "@nestjs/swagger";
import { Type } from "class-transformer";

export class PaginationMetaDto {
  @ApiProperty()
  total: number;

  @ApiProperty()
  page: number;

  @ApiProperty()
  limit: number;

  @ApiProperty()
  totalPages: number;
}

export class PaginatedResponseDto<T> {
  @ApiProperty({ type: [Object] })
  data: T[];

  @ApiProperty({ type: PaginationMetaDto })
  meta: PaginationMetaDto;
}

// users.controller.ts
import {
  Controller,
  Get,
  Post,
  Put,
  Delete,
  Body,
  Param,
  Query,
  ParseIntPipe,
} from "@nestjs/common";
import { ApiTags, ApiOperation, ApiResponse, ApiParam, ApiQuery } from "@nestjs/swagger";
import { CreateUserDto } from "./dto/create-user.dto";
import { UpdateUserDto } from "./dto/update-user.dto";
import { UserResponseDto } from "./dto/user-response.dto";
import { QueryUsersDto } from "./dto/query-users.dto";
import { PaginatedResponseDto } from "./dto/paginated-response.dto";

@ApiTags("users")
@Controller("users")
export class UsersController {
  @Post()
  @ApiOperation({ summary: "Создать нового пользователя" })
  @ApiResponse({
    status: 201,
    description: "Пользователь успешно создан",
    type: UserResponseDto,
  })
  @ApiResponse({ status: 400, description: "Некорректные данные" })
  create(@Body() createUserDto: CreateUserDto): Promise<UserResponseDto> {
    // Реализация
    return null;
  }

  @Get()
  @ApiOperation({ summary: "Получить список пользователей" })
  @ApiResponse({
    status: 200,
    description: "Список пользователей",
    type: [UserResponseDto],
  })
  findAll(@Query() query: QueryUsersDto): Promise<PaginatedResponseDto<UserResponseDto>> {
    // Реализация
    return null;
  }

  @Get(":id")
  @ApiOperation({ summary: "Получить пользователя по ID" })
  @ApiParam({ name: "id", type: Number, description: "ID пользователя" })
  @ApiResponse({
    status: 200,
    description: "Пользователь найден",
    type: UserResponseDto,
  })
  @ApiResponse({ status: 404, description: "Пользователь не найден" })
  findOne(@Param("id", ParseIntPipe) id: number): Promise<UserResponseDto> {
    // Реализация
    return null;
  }

  @Put(":id")
  @ApiOperation({ summary: "Обновить пользователя" })
  @ApiParam({ name: "id", type: Number, description: "ID пользователя" })
  @ApiResponse({
    status: 200,
    description: "Пользователь обновлен",
    type: UserResponseDto,
  })
  @ApiResponse({ status: 404, description: "Пользователь не найден" })
  update(
    @Param("id", ParseIntPipe) id: number,
    @Body() updateUserDto: UpdateUserDto,
  ): Promise<UserResponseDto> {
    // Реализация
    return null;
  }

  @Delete(":id")
  @ApiOperation({ summary: "Удалить пользователя" })
  @ApiParam({ name: "id", type: Number, description: "ID пользователя" })
  @ApiResponse({ status: 200, description: "Пользователь удален" })
  @ApiResponse({ status: 404, description: "Пользователь не найден" })
  remove(@Param("id", ParseIntPipe) id: number): Promise<void> {
    // Реализация
    return null;
  }
}
