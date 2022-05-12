#
# Composer Dependencies
#
FROM composer:2 as composer
WORKDIR /usr/local/src/
COPY auth.json composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader --prefer-dist --no-interaction

#
# Runtime
#
FROM php:7.4-fpm-alpine

ARG debug

USER root

RUN apk add --update \
    # For zlib and gd extensions
    freetype \
    freetype-dev \
    jpeg-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    zlib-dev \
    # For zip extension
    libzip-dev \
    # Extra modules
    git \
    jq \
    mysql-client \
    unzip \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install exif gd mysqli opcache pcntl pdo_mysql zip \
    && rm -rf /tmp/*

RUN if [[ -z "$debug" ]] ; then { \
    echo 'opcache.enable_cli=1'; \
    echo 'opcache.validate_timestamps=0'; \
    echo 'opcache.revalidate_freq=2'; \
    } > /usr/local/etc/php/conf.d/docker-opcache.ini ; \
    fi

RUN { \
    echo 'log_errors=on'; \
    echo 'access.log=/dev/null;' \
    echo 'display_errors=off'; \
    echo 'upload_max_filesize=32M'; \
    echo 'post_max_size=32M'; \
    echo 'memory_limit=512M'; \
    echo 'expose_php=Off'; \
    echo 'max_input_time=-1'; \
    echo 'max_execution_time=300'; \
    } > /usr/local/etc/php/conf.d/docker-php.ini

RUN echo "* * * * * php /var/www/html/artisan schedule:run > /proc/1/fd/1" | crontab -

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --chown=www-data --from=composer /usr/local/src/vendor ./vendor

COPY --chown=www-data ./ ./

RUN composer dumpautoload && composer clearcache

VOLUME ["/var/www/html", "/var/www/html/.nginx-templates"]

CMD ["php-fpm"]
