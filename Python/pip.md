# install pip
sudo pacman -S python-pip

## error pip
Open Terminal
sudo nvim /etc/pip.conf
Add following line:
[global]
break-system-packages = true

## vesrion

```bash
pip --version
```

## list

```bash
pip list
```

## pipenv install global

```bash
pip install pipenv
```

## pipenv install

```bash
pipenv install <package_name>
```
