let products = [
    {
        nama: 'Indomie Seleraku',
        harga: 3000,
        rating: 5,
        likes: 150
    },
    {
        nama: 'Aqua',
        harga: 3000,
        rating: 4.5,
        likes: 123
    },
    {
        nama: 'Le minerale',
        harga: 2000,
        rating: 5,
        likes: 250
    },
    {
        nama: 'Indomie Smart TV',
        harga: 4000000,
        rating: 4.5,
        likes: 92
    },
    {
        nama: 'Headphone',
        harga: 440000,
        rating: 3.5,
        likes: 90
    },
    {
        nama: 'My Smart TV',
        harga: 4000000,
        rating: 4.5,
        likes: 97
    },
]

console.log(products)

products.sort((a, b) =>
    (a.harga > b.harga) ?
    1 :
    (a.harga === b.harga) ?
    (b.rating > a.rating) ?
    1 :
    (a.rating === b.rating) ?
    (b.likes > a.likes) ?
    1 : -1 : -1 : -1
);

console.log(products);