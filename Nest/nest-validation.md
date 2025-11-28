### ✅ 1. Установка

Выполни:

```bash
npm install class-validator class-transformer
```

или

```bash
yarn add class-validator class-transformer
```

### ✅ 2. Включить ValidationPipe глобально

Открой main.ts и добавь:

```ts
import { ValidationPipe } from "@nestjs/common";

async function bootstrap() {
  const app = await NestFactory.create(AppModule);

  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true, // удаляет поля, которых нет в DTO
      forbidNonWhitelisted: true, // ошибка, если прислали лишнее поле
      transform: true, // включить class-transformer
      transformOptions: {
        enableImplicitConversion: true, // автоматически приводит типы
      },
    })
  );

  await app.listen(3000);
}
bootstrap();
```

### ✅ 3. Создаём DTO с декораторами валидации

Пример create-user.dto.ts:

```ts
import { IsString, IsEmail, MinLength } from "class-validator";

export class CreateUserDto {
  @IsString()
  name: string;

  @IsEmail()
  email: string;

  @MinLength(6)
  password: string;
}
```

### ✅ 4. Используем DTO в контроллере

```ts
@Post()
    createUser(@Body() dto: CreateUserDto) {
        return dto; // уже валидированный объект
    }
```

### ✅ 5. Список всех доступных декораторов
Вот некоторые из самых популярных декораторов, которые ты можешь использовать в своих DTO:
- `@IsString()`: Проверяет, что значение является строкой.
- `@IsInt()`: Проверяет, что значение является целым числом.
- `@IsEmail()`: Проверяет, что значение является корректным email.
- `@MinLength(length: number)`: Проверяет, что строка имеет минимальную длину.
- `@MaxLength(length: number)`: Проверяет, что строка не превышает максимальную длину.
- `@IsOptional()`: Делает поле необязательным.
- `@IsBoolean()`: Проверяет, что значение является булевым.
- `@IsDate()`: Проверяет, что значение является датой.
- `@IsArray()`: Проверяет, что значение является массивом.
- `@ValidateNested()`: Позволяет валидировать вложенные объекты
- `@IsEnum(enumType: object)`: Проверяет, что значение является одним из значений перечисления.
Полный список декораторов можно найти в [официальной документации class-validator](https://github.com/typestack/class-validator#validation-decorators).

