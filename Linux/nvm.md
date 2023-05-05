#clone this repo in the root of your user profile
cd ~/ from anywhere then
#clone
git clone https://github.com/nvm-sh/nvm.git .nvm

#source
cd ~/.nvm and check out the latest version with git checkout v0.39.1
activate nvm by sourcing it from your shell: . ./nvm.sh

#install
nvm ls-remote | grep -i "latest lts"

// в моём случае результат таков
v4.9.1 (Latest LTS: Argon)
v6.17.1 (Latest LTS: Boron)
v8.15.1 (Latest LTS: Carbon)
v10.15.3 (Latest LTS: Dubnium)
nvm install 12.22.9
nvm ls
nvm use <version_number>
nvm uninstall <version_number>

# set default version

nvm alias default 16
