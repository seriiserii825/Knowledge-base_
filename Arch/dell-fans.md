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
