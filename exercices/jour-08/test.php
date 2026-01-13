<?php

require_once 'entities/Product.php';
require_once 'entities/Category.php';
require_once 'entities/User.php';

use Entity\Product;
use Entity\Category;
use Entity\User;

$product = new Product(1, "Clavier Mécanique", "Un super clavier", 89.90, 20, "Périphérique");
$category = new Category(1, "Informatique", "Tout l'univers PC");
$user = new User("Cédric", "cedric@example.com", "secret123");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Entités Jour 08</title>
</head>
<body>
    <h1>Test des Entités</h1>

    <section>
        <h2>Produit</h2>
        <ul>
            <li>Nom : <?= $product->nom ?></li>
            <li>Prix HT : <?= $product->prix ?> €</li>
            <li>Prix TTC (20%) : <?= $product->getPriceIncludingTax() ?> €</li>
            <li>En stock : <?= $product->isInStock() ? 'Oui' : 'Non' ?></li>
        </ul>
    </section>

    <section>
        <h2>Catégorie</h2>
        <ul>
            <li>Nom : <?= $category->nom ?></li>
            <li>Slug : <?= $category->getSlug() ?></li>
        </ul>
 section>

    <section>
        <h2>Utilisateur</h2>
        <ul>
            <li>Nom : <?= $user->name ?></li>
            <li>Email : <?= $user->email ?></li>
            <li>Nouveau membre : <?= $user->isNewMember() ? 'Oui' : 'Non' ?></li>
        </ul>
    </section>
</body>
</html>
