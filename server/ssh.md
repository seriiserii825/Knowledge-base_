vim /etc/ssh/sshd_config
PermitRootLogin no

# systemctl restart sshd
OR
# /etc/init.d/sshd restart

ssh-copy-id username@remote_server

ssh-copy-id -i ~/.ssh/id_rsa.pub user@remote-host
