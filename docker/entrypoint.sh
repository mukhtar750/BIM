#!/bin/bash

# Create SQLite database if it doesn't exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
fi

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Cache configuration and routes for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache in the foreground
apache2-foreground
