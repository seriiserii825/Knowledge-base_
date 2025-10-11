# Remove VLC and its dependencies on Arch Linux

```bash

pacman -Qq | grep -E '^(libvlc|phonon-qt6|phonon-qt6-vlc|vlc-plugin-.+|vlc-plugins-base)$' \
| sudo xargs -r pacman -Rns --
```
