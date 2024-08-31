## plugins
Plug 'puremourning/vimspector'

cd autoload/plugged/vimspector
run
./install_gadget.py --all

## install pip globaly
sudo nvim /etc/pip.conf
Add following line:
[global]
break-system-packages = true

## terminal
pip3 install --upgrade pip setuptools

## inside neovim
:VimspectorInstall debugpy
