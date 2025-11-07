# install

```bash
npm install husky --save-dev

npx husky init
```

## Manually create your hook file, e.g. .husky/pre-commit, and inside it add your commands:

```bash

#!/usr/bin/env sh
. "$(dirname "$0")/_/husky.sh"

npm run format:scss && npm run type:check
```

## chmod

```bash
chmod +x .husky/pre-commit
```

# package.json scripts

```json

"scripts": {
  "prepare": "husky"
}
```
