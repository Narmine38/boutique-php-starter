<?php

require_once __DIR__ . '/Entity/Product.php';

use App\Entity\Product;

$productsData = [
    [
        "id" => 1,
        "name" => "T-shirt Premium",
        "price" => 29.99,
        "stock" => 150,
        "image" => "https://picsum.photos/id/1/300/200",
        "description" => "Un t-shirt de haute qualité en coton biologique.",
        "category" => "Vêtements"
    ],
    [
        "id" => 2,
        "name" => "Jean Denim",
        "price" => 59.99,
        "stock" => 85,
        "image" => "https://picsum.photos/id/2/300/200",
        "description" => "Jean coupe droite, résistant et élégant.",
        "category" => "Vêtements"
    ],
    [
        "id" => 3,
        "name" => "Veste d'Hiver",
        "price" => 89.99,
        "stock" => 3,
        "image" => "https://picsum.photos/id/3/300/200",
        "description" => "Parfaite pour affronter les températures les plus basses.",
        "category" => "Vêtements"
    ],
    [
        "id" => 4,
        "name" => "Chaussures Sport",
        "price" => 75.00,
        "stock" => 60,
        "image" => "https://picsum.photos/id/4/300/200",
        "description" => "Confortables et légères pour vos séances de sport.",
        "category" => "Chaussures"
    ],
    [
        "id" => 5,
        "name" => "Sac à Dos",
        "price" => 45.00,
        "stock" => 110,
        "image" => "https://picsum.photos/id/5/300/200",
        "description" => "Robuste et spacieux pour vos aventures quotidiennes.",
        "category" => "Accessoires"
    ],
    [
        "id" => 6,
        "name" => "Montre Digitale",
        "price" => 120.00,
        "stock" => 25,
        "image" => "https://picsum.photos/id/6/300/200",
        "description" => "Une montre connectée aux multiples fonctionnalités.",
        "category" => "Accessoires"
    ],
    [
        "id" => 7,
        "name" => "Casque Audio",
        "price" => 149.99,
        "stock" => 15,
        "image" => "https://picsum.photos/id/7/300/200",
        "description" => "Réduction de bruit active et son haute fidélité.",
        "category" => "Électronique"
    ],
    [
        "id" => 8,
        "name" => "Appareil Photo",
        "price" => 450.00,
        "stock" => 0,
        "image" => "https://picsum.photos/id/8/300/200",
        "description" => "Capturez vos meilleurs moments avec précision.",
        "category" => "Électronique"
    ]
];

$products = [];
foreach ($productsData as $data) {
    $products[] = new Product(
        $data['id'],
        $data['name'],
        $data['description'],
        $data['price'],
        $data['stock'],
        $data['image'],
        $data['category']
    );
}

// On s'assure que la variable est globale
global $products;
