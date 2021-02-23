FROM php:7

USER root

RUN apt-get update && apt-get -y upgrade
RUN apt-get update && apt-get -y install curl zip vim libxml2-dev zlib1g-dev libzip-dev libbz2-dev libpng-dev
RUN docker-php-ext-install pdo_mysql mysqli soap zip intl xml xmlrpc opcache bcmath bz2 json

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype --with-jpeg\
    && docker-php-ext-install -j$(nproc) gd


RUN pecl install redis \
    && pecl install mongodb \
    && docker-php-ext-enable redis mongodb

RUN apt-get install -y supervisor

ADD config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ADD test.sh /test.sh
RUN chmod +x /test.sh

CMD ["/usr/bin/supervisord"]
