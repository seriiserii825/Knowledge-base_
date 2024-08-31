## plugins
Plug 'puremourning/vimspector'

## install pip globaly
sudo nvim /etc/pip.conf
Add following line:
[global]
break-system-packages = true

## terminal
pip3 install --upgrade pip setuptools

## inside neovim
:VimspectorInstall debugpy
