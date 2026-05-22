FROM php:8.2-apache

# System deps + PHP extensions required by CodeIgniter 4 + mpdf
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        unzip \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        curl \
        gd \
        intl \
        mbstring \
        mysqli \
        pdo_mysql \
        zip \
        exif \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Composer (used by entrypoint for autoload regen / install on first boot)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP runtime tuning for CodeIgniter 4 (school site)
RUN { \
        echo 'upload_max_filesize=64M'; \
        echo 'post_max_size=64M'; \
        echo 'memory_limit=512M'; \
        echo 'max_execution_time=180'; \
        echo 'date.timezone=Asia/Jakarta'; \
        echo 'opcache.enable=1'; \
        echo 'opcache.memory_consumption=192'; \
        echo 'opcache.interned_strings_buffer=16'; \
        echo 'opcache.max_accelerated_files=20000'; \
        echo 'opcache.validate_timestamps=1'; \
        echo 'opcache.revalidate_freq=2'; \
    } > /usr/local/etc/php/conf.d/sekolah.ini

# Apache vhost: DocumentRoot -> /var/www/html/public (CI4 standard)
RUN { \
        echo '<VirtualHost *:80>'; \
        echo '    ServerAdmin webmaster@localhost'; \
        echo '    DocumentRoot /var/www/html/public'; \
        echo '    <Directory /var/www/html>'; \
        echo '        Options FollowSymLinks'; \
        echo '        AllowOverride None'; \
        echo '        Require all denied'; \
        echo '    </Directory>'; \
        echo '    <Directory /var/www/html/public>'; \
        echo '        Options Indexes FollowSymLinks'; \
        echo '        AllowOverride All'; \
        echo '        Require all granted'; \
        echo '    </Directory>'; \
        echo '    ErrorLog ${APACHE_LOG_DIR}/error.log'; \
        echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined'; \
        echo '</VirtualHost>'; \
    } > /etc/apache2/sites-available/000-default.conf

# Entrypoint: ensure writable dirs exist + permissions, then run composer install if vendor missing
COPY entrypoint.sh /usr/local/bin/sekolah-entrypoint.sh
RUN chmod +x /usr/local/bin/sekolah-entrypoint.sh

WORKDIR /var/www/html

ENTRYPOINT ["/usr/local/bin/sekolah-entrypoint.sh"]
CMD ["apache2-foreground"]
