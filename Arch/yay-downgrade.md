## 🚫 Как запретить обновление этого пакета

Открой /etc/pacman.conf:

```bash
sudo nano /etc/pacman.conf
```

## Найди секцию [options] и добавь туда:

```bash
IgnorePkg = flameshot-old
```

## Вариант А — через утилиту downgrade (проще)


```bash
yay -S downgrade
sudo downgrade flameshot
# выбери 12.1.0-6 из списка (утилита скачает из Arch Linux Archive и установит)
```
