## create new key
```

ssh-keygen -t ed25519
or
ssh-keygen -t ed25519 -f ~/.ssh/id_ed25519 -C "seriiburduja@gmail.com"
```

## copy key to remote server
```
ssh-copy-id -i ~/.ssh/id_ed25519.pub user@remote-host
```

or

in .ssh/authorized_keys append you public key from .ssh/id_ed25519.pub
```
cat ~/.ssh/id_ed25519.pub | ssh user@remote-host 'cat >> ~/.ssh/authorized_keys'
```

for authorized_keys check permissions
```
sudo chown -R user:user ~/.ssh
sudo chmod 700 ~/.ssh
sudo chmod 600 ~/.ssh/authorized_keys
```


## config ssh
vim /etc/ssh/sshd_config
PermitRootLogin no
change port

# systemctl restart sshd
OR
# /etc/init.d/sshd restart

