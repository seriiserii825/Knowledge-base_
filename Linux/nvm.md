# NVM

## Install

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash
```

Restart terminal or reload shell config.

## Versions

```bash
nvm ls                 # installed
nvm ls-remote --lts    # available LTS
nvm current            # current version
```

## Install / Use / Remove

```bash
nvm install 22
nvm use 22
nvm uninstall 20
```

## Set default

```bash
nvm alias default 22
```

## NVM directory

```bash
echo "$NVM_DIR"
```

Example:

```text
/home/serii/.config/nvm
```
