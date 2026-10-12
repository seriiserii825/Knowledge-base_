
# План изучения Go (Golang)

Цель: научиться разрабатывать CLI-приложения, автоматизировать задачи и создавать REST API на Go.

Формат каждого урока:
1. Теория и объяснение синтаксиса.
2. Сравнение с JavaScript/TypeScript.
3. Примеры рабочего кода.
4. Практическое задание.
5. Проверка решения.

## Этап 1. Основы Go

- [ ] 01. Установка Go и структура проекта
  - go version, go mod init, go run, go build.
  - package main, func main().
  - go.mod и структура проекта.

- [ ] 02. Переменные и типы данных
  - var, :=, const.
  - string, int, float64, bool.
  - Нулевые значения, преобразование типов.

- [ ] 03. Условия, циклы и функции
  - if, else, switch, for, range.
  - func, параметры и возвращаемые значения.
  - Несколько возвращаемых значений.

- [ ] 04. Массивы, slices и maps
  - Array, slice, map.
  - append, len, make, delete.
  - Аналоги Array, Object и Record из JS/TS.

- [ ] 05. Struct, методы и указатели
  - struct, методы, receiver.
  - Указатели * и &.
  - Отличия от классов JavaScript.

- [ ] 06. Обработка ошибок
  - error, nil, if err != nil.
  - defer, panic, recover.
  - Создание собственных ошибок.

## Этап 2. Файлы, данные и CLI

- [ ] 07. Работа с файлами и папками
  - os.ReadFile, os.WriteFile.
  - os.Create, os.MkdirAll, os.Remove.
  - filepath.Join, filepath.Ext.

- [ ] 08. Поиск файлов и дерево директорий
  - os.ReadDir и filepath.WalkDir.
  - Поиск по имени и расширению.
  - Рекурсия, отображение дерева файлов.

- [ ] 09. JSON в Go
  - encoding/json.
  - Struct tags, Marshal, Unmarshal.
  - Чтение, запись и обновление JSON-файлов.

- [ ] 10. CSV в Go
  - encoding/csv.
  - Чтение и запись CSV.
  - Фильтрация, импорт и экспорт данных.

- [ ] 11. SQLite в Go
  - SQLite и database/sql.
  - Создание таблиц и CRUD.
  - Поиск и обновление записей.

- [ ] 12. Ввод данных и аргументы CLI
  - bufio.NewReader, fmt.Scan.
  - os.Args, flag.
  - Интерактивные вопросы и CLI-флаги.

- [ ] 13. Запуск внешних команд
  - os/exec.
  - Запуск Bash, Git, WP-CLI, Docker и npm.
  - Обработка stdout, stderr и кодов завершения.

- [ ] 14. Интерактивный поиск с FZF
  - Передача списка файлов в fzf.
  - Поиск и выбор файла.
  - Открытие файла в Neovim.

- [ ] 15. Создание собственного CLI-генератора
  - Генерация HTML, JS и PHP файлов.
  - Создание структуры проекта.
  - Выбор шаблонов и обработка ошибок.

- [ ] 16. Сборка и распространение CLI
  - go build, GOOS, GOARCH.
  - Компиляция для Linux, Windows, macOS.
  - Установка собственной команды в PATH.

## Этап 3. Go для Backend

- [ ] 17. Пакеты, модули и зависимости
  - Организация большого проекта.
  - import, export, go get, go mod tidy.
  - Разделение кода по пакетам.

- [ ] 18. HTTP-сервер
  - net/http.
  - Request, ResponseWriter.
  - Маршруты, обработчики и JSON-ответы.

- [ ] 19. REST API
  - GET, POST, PUT, PATCH, DELETE.
  - CRUD, DTO, обработка ошибок.
  - Валидация входных данных.

- [ ] 20. Gin и Huma
  - Роутинг, middleware.
  - Валидация и OpenAPI.
  - Swagger UI, генерация типов TypeScript.

- [ ] 21. PostgreSQL
  - Подключение к PostgreSQL через pgx.
  - SQL, CRUD, транзакции.
  - Миграции и организация repository layer.

- [ ] 22. Авторизация и безопасность
  - Регистрация и вход.
  - Хеширование паролей.
  - JWT access token.
  - Refresh token и HTTP-only cookies.
  - Middleware, роли, права доступа.

## Этап 4. Продвинутые возможности Go

- [ ] 23. Интерфейсы
  - interface, реализация интерфейсов.
  - Композиция вместо наследования.
  - Dependency injection.

- [ ] 24. Generics
  - Type parameters.
  - any, comparable.
  - Обобщённые функции и структуры.

- [ ] 25. Горутины
  - goroutines.
  - Параллельное выполнение задач.
  - sync.WaitGroup, sync.Mutex.

- [ ] 26. Каналы
  - chan, select.
  - Передача данных между горутинами.
  - Worker pool.

- [ ] 27. Context
  - context.Context.
  - Timeout, cancellation.
  - Контекст HTTP-запросов и SQL-запросов.

- [ ] 28. Тестирование
  - go test.
  - Unit tests, table-driven tests.
  - HTTP handler tests, benchmarks.

- [ ] 29. Docker и Deployment
  - Multi-stage Dockerfile.
  - Переменные окружения.
  - Сборка и запуск Go API на сервере.

## Этап 5. Финальный проект

- [ ] 30. REST API интернет-магазина
  - Users, products, categories.
  - PostgreSQL и миграции.
  - Регистрация, JWT и refresh token.
  - Middleware и permissions.
  - Swagger / OpenAPI.
  - Генерация TypeScript-типов для Angular.
  - Docker Compose.
  - Тестирование и deployment.

## Дополнительные проекты для практики

1. File Explorer — поиск файлов, фильтрация и дерево папок.
2. WordPress CLI Manager — управление плагинами через WP-CLI.
3. Project Generator — генератор HTML/JS/PHP проектов.
4. JSON/CSV Manager — импорт, экспорт и редактирование данных.
5. Site Manager — список сайтов и настройки в SQLite.
6. REST API — полноценный backend с PostgreSQL и авторизацией.

## Как проходить

Для каждого пункта открыть отдельный чат с запросом:

"Урок №N из моего плана изучения Go: [название]. Объясни теорию, сравни с JavaScript/TypeScript, покажи несколько примеров и дай практическое задание. Не переходи к следующему уроку, пока я не закончу текущий."