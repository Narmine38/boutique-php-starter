<?php
$products = [
    ["name" => "T-shirt coton", "price" => 25],
    ["name" => "Jean slim", "price" => 60],
    ["name" => "Pull en laine", "price" => 45],
    ["name" => "Veste en cuir", "price" => 120],
    ["name" => "Baskets blanches", "price" => 80],
    ["name" => "Chaussettes sport", "price" => 10],
    ["name" => "Casquette noire", "price" => 20],
    ["name" => "Short de bain", "price" => 30],
    ["name" => "Robe d'été", "price" => 50],
    ["name" => "Chemise lin", "price" => 40],
];

$search = $_GET['q'] ?? '';
$results = [];

if ($search !== '') {
    foreach ($products as $product) {
        if (stripos($product['name'], $search) !== false) {
            $results[] = $product;
        }
    }
} else {
    $results = $products;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche de produits</title>
</head>
<body>
    <h1>Recherche de produits</h1>

    <form action="recherche.php" method="GET">
        <input type="text" name="q" placeholder="Rechercher un produit..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <h2>Résultats :</h2>
    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $product): ?>
                <li><?= htmlspecialchars($product['name']) ?> - <?= $product['price'] ?>€</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun résultat pour "<?= htmlspecialchars($search) ?>"</p>
    <?php endif; ?>
</body>
</html>
