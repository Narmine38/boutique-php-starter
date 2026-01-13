<?php
echo "Nombres de 1 à 10 : ";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";

echo "Nombres pairs de 2 à 20 : ";
for ($i = 2; $i <= 20; $i += 2) {
    echo $i . " ";
}
echo "<br>";

echo "Compte à rebours de 10 à 0 : ";
for ($i = 10; $i >= 0; $i--) {
    echo $i . " ";
}
echo "<br>";

echo "Table de multiplication de 7 :<br>";
$nombre = 7;
for ($i = 1; $i <= 10; $i++) {
    echo "$nombre x $i = " . ($nombre * $i) . "<br>";
}
