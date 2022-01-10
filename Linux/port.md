#port
sudo apt-get install net-tools 
sudo netstat -tpln | grep "tcp"

sudo netstat -ltnp | grep -w ':80'

fuser -k 3000/tcp && echo 'Terminated' || echo 'Nothing was running on the 3000'
fuser -k 80/tcp && echo 'Terminated' || echo 'Nothing was running on the 80'
