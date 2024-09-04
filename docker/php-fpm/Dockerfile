FROM php:8.3-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www

RUN apt-get update \
    && apt-get install -y wget git unzip libpq-dev libicu-dev libpng-dev libzip-dev libjpeg-dev libfreetype6-dev\
    && pecl install xdebug-3.3.0 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && docker-php-ext-enable pgsql

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

ADD ./docker/php-fpm/php.ini /usr/local/etc/php/php.ini

COPY . .

RUN composer install

CMD ["php-fpm"]
