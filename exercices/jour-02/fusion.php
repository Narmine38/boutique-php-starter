<?php

$clothes = ["T-shirt", "Jean", "Pull"];
$accessories = ["Ceinture", "Montre", "Lunettes"];

$catalog = array_merge($clothes, $accessories);

echo "Nombre total de produits : " . count($catalog) . PHP_EOL;

// Ajoute un produit au début du tableau
array_unshift($catalog, "Veste");

echo "Nombre total de produits après ajout : " . count($catalog) . PHP_EOL;
var_dump($catalog);
