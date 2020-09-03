FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev default-mysql-client unzip git \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install json \
    && pecl install mcrypt \
    && docker-php-ext-enable mcrypt

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /app