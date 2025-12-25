### TLP — самый простой вариант для тебя. Он автоматически управляет питанием и охлаждением.

Установка и запуск:

```bash
sudo pacman -S tlp
sudo systemctl enable tlp.service
sudo systemctl start tlp.service
```

Настройка (опционально): Открой /etc/tlp.conf и найди эти строки:

# Для работы от сети используй powersave вместо performance

```bash
CPU_SCALING_GOVERNOR_ON_AC=powersave
CPU_SCALING_GOVERNOR_ON_BAT=powersave
```

# Ограничь максимальную частоту при зарядке (например, 80%)

```bash
CPU_MAX_PERF_ON_AC=80
CPU_MAX_PERF_ON_BAT=50
```

После изменений:

```bash
sudo systemctl restart tlp.service
```

Всё. TLP сам будет контролировать температуру и шум. Если хочешь ещё тише — уменьши CPU_MAX_PERF_ON_AC до 70 или 60.
