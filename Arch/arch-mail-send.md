#### Step 1: Install `msmtp` and `mutt`/`neomutt`
```
sudo pacman -S msmtp mutt
```
#### Step 2: Configure `msmtp`
Create a configuration file for `msmtp` to handle sending emails via your email provider.
Create the file `~/.msmtprc`:
```
touch ~/.msmtprc 
chmod 600 ~/.msmtprc
```

### create google app password
https://myaccount.google.com/apppasswords?rapt=AEjHL4P5v7YrduLMBWIM9pBnRFWmYfLgm82QsNzw5kglLd4OKWkfZZWbVbGmKw-9YyEA9JFWyCGV49X381OG2zmyxPdsSg6DIfYNd2mRKfsFJgEM7Mgm-ag

## configure msmtprc
```
defaults
auth            on
tls             on
tls_trust_file  /etc/ssl/certs/ca-certificates.crt
logfile         ~/.msmtp.log

account gmail
host smtp.gmail.com
port 587
from seriiburduja@yandex.ru
user seriiburduja@gmail.com

# Set a default account
account default : gmail
passwordeval "echo 'password from google app password'"
```


#### Step 3: Configure `mutt`/`neomutt`
Create or modify the configuration file for `mutt`/`neomutt` in `~/.muttrc`:
```
set sendmail="/usr/bin/msmtp"
set use_from=yes
set realname="Your Name"
set envelope_from=yes
```
#### Step 4: Send an Email
You can send an email with `mutt`/`neomutt` like this:
`
echo "Email body text" | mutt -s "Subject here" seriiburduja@gmail.com
`
