FROM php:8.0.12-fpm
RUN apt update && pecl install yaf && docker-php-ext-enable yaf && docker-php-ext-install mysqli && docker-php-ext-enable mysqli