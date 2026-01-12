### create as script

```bash
// scripts/update.sh
#!/bin/bash
source ~/.nvm/nvm.sh
nvm use 22
git pull
bun install
bun run build
pm2 restart sondaggio
```

make it executable

```bash
chmod +x scripts/update.sh
```

in package.json

```json
"scripts": {
    "update": "./scripts/update.sh"
}
```
