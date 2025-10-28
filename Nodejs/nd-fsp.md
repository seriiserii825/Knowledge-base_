### 📖 Чтение файлов

```ts
fsp.readFile(path, options) — читает весь файл, возвращает содержимое.
fsp.open(path, flags?) — открывает файл и возвращает объект FileHandle (через который можно читать/писать).
```

### 📝 Запись файлов

```ts
fsp.writeFile(path, data, options) — записывает или создаёт файл.
fsp.appendFile(path, data, options) — добавляет данные в конец файла.
```

### 📁 Каталоги

```ts
fsp.readdir(path, options) — получает список файлов и папок.
fsp.mkdir(path, options) — создаёт папку (можно { recursive: true }).
fsp.rm(path, options) — удаляет файл или папку (рекурсивно, если нужно).
fsp.rmdir(path) — удаляет пустую папку (устарело, лучше rm).
```

### 📦 Работа с файлами

```ts
fsp.stat(path) — возвращает информацию о файле (размер, даты, тип).
fsp.lstat(path) — то же, но не разыменовывает символическую ссылку.
fsp.access(path, mode?) — проверяет доступ (чтение, запись и т.д.).
fsp.copyFile(src, dest, mode?) — копирует файл.
fsp.rename(oldPath, newPath) — переименовывает или перемещает файл.
fsp.unlink(path) — удаляет файл.
```

### 🔗 Ссылки и дескрипторы

```ts
fsp.readlink(path) — возвращает путь, на который указывает символическая ссылка.
fsp.symlink(target, path, type?) — создаёт символическую ссылку.
fsp.realpath(path) — возвращает абсолютный путь к файлу.
```

### ⚙️ Права и атрибуты

```ts
fsp.chmod(path, mode) — меняет права доступа (0o644, 0o755 и т.д.).
fsp.chown(path, uid, gid) — меняет владельца и группу.
fsp.utimes(path, atime, mtime) — меняет время доступа и изменения.
```

### 🧩 Утилиты

```ts
fsp.cp(src, dest, options) — копирует файлы и папки рекурсивно.
fsp.watch(path, options) — возвращает асинхронный итератор для отслеживания изменений (Node 18+).
```
