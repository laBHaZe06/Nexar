# Nexar

Nexar est un framework PHP moderne et léger conçu pour créer des applications web rapides et robustes. Il offre une structure intuitive et des fonctionnalités avancées pour développer des projets web avec facilité.

## Table des matières

- [Fonctionnalités](#fonctionnalités)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Commandes](#commandes)
- [Structure du Projet](#structure-du-projet)
- [Contribution](#contribution)
- [Licence](#licence)

## Fonctionnalités

- Routage dynamique
- Middleware
- Gestion des paramètres de route
- Commandes CLI intégrées
- Support des migrations de base de données
- Gestion des dépendances avec Composer
- Autoloading conforme à PSR-4
- Cache management

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Docker (facultatif mais recommandé pour un environnement de développement cohérent)

## Installation

### Avec Docker

1. Clonez le repository

    ```sh
    git clone https://github.com/votre-utilisateur/Nexar.git
    cd Nexar
    ```

2. Construisez et démarrez le conteneur Docker

    ```sh
    docker-compose up --build
    ```

### Sans Docker

1. Clonez le repository

    ```sh
    git clone https://github.com/votre-utilisateur/Nexar.git
    cd Nexar
    ```

2. Installez les dépendances avec Composer

    ```sh
    composer install
    ```

3. Configurez votre serveur web pour pointer vers le répertoire `public`.

## Utilisation

### Démarrer le serveur

Si vous utilisez Docker, le serveur devrait déjà être en cours d'exécution. Sinon, vous pouvez démarrer le serveur de développement PHP avec la commande suivante :

```sh
php -S localhost:8000 -t public
