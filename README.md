# Reservation Tukki

Application web de réservation d'hôtels développée avec **Symfony 5.4**. Elle propose un espace public permettant aux visiteurs de consulter les hôtels et leurs chambres et de réserver, ainsi qu'un back-office d'administration pour gérer les hôtels, chambres, réservations, utilisateurs et le contenu de la page d'accueil (carousel, images).

## Fonctionnalités

- **Front office**
  - Consultation des hôtels et de leurs chambres
  - Réservation de chambres
  - Inscription / connexion des utilisateurs, réinitialisation de mot de passe
- **Back office (admin)**
  - Gestion des hôtels et des chambres
  - Gestion des réservations
  - Gestion des utilisateurs
  - Gestion du carousel de la page d'accueil et des images

## Stack technique

- PHP >= 7.2.5
- Symfony 5.4
- Doctrine ORM / Doctrine Migrations
- PostgreSQL (via Docker)
- Twig
- Vich Uploader (upload d'images)
- FOS CKEditor (édition de contenu riche)

## Prérequis

- PHP >= 7.2.5 avec les extensions `ctype` et `iconv`
- Composer
- Docker et Docker Compose (pour la base de données)
- Symfony CLI (recommandé)

## Installation

1. Cloner le dépôt
   ```bash
   git clone https://github.com/BAMBA-FALL/reservation_tukki.git
   cd reservation_tukki
   ```

2. Installer les dépendances PHP
   ```bash
   composer install
   ```

3. Copier le fichier d'environnement et configurer les variables (base de données, mailer, etc.)
   ```bash
   cp .env .env.local
   ```

4. Démarrer la base de données PostgreSQL
   ```bash
   docker-compose up -d
   ```

5. Créer le schéma de base de données et exécuter les migrations
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

6. (Optionnel) Charger des données de test
   ```bash
   php bin/console doctrine:fixtures:load
   ```

7. Lancer le serveur de développement
   ```bash
   symfony server:start
   ```
   ou
   ```bash
   php -S 127.0.0.1:8000 -t public
   ```

## Tests

```bash
php bin/phpunit
```

## Structure du projet

```
src/
├── Controller/   # Contrôleurs front et admin
├── Entity/       # Entités Doctrine (Hotel, Room, Reservation, User, ...)
├── Repository/   # Repositories Doctrine
├── Form/         # Types de formulaires Symfony
├── Security/     # Authentification et autorisations
└── DataFixtures/ # Données de démonstration
migrations/       # Migrations Doctrine
templates/        # Vues Twig
public/           # Point d'entrée web et assets
```

## Licence

Projet propriétaire.
