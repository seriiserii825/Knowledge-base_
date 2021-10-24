Для начала откроем Git Bash и создадим новый SSH-ключ:
ssh-keygen -t rsa -b 4096 -f ~/.ssh/personalid -C "personalid"

Вместо personalid может быть например, your_email@example.com.

Далее после того как все необходимые ключи созданы нужно отредактировать config-файл по пути ~/.ssh/config.

Host workid
HostName bitbucket.org
IdentityFile ~/.ssh/workid
Host personalid
HostName bitbucket.org
IdentityFile ~/.ssh/personalid

sh-agent для безопасного хранения и использования SSH-ключей
Далее нужно добавить ключ в ssh-agent. Сначала нужно убедиться, что ssh-agent запущен, для этого под Git Bash нужно выполнить команду:
$ ps | grep ssh-agent
А под Mac OS X и Linux:
$ ps -e | grep [s]sh-agent
Чтобы запустить ssh-agent под Git Bash нужно выполнить команду:

# start the ssh-agent in the background

$ eval "$(ssh-agent -s)"

Просмотреть добавленные в ssh-agent ключи можно командой:
$ ssh-add -l

Сам ключ добавляется командой:
$ ssh-add ~/.ssh/id_rsa
Ключи добавляются кратковременно и при перезапуске агента будут удалены.
Если нужно чтобы ssh-agent "забыл" ключ спустя какое-то время, то нужно использовать команду:
$ ssh-add -t <seconds>

Тестирование подключения
Для того чтобы протестировать подключение нужно дать команду:
ssh -T git@github.com

ssh-copy-id user@server

==== Buffer
sudo apt-get install xauth -y
sudo vim /etc/ssh/sshd_config
X11Forwarding yes
X11DisplayOffset 10
X11UseLocalhost no

ssh -X root@ip_addr
