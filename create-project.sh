#!/bin/bash
set -e

PROJECT_NAME="cinema_booking_dev_project"
ROOT_DIR=$(pwd)/$PROJECT_NAME

mkdir -p $ROOT_DIR/{php,apache,www/html}
cd $ROOT_DIR

cat > docker-compose.yml <<'EOF'
version: '3.8'

services:
  web:
    build:
      context: ./php
    container_name: cinema_web
    ports:
      - "8080:80"
    volumes:
      - ./www:/var/www/html
      - ./apache/vhost.conf:/etc/apache2/sites-available/000-default.conf
    depends_on:
      - db
    environment:
      APACHE_RUN_USER: www-data
      APACHE_RUN_GROUP: www-data

  db:
    image: mysql:5.7
    container_name: cinema_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: cinema_db
      MYSQL_USER: cinema_user
      MYSQL_PASSWORD: cinema_pass
    volumes:
      - db_data:/var/lib/mysql

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: cinema_phpmyadmin
    restart: always
    ports:
      - "8081:80"
    environment:
      PMA_HOST: db
      PMA_USER: cinema_user
      PMA_PASSWORD: cinema_pass
      PMA_ARBITRARY: 1
    depends_on:
      - db

volumes:
  db_data:
EOF

cat > php/Dockerfile <<'EOF'
FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libicu-dev g++ \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
EOF

cat > apache/vhost.conf <<'EOF'
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
        Options +FollowSymLinks
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

docker-compose up -d --build
sleep 30

docker exec cinema_web bash -c "rm -rf /var/www/html/*"
docker exec cinema_web bash -c "cd /var/www/html && composer create-project symfony/website-skeleton . '4.4.*' --no-interaction"
docker exec cinema_web bash -c "cd /var/www/html && composer require symfony/orm-pack doctrine/annotations --no-interaction"
docker exec cinema_web bash -c "cd /var/www/html && sed -i 's|^DATABASE_URL=.*|DATABASE_URL=\"mysql://cinema_user:cinema_pass@db:3306/cinema_db\"|' .env"
docker exec cinema_web bash -c "chown -R www-data:www-data /var/www/html"
