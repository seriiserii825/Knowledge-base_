# install stow in arch

```bash
sudo pacman -S stow
```

## stow command

```bash
stow . -v
```

### if package already exists

```bash
stow -D .          # remove all symlinks stowed from current folder
stow .             # create fresh symlinks
```
