FROM php:7.3-apache

WORKDIR /var/www

RUN apt-get update \
    && a2enmod rewrite \
    && apt-get install -y --no-install-recommends libpq-dev libicu-dev libzip-dev zip unzip git \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo pdo_pgsql \
    && pecl install apcu xdebug \
    && docker-php-ext-enable apcu xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


# CONFIGURE TIMEZONE
ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone


# APACHE SETTINGS
COPY etc/host.conf /etc/apache2/conf-enabled/host.conf
COPY etc/000-default-backend.conf /etc/apache2/sites-enabled/000-default.conf
COPY etc/apache2.conf /etc/apache2/apache2.conf

# PHP SETTINGS
COPY etc/production.ini /usr/local/etc/php/conf.d/production.ini
COPY /etc/php.ini /opt/docker/etc/php/php.ini

# COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY entrypoint/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY entrypoint/tdd.sh /usr/local/bin/
COPY sh/porcentage.sh /usr/local/bin/
COPY sh/color.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/tdd.sh
RUN chmod +x /usr/local/bin/porcentage.sh
RUN chmod +x /usr/local/bin/color.sh

CMD [ "sh", "-c", "/usr/local/bin/entrypoint.sh; /usr/local/bin/apache2-foreground" ]
