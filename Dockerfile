FROM php:8.1-fpm

WORKDIR /var/www

COPY . .

RUN apt-get update && \
    apt-get install -y libzip-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev \
    libgd-dev libpng-dev && \
    docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) zip soap gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

EXPOSE 9000

CMD ["php-fpm"]