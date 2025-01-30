start: docker-up copy_env composer-install npm-install

docker-up:
	docker-compose up -d

copy_env:
	cp .env.example .env

composer-install:
	docker-compose exec laravel.test composer install

npm-install:
	./vendor/bin/sail npm install
	./vendor/bin/sail npm run build
