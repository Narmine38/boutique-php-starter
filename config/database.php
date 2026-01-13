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

return $pdo;
