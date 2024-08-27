## arch
yay -S browserpass-chrome

# download browserpass-linux64-3.1.0.tar.gz
https://github.com/browserpass/browserpass-native/releases
https://github.com/browserpass/browserpass-native/releases/download/3.1.0/browserpass-linux64-3.1.0.tar.gz

# First, import the public key using any of these commands:
curl https://maximbaz.com/pgp_keys.asc | gpg --import
curl https://keybase.io/maximbaz/pgp_keys.asc | gpg --import
gpg --recv-keys 56C3E775E72B0C8B1C0C1BD0B5DB77409B11B601

# Unpack the archive.
# IMPORTANT: replace XXXX with OS name depending on the archive you downloaded, e.g. "linux64"
cd browserpass-XXXX
make BIN=browserpass-XXXX configure      # Configure the hosts json files
sudo make BIN=browserpass-XXXX install   # Install the app

# install app
go to
/usr/local/lib/browserpass/ 
/usr/lib/browserpass
make hosts-chrome-user
make hosts-vivaldi-user

# install browser extenstion
browserpass
