### install prisma

node version >= 22

```bash
bun add @prisma/client@7
bun add -D prisma@7
```

##### 1. Инициализировать Prisma

```bash
npx prisma init --datasource-provider mysql

bun add @prisma/adapter-mariadb
```

##### 2. Создать только сервис и модуль (НЕ ресурс!)

```bash
nest g module prisma
nest g service prisma --no-spec
```

##### 3. Настроить schema.prisma и prisma.service.ts

##### 4. Сгенерировать клиент

```bash
npx prisma generate
```

#### prisma.config.ts

```typescript
import "dotenv/config";
import { defineConfig, env } from "prisma/config";

export default defineConfig({
  schema: "prisma/schema.prisma",
  migrations: {
    path: "prisma/migrations",
    seed: "tsx prisma/seed.ts",
  },
  datasource: {
    url: process.env.DATABASE_URL!,
  },
});
```

#### schema.prisma

```prisma

generator client {
  provider = "prisma-client"
  output   = "../src/generated/prisma"
  moduleFormat = "cjs" //Matches Prisma's output format with NestJS's CommonJS runtime environment.
}

datasource db {
  provider = "mysql"
}
```

#### prisma service

```typescript
import { Injectable, OnModuleInit, OnModuleDestroy } from "@nestjs/common";
import { PrismaClient } from "../generated/prisma/client";
import { PrismaMariaDb } from "@prisma/adapter-mariadb";

@Injectable()
export class PrismaService extends PrismaClient implements OnModuleInit, OnModuleDestroy {
  constructor() {
    const adapter = new PrismaMariaDb({
      host: process.env.MYSQL_HOST || "localhost",
      user: process.env.MYSQL_USER || "root",
      password: process.env.MYSQL_PASSWORD || "root",
      database: process.env.MYSQL_DB || "teashop",
      port: parseInt(process.env.MYSQL_PORT || "3306"),
    });
    super({ adapter, log: ["info", "warn", "error"] });
  }

  async onModuleInit() {
    try {
      await this.$connect();
      await this.$queryRaw`SELECT 1`;
      console.log("✅ Prisma connected to MySQL");
    } catch (error) {
      console.error("❌ Prisma connection error:", error);
      throw error;
    }
  }

  async onModuleDestroy() {
    await this.$disconnect();
    console.log("🔌 Prisma disconnected from MySQL");
  }
}
```

#### prisma module

```typescript
import { Module, Global } from "@nestjs/common";
import { PrismaService } from "./prisma.service";

@Global()
@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

#### seed.ts

```typescript
import { PrismaClient } from "../src/generated/prisma/client";
import { PrismaMariaDb } from "@prisma/adapter-mariadb";
import "dotenv/config";

const adapter = new PrismaMariaDb(process.env.DATABASE_URL!);
const prisma = new PrismaClient({ adapter });

async function main() {
  console.log("🌱 Starting database seeding...");

  // Check if database already has data
  const userCount = await prisma.user.count();

  if (userCount > 0) {
    console.log("⚠️  Database already contains data. Skipping seed.");
    console.log(`   Found ${userCount} users in the database.`);
    return;
  }

  console.log("📭 Database is empty. Starting seed...");

  // Hash password for users
  const hashedPassword = "test12345";

  // Create users
  const user1 = await prisma.user.create({
    data: {
      email: "robot@gmail.com",
      name: "Mr Robot",
      password: hashedPassword,
    },
  });

  console.log("✅ Created users");
}

main()
  .catch((e) => {
    console.error("❌ Error during seeding:", e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
```

### 9. Import the PrismaModule into your main AppModule app.module.ts :

```typescript
import { Module } from "@nestjs/common";
import { AppController } from "./app.controller";
import { AppService } from "./app.service";
import { AuthModule } from "./modules/auth/auth.module";
import { ConfigModule } from "@nestjs/config";
import { PrismaModule } from "prisma/prisma.module";

@Module({
  imports: [AuthModule, PrismaModule, ConfigModule.forRoot()],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
```

#### commands

```bash
npx prisma generate
npx prisma db push
npx prisma db seed
npm run start:dev
```

### Add this into your .gitignore :

```bash
/src/generated
```

##### 5. Создать миграции

```bash
npx prisma migrate dev --name init
```

#### .env example

```

PORT="3344"
MYSQL_USER="test"
MYSQL_PASSWORD="test"
MYSQL_HOST="localhost"
MYSQL_PORT="3306"
MYSQL_DB="test"
DATABASE_URL="mysql://root:root@localhost:3306/teashop"

```

### dockercompose

```yaml
# Use root/example as user/password credentials
version: "3.1"

services:
  mysql:
    image: mysql:8.0
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: teashop
      CHARACTER_SET_SERVER: utf8mb4
      COLLATION_SERVER: utf8mb4_general_ci
    ports:
      - "3306:3306" # Добавь эту строку!
    volumes:
      - mysql_data:/var/lib/mysql

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    restart: always
    ports:
      - "8085:80"
    environment:
      MAX_EXECUTION_TIME: 600
      UPLOAD_LIMIT: 800M
      PMA_HOST: mysql
      PMA_PORT: 3306
      PMA_ARBITRARY: 1
      MYSQL_ROOT_PASSWORD: root # server mysql, user root, password root
    depends_on:
      - mysql

volumes:
  mysql_data:
```
