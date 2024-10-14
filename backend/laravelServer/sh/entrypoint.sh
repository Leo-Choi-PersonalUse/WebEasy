#!/bin/bash

set -e

cp -R /var/www/vendor /var/www/html

# Run migrations and seed only if migrations haven't been run before
if [ ! -f "/var/www/html/.migrated" ]; then
  ./sh/wait-for-it.sh -t 30 mysql:3306 -- php artisan migrate --force
  php artisan migrate:refresh --seed
  touch /var/www/html/.migrated
fi

php artisan serve --host=0.0.0.0 --port=8000