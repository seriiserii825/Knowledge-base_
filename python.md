Step 1 – Prerequsities

sudo apt-get install -y make build-essential libssl-dev zlib1g-dev \
libbz2-dev libreadline-dev libsqlite3-dev wget curl llvm libncurses5-dev \
libncursesw5-dev xz-utils tk-dev libffi-dev liblzma-dev \
libgdbm-dev libnss3-dev libedit-dev libc6-dev
Step 2 – Download Python 3.6

wget https://www.python.org/ftp/python/3.6.15/Python-3.6.15.tgz

tar -xzf Python-3.6.15.tgz
Step 3 – Compile Python Source

cd Python-3.6.15
./configure --enable-optimizations  -with-lto  --with-pydebug
make -j 8  # adjust for number of your CPU cores
sudo make altinstall
Step 4 – Check the Python Version

python3.6 -V
