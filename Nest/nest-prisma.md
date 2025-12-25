### install

```bash
bun add prisma @prisma/client @prisma/adapter-pg pg
```

### generate prisma module

```bash
nest g res prisma --no-spec
```

### initialize prisma

```bash
npx prisma init
```

### set database url in .env

```env

POSTGRES_USER="postgres"
POSTGRES_PASSWORD="secret_pass"
POSTGRES_HOST="localhost"
POSTGRES_PORT="5432"
POSTGRES_DB="nest_free_code"

DATABASE_URL="postgresql://postgres:secret_pass@localhost:5432/nestjs_course?schema=public"

```

### mysql

```env
.env
MYSQL_USER="root"
MYSQL_PASSWORD="root"
MYSQL_HOST="localhost"
MYSQL_PORT="3306"
MYSQL_DB="teashop"
DATABASE_URL="mysql://${MYSQL_USER}:${MYSQL_PASSWORD}@${MYSQL_HOST}:${MYSQL_PORT}/${MYSQL_DB}"

schema

generator client {
  provider = "prisma-client"
}

datasource db {
  provider = "mysql"
  url      = env("DATABASE_URL")
}
```

### prisma schema

```prisma

generator client {
  provider = "prisma-client-js"
}

datasource db {
  provider = "postgresql"
}
```

### prisma studio

```bash
npx prisma studio
```

### push

```bash
npx prisma db push
```

### prisma.service.ts

```typescript
import { Injectable, OnModuleInit } from "@nestjs/common";
import { PrismaClient } from "@prisma/client";
import { PrismaPg } from "@prisma/adapter-pg";
import { Pool } from "pg";

@Injectable()
export class PrismaService extends PrismaClient implements OnModuleInit {
  constructor() {
    const pool = new Pool({ connectionString: process.env.DATABASE_URL });
    const adapter = new PrismaPg(pool);

    super({ adapter });
  }

  async onModuleInit() {
    await this.$connect();
  }
}
```

### prisma module global

```typescript
// prisma.module.ts
import { Global, Module } from "@nestjs/common";
import { PrismaService } from "./prisma.service";

@Global()
@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

### app.module.ts

```typescript
@Module({
  imports: [
    PrismaModule,
    TaskModule,
    MoviesModule,
    ReviewsModule,
    ActorsModule,
    PosterModule,
    PrismaModule,
  ],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
```

### movie schema

```prisma

model Movie {
  id           Int      @id @default(autoincrement())
  title        String
  description  String?
  release_year Int
  rating       Float    @default(0.0)
  is_avalaible Boolean  @default(false)
  genre        Genre @default(DRAMA)
  createdAt    DateTime @default(now())
  updatedAt    DateTime @updatedAt

  @@map("movies")
}

enum Genre {
  ACTION
  COMEDY
  DRAMA
  HORROR
  ROMANCE
  SCIFI
  FANTASY

  @@map("genres")
}
```
