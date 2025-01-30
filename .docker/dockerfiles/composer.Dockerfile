FROM composer:latest

WORKDIR /var/www/forblitz

ENTRYPOINT [ "composer", "--ignore-platform-reqs" ]
