## plugins
Plug 'puremourning/vimspector'

cd autoload/plugged/vimspector
run
./install_gadget.py --all

## install pip globaly
sudo nvim /etc/pip.conf
Add following line:
[global]
break-system-packages = true

## terminal
pip3 install --upgrade pip setuptools

## inside neovim
:VimspectorInstall debugpy

## .vimspector.json
{
  "configurations": {
    "<name>: Launch": {
      "adapter": "debugpy",
      "filetypes": [ "python" ],
      "configuration": {
        "name": "<name>: Launch",
        "type": "python",
        "request": "launch",
        "cwd": "${workspaceRoot}",
        "python": "./venv/bin/python",
        "stopOnEntry": true,
        "console": "externalTerminal",
        "debugOptions": [],
        "program": "${file}"
      }
    }
  }
}
