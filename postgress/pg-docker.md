## Setting Up a PostgreSQL Database with Docker

docker-compose.yml

```yaml
version: "3"
services:
  postgres:
    image: "postgres:16"
    container_name: "postgres"
    environment:
      POSTGRES_PASSWORD: "secret_pass"
    ports:
      - "5432:5432"
    volumes:
      - postgres_data:/var/lib/postgresql/data

volumes:
  postgres_data:
```
