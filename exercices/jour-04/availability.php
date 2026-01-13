<?php
$stock = 10;
$active = true;
$promoEndDate = "2026-12-31";

$isAvailable = $stock > 0 && $active;
$isOnSale = strtotime(date("Y-m-d")) < strtotime($promoEndDate);

if ($isAvailable) {
    echo "Product is available\n";
} else {
    echo "Product is not available\n";
}

if ($isOnSale) {
    echo "Product is on sale\n";
} else {
    echo "Product is not on sale\n";
}
