FROM php:7.3-fpm-stretch
RUN sed -i 's/9000/3001/' /usr/local/etc/php-fpm.d/zz-docker.conf

RUN apt-get update && apt-get install -y libzip-dev zip unzip libpq-dev git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libmagickwand-dev --no-install-recommends \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql pcntl zip \
    && docker-php-ext-install exif \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www
