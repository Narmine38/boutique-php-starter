# MaBoutique - Starter PHP

Starter HTML/CSS pour la formation PHP 14 jours. Template statique à "PHPiser" progressivement.

## Installation

1. **Forker** ce repo (bouton "Fork" en haut à droite sur GitHub)
2. Cloner votre fork :
```bash
git clone https://github.com/VOTRE-USERNAME/boutique-php-starter.git
cd boutique-php-starter
php -S localhost:8000 -t public
```
3. Ouvrir http://localhost:8000

## Structure

```
public/          # Pages HTML (index, catalogue, produit, panier, auth, contact)
public/css/      # Styles CSS
app/             # Code PHP (à créer)
views/           # Templates (à créer)
config/          # database.sql
exercices/       # Exercices jour 1-14
```

## Principe

Chaque fichier HTML contient des commentaires `<!-- JOUR X : ... -->` indiquant quoi modifier et quand.

Exemple :
```html
<!-- JOUR 1 : Remplacer 2024 par <?= date('Y') ?> -->
<!-- JOUR 3 : Générer avec foreach -->
<!-- JOUR 7 : Formulaire POST ajout panier -->
```

## Base de données (Jour 7+)

```bash
mysql -u root -p < config/database.sql
```
