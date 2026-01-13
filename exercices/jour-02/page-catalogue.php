<?php

$products = [
    ["name" => "T-shirt Bio", "price" => 25, "stock" => 100],
    ["name" => "Jean Slim", "price" => 50, "stock" => 45],
    ["name" => "Veste en cuir", "price" => 120, "stock" => 12],
    ["name" => "Casquette", "price" => 15, "stock" => 80],
    ["name" => "Chaussettes", "price" => 8, "stock" => 200],
    ["name" => "Sweat à capuche", "price" => 45, "stock" => 30]
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue</title>
    <style>
        .produit { border: 1px solid #ccc; padding: 10px; margin: 10px; width: 200px; display: inline-block; vertical-align: top; }
        .prix { font-weight: bold; color: green; }
        .stock { font-style: italic; }
    </style>
</head>
<body>
    <h1>Notre Catalogue</h1>

    <div class="produit">
        <h2><?= $products[0]["name"] ?></h2>
        <p class="prix"><?= $products[0]["price"] ?> €</p>
        <p class="stock">Stock : <?= $products[0]["stock"] ?></p>
    </div>

    <div class="produit">
        <h2><?= $products[1]["name"] ?></h2>
        <p class="prix"><?= $products[1]["price"] ?> €</p>
        <p class="stock">Stock : <?= $products[1]["stock"] ?></p>
    </div>

    <div class="produit">
        <h2><?= $products[2]["name"] ?></h2>
        <p class="prix"><?= $products[2]["price"] ?> €</p>
        <p class="stock">Stock : <?= $products[2]["stock"] ?></p>
    </div>

    <div class="produit">
        <h2><?= $products[3]["name"] ?></h2>
        <p class="prix"><?= $products[3]["price"] ?> €</p>
        <p class="stock">Stock : <?= $products[3]["stock"] ?></p>
    </div>

    <div class="produit">
        <h2><?= $products[4]["name"] ?></h2>
        <p class="prix"><?= $products[4]["price"] ?> €</p>
        <p class="stock">Stock : <?= $products[4]["stock"] ?></p>
    </div>

    <div class="produit">
        <h2><?= $products[5]["name"] ?></h2>
        <p class="prix"><?= $products[5]["price"] ?> €</p>
        <p class="stock">Stock : <?= $products[5]["stock"] ?></p>
    </div>
</body>
</html>
