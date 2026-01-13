<?php
$firstNames = ["Pierre", "Marie", "Jean", "Sophie", "Lucas"];

echo "<ul>";
$i = 1;
foreach ($firstNames as $firstName) {
    echo "<li>$i. $firstName</li>";
    $i++;
}
echo "</ul>";
