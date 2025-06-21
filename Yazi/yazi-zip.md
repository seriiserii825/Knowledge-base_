# install

## link

```bash

https://github.com/ndtoan96/ouch.yazi
```

```bash
yay -S ouch
```

### install package

```bash
ya pack -a ndtoan96/ouch
```

### yazi.toml

```toml

[plugin]
prepend_previewers = [
# Archive previewer
{ mime = "application/*zip",            run = "ouch" },
{ mime = "application/x-tar",           run = "ouch" },
{ mime = "application/x-bzip2",         run = "ouch" },
{ mime = "application/x-7z-compressed", run = "ouch" },
{ mime = "application/x-rar",           run = "ouch" },
{ mime = "application/x-xz",            run = "ouch" },
{ mime = "application/xz",              run = "ouch" },
]
```

### keymap.toml

```toml
[[mgr.prepend_keymap]]
on = ["C"]
run = "plugin ouch"
desc = "Compress with ouch"
```

## extract, by default is o(open)
