# NestJS + Drizzle ORM + Angular (типизация через OpenAPI)

```
Drizzle-схема → Zod (drizzle-zod) → DTO (nestjs-zod) → openapi.json → orval → Angular-сервисы
```

## 1. Установка

```bash
npm i drizzle-orm pg @nestjs/config
npm i -D drizzle-kit @types/pg
```

`.env`:
```
DATABASE_URL=postgres://postgres:postgres@localhost:5432/app
```

## 2. Схема — `src/db/schema.ts`

```ts
import { relations } from 'drizzle-orm';
import { integer, pgTable, serial, text, timestamp, varchar } from 'drizzle-orm/pg-core';

export const users = pgTable('users', {
  id: serial('id').primaryKey(),
  email: varchar('email', { length: 255 }).notNull().unique(),
  name: text('name'),
  passwordHash: text('password_hash').notNull(),
  createdAt: timestamp('created_at').defaultNow().notNull(),
});

export const posts = pgTable('posts', {
  id: serial('id').primaryKey(),
  title: text('title').notNull(),
  authorId: integer('author_id')
    .notNull()
    .references(() => users.id, { onDelete: 'cascade' }),
});

// нужны только для db.query.* (with: {...})
export const usersRelations = relations(users, ({ many }) => ({ posts: many(posts) }));
export const postsRelations = relations(posts, ({ one }) => ({
  author: one(users, { fields: [posts.authorId], references: [users.id] }),
}));

export type User = typeof users.$inferSelect;
export type NewUser = typeof users.$inferInsert;
```

## 3. Миграции

`drizzle.config.ts`:
```ts
import 'dotenv/config';
import { defineConfig } from 'drizzle-kit';

export default defineConfig({
  dialect: 'postgresql',
  schema: './src/db/schema.ts',
  out: './drizzle',
  dbCredentials: { url: process.env.DATABASE_URL! },
});
```

```json
"db:generate": "drizzle-kit generate",
"db:migrate": "drizzle-kit migrate",
"db:push": "drizzle-kit push",
"db:studio": "drizzle-kit studio"
```

- `generate` — SQL-миграция в `drizzle/` (коммитить)
- `migrate` — применить миграции
- `push` — схема в базу без миграций (только локально)
- `studio` — GUI

## 4. Модуль — `src/db/drizzle.module.ts`

```ts
import { Global, Inject, Module, OnApplicationShutdown } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';
import { drizzle, NodePgDatabase } from 'drizzle-orm/node-postgres';
import { Pool } from 'pg';
import * as schema from './schema';

export const PG_POOL = Symbol('PG_POOL');
export const DRIZZLE = Symbol('DRIZZLE');
export type Db = NodePgDatabase<typeof schema>;

@Global()
@Module({
  providers: [
    {
      provide: PG_POOL,
      inject: [ConfigService],
      useFactory: (config: ConfigService) =>
        new Pool({ connectionString: config.getOrThrow<string>('DATABASE_URL') }),
    },
    {
      provide: DRIZZLE,
      inject: [PG_POOL],
      useFactory: (pool: Pool): Db => drizzle({ client: pool, schema }), // без schema нет db.query.*
    },
  ],
  exports: [DRIZZLE],
})
export class DrizzleModule implements OnApplicationShutdown {
  constructor(@Inject(PG_POOL) private readonly pool: Pool) {}

  async onApplicationShutdown() {
    await this.pool.end(); // нужен app.enableShutdownHooks()
  }
}
```

`app.module.ts`: `imports: [ConfigModule.forRoot({ isGlobal: true }), DrizzleModule, UsersModule]`

## 5. Сервис

```ts
import { ConflictException, Inject, Injectable, NotFoundException } from '@nestjs/common';
import { desc, eq, ilike } from 'drizzle-orm';
import { DRIZZLE, type Db } from '../db/drizzle.module';
import { posts, users, type NewUser } from '../db/schema';
import { isUniqueViolation } from '../db/db-errors';

@Injectable()
export class UsersService {
  constructor(@Inject(DRIZZLE) private readonly db: Db) {}

  findAll() {
    return this.db.query.users.findMany({
      columns: { passwordHash: false },
      with: { posts: true },
      orderBy: [desc(users.createdAt)],
    });
  }

  async findOne(id: number) {
    const user = await this.db.query.users.findFirst({
      where: eq(users.id, id),
      columns: { passwordHash: false },
    });
    if (!user) throw new NotFoundException('User not found');
    return user;
  }

  search(q: string) {
    return this.db
      .select({ id: users.id, email: users.email, postTitle: posts.title })
      .from(users)
      .leftJoin(posts, eq(posts.authorId, users.id))
      .where(ilike(users.email, `%${q}%`))
      .limit(20);
  }

  async create(data: { email: string; name?: string | null; passwordHash: string }) {
    try {
      const [user] = await this.db.insert(users).values(data).returning();
      return user;
    } catch (e) {
      if (isUniqueViolation(e)) throw new ConflictException('Email already taken');
      throw e;
    }
  }

  async update(id: number, data: Partial<NewUser>) {
    const [user] = await this.db.update(users).set(data).where(eq(users.id, id)).returning();
    if (!user) throw new NotFoundException('User not found');
    return user;
  }

  async remove(id: number) {
    const [user] = await this.db.delete(users).where(eq(users.id, id)).returning();
    if (!user) throw new NotFoundException('User not found');
    return user;
  }

  createWithPost(email: string, passwordHash: string, title: string) {
    return this.db.transaction(async (tx) => {
      const [user] = await tx.insert(users).values({ email, passwordHash }).returning();
      await tx.insert(posts).values({ title, authorId: user.id });
      return user;
    });
  }
}
```

