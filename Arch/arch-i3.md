## According to https://askubuntu.com/a/1236095/1912012, you should try editing

```

/etc/systemd/logind.conf
```

and set/add

```
HandleSuspendKey=ignore.
```
### install xstart

```
sudo pacman -S xorg xorg-xinit nvidia kitty vifm rofi mousepad
```

Прописваешь для запуска i3. в ~/.xinitrc

```
#!/bin/sh
exec i3 &
dunst &
lxsession
```

## make file executable

```
chmod +x .xinitrc
```

## lightdm

```
sudo pacman -S lightdm lightdm-gtk-greeter
systemctl enablsudo pacman -S networkmanager
```

## networkmanager

```
sudo pacman -S network-manager-applet
```
