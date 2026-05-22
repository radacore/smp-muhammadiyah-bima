#!/bin/sh
set -eu

DUMP="/docker-dumps/sekolah.sql"

if [ ! -s "$DUMP" ]; then
    echo "[02-import-sekolah] $DUMP not found or empty, skipping."
    exit 0
fi

echo "[02-import-sekolah] importing $DUMP into database 'sekolah'..."
mysql -uroot -p"$MARIADB_ROOT_PASSWORD" sekolah < "$DUMP"
echo "[02-import-sekolah] done."
