# Remove VLC and its dependencies on Arch Linux

```bash

pacman -Qq | grep -E '^(libvlc|phonon-qt6|phonon-qt6-vlc|vlc-plugin-.+|vlc-plugins-base)$' \
| sudo xargs -r pacman -Rns --
```
```
/etc/pacman.conf
```

### package corrupted
sudo pacman -Sy archlinux-keyring && sudo pacman -Syu

### uncomment line
```
#Color
```

## update packages
```
sudo pacman -Syu
```

### remove with dependencies
```
sudo pacman -Rns package_name
```
## To differentiate between native packages (those available in the official repositories) and foreign packages (manually installed or not available in the repositories), use:

pacman \-Qen \# for native packages
pacman \-Qem \# for foreign packages

