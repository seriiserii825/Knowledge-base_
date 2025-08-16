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
