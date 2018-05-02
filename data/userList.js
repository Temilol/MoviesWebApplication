db.users.remove()
db.users.insert({
    "name": "The Flash",
    "username": "flash",
    "email": "the@flash.com",
    "password": "fastest",
    "number": 8231223731,
    "role": "admin"
})
db.users.insert({
    "name": "Super Man",
    "username": "sman",
    "email": "super@man.com",
    "password": "strongest",
    "number": 2341825419,
    "role": "user"
})
db.users.insert({
    "name": "Spider Man",
    "username": "spman",
    "email": "spider@man.com",
    "password": "ballers",
    "number": 5678210924,
    "role": "user"
})
db.users.insert({
    "name": "Bat Man",
    "username": "bman",
    "email": "bat@man.com",
    "password": "money",
    "number": 2124979503,
    "role": "user"
})
db.users.insert({
    "name": "Wonder Woman",
    "username": "wman",
    "email": "wonder@woman.com",
    "password": "wonder",
    "number": 4311331231,
    "role": "user"
})

// db.movie.aggregate({"$group" : {"_id": "$year", "Number of movies": {"$sum" : 1}}},{"$sort":{"_id": 1}})
// db.movie.aggregate({$group:{'_id':'$details.director', 'Number of movies directed':{$sum: 1}}})
// db.movie.find({"rating":{"$gte":8}}).pretty()