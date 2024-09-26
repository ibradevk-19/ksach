FROM php:7.4

RUN apt-get update

RUN apt-get install gnupg -qq

RUN curl -sL "https://deb.nodesource.com/setup_14.x" | bash -

RUN apt-get install git nodejs libcurl4-gnutls-dev libicu-dev libmcrypt-dev libvpx-dev libjpeg-dev libpng-dev libxpm-dev zlib1g-dev libfreetype6-dev libxml2-dev libexpat1-dev libbz2-dev libgmp3-dev libldap2-dev unixodbc-dev libpq-dev libsqlite3-dev libaspell-dev libsnmp-dev libpcre3-dev libtidy-dev -qq

RUN apt-get update \
    && apt-get install -y \
    libzip-dev

RUN docker-php-ext-install pdo_mysql curl json intl gd xml zip bz2 opcache 

RUN apt-get install -y libmcrypt-dev \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug xml

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod +x /usr/local/bin/composer

RUN apt-get clean
RUN composer global require "laravel/envoy=~1.0"