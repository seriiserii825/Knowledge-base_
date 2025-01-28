## get version

```
docker-compose version
docker-compose version 1.29.2, build 5becea4c
docker-py version: 5.0.0
CPython version: 3.7.10
OpenSSL version: OpenSSL 1.1.0l  10 Sep 2019
```

## docker-compose.yml

```yaml
version: "3.7"
services:
  api:
    build: .
    container_name: api
    ports:
      - "3001:3000"
    volumes:
      - .:/app
      - /app/node_modules
```
