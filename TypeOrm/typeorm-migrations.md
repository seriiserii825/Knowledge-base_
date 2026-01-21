### TypeORM Миграции - Полное руководство

### 1. Настройка конфигурации

Создайте файл data-source.ts в корне проекта (для CLI):

```ts
import { DataSource } from "typeorm";
import { config } from "dotenv";

config();

export const AppDataSource = new DataSource({
  type: "postgres",
  host: process.env.DB_HOST,
  port: parseInt(process.env.DB_PORT),
  username: process.env.DB_USERNAME,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
  entities: ["src/**/*.entity{.ts,.js}"],
  migrations: ["src/migrations/*{.ts,.js}"],
  synchronize: false,
});
```

### 2. Добавьте скрипты в package.json

```json
{
  "scripts": {
    "migration:generate": "typeorm-ts-node-commonjs migration:generate -d src/data-source.ts",
    "migration:create": "typeorm-ts-node-commonjs migration:create",
    "migration:run": "typeorm-ts-node-commonjs migration:run -d src/data-source.ts",
    "migration:revert": "typeorm-ts-node-commonjs migration:revert -d src/data-source.ts",
    "migration:show": "typeorm-ts-node-commonjs migration:show -d src/data-source.ts"
  }
}
```

### 3. Создание миграций

Автоматическая генерация (рекомендуется)
TypeORM сравнивает entities с БД и создает миграцию:

```bash
npm run migration:generate src/migrations/CreateUserTable
```

Ручное создание

```bash
npm run migration:create src/migrations/AddEmailToUser
```

### 4. Пример миграции

Автоматически сгенерированная:

```ts
import { MigrationInterface, QueryRunner } from "typeorm";

export class CreateUserTable1234567890123 implements MigrationInterface {
  name = "CreateUserTable1234567890123";

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(`
CREATE TABLE "user" (
"id" SERIAL NOT NULL,
"email" character varying NOT NULL,
"password" character varying NOT NULL,
"createdAt" TIMESTAMP NOT NULL DEFAULT now(),
CONSTRAINT "PK_user" PRIMARY KEY ("id")
)
`);
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(`DROP TABLE "user"`);
  }
}
```

### Ручная миграция:

```ts
import { MigrationInterface, QueryRunner, TableColumn } from "typeorm";

export class AddEmailToUser1234567890123 implements MigrationInterface {
  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.addColumn(
      "user",
      new TableColumn({
        name: "email",
        type: "varchar",
        isNullable: false,
      }),
    );
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.dropColumn("user", "email");
  }
}
```

### 5. Запуск миграций

#### Применить все новые миграции

```bash
npm run migration:run
```

#### Откатить последнюю миграцию

```bash
npm run migration:revert
```

#### Показать статус миграций

```bash
npm run migration:show
```
