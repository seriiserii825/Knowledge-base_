- connect to server throw ssh.
- Update and Upgrade on server

# User

- adduser boss
- gpasswd -a boss sudo - add user to admin
- su - boss - connect boss as user

# Ssh

- mkdir .ssh
- chmod 700 .ssh
- vim .ssh/authorize_keys - add here our public key.
- .ide_rsa.pug - public key
- chmod 600 .ssh/authorize_keys
- exit - go to root user
- /etc/ssh/ssh_config - change port from 22 to 5050, and PermitRouteLogin - no, PasswordAuthentification - no, Just user boss cant enter to server.
- server ssh restart
- /etc/sudoers - add line boss ALL=(ALL) NOPASSWD: ALL - user can work without print a password
- ssh -p 5050 root@IP_ADDRESS check if we cant enter with root
- ssh -p 5050 boss@IP_ADDRESS

# Nginx

- sudo apt install nginx
- sudo systemctl status nginx (active running)
- sudo systemctl enable nginx (enable nginx when system start)