Ошибки — коды Postgres, `src/db/db-errors.ts`:
```ts
const pgCode = (e: unknown) => {
  const err = e as { code?: string; cause?: { code?: string } };
  return err?.code ?? err?.cause?.code; // новые версии оборачивают ошибку pg в cause
};

export const isUniqueViolation = (e: unknown) => pgCode(e) === '23505';
export const isForeignKeyViolation = (e: unknown) => pgCode(e) === '23503';
```

> Drizzle v1 (beta): Relational Queries v2 — `defineRelations`, `where` объектом (`where: { id: 1 }`). Примеры выше — для 0.x.

## 6. DTO и валидация (drizzle-zod + nestjs-zod)

Swagger видит только классы, `$inferSelect` — TS-тип, в рантайме его нет. Поэтому DTO из Zod, Zod — из таблиц.

```bash
npm i nestjs-zod zod drizzle-zod @nestjs/swagger
```

> Версии zod / nestjs-zod / drizzle-zod должны совпадать по zod 3 vs 4. В Drizzle v1 drizzle-zod → `drizzle-orm/zod`.

`src/users/users.dto.ts`:
```ts
import { createInsertSchema, createSelectSchema } from 'drizzle-zod';
import { createZodDto } from 'nestjs-zod';
import { z } from 'zod';
import { users } from '../db/schema';

export class UserDto extends createZodDto(createSelectSchema(users).omit({ passwordHash: true })) {}

const createUserSchema = createInsertSchema(users, { email: (s) => s.email() })
  .pick({ email: true, name: true })
  .extend({ password: z.string().min(8) });

export class CreateUserDto extends createZodDto(createUserSchema) {}
export class UpdateUserDto extends createZodDto(createUserSchema.partial()) {}
```

`app.module.ts`:
```ts
providers: [
  { provide: APP_PIPE, useClass: ZodValidationPipe },            // валидация входа
  { provide: APP_INTERCEPTOR, useClass: ZodSerializerInterceptor }, // обрезка ответа
],
```

Контроллер:
```ts
@ApiTags('users')
@Controller('users')
export class UsersController {
  constructor(private readonly users: UsersService) {}

  @Get()
  @ZodSerializerDto([UserDto])
  @ApiOkResponse({ type: [UserDto] })
  findAll() {
    return this.users.findAll();
  }

  @Post()
  @ZodSerializerDto(UserDto)
  @ApiCreatedResponse({ type: UserDto })
  async create(@Body() dto: CreateUserDto) {
    const passwordHash = await argon2.hash(dto.password);
    return this.users.create({ email: dto.email, name: dto.name, passwordHash });
  }
}
```

`@ApiOkResponse({ type })` обязателен — иначе на фронте ответ `unknown`.

## 7. Swagger → `openapi.json` (`main.ts`)

```ts
const app = await NestFactory.create(AppModule);
app.enableShutdownHooks();
app.enableCors({ origin: 'http://localhost:4200', credentials: true });

const config = new DocumentBuilder().setTitle('API').setVersion('1.0').addBearerAuth().build();
const document = cleanupOpenApiDoc(
  SwaggerModule.createDocument(app, config, {
    // users_findAll → usersFindAll на фронте; operationId должен быть уникальным
    operationIdFactory: (controller, method) =>
      `${controller.replace(/Controller$/, '').toLowerCase()}_${method}`,
  }),
);
SwaggerModule.setup('docs', app, document);

if (process.env.NODE_ENV !== 'production') {
  writeFileSync('openapi.json', JSON.stringify(document, null, 2));
}
await app.listen(3000);
```

## 8. Angular (orval)

```bash
npm i -D orval
```

`orval.config.ts`:
```ts
import { defineConfig } from 'orval';

export default defineConfig({
  api: {
    input: '../backend/openapi.json',
    output: { target: 'src/app/api/generated.ts', client: 'angular', mode: 'tags-split', clean: true },
  },
});
```

`"api:gen": "orval"`

Интерсептор (базовый URL + cookie):
```ts
export const apiInterceptor: HttpInterceptorFn = (req, next) =>
  next(req.url.startsWith('/') ? req.clone({ url: environment.apiUrl + req.url, withCredentials: true }) : req);

// app.config.ts
provideHttpClient(withInterceptors([apiInterceptor]));
```

Компонент:
```ts
private users = inject(UsersService);
users$ = this.users.usersFindAll(); // Observable<UserDto[]>
create(body: CreateUserDto) { return this.users.usersCreate(body); }
```

## Workflow

1. Схема → `db:generate` → `db:migrate`
2. Бэк в dev → обновился `openapi.json`
3. Фронт → `api:gen`, TS покажет что сломалось

## Грабли

- `db.query.*` undefined → не передан `schema` в `drizzle()` или не экспортированы `relations`.
- Нет `@ApiOkResponse({ type })` или возвращается `$inferSelect` без DTO → на фронте `unknown`.
- `timestamp` → в JSON строка, на фронте тип `string`.
- `Paginated<T>` Swagger не понимает — отдельный DTO на каждую сущность.
