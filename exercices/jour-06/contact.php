<?php
$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name)) {
        $errors[] = "Le nom est requis.";
    }

    if (empty($email)) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }

    if (empty($message)) {
        $errors[] = "Le message est requis.";
    } elseif (strlen($message) < 10) {
        $errors[] = "Le message doit faire au moins 10 caractères.";
    }

    if (empty($errors)) {
        $data = [
            'name' => htmlspecialchars($name),
            'email' => htmlspecialchars($email),
            'message' => htmlspecialchars($message),
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>
    <h1>Contactez-nous</h1>

    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (!empty($data)): ?>
        <div style="background: #e0ffe0; padding: 10px; border: 1px solid green;">
            <h2>Données reçues :</h2>
            <p><strong>Nom :</strong> <?= $data['name'] ?></p>
            <p><strong>Email :</strong> <?= $data['email'] ?></p>
            <p><strong>Message :</strong> <?= $data['message'] ?></p>
        </div>
    <?php endif; ?>

    <form action="contact.php" method="POST">
        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
            <label for="message">Message :</label>
            <textarea name="message" id="message"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
