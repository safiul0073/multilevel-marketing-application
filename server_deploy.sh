#!/bin/bash
set -e

echo "Deploying application ..."

# Enter maintanance mode
php artisan down
    # Update codebase

    # Install dependencies based on lock file
     COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

    # Migrate database
    php artisan migrate --force

    # Clear cache
    php artisan optimize

    # permisson set storage && bootstrap folder
     sudo -S chown -R www-data.www-data /var/www/html/staging.aqebbd.com/bootstrap/cache/

     sudo -S chown -R www-data.www-data /var/www/html/staging.aqebbd.com/storage

    # Reload PHP to update opcache
    echo "" | sudo -S service php8.1-fpm reload
# Exit maintenance mode
php artisan up

echo "🚀 Application deployed!"
