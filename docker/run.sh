#!/bin/sh

cd /var/www/html

# Run migrations (force for production)
echo "Running migrations..."
echo "DB_HOST: $DB_HOST"
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Default to port 80 if PORT is not set
export PORT=${PORT:-80}

# Inject PORT environment variable into Nginx config
# Inject PORT environment variable into Nginx config
echo "Using PORT: $PORT"
sed -i "s/\${PORT}/${PORT}/g" /etc/nginx/conf.d/default.conf

# Start PHP-FPM in background
php-fpm -D
status=$?
if [ $status -ne 0 ]; then
  echo "Failed to start php-fpm: $status"
  exit $status
fi

# Start Nginx in foreground
nginx -g "daemon off;"
