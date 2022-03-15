Install mongo server and mongo shell
sudo chown serii:serii -R /tmp/mongodb-27017.sock
sudo mkdir -p /data/db
sudo mongo

#mongo tools
wget -qO - https://www.mongodb.org/static/pgp/server-4.4.asc | sudo apt-key add -
echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu focal/mongodb-org/4.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-4.4.list
Update
sudo apt-get install -y mongodb-org
#commands
use - go to db, or create
show collections - show collections
show dbs - show databases
db - view active db
db.stats() - show status for dbs
db.users.insert({name: 'John' age: 25}) - create collection or insert new document
db.dropDatabase() - delete db
db.users.drop() - drop collection

## Utilities

mongostat - show some info about dbs.
mongotop - show spent time to work with dbs.
mongoimport/mongoexport - import, export data in JSON, TSV, CSV format
mongodump - create dump
mongorestore - restore dump
mongofiles - work with files in GridFS.

Clone
mongodump --archive --db=nuxt-eccommerce-original | mongorestore --archive --nsFrom='nuxt-eccommerce-original._' --nsTo='pallina._'

mongoexport --db testDb --collection users --out ./users.json
mongoimport --db testDb --collection users --file ./users.json

mongodump --archive=./dump.archive --db testDb
mongorestore --archive=./dump.archive --db testDb
mongorestore --archive=./dump.archive --nsInclude testDb
mongorestore --archive=bludelego-30-08-2021.archive

MONGODB_URI = mongodb://localhost:27017
MONGODB_DB = blog

db.collection.dropIndexes()

#mongodb connection error
sudo service mongodb stop 

sudo rm /var/lib/mongodb/mongod.lock 

sudo mongod --repair --dbpath /var/lib/mongodb 

sudo mongod --fork --logpath /var/lib/mongodb/mongodb.log --dbpath /var/lib/mongodb 

sudo service mongodb start
