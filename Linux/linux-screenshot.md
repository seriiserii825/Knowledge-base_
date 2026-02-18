### install

```bash
sudo pacman -S grim slurp swappy
```

### use in hyprland

```bash
bind = $mainMod SHIFT, Y, exec, grim -g "$(slurp)" - | swappy -f -
```
