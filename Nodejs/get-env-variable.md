# getEnvVariable — типизированный доступ к env

## Установка

Типы для `.env` генерируются пакетом `gen-env-types`:

```bash
bun add -D gen-env-types
```

В `package.json`:

```json
{
  "scripts": {
    "env:types": "gen-env-types .env -o src/shared/types/env.d.ts"
  }
}
```

```bash
bun ad env:types
```

На выходе `env.d.ts`:

```typescript
declare namespace NodeJS {
  export interface ProcessEnv {
    DATABASE_URL: string;
    MAIL_HOST: string;
    MAIL_PASSWORD: string;
    // ...остальные ключи из .env
  }
}
```

Перегенерировать после любых изменений `.env` — пакет сохраняет ручные правки
(например, union-типы вроде `NODE_ENV: "development" | "production"`).

> Из-за встроенной в `@types/node` индекс-сигнатуры `[key: string]: string`
> `keyof NodeJS.ProcessEnv` схлопывается до `string`, поэтому строковый литерал
> для автокомплита в утилите ниже не подсказывается — это нормально, проверка
> идёт только на этапе доступа к `process.env.XXX` / `configService.get('XXX')`.

---

## 1. Простые проекты (Node/TS, без Nest)

```ts
// get-env-variable.util.ts
export default function getEnvVariable<T = string>(variable: keyof NodeJS.ProcessEnv): T {
  const value = process.env[variable];
  if (value === undefined) {
    throw new Error(`Missing env variable: ${variable}`);
  }
  return value as T;
}
```

```ts
const dbUrl = getEnvVariable("DATABASE_URL");
const port = getEnvVariable<number>("PORT");
```

---

## 2. NestJS

Установка:

```bash
bun add @nestjs/config
```

Подключение (один раз, глобально):

```ts
// core.module.ts
import { ConfigModule } from "@nestjs/config";

@Module({
  imports: [ConfigModule.forRoot({ isGlobal: true })],
})
export class CoreModule {}
```

Утилита через `ConfigService`:

```ts
// get-env-variables.utils.ts
import { ConfigService } from "@nestjs/config";

export default function getEnvVariables<T = string>(
  configService: ConfigService,
  variable: keyof NodeJS.ProcessEnv,
): T {
  return configService.getOrThrow<T>(variable);
}
```

Использование (например, в фабрике конфига для `forRootAsync`):

```ts
export function getMailerConfig(configService: ConfigService): MailerOptions {
  return {
    transport: {
      host: getEnvVariables(configService, "MAIL_HOST"),
      port: getEnvVariables<number>(configService, "MAIL_PORT"),
    },
  };
}
```
