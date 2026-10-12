# Install go

```bash
sudo pacman -S go
go version
```

## install go language server

```bash
go install golang.org/x/tools/gopls@latest
```

## path to .zshrc

```bash
echo 'export PATH="$(go env GOPATH)/bin:$PATH"' >> ~/.zshrc
gopls version
```

## neovim config

```json
{
  "languageserver": {
    "golang": {
      "command": "gopls",
      "rootPatterns": ["go.work", "go.mod", ".git"],
      "filetypes": ["go"],
      "initializationOptions": {
        "usePlaceholders": true,
        "completeUnimported": true
      }
    }
  },
  "coc.preferences.formatOnSaveFiletypes": ["go"]
}
```
