## install

Install tmux

## install tmp

You can install TPM by cloning its GitHub repository into your home directory. Here are the commands to do so:

```
git clone https://github.com/tmux-plugins/tpm ~/.tmux/plugins/tpm
```

## install plugins
```
Ctrl+b + I
```

## session
```
to create enter in tmux
ctrl+b + s - session list
: new -s session_name
```

### sessions in terminal
```
# Start a new tmux session.
tmux

# Start a new tmux session with name.
tmux new -s <session-name>

# List all sessions.
tmux ls

# Attach to the last session.
tmux attach

# Attach to a session with name.
tmux attach -t <session-name>

# Kill a session.
tmux kill-session -t <session-name>

# Kill sessions other than the current one.
tmux kill-session -a

# Kill sessions other than the named one.
tmux kill-session -a -t <session-name>
```

## session hotkeys
```
C-b d	Dettach from session
C-b s	Show all sessions
C-b $	Rename session
```

## windows hotkeys
```
C-b c	Create a new window
C-b p	Go to the previous window
C-b n	Go to the next window
C-b ,	Rename window
C-b &	Close window
C-b w	List window
C-b f	Find window
C-b l	Last window
C-b .	Move window
C-b 0...9
```

