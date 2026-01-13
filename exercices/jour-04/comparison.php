<?php
$a = 0;
$b = "";
$c = null;
$d = false;
$e = "0";

echo "Comparaisons avec == (loose comparison) :\n";
echo "0 == \"\" : "; var_dump($a == $b);
echo "0 == null : "; var_dump($a == $c);
echo "0 == false : "; var_dump($a == $d);
echo "0 == \"0\" : "; var_dump($a == $e);

echo "\nComparaisons avec === (strict comparison) :\n";
echo "0 === \"\" : "; var_dump($a === $b);
echo "0 === null : "; var_dump($a === $c);
echo "0 === false : "; var_dump($a === $d);
echo "0 === \"0\" : "; var_dump($a === $e);

/*
❓ Question : Dans quel cas == donne un résultat inattendu ?
Réponse : Le PHP considère 0, une chaîne vide, null et false comme équivalents lors d'une comparaison non stricte (==). 
Cela peut être inattendu quand on veut distinguer une valeur numérique 0 d'une absence de saisie (chaîne vide) ou d'un booléen false.
*/
