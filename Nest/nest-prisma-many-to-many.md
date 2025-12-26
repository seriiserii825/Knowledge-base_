### Many-to-Many (Многие ко многим)

Неявная связь (Prisma создаёт таблицу автоматически)

```prisma
model Post {
    id Int @id @default(autoincrement())
    title String
    categories Category[]
}

model Category {
    id Int @id @default(autoincrement())
    name String
    posts Post[]
}
```

Явная связь (своя промежуточная таблица)
Нужна, когда в связи есть дополнительные поля.

```prisma
model Post {
    id Int @id @default(autoincrement())
    title String
    categories CategoriesOnPosts[]
}

model Category {
    id Int @id @default(autoincrement())
    name String
    posts CategoriesOnPosts[]
}

model CategoriesOnPosts {
    post Post @relation(fields: [postId], references: [id])
    postId Int
    category Category @relation(fields: [categoryId], references: [id])
    categoryId Int
    assignedAt DateTime @default(now()) // доп. поле

    @@id([postId, categoryId])
}
```

NestJS использование:

```typescript
typescript; // Неявная связь — connect
await prisma.post.create({
  data: {
    title: "Post",
    categories: {
      connect: [{ id: 1 }, { id: 2 }],
    },
  },
});

// Или создать категории сразу
await prisma.post.create({
  data: {
    title: "Post",
    categories: {
      create: [{ name: "Tech" }, { name: "News" }],
    },
  },
});

// Явная связь
await prisma.categoriesOnPosts.create({
  data: {
    postId: 1,
    categoryId: 2,
    assignedAt: new Date(),
  },
});
```

### Самоссылающаяся связь (Self-relation)

Например, пользователь подписывается на пользователей.

```prisma
model User {
    id Int @id @default(autoincrement())
    name String
    followers User[] @relation("UserFollows")
    following User[] @relation("UserFollows")
}
```

### Каскадное удаление

```prisma
model Post {
    id Int @id @default(autoincrement())
    author User @relation(fields: [authorId], references: [id], onDelete: Cascade)
    authorId Int
}
```

### Опции onDelete / onUpdate:

- Cascade — удалить связанные записи
- SetNull — установить NULL
- Restrict — запретить удаление
- NoAction — ничего не делать
