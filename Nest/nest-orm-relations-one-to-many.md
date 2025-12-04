### movies table

```ts
import { ReviewEntity } from "src/reviews/entities/review.entity";
import {
  Column,
  CreateDateColumn,
  Entity,
  OneToMany,
  PrimaryGeneratedColumn,
  Unique,
  UpdateDateColumn,
} from "typeorm";

@Entity("movies")
@Unique(["title"])
export class MovieEntity {
  @PrimaryGeneratedColumn()
  id: number;

  @OneToMany(() => ReviewEntity, (review) => review.movie)
  reviews: ReviewEntity[];
}
```

### reviews table

```ts
import { MovieEntity } from "src/movies/entities/movie.entity";
import {
  Column,
  CreateDateColumn,
  Entity,
  JoinColumn,
  ManyToOne,
  PrimaryGeneratedColumn,
  UpdateDateColumn,
} from "typeorm";

@Entity("reviews")
export class ReviewEntity {
  @Column()
  movie_id: number;

  @ManyToOne(() => MovieEntity, (movie) => movie.reviews, {
    onDelete: "CASCADE",
  })
  @JoinColumn({ name: "movie_id" })
  movie: MovieEntity;
}
```
