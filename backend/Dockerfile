FROM php:8.3.3

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www
COPY ./laravelServer /var/www/html
COPY ./laravelServer/.env.example /var/www//html/.env


# Install PHP extensions
RUN apt-get update \
    && apt-get install -y curl \
    && apt-get install iputils-ping -y \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && apt-get install unzip -y \
    && composer self-update \
    && composer install \
    && php artisan key:generate \
    && su \
    && chmod 777 ./bootstrap/cache \
    && chmod 777 ./storage/ \
    && apt-get install default-mysql-client -y \
    && docker-php-ext-install mysqli pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis

# Make port 8000 available to the world outside this container
EXPOSE 8000

CMD ["php", "artisan", "serve","--host=0.0.0.0" ,"--port=8000"]
#CMD ["php", "artisan", "serve","--port=8000"]

