```
/etc/pacman.conf
```

### package corrupted
sudo pacman -Sy archlinux-keyring && sudo pacman -Syu

### uncomment line
```
#Color
```

## update packages
```
sudo pacman -Syu
```

### remove packages
```
sudo pacman -R package_name
```

### remove with dependencies
```
sudo pacman -Rs package_name
```

### Remove cached package files
sudo pacman -Sc  

# Remove orphaned package
sudo pacman -Rns $(pacman -Qtdq)   

## You can use the Pacman command with the `-Q` option to list all installed packages on your system. For example:

pacman \-Q

## For users interested in identifying explicitly installed packages, which are those installed by the user and not as dependencies, the command is:

pacman \-Qe

## To differentiate between native packages (those available in the official repositories) and foreign packages (manually installed or not available in the repositories), use:

pacman \-Qn \# for native packages
pacman \-Qm \# for foreign packages

## This command generates a list of all installed packages in two columns. If you want to show only the first column, which contains the package names, you can use the `awk` command to filter the output:

pacman \-Q | awk '{print $1}'

## To export the list to a file, you can redirect the output to a text file:

pacman \-Q | awk '{print $1}' \> package\_list.txt

## Pacman also allows for more refined searches using regular expressions:

pacman \-Qs regex
