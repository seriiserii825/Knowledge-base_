# install
sudo pacman -S python-pipx
pipx ensurepath
sudo pipx ensurepath --global

pipx install twitch-dl
pipx ensurepath

twitch-dl download video_url
