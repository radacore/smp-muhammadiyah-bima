#!/bin/sh
set -eu

mysql -uroot -p"$MARIADB_ROOT_PASSWORD" wbsiakadv3 < /docker-dumps/wbsiakadv3.sql
