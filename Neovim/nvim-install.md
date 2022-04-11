# set as default editor

sudo update-alternatives --all

https://www.chrisatmachine.com/Neovim/01-vim-plug/

# Installing Neovim

## Ubuntu

sudo apt install neovim

#Create config
##Make directory for your Neovim config
mkdir ~/.config/nvim

##Create an init.vim file
touch ~/.config/nvim/init.vim

#Install vim-plug
curl -fLo ~/.config/nvim/autoload/plug.vim --create-dirs https://raw.githubusercontent.com/junegunn/vim-plug/master/plug.vim

#Add a new file for plugins
We will manage our plugins in a separate file for the sake of my own sanity

mkdir ~/.config/nvim/vim-plug
touch ~/.config/nvim/vim-plug/plugins.vim

#Let's add some plugins
##Add the following to ~/.config/nvim/vim-plug/plugins.vim
" auto-install vim-plug
if empty(glob('~/.config/nvim/autoload/plug.vim'))
silent !curl -fLo ~/.config/nvim/autoload/plug.vim --create-dirs
\ https://raw.githubusercontent.com/junegunn/vim-plug/master/plug.vim
"autocmd VimEnter _ PlugInstall
"autocmd VimEnter _ PlugInstall | source $MYVIMRC
endif
call plug#begin('~/.config/nvim/autoload/plugged')
" Better Syntax Support
Plug 'sheerun/vim-polyglot'
" File Explorer
Plug 'scrooloose/NERDTree'
" Auto pairs for '(' '[' '{'
Plug 'jiangmiao/auto-pairs'
call plug#end()

#Source your plugins
##Add the following line to init.vim
source $HOME/.config/nvim/vim-plug/plugins.vim

#Vim-plug commands
##Check the status of your plugins
:PlugStatus

##Install all of your plugins
:PlugInstall

##To update your plugins
:PlugUpdate

##After the update you can press d to see the differences or run
:PlugDiff

##To remove plugins that are no longer defined in the plugins.vim file
:PlugClean

##Finally if you want to upgrade vim-plug itself run the following
:PlugUpgrade

#Install python
sudo apt install python3-neovim
