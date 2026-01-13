<?php

function isInStock($stock) {
    return $stock > 0;
}

function isOnSale($discount) {
    return $discount > 0;
}

function isNew($dateAdded) {
    $daysSince = (time() - strtotime($dateAdded)) / 86400;
    return $daysSince < 30;
}

function canOrder($stock, $quantity) {
    return $stock >= $quantity;
}

// Tests
var_dump(isInStock(10)); // true
var_dump(isInStock(0));  // false
echo "<br>";

var_dump(isOnSale(20)); // true
var_dump(isOnSale(0));  // false
echo "<br>";

var_dump(isNew("2026-01-01")); // true (on est le 13 jan 2026)
var_dump(isNew("2024-01-01")); // false
echo "<br>";

var_dump(canOrder(10, 5));  // true
var_dump(canOrder(10, 15)); // false
