FROM php:7-fpm

RUN apt-get update
RUN apt-get install -y libmcrypt-dev default-mysql-client zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev jpegoptim optipng

RUN pecl install mcrypt-1.0.2

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install exif

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN docker-php-ext-enable mcrypt

ADD ./deploy/php.ini 	/usr/local/etc/php/conf.d/app-config.ini

WORKDIR /var/www