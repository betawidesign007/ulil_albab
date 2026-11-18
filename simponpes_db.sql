-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: simponpes_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `simponpes_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `simponpes_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `simponpes_db`;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kamars`
--

DROP TABLE IF EXISTS `kamars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kamars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kamar` varchar(255) NOT NULL,
  `gedung` varchar(255) DEFAULT NULL,
  `kapasitas` int(10) unsigned NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kamars`
--

LOCK TABLES `kamars` WRITE;
/*!40000 ALTER TABLE `kamars` DISABLE KEYS */;
INSERT INTO `kamars` VALUES (1,'Kamar A1','Asrama Putra',20,'aktif','2026-09-21 08:13:36','2026-09-21 08:13:36'),(2,'Kamar A2','Asrama Putra',20,'aktif','2026-09-21 08:13:36','2026-09-21 08:13:36'),(3,'Kamar B1','Asrama Putri',20,'aktif','2026-09-21 08:13:36','2026-09-21 08:13:36');
/*!40000 ALTER TABLE `kamars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_07_25_021832_create_santris_table',1),(6,'2026_09_08_121711_create_pendaftars_table',1),(7,'2026_09_08_152105_create_pembayaran_spps_table',2),(8,'2026_09_21_000001_add_status_to_santris_table',3),(9,'2026_09_21_000002_create_kamars_table',3),(10,'2026_09_21_000003_add_nik_to_santris_table',4),(11,'2026_09_21_000004_add_kamar_id_to_santris_table',5),(12,'2026_09_21_000005_add_pendidik_id_to_santris_table',6),(13,'2026_09_21_000006_create_website_contents_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran_spps`
--

DROP TABLE IF EXISTS `pembayaran_spps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran_spps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `santri_id` bigint(20) unsigned NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `nominal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('Lunas','Belum') NOT NULL DEFAULT 'Belum',
  `tanggal_bayar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_spps_santri_id_foreign` (`santri_id`),
  CONSTRAINT `pembayaran_spps_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_spps`
--

LOCK TABLES `pembayaran_spps` WRITE;
/*!40000 ALTER TABLE `pembayaran_spps` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran_spps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftars`
--

DROP TABLE IF EXISTS `pendaftars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftars`
--

LOCK TABLES `pendaftars` WRITE;
/*!40000 ALTER TABLE `pendaftars` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendaftars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `santris`
--

DROP TABLE IF EXISTS `santris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `santris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nisn` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota_kabupaten` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `desa` varchar(255) NOT NULL,
  `jenjang` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `sekolah_asal` varchar(255) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `pekerjaan_orang_tua` varchar(255) NOT NULL,
  `nomor_telpon_wa` varchar(255) NOT NULL,
  `status_pendaftaran` enum('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu',
  `kamar_id` bigint(20) unsigned DEFAULT NULL,
  `pendidik_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `santris_nisn_unique` (`nisn`),
  KEY `santris_kamar_id_foreign` (`kamar_id`),
  KEY `santris_pendidik_id_foreign` (`pendidik_id`),
  CONSTRAINT `santris_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamars` (`id`) ON DELETE SET NULL,
  CONSTRAINT `santris_pendidik_id_foreign` FOREIGN KEY (`pendidik_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `santris`
--

LOCK TABLES `santris` WRITE;
/*!40000 ALTER TABLE `santris` DISABLE KEYS */;
INSERT INTO `santris` VALUES (1,'32110418','9871123456780123','Berry Prima','Laki-laki','Jakarta','2026-09-21','Jl. Borobudur Blok A9 No.13','JAWA BARAT','KABUPATEN BOGOR','GUNUNG SINDUR','CIBADUNG','MA',NULL,'MTs Al-Kautsar','Salman','Yuli','Karyawan Swasta','081234567890','diterima',1,6,'2026-09-21 07:36:32','2026-09-21 08:15:03'),(2,'3256712820','23456789012345678','Yusuf Prabu Setyanegara','Laki-laki','Meda','2013-09-17','Jl. Jantung Harapan Blok C.3 Rt.003/004','SUMATERA UTARA','KOTA MEDAN','MEDAN HELVETIA','TANJUNG GUSTA','Tsanawiyah (MTs / SMP)',NULL,'SDI Al Ikhlas','Hamdan Matondang','Aminah','Pedagang','081789012345','diterima',2,6,'2026-09-21 09:37:49','2026-09-21 09:39:21'),(3,'241011402540','3674041809850011','Ibrahim','Laki-laki','Jakarta','2012-06-12','Jl.Cendrawasih 5 Rt.002/04','BANTEN','KOTA TANGERANG SELATAN','CIPUTAT','SAWAH BARU','MA',NULL,'SDI Al Ikhlas','Abu Darda','Siti Aminah','Karyawan Swasta','087799107735','diterima',2,6,'2026-09-25 22:30:20','2026-09-25 22:30:20'),(4,'123456','1234567892345678','Gilang R','Laki-laki','Jakarta','2013-02-26','Jl. Cendrawasih V Rt.001/02, Desa Sawah Baru, Kec. Ciputat, Kota. Tangerang Selatan, Provinsi Banten 15413','BANTEN','KOTA TANGERANG SELATAN','PAMULANG','KEDAUNG','Tsanawiyah (MTs / SMP)',NULL,'SDI Al Ikhlas','Sulaiman','Mariam','Karyawan Swasta','081789012345','diterima',NULL,NULL,'2026-09-25 23:22:38','2026-09-25 23:24:35'),(5,'1234554321','123456789987654','rizal uye','Laki-laki','Jakarta','2013-01-21','Jalan Cendrawasih 5\r\nBogor','JAWA BARAT','KABUPATEN BOGOR','CIOMAS','CIOMAS RAHAYU','Tahfidz Khusus',NULL,'SDI Al Ikhlas','safig','Yuli','Pedagang','08777776665','diterima',NULL,NULL,'2026-09-26 03:34:30','2026-09-26 03:35:42');
/*!40000 ALTER TABLE `santris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pemilik','admin','pendidik') NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Bapak Pemilik Yayasan','pemilik@pondok.com',NULL,'$2y$10$T0gMZNyhLBIMwFg0eVuXIeCoaiJ3epyqhl1WQehggPwdNQihVJD1q','pemilik',NULL,'2026-09-21 06:25:31','2026-09-21 08:13:35'),(5,'Deri Diantara','admin@pondok.com',NULL,'$2y$10$bT9ee1lOHhA4LnNF20DR9uZhorWFQqwih8Lut7AfG.p3usBNKLo0y','admin',NULL,'2026-09-21 06:25:31','2026-09-21 09:11:23'),(6,'Diyan Abdul Manan','pendidik@pondok.com',NULL,'$2y$10$QP6CtdC7pf1NMtybA.tKee3WuXZssvYBukgt0MPU2YkiBj7kNHi5S','pendidik',NULL,'2026-09-21 06:25:31','2026-09-21 09:10:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_contents`
--

DROP TABLE IF EXISTS `website_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('slide','photo','video') NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `media_url` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_contents`
--

LOCK TABLES `website_contents` WRITE;
/*!40000 ALTER TABLE `website_contents` DISABLE KEYS */;
INSERT INTO `website_contents` VALUES (1,'slide','Tumbuh dengan ilmu, berakar dalam adab.','Pondok pesantren modern','Ruang pendidikan yang menyiapkan generasi Qur\'ani, berprestasi, dan siap menghadapi masa depan.','https://images.unsplash.com/photo-1590073844006-33379778ae09?auto=format&fit=crop&w=1800&q=88',NULL,1,1,'2026-09-21 08:02:57','2026-09-21 08:02:57'),(2,'photo','Belajar bersama di kelas','Dokumentasi pondok','Aktivitas belajar santri.','https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=700&q=82',NULL,1,1,'2026-09-21 08:02:57','2026-09-21 08:02:57'),(3,'video','Kehidupan asrama yang hangat','Dokumentasi pondok','Cerita kegiatan santri.','https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg','https://www.youtube.com/watch?v=dQw4w9WgXcQ',1,1,'2026-09-21 08:02:57','2026-09-21 08:02:57');
/*!40000 ALTER TABLE `website_contents` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-20  0:25:18
