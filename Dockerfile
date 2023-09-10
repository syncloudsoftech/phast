FROM php:7.4-apache

# enable rewrite module
RUN a2enmod rewrite

# install basic extensions
RUN apt-get update && \
    apt-get install -y libxml2-dev && \
    docker-php-ext-install bcmath ctype exif fileinfo opcache pcntl pdo_mysql xml

# install php-curl extension
RUN apt-get update && \
    apt-get install -y libcurl3-dev && \
    docker-php-ext-install curl

# install php-gd extension
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# install php-gmp extension
RUN apt-get update && \
    apt-get install -y libgmp-dev && \
    docker-php-ext-install gmp

# install php-imagick extension
RUN apt-get update && \
    apt-get install -y libmagickwand-dev && \
    pecl install imagick && \
    docker-php-ext-enable imagick

# install php-intl extension
RUN apt-get update && \
    apt-get -y install libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl

# install php-zip extension
RUN apt-get update && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install -j$(nproc) zip

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# install basic utilities (for composer)
RUN apt-get update && \
    apt-get install -y curl git zip

# install mysql client
RUN apt-get update && \
    apt-get install -y default-mysql-client

COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/

RUN composer install

COPY . /var/www/html/
