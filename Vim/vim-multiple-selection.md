You could also define your own custom operator which would yank incrementally any text-object or text covered by a motion:

```
fu! Incremental_yank(type, ...) abort
    if a:type ==# 'char'
        norm! `[v`]y
    elseif a:type ==# 'line'
        norm! '[V']y
    elseif a:0
        norm! gvy
    endif

    call setreg('z', @".(a:type ==# 'char' ? ' ' : ''), 'a' . getregtype('"'))
    call setreg('"', @z, getregtype('z'))
endfu

nno <silent> zy  :<C-U>set opfunc=Incremental_yank<CR>g@
xno <silent> zy  :<C-U>call Incremental_yank(visualmode(), 1)<CR>
nno <silent> zyy :<C-U>set opfunc=Incremental_yank<Bar>exe 'norm! '.v:count1.'g@_'<CR>

nno <silent> zyc :<C-U>let [@", @z] = ['', '']<CR>p
```

---

In this example, 4 key bindings are installed:

- `zy` normal operator to incrementally yank a text-object or motion
- `zyy` similar operator which works on lines
- `zy` similar operator which works on visual selection
- `zyc` normal command to empty the registers `"` and `z`; useful before beginning to yank a sequence of texts

With it, you could:

- copy some words hitting `zyiw` on the first word, then repeat the operation with the dot command on the next ones
- copy some lines hitting `zyy` on the first one, then repeat the operation with the dot command on the next ones
- copy some visual selections, hitting `zy` on each of them

The current code clutters the `z` register, if you prefer using another register, like `x` for example, you could change the following lines:

```
call setreg('z', @", 'a' . getregtype('"'))                call setreg('x', @", 'a' . getregtype('"'))
             ^                                                          ^
call setreg('"', @z, getregtype('z'))                 →    call setreg('"', @x, getregtype('x'))
                  ^              ^                                           ^              ^
nno <silent> zyc :<C-U>let [@", @z] = ['', '']<CR>p        nno <silent> zyc :<C-U>let [@", @x] = ['', '']<CR>p
                                 ^                                                          ^
```

---

For more information, see:

```
:h g@
:h getregtype()
:h setreg()
```
