<?php

class Category {
    public int $id;
    public string $nom;
    public string $description;

    public function __construct(int $id, string $nom, string $description) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
    }

    public function getSlug(): string {
        $slug = strtolower($this->nom);
        $slug = str_replace(' ', '-', $slug);
        // On pourrait ajouter d'autres remplacements pour les accents si nécessaire
        return $slug;
    }
}

// Tests
$cat1 = new Category(1, "Électroménager Cuisine", "Tout pour la cuisine");
$cat2 = new Category(2, "Jeux Vidéo", "Consoles et jeux");
$cat3 = new Category(3, "Vêtements Homme", "Mode masculine");

echo $cat1->getSlug() . PHP_EOL;
echo $cat2->getSlug() . PHP_EOL;
echo $cat3->getSlug() . PHP_EOL;
