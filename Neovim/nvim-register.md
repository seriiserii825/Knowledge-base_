# registers

## get register
```
a - name of register
"ayw

```

## view register
```
:reg a
:reg a b
```

## paster
```
"ap
"bp
```

## paste in insert mode
```
<C-R>a
<C-R>b
```


## list register
```
'"'	the unnamed register, containing the text of
  the last delete or yank
'%'	the current file name
'#'	the alternate file name
'*'	the clipboard contents (X11: primary selection)
'+'	the clipboard contents
'/'	the last search pattern
':'	the last command-line
'-'	the last small (less than a line) delete
'.'	the last inserted text
        *c_CTRL-R_=*
'='	the expression register: you are prompted to
  enter an expression (see |expression|)
  (doesn't work at the expression prompt; some
  things such as changing the buffer or current
  window are not allowed to avoid side effects)
  When the result is a |List| the items are used
  as lines.  They can have line breaks inside
  too.
  When the result is a Float it's automatically
  converted to a String.
  Note that when you only want to move the
  cursor and not insert anything, you must make
  sure the expression evaluates to an empty
  string.  E.g.: >
    <C-R><C-R>=setcmdpos(2)[-1]<CR>
```


