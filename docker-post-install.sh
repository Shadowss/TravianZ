#!/bin/bash
# ABOUTME: Post-installation cleanup script for TravianZ Docker setup
# ABOUTME: Run this after completing the web installation to clean up and secure the application

set -e

echo "=== TravianZ Post-Installation Cleanup ==="
echo ""

# Check if installation is complete
if [ ! -f "/var/www/html/var/installed" ]; then
    echo "❌ ERROR: Installation not complete!"
    echo "Please complete the web installation first at http://localhost:8081/install/"
    exit 1
fi

echo "✓ Installation marker found"
echo ""

# Remove or rename install directory if it still exists
if [ -d "/var/www/html/install" ]; then
    TIMESTAMP=$(date +%s)
    echo "→ Renaming install/ to installed_${TIMESTAMP}/"
    mv /var/www/html/install /var/www/html/installed_${TIMESTAMP}
    echo "✓ Install directory renamed"
elif ls -d /var/www/html/installed_* 1> /dev/null 2>&1; then
    echo "→ Removing old installed_* directories"
    rm -rf /var/www/html/installed_*
    echo "✓ Old install directories removed"
else
    echo "✓ Install directory already removed"
fi

echo ""
echo "→ Setting secure permissions..."

# Set GameEngine to 755 (read/execute for all, write for owner)
chmod -R 755 /var/www/html/GameEngine

# Set writable directories to 777 (needed for runtime operations)
chmod -R 777 /var/www/html/GameEngine/Prevention
chmod -R 777 /var/www/html/GameEngine/Notes
chmod -R 777 /var/www/html/var/log

# Ensure www-data owns everything
chown -R www-data:www-data /var/www/html

echo "✓ Permissions configured"
echo ""
echo "=== Post-Installation Complete! ==="
echo ""
echo "Next steps:"
echo "  1. Set up cron jobs for game mechanics (see DOCKER_SETUP.md)"
echo "  2. Configure Admin panel password protection"
echo "  3. Your game is ready at http://localhost:8081/"
echo ""
