sudo pacman -S nvidia nvidia-utils nvidia-settings

## check driver
nvidia-smi
modinfo nvidia | grep ^version
inxi -G

