I have an old ASUS laptop. The SDD is fully clean, empty. The laptop used to have Windows on it. Now I want to install only Ubuntu.

The error I get is this and I cannot boot at all, nothing:

![Error](https://i.sstatic.net/lYn4H39F.png)

Reading different posts lead me to these possible solutions:

- Delete all secure boot variables and do F9 optimized defaults to reset all keys to factory settings? see image (2) ![image-2](https://i.sstatic.net/pP3QJjfg.png)
- Do SET new platform keys (KP)? see image (3) ![image-3](https://i.sstatic.net/6E62FGBM.png)
- Disable secure boot but how exactly? see image (1) ![image-1](https://i.sstatic.net/kVdTSEb8.png)
- The final solution after I did one of above three options is to boot from liveUSB to try Ubuntu, then I do following to remove boot entries (all then because I do not need any, everything can be removed!):

```
sudo apt-get install efibootmgr    
sudo efibootmgr -v    
sudo efibootmgr -b XXXX -B
```
