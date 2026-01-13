<?php

$product = [
    "name" => "T-shirt Premium",
    "description" => "Un t-shirt en coton bio très confortable.",
    "price" => 29.99,
    "images" => [
        "https://example.com/img1.jpg",
        "https://example.com/img2.jpg",
        "https://example.com/img3.jpg"
    ],
    "sizes" => ["S", "M", "L", "XL"],
    "reviews" => [
        [
            "author" => "Alice",
            "rating" => 5,
            "comment" => "Super qualité !"
        ],
        [
            "author" => "Bob",
            "rating" => 4,
            "comment" => "Taille un peu grand mais très beau."
        ]
    ]
];

echo "La deuxième image : " . $product['images'][1] . PHP_EOL;

// Note: L'énoncé demande "Le nombre de tailles disponibles (x éléments en taille S, x éléments en taille M, etc)"
// Mais $product['sizes'] est un tableau indexé simple ["S", "M", "L", "XL"]. 
// Je vais afficher le nombre total de tailles et lister les tailles.
echo "Nombre de tailles disponibles : " . count($product['sizes']) . " (" . implode(", ", $product['sizes']) . ")" . PHP_EOL;

echo "La note du premier avis : " . $product['reviews'][0]['rating'] . "/5" . PHP_EOL;
