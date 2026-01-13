<?php
$person = [
    "name" => "Thomas",
    "age" => 28,
    "city" => "Paris",
    "job" => "Développeur"
];

foreach ($person as $key => $value) {
    echo "<strong>" . ucfirst($key) . "</strong> : " . $value . "<br>";
}
