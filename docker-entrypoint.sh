#!/bin/bash
# ABOUTME: Docker entrypoint script that sets correct file permissions
# ABOUTME: before starting Apache web server

set -e

# Set proper ownership and permissions for directories that need write access
echo "Setting file permissions..."

# Set ownership for directories that need write access
chown -R www-data:www-data /var/www/html/install
chown -R www-data:www-data /var/www/html/var
chown -R www-data:www-data /var/www/html/GameEngine

# Make root directory writable by www-data (needed for automation.lck and renaming install/)
chown www-data:www-data /var/www/html
chmod 775 /var/www/html

# Make install directory writable
chmod -R 775 /var/www/html/install

# Make var directory writable (needed for installed marker file and other runtime files)
chmod -R 775 /var/www/html/var

# Make GameEngine writable (needed for config.php generation and automation)
chmod -R 775 /var/www/html/GameEngine

echo "Permissions set successfully"

# Set up cron job for game automation (run as www-data user via su)
(crontab -l 2>/dev/null || true; echo "* * * * * su -s /bin/sh www-data -c 'php /var/www/html/cron.php >> /var/log/travianz-cron.log 2>&1'") | crontab -

# Start cron in background
echo "Starting cron service..."
cron

# Execute the original docker-php-entrypoint with apache
exec docker-php-entrypoint apache2-foreground
