### delete data from usb

```bash

sudo wipefs -a /dev/sdX  # Replace X with your USB drive letter
```

### usb to windows

```bash
sudo wipefs -a /dev/sda && sudo parted /dev/sda --script mklabel msdos mkpart primary fat32 1MiB 100% && sudo mkfs.fat -F32 /dev/sda1
```
