<?php
$products = [
    ["name" => "Produit 1", "price" => 50, "stock" => 10],
    ["name" => "Produit 2", "price" => 120, "stock" => 5], // S'arrête avant car > 100
    ["name" => "Produit 3", "price" => 20, "stock" => 0], // Sauté car stock 0
    ["name" => "Produit 4", "price" => 80, "stock" => 15],
    ["name" => "Produit 5", "price" => 110, "stock" => 20],
    ["name" => "Produit 6", "price" => 30, "stock" => 0],
    ["name" => "Produit 7", "price" => 45, "stock" => 8],
    ["name" => "Produit 8", "price" => 95, "stock" => 12],
    ["name" => "Produit 9", "price" => 10, "stock" => 2],
    ["name" => "Produit 10", "price" => 60, "stock" => 1],
];

echo "<h3>Produits filtrés (< 100€ et en stock) :</h3>";

foreach ($products as $product) {
    if ($product['stock'] == 0) {
        continue;
    }
    
    if ($product['price'] > 100) {
        break;
    }

    echo "<div>" . $product['name'] . " - " . $product['price'] . "€ (Stock: " . $product['stock'] . ")</div>";
}
