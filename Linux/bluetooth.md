## install bluetooth
sudo pacman -S bluez bluez-utils usbutils

## start bluetooth service
sudo systemctl start bluetooth.service
sudo systemctl enable bluetooth.service
sudo systemctl status bluetooth.service

## connect to device
bluetoothctl
power on
agent on
default-agent
devices
scan on
pair 34:88:5D:51:5A:95 (34:88:5D:51:5A:95 is my device code,replace it with yours)
trust 34:88:5D:51:5A:95
connect 34:88:5D:51:5A:95
scan off
remove 34:88:5D:51:5A:95

## change in file
sudo nvim /etc/bluetooth/main.conf 
AutoEnable=true

journalctl -xeu bluetooth.service

# microphone check
check when toggle mode in pavucontrol
pactl list short sources
parecord --device=bluez_source.5A_CC_BA_B1_C6_5E.handsfree_head_unit output.wav

https://discovery.endeavouros.com/audio/pipewire/2021/09/
