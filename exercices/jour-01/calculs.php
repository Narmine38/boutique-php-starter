<?php
$priceExcludingTax = 100;
$vat = 20; // en pourcentage
$quantity = 3;

$vatAmount = $priceExcludingTax * ($vat / 100);
$priceIncludingTax = $priceExcludingTax + $vatAmount;
$totalAmount = $priceIncludingTax * $quantity;

echo "Montant de la TVA : " . $vatAmount . "€\n";
echo "Prix TTC unitaire : " . $priceIncludingTax . "€\n";
echo "Total pour $quantity articles : " . $totalAmount . "€\n";
