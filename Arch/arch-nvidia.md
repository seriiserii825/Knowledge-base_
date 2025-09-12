Пакетов `nvidia-470xx-*` больше нет в официальных репах Arch — они в **AUR**. Их ставят через `yay` (или другой AUR-helper). Вот что делать:

## 0) Обновись и посмотри ядро

`sudo pacman -Syu uname -r                                # версия ядра pacman -Qs 'linux.*headers'             # стоят ли заголовки?`
Если ты на обычном `linux`, поставь заголовки:
`sudo pacman -S linux-headers`
(если `linux-lts` → `sudo pacman -S linux-lts-headers`)

## 1) Установи AUR-helper (если ещё нет)

`sudo pacman -S --needed git base-devel git clone https://aur.archlinux.org/yay.git cd yay && makepkg -si`

## 2) Удали/отключи nouveau

`sudo pacman -Rns xf86-video-nouveau || true echo "blacklist nouveau" | sudo tee /etc/modprobe.d/blacklist-nouveau.conf sudo mkinitcpio -P`

## 3) Поставь драйвер 470xx из AUR

`yay -S nvidia-470xx-dkms nvidia-470xx-utils nvidia-470xx-settings`

> Если соберётся долго — это нормально (DKMS собирает модуль под твоё ядро).

## 4) (Опционально) включи DRM KMS для плавной графики

Добавь в параметры загрузки ядра (GRUB):
ini
Copy cod
`nvidia_drm.modeset=1 modprobe.blacklist=nouveau`
В `/etc/default/grub` в переменной `GRUB_CMDLINE_LINUX_DEFAULT`, затем:
`sudo grub-mkconfig -o /boot/grub/grub.cfg`

## 5) Минимальный Xorg конфиг (для i3/Xorg)

Создай файл:
`sudo tee /etc/X11/xorg.conf.d/10-nvidia.conf >/dev/null <<'EOF' Section "Device"   Identifier "Nvidia Card"   Driver     "nvidia"   Option     "AllowEmptyInitialConfiguration" EndSection EOF`

## 6) Перезагрузка

`reboot`

## 7) Проверка

`lspci -k | grep -A3 -E "VGA|3D"     # Kernel driver in use: nvidia nvidia-smi                           # должен показать твою GT 710 и версию драйвера glxinfo | grep "OpenGL renderer"     # должен быть NVIDIA, а не llvmpipe/nouveau`
