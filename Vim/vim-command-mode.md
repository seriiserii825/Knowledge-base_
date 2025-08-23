# command mode

If you mean from Vim command line I would do:

```vim
:normal 10GV20G
```

To past right after line 14 I would do:

```vim
:14put
:78,40s/some/any/gic - i(case insensitive) c(ask for confirmation) I(case sensitive)
:22,28s/\<some\>/any/g - replace only whole words
```

## delete lines

that contains word "some"

```vim
:g/some/d
```

that does not contain word "some"

```vim
:v/some/d
```
