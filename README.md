# SMP Muhammadiyah Bima

Repository ini berisi dua aplikasi PHP yang dijalankan berdampingan dengan Docker:

1. `sekolah/` — website sekolah berbasis CodeIgniter 4, PHP 8.2.
2. `siakad/` — aplikasi SIAKAD legacy PHP, PHP 7.4.

Keduanya memakai database terpisah:

- `sekolah` untuk website sekolah.
- `wbsiakadv3` untuk SIAKAD.

## Struktur penting

```text
.
├── docker-compose.yaml              # untuk lokal/dev, sudah termasuk DB + phpMyAdmin + Portainer + NPM
├── docker-compose.vps.yml           # untuk VPS yang sudah punya MySQL, phpMyAdmin, Portainer, NPM sendiri
├── vps-setup.sh                     # helper deploy di VPS
├── docker/
│   ├── db/init/                     # init DB untuk compose lokal
│   ├── db/init-vps/                 # init/import DB untuk MySQL existing di VPS
│   ├── php-apache-ci4/              # PHP 8.2 Apache untuk CodeIgniter 4
│   └── php-apache-siakad/           # PHP 7.4 Apache untuk SIAKAD legacy
├── sekolah/
│   ├── sekolah.sql                  # dump database sekolah
│   └── ...
└── siakad/
    ├── DATABASE/wbsiakadv3.sql      # dump database SIAKAD
    └── ...
```

## Menjalankan di lokal

```bash
cd /path/to/smp-muhammadiyah-bima
docker compose up -d --build
```

URL lokal:

- Sekolah: http://localhost:8081
- SIAKAD: http://localhost:8082
- phpMyAdmin: http://localhost:8083
- Portainer: http://localhost:9001
- Nginx Proxy Manager: http://localhost:81

Jika database pernah diinisialisasi dan ingin import ulang dari SQL:

```bash
docker compose down -v
docker compose up -d --build
```

## Deploy di VPS yang sudah punya stack Docker sendiri

VPS Anda sudah punya service existing seperti:

- MySQL container: `mysql_db`
- Network Docker external: `mts_network`
- phpMyAdmin, Portainer, Nginx Proxy Manager existing

Karena itu file `docker-compose.vps.yml` tidak membuat MySQL/phpMyAdmin/Portainer/NPM baru. File ini hanya menjalankan dua aplikasi:

- `mts_sekolah_muhammadiyah` di port host `8090`
- `mts_siakad_muhammadiyah` di port host `8091`

### Langkah deploy dari awal

```bash
cd /path/di/vps
git clone https://github.com/radacore/smp-muhammadiyah-bima.git
cd smp-muhammadiyah-bima
cp .env.example .env
# edit .env, set SEKOLAH_BASE_URL ke domain final (akhiri dengan "/")
chmod +x vps-setup.sh docker/db/init-vps/import-dumps.sh
./vps-setup.sh
```

Script `vps-setup.sh` akan:

1. Membuat `.env` dari `.env.example` kalau belum ada, lalu membaca `SEKOLAH_BASE_URL` dari sana.
2. Memastikan network `mts_network` ada.
3. Memastikan container MySQL existing `mysql_db` sedang running.
4. Membuat database `sekolah` dan `wbsiakadv3`.
5. Membuat user database `muhammadiyah` dengan password `muhammadiyah`.
6. Meng-import `sekolah/sekolah.sql` dan `siakad/DATABASE/wbsiakadv3.sql`.
7. Menyalin `sekolah/.env.production` ke `sekolah/.env` dan mengisi `app.baseURL` dari `SEKOLAH_BASE_URL`.
8. Build dan start container sekolah + siakad.

Setelah selesai:

- Sekolah: `http://IP_VPS:8090`
- SIAKAD: `http://IP_VPS:8091`

## Setup domain dengan Nginx Proxy Manager

Karena aplikasi berada di network `mts_network`, di Nginx Proxy Manager buat Proxy Host:

Untuk website sekolah:

- Forward Hostname/IP: `mts_sekolah_muhammadiyah`
- Forward Port: `80`

Untuk SIAKAD:

- Forward Hostname/IP: `mts_siakad_muhammadiyah`
- Forward Port: `80`

Jika sudah pakai domain, atur base URL sekolah agar asset dan link benar lewat `.env` di root repo:

```bash
# .env (di root repo VPS)
SEKOLAH_BASE_URL=https://domain-sekolah-anda.com/
```

Lalu restart:

```bash
docker compose -f docker-compose.vps.yml up -d
```

Kalau CSS/JS/gambar masih nge-load dari `http://localhost:8090/...`, artinya `SEKOLAH_BASE_URL` belum ke-set saat compose up. Jalankan ulang `./vps-setup.sh` (atau minimal `docker compose -f docker-compose.vps.yml up -d --force-recreate sekolah`) setelah `.env` benar.

## Perintah update di VPS setelah ada perubahan dari Git

```bash
cd /path/di/vps/smp-muhammadiyah-bima
git pull
docker compose -f docker-compose.vps.yml up -d --build
```

Kalau perubahan hanya PHP/CSS/JS dan memakai volume bind mount, rebuild biasanya tidak wajib. Namun perintah di atas aman untuk memastikan image terbaru dipakai.

Jika dump SQL berubah dan ingin import ulang:

```bash
bash docker/db/init-vps/import-dumps.sh
```

Hati-hati: perintah import akan menimpa/menambahkan data sesuai isi dump SQL. Backup database production terlebih dahulu jika sudah berisi data real.

## Login default

Website sekolah:

- CMS admin: http://localhost:8081/login
  - username: `admin`
  - password: `admin123`
- CMS admin vendor lama:
  - username: `andoyo`
  - password: `andoyo`
- Login pegawai: http://localhost:8081/signin
  - username: `admin`
  - password: `admin123`

SIAKAD:

- URL lokal: http://localhost:8082
- username: `admin`
- password: `admin123`

Di VPS, sesuaikan port:

- Sekolah: `http://IP_VPS:8090`
- SIAKAD: `http://IP_VPS:8091`

## Catatan teknis

- Website sekolah memakai PHP 8.2 karena CodeIgniter 4 di project ini membutuhkan PHP minimal 8.1.
- SIAKAD memakai PHP 7.4 karena aplikasi legacy masih memakai pola lama dan shim `mysql_*` ke `mysqli_*`. Jangan upgrade SIAKAD ke PHP 8 tanpa refactor kode database.
- MySQL 8 di VPS memakai user `muhammadiyah` dengan `mysql_native_password` agar kompatibel dengan PHP 7.4 mysqli.
- Folder asset sekolah berada di `sekolah/assets`, lalu di-serve lewat symlink `sekolah/public/assets`.

## Troubleshooting cepat

Cek container:

```bash
docker ps
docker compose -f docker-compose.vps.yml logs -f sekolah
docker compose -f docker-compose.vps.yml logs -f siakad
```

Cek database di VPS:

```bash
docker exec -it mysql_db mysql -uroot -proot -e "SHOW DATABASES;"
docker exec -it mysql_db mysql -uroot -proot -e "SHOW TABLES FROM sekolah;"
docker exec -it mysql_db mysql -uroot -proot -e "SHOW TABLES FROM wbsiakadv3;"
```

Restart aplikasi:

```bash
docker compose -f docker-compose.vps.yml restart sekolah siakad
```
