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

// Actions du panier
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        $productId = (int)$_POST["product_id"];
        
        if ($_POST["action"] === "update") {
            $newQty = (int)$_POST["quantity"];
            if ($newQty > 0) {
                // Vérifier le stock
                $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ?");
                $stmt->execute([$productId]);
                $stock = $stmt->fetchColumn();
                
                if ($newQty <= $stock) {
                    $_SESSION["cart"][$productId]["quantity"] = $newQty;
                } else {
                    $_SESSION["cart"][$productId]["quantity"] = $stock;
                    $_SESSION["flash_error"] = "Stock limité à $stock unités.";
                }
            } else {
                unset($_SESSION["cart"][$productId]);
            }
        } elseif ($_POST["action"] === "delete") {
            unset($_SESSION["cart"][$productId]);
        }
    }
    
    if (isset($_POST["clear"])) {
        $_SESSION["cart"] = [];
    }
    
    header("Location: panier.php");
    exit;
}

$cartProducts = [];
$totalGeneral = 0;
$cartIds = array_keys($_SESSION["cart"] ?? []);

if (!empty($cartIds)) {
    $placeholders = str_repeat('?,', count($cartIds) - 1) . '?';
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($cartIds);
    $dbProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($dbProducts as $p) {
        $qty = $_SESSION["cart"][$p["id"]]["quantity"];
        $subtotal = $p["price"] * $qty;
        $totalGeneral += $subtotal;
        $cartProducts[] = array_merge($p, ["quantity" => $qty, "subtotal" => $subtotal]);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .total { font-weight: bold; font-size: 1.2em; text-align: right; margin-top: 10px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mon Panier</h1>
        <a href="catalogue-panier.php">Retour au catalogue</a>
    </div>

    <?php if (isset($_SESSION["flash_error"])): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border: 1px solid #f5c6cb;">
            <?php echo $_SESSION["flash_error"]; unset($_SESSION["flash_error"]); ?>
        </div>
    <?php endif; ?>

    <?php if (empty($cartProducts)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartProducts as $p): ?>
                <tr>
                    <td><?php echo htmlspecialchars($p["name"]); ?></td>
                    <td><?php echo number_format($p["price"], 2); ?> €</td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="product_id" value="<?php echo $p["id"]; ?>">
                            <input type="number" name="quantity" value="<?php echo $p["quantity"]; ?>" min="0" style="width: 50px;">
                            <button type="submit">OK</button>
                        </form>
                    </td>
                    <td><?php echo number_format($p["subtotal"], 2); ?> €</td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="product_id" value="<?php echo $p["id"]; ?>">
                            <button type="submit" onclick="return confirm('Retirer cet article ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">Total Général : <?php echo number_format($totalGeneral, 2); ?> €</div>

        <form method="POST" style="margin-top: 20px;">
            <button type="submit" name="clear" onclick="return confirm('Vider tout le panier ?')">Vider le panier</button>
        </form>
    <?php endif; ?>
</body>
</html>
