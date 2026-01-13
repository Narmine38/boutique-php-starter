<?php
require_once "helpers.php";

$priceHT = 1234.5;
$priceTTC = calculateIncludingTax($priceHT);
$formattedPrice = formatPrice($priceTTC);

echo "Prix HT : " . $priceHT . " €<br>";
echo "Prix TTC formaté : " . $formattedPrice . "<br>";

if (isInStock(10)) {
    echo "Le produit est disponible.";
}
