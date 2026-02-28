### toggle to quiet

Выполни в терминале:

```bash
echo quiet | sudo tee /sys/firmware/acpi/platform_profile
```

Это переключит на тихий профиль. Вентилятор должен сразу замедлиться.

Если quiet будет слишком агрессивно тормозить (троттлинг), можешь попробовать balanced:

```bash
echo balanced | sudo tee /sys/firmware/acpi/platform_profile
```

### service to save fan profile

● Sudo требует терминал. Создам файл сервиса, а ты его скопируешь одной командой.

● Write(/tmp/platform-profile-quiet.service)
⎿  Wrote 10 lines to ../../tmp/platform-profile-quiet.service

```vim
[Unit]
Description=Set platform profile to quiet
After=multi-user.target

[Service]
Type=oneshot
ExecStart=/bin/bash -c 'echo quiet > /sys/firmware/acpi/platform_profile'

[Install]
WantedBy=multi-user.target
```

● Выполни в терминале:

```bash
sudo cp /tmp/platform-profile-quiet.service /etc/systemd/system/ && sudo systemctl enable platform-profile-quiet.service
```

Это создаст systemd-сервис, который при каждой загрузке будет ставить профиль quiet.
