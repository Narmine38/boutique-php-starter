<?php
$products = [
    [
        "nom" => "T-shirt Premium",
        "prix" => 29.99,
        "stock" => 150,
        "image" => "https://picsum.photos/id/10/300/200"
    ],
    [
        "nom" => "Jean Denim",
        "prix" => 59.99,
        "stock" => 85,
        "image" => "https://picsum.photos/id/11/300/200"
    ],
    [
        "nom" => "Veste d'Hiver",
        "prix" => 89.99,
        "stock" => 40,
        "image" => "https://picsum.photos/id/12/300/200"
    ],
    [
        "nom" => "Chaussures Sport",
        "prix" => 75.00,
        "stock" => 60,
        "image" => "https://picsum.photos/id/13/300/200"
    ],
    [
        "nom" => "Sac à Dos",
        "prix" => 45.00,
        "stock" => 110,
        "image" => "https://picsum.photos/id/14/300/200"
    ],
    [
        "nom" => "Montre Digitale",
        "prix" => 120.00,
        "stock" => 25,
        "image" => "https://picsum.photos/id/15/300/200"
    ],
    [
        "nom" => "Casque Audio",
        "prix" => 149.99,
        "stock" => 0,
        "image" => "https://picsum.photos/id/16/300/200"
    ],
    [
        "nom" => "Appareil Photo",
        "prix" => 450.00,
        "stock" => 5,
        "image" => "https://picsum.photos/id/17/300/200"
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue</title>
    <style>
        .grille { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .produit { border: 1px solid #ddd; padding: 15px; text-align: center; }
        .produit img { max-width: 100%; height: auto; }
        .rupture { color: red; font-weight: bold; }
        .en-stock { color: green; font-weight: bold; }
        .prix { font-size: 1.2em; }
    </style>
</head>
<body>
    <h1>Notre Catalogue</h1>
    <p><?= count($products) ?> produits affichés</p>
    <div class="grille">
        <?php foreach ($products as $product): ?>
            <div class="produit">
                <img src="<?= $product['image'] ?>" alt="<?= $product['nom'] ?>">
                <h3><?= $product['nom'] ?></h3>
                <p class="prix"><?= number_format($product['prix'], 2, ',', ' ') ?> €</p>
                <?php if ($product['stock'] > 0): ?>
                    <p class="en-stock">En stock</p>
                <?php else: ?>
                    <p class="rupture">Rupture</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
