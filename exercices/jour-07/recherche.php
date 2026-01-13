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

$search = $_GET["search"] ?? "";
$products = [];

if ($search !== "") {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
    $stmt->execute(['%' . $search . '%']);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <form method="GET">
        <input type="text" name="search" placeholder="Nom du produit..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Rechercher</button>
    </form>

    <?php if ($search !== ""): ?>
        <h2>Résultats pour "<?php echo htmlspecialchars($search); ?>"</h2>
        <?php if (empty($products)): ?>
            <p>Aucun produit trouvé.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li><?php echo htmlspecialchars($product["name"]); ?> - <?php echo number_format($product["price"], 2); ?> €</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
