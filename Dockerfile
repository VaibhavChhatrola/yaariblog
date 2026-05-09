FROM php:8.2-apache

# જરૂરી લાયબ્રેરી ઇન્સ્ટોલ કરવા માટે
RUN apt-get update && apt-get install -y \
        libpq-dev \
        libpng-dev \
        zip \
        unzip \
        git

# PostgreSQL ડ્રાઈવર ઇન્સ્ટોલ કરવા માટે (આ લાઈન ખાસ ચેક કરો)
RUN docker-php-ext-install pdo_pgsql pgsql pdo_mysql

RUN a2enmod rewrite

# Apache configuration (જે તમે પહેલા કર્યું હતું)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN composer install --no-dev --optimize-autoloader

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

CMD php artisan config:cache && php artisan migrate --force && apache2-foreground

EXPOSE 80                                       