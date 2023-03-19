FROM php:7.4-apache

# Install dependency
RUN apt-get update && \
    apt-get install -y zlib1g-dev libpng-dev libjpeg-dev && \
    docker-php-ext-install pdo_mysql gd mysqli && \
    a2enmod rewrite && \
    a2enmod headers && \
    a2enmod expires

# Copy application files to a different folder
COPY . /var/www/container_files/ 
# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh 

RUN chmod +x /entrypoint.sh && \
    chown -R www-data:www-data /var/www/container_files/ && \
    chmod -R 777 /var/www/container_files/

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
