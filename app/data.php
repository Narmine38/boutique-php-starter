<?php

$products = [
    [
        "name" => "T-shirt Premium",
        "price" => 29.99,
        "stock" => 150,
        "image" => "https://picsum.photos/id/1/300/200",
        "description" => "Un t-shirt de haute qualité en coton biologique.",
        "new" => true,
        "discount" => 0,
        "category" => "Vêtements"
    ],
    [
        "name" => "Jean Denim",
        "price" => 59.99,
        "stock" => 85,
        "image" => "https://picsum.photos/id/2/300/200",
        "description" => "Jean coupe droite, résistant et élégant.",
        "new" => false,
        "discount" => 15,
        "category" => "Vêtements"
    ],
    [
        "name" => "Veste d'Hiver",
        "price" => 89.99,
        "stock" => 3,
        "image" => "https://picsum.photos/id/3/300/200",
        "description" => "Parfaite pour affronter les températures les plus basses.",
        "new" => false,
        "discount" => 0,
        "category" => "Vêtements"
    ],
    [
        "name" => "Chaussures Sport",
        "price" => 75.00,
        "stock" => 60,
        "image" => "https://picsum.photos/id/4/300/200",
        "description" => "Confortables et légères pour vos séances de sport.",
        "new" => true,
        "discount" => 0,
        "category" => "Chaussures"
    ],
    [
        "name" => "Sac à Dos",
        "price" => 45.00,
        "stock" => 110,
        "image" => "https://picsum.photos/id/5/300/200",
        "description" => "Robuste et spacieux pour vos aventures quotidiennes.",
        "new" => false,
        "discount" => 10,
        "category" => "Accessoires"
    ],
    [
        "name" => "Montre Digitale",
        "price" => 120.00,
        "stock" => 25,
        "image" => "https://picsum.photos/id/6/300/200",
        "description" => "Une montre connectée aux multiples fonctionnalités.",
        "new" => true,
        "discount" => 0,
        "category" => "Accessoires"
    ],
    [
        "name" => "Casque Audio",
        "price" => 149.99,
        "stock" => 15,
        "image" => "https://picsum.photos/id/7/300/200",
        "description" => "Réduction de bruit active et son haute fidélité.",
        "new" => false,
        "discount" => 20,
        "category" => "Électronique"
    ],
    [
        "name" => "Appareil Photo",
        "price" => 450.00,
        "stock" => 0,
        "image" => "https://picsum.photos/id/8/300/200",
        "description" => "Capturez vos meilleurs moments avec précision.",
        "new" => false,
        "discount" => 0,
        "category" => "Électronique"
    ]
];

// On s'assure que la variable est globale
global $products;
