## Проблема

В GTK Save-диалоге Chrome (`GtkFileChooserDialog`) после ввода/вставки имени файла `Enter` не срабатывал — сохраняло только по клику на кнопку Save, `Escape` при этом закрывал диалог целиком (не автокомплит).

Пробовал по пути наименьшего риска (не помогло, но оставляю для истории):
- Убрать `resize set` / `move position center` из `for_window` правила для `GtkFileChooserDialog` в i3 — не помогло.
- Убрать `for_window` правило вообще (диалог тайлится как обычное окно) — не помогло.
- `focus_follows_mouse no` в `~/.config/i3/config` — не помогло.

Похоже на общую проблему самого GTK-диалога в Chrome (баг-репорты про Chrome/GTK на Linux встречаются, конкретную причину не нашли). Решили обойти проблему целиком — заменить встроенный GTK-диалог на терминальный file picker через `xdg-desktop-portal` с `yazi`.

---

## Решение: xdg-desktop-portal-termfilechooser + yazi

Суть: приложения, поддерживающие `xdg-desktop-portal` (Chrome — при указанном флаге, см. ниже), вместо своего диалога дергают системный portal-сервис, который открывает выбранный терминальный file manager (в нашем случае `yazi` в `alacritty`).

### 1. Установка

```
yay -S xdg-desktop-portal-termfilechooser
```

Пакет: `hunkyburrito/xdg-desktop-portal-termfilechooser`. `yazi` должен быть установлен отдельно (у нас уже был).

Добавлено в `~/dotfiles/packages/eiwi.txt` (список AUR-пакетов), чтобы на второй машине подтянулось при синхронизации пакетов:
```
xdg-desktop-portal-termfilechooser
```

### 2. Конфиги

Все конфиги живут в `~/dotfiles/.config/...` и симлинкаются в `~/.config/...` — как и остальные dotfiles (см. `~/dotfiles/.config/i3`, `~/dotfiles/.config/yazi` и т.д., та же схема используется и для новых конфигов).

**`~/dotfiles/.config/xdg-desktop-portal-termfilechooser/config`** (симлинк `~/.config/xdg-desktop-portal-termfilechooser`):
```ini
[filechooser]
cmd=yazi-wrapper.sh
default_dir=$HOME
env=TERMCMD=alacritty -T termfilechooser -e
open_mode=suggested
save_mode=suggested
```

`-T termfilechooser` — задаёт заголовок окна alacritty на момент запуска, нужен для i3-правила ниже (yazi потом сам переименует заголовок окна на `Yazi: ...`, но i3 матчит `for_window` по заголовку в момент маппинга окна, так что успевает сработать).

**`~/dotfiles/.config/xdg-desktop-portal/portals.conf`** (симлинк `~/.config/xdg-desktop-portal`):
```ini
[preferred]
org.freedesktop.impl.portal.FileChooser=termfilechooser
```
Явно указывает предпочитаемый бэкенд для FileChooser — не полагаемся на автоопределение через `XDG_CURRENT_DESKTOP` (у нас эта переменная вообще пустая, хотя `termfilechooser.portal` и содержит `i3` в `UseIn=`).

Создать симлинки (если конфиги ещё не засимлинканы, как в dotfiles):
```
ln -s ~/dotfiles/.config/xdg-desktop-portal-termfilechooser ~/.config/xdg-desktop-portal-termfilechooser
ln -s ~/dotfiles/.config/xdg-desktop-portal ~/.config/xdg-desktop-portal
```

### 3. i3: floating + focus для picker-окна

В `~/dotfiles/.config/i3/workspaces`:
```
for_window [title="termfilechooser"] floating enable, resize set 900 700, move position center, focus
```
Без этого правила окно yazi тайлится как обычное окно и легко теряется из виду (не в фокусе, может уйти на другой воркспейс).

### 4. Перезапуск сервисов

```
systemctl --user restart xdg-desktop-portal.service
systemctl --user restart xdg-desktop-portal-termfilechooser.service
i3-msg reload
```

### 5. Запуск Chrome с поддержкой портала

Chrome не использует portal file dialog по умолчанию — нужна переменная окружения:
```
GTK_USE_PORTAL=1
```

