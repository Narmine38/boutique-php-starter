<?php
$status = "standby";

echo "<h3>Avec switch :</h3>";
switch ($status) {
    case 'standby':
        echo '<span style="color: orange">⏳ Commande en attente de validation</span>';
        break;
    case 'validated':
        echo '<span style="color: blue">✅ Commande validée</span>';
        break;
    case 'shipped':
        echo '<span style="color: purple">🚚 Commande expédiée</span>';
        break;
    case 'delivered':
        echo '<span style="color: green">📦 Commande livrée</span>';
        break;
    case 'canceled':
        echo '<span style="color: red">❌ Commande annulée</span>';
        break;
    default:
        echo 'Statut inconnu';
}

echo "<h3>Avec match :</h3>";
$message = match ($status) {
    'standby' => '<span style="color: orange">⏳ Commande en attente de validation</span>',
    'validated' => '<span style="color: blue">✅ Commande validée</span>',
    'shipped' => '<span style="color: purple">🚚 Commande expédiée</span>',
    'delivered' => '<span style="color: green">📦 Commande livrée</span>',
    'canceled' => '<span style="color: red">❌ Commande annulée</span>',
    default => 'Statut inconnu',
};

echo $message;
