1.git clone on your public_html folder (after you create ssh keys etc)
2.create a file gitpull.php with the command : exec(git pull); inside it
3.create a webhook on github to call yourwebsite.com/gitpull.php
