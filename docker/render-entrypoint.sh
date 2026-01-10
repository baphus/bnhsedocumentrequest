#!/bin/sh
set -e

# If the first argument is "worker", run the queue worker
if [ "$1" = "worker" ]; then
    echo "Starting Queue Worker..."
    exec php artisan queue:work --tries=3 --timeout=90
fi

# Otherwise, start the FrankenPHP server (Default behavior)
echo "Starting FrankenPHP Server..."
exec /usr/local/bin/frankenphp php-server --listen :10000 --root public/
