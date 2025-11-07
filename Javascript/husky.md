Awesome—here’s a clean, copy-pasteable setup for **Husky v9+** from zero, using your SCSS formatter and `vue-tsc` type check. This uses **Bun** (I’ll note npm/yarn variants too).

# 1) Install Husky

bash

Copy code

`# choose ONE of these bun add -D husky # npm i -D husky # yarn add -D husky`

# 2) Add the prepare script

Add/keep this in `package.json`:

json

Copy code

`{   "scripts": {     "prepare": "husky"   } }`

# 3) Initialize Husky

This creates the `.husky/` folder and wiring.

bash

Copy code

`bun run prepare # or: npx husky install`

# 4) Create the pre-commit hook

Create file: `.husky/pre-commit` (no subfolder like `_/`, no sourcing!)

bash

Copy code

`#!/usr/bin/env sh  # Stop on first failure set -e  # Run your checks bun run format:scss bun run type:check  echo "✅ Pre-commit checks passed"`

Make it executable:

bash

Copy code

`chmod +x .husky/pre-commit`

> **Important (v9+):** Do **NOT** include the deprecated lines
> 
> bash
> 
> Copy code
> 
> `. "$(dirname -- "$0")/_/husky.sh"`
> 
> and you don’t need a `.husky/_` directory at all.

# 5) Remove old config

Delete the old, ignored block from `package.json`:

json

Copy code

`"husky": {   "hooks": {     "pre-commit": "npm run format:scss && npm run type:check"   } }`

# 6) Verify Husky is active

bash

Copy code

`git config --get core.hooksPath # should print: .husky`

If it doesn’t:

bash

Copy code

`git config core.hooksPath .husky`

# 7) Test it

Make a tiny, intentional SCSS error, then:

bash

Copy code

`git add -A git commit -m "test husky"`

