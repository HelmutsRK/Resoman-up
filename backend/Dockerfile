FROM php:8.1-fpm

RUN apt-get update -y
RUN apt-get install -y \
	git \
	zip \
	sudo \
	libzip-dev \
	libmemcached-dev \
	zlib1g-dev \
	libcurl4-openssl-dev \
	libicu-dev \
	libxml2-dev

RUN docker-php-ext-install pdo && docker-php-ext-enable pdo
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install exif && docker-php-ext-enable exif
RUN docker-php-ext-install curl && docker-php-ext-enable curl
RUN docker-php-ext-install dom && docker-php-ext-enable dom
RUN pecl install memcached && docker-php-ext-enable memcached

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

COPY --chown=www-data:www-data . /var/www

WORKDIR /var/www

RUN composer install

RUN php artisan key:generate

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 9000
CMD ["php-fpm"]
