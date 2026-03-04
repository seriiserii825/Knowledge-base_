# Better Auth + Next.js 16 + Prisma — Полная инструкция

## 1. Установка

```bash
npm install better-auth @prisma/client
npm install prisma --save-dev
```

---

## 2. Структура файлов

```
app/
├── api/
│   ├── auth/[...all]/
│   │   └── route.ts          # Better Auth handler
│   └── posts/
│       ├── route.ts          # GET (public), POST (protected)
│       └── [id]/
│           └── route.ts      # GET (public), PUT/DELETE (protected)
lib/
├── auth.ts                   # Better Auth конфиг
├── auth-client.ts            # Клиентский инстанс
├── auth-session.ts           # Хелпер requireSession
└── prisma.ts                 # Prisma клиент
prisma/
└── schema.prisma
proxy.ts                      # Защита роутов (Next.js 16)
```

---

## 3. Prisma Schema

```prisma
// prisma/schema.prisma
generator client {
  provider = "prisma-client-js"
}

datasource db {
  provider = "postgresql"
  url      = env("DATABASE_URL")
}

model User {
  id            String   @id @default(cuid())
  name          String?
  email         String   @unique
  emailVerified Boolean  @default(false)
  image         String?
  createdAt     DateTime @default(now())
  updatedAt     DateTime @updatedAt
  posts         Post[]
  sessions      Session[]
  accounts      Account[]
}

model Session {
  id        String   @id @default(cuid())
  userId    String
  token     String   @unique
  expiresAt DateTime
  ipAddress String?
  userAgent String?
  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt
  user      User     @relation(fields: [userId], references: [id], onDelete: Cascade)
}

model Account {
  id           String    @id @default(cuid())
  userId       String
  accountId    String
  providerId   String
  accessToken  String?
  refreshToken String?
  expiresAt    DateTime?
  createdAt    DateTime  @default(now())
  updatedAt    DateTime  @updatedAt
  user         User      @relation(fields: [userId], references: [id], onDelete: Cascade)
}

model Verification {
  id         String   @id @default(cuid())
  identifier String
  value      String
  expiresAt  DateTime
  createdAt  DateTime @default(now())
  updatedAt  DateTime @updatedAt
}

model Post {
  id        String   @id @default(cuid())
  title     String
  content   String?
  userId    String
  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt
  user      User     @relation(fields: [userId], references: [id], onDelete: Cascade)
}
```

```bash
npx prisma migrate dev --name init
```

---

## 4. Prisma клиент

```ts
// lib/prisma.ts
import { PrismaClient } from "@prisma/client";

const globalForPrisma = globalThis as unknown as {
  prisma: PrismaClient | undefined;
};

export const prisma = globalForPrisma.prisma ?? new PrismaClient();

if (process.env.NODE_ENV !== "production") {
  globalForPrisma.prisma = prisma;
}
```

---

## 5. Better Auth конфиг

```ts
// lib/auth.ts
import { betterAuth } from "better-auth";
import { prismaAdapter } from "better-auth/adapters/prisma";
import { nextCookies } from "better-auth/next-js";
import { prisma } from "@/lib/prisma";

export const auth = betterAuth({
  database: prismaAdapter(prisma, {
    provider: "postgresql",
  }),
  emailAndPassword: {
    enabled: true,
  },
  plugins: [nextCookies()], // всегда последним
});
```

---

## 6. Auth клиент

```ts
// lib/auth-client.ts
import { createAuthClient } from "better-auth/react";

export const authClient = createAuthClient();
```

---

## 7. Хелпер requireSession

```ts
// lib/auth-session.ts
import { auth } from "@/lib/auth";
import { headers } from "next/headers";
import { NextResponse } from "next/server";

export async function requireSession() {
  const session = await auth.api.getSession({
    headers: await headers(),
  });

  if (!session) {
    return {
      session: null,
      error: NextResponse.json({ error: "Unauthorized" }, { status: 401 }),
    };
  }

  return { session, error: null };
}
```

---

## 8. Better Auth API Route

```ts
// app/api/auth/[...all]/route.ts
import { auth } from "@/lib/auth";
import { toNextJsHandler } from "better-auth/next-js";

export const { GET, POST } = toNextJsHandler(auth);
```

---

## 9. CRUD роуты

### `/api/posts` — список и создание

```ts
// app/api/posts/route.ts
import { prisma } from "@/lib/prisma";
import { requireSession } from "@/lib/auth-session";
import { NextRequest, NextResponse } from "next/server";

// GET — публичный
export async function GET() {
  const posts = await prisma.post.findMany({
    include: { user: { select: { name: true } } },
    orderBy: { createdAt: "desc" },
  });
  return NextResponse.json(posts);
}

// POST — только авторизованные
export async function POST(request: NextRequest) {
  const { session, error } = await requireSession();
  if (error) return error;

  const body = await request.json();

  const post = await prisma.post.create({
    data: {
      title: body.title,
      content: body.content,
      userId: session.user.id,
    },
  });

  return NextResponse.json(post, { status: 201 });
}
```

