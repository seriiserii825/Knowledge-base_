https://linoxide.com/how-to-install-nvidia-driver-on-ubuntu/

sudo apt-get install ubuntu-drivers-common

sudo ubuntu-drivers devices

sudo apt install nvidia-driver-390

reboot

nvidia-smi

#================== arch
https://www.archlinuxuser.com/2013/01/installing-nvidia-driver-on-archlinux.html

# Installing Nvidia Driver on Archlinux

Article by 2LapsTimeTrial di  [4:29:00 PM](https://www.archlinuxuser.com/2013/01/installing-nvidia-driver-on-archlinux.html "permanent link") 

The nvidia driver is available on Archlinux repository. And it is recommended to use package from repository to prevent problem when upgrading archlinux system.  

To install it there are two different packages:

## **Installing NVidia Propietary driver:**

> $sudo su  
> #pacman -S nvidia nvidia-utils

  
For this example, i'm using NVidia 9300GS  

(adsbygoogle = window.adsbygoogle || \[\]).push({}); (adsbygoogle = window.adsbygoogle || \[\]).push({});

[![Installing Nvidia Driver on Archlinux](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEinnbPZJyOe9XYwuxuhE1JacH0xWkExHLGAtc-3sE8JJOvTMqO9RwumZ4ntuXfTW_LUyfzOyH6Zd0CynkXztZbPtEMkatKyKyW8fRnlP-z0N7ghYo7g5kqjpEi4SbPw6w1149KT4yixtSoM/s1600/664712247.jpg "Installing Nvidia Driver on Archlinux")](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEinnbPZJyOe9XYwuxuhE1JacH0xWkExHLGAtc-3sE8JJOvTMqO9RwumZ4ntuXfTW_LUyfzOyH6Zd0CynkXztZbPtEMkatKyKyW8fRnlP-z0N7ghYo7g5kqjpEi4SbPw6w1149KT4yixtSoM/s1600/664712247.jpg)

  
  
With Nvidia utilities, i can set twinview easily.  
  

[![Installing Nvidia Driver on Archlinux](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgChyphenhyphenTFg9qHuau2vofJcZpkNobpET2QB3C3OYjEBQW06OEFcXqF5PLfgiqYQLx_R1S5APOmyZDJkaZ_iMgYbc1LXnKxIpw6b69L2HTZfARwnSngvw-7U36umSE1iKt_MHG1O9Sh2sOOFzJP/s1600/178486010.jpg "Installing Nvidia Driver on Archlinux")](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgChyphenhyphenTFg9qHuau2vofJcZpkNobpET2QB3C3OYjEBQW06OEFcXqF5PLfgiqYQLx_R1S5APOmyZDJkaZ_iMgYbc1LXnKxIpw6b69L2HTZfARwnSngvw-7U36umSE1iKt_MHG1O9Sh2sOOFzJP/s1600/178486010.jpg)

  
Note: Based On wiki, propietary driver not work on EFI system. Only Bios that work. The alternative way use open source driver below.  
  

## **Installing Nvidia Open source drivers:**

  

> #pacman -S libgl xf86-video-nouveau

  
If you have installed nvidia propietary  

> #pacman -Rdds nvidia nvidia-utils  
> \# pacman -S --asdeps libgl

  
To enable 3D acceleration:  

> #pacman -S nouveau-dri

for 64bit:  

> #pacman -S nouveau-dri lib32-noveau-dri

  
KMS is required, to add it,  

> #nano /etc/mkinitcpio.conf

add nouveau like this  
  

[![](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEj4Tf_84KT_kzaqHJYt5fRhnnt42l0RqL0oWsFUnVFViseYtBP1GbJscNqgsOfYoQd4M1oKcxmXrcCgjts-QnpwZMkqI09SqND_NC-kHRYmQq-Grj5akE0DqXYh_MuzUXT7gPYOTFbojqHy/s1600/Screenshot+from+2013-01-07+14:27:05.png)](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEj4Tf_84KT_kzaqHJYt5fRhnnt42l0RqL0oWsFUnVFViseYtBP1GbJscNqgsOfYoQd4M1oKcxmXrcCgjts-QnpwZMkqI09SqND_NC-kHRYmQq-Grj5akE0DqXYh_MuzUXT7gPYOTFbojqHy/s1600/Screenshot+from+2013-01-07+14:27:05.png)

  
  
save (ctrl+x), then  

> #mkinitcpio -p linux
