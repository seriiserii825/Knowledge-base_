#suggestion with tab
As Rajesh and Malte said, go in Key Binding preferences (Preferences > Keyboard Shortcuts) and remove the key binding on "ENTER" key related to "suggestWidgetVisible" solved the problem.
- keybindings suggestWidgetVisible remove Enter and add Tab

Settings > Text editor > Suggestions > Accept suggestion on Enter > off
- settings: acceptSugesstionOnEnter - off

#expand snippet in html attribute
- ctrl+space

# shortcuts
ctrl+shift+w - close all tabs
ctrl+alt+. - close others
ctrl+\ - split
ctrl+shift+o - view all variables in file


#sftp
https://stackoverflow.com/questions/67506693/error-no-such-file-sftp-liximomo-extension
/home/serii/.vscode/extensions/liximomo.sftp-1.12.9
in package.json am schimbat versiunea la ssh2 ("ssh2": "^1.1.0",);
npm install

# vim emmet expand problem
Change vim version to 1.16.0

#status bar
ext install JoeBerria.statusbarerror

#tabs
Workbench Appearence -> Workbench Tree indent

#folding
vim.foldfix

#remove empty line in replace(use regular expresion)
^(\s)\*$\n

#font
"editor.fontFamily": "Menlo, Monaco, 'Courier New', monospace",

~/.config/Code/User (settings, keybindings)

# import export extensions
On the old machine:
code --list-extensions > vscode-extensions.list

On the new machine:
cat vscode-extensions.list | xargs -L 1 code --install-extension

#extensions
alefragnani.project-manager
amiralizadeh9480.laravel-extra-intellisense
ducfilan.pug-formatter
Atishay-Jain.All-Autocomplete
bmewburn.vscode-intelephense-client
christian-kohler.path-intellisense
claudiosanches.woocommerce
codingyu.laravel-goto-view
dbaeumer.vscode-eslint
eamodio.gitlens
esbenp.prettier-vscode
formulahendry.auto-close-tag
formulahendry.auto-complete-tag
formulahendry.auto-rename-tag
ionutvmi.path-autocomplete
IronGeek.vscode-env
JoeBerria.statusbarerror
johnbillion.vscode-wordpress-hooks
liximomo.sftp
mhutchie.git-graph
monokai.theme-monokai-pro-vscode
mrmlnc.vscode-scss
ms-vscode.vscode-typescript-next
nafiz.php-html-comment
octref.vetur
oderwat.indent-rainbow
patbenatar.advanced-new-file
PKief.material-icon-theme
pucelle.vscode-css-navigation
rifi2k.format-html-in-php
Shan.code-settings-sync
sleistner.vscode-fileutils
Sophisticode.php-formatter
steoates.autoimport
streetsidesoftware.code-spell-checker
Tobermory.es6-string-html
tuwrraphael.queryselector-completion
usernamehw.remove-empty-lines
vikyd.vscode-fold-level
vscodevim.vim
wangtao0101.vscode-js-import
wordpresstoolbox.wordpress-toolbox
wouterlms.vueimport
zhubincong.vue-component
