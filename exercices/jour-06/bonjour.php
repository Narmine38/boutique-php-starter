<?php
$name = $_GET['name'] ?? 'visiteur';
$age = $_GET['age'] ?? null;

if ($age) {
    echo "Bonjour $name, vous avez $age ans !";
} else {
    echo "Bonjour $name !";
}
