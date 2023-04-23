## install

Install tmux

## install tmp

git clone https://github.com/tmux-plugins/tpm ~/.tmux/plugins/tpm

## new session

tmux new-session -s test
prefix d - detach from session
tmux attach -t test - connect to session

## new window

prefix c - new window
prefix n,p - next prev window
prefix n - window number

## reload conf

tmux source ~/.tmux.conf

## mapping

prefix I - install
prefix U - uninstall
<C-m> toggle mouse

## session

prefix s - session list
prefix C - create session
prefix $ - rename session
prefix g - switch session
prefix , - rename tab

## kill session

prefix s - session list
: kill-session
