<?php
// starter-project/public/catalogue.php
require_once __DIR__ . '/../app/data.php';

// Initialisation de $products si non défini par data.php (sécurité)
if (!isset($products)) {
    $products = [];
}

// Stats
$inStockCount = 0;
$onSaleCount = 0;
$outOfStockCount = 0;

foreach ($products as $product) {
    if ($product["stock"] > 0) {
        $inStockCount++;
    } else {
        $outOfStockCount++;
    }
    if (isset($product["discount"]) && $product["discount"] > 0) {
        $onSaleCount++;
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
            <a href="panier.html" class="header__cart">🛒<span class="header__cart-badge">3</span></a>
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
                <form>
                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Recherche</h3>
                        <input type="text" name="q" class="form-input" placeholder="Rechercher...">
                    </div>

                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Catégories</h3>
                        <div class="catalog-sidebar__categories">
                            <label class="form-checkbox">
                                <input type="checkbox" name="categories[]" value="vetements">
                                <span>Vêtements (4)</span>
                            </label>
                            <label class="form-checkbox">
                                <input type="checkbox" name="categories[]" value="chaussures">
                                <span>Chaussures (1)</span>
                            </label>
                            <label class="form-checkbox">
                                <input type="checkbox" name="categories[]" value="accessoires">
                                <span>Accessoires (3)</span>
                            </label>
                        </div>
                    </div>

                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Prix</h3>
                        <div class="catalog-sidebar__price-inputs">
                            <div class="form-group">
                                <label class="form-label">Min</label>
                                <input type="number" name="price_min" class="form-input" placeholder="0 €" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Max</label>
                                <input type="number" name="price_max" class="form-input" placeholder="100 €" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="catalog-sidebar__section">
                        <h3 class="catalog-sidebar__title">Disponibilité</h3>
                        <label class="form-checkbox">
                            <input type="checkbox" name="in_stock" value="1">
                            <span>En stock uniquement</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn--primary btn--block">Appliquer</button>
                    <a href="catalogue.php" class="btn btn--secondary btn--block mt-sm">Réinitialiser</a>
                </form>
            </aside>

            <div class="catalog-main">
                <div class="catalog-header">
                    <p><strong><?= count($products) ?></strong> produits trouvés</p>
                    <div class="catalog-header__sort">
                        <label>Trier :</label>
                        <select class="form-select" style="width:auto">
                            <option>Nom A-Z</option>
                            <option>Nom Z-A</option>
                            <option>Prix ↑</option>
                            <option>Prix ↓</option>
                        </select>
                    </div>
                </div>

                <div class="products-grid">
                    <?php foreach ($products as $id => $product): ?>
                        <article class="product-card">
                            <div class="product-card__image-wrapper">
                                <img src="<?= $product["image"] ?>" alt="<?= $product["name"] ?>" class="product-card__image">
                                <div class="product-badges" style="position: absolute; top: 10px; left: 10px; display: flex; flex-direction: column; gap: 5px;">
                                    <?php if (isset($product["new"]) && $product["new"]): ?>
                                        <span style="background: #27ae60; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold;">NOUVEAU</span>
                                    <?php endif; ?>
                                    <?php if (isset($product["discount"]) && $product["discount"] > 0): ?>
                                        <span style="background: #e67e22; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold;">PROMO -<?= $product["discount"] ?>%</span>
                                    <?php endif; ?>
                                    <?php if ($product["stock"] < 5 && $product["stock"] > 0): ?>
                                        <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold;">DERNIERS</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="product-card__content">
                                <a href="produit.php?id=<?= $id ?>" class="product-card__title"><?= $product["name"] ?></a>
                                <div class="product-card__price">
                                    <?php if (isset($product["discount"]) && $product["discount"] > 0): ?>
                                        <span class="product-card__price-old" style="text-decoration: line-through; color: #999; font-size: 0.9em; margin-right: 5px;"><?= number_format($product["price"], 2, ',', ' ') ?> €</span>
                                        <span class="product-card__price-current" style="color: #e67e22; font-weight: bold;"><?= number_format($product["price"] * (1 - $product["discount"] / 100), 2, ',', ' ') ?> €</span>
                                    <?php else: ?>
                                        <span class="product-card__price-current"><?= number_format($product["price"], 2, ',', ' ') ?> €</span>
                                    <?php endif; ?>
                                </div>
                                <?php if ($product['stock'] > 0): ?>
                                    <p class="product-card__stock product-card__stock--available">✓ En stock (<?= $product["stock"] ?>)</p>
                                <?php else: ?>
                                    <p class="product-card__stock product-card__stock--out" style="color: red; font-weight: bold;">❌ RUPTURE</p>
                                <?php endif; ?>
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
