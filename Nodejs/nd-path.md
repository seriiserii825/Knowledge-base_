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

path.basename() — возвращает последнюю часть пути. Второй параметр может фильтровать расширение файла.
path.dirname() — возвращает часть пути к директории.
path.extname() — возвращает часть пути к расширению.
path.isAbsolute() — возвращает true, если путь абсолютный.
path.join() — объединяет две или более части пути.
path.normalize() — пытается вычислить реальный путь, когда он содержит относительные спецификаторы вроде . или ..,
или двойные косые черты.
path.parse() — преобразует путь в объект с составляющими его сегментами: корень, путь к папке, начиная от корня,
имя файла и расширение.
path.relative() — принимает два пути в качестве аргументов и возвращает относительный путь от первого пути ко второму,
основываясь на текущей рабочей директории.
path.resolve() — находит абсолютный путь к файлу на основе относительного пути к нему.
```
