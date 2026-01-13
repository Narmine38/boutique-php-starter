<?php
$a = "5";
$b = 3;
$c = $a + $b;

echo "--- Premier test ---\n";
var_dump($a);
var_dump($b);
var_dump($c);

echo "\n--- Deuxième test ---\n";
$price = "29.99€";
// PHP 8+ lancera un warning ou une erreur ici si la chaîne n'est pas numérique
$result = $price + 10;
var_dump($result);
