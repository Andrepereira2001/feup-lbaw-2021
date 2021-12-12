FROM ubuntu:20.04

# Set time zone. Avoids a prompt when calling apt-get
ENV TZ=Europe/Lisbon
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#Install dependencies
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    unzip \
    curl \
    nginx \
    php php-curl php-xml php-fpm php-mbstring php-pgsql

# Install Composer 2
RUN curl -k https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer --output composer-setup.php
RUN php composer-setup.php --quiet
RUN mv composer.phar /usr/local/bin/composer

# Copy project configurations
COPY ./etc/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./etc/nginx/default.conf /etc/nginx/sites-enabled/default
RUN mkdir -p /var/run/php

WORKDIR /code

# Composer install
# Composer is installed in two stages:
# 1. Install all dependencies
COPY code/composer.json composer.json
COPY code/composer.lock composer.lock
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-plugins \
    --no-autoloader

# 2. Run scripts
COPY code .
RUN composer install \
    --no-interaction \
    --prefer-dist

COPY code/.env_production .env

RUN chown -R www-data:www-data storage
RUN chown -R www-data:www-data bootstrap/cache

# Redirect /var/www/public to /code/public
RUN ln -s /code/public /var/www/public

EXPOSE 80

COPY docker_run.sh /docker_run.sh
RUN chmod +x /docker_run.sh
CMD /docker_run.sh
