## add in existing repo
git submodule add ./submarine

## clone a repo as submodule
git submodule add https://github/.../submarine.git

## clone a repo with submodule
git clone parent url
cd parent
git submodule init
git submodule update

## remove submodule
rm -rf .git/modules/submarine
git rm -f ./submarine
.git/config # remove submodule entry


