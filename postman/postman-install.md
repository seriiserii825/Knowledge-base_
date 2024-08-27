# To install manually, download and unzip the app, for example into the Downloads directory.
https://www.postman.com/downloads/

cd Downloads/
tar -xzf Postman-linux-x64-7.32.0.tar.gz
sudo mkdir -p /opt/apps/
sudo mv Postman /opt/apps/
sudo ln -s /opt/apps/Postman/Postman /usr/local/bin/postman
postman
