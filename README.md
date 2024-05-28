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


Nexar inclut pour le moment plusieurs commandes CLI pour faciliter le développement :

- **Créer un nouveau projet**

    ```sh
    bin/nexar create:project <nom-du-projet>
    ```

- **Démarrer le serveur Nexar**

    ```sh
    bin/nexar server:start
    ```

- **Effacer le cache**

    ```sh
    bin/nexar cache:clear
    ```

## Structure du Projet

Voici un aperçu de la structure du répertoire Nexar :

```sh
Nexar/
├── bin/
│ └── nexar
├── public/
│ └── index.php
├── src/
│ ├── Command/
│ │ ├── CreateProjectCommand.php
│ │ └── StartServerCommand.php
│ ├── Controller/
│ │ └── DefaultController.php
│ ├── Core/
│ │ ├── Router/
│ │ │ ├── Route.php
│ │ │ └── Router.php
│ │ └── Middleware/
│ │ └── MiddlewareInterface.php
│ └── ...
├── tests/
├── vendor/
├── .env
├── composer.json
├── docker-compose.yml
├── Dockerfile
└── install.sh
```

## Contribution

Les contributions sont les bienvenues ! Si vous souhaitez contribuer à Nexar, veuillez suivre ces étapes :

1. Forkez le projet
2. Créez votre branche de fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commitez vos modifications (`git commit -m 'Add some AmazingFeature'`)
4. Poussez votre branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

Pour toute demande de contribution, veuillez me contacter afin de participer au projet.

