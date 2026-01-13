<?php
session_start();

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
            "dev",
            "dev",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e2) {
        die("❌ Erreur de connexion : " . $e2->getMessage());
    }
}

// Ajouter au panier
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_id"])) {
    $productId = (int)$_POST["product_id"];
    
    // Vérifier si le produit existe et s'il y a du stock
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        $currentQuantity = isset($_SESSION["cart"][$productId]) ? $_SESSION["cart"][$productId]["quantity"] : 0;
        
        if ($product["stock"] > $currentQuantity) {
            if (!isset($_SESSION["cart"][$productId])) {
                $_SESSION["cart"][$productId] = ["quantity" => 0];
            }
            $_SESSION["cart"][$productId]["quantity"]++;
            $_SESSION["flash_message"] = "Produit ajouté au panier !";
        } else {
            $_SESSION["flash_error"] = "Stock insuffisant !";
        }
    }
    
    header("Location: catalogue-panier.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Catalogue</title>
    <style>
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .flash { padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ma Boutique</h1>
        <a href="panier.php">Panier (<?php echo $cartCount; ?> articles)</a>
    </div>

    <?php if (isset($_SESSION["flash_message"])): ?>
        <div class="flash success"><?php echo $_SESSION["flash_message"]; unset($_SESSION["flash_message"]); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION["flash_error"])): ?>
        <div class="flash error"><?php echo $_SESSION["flash_error"]; unset($_SESSION["flash_error"]); ?></div>
    <?php endif; ?>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
        <div class="product-card">
            <h3><?php echo htmlspecialchars($product["name"]); ?></h3>
            <p>Prix : <?php echo number_format($product["price"], 2); ?> €</p>
            <p>Stock : <?php echo $product["stock"]; ?></p>
            <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                <button type="submit" <?php echo $product["stock"] <= 0 ? "disabled" : ""; ?>>
                    <?php echo $product["stock"] <= 0 ? "En rupture" : "Ajouter au panier"; ?>
                </button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
