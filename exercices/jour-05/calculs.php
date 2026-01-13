<?php

function calculateVAT($priceExcludingTax, $rate) {
    return $priceExcludingTax * ($rate / 100);
}

function calculateIncludingTax($priceExcludingTax, $rate) {
    return $priceExcludingTax + calculateVAT($priceExcludingTax, $rate);
}

function calculateDiscount($price, $percentage) {
    return $price * (1 - $percentage / 100);
}

$priceHT = 100;
$vatRate = 20;
$discountRate = 10;

$vatAmount = calculateVAT($priceHT, $vatRate);
$priceTTC = calculateIncludingTax($priceHT, $vatRate);
$finalPrice = calculateDiscount($priceTTC, $discountRate);

echo "Prix HT : " . $priceHT . " €<br>";
echo "TVA : " . $vatAmount . " €<br>";
echo "TTC : " . $priceTTC . " €<br>";
echo "Remise : " . $discountRate . " %<br>";
echo "Prix final : " . $finalPrice . " €<br>";
