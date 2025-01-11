## install

```bash
curl -fsSL https://get.pnpm.io/install.sh | env PNPM_VERSION=10.0.0 sh -
```

## install nuxi

```bash
pnpm install nuxi -g
```

## install dependencies

```bash
pnpm install --shamefully-hoist
```

## config

.npmrc in project root

```bash
engine-strict=true
```
package.json

```json
{
  "engines": {
    "node": "18.19.0"
  }
}
```
