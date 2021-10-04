#port
sudo netstat -tpln | grep "tcp"
lsof -i :80 - проверить что запущенно на порту 80
