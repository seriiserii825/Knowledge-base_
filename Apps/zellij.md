### kill session

To kill a Zellij session, you can use the following command in your terminal:

```bash
ctrl + q
```

Kill all existing sessions:

```bash
zellij kill
```

### dump current layout to file

To dump the current layout of your Zellij session to a file, you can use the following command:

```bash
zellij action dump-layout > layout.kdl
```

remove path from file and save to ~/.config/zellij/layouts/layout-name

after call inside any folder

```bash
zellij --l layout-name
```
