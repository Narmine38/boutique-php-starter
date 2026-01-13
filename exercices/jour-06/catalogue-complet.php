<?php
// Simulation de 35 produits
$products = [];
$categories_list = ["Vêtements", "Chaussures", "Accessoires", "Maison"];
for ($i = 1; $i <= 35; $i++) {
    $products[] = [
        "id" => $i,
        "name" => "Produit $i " . ($i % 2 == 0 ? "Premium" : "Standard"),
        "price" => rand(10, 200),
        "category" => $categories_list[array_rand($categories_list)],
        "inStock" => (bool)rand(0, 1)
    ];
}

// Récupération des filtres
$search = $_GET["q"] ?? "";
$selectedCategories = $_GET["category"] ?? [];
$priceMin = $_GET["price_min"] ?? 0;
$priceMax = $_GET["price_max"] ?? 1000;
$sort = $_GET["sort"] ?? "name_asc";
$page = (int)($_GET["page"] ?? 1);
if ($page < 1) $page = 1;

// Filtrage
$results = array_filter($products, function($p) use ($search, $selectedCategories, $priceMin, $priceMax) {
    if ($search !== "" && stripos($p["name"], $search) === false) return false;
    if (!empty($selectedCategories) && !in_array($p["category"], $selectedCategories)) return false;
    if ($p["price"] < $priceMin || $p["price"] > $priceMax) return false;
    return true;
});

// Tri
usort($results, function($a, $b) use ($sort) {
    switch ($sort) {
        case "price_asc": return $a["price"] <=> $b["price"];
        case "price_desc": return $b["price"] <=> $a["price"];
        case "name_desc": return strcasecmp($b["name"], $a["name"]);
        case "name_asc":
        default: return strcasecmp($a["name"], $b["name"]);
    }
});

// Pagination
$perPage = 10;
$total = count($results);
$pages = ceil($total / $perPage);
$results_paged = array_slice($results, ($page - 1) * $perPage, $perPage);

$all_categories = array_unique(array_column($products, 'category'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue Complet</title>
    <style>
        .container { display: flex; }
        .sidebar { width: 250px; padding: 20px; border-right: 1px solid #ccc; }
        .main { flex: 1; padding: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .pagination { margin-top: 20px; }
        .pagination a { padding: 5px 10px; border: 1px solid #ccc; text-decoration: none; margin-right: 5px; }
        .pagination a.active { background: #007bff; color: white; border-color: #007bff; }
    </style>
</head>
<body>
    <h1>Catalogue Complet</h1>

    <div class="container">
        <aside class="sidebar">
            <form action="catalogue-complet.php" method="GET">
                <h3>Recherche</h3>
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Rechercher...">

                <h3>Catégories</h3>
                <?php foreach ($all_categories as $cat): ?>
                    <div>
                        <input type="checkbox" name="category[]" value="<?= $cat ?>" id="cat_<?= $cat ?>" <?= in_array($cat, $selectedCategories) ? 'checked' : '' ?>>
                        <label for="cat_<?= $cat ?>"><?= $cat ?></label>
                    </div>
                <?php endforeach; ?>

                <h3>Prix</h3>
                <input type="number" name="price_min" value="<?= htmlspecialchars($priceMin) ?>" placeholder="Min" style="width: 60px;">
                à
                <input type="number" name="price_max" value="<?= htmlspecialchars($priceMax) ?>" placeholder="Max" style="width: 60px;">

                <h3>Tri</h3>
                <select name="sort">
                    <option value="name_asc" <?= $sort == "name_asc" ? "selected" : "" ?>>Nom A-Z</option>
                    <option value="name_desc" <?= $sort == "name_desc" ? "selected" : "" ?>>Nom Z-A</option>
                    <option value="price_asc" <?= $sort == "price_asc" ? "selected" : "" ?>>Prix croissant</option>
                    <option value="price_desc" <?= $sort == "price_desc" ? "selected" : "" ?>>Prix décroissant</option>
                </select>

                <div style="margin-top: 20px;">
                    <button type="submit">Appliquer</button>
                    <a href="catalogue-complet.php">Reset</a>
                </div>
            </form>
        </aside>

        <main class="main">
            <p><strong><?= $total ?> produits trouvés</strong> (Page <?= $page ?> sur <?= $pages ?>)</p>

            <div class="grid">
                <?php foreach ($results_paged as $p): ?>
                    <div class="card">
                        <h4><?= htmlspecialchars($p["name"]) ?></h4>
                        <p>Prix : <?= $p["price"] ?>€</p>
                        <p>Cat : <?= $p["category"] ?></p>
                        <p><?= $p["inStock"] ? "✅ En stock" : "❌ Indisponible" ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($pages > 1): ?>
                <div class="pagination">
                    <?php 
                    $query = $_GET; 
                    for ($i = 1; $i <= $pages; $i++): 
                        $query['page'] = $i;
                        $link = "?" . http_build_query($query);
                    ?>
                        <a href="<?= $link ?>" class="<?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
