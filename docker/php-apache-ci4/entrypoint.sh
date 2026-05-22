#!/bin/sh
set -eu

APP_DIR="/var/www/html"
WRITABLE="$APP_DIR/writable"

# Install composer deps on first boot if vendor is missing
if [ -f "$APP_DIR/composer.json" ] && [ ! -d "$APP_DIR/vendor" ]; then
    echo "[sekolah] vendor/ missing, running composer install..."
    cd "$APP_DIR"
    composer install --no-interaction --no-progress --prefer-dist --optimize-autoloader || true
fi

# Ensure writable tree exists with the dirs CI4 expects
mkdir -p \
    "$WRITABLE/cache" \
    "$WRITABLE/logs" \
    "$WRITABLE/session" \
    "$WRITABLE/uploads" \
    "$WRITABLE/debugbar" \
    "$APP_DIR/public/uploads"

# Apache runs as www-data; make writable + uploads owned by it
chown -R www-data:www-data "$WRITABLE" "$APP_DIR/public/uploads" || true
chmod -R ug+rwX "$WRITABLE" "$APP_DIR/public/uploads" || true

exec "$@"
