<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
        "root",
        "", // J'utilise root sans mot de passe par défaut sur Windows/WAMP/XAMPP souvent
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "✅ Connexion réussie !";
} catch (PDOException $e) {
    // Tentative avec dev/dev si root/vide échoue (souvent utilisé dans les environnements de formation)
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=boutique;charset=utf8mb4",
            "dev",
            "dev",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        echo "✅ Connexion réussie ! (avec credentials dev)";
    } catch (PDOException $e2) {
        echo "❌ Erreur : " . $e2->getMessage();
    }
}
