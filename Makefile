start: copy_env composer-install sail npm-install migrate

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

npm-install:
	./vendor/bin/sail npm install
	./vendor/bin/sail npm run build

migrate:
	./vendor/bin/sail php artisan migrate:fresh --seed
