wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash
GitCopy
 

Обновим среду оболочки, для чего требуется закрыть и снова открыть терминал, либо выполнить команду:
source ~/.profile
nvm --version
nvm ls-remote | grep -i "latest lts"

// в моём случае результат таков
         v4.9.1   (Latest LTS: Argon)
        v6.17.1   (Latest LTS: Boron)
        v8.15.1   (Latest LTS: Carbon)
       v10.15.3   (Latest LTS: Dubnium)
nvm install 12.22.9
nvm ls
nvm use <version_number>
nvm uninstall <version_number>
