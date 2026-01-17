FROM php:7.4-fpm-alpine3.16

# Install runtime dependencies
RUN apk add --no-cache \
    bash \
    git \
    zip \
    unzip \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    oniguruma \
    icu

# Install build dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev

# Configure and install PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        zip \
        intl \
    && apk del .build-deps

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Permissions (FPM runs as www-data)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www \
    && mkdir -p /var/www/html/var \
    && chown -R www-data:www-data /var/www/html/var

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
