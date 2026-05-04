#!/bin/sh

# Exit on error
set -e

# Clear and cache Laravel settings
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (only if DB_CONNECTION is set and not sqlite/if we want to auto-migrate)
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start Nginx in background
echo "Starting Nginx..."
nginx -g "daemon on;"

# Start PHP-FPM in foreground
echo "Starting PHP-FPM..."
php-fpm