В `~/dotfiles/.config/i3/keyboard` биндинг запуска Chrome изменён на:
```
bindsym $mod+g exec env GTK_USE_PORTAL=1 google-chrome-stable
```

**Важно (грабли):** Chrome — single-instance приложение. Если Chrome уже запущен (например, с автостарта или был открыт до этого изменения), повторный запуск через `$mod+g` просто откроет новое окно в уже работающем процессе — переменная окружения не применится, потому что новый процесс не стартует. Если после настройки portal всё ещё открывается родной GTK-диалог — **сначала полностью закрыть Chrome** (все окна, процесс должен погибнуть полностью — проверить `pgrep -al chrome`), и только потом открыть заново через `$mod+g`.

---

## Как это выглядит и как пользоваться

При Ctrl+S / "Save Image As" вместо GTK-диалога открывается floating-окно alacritty с yazi, уже в фокусе, по центру экрана. В текущей директории уже лежит файл-плейсхолдер с предложенным именем (Chrome его подсказывает) — это служебный файл с инструкцией внутри (создаётся автоматически, `create_help_file` по умолчанию включён):

```
!!! WARNING !!!
Opening a file OVERWRITES it!
How to save *this* file:
1) Move the file to your desired location.
2) Rename the file if needed.
3) Open the file.

Tips:
- If you quit without opening a file, the save operation is cancelled.
```

**"Open the file" — не значит открыть/просмотреть.** Это условность chooser-режима yazi: действие "open" на этом файле-плейсхолдере — способ сказать порталу "сохраняй сюда", после чего yazi закрывается и путь уходит обратно в Chrome.

### Как сохранить

- **Как предложено (то же имя/место)** — навести курсор на файл-плейсхолдер и выполнить действие `open`.
- **Другое имя** — переименовать плейсхолдер, затем `open`.
- **Другая папка** — переместить плейсхолдер (cut+paste) в нужную директорию, затем `open`.
- **Отмена** — `q` (выйти без открытия файла).

**Важно:** в кастомном `~/dotfiles/.config/yazi/keymap.toml` действие `open` привязано к клавише **`o`**, а не к `Enter` (в главном режиме файлового менеджера `<Enter>` вообще не забинден — есть только в других режимах: pick/input/confirm/task-inspect). Так что для подтверждения сохранения нужно нажимать `o`, не `Enter`.

---

## Диагностика (если снова перестанет работать)

Проверить, что запрос вообще доходит до portal-бэкенда:
```
journalctl --user -u xdg-desktop-portal.service -u xdg-desktop-portal-termfilechooser.service --since "5 minutes ago" --no-pager
```

Протестировать portal напрямую, в обход Chrome (полезно, чтобы понять — проблема в Chrome или в конфиге):
```
busctl --user call org.freedesktop.portal.Desktop /org/freedesktop/portal/desktop org.freedesktop.portal.FileChooser OpenFile "ssa{sv}" "" "Test" 0
```
Если после этого не появилось окно yazi — искать `ps aux | grep -E "yazi|alacritty"` и `wmctrl -l`: окно может быть создано, но не в фокусе/не на текущем воркспейсе (тогда решает `for_window` правило из шага 3).

**Грабли, с которыми уже сталкивались:**
- Если до этого руками запускали `/usr/lib/xdg-desktop-portal-termfilechooser` для дебага (например с `-l DEBUG`) и не убили процесс — он держит имя на D-Bus, и systemd-сервис не может запуститься (`failed to acquire service name: File exists`). Проверить `ps aux | grep termfilechooser`, убить лишние процессы, `systemctl --user restart xdg-desktop-portal-termfilechooser.service`.
- Chrome single-instance — см. пункт про `GTK_USE_PORTAL=1` выше, надо гарантированно убить старый процесс перед тестом.

## На второй машине (репликация)

1. `git pull` в `~/dotfiles` — конфиги уже там (симлинки нужно будет создать заново, если это свежий стоу/бутстрап без них).
2. `yay -S xdg-desktop-portal-termfilechooser` (или через синхронизацию `eiwi.txt`).
3. Проверить/создать симлинки из шага 2 выше.
4. `systemctl --user restart xdg-desktop-portal.service xdg-desktop-portal-termfilechooser.service`.
5. Полностью закрыть Chrome и открыть заново через `$mod+g`.
