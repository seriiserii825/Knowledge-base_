# Arch Linux: RAM, ZRAM и earlyoom

## Проверка памяти

```bash
free -h
swapon --show
zramctl
```

В `free -h` ориентируйся прежде всего на `available`: это приблизительный объём памяти, доступный новым приложениям. `buff/cache` — кэш, который Linux может освобождать по мере необходимости. Если строка `Swap` показывает `0B`, активного Swap нет.

Процессы по потреблению RAM:

```bash
ps aux --sort=-%mem | head -15
htop
```

Мониторинг в реальном времени:

```bash
watch -n 1 free -h
```

## Если система уже зависла

1. Попробуй `Ctrl + Alt + F3` для перехода в текстовую консоль (TTY).
2. Войди и найди наиболее прожорливый процесс: `ps aux --sort=-%mem | head`.
3. Заверши его командой `kill PID`; если не помогло — `kill -9 PID` (можно потерять несохранённые данные).
4. Если клавиатура поддерживает Magic SysRq и эта функция включена: `Alt + SysRq (PrtSc) + F` запускает OOM killer. На ноутбуках иногда нужен `Fn`.
5. Если ничего не реагирует, остаётся принудительное выключение удержанием кнопки питания. Это крайняя мера.

## ZRAM — сжатый Swap в RAM

ZRAM позволяет хранить страницы Swap в сжатом виде в оперативной памяти. Он не резервирует весь указанный объём сразу и не использует диск; при сжатии расходует ресурсы процессора.

Установка:

```bash
sudo pacman -S zram-generator
sudo nano /etc/systemd/zram-generator.conf
```

Содержимое файла:

```ini
[zram0]
zram-size = ram / 2
compression-algorithm = zstd
```

Применение:

```bash
sudo systemctl daemon-reload
sudo systemctl start systemd-zram-setup@zram0.service
```

Проверка:

```bash
free -h
swapon --show
zramctl
```

Для системы с примерно 15–16 GiB RAM получаем около 7.8 GiB логического Swap. `USED: 0B` означает, что сейчас он не используется — это нормально. После перезагрузки конфигурация будет применяться автоматически.

## earlyoom — защита от зависаний

`earlyoom` контролирует нехватку RAM и Swap, чтобы раньше ядра завершить один из процессов. Он работает и без Swap.

```bash
sudo pacman -S earlyoom
sudo systemctl enable --now earlyoom
```

Проверка и журнал:

```bash
systemctl is-active earlyoom
systemctl status earlyoom
journalctl -u earlyoom -b
```

По умолчанию при одновременном снижении **доступной RAM и свободного Swap** ниже ~10% он отправляет выбранному процессу `SIGTERM`, а ниже ~5% — `SIGKILL`. Выбирает процесс по оценке OOM, не обязательно самый большой. Несохранённые данные могут потеряться.

При желании можно увеличить пороги. Сначала проверь настройки установленной службы:

```bash
systemctl cat earlyoom
```

Если служба читает `/etc/default/earlyoom`, там можно задать:

```bash
EARLYOOM_ARGS="-m 15,8 -s 15,8"
```

Здесь 15% — порог `SIGTERM`, 8% — `SIGKILL`, отдельно для памяти и Swap. После изменения:

```bash
sudo systemctl restart earlyoom
```

Обычно разумно сначала оставить стандартные пороги.

## Итоговая проверка

```bash
free -h
swapon --show
zramctl
systemctl is-active earlyoom
```

Пример успешной настройки:

```text
Mem:     15Gi total, 4.6Gi used, 10Gi available
Swap:   7.8Gi total, 0B used
/dev/zram0: zstd, 7.8G, PRIO 100
earlyoom: active
```

**Итог:** ZRAM помогает эффективнее использовать память благодаря сжатию; earlyoom снижает риск зависания при её нехватке. Полной гарантии от зависаний нет.

## Ссылки

- [ArchWiki: ZRAM](https://wiki.archlinux.org/title/Zram)
- [zram-generator](https://github.com/systemd/zram-generator)
- [earlyoom](https://github.com/rfjakob/earlyoom)
