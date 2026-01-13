#!/bin/sh
set -e

# Change to the application directory
cd /var/www

echo "Caching configuration..."
# Clear any old cached config and cache it with production env vars
php artisan config:cache

echo "Starting supervisor..."
# Start supervisor to run nginx, php-fpm, and the worker
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
