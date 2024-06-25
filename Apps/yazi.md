Download the latest release of Yazi from GitHub:

wget -qO yazi.zip https://github.com/sxyazi/yazi/releases/latest/download/yazi-x86_64-unknown-linux-gnu.zip
Extract files to temporary directory:

unzip -q yazi.zip -d yazi-temp
Move executable to /usr/local/bin directory:

sudo mv yazi-temp/*/yazi /usr/local/bin
We can check Yazi version using the following command:

yazi --version
