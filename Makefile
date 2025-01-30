start: copy_env install_composer sail_up get_perms npm_install migrate_and_clear_cache

copy_env:
	cp .env.example .env

install_composer:
	docker run --rm \
	-u "$(shell id -u):$(shell id -g)" \
	-v $(shell pwd):/var/www/html \
	-w /var/www/html \
	laravelsail/php84-composer:latest \
	composer install --ignore-platform-reqs

sail_up:
	./vendor/bin/sail up -d

get_perms:
	chmod -R gu+w storage
	chmod -R guo+w storage
	chmod -R 775 storage
	chmod -R 775 bootstrap/cache

npm_install:
	docker-compose exec -it laravel.test npm install
	docker-compose exec -it laravel.test npm run build

migrate_and_clear_cache:
	./vendor/bin/sail php artisan migrate:fresh --seed
	./vendor/bin/sail php artisan cache:clear

production:
	git pull
	docker-compose -f docker-compose.prod.yml up -d
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
	chmod -R gu+w storage
	chmod -R guo+w storage
	chmod -R 775 storage
	chmod -R 775 bootstrap/cache

production_down:
	docker-compose -f docker-compose.prod.yml down

production_down:
	docker-compose -f docker-compose.prod.yml up -d
