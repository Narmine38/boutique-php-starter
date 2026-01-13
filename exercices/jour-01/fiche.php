<?php
$name = "Souris Gamer";
$price = 45.50;
$stock = 5;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $name ?></title>
</head>
<body>
    <h1><?= $name ?></h1>
    <p>Prix : <?= $price ?> €</p>
    <span>Stock : <?= $stock > 0 ? "En stock" : "Rupture" ?></span>
</body>
</html>
