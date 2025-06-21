# Install

```bash
yay -S oh-my-posh
```

## add font

```bash
oh-my-posh font install meslo
```

### in .zshrc add path to config file

```bash
eval "$(oh-my-posh init zsh --config ~/.config/ohmyposh/base.toml)"
```

### config

create directory

```bash
mkdir ~/.config/ohmyposh
```

copy config json file

```bash
oh-my-posh config --format toml export --output ~/.config/ohmyposh/base.toml
```
