# install hunspell and dictionaries on Arch Linux

```
sudo pacman -S hunspell hunspell-en_us hunspell-it
```

## fix error run in terminal bash
```bash

# 1) Use clang++ (it understands that flag on many setups)
export CXX=clang++

# 2) Or strip the bad flag if it’s injected via env vars
export CXXFLAGS="${CXXFLAGS/-fdebug-default-version=4/}"
```
