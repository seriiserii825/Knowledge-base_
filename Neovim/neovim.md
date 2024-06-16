# Neovim

## Install neovim 0.8 or later

```

<a href="https://github.com/neovim/neovim/wiki/Installing-Neovim" target="blank">Neovim 0.8</a>

download image
mv image to nvim
chmod u+x
mv nvim to /usr/bin
```

### backup

#### Make a backup of your current nvim folder

```
mv ~/.config/nvim ~/.config/nvim.bak
mv ~/.local/share/nvim ~/.local/share/nvim.bak
mv ~/.local/state/nvim ~/.local/state/nvim.bak
mv ~/.cache/nvim ~/.cache/nvim.bak
```

### format
```
gg=G
```

### errror
No Python executable found that can import neovim

Add at the end of init.vim
let g:python3_host_prog = "/usr/bin/python"

