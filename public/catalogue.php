<?php
session_start();
// starter-project/public/catalogue.php
$pdo = require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers.php';

// Récupération des produits depuis la BDD
$stmt = $pdo->query("SELECT p.*, c.name as category FROM products p LEFT JOIN categories c ON p.category_id = c.id");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Conversion des types pour correspondre à l'ancien format si besoin
foreach ($products as &$p) {
    $p['price'] = (float)$p['price'];
    $p['stock'] = (int)$p['stock'];
    $p['discount'] = (int)$p['discount'];
}
unset($p);

// Récupération des filtres
$search = $_GET["q"] ?? "";
$selectedCategories = $_GET["categories"] ?? [];
$priceMin = (float)($_GET["price_min"] ?? 0);
$priceMax = (float)($_GET["price_max"] ?? 999999);
$inStockOnly = isset($_GET["in_stock"]);
$sort = $_GET["sort"] ?? "name_asc";

// Filtrage
$filteredProducts = array_filter($products, function($p) use ($search, $selectedCategories, $priceMin, $priceMax, $inStockOnly) {
    if ($search !== "" && stripos($p["name"], $search) === false) return false;
    if (!empty($selectedCategories) && !in_array($p["category"], $selectedCategories)) return false;
    
    $currentPrice = isset($p["discount"]) && $p["discount"] > 0 
        ? $p["price"] * (1 - $p["discount"] / 100) 
        : $p["price"];
        
    if ($currentPrice < $priceMin || $currentPrice > $priceMax) return false;
    if ($inStockOnly && $p["stock"] <= 0) return false;
    return true;
});

// Tri
usort($filteredProducts, function($a, $b) use ($sort) {
    switch ($sort) {
        case "price_asc": return $a["price"] <=> $b["price"];
        case "price_desc": return $b["price"] <=> $a["price"];
        case "name_desc": return strcasecmp($b["name"], $a["name"]);
        case "name_asc":
        default: return strcasecmp($a["name"], $b["name"]);
    }
});

// Liste des catégories pour le filtre
$allCategories = [];
foreach ($products as $p) {
    $cat = $p['category'];
    if (!isset($allCategories[$cat])) {
        $allCategories[$cat] = 0;
    }
    $allCategories[$cat]++;
}

// Stats sur les produits filtrés
$inStockCount = 0;
$onSaleCount = 0;
$outOfStockCount = 0;

