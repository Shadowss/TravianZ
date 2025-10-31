FROM php:7.4-apache

# Install required PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Apache configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Set recommended PHP.ini settings for TravianZ
RUN { \
    echo 'max_execution_time = 300'; \
    echo 'memory_limit = 256M'; \
    echo 'post_max_size = 20M'; \
    echo 'upload_max_filesize = 20M'; \
    echo 'date.timezone = Europe/London'; \
} > /usr/local/etc/php/conf.d/travianz.ini

# Set working directory
WORKDIR /var/www/html

# Copy entrypoint and utility scripts
COPY docker-entrypoint.sh /usr/local/bin/
COPY docker-post-install.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-post-install.sh

# Expose port 80
EXPOSE 80

# Use custom entrypoint to set permissions at runtime
ENTRYPOINT ["docker-entrypoint.sh"]
