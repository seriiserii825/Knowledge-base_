### Pipes в NestJS

Pipes в NestJS — это классы, которые перехватывают входящие данные (параметры контроллера) до того, как они попадут в метод, и могут:

- трансформировать данные (string → number, trim, toUpperCase и т.д.),
- валидировать данные и выбрасывать исключения, если что-то не так.

NestJS Documentation

Любой pipe реализует интерфейс PipeTransform и метод transform().

```ts
import { PipeTransform, Injectable, ArgumentMetadata } from "@nestjs/common";

@Injectable()
export class ExamplePipe implements PipeTransform {
  transform(value: any, metadata: ArgumentMetadata) {
    // value    — значение параметра (например, @Body() или @Param('id'))
    // metadata — информация о параметре (тип: body/query/param, мета-тип и т.д.)
    return value;
  }
}
```

ArgumentMetadata содержит:

```ts
type: 'body' | 'query' | 'param' | 'custom'
```

metatype: класс/тип (например, String, Number, CreateTaskDto)

data: строка из декоратора (@Param('id') → "id")

Где можно применять Pipes

Pipes можно вешать на разных уровнях:

На конкретный параметр

```ts
@Get(':id')
getById(@Param('id', ParseIntPipe) id: number) {
    // сюда уже прилетит number, а не string
}
```

### На параметр с кастомным pipe


```ts
@Get()
    getTasks(@Query('status', TaskStatusValidationPipe) status: TaskStatus) {
        // status уже проверен и приведён к нужному enum
    }
```

### На метод


```ts
    @Post()
@UsePipes(new ValidationPipe())
    create(@Body() dto: CreateTaskDto) {
        // Весь body валидируется по декораторам class-validator
    }
```

### На контроллер


```ts
@UsePipes(new ValidationPipe())
    @Controller('tasks')
    export class TasksController {
        // Все методы внутри контроллера идут через этот pipe
    }
```

### Глобально (на всё приложение)


main.ts:

```ts
import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';
import { ValidationPipe } from '@nestjs/common';

async function bootstrap() {
    const app = await NestFactory.create(AppModule);

    app.useGlobalPipes(
            new ValidationPipe({
whitelist: true, // удалять поля, которых нет в DTO
forbidNonWhitelisted: true, // падать, если пришли лишние поля
transform: true, // автоматически приводить типы (string -> number и т.д.)
}),
            );

await app.listen(3000);
}
bootstrap();
```

### Встроенные Pipes (built-in)


NestJS даёт несколько готовых pipe’ов из коробки:

- ValidationPipe — валидация по DTO и декораторам class-validator.
- ParseIntPipe — конвертация строки в число.
- ParseBoolPipe — "true"/"false" → boolean.
- ParseUUIDPipe — проверяет параметр как UUID (можно указать версию).
- ParseArrayPipe — парсит строку/массив в Array нужного типа.
- DefaultValuePipe — подставляет значение по умолчанию, если пришёл null | undefined.

Примеры использования:

```ts
@Get(':id')
findOne(@Param('id', ParseIntPipe) id: number) {
    // id — гарантированно number, иначе выброшено исключение
}

@Get()
    getItems(
            @Query('page', new DefaultValuePipe(1), ParseIntPipe) page: number,
            @Query('limit', new DefaultValuePipe(10), ParseIntPipe) limit: number,
            ) {
        // page и limit уже числа, с дефолтами
    }

```

### ValidationPipe + DTO + class-validator


Самый часто используемый сценарий — валидация тела запроса по DTO.

Ставим зависимости:

```bash
npm i class-validator class-transformer
```

### DTO с декораторами:


```ts
import { IsEnum, IsNotEmpty, IsOptional, IsString } from 'class-validator';
import { TaskStatus } from '../tasks.model';

export class CreateTaskDto {
    @IsNotEmpty()
        @IsString()
        title: string;

    @IsNotEmpty()
        @IsString()
        description: string;
}

export class FilterTaskDto {
    @IsOptional()
        @IsEnum(TaskStatus) // проверяет, что значение входит в enum
        status?: TaskStatus;

    @IsOptional()
        @IsString()
        search?: string;
}
```

