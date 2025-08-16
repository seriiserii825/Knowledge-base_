# Insert

Commands to revert mistakes in insert mode.

```vim
<C-h> Delete character before cursor
<C-w> Delete word before cursor
<C-u> Delete all characters before cursor
<C-o> Execute one normal mode command
<C-r>+ Insert register content
<C-r>= Evaluate expression and insert result
R - Enter replace mode
<C-v>{symbol} - Insert a special character
```

## insert dollar and euro sign

```vim
<C-v>u0024 - Insert dollar sign
<C-v>u20ac - Insert euro sign
```

## Calculating aspect ration(float)

```vim
<C-r>=640/200.0<CR>
```

## replace mode

```vim
RHello - Enter replace mode and type "Hello", replacing existing text.
```

## Centering text in insert mode

```vim
iHello<C-o>zz - Insert "Hello" and then execute the `zz`
command to center the line.
```
