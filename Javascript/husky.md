# husky

## 1) Install Husky

```bash
bun add -D husky
```

## 2) Add the prepare script

Add/keep this in package.json:

```json
{
  "scripts": {
    "prepare": "husky"
  }
}
```

## 3) Initialize Husky

This creates the .husky/ folder and wiring.

```bash
bun run prepare
```

## 4. Create the pre-commit hook

Create file: .husky/pre-commit (no subfolder like \_/, no sourcing!)

```bash
#!/usr/bin/env sh
# Stop on first failure
set -e
# Run your checks
bun run format:scss
bun run type:check
echo "✅ Pre-commit checks passed"
```

Make it executable:

```bash
chmod +x .husky/pre-commit
```

## 6) Verify Husky is active

```bash
git config --get core.hooksPath
```

# should print: .husky

If it doesn’t:

```bash
git config core.hooksPath .husky
```

## 7) Test it

Make a tiny, intentional SCSS error, then:

```bash
git add -A
git commit -m "test husky"
```
