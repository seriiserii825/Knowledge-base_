## install

Install python3

## install pip
Install python3-pip

## error pip
Open Terminal
sudo nvim /etc/pip.conf
Add following line:
[global]
break-system-packages = true

Every thing is updated now you can run pip install <package_name>
