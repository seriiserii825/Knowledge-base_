sudo pacman -S bluez bluez-utils pulseaudio-bluetooth usbutils

sudo systemctl start bluetooth.service
sudo systemctl enable bluetooth.service
sudo systemctl status bluetooth.service

sudo rfkill block bluetooth
sudo rfkill unblock bluetooth
sleep 1
bluetoothctl power on

https://stackoverflow.com/questions/48279646/bluetoothctl-no-default-controller-available
## install bluetooth driver
https://github.com/winterheart/broadcom-bt-firmware
yay -S broadcom-bt-firmware
sudo systemctl disable blueman-mechanism.service
sudo systemctl disable bluetooth-mesh.service
reboot

systemctl list-unit-files | grep blue

bluetoothctl
power on
agent on
devices
scan on
pair 34:88:5D:51:5A:95 (34:88:5D:51:5A:95 is my device code,replace it with yours)
trust 34:88:5D:51:5A:95
connect 34:88:5D:51:5A:95
remove 34:88:5D:51:5A:95

journalctl -xeu bluetooth.service

# microphone check
check when toggle mode in pavucontrol
pactl list short sources
parecord --device=bluez_source.5A_CC_BA_B1_C6_5E.handsfree_head_unit output.wav

https://discovery.endeavouros.com/audio/pipewire/2021/09/
