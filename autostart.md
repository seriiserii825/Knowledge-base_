#start disks
lsblk

#errors 
systemd-analyze critical-chain

#time to start
systemd-analyze blame

#
sudo blkid -c /dev/null

cat /etc/fstab
