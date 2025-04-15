### keybindings

#### session

```bash
# start a new session
prefix + s
:new -s session_name
# with plugin
prefix + C

# switch session
prefix + g, or s

rename session
prefix + $

detach session
prefix + d

delete session
prefix + x
```

#### window

```bash
start a new window
prefix + c

rename window
prefix + ,


delete window
prefix + &

split window
prefix + |, or -

resize
prefix + l,j,k,h
```

## list sessions

```bash
tmux ls
```

## new session

```bash
tmux new -s session_name
```

## attach to session

```bash
tmux attach -t session_name
```

## kill session

```bash
tmux kill-session -t session_name
```

## kill tmux

```bash
tmux kill-server
```

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
