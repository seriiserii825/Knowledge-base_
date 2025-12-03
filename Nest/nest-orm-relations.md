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

export enum Genre {
  ACTION = "Action",
  COMEDY = "Comedy",
  DRAMA = "Drama",
}

@Entity("movies")
@Unique(["title"])
export class MovieEntity {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({
    type: "varchar",
    length: 128,
  })
  title: string;

  @OneToMany(() => ReviewEntity, (review) => review.movie)
  reviews: ReviewEntity[];

  @CreateDateColumn()
  created_at: Date;

  @UpdateDateColumn()
  updated_at: Date;
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
  @PrimaryGeneratedColumn()
  id: number;

  @Column("text")
  text: string;

  @Column({
    type: "decimal",
    precision: 3,
    scale: 1,
    default: 0.0,
  })
  rating: number;

  @Column()
  movie_id: number;

  @ManyToOne(() => MovieEntity, (movie) => movie.reviews, {
    onDelete: "CASCADE",
  })
  @JoinColumn({ name: "movie_id" })
  movie: MovieEntity;

  @CreateDateColumn()
  createdAt: Date;

  @UpdateDateColumn()
  updatedAt: Date;
}
```
