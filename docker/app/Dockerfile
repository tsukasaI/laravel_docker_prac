FROM php:8.0-fpm

COPY php.ini /usr/local/etc/php/
COPY 000-default.conf /etc/apache2/sites-enabled/

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    libpng-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql
