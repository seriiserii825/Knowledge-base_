## Сделай так:

Bash

cd ~/Downloads/bs-salumificio-tarasconi.git

git branch -a
cat HEAD
Скорее всего увидишь master. Тогда создай локальную ветку main из master:

Bash

git branch main master
git symbolic-ref HEAD refs/heads/main
Теперь пуш:

Bash

git remote set-url origin git@bitbucket.org:blueline-wordpress-sites/bs-portfolio-altuofianco.git
git push --mirror origin
