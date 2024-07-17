## install
```bash
sudo pacman -Syyu lightdm
sudo pacman -S lightdm-gtk-greeter
sudo systemctl enable lightdm
```

## Enable the greeter
```bash
sudo vim /etc/lightdm/lightdm.conf
“#greeter-session=example-gtk-gnome”
greeter-session=lightdm-gtk-greeter
```

Note: if the test fails, you will need to edit the configuration file and determine what went wrong.

```

lightdm --test-mode --debug
```
