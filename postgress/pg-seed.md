### seeder

### install extension

```bash
npm install typeorm-extension --save-dev
```

src/db/seeders/user.seed.ts

```ts
import { Seeder } from "typeorm-extension";
import { DataSource } from "typeorm";
import { UserEntity } from "src/shared/models/user.entity";

export default class UserSeeder implements Seeder {
  public async run(dataSource: DataSource): Promise<any> {
    const repo = dataSource.getRepository(UserEntity);

    console.log("UserSeeder RUNNING...");
    await repo.insert([
      {
        name: "Admin User",
        email: "admin@example.com",
        role: "admin",
      },
    ]);
  }
}
```

db/data-source.ts

```ts
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
  database: process.env.DB_NAME || "nestjs_blog",
  entities: ["dist/**/*.entity.js"],
  migrations: ["dist/db/migrations/*.js"],
  seeds: ["dist/src/db/seeders/*.js"],
  synchronize: false,
  logging: true,
};

const dataSource = new DataSource(dataSourceOptions);
export default dataSource;
```

package.json

```json
{
  "scripts": {
    "typeorm": "bun run build && npx typeorm -d dist/db/data-source.js",
    "migration:generate": "npm run typeorm -- migration:generate",
    "migration:run": "npm run typeorm -- migration:run",
    "migration:revert": "npm run typeorm -- migration:revert",
    "seed:run": "bun run build && npx typeorm-extension seed:run"
  }
}
```
