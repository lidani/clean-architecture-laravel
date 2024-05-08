FROM php:8.3-fpm-alpine3.19

LABEL Author="Gustavo Lidani <gustavo@lidani.dev>"

RUN apk add --update \
  git curl zip unzip postgresql-dev oniguruma-dev tzdata libzip-dev

RUN docker-php-ext-install pdo_pgsql mbstring bcmath zip

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
  linux-headers \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del -f .build-deps

ENV TZ=America/Sao_Paulo
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction \
  && composer dump-autoload --optimize --profile

RUN chown -R www-data:www-data /var/www \
  && chmod -R 755 /var/www/html/src/external/laravel/storage
