### install packages

```bash
sudo pacman -S xclip rofi xdotool
yay -S greenclip
```

### i3config autostart

```bash
exec_always --no-startup-id greenclip daemon
```

### 3 scripts hotkeys

```bash

bindsym $mod+c exec --no-startup-id rofi -modi "clipboard:greenclip print" -show clipboard
bindsym $mod+v exec ~/Documents/bash/bash-scripts/paste-next.sh
bindsym $mod+b exec ~/Documents/bash/bash-scripts/paste-prev.sh
bindsym $mod+ctrl+shift+v exec echo "0" > /tmp/paste_stack_index
```
