# Arch Linux: защита от зависаний при нехватке RAM

Схема: **ZRAM** сжимает редко используемую память, **earlyoom** закрывает процесс, когда RAM почти кончилась, — до того, как система зависнет.

## Шаг 1. ZRAM — сжатый swap в RAM

Установить:

```bash
sudo pacman -S zram-generator
```

Создать `/etc/systemd/zram-generator.conf`:

```ini
[zram0]
zram-size = ram / 2
compression-algorithm = zstd
```

Запустить (после перезагрузки поднимается сам):

```bash
sudo systemctl daemon-reload
sudo systemctl start systemd-zram-setup@zram0.service
```

Проверить:

```bash
zramctl         # /dev/zram0 zstd 7.8G ... [SWAP]
swapon --show   # zram0 с PRIO 100
```

Диск не используется; память под zram занимается по мере заполнения.

## Шаг 2. swappiness — чтобы ZRAM реально использовался

По умолчанию `vm.swappiness = 60`, и ядро неохотно сжимает память в zram. Для zram ArchWiki советует 180:

```bash
echo 'vm.swappiness = 180' | sudo tee /etc/sysctl.d/99-zram.conf
sudo sysctl --system
```

Проверить:

```bash
cat /proc/sys/vm/swappiness   # 180
```

## Шаг 3. earlyoom — закрывать процесс до зависания

Установить и включить:

```bash
sudo pacman -S earlyoom
sudo systemctl enable --now earlyoom
```

По умолчанию срабатывает, только когда **и** RAM, **и** swap < 10%. Со zram это поздно: пока zram заполнится, система уже тормозит. Поэтому настроить порог только по RAM.

В `/etc/default/earlyoom` добавить `-m 15,8 -s 100` в начало `EARLYOOM_ARGS`:

```bash
EARLYOOM_ARGS="-m 15,8 -s 100 -r 3600 -n --avoid '(^|/)(init|systemd|Xorg|sshd)$'"
```

- `-m 15,8` — `SIGTERM` при available RAM < 15% (~2.4 GiB из 16), `SIGKILL` при < 8%.
- `-s 100` — не ждать заполнения swap/zram.

Перезапустить и проверить:

```bash
sudo systemctl restart earlyoom
journalctl -u earlyoom -n 5   # "mem avail <= 15.00% and swap free <= 100.00%"
```

Если убивает слишком часто — снизить до `-m 10,5`.

## Итоговая проверка

```bash
free -h                         # Swap: 7.8Gi
zramctl
cat /proc/sys/vm/swappiness     # 180
systemctl is-active earlyoom    # active
```

## Диагностика

```bash
free -h                          # смотреть на available, не на free
ps aux --sort=-%mem | head -15   # самые прожорливые процессы
journalctl -u earlyoom -b        # кого и когда убил earlyoom
```

Если система всё же зависла:

1. `Ctrl + Alt + F3` → TTY, `ps aux --sort=-%mem | head`, `kill PID` (или `kill -9 PID`).
2. `Alt + SysRq + F` — ручной вызов OOM killer (если SysRq включён).
3. Крайняя мера — кнопка питания.

## Ссылки

- [ArchWiki: ZRAM](https://wiki.archlinux.org/title/Zram)
- [zram-generator](https://github.com/systemd/zram-generator)
- [earlyoom](https://github.com/rfjakob/earlyoom)
