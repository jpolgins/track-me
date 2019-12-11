FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install -y libpq-dev zip unzip bash && \
    php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pgsql pdo_pgsql opcache
