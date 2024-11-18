## need to be like this

```
lspci -k | grep -EA3 'VGA|3D|Display'
0000:00:02.0 VGA compatible controller: Intel Corporation Device a7ac (rev 04)
  Subsystem: Dell Device 0ca0
  Kernel driver in use: i915
  Kernel modules: i915, xe
```

## update system

```

sudo pacman -Syu
```

## Manually Load the i915 Module Load the module manually to associate it with your Intel GPU:

```

sudo modprobe i915

```

## Edit the Kernel Command Line

With systemd-boot, kernel parameters are added to the boot entry. Here’s how to do it:

Locate the boot entry configuration file in /boot/loader/entries/. For example:
ls /boot/loader/entries/
You should see a file like arch.conf.

Edit the file corresponding to your Linux kernel (e.g., arch.conf):

```

sudo nvim /boot/loader/entries/arch.conf
```

Add the following to the options line:

```

options ... i915.enable_guc=2
```

(Keep the existing options intact; just append i915.enable_guc=2.)

Example arch.conf file:

```

title Arch Linux
linux /vmlinuz-linux
initrd /initramfs-linux.img
options root=UUID=<your-root-uuid> rw i915.enable_guc=2
```

## Update Kernel
Your GPU (Raptor Lake-U) is a newer model that might require the latest kernel for proper support. Install the mainline kernel (linux) and headers:

```

sudo pacman -S linux linux-headers
```

Update your systemd-boot entry to use /vmlinuz-linux and /initramfs-linux.img, then reboot.

## Edit the Entry File
Open the configuration file for your entry (e.g., 2024-11-17_21-03-15_linux-lts.conf) with a text editor:

```

sudo nano /boot/loader/entries/2024-11-17_21-03-15_linux-lts.conf
```

Modify the linux and initrd paths to point to /vmlinuz-linux and /initramfs-linux.img:

```

title   Arch Linux (linux)
linux   /vmlinuz-linux
initrd  /initramfs-linux.img
options root=PARTUUID=85bb3f1e-c53d-4ef6-b97f-54d7469b612c rw rootfstype=ext4
```

Save and exit the editor.

Step 3: Add an Entry for Fallback (Optional)

If you have a fallback image, edit the fallback entry (e.g., 2024-11-17_21-03-15_linux-lts-fallback.conf) similarly:

```

sudo nano /boot/loader/entries/2024-11-17_21-03-15_linux-lts-fallback.conf
```

```

title   Arch Linux (linux-fallback)
linux   /vmlinuz-linux
initrd  /initramfs-linux-fallback.img
options root=PARTUUID=85bb3f1e-c53d-4ef6-b97f-54d7469b612c rw rootfstype=ext4
```

Save and exit the editor.

Step 4: Update loader.conf (Optional)
If needed, verify or update the default boot entry in /boot/loader/loader.conf:

```

sudo nano /boot/loader/loader.conf
```

Ensure it contains the following:

```

default 2024-11-17_21-03-15_linux-lts.conf
timeout 5
editor  yes
```
Replace 2024-11-17_21-03-15_linux-lts.conf with the correct entry filename if different.

Step 5: Reboot

Reboot the system and check if the updated kernel is used:

```

sudo reboot
```

After booting, verify the kernel in use:

```

uname -r
```

You should now see the kernel version corresponding to /vmlinuz-linux. Let me know if further assistance is needed!
