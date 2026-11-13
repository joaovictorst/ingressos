FROM php:8.4-fpm

RUN apt-get update && \ 
    apt-get install -y \
libpq-dev zip unzip zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libicu-dev

RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install opcache

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ARG APP_VERSAO=dev
ENV APP_VERSAO=${APP_VERSAO}

WORKDIR /var/www/html
