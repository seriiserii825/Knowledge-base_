# Git submodule + Python (uv editable)

Сценарий: есть общая библиотека (`py-libs`), которую нужно подключать
в несколько проектов (`py-wp`, `py-ng`, ...) так, чтобы правки в
библиотеке сразу были видны в проекте, без publish/переустановки.

## TL;DR (5 команд)

```bash
# в основном проекте (например py-wp)
git submodule add git@github.com:USER/py-libs.git libs/py-libs
uv add --editable ./libs/py-libs

# после клонирования проекта на новой машине
git clone --recurse-submodules git@github.com:USER/py-wp.git

# после правок ВНУТРИ submodule — коммит идёт в 2 репозитория
cd libs/py-libs && git add . && git commit -m "..." && git push
cd ../.. && git add libs/py-libs && git commit -m "bump py-libs"
```

---

## 1. Пример на двух репозиториях

- `py-libs` — библиотека с переиспользуемыми классами (`Select`, `Command`, `Print`, ...), свой git-репозиторий, свой `pyproject.toml`.
- `py-wp` — основной проект, использующий `py-libs` как зависимость.

Задача: подключить `py-libs` внутрь `py-wp` как submodule и установить его как editable Python-пакет, чтобы `import py_libs...` работал и любая правка файла в `py-libs` сразу отражалась в `py-wp` без переустановки.

---

## 2. Подключение submodule в существующий репозиторий

```bash
cd py-wp
git submodule add git@github.com:USER/py-libs.git libs/py-libs
```

Что произошло:
- склонировался репозиторий `py-libs` в `py-wp/libs/py-libs`
- в корне `py-wp` появился файл `.gitmodules`:
  ```ini
  [submodule "libs/py-libs"]
      path = libs/py-libs
      url = git@github.com:USER/py-libs.git
  ```
- в `py-wp` замокан коммит submodule'а (специальная запись в git index — "gitlink"), а не сам код файлами напрямую

Привязать submodule к конкретной ветке (по умолчанию — detached HEAD на коммите):

```bash
git submodule add -b main git@github.com:USER/py-libs.git libs/py-libs
```

Закоммитить добавление submodule:

```bash
git add .gitmodules libs/py-libs
git commit -m "add py-libs as submodule"
```

---

## 3. Установка как editable-пакета через uv

Требование: у `py-libs` должен быть свой `pyproject.toml` с секцией `[project]` и `name = "py_libs"`.

```bash
cd py-wp
uv add --editable ./libs/py-libs
```

Что меняется:
- в `py-wp/pyproject.toml` добавляется зависимость с `{ path = "libs/py-libs", editable = true }`
- `uv.lock` фиксирует, что пакет ставится в editable-режиме (симлинк на исходники, а не копия)
- теперь в коде `py-wp` работает `from py_libs.utils.Print import Print` — и правки файлов в `libs/py-libs/py_libs/...` видны сразу, без `uv sync`/переустановки

---

## 4. Клонирование проекта с submodule

Сразу с submodule'ами:

```bash
git clone --recurse-submodules git@github.com:USER/py-wp.git
```

Если уже склонировали без флага (submodule-папка будет пустой):

```bash
git submodule init
git submodule update
# или одной командой:
git submodule update --init --recursive
```

После этого не забыть `uv sync`, чтобы editable-пакет встал на место.

---

## 5. Рабочий цикл разработки (важно понять сразу)

`libs/py-libs` внутри `py-wp` — это **отдельный git-репозиторий**. Правки нужно коммитить/пушить в двух местах:

1. Правите код прямо в `py-wp/libs/py-libs/...` — изменения сразу видны в `py-wp` (editable install).
2. Коммит и пуш **внутри submodule**:
   ```bash
   cd libs/py-libs
   git checkout main        # если попали в detached HEAD, см. раздел 8
   git add .
   git commit -m "fix Select.select_one"
   git push
   ```
3. Возвращаетесь в основной репозиторий и фиксируете новый указатель (pointer) submodule'а:
   ```bash
   cd ../..            # обратно в py-wp
   git add libs/py-libs
   git commit -m "bump py-libs pointer"
   git push
   ```

**Частая ошибка**: закоммитили `libs/py-libs` в `py-wp` (шаг 3), но забыли `git push` внутри самого submodule (шаг 2). На другой машине `git submodule update` попытается зачекаутить коммит, которого нет на remote — ошибка "reference is not a tree" / "Fetched in submodule path ... but it did not contain <sha>". Правило: **сначала push внутри submodule, потом commit+push в основном репо**.

---

## 6. Подтягивание изменений

`git pull` в основном репозитории обновляет только **ссылку** на коммит submodule'а, не сам код внутри `libs/py-libs`. После pull:

```bash
git pull
git submodule update --init --recursive
```

Подтянуть последний коммит удалённой ветки submodule'а (не тот, что зафиксирован в основном репо, а прямо HEAD ветки):

```bash
git submodule update --remote libs/py-libs
git add libs/py-libs
git commit -m "update py-libs to latest"
```

---

## 7. Статус и диагностика

```bash
git submodule status              # какой коммит зафиксирован, есть ли расхождения
git diff --submodule               # что изменилось на уровне submodule-указателя
git status                         # "modified: libs/py-libs (new commits)" — есть незапушенные/незакоммиченные правки внутри submodule
```

---

## 8. Частые проблемы

**Detached HEAD внутри submodule**
После `git submodule update` submodule чекаутится на конкретный коммит, а не на ветку — это нормально для "просмотра", но перед правками нужно:
```bash
cd libs/py-libs
git checkout main
```
иначе коммиты уйдут в detached HEAD и потеряются при следующем `git submodule update`.

**Забыли `--recurse-submodules` при клонировании**
Папка `libs/py-libs` будет пустой. Исправляется:
```bash
git submodule update --init --recursive
```

**Удаление submodule**
```bash
git submodule deinit -f libs/py-libs
git rm -f libs/py-libs
rm -rf .git/modules/libs/py-libs
```
(плюс убедиться, что запись про submodule пропала из `.gitmodules` и `.git/config`)

---

## 9. Подключение той же библиотеки во второй проект (например py-ng)

Ровно те же две команды, что и в разделе 2-3:

```bash
cd py-ng
git submodule add git@github.com:USER/py-libs.git libs/py-libs
uv add --editable ./libs/py-libs
```

Один и тот же `py-libs` можно подключать в сколько угодно проектов — каждый держит свою копию кода в `libs/py-libs`, но все они смотрят на один и тот же remote-репозиторий и обновляются независимо (`git submodule update --remote`).
