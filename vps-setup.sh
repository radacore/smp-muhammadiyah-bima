#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

# 1) Root .env (consumed by docker compose for ${SEKOLAH_BASE_URL})
if [ ! -f .env ]; then
  if [ -f .env.example ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
  else
    echo "WARN: .env and .env.example both missing; SEKOLAH_BASE_URL akan default ke http://localhost:8090/" >&2
  fi
fi

# Load .env so SEKOLAH_BASE_URL juga tersedia untuk patch sekolah/.env di bawah
if [ -f .env ]; then
  set -a
  # shellcheck disable=SC1091
  . ./.env
  set +a
fi

SEKOLAH_BASE_URL="${SEKOLAH_BASE_URL:-http://localhost:8090/}"
echo "Using SEKOLAH_BASE_URL=${SEKOLAH_BASE_URL}"

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

echo "Preparing sekolah environment..."
if [ -f sekolah/.env.production ]; then
  cp sekolah/.env.production sekolah/.env
fi
SEKOLAH_BASE_URL="${SEKOLAH_BASE_URL}" python3 - <<'PY'
import os, re
from pathlib import Path
base = os.environ['SEKOLAH_BASE_URL']
p = Path('sekolah/.env')
text = p.read_text()
text = text.replace('CI_ENVIRONMENT = development', 'CI_ENVIRONMENT = production')
# Replace any existing app.baseURL line (covers localhost:8081, localhost:8090, atau domain lama)
text = re.sub(r"^app\.baseURL\s*=\s*['\"].*?['\"]\s*$",
              f"app.baseURL = '{base}'", text, flags=re.MULTILINE)
p.write_text(text)
PY

echo "Preparing databases..."
bash docker/db/init-vps/import-dumps.sh

echo "Building and starting sekolah + siakad..."
docker compose -f docker-compose.vps.yml up -d --build

echo ""
echo "Deployment done."
echo "Sekolah: ${SEKOLAH_BASE_URL}"
echo "Siakad : http://YOUR_VPS_IP:8091"
echo ""
echo "If you use Nginx Proxy Manager, point domains to:"
echo "  mts_sekolah_muhammadiyah:80"
echo "  mts_siakad_muhammadiyah:80"
