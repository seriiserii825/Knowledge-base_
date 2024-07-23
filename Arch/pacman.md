```
/etc/pacman.conf
```

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
