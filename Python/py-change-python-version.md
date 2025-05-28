## install
sudo pacman -S pyenv
pyenv install 3.11.1
pyenv local 3.11.1
which python
python --version

## clear cache
hash -r
python --version

## in  zshrc

export PYENV_ROOT="$HOME/.pyenv"
export PATH="$PYENV_ROOT/bin:$PATH"
eval "$(pyenv init --path)"
eval "$(pyenv init -)"

## temporary remove alias
which python # if alias is present
unalias python

## remove alias from zshrc
