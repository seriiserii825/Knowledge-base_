## install

Install tmux

## install tmp

You can install TPM by cloning its GitHub repository into your home directory. Here are the commands to do so:

```
git clone https://github.com/tmux-plugins/tpm ~/.tmux/plugins/tpm
```

### Configure tmux:

### Edit your tmux configuration file (usually ~/.tmux.conf or ~/.tmux.conf.local) and add the following lines to load TPM:

# List of plugins
set -g @plugin 'tmux-plugins/tpm'

# Initialize TPM (add this line at the bottom of your tmux.conf)
run '~/.tmux/plugins/tpm/tpm'

### Save and Source:

### Save your configuration file, and then either restart tmux or run the following command to source the configuration changes:

tmux source-file ~/.tmux.conf

# List of plugins

set -g @plugin 'tmux-plugins/tpm'

# Initialize TPM (add this line at the bottom of your tmux.conf)

run '~/.tmux/plugins/tpm/tpm'

## new session

tmux kill-server // remove all sessions
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

prefix = C-b

prefix I - install
prefix U - uninstall
<C-m> toggle mouse

## prefix s

: new -s session_name

## check if tmux session is running

tmux display-message -p '#S'

## session

prefix s - session list
prefix C - create session
prefix $ - rename session
prefix g - switch session
prefix , - rename tab

## kill session

prefix s - session list
: kill-session
