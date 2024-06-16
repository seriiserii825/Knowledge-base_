## check disks 
grub> ls

### check disk for grub
```
grub> ls (hdX, Y)
Здесь X - номер диска, а Y - имя раздела. Например: grub> ls (hd0, gpt3) или grub> ls (hd1, msdos5)

File sistyem type ext*
```

## set root and prefix for grub
```
grub> set root=(hdX, Y)
grub> set prefix=(hdX, Y)/boot/grub
```

## install module for grub
```
grub> insmod normal
Запустите этот файл с модом для настройки вашего GRUB:

grub> normal
```

## after restart update grub
```
sudo grub-install /dev/sdXY
sudo update-grub
Здесь X - номер диска, а Y - номер раздела EFI-раздела. Если вы не знаете, какой раздел является разделом EFI, используйте Disks или GParted для проверки.
```

```
lsblk

nvme0n1     259:0    0 238.5G  0 disk 
├─nvme0n1p1 259:1    0   512M  0 part /boot/efi
└─nvme0n1p2 259:2    0   238G  0 part /var/snap/firefox/common/host-hunspell

sudo grub-install /dev/nvme0n1p1
```
