### install apps

```
sudo pacman -S polkit dunst lxsession
yay -S xfce-polkit
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


- Install the required packages with:
    
    bash
    
    Copy code
    
    `sudo pacman -S polkit lxpolkit`
    
    Alternatively, you can use `polkit-gnome` if you prefer:
    
    bash
    
    Copy code
    
    `sudo pacman -S polkit-gnome`
    
- **Start the Polkit Authentication Agent:**
    
    You need to start the authentication agent as part of your i3 session. Add the following line to your i3 configuration file (`~/.config/i3/config` or `~/.i3/config`):
    
    - For `lxpolkit`:
        
        bash
        
        Copy code
        
        `exec --no-startup-id lxpolkit`
        
    - For `polkit-gnome`:
        
        bash
        
        Copy code
        
        `exec --no-startup-id /usr/lib/polkit-gnome/polkit-gnome-authentication-agent-1`
        
    
    This ensures the authentication agent starts when i3 starts.
    
- **Verify Polkit Service:**
    
    Ensure the Polkit service is running:
    
    bash
    
    Copy code
    
    `systemctl status polkit.service`
    
    If it’s not running, start it with:
    
    bash
    
    Copy code
    
    `sudo systemctl start polkit.service`
    
    And enable it to start on boot:
    
    bash
    
    Copy code
    
    `sudo systemctl enable polkit.service`
