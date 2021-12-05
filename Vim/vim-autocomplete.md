#first method =============
in .vimrc
"Autocomplete
  Plugin 'vim-scripts/AutoComplPop'

set complete+=kspell
set completeopt=menuone,longest
set shortmess+=c

function! Tab_Or_Complete()
  if col('.')>1 && strpart( getline('.'), col('.')-2, 3 ) =~ '^\w'
    return "\<C-N>"
  else
    return "\<Tab>"
  endif
endfunction
:inoremap <Tab> <C-R>=Tab_Or_Complete()<CR>
:set dictionary="/usr/dict/words"

#default method =================

#autocomplete path
assets/
c+x,c+f - autocomplete
c+n,c+p -move up, down in search

#words
- c+p search up
- c+n search down
- c+n,c+p - select from dropdown
- c+x,c+i in current and include files
:set omnifunc=javascriptcomplete#CompleteJS

#find
:find filename or /som/ with tab

#tab
:ls - list buffers
:b filename or short filename in buffer

#ctags
ctags --recurse=yes --exclude=.git --exclude=BUILD --exclude=.svn --exclude=vendor/* --exclude=node_modules/* --exclude=db/* --exclude=log/*
