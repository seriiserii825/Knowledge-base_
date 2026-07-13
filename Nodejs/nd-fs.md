### 📖 Чтение файлов в node.js

```ts
fs.readFile(path, options, callback) — читает весь файл целиком.
fs.readFileSync(path, options) — синхронное чтение файла.
fs.createReadStream(path, options) — потоковое чтение файла.
```

### 📝 Запись файлов

```ts
fs.writeFile(path, data, options, callback) — записывает данные, перезаписывая файл.
fs.writeFileSync(path, data, options) — синхронная запись.
fs.appendFile(path, data, options, callback) — добавляет данные в конец файла.
fs.createWriteStream(path, options) — потоковая запись в файл.
```

### 📁 Каталоги

```ts
fs.readdir(path, options, callback) — читает содержимое папки.
fs.mkdir(path, options, callback) — создаёт папку.
fs.rm(path, options, callback) — удаляет файл или папку (в т.ч. рекурсивно).
fs.rmdir(path, callback) — удаляет пустую папку (устарел).
```

### 📦 Работа с файлами

```ts
fs.stat(path, callback) — получает информацию о файле (размер, дата, тип).
fs.lstat(path, callback) — информация о ссылке (не разыменовывает).
fs.existsSync(path) — проверяет, существует ли файл или папка.
fs.access(path, mode, callback) — проверяет права доступа.
fs.copyFile(src, dest, callback) — копирует файл.
fs.rename(oldPath, newPath, callback) — переименовывает или перемещает файл.
fs.unlink(path, callback) — удаляет файл.
```

### 🔗 Ссылки и дескрипторы

```ts
fs.open(path, flags, mode, callback) — открывает файл и возвращает дескриптор.
fs.close(fd, callback) — закрывает открытый дескриптор.
fs.readlink(path, callback) — читает путь символической ссылки.
fs.symlink(target, path, type, callback) — создаёт символическую ссылку.
```

### ⚙️ Права и атрибуты

```ts
fs.chmod(path, mode, callback) — изменяет права доступа (например, 0o755).
fs.chown(path, uid, gid, callback) — меняет владельца и группу.
fs.utimes(path, atime, mtime, callback) — обновляет время доступа/изменения.
fs.realpath(path, callback) — возвращает абсолютный путь (разрешает .. и .).
```

### 🧩 Утилиты и наблюдение

```ts
fs.watch(path, options, listener) — следит за изменениями файла/папки.
fs.watchFile(filename, options, listener) — следит с интервалом опроса.
fs.unwatchFile(filename) — прекращает слежение.
fs.cp(src, dest, options, callback) — рекурсивно копирует (Node.js 16+).
```
