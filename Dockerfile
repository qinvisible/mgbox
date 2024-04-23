FROM php:8.1
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo
WORKDIR /var/www

CMD bash -c "composer install && php artisan serve --host=0.0.0.0"
EXPOSE 80