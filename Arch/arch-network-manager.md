# enable networkmanager

```
sudo pacman -S linux-headers
```

# find driver

```
lspci -k
sudo pacman -S broadcom-wl networkmanager
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

### wifi

```
rfkill list
rfkill unblock wifi
ip link
ip link set wlan0 up
iwctl
device list
station wlan0 scan
station wlan0 get-networks
station wlan0 connect ИмяСети
quit
ping ya.ru
```
