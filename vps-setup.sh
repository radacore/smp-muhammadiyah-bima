#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

echo "Checking Docker network mts_network..."
if ! docker network inspect mts_network >/dev/null 2>&1; then
  docker network create mts_network
fi

echo "Checking existing MySQL container mysql_db..."
if ! docker ps --format '{{.Names}}' | grep -qx 'mysql_db'; then
  echo "ERROR: container mysql_db is not running." >&2
  echo "Start your existing VPS stack first, then run ./vps-setup.sh again." >&2
  exit 1
fi

echo "Preparing databases..."
bash docker/db/init-vps/import-dumps.sh

echo "Building and starting sekolah + siakad..."
docker compose -f docker-compose.vps.yml up -d --build

echo ""
echo "Deployment done."
echo "Sekolah: http://YOUR_VPS_IP:8090"
echo "Siakad : http://YOUR_VPS_IP:8091"
echo ""
echo "If you use Nginx Proxy Manager, point domains to:"
echo "  mts_sekolah_muhammadiyah:80"
echo "  mts_siakad_muhammadiyah:80"
