# TravianZ

[![Maintenance](https://img.shields.io/maintenance/yes/2026.svg)](https://github.com/Shadowss/TravianZ)
[![GitHub Release](https://img.shields.io/github/release/Shadowss/TravianZ/all.svg)](https://github.com/Shadowss/TravianZ)
[![GitHub contributors](https://img.shields.io/github/contributors/Shadowss/TravianZ.svg)](https://github.com/Shadowss/TravianZ)
[![license](https://img.shields.io/github/license/Shadowss/TravianZ.svg)](https://github.com/Shadowss/TravianZ)

TravianZ is an open-source browser strategy game inspired by classic Travian-like gameplay.

This repository currently targets modern local/server setups with PHP 8.x and MariaDB.

Project Status

* Version: v10 Full Refactor
* PHP 8.3+ compatible
* Actively maintained
* Suitable for production servers
* Major legacy codebase modernization completed

Upgrading from older versions is not recommended. Perform a fresh installation and migrate data manually if required.

⸻

Version 11 Highlights

Massive Code Refactor

* Fully refactored Templates folder/system.
* Added 🇫🇷 French and 🇷🇴 Romanian languages.
* GameEngine fully refactored, file by file, with randomized equivalence testing (20k-30k cases per critical function).
* Database.php (~450 methods) split into 14 domain traits under GameEngine/Database/ - zero call-site changes, validated via reflection parity.
* Automation.php (~116 methods) split into 11 domain traits under GameEngine/Automation/ using the same method.
* Village.php: production getters unified, one UPDATE per resource tick instead of two, side-effect-free constructor with explicit tick(), automation lock race (TOCTOU) fixed.
* Building.php: build requirements rewritten as a declarative table, per-village instance caches, dead code removed (2,085 -> 1,829 lines).
* Units.php, Market.php, Message.php, Profile.php and Chat.php refactored and hardened.
* starvation() function in Automation refactored and split into multiple methods.
* sendUnitsComplete() function fully refactored, reducing a 1711-line function into 26 separate methods.
* checkAllianceEmbassiesStatus() in Database redesigned and split into multiple functions.
* Medal system completely rewritten for easier maintenance and readability.
* Removed obsolete and unused code/folders from both the game and Admin Panel.
* Automation moved to a real cron job.
* Database cleanup with configurable retention (battle reports, chat, stale rows).
* SQL index audit for hot columns.
* Static asset compression and browser caching (.htaccess).

⸻

New Playable Tribes

Four fully playable tribes added on top of the original three, across the data layer, game engine and templates:

* Huns (tribe 6, units u51-u60) - Command Center (gid 44) replaces Residence/Palace, Makeshift Wall.
* Egyptians (tribe 7, units u61-u70) - Waterworks, Stone Wall.
* Spartans (tribe 8, units u71-u80) - Defensive Wall.
* Vikings (tribe 9, units u81-u90) - Barricade.
* New buildings integrated across gids 42-50 (incl. the Hospital family and Great Workshop) with per-tribe build requirements.
* Unit-range formula (tribe-1)*10+1; Great Building training queue offset moved to +500 to avoid unit-ID conflicts.
* Per-tribe Academy templates, troops.tpl unit cap raised 50 -> 90, statistics routing and CSS, profile/ranking/map tribe arrays, admin dropdowns, install feature flags.
* Three-step registration wizard: visual tribe cards -> starting quadrant -> confirmation.

⸻

T4 Hero System

Travian 4-style hero system ported into the T3.6 engine, in phases:

* Items backend (HeroItems.php) with equippable hero items and data layer.
* Adventures backend (HeroAdventure.php) with adventure generation and rewards.
* Auction house (HeroAuction.php) for player-to-player item trading.
* Battle and speed integration (HeroBattleBonus.php + Battle.php hooks): item fighting strength, per-unit weapon bonuses, armor damage reduction, hunting horn and speed effects, artwork culture-point item.

⸻

Admin Panel

* Complete frontend and backend redesign.
* New Admin Panel design.
* New homepage with server statistics.
* New Server Info page.
* New Natars Management format.
* New debug log system.
* New maintenance mode system (banned players remain banned after maintenance).
* New server reset system.
* Username rename moved to Edit User.
* Added Edit Protection in Edit User.
* Alliance editor added (frontend & backend).
* Removed duplicate player pencils; user and alliance editing are now separated.
* Improved punish system (troop deletion now works correctly).
* Ban by IP support added.
* Ban system redesigned:
    * In-game ban reason visible.
    * Moderator name visible.
    * Ban history included.
* Unified log system:
    * Admin Panel logs tab.
    * Village logs.
    * Technology logs.
    * Troop logs.
    * Various game logs.
* Account deletion page improved:
    * Displays deletion process status.
    * Allows cancellation of deletion.
* Fixed Multihunter access during installation.

⸻

Gameplay Improvements

* Vacation Mode added (requires 9 conditions).
* Alliance rank and privilege management added.
* Main Building instant demolition with 10 gold.
* Account Statement added in Travian Plus section (received/spent gold history).
* Winner registration check added.
* Medal onclick support.
* Complete Preferences system (frontend & backend):
    * Language
    * Time format
    * Large map
    * Reports
    * Auto-completions
    * Other player settings
* Server Milestones system (first village, first artifact, WW progress...) with ranking widget and SVG badges.
* Mead-Festival mechanic for the Brewery (Teuton-only, 72-hour timer) with correct catapult-confusion integration.
* New Special Medal System:
    * Artifact Owner
    * WW Owner
    * WW Winner
    * Hero Level 100
    * Great Warehouse Owner
    * Great Granary Owner
    * Wall Master

⸻

Bug Fixes

* Oasis regeneration fixed after attacks without conquest.
* Parallel training exploit fixed.
* Infinite gold exploit fixed.
* Race conditions fixed for:
    * Market
    * Hero
    * Troops
    * Various game mechanics
* Winner registration issues fixed.
* Punish troop deletion fixed.
* Huns can now build the Stonemason's Lodge (via Command Center >= 3) - engine and templates.
* Master Builder gold finish now always deducts resources (was free with <= 2 queued jobs) and validates the building type instead of the slot number.
* finishAll() no longer recomputes culture points from stale cached data (wrong CP was being persisted).
* isCastleBuilt() strict type check - a WW at level 26 or a matching village ref no longer falsely blocks Palace construction.
* Undefined-variable warnings on PHP 8 fixed (chat refresh wrote to the error log on every request).

⸻

Security Improvements

* Full Admin Panel security overhaul.
* Game mechanics security updates.
* New CSRF protection system implemented.
* Added protection against race conditions.
* Improved validation across critical systems.
* Server-side culture-point check on village founding was silently bypassed - fixed (client-side was the only enforcement).
* IDOR in friend-list operations fixed: client-supplied user ID replaced with the session user.
* Negative-amount guard on marketplace resource sending.
* Repo-wide audit (342 PHP files, ~66k lines): systemic cache-invalidation gaps closed via a central invalidateCachesFor(), reflected XSS fixes (warsim.php, Preferences), hardened .htaccess, error_reporting bitmask and MD5-fallback guards.

⸻

New Systems

* Full alliance editing system.
* New account statement system.
* New maintenance mode logic.
* New reset server system.
* New debug log system.
* New logging architecture.
* New Preferences system.
* New Special Medal system.

⸻

Installer

* New installation design.
* Multihunter access fixed during installation.

⸻

Performance Improvements

* Added caching in critical areas.
* Dynamic table prefix support.
* Better query handling.
* Improved world generation.
* Improved reset operations.

⸻

Refactor Progress

Completed

* Templates system.
* Admin Panel.
* Frontend and backend redesign.
* GameEngine (full sweep - all files audited, refactored where needed).
* Automation functions + split into 11 domain traits.
* Database split into 14 domain traits, with request-level caching and central invalidation.
* Units, Technology, Village, Building, Market, Message, Profile and Chat refactors.
* Medal system.
* Logging system.

Still Planned

Nothing for the moment !

⸻

Miscellaneous

* Added 🇫🇷 French language.
* Added 🇷🇴 Romanian language.
* Improved code readability and maintainability across the entire project.
* Removed hundreds of lines of legacy and duplicate code.
* Multiple internal optimizations and quality-of-life improvements.

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
6. Installation in cPanel (Cron Jobs → Add New Cron Job, every minute):
   - * * * * * /usr/bin/php /home/USER/public_html/cron.php >/dev/null 2>&1 (REPLACE USER WITH YOUR USERNAME)

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
