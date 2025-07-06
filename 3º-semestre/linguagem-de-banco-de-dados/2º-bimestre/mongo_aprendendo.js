use('Livraria')
db.livraria.insertOne(
    {
        nome:"O Pequeno Príncipe",
        autor:"Antoine de Saint-Exupéry"
    }
)

// select * from livraria
    use('Livraria')
    db.livraria.find()

//novo insert com mais o atributo ano
db.livraria.insertOne(
    {
        nome: "1984",
        autor: "George Orwell",
        ano: 1949
    }
)

//insert com muitos valores
use('Livraria')
db.livraria.insertMany(
    {nome: "O senhor dos anéis", autor: "J.R.R Tolkien", ano: 1954},
    {nome: "O Hobbit", autor: "J.R.R Tolkien", ano: 1937},
    {nome: "1984", autor: "George Orwell", ano: 1949},
)

// select com where
use('Livraria')
db.livraria.find({ano: 1949})

//sem os IDs
use('Livraria')
db.livraria.find({ano: 1949}, {_id: 0})

//usando o operador Like - "i" - insensitive
use('Livraria')
db.livraria.find({nome:/Senhor/i}, {_id: 0})

use('Livraria')
db.dropDatabase()