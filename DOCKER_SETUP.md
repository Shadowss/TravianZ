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

4. **Complete the installation:**
   Follow the web installer steps to complete the setup.

5. **Access your game:**
   After installation, navigate to:
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

## Troubleshooting

### Permission Issues
If you encounter permission issues, run:
```bash
docker compose exec web chown -R www-data:www-data /var/www/html
docker compose exec web chmod -R 755 /var/www/html
```

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
