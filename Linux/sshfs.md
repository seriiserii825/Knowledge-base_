Connecting to a server across the internet is much more secure using SSH. There is a way that you can mount a folder on a remote server using the SSHFS service.

There are quite a few steps that you’ll have to follow, so get ready and open a terminal window.

First we’ll install the module:

sudo apt-get install sshfs

Now we will use the modprobe command to load it

sudo modprobe fuse

We’ll need to set up some permissions in order to access the utilities. Replace <username> with your username.

sudo adduser <username> fuse

sudo chown root:fuse /dev/fuse

sudo chmod +x /dev/fusermount

Since we’ve added ourselves to a user group, we need to logout and back in at this point before we continue.

ADVERTISEMENT

Now we’ll create a directory to mount the remote folder in. I chose to create it in my home directory and call it remoteserv.

mkdir ~/remoteserv

Now we have the command to actually mount it. You’ll be prompted to save the server key and for your remote password.

sshfs <username>@<ipaddress>:/remotepath ~/remoteserv

Now you should be able to cd into the directory and start using it as if it was local.
