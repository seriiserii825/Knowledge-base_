### If you have installed nvidia propietary

```
sudo pacman -Rdds nvidia nvidia-utils
sudo pacman -S --asdeps libgl
```

### install

```
sudo pacman -S libgl xf86-video-nouveau
```

To enable 3D acceleration:

```
sudo pacman -S nouveau-dri lib32-noveau-dri
```

### mkinitcpio
```
sudo nvim /etc/mkinitcpio.conf
add MODULES=(nouveau)
sudo mkinitcpio -p linux
```
restart


