sudo nvim /etc/pacman.conf

Server = https://mirror.js-webcoding.de/pub/archlinux/$repo/os/$arch
Server = https://mirror.f4st.host/archlinux/$repo/os/$arch
Server = https://archmirror.tomforb.es/$repo/os/$arch
Server = https://mirrors.kernel.org/archlinux/$repo/os/$arch
Server = https://lug.mtu.edu/archlinux/$repo/os/$arch
Server = https://mirrors.ocf.berkeley.edu/archlinux/$repo/os/$arch


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

