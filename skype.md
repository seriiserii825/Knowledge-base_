# install

wget https://repo.skype.com/latest/skypeforlinux-64.deb

# Hide window popup

settings -> calling -> Show call window when skype is in the background

# if restart

https://www.skype.com/ru/insider/

## skype sharing

1. echo $XDG_SESSION_TYPE
2. sudo nano /etc/gdm3/custom.conf
3. Remove “#” from “WaylandEnable=false” line on custom.conf file.
4. Reboot
