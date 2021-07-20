mongodump --archive=nature.archive --db nature
mongorestore --archive=nature.archive --db nature
db.tours.deleteOne({name: {$eq: "Tour5"}})
db.tours.deleteMany({rating: {$lt: 4.5}})

