# TravianZ Docker Setup

This Docker Compose setup allows you to run TravianZ without installing PHP, MySQL, or Apache directly on your system.

## Prerequisites

- Docker
- Docker Compose

## Quick Start

1. **Start the application:**
   ```bash
   docker compose up -d
   ```

2. **Access the installer:**
   Open your browser and navigate to:
   ```
   http://localhost:8081/install/
   ```

3. **Configure the installation:**

   When you reach the database configuration step, the form will be **automatically pre-filled** with the correct Docker values:
   - **Hostname:** `db` (Docker service name)
   - **Port:** `3306` (internal MySQL port)
   - **Username:** `travianz`
   - **Password:** `travianz_pass`
   - **Database name:** `travianz`
   - **Prefix:** `s1_` (or your choice)
   - **Type:** MYSQLi

   You can simply accept these defaults and continue with the installation.

   **Note:** Port `3307` is for accessing the database from your host machine (outside Docker), but the web container uses the internal port `3306`.

   For the server URL settings:
   - **Server:** `http://localhost:8081/`
   - **Domain:** `http://localhost:8081/`
   - **Homepage:** `http://localhost:8081/`

   When you reach the admin accounts step, the form will be **automatically pre-filled** with default credentials:
   - **Multihunter password:** `admin`
   - **Support password:** `admin`
   - **Admin name:** `admin`
   - **Admin email:** `admin@email.com`
   - **Admin password:** `admin`

   **IMPORTANT:** These are default development credentials. Change them immediately in production!

4. **Complete the installation:**
   Follow the web installer steps to complete the setup.

5. **Run post-installation cleanup:**
   After the web installation finishes, run the cleanup script:
   ```bash
   docker compose exec web docker-post-install.sh
   ```

   This script will:
   - Remove/rename the install directory
   - Set secure file permissions
   - Configure writable directories for game operations

6. **Access your game:**
   Your game is now ready at:
   ```
   http://localhost:8081/
   ```

## Stopping the Application

```bash
docker compose down
```

## Stopping and Removing Data

To stop the application and remove all data (including the database):
```bash
docker compose down -v
```

## Logs

View web server logs:
```bash
docker compose logs -f web
```

View database logs:
```bash
docker compose logs -f db
```

## Post-Installation Tasks

### Setting Up Cron Jobs (Recommended)

TravianZ uses a hybrid automation system:
- **When players are online**: JavaScript automatically triggers game automation every 30 seconds
- **When no players are online**: Without cron, the game "pauses" until someone logs in

**Why you need cron**: To keep the game world running 24/7 even when no players are online. Cron handles:
- Building construction completion
- Troop training and movement completion
- Market trade completion
- Loyalty regeneration
- Troop spawning and battles
- Other time-based game mechanics

**Note about resources**: Village resources are calculated on-demand based on production rates and time elapsed. They don't need active cron generation.

**Setup host cron (recommended):**

Add to your host crontab (`crontab -e`):
```bash
* * * * * docker-compose -f /full/path/to/docker-compose.yml exec -T web php /var/www/html/cron.php >> /tmp/travianz-cron.log 2>&1
```

For example, if your TravianZ is in `/home/theo/work/TravianZ`:
```bash
* * * * * docker-compose -f /home/theo/work/TravianZ/docker-compose.yml exec -T web php /var/www/html/cron.php >> /tmp/travianz-cron.log 2>&1
```

**Verify cron is working:**
```bash
# Wait a minute after adding to crontab, then check:
cat /tmp/travianz-cron.log
# Should show: Cron completed at [timestamp]

# Or watch it in real-time:
tail -f /tmp/travianz-cron.log
```

**Manual test:**
```bash
docker-compose exec -T web php /var/www/html/cron.php
# Should output: Cron completed at [timestamp]
```

### Securing the Admin Panel (Recommended)

The Admin panel at `/Admin` should be protected. You can use Apache's `.htaccess` or configure authentication:

```bash
# Create .htpasswd file inside the container
docker compose exec web htpasswd -c /var/www/html/Admin/.htpasswd admin
```

## Troubleshooting

### Database Connection Issues
Make sure the database service is healthy before accessing the installer:
```bash
docker compose ps
```

The `db` service should show as "healthy" in the status.

### Reinstalling
To reinstall from scratch:
1. Stop the containers: `docker compose down -v`
2. Remove the `var/installed` file if it exists
3. Start again: `docker compose up -d`

## Ports

- **Web Application:** http://localhost:8081
- **MySQL Database:** localhost:3307

## Default Database Credentials

- **Root Password:** `root_password`
- **Database:** `travianz`
- **User:** `travianz`
- **Password:** `travianz_pass`

## Customization

### Changing the Web Port
Edit `docker-compose.yml` and change the web service ports mapping:
```yaml
ports:
  - "8081:80"  # Change 8081 to your desired port
```

### Changing Database Credentials
Edit the environment variables in `docker-compose.yml` for both the `web` and `db` services.
