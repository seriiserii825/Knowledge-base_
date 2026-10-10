# air

```bash
go install github.com/air-verse/air@latest
```

## air.toml inside module

```toml
[build]
cmd = "go build -o ./tmp/main ."
entrypoint = "./tmp/main"
```

and run

```bash
air
```

## air.toml in root

Вариант 3. Одна конфигурация в корне (рекомендую)
Можно сделать один .air.toml в корне:

go-course/
├── .air.toml
├── go.mod
├── 01-go-install/
│ └── main.go
├── 02-variables/
│ └── main.go
└── 03-functions/
└── main.go
И указать в нём, какой урок запускать:

```toml
[build]
cmd = "go build -o ./tmp/main ./02-variables"
entrypoint = "./tmp/main"
```

Теперь запускаешь из корня:

```bash
air
```

Чтобы переключиться на 03-functions, меняешь 02-variables на 03-functions в .air.toml.
