#constructor
generate

#search
file
action
class

#if
alt+enter = simplify

#posfix
autocompletions

#surround with template
##surround with emmet 
alt+enter inject html

#carret at the end of selection
alt+shift+g


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

sudo tar -xzf PhpStorm\*.tar.gz -C /opt
cd /opt/PhpStorm-212.4746.100/bin and type sudo ./phpstorm.sh
in phpstorm -> tools -> create desktop launcher

### autoprefixer

disable.
file > settings > editor > emmet > css > "auto insert css vendor prefixes"

### hotkeys
ctrl+up - navigation bar
ctrl+n - new file
ctrl+up - delete - delete file
ctrl+alt+n - select in sidebar
