sudo pacman -S pipewire pipewire-pulse pipewire-alsa pipewire-jack wireplumber bluez bluez-utils

sudo systemctl enable --now bluetooth

systemctl --user enable pipewire pipewire-pulse wireplumber
systemctl --user start pipewire pipewire-pulse wireplumber

## pair bluetooth devices

sudo pacman -S pavucontrol

## blueman

sudo pacman -S blueman

## in tray

blueman-manager


sudo pacman -S bluez bluez-utils

sudo systemctl enable --now bluetooth

sudo nano /etc/wireplumber/main.lua.d/50-bluez-config.lua

default_profiles = {
    a2dp_sink = true,
    hsp_hs = true,  -- Enable HSP
    hfp_ag = true,  -- Enable HFP
}


systemctl --user restart wireplumber
systemctl --user restart pipewire pipewire-pulse
sudo systemctl restart bluetooth
