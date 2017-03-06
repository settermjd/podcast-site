FROM php:7.0-fpm

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install json

ENV PHPREDIS_VERSION 3.1.1
RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis
