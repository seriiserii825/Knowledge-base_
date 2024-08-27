## git blame
left side pane - annotate with git blame

# if
alt+enter = simplify

### optimize import
```
ctrl+alt+o
```

## surround with emmet
alt+enter inject html

# carret at the end of selection
alt+shift+g

## vim

:actionlist

## remove .idea from git

git rm -r --cached .idea
.gitignore
.idea/

### Буфер обмена

touch ~/.ideavimrc
echo "set clipboard=unnamedplus" >> .ideavimrc

###

imap jj <Esc>

### speed up

From the main menu, select Help | Change Memory Settings.
Set the necessary amount of memory that you want to allocate and click Save and Restart.
This action changes the value of the -Xmx option used by the JVM and restarts PhpStorm with the new setting.

Disable language injections: File -> Settings -> Language injections. Untick as many boxes as you're comfortable with. HTML was the real killer for me.
Disable inspections: File -> Settings -> Inspections. Untick as many as you don't need.
Disable unused plugins: File -> Settings -> Plugins. Untick unused.

wget https://www.jetbrains.com/phpstorm/download/ ~/Downloads
sudo tar -xzf PhpStorm\*.tar.gz -C /opt
cd /opt/PhpStorm-212.4746.100/bin 
and type 
sudo ln -s /opt/PhpStorm-203.7717.64/bin/phpstorm.sh /usr/bin/phpstorm
call phpstorm

### autoprefixer

disable.
file > settings > editor > emmet > css > "auto insert css vendor prefixes"

### hotkeys

ctrl+up - navigation bar
ctrl+n - new file
ctrl+up - delete - delete file
ctrl+alt+n - select in sidebar

### reset to default settings

remove /home/serii/.config/JetBrains

### downgrade

https://www.jetbrains.com/phpstorm/download/other.html

### github sync settings

Далее в IDE (PhpStorm, PyCharm, RubyMine) настройками которой нужно поделиться с другими экземплярами заходим в File → Settings Repository и добавляем url созданного выше репозитория.

Нас попросит ввести token. Для того чтобы его создать идем на Гитхаб в настройки аккаунта, далее выбираем Developer settings -> Personal access tokens, ставим галочку у repo и нажимаем Generate new token.

Автоматическую синхронизацию можно отключить и выполнять ее вручную с помощью меню VCS → Sync Settings. Для этого нужно перейти в Settings → Tools → Settings Repository и убрать галочку Auto Sync.
