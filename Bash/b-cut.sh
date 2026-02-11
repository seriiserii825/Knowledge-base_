# cut command

serii:x:1000:1000::/home/serii:/usr/bin/zsh
shor_name=$(cat /etc/passwd | grep $name | awk -F : '{print $6}')
/home/serii
shor_name=$(cat /etc/passwd | grep $name | awk -F : '{print $6}' | cut -d / -f 3)
