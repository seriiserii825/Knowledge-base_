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
bun run env:types
```

На выходе `env.d.ts`:

```typescript
declare global {
  namespace NodeJS {
    interface ProcessEnv {
      DATABASE_URL: string;
      MAIL_HOST: string;
      MAIL_PASSWORD: string;
      // ...остальные ключи из .env
    }
  }
}

export {};
```

Перегенерировать после любых изменений `.env` (`bun run env:types`) — файл полностью
перезаписывается, **не редактировать вручную**.

## Автокомплит ключей (RemoveIndexSignature)

`@types/node` объявляет `NodeJS.ProcessEnv` с индекс-сигнатурой
`[key: string]: string | undefined`. Из-за неё `keyof NodeJS.ProcessEnv`
схлопывается до `string`, и автокомплит конкретных имён переменных пропадает.

Фикс — мапированный тип, убирающий ключи-сигнатуры (`string`/`number`/`symbol`)
и оставляющий только литералы (`MAIL_HOST`, `MAIL_PASSWORD`, ...):

```ts
type RemoveIndexSignature<T> = {
  [K in keyof T as string extends K
    ? never
    : number extends K
      ? never
      : symbol extends K
        ? never
        : K]: T[K];
};

type TEnvVariables = keyof RemoveIndexSignature<NodeJS.ProcessEnv>;
```

`TEnvVariables` теперь — объединение литералов всех ключей из `env.d.ts`,
обновляется само после каждого `bun run env:types`, без отдельного
вручную поддерживаемого списка.

---

## 1. Простые проекты (Node/TS, без Nest)

```ts
// get-env-variable.util.ts
type RemoveIndexSignature<T> = {
  [K in keyof T as string extends K
    ? never
    : number extends K
      ? never
      : symbol extends K
        ? never
        : K]: T[K];
};

type TEnvVariables = keyof RemoveIndexSignature<NodeJS.ProcessEnv>;

export default function getEnvVariable<T = string>(variable: TEnvVariables): T {
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

type RemoveIndexSignature<T> = {
  [K in keyof T as string extends K
    ? never
    : number extends K
      ? never
      : symbol extends K
        ? never
        : K]: T[K];
};

type TEnvVariables = keyof RemoveIndexSignature<NodeJS.ProcessEnv>;

export default function getEnvVariables<T = string>(
  configService: ConfigService,
  variable: TEnvVariables,
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
