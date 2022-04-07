coc-css coc-emmet coc-eslint coc-explorer coc-fzf-preview coc-git coc-highlight coc-json coc-phpactor coc-stylelint coc-snippets coc-spell-checker coc-svg coc-translator coc-tsserver coc-prettier


#Conquerer of Completion
This plugin is too featureful (bloated) to explain in a single blog post
Good thing the author provided extensive documentation here

#Install with vim-plug

" Stable version of coc
Plug 'neoclide/coc.nvim', {'branch': 'release'}

" Keeping up to date with master
Plug 'neoclide/coc.nvim', {'do': 'yarn install --frozen-lockfile'}
make sure you have yarn installed if you choose the second way
npm i -g yarn

#Create a directory called plug-config and an entry for coc

mkdir ~/.config/nvim/plug-config
touch ~/.config/nvim/plug-config/coc.vim

#Create basic config file
Head over to the readme and grab his example config

##Add the following to your init.vim
" Explorer
let g:coc_explorer_global_presets = {
\   '.vim': {
\     'root-uri': '~/.vim',
\   },
\   'tab': {
\     'position': 'tab',
\     'quit-on-open': v:true,
\   },
\   'floating': {
\     'position': 'floating',
\     'open-action-strategy': 'sourceWindow',
\   },
\   'floatingTop': {
\     'position': 'floating',
\     'floating-position': 'center-top',
\     'open-action-strategy': 'sourceWindow',
\   },
\   'floatingLeftside': {
\     'position': 'floating',
\     'floating-position': 'left-center',
\     'floating-width': 50,
\     'open-action-strategy': 'sourceWindow',
\   },
\   'floatingRightside': {
\     'position': 'floating',
\     'floating-position': 'right-center',
\     'floating-width': 50,
\     'open-action-strategy': 'sourceWindow',
\   },
\   'simplify': {
\     'file-child-template': '[selection | clip | 1] [indent][icon | 1] [filename omitCenter 1]'
\   }
\ }

nmap <space>e :CocCommand explorer<CR>
nmap <space>f :CocCommand explorer --preset floating<CR>
autocmd BufEnter * if (winnr("$") == 1 && &filetype == 'coc-explorer') | q | endif

#source file
source $HOME/.config/nvim/plug-config/coc.vim

#Checking coc health
You can run :checkhealth and there should now be an entry for coc
You can use g:coc_node_path to point to your node executable
You can also run :CocInfo to get some useful info

#Install extensions
You can install extensions for languages like this:
:CocInstall coc-css coc-emmet coc-eslint coc-explorer coc-fzf-preview coc-git coc-highlight coc-json coc-phpactor coc-stylelint coc-snippets coc-spell-checker coc-svg coc-translator coc-tsserver coc-prettier


There are many more extensions to choose from here:
coc-extensions

#You can list all of the extension commands with:
:CocList commands

#You can uninstall an extension with:
:CocUninstall coc-html

#You can manage your extensions with:
:CocList extensions

#Hit to see a list of options for each extension
Run :CocConfig this will open the file ~/.config/nvim/coc-settings.json

