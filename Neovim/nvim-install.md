# set as default editor

sudo update-alternatives --all

curl -LO https://github.com/neovim/neovim/releases/latest/download/nvim.appimage
chmod u+x nvim.appimage

Move the file to the following location

sudo mv nvim.appimage nvim  
sudo mv nvim /usr/local/bin

which nvim
nvim --version
