#!/bin/sh
set -eu

script_dir=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
repo_root=$(CDPATH= cd -- "$script_dir/.." && pwd)
compose_file=${1:-"$repo_root/docker-compose.yml"}

fail()
{
    printf 'FAIL: %s\n' "$1" >&2
    exit 1
}

[ -f "$compose_file" ] || fail "Compose file not found: $compose_file"

if awk '
    /^[[:space:]]*#/ { next }
    index($0, "./var/db") && index($0, "/docker-entrypoint-initdb.d") { found = 1 }
    END { exit found ? 0 : 1 }
' "$compose_file"
then
    fail "installer SQL templates must not be mounted into /docker-entrypoint-initdb.d"
fi

if ! awk '
    $0 == "  db:" {
        in_db = 1
        next
    }
    in_db && /^  [[:alnum:]_-]+:$/ {
        in_db = 0
    }
    in_db && $0 == "    healthcheck:" {
        healthcheck = 1
    }
    in_db && /healthcheck[.]sh/ && /--connect/ && /--innodb_initialized/ {
        readiness_probe = 1
    }
    in_db && $0 ~ /^      interval:/ {
        interval = 1
    }
    in_db && $0 ~ /^      timeout:/ {
        timeout = 1
    }
    in_db && $0 ~ /^      retries:/ {
        retries = 1
    }
    END {
        exit (healthcheck && readiness_probe && interval && timeout && retries) ? 0 : 1
    }
' "$compose_file"
then
    fail "db service must define a bounded MariaDB readiness healthcheck"
fi

require_healthy_db_dependency()
{
    service=$1

    if ! awk -v service="$service" '
        $0 == "  " service ":" {
            in_service = 1
            next
        }
        in_service && /^  [[:alnum:]_-]+:$/ {
            in_service = 0
        }
        in_service && $0 == "    depends_on:" {
            in_dependencies = 1
            next
        }
        in_service && in_dependencies && $0 == "      db:" {
            in_db_dependency = 1
            next
        }
        in_service && in_db_dependency && $0 == "        condition: service_healthy" {
            found = 1
        }
        END {
            exit found ? 0 : 1
        }
    ' "$compose_file"
    then
        fail "$service must wait for the db service to become healthy"
    fi
}

require_healthy_db_dependency web
require_healthy_db_dependency phpmyadmin

printf 'PASS: Docker Compose database initialization contract\n'
