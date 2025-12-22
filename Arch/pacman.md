# downgrade package

```
yay -S downgrade
sudo downgrade flameshot
```

/etc/pacman.conf
ignore package

```
[options]
IgnorePkg = package_name
```

<!-- 1️⃣ Обновить список зеркал автоматически -->

```bash
sudo pacman -S reflector
```

```bash
sudo reflector \
         --country Moldova,Romania,Ukraine,Germany \
         --protocol https \
         --latest 10 \
         --sort rate \
         --save /etc/pacman.d/mirrorlist
```

Если Moldova нет — нормально, он просто пропустит

### 2️⃣ Синхронизировать базы

```bash
sudo pacman -Syyu
```

### 3️⃣ Обновить систему

```bash
sudo reflector --latest 20 --protocol https --sort rate --save /etc/pacman.d/mirrorlist
sudo pacman -Syu
```

# Remove VLC and its dependencies on Arch Linux

```bash

pacman -Qq | grep -E '^(libvlc|phonon-qt6|phonon-qt6-vlc|vlc-plugin-.+|vlc-plugins-base)$' \
| sudo xargs -r pacman -Rns --
```

```
/etc/pacman.conf
```

### package corrupted

sudo pacman -Sy archlinux-keyring && sudo pacman -Syu

### uncomment line

```
#Color
```

## update packages

```
sudo pacman -Syu
```

### remove with dependencies

```
sudo pacman -Rns package_name
```

## To differentiate between native packages (those available in the official repositories) and foreign packages (manually installed or not available in the repositories), use:

pacman \-Qen \# for native packages
pacman \-Qem \# for foreign packages
