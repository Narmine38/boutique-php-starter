<?php
$age = 25;

if ($age < 18) {
    echo "minor";
} elseif ($age >= 18 && $age <= 25) {
    echo "Young adult";
} elseif ($age >= 26 && $age <= 64) {
    echo "Adult";
} else {
    echo "Senior";
}
