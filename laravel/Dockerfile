FROM php:8-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN service apache2 restart

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions gd zip

RUN a2enmod rewrite

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN mv .env.example .env
RUN composer install
RUN php artisan key:generate

RUN chown -R www-data /var/www
USER www-data

RUN rm -rf /var/www/html && ln -s /var/www/public /var/www/html

EXPOSE 80
