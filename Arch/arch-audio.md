sudo pacman -S pipewire pipewire-pulse pavucontrol

sudo systemctl enable --now bluetooth

systemctl --user enable pipewire pipewire-pulse wireplumber
systemctl --user start pipewire pipewire-pulse wireplumber

## pair bluetooth devices

sudo pacman -S pavucontrol

## blueman

sudo pacman -S blueman

