# NestJS на пальцах

Если совсем на пальцах, то NestJS — это огромная система классов и зависимостей (**Dependency Injection**).

Представь приложение как набор коробок:

- **Module** — коробка
- **Provider** — сервис внутри коробки
- **Inject** — попросить Nest дать тебе сервис
- **Imports** — подключить другую коробку
- **Exports** — разрешить другим коробкам использовать сервис
- **Global** — сделать коробку доступной везде

---

# 1. Provider

Обычный сервис:

```ts
@Injectable()
export class PrismaService {
  connect() {
    console.log("Connected");
  }
}
```

Nest создаёт его сам.

```ts
constructor(private prisma: PrismaService) {}
```

Nest видит:

```ts
private prisma: PrismaService
```

и автоматически создаёт объект:

```ts
new PrismaService();
```

и подставляет его.

Это называется **Dependency Injection (DI)**.

---

# 2. Module

Модуль — это контейнер.

```ts
@Module({
  providers: [PrismaService],
})
export class PrismaModule {}
```

Здесь мы говорим:

> Внутри этого модуля есть PrismaService.

---

# 3. Providers

```ts
@Module({
	providers: [
		PrismaService,
		UsersService,
		AuthService
	]
})
```

Nest создаёт экземпляры:

```ts
new PrismaService();
new UsersService();
new AuthService();
```

и хранит их в контейнере.

---

# 4. Inject

Допустим:

```ts
@Injectable()
export class UsersService {
  constructor(private prisma: PrismaService) {}
}
```

Nest делает примерно так:

```ts
const prisma = new PrismaService();

const users = new UsersService(prisma);
```

самостоятельно.

Ты практически никогда не пишешь:

```ts
new PrismaService();
```

вручную.

---

# 5. Exports

Допустим есть:

```ts
@Module({
  providers: [PrismaService],
})
export class PrismaModule {}
```

Теперь в другом модуле:

```ts
constructor(private prisma: PrismaService) {}
```

не заработает.

Почему?

Потому что PrismaService скрыт внутри PrismaModule.

Нужно экспортировать:

```ts
@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

Теперь другие модули смогут использовать PrismaService.

---

# 6. Imports

Подключаем модуль:

```ts
@Module({
  imports: [PrismaModule],
})
export class UsersModule {}
```

Теперь UsersModule получает всё, что экспортирует PrismaModule.

Схема:

```text
PrismaModule
 └── PrismaService
      ↑ export

UsersModule
 └── import PrismaModule
      ↓
    UsersService
```

---

# 7. Полная цепочка

```ts
@Global()
@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

```ts
@Module({
  imports: [PrismaModule],
  providers: [UsersService],
})
export class UsersModule {}
```

```ts
@Injectable()
export class UsersService {
  constructor(private prisma: PrismaService) {}
}
```

Nest делает примерно следующее:

```ts
const prisma = new PrismaService();

const users = new UsersService(prisma);
```

---

# 8. Singleton

По умолчанию все сервисы — **singleton**.

Есть один объект:

```ts
PrismaService;
```

на всё приложение.

```ts
UserService;
AuthService;
PostsService;
```

получают один и тот же экземпляр.

Схема:

```text
AuthService ----\
                 \
UserService ------> PrismaService
                 /
PostsService ---/
```

Это очень важно для Prisma.

---

# 9. Global

Без Global:

```ts
@Module({
  imports: [PrismaModule],
})
export class UsersModule {}
```

```ts
@Module({
  imports: [PrismaModule],
})
export class AuthModule {}
```

В каждый модуль надо импортировать PrismaModule.

---

С Global:

```ts
@Global()
@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

и один раз:

```ts
@Module({
  imports: [PrismaModule],
})
export class AppModule {}
```

После этого:

```ts
constructor(private prisma: PrismaService) {}
```

работает в любом модуле.

Импорт больше не нужен.

---

# 10. Почему PrismaModule обычно делают Global

Потому что:

```text
UsersService
AuthService
PostsService
ProductsService
OrdersService
```

всем нужен доступ к базе данных.

Не хочется писать:

```ts
imports: [PrismaModule];
```

в каждом модуле.

Поэтому обычно делают так:

```ts
@Global()
@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

---

# 11. Когда НЕ делать Global

Например:

```text
PaymentsModule
TelegramModule
MailModule
```

используются не везде.

Тогда:

```ts
@Module({
  providers: [TelegramService],
  exports: [TelegramService],
})
export class TelegramModule {}
```

и импортируешь только там, где нужно.

---

# Самая частая схема в NestJS

```text
AppModule
│
├── PrismaModule (Global)
│     └── PrismaService
│
├── AuthModule
│     ├── AuthController
│     └── AuthService
│
├── UsersModule
│     ├── UsersController
│     └── UsersService
│
└── PostsModule
      ├── PostsController
      └── PostsService
```

Все сервисы получают один и тот же `PrismaService` через DI-контейнер NestJS.

---

# Краткая шпаргалка

| Что                                     | Для чего                                      |
| --------------------------------------- | --------------------------------------------- |
| `@Module()`                             | Контейнер для сервисов и контроллеров         |
| `providers`                             | Сервисы, которые создаёт Nest                 |
| `exports`                               | Что можно использовать в других модулях       |
| `imports`                               | Подключение других модулей                    |
| `constructor(private service: Service)` | Внедрение зависимости (Inject)                |
| `@Injectable()`                         | Класс можно использовать как Provider         |
| `@Global()`                             | Модуль доступен во всём приложении            |
| Singleton                               | Один экземпляр сервиса на всё приложение      |
| DI Container                            | Механизм, который создаёт и связывает объекты |

---

# Главное правило

Если сервис нужен только внутри одного модуля:

```ts
@Module({
	providers: [UsersService]
})
```

Если сервис нужен другим модулям:

```ts
@Module({
	providers: [UsersService],
	exports: [UsersService]
})
```

Если нужен доступ к сервису по всему приложению:

```ts
@Global()
@Module({
	providers: [PrismaService],
	exports: [PrismaService]
})
```
