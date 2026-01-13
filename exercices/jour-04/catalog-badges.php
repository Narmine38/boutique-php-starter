<?php
$products = [
    [
        "name" => "T-shirt",
        "price" => 29.99,
        "stock" => 3,
        "new" => true,
        "discount" => 0
    ],
    [
        "name" => "Jean",
        "price" => 89.99,
        "stock" => 0,
        "new" => false,
        "discount" => 20
    ],
    [
        "name" => "Casquette",
        "price" => 15.00,
        "stock" => 10,
        "new" => true,
        "discount" => 10
    ],
    [
        "name" => "Chaussettes",
        "price" => 5.00,
        "stock" => 2,
        "new" => false,
        "discount" => 0
    ]
];

// Compteurs pour les stats
$inStock = 0;
$onSale = 0;
$outOfStock = 0;

foreach ($products as $product) {
    if ($product["stock"] > 0) {
        $inStock++;
    } else {
        $outOfStock++;
    }
    
    if ($product["discount"] > 0) {
        $onSale++;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue avec Badges</title>
    <style>
        .badge { padding: 2px 5px; border-radius: 3px; font-size: 0.8em; margin-left: 5px; color: white; }
        .badge-new { background-color: green; }
        .badge-promo { background-color: orange; }
        .badge-last { background-color: red; }
        .rupture { color: red; font-weight: bold; }
        .stats { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; }
        .product-card { border: 1px solid #eee; margin: 10px; padding: 10px; width: 200px; display: inline-block; vertical-align: top; }
    </style>
</head>
<body>

<div class="stats">
    <p>Produits en stock : <?= $inStock ?></p>
    <p>Produits en promo : <?= $onSale ?></p>
    <p>Ruptures de stock : <?= $outOfStock ?></p>
</div>

<div class="catalog">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <h3>
                <?= $product["name"] ?>
                <?php if ($product["new"]): ?>
                    <span class="badge badge-new">NOUVEAU</span>
                <?php endif; ?>
                <?php if ($product["discount"] > 0): ?>
                    <span class="badge badge-promo">PROMO -<?= $product["discount"] ?>%</span>
                <?php endif; ?>
                <?php if ($product["stock"] < 5 && $product["stock"] > 0): ?>
                    <span class="badge badge-last">DERNIERS</span>
                <?php endif; ?>
            </h3>

            <p>Prix : <?= $product["price"] ?> €</p>

            <?php if ($product["stock"] === 0): ?>
                <p class="rupture">RUPTURE</p>
            <?php endif; ?>

            <button <?= $product["stock"] === 0 ? "disabled" : "" ?>>
                Ajouter au panier
            </button>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
