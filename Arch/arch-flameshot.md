# Flameshot на i3: откат с 14.0 на 13.3

## Проблема

После обновления `flameshot` 13.3.0-2 → 14.0.0-1 (2026-10-26) `$mod+shift+y` (`flameshot gui`) перестал работать.

1. **Сначала не открывалось вообще ничего.** Flameshot 14 по умолчанию захватывает экран через `org.freedesktop.portal.Screenshot`. На i3 ни один установленный портал его не реализует (Screenshot есть только в `hyprland.portal`), поэтому flameshot молча ждёт 30 секунд и сдаётся. Видно, если запустить демон в терминале:
   ```
   flameshot: error: Screenshot portal timed out after 30 seconds
   flameshot: error: Unable to capture screen
   ```
   Лечится опцией `useX11LegacyScreenshot=true` в секции `[General]` файла `~/.config/flameshot/flameshot.ini`: она возвращает нативный захват через X11.

2. **Потом i3 тайлил окно захвата.** Окно размером на оба монитора вставлялось плиткой, и было видно уменьшенный скриншот обоих экранов. Лечится правилом `for_window [class="flameshot"] floating enable, border none, move absolute position 0 0, resize set 3840 1080`.

3. **Главное: в 14.0 больше нельзя выделить область на два монитора сразу.** С 14.0 flameshot сначала показывает на каждом мониторе плашку с его названием. Кликаешь по монитору, и только тогда начинается выделение, причём в пределах одного экрана. Старое поведение (одно окно захвата на все мониторы) убрали намеренно, см. [release notes 14.0](https://sourceforge.net/projects/flameshot.mirror/files/v14.0.0/). Опция `captureActiveMonitor` убирает плашку, но снимает только монитор под курсором. Вернуть выделение через два монитора в 14.x нечем.

## Решение: откат на 13.3.0-2 и запрет обновления

В кэше pacman старой версии может не оказаться, тогда пакет берётся из Arch Linux Archive:

```bash
sudo pacman -U https://archive.archlinux.org/packages/f/flameshot/flameshot-13.3.0-2-x86_64.pkg.tar.zst
```

Запретить обновление: добавить `flameshot` в `IgnorePkg` в `/etc/pacman.conf`:

```
IgnorePkg = cmake flameshot
```

Перезапустить демон, иначе продолжит работать старый процесс:

```bash
pkill -x flameshot
```

Он поднимется сам при следующем `flameshot gui` через D-Bus activation.

Правило `for_window` из пункта 2 на 13.3 не нужно: там окно захвата и так занимает все мониторы, поэтому оно убрано. `useX11LegacyScreenshot=true` 13.3 игнорирует. Строку стоит оставить, она пригодится, если когда-нибудь всё же придётся обновиться до 14.

## Конфиг в dotfiles

`~/.config/flameshot` теперь симлинк на `~/dotfiles/.config/flameshot`:

```bash
ln -s ~/dotfiles/.config/flameshot ~/.config/flameshot
```

Биндинг в `~/.config/i3/keyboard` не менялся (про `QT_QPA_PLATFORMTHEME` см. раздел flameshot-save-dialog-with-yazi в `~/CLAUDE.md`):

```
bindsym $mod+shift+y exec env QT_QPA_PLATFORMTHEME=xdgdesktopportal flameshot gui
```

## Диагностика

```bash
pacman -Q flameshot                      # должна быть 13.3.0-2
pgrep -al flameshot                      # висящий демон
pkill -x flameshot; /usr/bin/flameshot   # демон в терминале, видно ошибки
flameshot gui                            # в соседнем терминале
```

## Перед обновлением до 14+

Проверить в changelog, вернули ли выделение через несколько мониторов. Если обновляться:
- `useX11LegacyScreenshot=true` уже лежит в `flameshot.ini`;
- вернуть правило i3 из пункта 2 (в `~/.config/i3/workspaces`).
