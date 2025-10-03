# Node js

## Recomendations

```
Node.js (+ npm / pnpm / yarn) — среда выполнения.
TypeScript — типизация, нравится вам.
fs/promises, path, glob — файловые операции.
axios / node-fetch / undici — HTTP-запросы.
cheerio / jsdom — парсинг HTML (аналог BeautifulSoup).
Puppeteer / Playwright / selenium-webdriver — управление браузером (рекомендую Playwright или Puppeteer; Playwright более современный и поддерживает Chromium/Firefox/WebKit).
commander / yargs / oclif — парсинг аргументов CLI.
chalk / ora / enquirer — цвет, спиннеры, интерактивность.
ts-node — исполнение TS без компиляции (удобно в разработке).
esbuild / tsc / rollup — сборка/транспиляция в JS для продакшн.
```

## Как сделать «вызов из любой папки» — варианты

### Через npm (локально)

В package.json добавьте поле bin:

```json
{
  "name": "my-cli",
  "version": "1.0.0",
  "bin": {
    "my-cli": "./dist/index.js"
  }
}
```

Затем собрать/скомпилировать и выполнить npm link в папке проекта — npm создаст глобальную ссылку,
и команда my-cli будет доступна в PATH.

### Установить глобально

```bash

npm install -g . из папки проекта (или опубликовать в npm и npm i -g my-cli).
```

### Просто положить скрипт в папку, которая в $PATH

```bash

Unix: /usr/local/bin/ — скопировать туда с chmod +x.
Windows: поместить .cmd/.bat или добавить папку в переменную PATH.
```

### Упаковать в исполняемый файл

```bash
pkg или nexe — выдадут один бинарник (полезно когда не хочется требовать Node на хосте).
```
