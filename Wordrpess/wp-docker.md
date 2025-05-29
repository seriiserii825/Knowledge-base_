docker-compose down -v
sudo chown -R $USER:$USER .
docker-compose up --build

sudo chown -R 33:33 .
sudo chmod -R 775 .
