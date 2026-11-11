FROM php:8.3-apache

RUN apt-get update && apt-get install -y \

    git unzip libzip-dev libicu-dev \

    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \

    && docker-php-ext-configure gd \

       --with-freetype --with-jpeg \

    && docker-php-ext-install \

       pdo_mysql mbstring bcmath exif gd intl zip opcache \

    && a2enmod rewrite headers \

    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

ENV PORT=10000

RUN sed -ri \

    's!/var/www/html!/var/www/html/public!g' \

    /etc/apache2/sites-available/000-default.conf \

    && sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

WORKDIR /var/www/html

COPY . .

RUN composer install \

    --no-dev \

    --optimize-autoloader \

    --no-interaction

RUN printf '%s\n' \

    '<Directory /var/www/html/public>' \

    'AllowOverride All' \

    'Require all granted' \

    '</Directory>' \

    > /etc/apache2/conf-available/laravel.conf \

    && a2enconf laravel \

    && mkdir -p storage/framework/cache \

       storage/framework/sessions \

       storage/framework/views \

       storage/logs \

       bootstrap/cache \

    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

CMD ["apache2-foreground"]