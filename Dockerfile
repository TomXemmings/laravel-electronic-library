FROM php:8.1-fpm
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY . /var/www/html
RUN #composer install
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
