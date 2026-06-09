# TravianZ

[![Maintenance](https://img.shields.io/maintenance/yes/2026.svg)](https://github.com/Shadowss/TravianZ)
[![GitHub Release](https://img.shields.io/github/release/Shadowss/TravianZ/all.svg)](https://github.com/Shadowss/TravianZ)
[![GitHub contributors](https://img.shields.io/github/contributors/Shadowss/TravianZ.svg)](https://github.com/Shadowss/TravianZ)
[![license](https://img.shields.io/github/license/Shadowss/TravianZ.svg)](https://github.com/Shadowss/TravianZ)

TravianZ is an open-source browser strategy game inspired by classic Travian-like gameplay.

This repository currently targets modern local/server setups with PHP 8.x and MariaDB.

## Project Status

- Version line: `v9` (Incremental Refactor)
- Stability: playable and actively maintained
- Migration note: this is not a drop-in upgrade over older `8.3.4` deployments

If you are upgrading from an older installation, do a fresh install and migrate data carefully.

## Quick Start (Docker)

```bash
git clone https://github.com/Shadowss/TravianZ.git
cd TravianZ
cp .env.example .env
docker compose up -d
```

Then open:

- `http://localhost:8080/install`

Detailed container guide: [DOCKER_README.md](DOCKER_README.md)

## System Requirements

Recommended:

- PHP `8.3+`
- MariaDB `latest stable` (or MySQL-compatible server)
- Apache or Nginx with PHP support
- Linux server with enough CPU/RAM for your expected player count

Notes:

- The game is query-heavy by design (legacy architecture), so shared hosting can become a bottleneck quickly.
- For medium/large servers, prefer dedicated or well-sized VPS infrastructure.

## Installation (Web Installer)

1. Start services (Docker) or prepare your web+DB stack.
2. Open `http://your-host/install`.
3. Fill database settings:
  - Host: `db` (Docker) or your DB host
  - Port: usually `3306`
  - DB/User/Password from your environment
4. Complete installer steps:
  - DB structure
  - World data
  - Croppers build
5. After success, access the game root.

## Environment Configuration

Use `.env` (copy from `.env.example`) to manage deployment values.

Main keys:

- `MARIADB_ROOT_PASSWORD`
- `MARIADB_DATABASE`
- `MARIADB_USER`
- `MARIADB_PASSWORD`
- `DB_HOST`
- `DB_PORT`

Legacy compatibility keys (`MYSQL_*`) are still supported and can inherit MariaDB values.

## Admin Panel

Admin entrypoint:

- `http://your-host/Admin/admin.php`

Recent improvements include:

- Full incremental refactored GameEngine and Templates folder
- Added cache on Database.php and Automation.php and other important files
- Dynamic table prefix support in map tile queries

## Security: IP bans & reverse proxies

The admin **Ban** page can ban by **IP address** in addition to per-account bans
(`Admin/admin.php?p=ban` -> *Ban IP Address*). A banned IP receives an "Access blocked"
page on every game page. Admins and Multihunters are never affected, and the admin
panel itself is always reachable (no self-lockout). IPv4 and IPv6 are supported.

### Configuration (`GameEngine/config.php`)

| Constant | Default | Purpose |
|----------|---------|---------|
| `BAN_IP_ENABLED` | `true` | Master switch for IP-ban enforcement. |
| `IP_TRUSTED_PROXIES` | `""` | Comma-separated proxy IPs/CIDRs allowed to set the forwarded header. |
| `IP_FORWARDED_HEADER` | `"HTTP_X_FORWARDED_FOR"` | `$_SERVER` key read for the real client IP when behind a trusted proxy. |

**Security model:** only `REMOTE_ADDR` (the direct peer) is trusted by default — it
cannot be spoofed. Forwarded headers are honoured **only** when `REMOTE_ADDR` is in
`IP_TRUSTED_PROXIES`. This prevents a visitor from bypassing a ban with a forged
`X-Forwarded-For` header.

### Deployment scenarios

**1. Direct access (no proxy)** — default, nothing to do:

```php
define("IP_TRUSTED_PROXIES", "");
```

**2. Behind a reverse proxy** (Nginx, Nginx Proxy Manager / NPMplus, Traefik, Caddy, …):

```php
// your proxy's address, or a CIDR (e.g. 10.0.0.0/8 / 172.16.0.0/12 for a Docker bridge network)
define("IP_TRUSTED_PROXIES", "10.0.0.1");
define("IP_FORWARDED_HEADER", "HTTP_X_FORWARDED_FOR");
```

The proxy must forward the client IP. Prefer **overwriting** the header with the real
peer rather than appending a client-supplied value (non-spoofable). Nginx example:

```nginx
proxy_set_header X-Forwarded-For $remote_addr;
proxy_set_header X-Real-IP $remote_addr;
```

**3. Behind Cloudflare:**

```php
define("IP_TRUSTED_PROXIES", "<your origin proxy or the Cloudflare IP ranges>");
define("IP_FORWARDED_HEADER", "HTTP_CF_CONNECTING_IP");
```

> ⚠️ **Important:** behind a proxy, if `IP_TRUSTED_PROXIES` is left empty, every
> visitor is seen with the proxy's IP — a single IP ban would then block everyone.
> Always set it to your proxy's address.

### Verify

Check the resolved IP in the admin **Unified Admin Log** (a login entry shows the
client IP), or temporarily print `$_SERVER['REMOTE_ADDR']` and the forwarded header:
`REMOTE_ADDR` should be your proxy, and the forwarded header should carry the real
client IP.

## Performance Notes

For large worlds (for example `400x400`), generation tasks can be expensive.

Recent optimizations include:

- world data generation tuning for bulk operations
- croppers generation batching and progress streaming
- safer DB/session handling during installer workflows

For production-like loads, monitor:

- DB CPU and slow queries
- PHP-FPM/Apache worker limits
- disk I/O during installer and reset operations

## Troubleshooting

Common checks:

1. If installer cannot connect to DB:
  - verify `DB_HOST`, port, user and password
  - in Docker, host should be `db`, not `localhost`
2. If permissions fail during install:
  - ensure web user can write required runtime files/folders
3. If pages show warnings after PHP upgrade:
  - ensure latest code is deployed
  - clear opcode/cache and retry

For container-specific troubleshooting, see [DOCKER_README.md](DOCKER_README.md).

## Development

Useful commands:

```bash
# Start stack
docker compose up -d

# Logs
docker compose logs -f web

# Validate PHP files
find . -name '*.php' -not -path './var/*' -print0 | xargs -0 -n1 php -l
```

Repository references:

- Change history: [CHANGELOG.md](CHANGELOG.md)
- Contribution guide: [CONTRIBUTING.md](CONTRIBUTING.md)
- Code of conduct: [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)

## Community and Support

- Issues: https://github.com/Shadowss/TravianZ/issues
- Wiki: https://github.com/Shadowss/TravianZ/wiki
- Chat: https://gitter.im/TravianZ-V8/Lobby

## Credits

Thanks to the original and current maintainers, contributors, testers, and the TravianZ community.

Special acknowledgement to all legacy authors and maintainers who kept this project alive through multiple iterations.

## License

This project is licensed under the terms described in [LICENSE](LICENSE).
