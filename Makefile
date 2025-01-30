start: copy_env composer-install sail get-perms npm-install migrate-and-clear-cache

copy_env:
	cp .env.example .env

composer-install:
	docker run --rm \
	-u "$(shell id -u):$(shell id -g)" \
	-v $(shell pwd):/var/www/html \
	-w /var/www/html \
	laravelsail/php84-composer:latest \
	composer install --ignore-platform-reqs

sail:
	./vendor/bin/sail up -d

get-perms:
#	chmod -R gu+w storage
#	chmod -R guo+w storage
	chmod -R 775 storage
	chmod -R 775 bootstrap/cache

npm-install:
	docker-compose exec -it laravel.test npm install
	docker-compose exec -it laravel.test npm run build
migrate-and-clear-cache:
	./vendor/bin/sail php artisan migrate:fresh --seed
	./vendor/bin/sail php artisan cache:clear
