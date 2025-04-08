#!/bin/sh
set -e

# Clear and re-cache artisan routes
php /app/artisan route:clear -n
php /app/artisan route:cache -n

exec "$@"
