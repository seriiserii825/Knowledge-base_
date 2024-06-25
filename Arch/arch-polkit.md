### install apps

```
sudo pacman -S polkit dunst lxsession
```

connect dunstrc to .config

### .xinitrc at the end
```
dunst &
lxsession &
```

## xservers
```

cp /etc/X11/xinit/xserverrc ~/.xserverrc
```

at the end  of file add:
```
exec /usr/bin/Xorg -nolisten tcp "$@" vt$XDG_VTNR
```


