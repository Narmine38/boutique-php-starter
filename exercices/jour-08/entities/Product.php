<?php

namespace Entity;

class Product {
    public int $id;
    public string $nom;
    public string $description;
    public float $prix;
    public int $stock;
    public string $categorie;

    public function __construct(int $id, string $nom, string $description, float $prix, int $stock, string $categorie) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->categorie = $categorie;
    }

    public function getPriceIncludingTax(float $vat = 20): float {
        return $this->prix * (1 + $vat / 100);
    }

    public function isInStock(): bool {
        return $this->stock > 0;
    }

    public function reduceStock(int $quantity): void {
        if ($quantity > 0 && $this->stock >= $quantity) {
            $this->stock -= $quantity;
        }
    }

    public function applyDiscount(float $percentage): void {
        if ($percentage > 0 && $percentage <= 100) {
            $this->prix -= $this->prix * ($percentage / 100);
        }
    }

    // Getters pour l'exemple de l'intégration
    public function getName(): string {
        return $this->nom;
    }
}
