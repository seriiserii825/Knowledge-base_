alias gs="git status"
alias gcp="git config pull.rebase false && git pull"
alias gph="git push"
alias gpl="git pull"
alias lz="lazygit"
alias glog="git log --oneline --graph --decorate --all"

function gcmt() {
  git add .
  git commit -m "$*"
}

function gitRestore(){
  git restore .
  git clean -f   
  git clean -df
}

function checkInGit(){
  git ls-files --error-unmatch "$1"
}

function gitRmCached(){
  git rm -rf --cached "$1"
}

alias sb="source ~/.bashrc"
alias n12='nvm use 12'
alias n14='nvm use 14'
alias n16='nvm use 16'
alias n18='nvm use 18'
alias n20='nvm use 20'
alias rmn="rm -rf node_modules"

alias nru="npm run update"
alias bib="bun install && bun run build"
