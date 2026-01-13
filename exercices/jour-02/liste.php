<?php

$groceries = ["Pommes", "Lait", "Pain", "Œufs", "Fromage"];

echo "Premier article : " . $groceries[0] . PHP_EOL;
echo "Dernier article : " . $groceries[count($groceries) - 1] . PHP_EOL;
echo "Nombre total d'articles : " . count($groceries) . PHP_EOL;

$groceries[] = "Beurre";
$groceries[] = "Café";

unset($groceries[2]);

var_dump($groceries);
