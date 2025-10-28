# Path

Модуль path в Node.js
предоставляет инструменты для обработки и преобразования путей к файлам в разных операционных системах.
Он помогает писать кроссплатформенный код, который работает правильно в любой системе. 1

Некоторые методы модуля path:

## path where is situated script

```ts
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

console.log("__filename:", __filename);
console.log("__dirname:", __dirname);
__filename: /home/eiirs / Documents / typescript / ts -
  json -
  schema -
  cli / src / modules / getApiFilesUrls.ts;
__dirname: /home/eiirs / Documents / typescript / ts - json - schema - cli / src / modules;
```

## path where script was called

```ts
const cwd = process.cwd();
console.log("called from:", cwd);

// example: join relative path from project root
const apiDir = path.join(cwd, "src/api");
console.log("apiDir:", apiDir);

called from: /home/serii/Downloads
apiDir: /home/serii/Downloads/src/api
```

```javascript

import path from "node:path";

path.basename(p, ext?) — возвращает последнюю часть пути (имя файла). Второй параметр удаляет указанное расширение.
path.dirname(p) — возвращает путь к каталогу, в котором находится файл.
path.extname(p) — возвращает расширение файла, включая точку (.txt, .js и т.д.).
path.join(...segments) — соединяет несколько частей пути, автоматически добавляя правильные разделители.
path.resolve(...segments) — формирует абсолютный путь, начиная с текущей рабочей директории.
path.normalize(p) — нормализует путь: убирает лишние слэши, ".", ".." и т.д.
path.relative(from, to) — возвращает относительный путь от одной директории к другой.
path.isAbsolute(p) — проверяет, является ли путь абсолютным.
path.format(obj) — собирает путь из объекта { root, dir, base, name, ext }.
path.parse(p) — разбирает путь в объект с полями root, dir, base, name, ext.
path.toNamespacedPath(p) — преобразует путь в формат Windows (редко используется).
```

### ⚙️ Свойства

```ts
path.sep — разделитель директорий ("/" на Unix, "\" на Windows).
path.delimiter — разделитель путей в переменной PATH (":" на Unix, ";" на Windows).
path.posix — POSIX-версия методов (использует "/" как разделитель).
path.win32 — Windows-версия методов (использует "\" как разделитель).
```
