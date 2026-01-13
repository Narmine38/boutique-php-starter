<?php
// starter-project/public/produit.php
require_once __DIR__ . '/../app/data.php';
require_once __DIR__ . '/../app/helpers.php';

$id = $_GET['id'] ?? null;

if ($id === null || !isset($products[$id])) {
    // Redirection ou message d'erreur si le produit n'existe pas
    header('Location: catalogue.php');
    exit;
}

$product = $products[$id];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?> - MaBoutique</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="container header__container">
        <a href="index.html" class="header__logo">🛍️ MaBoutique</a>
        <nav class="header__nav">
            <a href="index.html" class="header__nav-link">Accueil</a>
            <a href="catalogue.php" class="header__nav-link">Catalogue</a>
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
        <div class="product-detail">
            <div class="product-detail__grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 40px;">
                <div class="product-detail__image-wrapper">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" style="width: 100%; border-radius: 8px;">
                </div>
                <div class="product-detail__info">
                    <div class="product-badges" style="margin-bottom: 10px; display: flex; gap: 5px;">
                        <?= displayBadges($product) ?>
                    </div>
                    <h1 class="page-title" style="margin-bottom: 10px;"><?= $product['name'] ?></h1>
                    <p class="product-category" style="color: #777; margin-bottom: 20px;">Catégorie : <?= ucfirst($product['category']) ?></p>
                    
                    <div class="product-price" style="font-size: 1.5em; margin-bottom: 20px;">
                        <?php if (isset($product["discount"]) && $product["discount"] > 0): ?>
                            <span style="text-decoration: line-through; color: #999; margin-right: 10px;"><?= formatPrice($product["price"]) ?></span>
                            <span style="color: #e67e22; font-weight: bold;"><?= formatPrice(calculateDiscount($product["price"], $product["discount"])) ?></span>
                            <span style="background: #e67e22; color: white; font-size: 0.5em; padding: 2px 6px; border-radius: 4px; vertical-align: middle;">-<?= $product["discount"] ?>%</span>
                        <?php else: ?>
                            <span style="font-weight: bold;"><?= formatPrice($product["price"]) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="product-description" style="margin-bottom: 30px; line-height: 1.6;">
                        <p><?= $product['description'] ?? "Aucune description disponible pour ce produit." ?></p>
                    </div>

                    <div class="product-status" style="margin-bottom: 20px;">
                        <?= displayStockStatus($product["stock"]) ?>
                        <?php if ($product["stock"] > 0 && $product["stock"] < 5): ?>
                            <p style="color: #e74c3c; font-weight: bold; margin-top: 5px;">Plus que <?= $product["stock"] ?> exemplaires en stock !</p>
                        <?php endif; ?>
                    </div>

                    <form action="panier.html" method="POST">
                        <input type="hidden" name="product_id" value="<?= $id ?>">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" class="form-input" style="width: 70px;" <?= $product['stock'] <= 0 ? 'disabled' : '' ?>>
                            <button type="submit" class="btn btn--primary" style="flex: 1;" <?= $product['stock'] <= 0 ? 'disabled' : '' ?>>
                                <?= $product['stock'] <= 0 ? 'Rupture de stock' : 'Ajouter au panier' ?>
                            </button>
                        </div>
                    </form>

                    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                        <a href="catalogue.php" style="color: #3498db; text-decoration: none;">← Retour au catalogue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer" style="margin-top: 60px;">
    <div class="container">
        <div class="footer__grid">
            <div class="footer__section"><h4>À propos</h4><p>MaBoutique - Shopping en ligne.</p></div>
            <div class="footer__section"><h4>Navigation</h4><ul><li><a href="index.html">Accueil</a></li><li><a href="catalogue.php">Catalogue</a></li><li><a href="contact.html">Contact</a></li></ul></div>
            <div class="footer__section"><h4>Compte</h4><ul><li><a href="connexion.html">Connexion</a></li><li><a href="inscription.html">Inscription</a></li><li><a href="panier.html">Panier</a></li></ul></div>
        </div>
        <div class="footer__bottom"><p>&copy; 2024 MaBoutique</p></div>
    </div>
</footer>

</body>
</html>
