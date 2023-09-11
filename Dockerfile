ARG imageTag=7.x-apache

FROM ghcr.io/qrstuff/phackage:${imageTag}

# enable rewrite module
RUN a2enmod rewrite

# copy dependencies information
COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/

# install dependencies
RUN composer install

# copy project files
COPY . /var/www/html/
