<?php
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

// CREATE / UPDATE
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "add") {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, stock, slug) VALUES (?, ?, ?, ?)");
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST["name"])));
        $stmt->execute([$_POST["name"], $_POST["price"], $_POST["stock"], $slug]);
        header("Location: admin-produits.php");
        exit;
    }
    
    if (isset($_POST["action"]) && $_POST["action"] === "update") {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->execute([$_POST["name"], $_POST["price"], $_POST["stock"], $_POST["id"]]);
        header("Location: admin-produits.php");
        exit;
    }
}

// DELETE
if (isset($_GET["delete"])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_GET["delete"]]);
    header("Location: admin-produits.php");
    exit;
}

// Get product for edit
$editProduct = null;
if (isset($_GET["edit"])) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET["edit"]]);
    $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
}

// List products
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration des produits</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .form-section { background: #f9f9f9; padding: 15px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Administration des produits</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product["id"]; ?></td>
                <td><?php echo htmlspecialchars($product["name"]); ?></td>
                <td><?php echo number_format($product["price"], 2); ?> €</td>
                <td><?php echo $product["stock"]; ?></td>
                <td>
                    <a href="admin-produits.php?edit=<?php echo $product["id"]; ?>">Modifier</a>
                    <a href="admin-produits.php?delete=<?php echo $product["id"]; ?>" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="form-section">
        <h2><?php echo $editProduct ? "Modifier le produit" : "Ajouter un produit"; ?></h2>
        <form method="POST">
            <input type="hidden" name="action" value="<?php echo $editProduct ? "update" : "add"; ?>">
            <?php if ($editProduct): ?>
                <input type="hidden" name="id" value="<?php echo $editProduct["id"]; ?>">
            <?php endif; ?>
            
            <div>
                <label>Nom :</label><br>
                <input type="text" name="name" value="<?php echo $editProduct ? htmlspecialchars($editProduct["name"]) : ""; ?>" required>
            </div>
            <div>
                <label>Prix :</label><br>
                <input type="number" step="0.01" name="price" value="<?php echo $editProduct ? $editProduct["price"] : ""; ?>" required>
            </div>
            <div>
                <label>Stock :</label><br>
                <input type="number" name="stock" value="<?php echo $editProduct ? $editProduct["stock"] : ""; ?>" required>
            </div>
            <br>
            <button type="submit"><?php echo $editProduct ? "Mettre à jour" : "Ajouter"; ?></button>
            <?php if ($editProduct): ?>
                <a href="admin-produits.php">Annuler</a>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
