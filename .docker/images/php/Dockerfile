FROM php:8.0-fpm as base

RUN docker-php-ext-install opcache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt update && apt install -y git zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/bin/composer

RUN groupadd -g 1000 kozols
RUN useradd -u 1000 -ms /bin/bash -g kozols kozols

COPY --chown=kozols:kozols . /var/www

USER kozols
