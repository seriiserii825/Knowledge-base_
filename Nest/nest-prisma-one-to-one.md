### One-to-One (Один к одному)

Один пользователь — один профиль.

```prisma
model User {
    id      Int      @id @default(autoincrement())
        email   String   @unique
        profile Profile?
}

model Profile {
    id     Int    @id @default(autoincrement())
        bio    String
        user   User   @relation(fields: [userId], references: [id])
        userId Int    @unique // @unique делает связь 1:1
}
```

NestJS использование:

```typescript
typescript; // Создание с профилем
await prisma.user.create({
  data: {
    email: "test@mail.com",
    profile: {
      create: { bio: "Hello!" },
    },
  },
});

// Получение с профилем
await prisma.user.findUnique({
  where: { id: 1 },
  include: { profile: true },
});
```
