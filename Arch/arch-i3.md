sudo pacman -S xorg xorg-xinit nvidia kitty vifm rofi mousepad 

Прописваешь exec i3~/.xinitrc для запуска i3.

## lightdm
sudo pacman -S lightdm lightdm-gtk-greeter
systemctl enablsudo pacman -S networkmanager

## networkmanager
sudo pacman -S network-manager-applet апплет для панели
sudo systemctl enable networkmanager.servicee lightdm
