<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Tableau de bord</h1>
    <p>Bonjour <?php echo htmlspecialchars($_SESSION["user"]); ?> !</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
