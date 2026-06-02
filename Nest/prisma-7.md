# Prisma 7 + NestJS + PostgreSQL

## Установка

```bash
npm install @prisma/client @prisma/adapter-pg
npm install -D prisma
```

## Генерация клиента

```bash
npx prisma generate
```

## Файлы конфигурации

### `prisma/schema.prisma`

`url` больше не поддерживается — только провайдер:

```prisma
generator client {
  provider = "prisma-client-js"
}

datasource db {
  provider = "postgresql"
}
```

### `prisma.config.ts`

URL для CLI-команд (migrate, generate, studio):

```ts
import "dotenv/config";
import { defineConfig } from "prisma/config";

export default defineConfig({
  schema: "prisma/schema.prisma",
  migrations: {
    path: "prisma/migrations",
  },
  datasource: {
    url: process.env["DATABASE_URL"],
  },
});
```

### `.env`

```
DATABASE_URL=postgresql://user:password@localhost:5432/dbname
```

## PrismaService

```ts
import { Injectable, OnModuleDestroy, OnModuleInit } from "@nestjs/common";
import { PrismaPg } from "@prisma/adapter-pg";
import { PrismaClient } from "@prisma/client";

@Injectable()
export class PrismaService extends PrismaClient implements OnModuleInit, OnModuleDestroy {
  constructor() {
    super({ adapter: new PrismaPg({ connectionString: process.env.DATABASE_URL }) });
  }

  async onModuleInit() {
    await this.$connect();
  }

  async onModuleDestroy() {
    await this.$disconnect();
  }
}
```

## PrismaModule

```ts
import { Module } from "@nestjs/common";
import { PrismaService } from "./prisma.service";

@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

## Подключение в CoreModule

```ts
import { Module } from "@nestjs/common";
import { PrismaModule } from "./prisma/prisma.module";

@Module({
  imports: [PrismaModule],
})
export class CoreModule {}
```

## Использование в других модулях

```ts
import { Module } from "@nestjs/common";
import { PrismaModule } from "src/core/prisma/prisma.module";

@Module({
  imports: [PrismaModule],
})
export class UsersModule {}
```

```ts
import { Injectable } from "@nestjs/common";
import { PrismaService } from "src/core/prisma/prisma.service";

@Injectable()
export class UsersService {
  constructor(private readonly prisma: PrismaService) {}

  findAll() {
    return this.prisma.user.findMany();
  }
}
```

## Ключевое отличие Prisma 7

|                     | Prisma ≤ 6                     | Prisma 7                            |
| ------------------- | ------------------------------ | ----------------------------------- |
| URL в schema.prisma | ✅ `url = env("DATABASE_URL")` | ❌ запрещено                        |
| URL для CLI         | schema.prisma                  | `prisma.config.ts`                  |
| URL для рантайма    | автоматически из env           | `@prisma/adapter-pg` в конструкторе |