### `/api/posts/[id]` — один пост, обновление, удаление

```ts
// app/api/posts/[id]/route.ts
import { prisma } from "@/lib/prisma";
import { requireSession } from "@/lib/auth-session";
import { NextRequest, NextResponse } from "next/server";

// GET — публичный
export async function GET(_req: NextRequest, { params }: { params: { id: string } }) {
  const post = await prisma.post.findUnique({
    where: { id: params.id },
    include: { user: { select: { name: true } } },
  });

  if (!post) {
    return NextResponse.json({ error: "Not found" }, { status: 404 });
  }

  return NextResponse.json(post);
}

// PUT — только свои записи
export async function PUT(request: NextRequest, { params }: { params: { id: string } }) {
  const { session, error } = await requireSession();
  if (error) return error;

  const existing = await prisma.post.findUnique({
    where: { id: params.id },
  });

  if (!existing) {
    return NextResponse.json({ error: "Not found" }, { status: 404 });
  }

  if (existing.userId !== session.user.id) {
    return NextResponse.json({ error: "Forbidden" }, { status: 403 });
  }

  const body = await request.json();
  const post = await prisma.post.update({
    where: { id: params.id },
    data: { title: body.title, content: body.content },
  });

  return NextResponse.json(post);
}

// DELETE — только свои записи
export async function DELETE(_req: NextRequest, { params }: { params: { id: string } }) {
  const { session, error } = await requireSession();
  if (error) return error;

  const existing = await prisma.post.findUnique({
    where: { id: params.id },
  });

  if (!existing) {
    return NextResponse.json({ error: "Not found" }, { status: 404 });
  }

  if (existing.userId !== session.user.id) {
    return NextResponse.json({ error: "Forbidden" }, { status: 403 });
  }

  await prisma.post.delete({ where: { id: params.id } });

  return NextResponse.json({ success: true });
}
```

---

## 10. Proxy (Next.js 16)

```ts
// proxy.ts
import { NextRequest, NextResponse } from "next/server";
import { getSessionCookie } from "better-auth/cookies";

// Точное совпадение для главной страницы + startsWith для остальных
const publicRoutes = ["/sign-in", "/sign-up"];
const publicApiRoutes = ["/api/auth"]; // Better Auth эндпоинты

export async function proxy(request: NextRequest) {
  const { pathname } = request.nextUrl;

  // Главная страница — точное совпадение
  if (pathname === "/") return NextResponse.next();

  // Публичные страницы
  if (publicRoutes.some((r) => pathname.startsWith(r))) {
    return NextResponse.next();
  }

  // Публичные API эндпоинты (Better Auth)
  if (publicApiRoutes.some((r) => pathname.startsWith(r))) {
    return NextResponse.next();
  }

  // GET запросы к API — публичные
  if (request.method === "GET" && pathname.startsWith("/api/")) {
    return NextResponse.next();
  }

  // Всё остальное — проверяем куки
  const sessionCookie = getSessionCookie(request);
  if (!sessionCookie) {
    // Для API — 401, для страниц — редирект
    if (pathname.startsWith("/api/")) {
      return NextResponse.json({ error: "Unauthorized" }, { status: 401 });
    }
    return NextResponse.redirect(new URL("/sign-in", request.url));
  }

  return NextResponse.next();
}

export const config = {
  matcher: ["/((?!_next/static|_next/image|favicon.ico).*)"],
};
```

> **Важно:** `getSessionCookie` проверяет только наличие куки, но не валидирует её.
> Реальная проверка сессии происходит внутри каждого роута через `requireSession()`.

---

## Итоговая схема защиты

```
Запрос
  │
  ▼
proxy.ts
  ├── pathname === "/"         ──► пропускаем
  ├── /sign-in, /sign-up      ──► пропускаем
  ├── /api/auth/*             ──► пропускаем (Better Auth)
  ├── GET /api/*              ──► пропускаем (публичные данные)
  └── есть кука?
        ├── нет ──► /api/* → 401 | страница → редирект /sign-in
        └── да  ──► пропускаем
                      │
                      ▼
                 API Route
                      │
                      └── requireSession()
                            ├── нет сессии  ──► 401 Unauthorized
                            └── есть сессия
                                  └── userId совпадает?
                                        ├── нет ──► 403 Forbidden
                                        └── да  ──► prisma.*()
```

---

## Коды ответов

| Код   | Когда                        |
| ----- | ---------------------------- |
| `200` | Успешный GET                 |
| `201` | Успешный POST (создание)     |
| `401` | Нет сессии / не авторизован  |
| `403` | Сессия есть, но запись чужая |
| `404` | Запись не найдена            |
