<?php
require_once "ecommerce-helpers.php";

echo "<h1>Tests Ecommerce Helpers</h1>";

echo "<h2>Calculs et Formatage</h2>";
$priceHT = 1000;
$priceTTC = calculateIncludingTax($priceHT);
echo "1000 € HT -> TTC : " . formatPrice($priceTTC) . "<br>";
echo "Remise 10% sur " . formatPrice($priceTTC) . " : " . formatPrice(calculateDiscount($priceTTC, 10)) . "<br>";

$cart = [10.5, 20.0, 5.25];
echo "Total panier [10.5, 20.0, 5.25] : " . formatPrice(calculateTotal($cart)) . "<br>";

echo "Date formatée (2024-01-15) : " . formatDate("2024-01-15") . "<br>";

echo "<h2>Affichage</h2>";
echo "Stock 10 : " . displayStockStatus(10) . "<br>";
echo "Stock 0 : " . displayStockStatus(0) . "<br>";

$product = [
    'promo' => true,
    'date_added' => date("Y-m-d") // Aujourd'hui
];
echo "Badges produit (promo + nouveau) : " . displayBadges($product) . "<br>";

echo "<h2>Validation</h2>";
var_dump(validateEmail("test@example.com")); // true
var_dump(validateEmail("invalid-email")); // false
echo "<br>";
var_dump(validatePrice(100)); // true
var_dump(validatePrice(-5)); // false
echo "<br>";

echo "<h2>Debug (commenter pour voir le reste)</h2>";
// dump_and_die("iPhone", 999.99, ["test" => 123]);
echo "Si vous voyez ceci, dump_and_die n'a pas été appelé.";
