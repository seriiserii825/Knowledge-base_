## view installed packages
```
yay -Qem
-Q - query installed packages
-e - only explicitly installed packages
-m - only installed packages from the AUR
```


## install

```
sudo pacman -S --needed git base-devel && git clone https://aur.archlinux.org/yay.git && cd yay && makepkg -si
```

**Interactively search and install packages from the repos and AUR**

$ yay \[package_name|search_term\]

![copy](/images/icon-copy.svg)

**Synchronize and update all packages from the repos and AUR**

$ yay

![copy](/images/icon-copy.svg)

**Synchronize and update only AUR packages**

$ yay -Sua

![copy](/images/icon-copy.svg)

**Install a new package from the repos and AUR**

$ yay -S \[package\]

![copy](/images/icon-copy.svg)

**Remove an installed package and both its dependencies and configuration files**

$ yay -Rns \[package\]

![copy](/images/icon-copy.svg)

**Search the package database for a keyword from the repos and AUR**

$ yay -Ss \[keyword\]

![copy](/images/icon-copy.svg)

**Remove orphaned packages (installed as dependencies but not required by any package)**

$ yay -Yc

![copy](/images/icon-copy.svg)

**Show statistics for installed packages and system health**

$ yay -Ps

![copy](/images/icon-copy.svg)