Controller:

```ts
import { Body, Controller, Get, Post, Query } from '@nestjs/common';
import { CreateTaskDto, FilterTaskDto } from './dto';
import { TasksService } from './tasks.service';
import { Task } from './tasks.model';

@Controller('tasks')
export class TasksController {
    constructor(private readonly tasksService: TasksService) {}

    @Get()
        getAll(@Query() filterDto: FilterTaskDto): Task[] {
            if (Object.keys(filterDto).length) {
                return this.tasksService.filterTasks(filterDto);
            }
            return this.tasksService.getAllTasks();
        }

    @Post()
        create(@Body() dto: CreateTaskDto): Task {
            return this.tasksService.createTask(dto);
        }
}
```

Глобальный ValidationPipe уже был выше в main.ts.

Теперь:

- Если поля не проходят валидацию → кидается BadRequestException с описанием ошибок.
- Если whitelist: true → лишние поля убираются.
- Если transform: true → параметры приводятся к типам, указанным в DTO и сигнатурах методов.

### Кастомный pipe: пример проверки enum (TaskStatus)


Твой пример с TaskStatusValidationPipe можно оформить по-nest’овски так:

```ts
import {
    PipeTransform,
        Injectable,
        BadRequestException,
} from '@nestjs/common';
import { TaskStatus } from 'src/tasks/tasks.model';

@Injectable()
    export class TaskStatusValidationPipe implements PipeTransform {
        private readonly allowedStatuses = Object.values(TaskStatus);

        transform(value: unknown) {
            if (typeof value !== 'string') {
                throw new BadRequestException(
                        `Status must be a string. Allowed: ${this.allowedStatuses.join(', ')}`,
                        );
            }

            const upperValue = value.toUpperCase();

            if (!this.isStatusValid(upperValue)) {
                throw new BadRequestException(
                        `"${value}" is an invalid status. Use one of: ${this.allowedStatuses.join(
                                ', ',
                                )}`,
                        );
            }

            // возвращаем нормализованное значение (например, в верхнем регистре)
            return upperValue as TaskStatus;

        }

        private isStatusValid(status: string): boolean {
            return this.allowedStatuses.includes(status as TaskStatus);
        }
    }
```

Важно:
В NestJS лучше кидать HTTP-исключения (BadRequestException, NotFoundException и т.д.), а не new Error(). Тогда глобальный exception filter корректно сформирует HTTP-ответ.
NestJS Documentation

Использование в контроллере:

```ts
@Patch(':id/status')
updateStatus(
        @Param('id') id: string,
        @Body('status', TaskStatusValidationPipe) status: TaskStatus,
        ) {
    return this.tasksService.updateStatus(id, status);
}
```

### Кастомный pipe: трансформация строки


Простой пример pipe, который триммит строку и приводит к нижнему регистру:

```ts
import { PipeTransform, Injectable } from '@nestjs/common';

@Injectable()
    export class TrimToLowerPipe implements PipeTransform {
        transform(value: any) {
            if (typeof value !== 'string') return value;
            return value.trim().toLowerCase();
        }
    }
```

Использование:

@Get('search')
search(@Query('q', TrimToLowerPipe) query: string) {
// сюда придёт "hello world", а не " HELLO World "
}

### Когда использовать Pipes


Типичные кейсы:

- Валидация запросов (body, query, params) через DTO + ValidationPipe.
- Преобразование типов: ParseIntPipe, ParseBoolPipe, ParseUUIDPipe, ParseArrayPipe.
- Нормализация данных (trim, toLowerCase, конвертации и т.п.).
- Бизнес-валидация простого уровня (например, проверка enum, диапазоны, формат значения).

### Что НЕ стоит делать в pipes:


Долгие/тяжёлые операции (запросы в БД, внешние API), если это можно сделать в сервисе.

Сложную бизнес-логику — pipes лучше держать узкими и техническими:
валидация + простая трансформация.
