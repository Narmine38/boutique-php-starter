<?php

namespace App\Entity;

class Product {
    private int $id;
    private string $nom;
    private string $description;
    private float $prix;
    private int $stock;
    private string $image;
    private string $categorie;

    public function __construct(int $id, string $nom, string $description, float $prix, int $stock, string $image, string $categorie) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->image = $image;
        $this->categorie = $categorie;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->nom; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->prix; }
    public function getStock(): int { return $this->stock; }
    public function getImage(): string { return $this->image; }
    public function getCategory(): string { return $this->categorie; }

    public function getPriceIncludingTax(float $vat = 20): float {
        return $this->prix * (1 + $vat / 100);
    }

    public function isInStock(): bool {
        return $this->stock > 0;
    }
}
