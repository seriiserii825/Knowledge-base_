### install

```bash
bun add prisma @prisma/client @prisma/adapter-pg
```

### prisma studio

```bash
npx prisma studio
```

### push

```bash
npx prisma db push
```

### generate prisma module

```bash
nest g res prisma --no-spec
```

### prisma.module.ts

```typescript
//remove controller
import { Module } from "@nestjs/common";
import { PrismaService } from "./prisma.service";

@Module({
  providers: [PrismaService],
  exports: [PrismaService],
})
export class PrismaModule {}
```

### prisma.service.ts

```typescript
import { Injectable, OnModuleInit } from '@nestjs/common';
import { PrismaClient } from '@prisma/client';
import { PrismaPg } from '@prisma/adapter-pg';
import { Pool } from 'pg';

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