foreach ($filteredProducts as $product) {
    if ($product["stock"] > 0) {
        $inStockCount++;
    } else {
        $outOfStockCount++;
    }
    if (isset($product["discount"]) && $product["discount"] > 0) {
        $onSaleCount++;
    }
}
$cartCount = 0;
if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $item) {
        $cartCount += $item["quantity"];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - MaBoutique</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="container header__container">
        <a href="index.html" class="header__logo">🛍️ MaBoutique</a>
        <nav class="header__nav">
            <a href="index.html" class="header__nav-link">Accueil</a>
            <a href="catalogue.php" class="header__nav-link header__nav-link--active">Catalogue</a>
            <a href="contact.html" class="header__nav-link">Contact</a>
        </nav>
        <div class="header__actions">
            <a href="panier.php" class="header__cart">🛒<span class="header__cart-badge"><?= $cartCount ?></span></a>
            <a href="connexion.html" class="btn btn--primary btn--sm">Connexion</a>
        </div>
        <button class="header__menu-toggle">☰</button>
    </div>
</header>

<main class="main-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Notre Catalogue</h1>
            <p class="page-subtitle">Découvrez tous nos produits</p>
        </div>

        <div class="stats-bar" style="display: flex; gap: 20px; background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #eee;">
            <div><strong>✅ En stock :</strong> <?= $inStockCount ?></div>
            <div><strong>🔥 En promo :</strong> <?= $onSaleCount ?></div>
            <div><strong>❌ Ruptures :</strong> <?= $outOfStockCount ?></div>
        </div>

        <div class="catalog-layout">

            <aside class="catalog-sidebar">
                <form action="catalogue.php" method="GET">
                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Recherche</h3>
                        <input type="text" name="q" class="form-input" placeholder="Rechercher..." value="<?= htmlspecialchars($search) ?>">
                    </div>

                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Catégories</h3>
                        <div class="catalog-sidebar__categories">
                            <?php foreach ($allCategories as $catName => $count): ?>
                                <label class="form-checkbox">
                                    <input type="checkbox" name="categories[]" value="<?= $catName ?>" <?= in_array($catName, $selectedCategories) ? 'checked' : '' ?>>
                                    <span><?= ucfirst($catName) ?> (<?= $count ?>)</span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Prix</h3>
                        <div class="catalog-sidebar__price-inputs">
                            <div class="form-group">
                                <label class="form-label">Min</label>
                                <input type="number" name="price_min" class="form-input" placeholder="0 €" min="0" value="<?= $priceMin > 0 ? $priceMin : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Max</label>
                                <input type="number" name="price_max" class="form-input" placeholder="100 €" min="0" value="<?= $priceMax < 999999 ? $priceMax : '' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Disponibilité</h3>
                        <label class="form-checkbox">
                            <input type="checkbox" name="in_stock" value="1" <?= $inStockOnly ? 'checked' : '' ?>>
                            <span>En stock uniquement</span>
                        </label>
                    </div>

                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">

                    <button type="submit" class="btn btn--primary btn--block">Appliquer</button>
                    <a href="catalogue.php" class="btn btn--secondary btn--block mt-sm">Réinitialiser</a>
                </form>
            </aside>

            <div class="catalog-main">
                <div class="catalog-header">
                    <p><strong><?= count($filteredProducts) ?></strong> produits trouvés</p>
                    <div class="catalog-header__sort">
                        <label>Trier :</label>
                        <form action="catalogue.php" method="GET" style="display: inline;">
                            <?php foreach ($_GET as $key => $value): if ($key !== 'sort'): ?>
                                <?php if (is_array($value)): ?>
                                    <?php foreach ($value as $v): ?>
                                        <input type="hidden" name="<?= htmlspecialchars($key) ?>[]" value="<?= htmlspecialchars($v) ?>">
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                                <?php endif; ?>
                            <?php endif; endforeach; ?>
                            <select name="sort" class="form-select" style="width:auto" onchange="this.form.submit()">
                                <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Nom A-Z</option>
                                <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Nom Z-A</option>
                                <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Prix ↑</option>
                                <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Prix ↓</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="products-grid">
                    <?php foreach ($filteredProducts as $id => $product): ?>
                        <article class="product-card">
                            <div class="product-card__image-wrapper">
                                <img src="<?= $product["image"] ?>" alt="<?= $product["name"] ?>" class="product-card__image">
                                <div class="product-badges" style="position: absolute; top: 10px; left: 10px; display: flex; flex-direction: column; gap: 5px;">
                                    <?= displayBadges($product) ?>
                                    <?php if ($product["stock"] < 5 && $product["stock"] > 0): ?>
                                        <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold;">DERNIERS</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="product-card__content">
                                <a href="produit.php?id=<?= $id ?>" class="product-card__title"><?= $product["name"] ?></a>
                                <div class="product-card__price">
                                    <?php if (isset($product["discount"]) && $product["discount"] > 0): ?>
                                        <span class="product-card__price-old" style="text-decoration: line-through; color: #999; font-size: 0.9em; margin-right: 5px;"><?= formatPrice($product["price"]) ?></span>
                                        <span class="product-card__price-current" style="color: #e67e22; font-weight: bold;"><?= formatPrice(calculateDiscount($product["price"], $product["discount"])) ?></span>
                                    <?php else: ?>
                                        <span class="product-card__price-current"><?= formatPrice($product["price"]) ?></span>
                                    <?php endif; ?>
                                </div>
                                <?= displayStockStatus($product["stock"]) ?>
                                <div class="product-card__actions">
                                    <form action="panier.html" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $id ?>">
                                        <button type="submit" class="btn btn--primary btn--block" <?= $product['stock'] <= 0 ? 'disabled' : '' ?>>Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <nav class="pagination">
                    <a class="pagination__item pagination__item--disabled">←</a>
                    <a class="pagination__item pagination__item--active">1</a>
                    <a class="pagination__item">2</a>
                    <a class="pagination__item">3</a>
                    <a class="pagination__item">→</a>
                </nav>
            </div>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer__grid">
            <div class="footer__section"><h4>À propos</h4><p>MaBoutique - Shopping en ligne.</p></div>
            <div class="footer__section"><h4>Navigation</h4><ul><li><a href="index.html">Accueil</a></li><li><a href="catalogue.php">Catalogue</a></li><li><a href="contact.html">Contact</a></li></ul></div>
            <div class="footer__section"><h4>Compte</h4><ul><li><a href="connexion.html">Connexion</a></li><li><a href="inscription.html">Inscription</a></li><li><a href="panier.html">Panier</a></li></ul></div>
            <div class="footer__section"><h4>Formation</h4><ul><li><a href="#">Jour 1-5</a></li><li><a href="#">Jour 6-10</a></li><li><a href="#">Jour 11-14</a></li></ul></div>
        </div>
        <div class="footer__bottom"><p>&copy; 2024 MaBoutique</p></div>
    </div>
</footer>

</body>
</html>
