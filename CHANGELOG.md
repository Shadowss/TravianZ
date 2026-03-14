# Changelog

All notable changes to this project are documented in this file.

Format inspired by Keep a Changelog and Semantic Versioning principles.

## [Unreleased]

## [2026-03-14] - Stability, PHP 8, Docker and Installer Hardening

### Added
- New root changelog file.
- Admin panel option to list users in the Users menu (`?p=users`).
- New admin users list page with pagination and links to player details: `Admin/Templates/users.tpl`.
- Installer SQL defaults in config form now read from `.env` (with fallback to legacy `MYSQL_*` keys).
- Random database prefix generation per installation session.
- Installer timezone option for Brazil (`America/Sao_Paulo`) and default timezone set to Sao Paulo.
- SSE explicit error payload in croppers builder to avoid infinite reconnect loops.

### Changed
- Docker runtime upgraded to PHP 8.3 (Apache).
- Docker Compose database moved to MariaDB latest.
- Compose configuration modernized (v2 style), env naming standardized to `MARIADB_*` with compatibility support.
- README and Docker docs updated to reflect PHP 8/MariaDB and modern compose commands.
- Installer timezone id mapping fixed in `install/index.php` to match form options.
- Croppers build progress behavior adjusted to report incremental progress in batches.

### Fixed
- PHP 8 compatibility:
  - Replaced deprecated `each()` usage.
  - Added safe guards for `magic_quotes_*` checks.
- Multiple warnings/fatals from undefined variables and null array offsets across game/admin/installer pages.
- Duplicate constant definition warnings in language file (preventing header issues).
- Duplicate key failures for croppers index creation in PHP 8 (`mysqli_sql_exception` behavior) by making index ops idempotent.
- Installer and runtime DB connection robustness:
  - host:port normalization,
  - retry logic,
  - throwable-safe handling.
- Duplicate primary key errors in units insertion by making `addUnits` idempotent (`ON DUPLICATE KEY UPDATE`).
- Admin template warnings in report/message pages (undefined keys/indexes).
- Admin map tile query now uses dynamic table prefix (`TB_PREFIX`) instead of hardcoded `s1_` tables.
- Session/header issues in admin reset script:
  - removed output before `<?php`,
  - proper session start checks,
  - safe admin access check.
- Mass message and system message flows no longer trigger undefined control variable warnings.
- Plus menu warning fixed by correcting `isset($_GET['id'])` condition precedence.
- Plus page now displays active option remaining time with seconds and end time.

### Performance
- World data generation optimized for large maps:
  - temporary session tuning for bulk writes,
  - temporary drop/recreate of secondary indexes in `wdata` during heavy insert.
- Croppers generation optimized:
  - per-tile bonus query replaced with chunk-level batch bonus calculation,
  - reduced lock contention and improved perceived progress updates.
- Build/installer flow updated to avoid stalled progress UI states.

### Security and Safety
- Stricter checks around request/session variables to prevent warnings escalating into header failures.
- More defensive null-safe access patterns in DB result handling.
- Better error propagation in SSE endpoints.

### Developer Experience
- `.env.example` restored and aligned with MariaDB naming.
- Legacy `MYSQL_*` compatibility keys now inherit values from `MARIADB_*`.
- Multiple PHP syntax validation passes performed after patches.

---

## Notes
- This changelog reflects the current hardening/migration cycle and operational fixes applied to make the project run cleanly on PHP 8 + MariaDB.
- If you want strict version tags (e.g. `v8-migration.1`, `v8-migration.2`), convert the dated section above into tagged releases as part of your next release process.
