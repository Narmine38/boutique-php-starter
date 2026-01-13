<?php
$products = [
    1 => ["name" => "T-shirt", "price" => 29.99],
    2 => ["name" => "Jean", "price" => 79.99],
    3 => ["name" => "Pull", "price" => 49.99],
    4 => ["name" => "Casquette", "price" => 19.99],
    5 => ["name" => "Chaussettes", "price" => 9.99],
];

$id = $_GET["id"] ?? null;

if ($id && isset($products[$id])) {
    $product = $products[$id];
    echo "Produit : " . $product['name'] . " - Prix : " . $product['price'] . "€";
} else {
    echo "Produit non trouvé";
}
