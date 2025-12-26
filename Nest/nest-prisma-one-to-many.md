### One-to-Many (Один ко многим)

Один пользователь — много постов.

```prisma
model User {
  id Int @id @default(autoincrement())
  email String @unique
  posts Post[]
}

model Post {
  id Int @id @default(autoincrement())
  title String
  author User @relation(fields: [authorId], references: [id])
  authorId Int
}
```

NestJS использование:

```typescript
typescript; // Создание поста для пользователя
await prisma.post.create({
  data: {
    title: "My Post",
    author: { connect: { id: 1 } },
  },
});

// Или через user
await prisma.user.update({
  where: { id: 1 },
  data: {
    posts: {
      create: { title: "New Post" },
    },
  },
});

// Получение пользователя с постами
await prisma.user.findUnique({
  where: { id: 1 },
  include: { posts: true },
});
```
