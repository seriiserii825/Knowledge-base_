## install Windows 10 on USB drive

```
sudo pacman -S exfatprogs
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

Delete Existing Partitions (if any):

Press d and confirm the partition number.
Repeat if there are multiple partitions.
Create a New Partition:

Press n for a new partition.
Choose p for primary.
Accept the defaults for partition number, first sector, and last sector (use the full disk).
Write Changes and Exit:

Press w to write the changes to the disk and exit.

### 5\. **Format the Partition**

Format the new partition as exfat:

```
sudo mkfs.exfat -F /dev/sda
```
