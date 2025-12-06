## one to many

```prisma


model Movie {
  id           Int      @id @default(autoincrement())
  title        String
  description  String?
  release_year Int
  rating       Float    @default(0.0)
  is_avalaible Boolean  @default(false)
  genre        Genre    @default(DRAMA)
  createdAt    DateTime @default(now())
  updatedAt    DateTime @updatedAt
  reviews      Review[] @relation("movie_reviews")

  @@map("movies")
}

model Review {
  id     Int    @id @default(autoincrement())
  text   String
  rating Float  @default(0.0)

  movie    Movie @relation("movie_reviews", fields: [movie_id], references: [id], onDelete: Cascade)
  movie_id Int

  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt

  @@map("movies")
}
```
