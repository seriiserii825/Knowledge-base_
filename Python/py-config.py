# config.py connect in main.py

from configparser import ConfigParser
from rich import print

from constants import SCRIPT_DIR
from utils.checkConfigTxt import checkConfigTxt
from utils.chooseNuxtOrVue import chooseNuxtOrVue
from utils.getSelectedTemplate import getSelectedTemplate


checkConfigTxt()
config_txt = getSelectedTemplate()
print(f"[green]Current template: ([blue]{config_txt})")
chooseNuxtOrVue()

config = ConfigParser()

config['vue'] = {
        'pages': 'src/views',
        'components': 'src/components',
        'store': 'src/store',
        'api': 'src/api',
        'hooks': 'src/hooks',
        'interfaces': 'src/interfaces',
        'icons': 'src/icons',
        'scss': 'src/scss/blocks',
        }
config['nuxt'] = {
        'pages': 'pages',
        'components': 'components',
        'store': 'store',
        'api': 'api',
        'hooks': 'hooks',
        'interfaces': 'interfaces',
        'icons': 'icons',
        'scss': 'assets/scss/blocks',
        }

with open(f"{SCRIPT_DIR}/config.ini", 'w') as configfile:
    config.write(configfile)
    print(f"[green]config.ini file created")

## use  after

from configparser import ConfigParser
from config import SCRIPT_DIR


def getConfigData(is_vue, path):
    # Read the configuration file
    config = ConfigParser()
    config.read(f"{SCRIPT_DIR}/config.ini")
    if is_vue:
        return config['vue'][path]
    else:
        return config['nuxt'][path]
