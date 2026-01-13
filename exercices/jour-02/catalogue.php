<?php

$products = [
    ["name" => "Smartphone", "price" => 599, "stock" => 10],
    ["name" => "Ordinateur Portable", "price" => 999, "stock" => 5],
    ["name" => "Casque Audio", "price" => 150, "stock" => 20],
    ["name" => "Souris Sans Fil", "price" => 30, "stock" => 50],
    ["name" => "Clavier Mécanique", "price" => 80, "stock" => 12]
];

echo "Nom du 3ème produit : " . $products[2]['name'] . PHP_EOL;
echo "Prix du 1er produit : " . $products[0]['price'] . " €" . PHP_EOL;
echo "Stock du dernier produit : " . $products[count($products) - 1]['stock'] . PHP_EOL;

// Modifie le stock du 2ème produit (ajoute 10 unités)
$products[1]['stock'] += 10;

echo "Nouveau stock du 2ème produit : " . $products[1]['stock'] . PHP_EOL;
