$ su
> Enter root password: *******
$ visudo -f /etc/sudoers
Find the following section of /etc/sudoers file and add your users privileges:

# User privilege specification
root    ALL=(ALL:ALL) ALL
user_name ALL=(ALL) ALL
