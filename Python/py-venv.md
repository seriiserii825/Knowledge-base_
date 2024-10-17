##
<!--  run file as script with virtual environment -->
python3 -m venv venv
<!-- activate venv -->
source venv/bin/activate
<!-- for windows: venv\Scripts\activate -->

pip freeze - show installed packages
pip install -U pip - upgrade pip - update pip or another package
pip uninstall lib -y - remove package

pip freeze > requirements.txt - save installed packages
pip deactive - deactivate venv
pip install -r requirements.txt - install packages from requirements.txt

## on new machine
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt
