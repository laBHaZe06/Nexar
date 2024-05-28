#!/bin/sh

# Assurer que le script s'arrête en cas d'erreur
set -e

# Passer au répertoire de l'application
cd /var/www/Nexar/

# faire un ls de l'application
ll


# Ajouter Nexar au PATH
export PATH=$PATH:/var/www/Nexar/bin/

# Vérifier le répertoire courant et le PATH
echo $(pwd)
echo $PATH

# Installer les dépendances Composer
echo "Installing Composer dependencies..."
composer install --no-interaction --optimize-autoloader

# Optionnel : Exécuter des migrations de base de données
# echo "Running database migrations..."
# nexar doctrine:migrations:migrate --no-interaction

# Optionnel : Charger les fixtures de base de données
# echo "Loading database fixtures..."
# nexar doctrine:fixtures:load --no-interaction

# Assurer les permissions correctes
echo "Setting permissions..."
chown -R www-data:www-data /var/www/Nexar
chmod -R 775 /var/www/Nexar

# Effacer le cache
echo "Clearing cache..."
nexar cache:clear

echo " 🚀 Nexar installed successfully! Good coding! 🚀"