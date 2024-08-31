## install

Install python3

## install pip
sudo pacman -S python-pip

## error pip
Open Terminal
sudo nvim /etc/pip.conf
Add following line:
[global]
break-system-packages = true

Every thing is updated now you can run pip install <package_name>

## selenium chromedriver
yay -S chromedriver
