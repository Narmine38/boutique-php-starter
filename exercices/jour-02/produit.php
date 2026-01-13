<?php

$product = [
    "name" => "Clavier Mécanique",
    "description" => "Un clavier rétroéclairé avec switchs rouges.",
    "price" => 89.99,
    "stock" => 15,
    "category" => "Informatique",
    "brand" => "KeyMaster"
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche Produit</title>
</head>
<body>
    <h1>Fiche Produit</h1>
    <ul>
        <li><strong>Nom :</strong> <?= $product['name'] ?></li>
        <li><strong>Description :</strong> <?= $product['description'] ?></li>
        <li><strong>Prix :</strong> <?= $product['price'] ?> €</li>
        <li><strong>Stock :</strong> <?= $product['stock'] ?></li>
        <li><strong>Catégorie :</strong> <?= $product['category'] ?></li>
        <li><strong>Marque :</strong> <?= $product['brand'] ?></li>
    </ul>

    <?php
    $product['dateAdded'] = date('Y-m-d');
    $product['price'] *= 0.9; // Remise de 10%
    ?>

    <p>Nouveau prix après remise : <?= $product['price'] ?> €</p>
    <p>Date d'ajout : <?= $product['dateAdded'] ?></p>

    <hr>
    <p>Question : Que se passe-t-il si tu accèdes à une clé qui n'existe pas ?</p>
    <p>Réponse : PHP génère un avertissement (Warning: Undefined array key) et retourne la valeur null.</p>
</body>
</html>
