FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y zlib1g-dev vim libzip-dev zip \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip pdo_mysql mbstring bcmath

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update
