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
        return "<span style=\"color: green;\">En stock</span>";
    }
    return "<span style=\"color: red;\">Rupture</span>";
}

function displayBadges(array $product): string {
    $badges = "";
    if (isset($product['promo']) && $product['promo']) {
        $badges .= "<span class=\"badge\" style=\"background: red; color: white; margin-right: 5px;\">PROMO</span>";
    }
    if (isset($product['date_added']) && (time() - strtotime($product['date_added'])) / 86400 < 30) {
        $badges .= "<span class=\"badge\" style=\"background: blue; color: white;\">NOUVEAU</span>";
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
        echo '<pre style="background: #1e1e1e; color: #4ec9b0; padding: 20px; border-radius: 5px; margin-bottom: 10px;">';
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
