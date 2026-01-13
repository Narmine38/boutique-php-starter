<?php

function displayBadge($text, $color) {
    return "<span class=\"badge\" style=\"background: $color; color: white; padding: 5px; border-radius: 3px;\">$text</span>";
}

function displayPrice($price, $discount = 0) {
    if ($discount > 0) {
        $discountedPrice = $price * (1 - $discount / 100);
        return "<span style=\"text-decoration: line-through; color: red;\">$price €</span> <strong>$discountedPrice €</strong>";
    }
    return "<strong>$price €</strong>";
}

function displayStock($quantity) {
    if ($quantity > 10) {
        return "<span style=\"color: green;\">En stock ($quantity)</span>";
    } elseif ($quantity > 0) {
        return "<span style=\"color: orange;\">Plus que $quantity en stock !</span>";
    } else {
        return "<span style=\"color: red;\">Rupture de stock</span>";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Affichage Produit</title>
</head>
<body>
    <h1>Exemples d'affichage</h1>
    <p>Badge : <?php echo displayBadge("PROMO", "red"); ?> <?php echo displayBadge("NOUVEAU", "blue"); ?></p>
    <p>Prix avec remise : <?php echo displayPrice(100, 20); ?></p>
    <p>Prix sans remise : <?php echo displayPrice(50); ?></p>
    <p>Stock élevé : <?php echo displayStock(25); ?></p>
    <p>Stock faible : <?php echo displayStock(3); ?></p>
    <p>Hors stock : <?php echo displayStock(0); ?></p>
</body>
</html>
