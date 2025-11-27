Сервисы в NestJS: как они работают

# 1. Что такое сервис в NestJS

**Сервис** — это класс с бизнес-логикой, который:
помечен декоратором `@Injectable()`;
регистрируется как **provider** в модуле;
может быть **внедрён** (инжектирован) в другие классы (контроллеры, другие сервисы, guard'ы и т.д.).

основная идея:

**контроллеры отвечают за HTTP, сервисы — за логику.**

простой пример сервиса:

```ts
import { Injectable } from "@nestjs/common";

@Injectable()
export class UsersService {
  private users = ["Alice", "Bob"];

  findAll() {
    return this.users;
  }

  findOne(id: number) {
    return this.users[id] ?? null;
  }

  create(name: string) {
    this.users.push(name);
  }
}
```

2. Регистрация сервиса в модуле
   Чтобы Nest знал о сервисе, его нужно зарегистрировать как provider в модуле.

```ts
import { Module } from "@nestjs/common";
import { UsersService } from "./users.service";
import { UsersController } from "./users.controller";

@Module({
  controllers: [UsersController],
  providers: [UsersService], // <-- регистрация сервиса
  exports: [UsersService], // <-- экспорт, если сервис нужен в других модулях
})
export class UsersModule {}
```

Если сервис нужен в другом модуле, этот модуль должен:

Импортировать UsersModule;

Забрать оттуда экспортированный сервис.

```ts
import { Module } from "@nestjs/common";
import { UsersModule } from "../users/users.module";
import { OrdersService } from "./orders.service";

@Module({
  imports: [UsersModule], // <-- сюда подтягиваем UsersModule
  providers: [OrdersService],
})
export class OrdersModule {}
```

Теперь OrdersService может инжектировать UsersService.

### 3. Как работает DI (Dependency Injection) в NestJS

NestJS использует контейнер зависимостей:

- На старте приложения Nest сканирует модули.
- Видит массив providers и создаёт экземпляры классов.
- Если в конструкторе сервиса есть зависимости — Nest пытается их тоже создать и передать.
- Все эти экземпляры складываются в контейнер, и дальше их можно переиспользовать.

Пример: сервис инжектируется в контроллер:

```ts
import { Controller, Get, Param } from "@nestjs/common";
import { UsersService } from "./users.service";

@Controller("users")
export class UsersController {
  constructor(private readonly usersService: UsersService) {}

  @Get()
  findAll() {
    return this.usersService.findAll();
  }

  @Get(":id")
  findOne(@Param("id") id: string) {
    return this.usersService.findOne(Number(id));
  }
}
```

Здесь Nest делает примерно следующее (упрощённо):

- создаёт UsersService;
- создаёт UsersController, передавая в конструктор уже готовый экземпляр UsersService.

### 4. Инжекция одного сервиса в другой

Сервисы могут зависимости друг от друга:

```ts
import { Injectable } from "@nestjs/common";
import { UsersService } from "../users/users.service";

@Injectable()
export class OrdersService {
  constructor(private readonly usersService: UsersService) {}

  createOrderForUser(userId: number, productId: number) {
    const user = this.usersService.findOne(userId);
    if (!user) {
      throw new Error("User not found");
    }

    // какая-то логика создания заказа
    return {
      user,
      productId,
      status: "created",
    };
  }
}
```

Чтобы это работало:

UsersService должен быть экспортирован из UsersModule;

OrdersModule должен импортировать UsersModule.

### 5. Виды провайдеров (providers)

В providers можно регистрировать не только классы:

Class provider (обычный сервис):

```ts
providers: [UsersService];
```

Value provider:

```ts
const CONFIG = { apiKey: "123", env: "dev" };

@Module({
  providers: [
    {
      provide: "APP_CONFIG",
      useValue: CONFIG,
    },
  ],
})
export class AppModule {}
```

Инжект:

```ts
@Injectable()
export class SomeService {
  constructor(@Inject("APP_CONFIG") private readonly config: any) {}
}
```

Factory provider:

```ts
@Module({
  providers: [
    {
      provide: "RANDOM_NUMBER",
      useFactory: () => Math.random(),
    },
  ],
})
export class AppModule {}
```

Инжект:

```ts
@Injectable()
export class DemoService {
  constructor(@Inject("RANDOM_NUMBER") private readonly random: number) {}
}
```

Existing provider (алиас):

```ts
providers: [
  UsersService,
  {
    provide: "USERS_SERVICE_ALIAS",
    useExisting: UsersService,
  },
];
```

### 6. Scope (область жизни сервиса)

По умолчанию сервис — singleton:

создаётся 1 раз на всё приложение;

переиспользуется везде.

Можно поменять scope:

```ts
import { Injectable, Scope } from "@nestjs/common";

@Injectable({ scope: Scope.REQUEST })
export class RequestScopedService {
  // создаётся заново на каждый HTTP-запрос
}
```

Варианты:

- DEFAULT — singleton;
- REQUEST — новый инстанс на каждый запрос;
- TRANSIENT — новый инстанс при каждом инжекте.

### 7. Жизненный цикл сервиса (lifecycle hooks)

Сервис может реализовывать хуки:

- OnModuleInit — вызывается, когда модуль и все его зависимости готовы;
- OnModuleDestroy — при остановке приложения.

```ts
import { Injectable, OnModuleInit, OnModuleDestroy } from "@nestjs/common";

@Injectable()
export class DbService implements OnModuleInit, OnModuleDestroy {
  onModuleInit() {
    console.log("DbService init: connect to DB");
  }

  onModuleDestroy() {
    console.log("DbService destroy: close DB connection");
  }
}
```
