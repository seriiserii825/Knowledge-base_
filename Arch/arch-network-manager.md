# enable networkmanager
```
sudo pacman -S linux-headers

# find driver
lspci -k

sudo pacman -S broadcom-wl

sudo systemctl enable NetworkManager 
```



### list wifi
```
nmcli device wifi list
```

### connect to wifi
```
nmcli device wifi connect SSID password PASSWORD
```
