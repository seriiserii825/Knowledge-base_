###.vimrc
Plugin 'prettier/vim-prettier', { 'do': 'yarn install' }

###After install
.vim/bundle/vim-prettier - run npm i

###.vimrc config
" when running at every change you may want to disable quickfix
let g:prettier#quickfix_enabled = 0

autocmd TextChanged,InsertLeave _.js,_.jsx,_.mjs,_.ts,_.tsx,_.css,_.less,_.scss,_.json,_.graphql,_.md,_.vue,_.svelte,_.yaml,\*.html PrettierAsync
