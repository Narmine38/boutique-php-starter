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

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Liste des produits</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product["name"]); ?></td>
                <td><?php echo number_format($product["price"], 2); ?> €</td>
                <td><?php echo $product["stock"]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
