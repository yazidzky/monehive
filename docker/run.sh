#!/bin/sh

cd /var/www/html

# Run migrations (force for production)
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Default to port 80 if PORT is not set
export PORT=${PORT:-80}

# Inject PORT environment variable into Nginx config
envsubst '${PORT}' < /etc/nginx/sites-available/default > /etc/nginx/sites-available/default.tmp && mv /etc/nginx/sites-available/default.tmp /etc/nginx/sites-available/default

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
nginx -g "daemon off;"
