## install
Install tmux

## install tmp
git clone https://github.com/tmux-plugins/tpm ~/.tmux/plugins/tpm

## reload conf
tmux source ~/.tmux.conf

## mapping
prefix I - install
prefix U - uninstall
## session
prefix s - session list
prefix C - create session
prefix $ - rename session
prefix g - switch session
prefix , - rename tab
## kill session
prefix s - session list
: kill-session
