#!/usr/bin/env bash
set -euo pipefail

MYSQL_CONTAINER="${MYSQL_CONTAINER:-mysql_db}"
MYSQL_ROOT_PASSWORD="${MYSQL_ROOT_PASSWORD:-root}"

cd "$(dirname "$0")/../../.."

echo "[1/3] Initializing databases/users inside ${MYSQL_CONTAINER}..."
docker exec -i "${MYSQL_CONTAINER}" mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" < docker/db/init-vps/01-init-databases.sql

echo "[2/3] Importing sekolah/sekolah.sql into database sekolah..."
docker exec -i "${MYSQL_CONTAINER}" mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" sekolah < sekolah/sekolah.sql

echo "[3/3] Importing siakad/DATABASE/wbsiakadv3.sql into database wbsiakadv3..."
docker exec -i "${MYSQL_CONTAINER}" mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" wbsiakadv3 < siakad/DATABASE/wbsiakadv3.sql

echo "Done. Database sekolah and wbsiakadv3 are ready."
