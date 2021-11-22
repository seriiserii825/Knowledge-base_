#port
sudo netstat -tpln | grep "tcp"
lsof -i :80 - проверить что запущенно на порту 80
fuser -k 3000/tcp && echo 'Terminated' || echo 'Nothing was running on the 3000'
