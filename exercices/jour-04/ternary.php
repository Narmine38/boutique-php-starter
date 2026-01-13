<?php
$product = [
    "name" => "Clavier Mécanique",
    "price" => 80,
    "stock" => 5,
    "onSale" => true
];

$finalPrice = $product["onSale"] ? $product["price"] * 0.8 : $product["price"];
?>

<style>
    .rupture { color: red; text-decoration: line-through; }
    .disponible { color: green; }
    .old-price { text-decoration: line-through; color: gray; }
</style>

<div class="product <?= $product["stock"] > 0 ? "disponible" : "rupture" ?>">
    <h3>
        <?= $product["name"] ?> 
        <?= $product["onSale"] ? "🔥 PROMO" : "" ?>
    </h3>
    
    <?php if ($product["onSale"]): ?>
        <p>
            <span class="old-price"><?= $product["price"] ?> €</span> 
            <strong><?= $finalPrice ?> €</strong>
        </p>
    <?php else: ?>
        <p>Prix : <?= $product["price"] ?> €</p>
    <?php endif; ?>

    <p>Statut : <?= $product["stock"] > 0 ? "En stock (" . $product["stock"] . ")" : "Rupture de stock" ?></p>
</div>
