<?php
$brand = "Nike";
$model = "Air Max";

echo "--- 3 façons d'afficher ---\n";
// 1. Concaténation
echo "Chaussures " . $brand . " " . $model . "\n";

// 2. Interpolation
echo "Chaussures $brand $model\n";

// 3. sprintf
echo sprintf("Chaussures %s %s\n", $brand, $model);

echo "\n--- Différence ' vs \" ---\n";
$price = 99.99;
echo "Prix : $price €\n";  // Affiche la valeur
echo 'Prix : $price €' . "\n";  // Affiche le nom de la variable littéralement
