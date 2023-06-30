## Install zsh
Install zsh
ln -s ~/xubuntu/zshrc .zshrc

## oh-my-zsh
curl -L https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh | sh

## bash to zsh
chsh -s $(which zsh) (will work after restart)

## autocomplete
git clone --depth 1 -- https://github.com/marlonrichert/zsh-autocomplete.git
source ~/zsh-autocomplete/zsh-autocomplete.plugin.zsh

## syntax highliting
git clone https://github.com/zsh-users/zsh-syntax-highlighting.git ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-syntax-highlighting

## zsh autosugestion
git clone https://github.com/zsh-users/zsh-autosuggestions ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-autosuggestions


https://i.imgur.com/JKj2JKD.png
