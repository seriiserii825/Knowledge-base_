### install

```bash

sudo pacman -S tmux
```

### plugins

https://github.com/tmux-plugins/tpm

### install

```bash
git clone https://github.com/tmux-plugins/tpm ~/.tmux/plugins/tpm

```

### config

```bash
# ~/.tmux.conf

```

### install plugins for first time

```bash
# Press prefix + I (capital I, as in Install) to fetch the plugin.
```

### new session

#### from inside

```bash
# start a new session
prefix + s
:new -s session_name
```

#### from outside

```bash
tmux new -s session_name
```
