# Git: случайно сделал коммит в detached HEAD

## Как понять, что это произошло

Если вместо названия ветки (`main`, `develop` и т.д.) Git показывает:

```bash
HEAD detached from <commit>
```

или в приглашении терминала отображается хеш коммита:

```bash
on 2c894d8d
```

значит ты находишься в **detached HEAD**.

Проверить можно командой:

```bash
git status
```

или

```bash
git branch
```

---

## Что нельзя делать

Не переключайся сразу на другую ветку:

```bash
git switch main
```

или

```bash
git checkout main
```

Пока коммит не привязан к ветке, его будет сложнее найти (хотя через `git reflog` это обычно возможно).

---

# Вариант 1 (рекомендуется). Перенести коммит в main через cherry-pick

### 1. Сохранить коммит отдельной веткой

```bash
git branch save-detached-work
```

### 2. Перейти на main

```bash
git switch main
```

### 3. Перенести коммит

Если это текущий коммит:

```bash
git cherry-pick save-detached-work
```

или по хешу:

```bash
git cherry-pick <commit_hash>
```

### 4. Удалить временную ветку

```bash
git branch -d save-detached-work
```

---

# Вариант 2. Влить временную ветку через merge

Если хочется сохранить историю именно как отдельную ветку:

```bash
git branch save-detached-work

git switch main

git merge save-detached-work

git branch -d save-detached-work
```

---

# Какой способ лучше?

## cherry-pick

Используется, когда нужно перенести один или несколько отдельных коммитов.

История получается линейной:

```
A -- B -- C -- D
```

Это наиболее распространённый вариант.

---

## merge

Используется, когда detached HEAD фактически стал новой веткой разработки.

История может выглядеть так:

```
A -- B -- C ---- M
     \       /
      D ----
```

или (если возможен fast-forward):

```
A -- B -- D
```

---

# Если уже переключился на main

Не паникуй.

Посмотреть последние положения HEAD:

```bash
git reflog
```

Найти нужный коммит и создать от него ветку:

```bash
git branch recovered <commit_hash>
```

Дальше выполнить:

```bash
git switch main
git cherry-pick recovered
```

или

```bash
git merge recovered
```

---

# Полезные команды

Текущий статус:

```bash
git status
```

Все ветки:

```bash
git branch
```

История:

```bash
git log --oneline --graph --decorate --all
```

История перемещений HEAD:

```bash
git reflog
```

Текущий коммит:

```bash
git rev-parse --short HEAD
```
