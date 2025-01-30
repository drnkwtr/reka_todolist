FROM php:8.2.9-fpm-alpine

WORKDIR /var/www/forblitz

RUN docker-php-ext-install pdo pdo_mysql
