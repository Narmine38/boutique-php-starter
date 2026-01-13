<?php
$products = [
    ["name" => "T-shirt coton", "price" => 25, "category" => "Vêtements", "inStock" => true],
    ["name" => "Jean slim", "price" => 60, "category" => "Vêtements", "inStock" => true],
    ["name" => "Pull en laine", "price" => 45, "category" => "Vêtements", "inStock" => false],
    ["name" => "Veste en cuir", "price" => 120, "category" => "Vêtements", "inStock" => true],
    ["name" => "Baskets blanches", "price" => 80, "category" => "Chaussures", "inStock" => true],
    ["name" => "Chaussettes sport", "price" => 10, "category" => "Accessoires", "inStock" => true],
    ["name" => "Casquette noire", "price" => 20, "category" => "Accessoires", "inStock" => false],
    ["name" => "Short de bain", "price" => 30, "category" => "Vêtements", "inStock" => true],
    ["name" => "Robe d'été", "price" => 50, "category" => "Vêtements", "inStock" => true],
    ["name" => "Chemise lin", "price" => 40, "category" => "Vêtements", "inStock" => true],
    ["name" => "Mocassins", "price" => 90, "category" => "Chaussures", "inStock" => false],
    ["name" => "Ceinture cuir", "price" => 35, "category" => "Accessoires", "inStock" => true],
    ["name" => "Écharpe soie", "price" => 55, "category" => "Accessoires", "inStock" => true],
    ["name" => "Montre", "price" => 150, "category" => "Accessoires", "inStock" => true],
    ["name" => "Sac à dos", "price" => 70, "category" => "Accessoires", "inStock" => true],
];

$search = $_GET['q'] ?? '';
$category = $_GET['category'] ?? '';
$priceMax = $_GET['price_max'] ?? '';
$inStockOnly = isset($_GET['in_stock']);

$results = array_filter($products, function($p) use ($search, $category, $priceMax, $inStockOnly) {
    if ($search !== '' && stripos($p['name'], $search) === false) {
        return false;
    }
    if ($category !== '' && $p['category'] !== $category) {
        return false;
    }
    if ($priceMax !== '' && $p['price'] > $priceMax) {
        return false;
    }
    if ($inStockOnly && !$p['inStock']) {
        return false;
    }
    return true;
});

$categories = array_unique(array_column($products, 'category'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue avec filtres</title>
</head>
<body>
    <h1>Catalogue</h1>

    <form action="catalogue-filtres.php" method="GET">
        <div>
            <label for="q">Recherche :</label>
            <input type="text" name="q" id="q" value="<?= htmlspecialchars($search) ?>">
        </div>
        <div>
            <label for="category">Catégorie :</label>
            <select name="category" id="category">
                <option value="">Toutes</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat ?>" <?= $category === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="price_max">Prix max :</label>
            <input type="number" name="price_max" id="price_max" value="<?= htmlspecialchars($priceMax) ?>">
        </div>
        <div>
            <input type="checkbox" name="in_stock" id="in_stock" <?= $inStockOnly ? 'checked' : '' ?>>
            <label for="in_stock">En stock uniquement</label>
        </div>
        <button type="submit">Filtrer</button>
        <a href="catalogue-filtres.php">Réinitialiser</a>
    </form>

    <hr>

    <h2>Résultats (<?= count($results) ?>) :</h2>
    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $product): ?>
                <li>
                    <strong><?= htmlspecialchars($product['name']) ?></strong> - 
                    <?= $product['price'] ?>€ - 
                    Catégorie : <?= $product['category'] ?> - 
                    <?= $product['inStock'] ? 'En stock' : 'Rupture' ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun produit ne correspond à vos critères.</p>
    <?php endif; ?>
</body>
</html>
