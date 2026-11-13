## check disk health

```bash
sudo smartctl -a -d sat /dev/sdc | grep -iE "overall-health|Device Model|Power_On_Hours|Reallocated|Pending|Uncorrectable|CRC_Error|Spin_Retry|Start_Stop|G-Sense|Load_Cycle|Seek_Error|Raw_Read|ATA Error Count|Power_Cycle"
```
