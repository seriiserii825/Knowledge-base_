# install

```bash
sudo pacman -S alsa-lib alsa-plugins alsa-utils pulseaudio-alsa
```

# enable
```bash
sudo systemctl enable alsa-restore
in pavucontrol, set the default output device to the correct one
```
