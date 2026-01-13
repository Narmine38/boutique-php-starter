<?php
$products = [];

for ($i = 1; $i <= 10; $i++) {
    $products[] = [
        "name" => "Produit $i",
        "price" => rand(10, 100),
        "stock" => rand(0, 50)
    ];
}

echo "<h3>Affichage var_dump()</h3>";
var_dump($products);

echo "<h3>Affichage HTML</h3>";
foreach ($products as $product) {
    echo "<div>";
    echo "<strong>" . $product['name'] . "</strong> - ";
    echo "Prix : " . $product['price'] . "€ - ";
    echo "Stock : " . $product['stock'];
    echo "</div>";
}
