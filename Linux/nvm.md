wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash
GitCopy
 

Обновим среду оболочки, для чего требуется закрыть и снова открыть терминал, либо выполнить команду:

source ~/.profile
GitCopy
 

Проверяем:

nvm --version
GitCopy
 

Получить список всех доступных версий node.js можно следующим образом:

nvm ls-remote
GitCopy
 

Ещё лучше - вывести лишь список версий с долгосрочной поддержкой:

nvm ls-remote | grep -i "latest lts"

// в моём случае результат таков
         v4.9.1   (Latest LTS: Argon)
        v6.17.1   (Latest LTS: Boron)
        v8.15.1   (Latest LTS: Carbon)
       v10.15.3   (Latest LTS: Dubnium)
GitCopy
 

Теперь можно выбрать желаемый вариант и установить, например:

nvm install 10.15.3
GitCopy
 

Вывести список установленных версий:

nvm ls
PHPCopy
 

Переключить на другую версию:

 nvm use <version_number>
PHPCopy
 

Чтобы удалить версию, нужно предварительно переключиться на другую и затем выполнить:

nvm uninstall <version_number>
