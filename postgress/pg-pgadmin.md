Зайди в http://localhost:5050.

В pgAdmin:

- Правый клик по серверу → Delete/Remove (если уже создавал с неправильным host).
- Создай заново: Register → Server...
- Вкладка Connection:
- Host name/address: postgres
- Port: 5432
- Maintenance database: postgres
- Username: postgres
- Password: secret_pass

docker-compose.yml:

```yaml
version: "3.8"

services:
  postgres:
    image: "postgres:16"
    container_name: "postgres"
    environment:
      POSTGRES_PASSWORD: "secret_pass"
      POSTGRES_USER: "postgres"
      POSTGRES_DB: "postgres"
    ports:
      - "5432:5432"
    volumes:
      - postgres_data:/var/lib/postgresql/data

  pgadmin:
    image: dpage/pgadmin4
    container_name: pgadmin
    environment:
      PGADMIN_DEFAULT_EMAIL: "admin@example.com" # логин для входа в pgAdmin
      PGADMIN_DEFAULT_PASSWORD: "admin" # пароль для входа в pgAdmin
    ports:
      - "5050:80" # http://localhost:5050
    depends_on:
      - postgres
    volumes:
      - pgadmin_data:/var/lib/pgadmin # чтобы настройки pgAdmin не терялись

volumes:
  postgres_data:
  pgadmin_data:
```
