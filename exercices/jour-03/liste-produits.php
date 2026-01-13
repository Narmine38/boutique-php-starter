<?php
$products = [
    [
        "name" => "T-shirt Premium",
        "price" => 29.99,
        "stock" => 150
    ],
    [
        "name" => "Jean Denim",
        "price" => 59.99,
        "stock" => 85
    ],
    [
        "name" => "Veste d'Hiver",
        "price" => 89.99,
        "stock" => 40
    ],
    [
        "name" => "Chaussures Sport",
        "price" => 75.00,
        "stock" => 60
    ],
    [
        "name" => "Sac à Dos",
        "price" => 45.00,
        "stock" => 110
    ]
];

foreach ($products as $product) {
    echo "<article>";
    echo "<h3>" . $product['name'] . "</h3>";
    echo "<p class=\"prix\">" . number_format($product['price'], 2) . " €</p>";
    echo "<p class=\"stock\">Stock : " . $product['stock'] . "</p>";
    echo "</article>";
}
