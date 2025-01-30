#!/bin/bash

set -e

git pull

docker-compose -f docker-compose.prod.yml run composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --ignore-platform-req=ext-exif

docker-compose -f docker-compose.prod.yml run npm install
docker-compose -f docker-compose.prod.yml run npm run build

docker-compose -f docker-compose.prod.yml run artisan migrate --force

docker-compose -f docker-compose.prod.yml run artisan cache:clear
docker-compose -f docker-compose.prod.yml run artisan config:clear
docker-compose -f docker-compose.prod.yml run artisan route:clear
docker-compose -f docker-compose.prod.yml run artisan view:clear
docker-compose -f docker-compose.prod.yml run artisan optimize:clear
docker-compose -f docker-compose.prod.yml run artisan optimize
