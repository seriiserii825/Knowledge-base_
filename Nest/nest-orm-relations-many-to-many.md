### movies table

```ts
@Entity("movies")
@Unique(["title"])
export class MovieEntity {
  @ManyToMany(() => ActorEntity, (actor) => actor.movies)
  @JoinTable({
    name: "movie_actors",
    joinColumn: { name: "movie_id", referencedColumnName: "id" },
    inverseJoinColumn: { name: "actor_id", referencedColumnName: "id" },
  })
  actors: ActorEntity[];
}
```

### actor entity

```ts
@Unique(["name"])
@Entity("actors")
export class ActorEntity {
  @ManyToMany(() => MovieEntity, (movie) => movie.actors)
  movies: MovieEntity[];
}
```

### create actor

```ts
async create(dto: CreateActorDto): Promise<ActorEntity> {
    try {
        const actor = this.actorRepository.create(dto);
        return await this.actorRepository.save(actor);
    } catch (error) {
        const message = error instanceof Error ? error.message : 'Unknown error';
        throw new InternalServerErrorException(
                `Failed to create actor: ${message}`,
                );
    }
}
```

### actors findByIds

```ts
async findByIds(ids: number[]): Promise<ActorEntity[]> {
    const actors = await this.actorRepository.find({
    where: {
        id: In(ids),
    },
    });
    if (actors.length === 0) {
        throw new InternalServerErrorException(
                'No actors found with the provided IDs',
                );
    }
    if (actors.length !== ids.length) {
        const foundIds = actors.map((actor) => actor.id);
        const notFoundIds = ids.filter((id) => !foundIds.includes(id));
        throw new InternalServerErrorException(
                `Actors not found with IDs: ${notFoundIds.join(', ')}`,
                );
    }
    return actors;
}
```

### create movie

```ts

async create(dto: CreateMovieDto): Promise<MovieEntity> {
    try {
        const movie = this.movieRepository.create(dto);
        const actors = await this.actorService.findByIds(dto.actor_ids);
        if (actors.length === 0) {
            throw new NotFoundException('No actors found with the provided IDs');
        }
        movie.actors = actors;
        await this.movieRepository.save(movie);
        return movie;
    } catch (error: unknown) {
        let message = 'Unknown error';
        if (error instanceof Error) {
            message = error.message;
        }
        throw new HttpException(`Failed to create movie: ${message}`, 500);
    }
}
```
