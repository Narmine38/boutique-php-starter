<?php
session_start();

if (isset($_GET["reset"])) {
    $_SESSION["visits"] = 0;
    header("Location: compteur.php");
    exit;
}

if (!isset($_SESSION["visits"])) {
    $_SESSION["visits"] = 1;
} else {
    $_SESSION["visits"]++;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compteur de visites</title>
</head>
<body>
    <h1>Compteur de visites</h1>
    <p>Vous avez visité cette page <?php echo $_SESSION["visits"]; ?> fois</p>
    <a href="compteur.php">Rafraîchir</a> | 
    <a href="compteur.php?reset=1">Réinitialiser</a>
</body>
</html>
