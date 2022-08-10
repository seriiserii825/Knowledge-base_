# For the second account:

## Create a new ssh key:
ssh-keygen -f ~/.ssh/sites-bludelego -C "bludelego@gmail.com"

## Add the ssh key:
ssh-add ~/.ssh/sites-bludelego 

## Copy pub key to bitbucket ssh
xclip -sel clip < ~/.ssh/sites-bludelego.pub

## Add the following to your ~/.ssh/config file. The first sets the default key for bitbucket.org. The second sets your second key to an alias sites-bludelego for bitbucket.org:

Host bitbucket.org
  Hostname bitbucket.org
  IdentityFile ~/.ssh/id_rsa

Host bitbucket.org-b
  Hostname bitbucket.org
  PreferredAuthentications publickey
  IdentityFile ~/.ssh/sites-bludelego

