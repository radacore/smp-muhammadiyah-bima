CREATE DATABASE IF NOT EXISTS `sekolah` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE IF NOT EXISTS `wbsiakadv3` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'muhammadiyah'@'%' IDENTIFIED WITH mysql_native_password BY 'muhammadiyah';
ALTER USER 'muhammadiyah'@'%' IDENTIFIED WITH mysql_native_password BY 'muhammadiyah';
GRANT ALL PRIVILEGES ON `sekolah`.* TO 'muhammadiyah'@'%';
GRANT ALL PRIVILEGES ON `wbsiakadv3`.* TO 'muhammadiyah'@'%';
FLUSH PRIVILEGES;
