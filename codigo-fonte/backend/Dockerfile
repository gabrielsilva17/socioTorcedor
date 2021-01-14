FROM php:7.3-apache

WORKDIR /var/www
VOLUME /data

RUN apt-get update \
    && a2enmod rewrite headers \
    && apt-get install -y --no-install-recommends git cron zip vim unzip libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && apt-get install -y --no-install-recommends libicu-dev libsodium-dev libcurl4-openssl-dev pkg-config libssl-dev \
    && apt-get install -y --no-install-recommends libpq-dev libzip-dev libxml2-dev \
    && docker-php-ext-install intl mbstring pdo pdo_mysql calendar bcmath soap mysqli \
    && docker-php-ext-enable intl mbstring pdo pdo_mysql calendar bcmath soap mysqli \
    && pecl install apcu xdebug-2.9.2 mongodb redis-5.1.1 \
    && docker-php-ext-enable apcu xdebug mongodb redis \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl \
    && apt-get clean \
    && rm -rf /tmp/* /var/tmp/*

# Configurando o timezone do servidor com UTC 0
ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY . .

# Apache settings
COPY docker/etc/host.conf /etc/apache2/conf-enabled/host.conf
COPY docker/etc/000-default-backend.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/etc/apache2.conf /etc/apache2/apache2.conf

# PHP settings
COPY docker/etc/production.ini /usr/local/etc/php/conf.d/production.ini
COPY docker/etc/php.ini /opt/docker/etc/php/php.ini

# COPY CERTIFICATES
COPY docker/certificates/ /usr/local/certs/

# COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy cron file to the cron.d directory
COPY docker/etc/crontab /etc/cron.d/cron

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/cron

# Apply cron job
RUN crontab /etc/cron.d/cron

# Create the log file to be able to run tail
RUN mkdir -p /var/log/cron

RUN rm -rf /etc/ssl/openssl.cnf
COPY docker/etc/openssl.cnf /etc/ssl/

COPY docker/entrypoint/entrypoint.sh /usr/local/bin/
COPY docker/entrypoint/tdd.sh /usr/local/bin/
COPY docker/sh/porcentage.sh /usr/local/bin/
COPY docker/sh/color.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/tdd.sh
RUN chmod +x /usr/local/bin/porcentage.sh
RUN chmod +x /usr/local/bin/color.sh

CMD [ "sh", "-c", "/usr/local/bin/entrypoint.sh; /usr/local/bin/apache2-foreground" ]