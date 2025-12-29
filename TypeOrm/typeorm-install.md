## install with bun

```bash
bun add typeorm @nestjs/typeorm typeorm-extension pg
```

src/config/data-source.ts

```typescript
import { DataSource, DataSourceOptions } from "typeorm";
import { config } from "dotenv";
import { SeederOptions } from "typeorm-extension";

config();

export const dataSourceOptions: DataSourceOptions & SeederOptions = {
  type: "postgres",
  host: process.env.DB_HOST || "localhost",
  port: process.env.DB_PORT ? parseInt(process.env.DB_PORT) : 5432,
  username: process.env.DB_USERNAME || "postgres",
  password: process.env.DB_PASSWORD || "serii1981",
  database: process.env.DB_NAME || "taskmanagment",
  entities: ["dist/**/*.entity.js"],
  // migrations: ['dist/db/migrations/*.js'],
  // seeds: ['dist/src/db/seeders/*.js'],
  synchronize: false,
  logging: true,
};

const dataSource = new DataSource(dataSourceOptions);
export default dataSource;
```

src/app.module.ts

```typescript
import { Module } from "@nestjs/common";
import { AppController } from "./app.controller";
import { AppService } from "./app.service";
import { TasksModule } from "./tasks/tasks.module";
import { TypeOrmModule } from "@nestjs/typeorm";
import { dataSourceOptions } from "./config/data-source";

@Module({
  imports: [TasksModule, TypeOrmModule.forRoot(dataSourceOptions)],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
```
