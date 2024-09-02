Download the latest release of Yazi from GitHub:

wget -qO yazi.zip https://github.com/sxyazi/yazi/releases/latest/download/yazi-x86_64-unknown-linux-gnu.zip
unzip -q yazi.zip -d yazi-temp
sudo mv yazi-temp/*/yazi /usr/local/bin
yazi --version

# Linux/macOS
git clone -b yazi-0.2.5 https://github.com/dedukun/bookmarks.yazi.git ~/.config/yazi/plugins/bookmarks.yazi

https://github.com/dedukun/bookmarks.yazi

# Add the plugin
ya pack -a dedukun/bookmarks

# Install plugin
ya pack -i

# Update plugin
ya pack -u
