### env

.env

DB_USERNAME=postgres
DB_PASSWORD=
DB_NAME=
DB_PORT=5433

JWT_SECRET=""

#Google OAuth

GOOGLE_CLIENT_ID=""
GOOGLE_CLIENT_SECRET=""

### env dev

.env.development

PORT=3300
SERVER_URL="http://localhost:${PORT}"
SERVER_DOMAIN="localhost"
GOOGLE_CALLBACK_URL="${SERVER_URL}/auth/google/callback"
CLIENT_URL="http://localhost:3000"

### env prod

.env.production

PORT=3300
SERVER_URL="https://nest-teashop.seriiburduja.org"
SERVER_DOMAIN="nest-teashop.seriiburduja.org"
GOOGLE_CALLBACK_URL="${SERVER_URL}/auth/google/callback"
CLIENT_URL="http://localhost:3000"

### helpers

src/config/env.helper.ts

```typescript
import { config } from "dotenv";
import { expand } from "dotenv-expand";

// Типы всех переменных
type TEnvVar =
  | "PORT"
  | "SERVER_URL"
  | "SERVER_DOMAIN"
  | "CLIENT_URL"
  | "JWT_SECRET"
  | "GOOGLE_CLIENT_ID"
  | "GOOGLE_CLIENT_SECRET"
  | "GOOGLE_CALLBACK_URL"
  | "DB_USERNAME"
  | "DB_PASSWORD"
  | "DB_NAME"
  | "DB_PORT";

// Загрузка env файлов (вызвать один раз в main.ts)
export function loadEnv(): void {
  const nodeEnv = process.env.NODE_ENV || "development";

  // Сначала .env (общие переменные)
  expand(config({ path: ".env" }));

  // Потом специфичные (перезаписывают)
  expand(config({ path: `.env.${nodeEnv}`, override: true }));
}

// Получение переменной
export function getEnv(name: TEnvVar, defaultValue?: string): string {
  const value = process.env[name];
  if (!value) {
    if (defaultValue !== undefined) {
      return defaultValue;
    }
    throw new Error(`Environment variable ${name} is not defined`);
  }
  return value;
}
```

### main.ts usage

```typescript
import { loadEnv, getEnv } from "./config/env.helper";

// Загружаем env ПЕРВЫМ делом
loadEnv();

async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  app.enableCors({
    origin: [getEnv("CLIENT_URL")],
    credentials: true,
    exposedHeaders: ["set-cookie"],
  });

  console.log(`Server running on port ${getEnv("PORT")}`);
  await app.listen(+getEnv("PORT"));
}
bootstrap().catch((err) => {
  console.error("Error during application bootstrap:", err);
});
```

### google strategy usage

```typescript
import { Injectable } from '@nestjs/common';
import { PassportStrategy } from '@nestjs/passport';
import { Profile, Strategy, VerifyCallback } from 'passport-google-oauth20';
import { getEnv } from 'src/config/env.helper';

@Injectable()
export class GoogleStrategy extends PassportStrategy(Strategy, 'google') {
  constructor() {
    const clientID = getEnv('GOOGLE_CLIENT_ID');
    const clientSecret = getEnv('GOOGLE_CLIENT_SECRET');
    const callbackURL = getEnv('GOOGLE_CALLBACK_URL');

    if (!clientID || !clientSecret || !callbackURL) {
      throw new Error(
        'Google OAuth environment variables are not defined in .env',
      );
    }
}
```

package.json

```json
    "update": "git pull && bun install && bun run build:prod && pm2 restart nest-teashop",
    "build": "NODE_ENV=development && nest build",
    "build:prod": "NODE_ENV=production && nest build",
```
