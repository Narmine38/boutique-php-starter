<?php

namespace Entity;

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
        return $slug;
    }
}
