FROM php:5.6-apache-jessie
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
&& docker-php-ext-install pdo pdo_mysql