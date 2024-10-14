#!/bin/bash

set -e

# Run migrations and seed only if migrations haven't been run before
if [ ! -f "/var/www/html/.migrated" ]; then
  composer install
  ./sh/wait-for-it.sh -t 30 mysql:3306 -- php artisan migrate --force
  php artisan migrate:refresh --seed
  touch /var/www/html/.migrated
fi

# ./sh/wait-for-it.sh -t 30 mysql:3306 -- echo "Checking if database 'laravel' exists..."

# if [ -f .env ]
# then
#   export $(cat .env | sed 's/#.*//g' | xargs)
# fi

# if [ "$DB_CHECK" = "laravel" ]; then
#   echo "Database 'laravel' exists. Running migrations..."
#   php artisan migrate --force
#   php artisan migrate:refresh --seed
#   touch /var/www/html/.migrated
# else
#   echo "Database 'laravel' does not exist. Exiting..."
#   exit 1
# fi
# # Start the Laravel server
php artisan serve --host=0.0.0.0 --port=8000