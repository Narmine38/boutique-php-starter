<?php

require_once 'Product.php';

$products = [
    new Product(1, "iPhone 15", "Le dernier iPhone", 999.99, 10, "Smartphone"),
    new Product(2, "MacBook Air", "Puce M2", 1199.00, 5, "Ordinateur"),
    new Product(3, "AirPods Pro", "Réduction de bruit", 279.00, 15, "Accessoire"),
    new Product(4, "iPad Pro", "Écran Liquid Retina", 1069.00, 8, "Tablette"),
    new Product(5, "Apple Watch", "Série 9", 449.00, 12, "Montre")
];

$totalStock = 0;
$totalValue = 0;

foreach ($products as $product) {
    echo "Produit : {$product->nom} | Prix : {$product->prix} € | Stock : {$product->stock} | Catégorie : {$product->categorie}" . PHP_EOL;
    $totalStock += $product->stock;
    $totalValue += ($product->prix * $product->stock);
}

echo "---" . PHP_EOL;
echo "Total du stock : $totalStock" . PHP_EOL;
echo "Valeur totale du catalogue : $totalValue €" . PHP_EOL;
