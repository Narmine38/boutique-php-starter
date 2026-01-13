<?php

$categories = ["Vêtements", "Chaussures", "Accessoires", "Sport"];

// Vérifie si "Chaussures" existe
if (in_array("Chaussures", $categories)) {
    echo "Chaussures : Trouvé !" . PHP_EOL;
} else {
    echo "Chaussures : Non trouvé" . PHP_EOL;
}

// Vérifie si "Électronique" existe
if (in_array("Électronique", $categories)) {
    echo "Électronique : Trouvé !" . PHP_EOL;
} else {
    echo "Électronique : Non trouvé" . PHP_EOL;
}

// Utilise array_search() pour trouver l'index de "Sport"
$indexSport = array_search("Sport", $categories);
echo "L'index de 'Sport' est : " . $indexSport . PHP_EOL;
