<?php
$products = [
    ["name" => "Produit 1", "price" => 20, "stock" => 10, "category" => "A"],
    ["name" => "Produit 2", "price" => 60, "stock" => 5, "category" => "B"],
    ["name" => "Produit 3", "price" => 30, "stock" => 0, "category" => "A"],
    ["name" => "Produit 4", "price" => 45, "stock" => 8, "category" => "C"],
    ["name" => "Produit 5", "price" => 100, "stock" => 2, "category" => "B"],
    ["name" => "Produit 6", "price" => 10, "stock" => 20, "category" => "A"],
    ["name" => "Produit 7", "price" => 55, "stock" => 0, "category" => "C"],
    ["name" => "Produit 8", "price" => 40, "stock" => 12, "category" => "B"],
    ["name" => "Produit 9", "price" => 15, "stock" => 7, "category" => "A"],
    ["name" => "Produit 10", "price" => 80, "stock" => 1, "category" => "C"],
];

$foundCount = 0;
$totalCount = count($products);

echo "<ul>";
foreach ($products as $product) {
    if ($product["stock"] <= 0 || $product["price"] >= 50) {
        continue;
    }
    
    echo "<li>" . $product["name"] . " - " . $product["price"] . "€ (Stock: " . $product["stock"] . ")</li>";
    $foundCount++;
}
echo "</ul>";

echo "<p>$foundCount produits trouvés sur $totalCount</p>";
