FROM php:7.4-apache

# Legacy SIAKAD: keeps PHP 7.4 so the mysql_* shim (parser-php-version.php)
# remains functional. Do NOT bump PHP without rewriting siakad to mysqli/PDO.

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" curl gd mbstring mysqli zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN { \
        echo 'upload_max_filesize=64M'; \
        echo 'post_max_size=64M'; \
        echo 'memory_limit=256M'; \
        echo 'date.timezone=Asia/Jakarta'; \
        echo 'short_open_tag=On'; \
        echo 'error_reporting=E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING'; \
    } > /usr/local/etc/php/conf.d/siakad.ini
