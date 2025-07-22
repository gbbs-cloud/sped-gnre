FROM php:8.1

WORKDIR /var/www

RUN apt update && \
    apt install -y \
    libfreetype6-dev \
    libgd-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    unzip 

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY . .

EXPOSE 8181

CMD ["php", "-S", "0.0.0.0:8181"]
