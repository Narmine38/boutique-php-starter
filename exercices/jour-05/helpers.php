<?php

function formatPrice($amount, $currency = "€") {
    return number_format($amount, 2, ",", " ") . " " . $currency;
}

function isInStock($stock) {
    return $stock > 0;
}

function calculateIncludingTax($priceExcludingTax, $rate = 20) {
    return $priceExcludingTax * (1 + $rate / 100);
}
