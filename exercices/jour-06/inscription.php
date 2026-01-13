<?php
$errors = [];
$success = false;

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmation = $_POST['confirmation'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Username : 3-20 caractères, alphanumérique
    if (empty($username)) {
        $errors['username'] = "L'identifiant est requis.";
    } elseif (!preg_match('/^[a-zA-Z0-9]{3,20}$/', $username)) {
        $errors['username'] = "L'identifiant doit contenir entre 3 et 20 caractères alphanumériques.";
    }

    // Email : format valide
    if (empty($email)) {
        $errors['email'] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email n'est pas valide.";
    }

    // Mot de passe : minimum 8 caractères
    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit faire au moins 8 caractères.";
    }

    // Confirmation : identique au mot de passe
    if ($password !== $confirmation) {
        $errors['confirmation'] = "La confirmation ne correspond pas au mot de passe.";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        .error { color: red; font-size: 0.9em; }
        .field { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Inscription</h1>

    <?php if ($success): ?>
        <p style="color: green;">Inscription réussie !</p>
    <?php endif; ?>

    <form action="inscription.php" method="POST">
        <div class="field">
            <label for="username">Nom d'utilisateur :</label><br>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
            <?php if (isset($errors['username'])): ?>
                <div class="error"><?= $errors['username'] ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="email">Email :</label><br>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="password">Mot de passe :</label><br>
            <input type="password" name="password" id="password">
            <?php if (isset($errors['password'])): ?>
                <div class="error"><?= $errors['password'] ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="confirmation">Confirmez le mot de passe :</label><br>
            <input type="password" name="confirmation" id="confirmation">
            <?php if (isset($errors['confirmation'])): ?>
                <div class="error"><?= $errors['confirmation'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
