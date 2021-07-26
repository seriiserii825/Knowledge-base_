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

mongoexport --db testDb --collection users --out ./users.json
mongoimport --db testDb --collection users --file ./users.json

mongodump --archive=./dump.archive --db testDb
mongorestore --archive=./dump.archive --db testDb

