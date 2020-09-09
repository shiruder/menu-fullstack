FROM php:7.1-fpm

RUN docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql

RUN usermod -u 501 www-data

# Setting up permissions so composer can run withput problems
RUN chown -R www-data /var/www
USER www-data

WORKDIR /var/www/html/
