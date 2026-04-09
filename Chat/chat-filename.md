## `@filename` — прикрепить файл

`@` запускает умное автодополнение путей к файлам. Например:

`@src/components/Header.tsx Fix the responsive layout`

Это быстрее, чем описывать файл и ждать, пока Claude его найдёт.

> Tim Dietrich

---

В кастомных командах также можно использовать `@filename`, чтобы включить содержимое файла прямо в промпт.

> Awesome Claude

---

### Примеры использования

```bash
@src/utils/auth.ts объясни как работает эта функция

@README.md обнови секцию Installation

@package.json какие зависимости устарели?

# Несколько файлов сразу:
@src/api/users.ts @src/types/User.ts найди несоответствия в типах
```
