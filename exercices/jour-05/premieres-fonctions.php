<?php

function greet() {
    echo "Bienvenue sur la boutique !<br>";
}

function greetClient($name) {
    echo "Bonjour $name !<br>";
}

// Appels des fonctions
greet();
greetClient("Alice");
greetClient("Bob");
greet();
