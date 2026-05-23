#!/bin/sh
set -eu

APP_DIR="/var/www/html"
WRITABLE="$APP_DIR/writable"
UPLOAD_ROOT="$APP_DIR/assets/upload"

if [ -f "$APP_DIR/composer.json" ] && [ ! -d "$APP_DIR/vendor" ]; then
    echo "[sekolah] vendor/ missing, running composer install..."
    cd "$APP_DIR"
    composer install --no-interaction --no-progress --prefer-dist --optimize-autoloader || true
fi

mkdir -p \
    "$WRITABLE/cache" \
    "$WRITABLE/logs" \
    "$WRITABLE/session" \
    "$WRITABLE/uploads" \
    "$WRITABLE/debugbar" \
    "$APP_DIR/public/uploads" \
    "$UPLOAD_ROOT/image/thumbs" \
    "$UPLOAD_ROOT/file" \
    "$UPLOAD_ROOT/staff/thumbs" \
    "$UPLOAD_ROOT/kategori_agenda/thumbs" \
    "$UPLOAD_ROOT/pendaftaran"

chown -R www-data:www-data \
    "$WRITABLE" \
    "$APP_DIR/public/uploads" \
    "$UPLOAD_ROOT" || true
chmod -R ug+rwX \
    "$WRITABLE" \
    "$APP_DIR/public/uploads" \
    "$UPLOAD_ROOT" || true

exec "$@"
