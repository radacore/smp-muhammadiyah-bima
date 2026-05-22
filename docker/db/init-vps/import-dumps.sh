#!/usr/bin/env bash
set -euo pipefail

MYSQL_CONTAINER="${MYSQL_CONTAINER:-mysql_db}"
MYSQL_ROOT_PASSWORD="${MYSQL_ROOT_PASSWORD:-root}"
FORCE_IMPORT="${FORCE_IMPORT:-0}"

cd "$(dirname "$0")/../../.."

mysql_exec() {
  docker exec -i "${MYSQL_CONTAINER}" mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" "$@"
}

table_count() {
  local db="$1"
  docker exec -i "${MYSQL_CONTAINER}" mysql -N -B -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${db}';" 2>/dev/null | tr -d '[:space:]'
}

import_dump_if_needed() {
  local db="$1"
  local dump="$2"
  local count
  count="$(table_count "$db")"

  if [ "${FORCE_IMPORT}" = "1" ]; then
    echo "  FORCE_IMPORT=1, dropping and recreating ${db} before import..."
    mysql_exec -e "DROP DATABASE IF EXISTS \`${db}\`; CREATE DATABASE \`${db}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; GRANT ALL PRIVILEGES ON \`${db}\`.* TO 'muhammadiyah'@'%'; FLUSH PRIVILEGES;"
    count=0
  fi

  if [ "${count}" != "0" ]; then
    echo "  ${db} already has ${count} tables. Skipping import. Set FORCE_IMPORT=1 to re-import."
    return 0
  fi

  echo "  Importing ${dump} into ${db}..."
  mysql_exec "${db}" < "${dump}"
}

echo "[1/3] Initializing databases/users inside ${MYSQL_CONTAINER}..."
mysql_exec < docker/db/init-vps/01-init-databases.sql

echo "[2/3] Checking/importing sekolah database..."
import_dump_if_needed "sekolah" "sekolah/sekolah.sql"

echo "[3/3] Checking/importing siakad database..."
import_dump_if_needed "wbsiakadv3" "siakad/DATABASE/wbsiakadv3.sql"

echo "Done. Database sekolah and wbsiakadv3 are ready."
