## 🧩 1. После установки системы

Сначала обнови систему и установи нужные базовые пакеты:

```bash
sudo pacman -Syu
sudo pacman -S base-devel git vim neovim
```

## ⚙️ 2. Установка видеодрайвера NVIDIA (ветка 470xx)

Для старых карт вроде GeForce GT 710 нужен драйвер 470xx — он ставится из AUR.

Если у тебя ещё нет yay:

```bash
git clone https://aur.archlinux.org/yay.git
cd yay
makepkg -si
```

## Теперь установи драйверы:

```bash
yay -S nvidia-470xx-dkms nvidia-470xx-utils lib32-nvidia-470xx-utils nvidia-470xx-settings
```

## 🧠 3. Обязательно обнови initramfs

```bash
sudo mkinitcpio -P
```

## 🚫 4. Отключи nouveau

Создай файл:

```bash
echo 'blacklist nouveau' | sudo tee /etc/modprobe.d/blacklist-nouveau.conf
```

## 🧩 5. Разреши NVIDIA DRM KMS

(нужно для корректной работы Xorg и tty)

```bash
echo 'options nvidia_drm modeset=1' | sudo tee /etc/modprobe.d/nvidia.conf
sudo mkinitcpio -P
```

🖼️ 6. Настрой Xorg для NVIDIA
Создай каталог (если нет):

```bash
sudo mkdir -p /etc/X11/xorg.conf.d
sudo touch /etc/X11/xorg.conf.d/01-nvidia-path.conf:
```

```bash
sudo vim /etc/X11/xorg.conf.d/01-nvidia-path.conf
```

Вставь:

```bash
Section "Files"
ModulePath "/usr/lib/nvidia/xorg"
ModulePath "/usr/lib/xorg/modules"
EndSection
```

Создай файл /etc/X11/xorg.conf.d/10-nvidia.conf:

```bash
sudo nano /etc/X11/xorg.conf.d/10-nvidia.conf
```

Вставь:

```bash
Section "Device"
Identifier "NVIDIA Card"
Driver "nvidia"
VendorName "NVIDIA Corporation"
EndSection
```

## 🔁 7. Перезагрузка

```bash
sudo reboot
```

## ✅ 8. Проверка после входа

Проверь, что Xorg подхватил NVIDIA:

```bash
grep -E "ModulePath|glxserver_nvidia" /var/log/Xorg.0.log
```

Проверь OpenGL:

```bash
glxinfo | grep "OpenGL renderer"
```

## ✅ Должно быть:

OpenGL renderer string: NVIDIA GeForce GT 710/PCIe/SSE2

## 🪄 9. Уведомление при старте i3 (опционально)

Добавь в ~/.config/i3/config:

```bash
exec --no-startup-id bash -lc 'sleep 2; ~/.local/bin/gpu-notify.sh'
```

(Скрипт gpu-notify.sh ты уже создал ранее.)

## 🧰 10. Дополнительные утилиты

```bash
sudo pacman -S nvidia-utils nvidia-settings vulkan-tools mesa-utils
```

Проверить Vulkan:

vulkaninfo | grep "deviceName"
