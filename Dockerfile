FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application code first
COPY public_html/ ./
COPY tests/ ./tests/
COPY phpunit.xml ./

# Copy composer files and install dependencies
COPY composer.json ./
RUN composer install --optimize-autoloader --no-interaction

EXPOSE 80