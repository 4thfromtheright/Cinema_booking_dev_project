FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libicu-dev g++ \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
