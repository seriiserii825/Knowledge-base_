step 1:
goto .ssh folder and generate ssh keys for all your github accounts

$ cd ~/.ssh
$ ssh-keygen -t rsa -b 4096 -C "personal_email_id"
  # save as id_rsa_personal
$ ssh-keygen -t rsa -b 4096 -C "work_email_id"
  # save as id_rsa_work

step 2:
Copy id_rsa_personal.pub and id_rsa_work.pub and add to respective github account.

step 3:
create config file in .ssh folder And add below configs

$ touch config

# Personal account - default config
Host github.com-personal
   HostName github.com
   User git
   IdentityFile ~/.ssh/id_rsa_personal
# Work account
Host github.com-work
   HostName github.com
   User git
   IdentityFile ~/.ssh/id_rsa_work

step 4:
create .gitconfig for personal and work directory with respective config git host names

$ cd ~
$ nano ~/.gitconfig

[user]
    name = personal_name
    email = personal_email_id
[includeIf "gitdir:~/work/"]
    path = ~/work/.gitconfig

$ nano ~/work/.gitconfig
[user]
    name = Coder Train
    email = work_email_id

step 5: 
Add new ssh keys 
$ cd ~/.ssh

ssh-add -D delete all keys

$ ssh-add id_rsa_personal
$ ssh-add id_rsa_work

$ ssh-add -l

step 6:
check configuration is right by pinging to github with below commands

$ ssh -T github.com-personal
$ ssh -T github.com-work


user ssh-key in .gitconfig

[core]
sshCommand = ssh -i ~/.ssh/id_rsa_work
