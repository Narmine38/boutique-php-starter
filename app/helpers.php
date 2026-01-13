<?php

/**
 * Fonctions de calcul
 */

function calculateIncludingTax(float $priceExcludingTax, float $vat = 20): float {
    return $priceExcludingTax * (1 + $vat / 100);
}

function calculateDiscount(float $price, float $percentage): float {
    return $price * (1 - $percentage / 100);
}

function calculateTotal(array $cart): float {
    return array_sum($cart);
}

/**
 * Fonctions de formatage
 */

function formatPrice(float $amount): string {
    return number_format($amount, 2, ",", " ") . " €";
}

function formatDate(string $date): string {
    $months = [
        "01" => "janvier", "02" => "février", "03" => "mars", "04" => "avril",
        "05" => "mai", "06" => "juin", "07" => "juillet", "08" => "août",
        "09" => "septembre", "10" => "octobre", "11" => "novembre", "12" => "décembre"
    ];
    $timestamp = strtotime($date);
    $day = date("j", $timestamp);
    $monthNum = date("m", $timestamp);
    $year = date("Y", $timestamp);
    
    return "$day " . $months[$monthNum] . " $year";
}

/**
 * Fonctions d'affichage
 */

function displayStockStatus(int $stock): string {
    if ($stock > 0) {
        return "<p class=\"product-card__stock product-card__stock--available\">✓ En stock ($stock)</p>";
    }
    return "<p class=\"product-card__stock product-card__stock--out\" style=\"color: red; font-weight: bold;\">❌ RUPTURE</p>";
}

function displayBadges(array $product): string {
    $badges = "";
    if (isset($product['promo']) && $product['promo']) {
        $badges .= "<span class=\"badge promo\" style=\"background: red; color: white; margin-right: 5px;\">PROMO</span>";
    } elseif (isset($product['discount']) && $product['discount'] > 0) {
        $badges .= "<span class=\"badge promo\" style=\"background: #e67e22; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; margin-right: 5px;\">PROMO -" . $product['discount'] . "%</span>";
    }
    
    if (isset($product['date_ajout']) && (time() - strtotime($product['date_ajout'])) / 86400 < 30) {
        $badges .= "<span class=\"badge nouveau\" style=\"background: blue; color: white; margin-right: 5px;\">NOUVEAU</span>";
    } elseif (isset($product['new']) && $product['new']) {
        $badges .= "<span class=\"badge nouveau\" style=\"background: #27ae60; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; margin-right: 5px;\">NOUVEAU</span>";
    }
    
    return $badges;
}

/**
 * Fonctions de validation
 */

function validateEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePrice(mixed $price): bool {
    return is_numeric($price) && $price >= 0;
}

/**
 * Fonction de debug
 */

function dump_and_die(mixed ...$vars): void {
    foreach ($vars as $var) {
        echo '<pre style="background: #1e1e1e; color: #4ec9b0; padding: 20px; border-radius: 5px; margin-bottom: 10px; text-align: left;">';
        $type = gettype($var);
        echo "Type: $type\n";
        if (is_string($var)) {
            echo "Length: " . strlen($var) . "\n";
        } elseif (is_array($var)) {
            echo "Count: " . count($var) . "\n";
        }
        echo "Value: ";
        var_dump($var);
        echo '</pre>';
    }
    die();
}
