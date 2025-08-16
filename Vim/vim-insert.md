# Insert

Commands to revert mistakes in insert mode.

```vim
<C-h> Delete character before cursor
<C-w> Delete word before cursor
<C-u> Delete all characters before cursor
<C-o> Execute one normal mode command
```

example:

```vim
iHello<C-o>zz - Insert "Hello" and then execute the `zz`
command to center the line.
```
