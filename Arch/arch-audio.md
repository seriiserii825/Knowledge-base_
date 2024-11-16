sudo pacman -S pipewire pipewire-pulse pavucontrol
systemctl --user enable pipewire pipewire-pulse wireplumber
systemctl --user start pipewire pipewire-pulse wireplumber
