alias rnst="rename -v 's/\ /-/g' *"
alias ns='npm start'
alias nrs='npm run serve'
alias nrst='npm run start'
alias ll='ls -lha'
alias nru='npm run update'
alias nrd='npm run dev'
alias nrb='npm run build'
alias nrp='npm run predev'
alias lg='lazygit'
alias ms='mgitstatus -e -d 4'
alias gx='cd ~/xubuntu'
alias gd='cd ~/Downloads'
alias zn='cd ~/.config/nvim'
alias build_prod_strapi='NODE_ENV=production pm2 start server.js --name strapi'

alias api_www='sudo chown -R www-data:www-data /var/www/api'
alias api_seriivds='sudo chown -R seriivds:seriivds /var/www/api'


function gcm() {
    git commit -m "$*"
}

export FZF_DEFAULT_COMMAND="find . -path '*/\.*' -type d -prune -o -type f -print -o -type l -print 2> /dev/null | sed s/^..//" 


#programms
alias r='ranger'
alias f='vim -o `fzf`'

function lf() {
    git add .
    git commit -a -m "$*"
    git push
}

# some more ls aliases

alias gs='git status'
alias gad='git add --all'
alias glg='git log --oneline --graph'
alias gph='git push'
alias gpl='git pull'
alias dg='sudo dpkg -i'
alias Install="sudo apt install -y"
alias Update='sudo apt update -y'
alias Upgrade='sudo apt upgrade'
alias Search='apt-cache search'
alias Autoremove='sudo apt autoremove'
alias Autoclean='sudo apt autoclean'
alias Purge='sudo apt purge -y'
alias Search='sudo apt search'
alias o='xdg-open'
alias df='df -h'
alias du='du -h'
alias shn="sudo shutdown -h now"
alias srn="sudo shutdown -r now"
alias out='pastebinit'
alias phpr="sudo systemctl restart apache2"
alias mysqlr="sudo systemctl restart mysql"
alias zshrc="vim ~/.zshrc"
alias szshrc="vim ~/.zshrc"
alias vimrc="vim ~/.vimrc"
alias svimrc="source ~/.vimrc"
alias b="vim ~/.bashrc"
alias sb="source ~/.bashrc"
