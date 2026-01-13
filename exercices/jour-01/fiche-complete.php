<?php
$name = "Écran PC UltraWide";
$description = "Un écran 34 pouces parfait pour le gaming et la productivité.";
$priceHT = 349.99;
$vatRate = 20; // 20%
$stock = 12;
$discount = 10; // 10% de remise (Bonus)

// Calculs
$vatAmount = $priceHT * ($vatRate / 100);
$priceTTC = $priceHT + $vatAmount;
$discountAmount = $priceTTC * ($discount / 100);
$finalPrice = $priceTTC - $discountAmount;

// Formatage
function formatPrice($price) {
    return number_format($price, 2, ',', ' ') . " €";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?> - Fiche Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            max-width: 600px;
            margin: 50px auto;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .stock-badge {
            font-size: 0.9rem;
        }
        .price-ttc {
            font-size: 1.5rem;
            color: #2c3e50;
            font-weight: bold;
        }
        .price-discounted {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.8rem;
        }
        .old-price {
            text-decoration: line-through;
            color: #95a5a6;
            font-size: 1.2rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="card product-card">
            <div class="card-body">
                <h1 class="card-title text-primary"><?= $name ?></h1>
                <p class="card-text text-muted"><?= $description ?></p>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1">Prix HT : <?= formatPrice($priceHT) ?></p>
                        <p class="mb-1">TVA (<?= $vatRate ?>%) : <?= formatPrice($vatAmount) ?></p>
                        <p class="mb-1">Prix TTC : <span class="<?= $discount > 0 ? 'old-price' : 'price-ttc' ?>"><?= formatPrice($priceTTC) ?></span></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <?php if ($discount > 0): ?>
                            <div class="badge bg-danger mb-2">-<?= $discount ?>% PROMO</div>
                            <p class="price-discounted mb-0"><?= formatPrice($finalPrice) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-3">
                    <?php if ($stock > 0): ?>
                        <span class="badge bg-success stock-badge">En stock (<?= $stock ?> disponibles)</span>
                    <?php else: ?>
                        <span class="badge bg-danger stock-badge">Rupture de stock</span>
                    <?php endif; ?>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-primary w-100 <?= $stock <= 0 ? 'disabled' : '' ?>">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
