## install Windows 10 on USB drive

```
sudo pacman -S ntfs-3g
```

### 1\. **Unmount the USB Partition**

First, unmount the partition:

```
sudo umount /dev/sda1
```

### 2\. **Wipe the USB Drive**

To ensure a clean format, wipe the partition table:

```
sudo wipefs -a /dev/sda sudo dd if=/dev/zero of=/dev/sda bs=1M count=10
```

This clears any existing filesystem or partition data.

### 3\. **Create a New Partition Table**

Recreate the partition table as MBR (Master Boot Record):

```
sudo parted /dev/sda mklabel msdos
```

### 4\. **Create a New Partition**

Create a single primary partition:

```
sudo parted -a optimal /dev/sda mkpart primary ntfs 0% 100%
```

### 5\. **Format the Partition**

Format the new partition as exfat:

```
sudo mkfs.exfat -F /dev/sda
```
