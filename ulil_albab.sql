-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ulil_albab
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
-- Current Database: `ulil_albab`
--

-- /* CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ulil_albab` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */; */

/* USE `ulil_albab`; */

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `jadwal_pelajarans`
--

DROP TABLE IF EXISTS `jadwal_pelajarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_pelajarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_mulai` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `mata_pelajaran` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL DEFAULT 'Ruang Kelas',
  `tahun_ajaran` varchar(255) NOT NULL DEFAULT '2026/2027',
  `semester` varchar(255) NOT NULL DEFAULT 'Ganjil',
  `kitab_referensi` varchar(255) DEFAULT NULL,
  `target_capaian` text DEFAULT NULL,
  `metode_pembelajaran` varchar(255) DEFAULT NULL,
  `silabus_ringkas` text DEFAULT NULL,
  `status_pelaksanaan` varchar(255) NOT NULL DEFAULT 'aktif',
  `jurnal_terakhir` text DEFAULT NULL,
  `jurnal_updated_at` timestamp NULL DEFAULT NULL,
  `catatan_supervisi` text DEFAULT NULL,
  `status_verifikasi` varchar(255) NOT NULL DEFAULT 'disetujui_mudir',
  `supervisi_by` bigint(20) unsigned DEFAULT NULL,
  `supervisi_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_pelajarans_user_id_foreign` (`user_id`),
  KEY `jadwal_pelajarans_supervisi_by_foreign` (`supervisi_by`),
  CONSTRAINT `jadwal_pelajarans_supervisi_by_foreign` FOREIGN KEY (`supervisi_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `jadwal_pelajarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_pelajarans`
--

LOCK TABLES `jadwal_pelajarans` WRITE;
/*!40000 ALTER TABLE `jadwal_pelajarans` DISABLE KEYS */;
INSERT INTO `jadwal_pelajarans` VALUES (1,2,'Senin','07:30','09:00','Tahfidzul Qur\'an & Tahsin Terpadu','VII-A MTs','Masjid Utama Lt. 1','2026/2027','Ganjil','Mushaf Al-Madinah & Matan Tuhfatul Athfal','Santri mampu menuntaskan setoran hafalan Juz 30 dengan makharijul huruf tepat dan hukum tajwid mutqin.','Talaqqi, Musyafahah, dan Tasmi\' berpasangan','Pekan 1-4: An-Naba s.d Al-Muthaffifin; Pekan 5-8: Al-Insyiqaq s.d Al-Balad; Pekan 9-14: Asy-Syams s.d An-Nas & Muroja\'ah kubro.','aktif','Alhamdulillah setoran hafalan QS. An-Naba ayat 1-20 tuntas dengan tajwid baik. Perlu penguatan mad wajib muttashil untuk 3 santri.','2026-09-29 06:03:21','Target hafalan berjalan sangat baik. Harap pertahankan ketelitian tajwid santri putra.','disetujui_mudir',3,'2026-09-29 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21'),(2,4,'Senin','09:30','11:00','Ilmu Nahwu Dasar','VII-A MTs','Kelas VII-A (Gedung Umar bin Khattab)','2026/2027','Ganjil','Matan Al-Jurumiyyah (Syaikh Ash-Shonhaji)','Santri memahami konsep kalam, pembagian isim-fi\'il-huruf, serta tanda-tanda I\'rob rofa\' (dhommah, wawu, alif, nun).','Bandongan, Sorogan Matan, dan Latihan I\'rob di papan tulis','Bab Kalam, Bab I\'rob, Bab Ma\'rifah \'Alamatil I\'rob, Bab Al-Af\'al (Madi, Mudhari, Amr), dan praktek bedah ayat.','aktif','Pembahasan Bab Al-Kalam dan tanda-tanda isim (tanwin, alif lam, huruf khofadh). Seluruh santri mencatat matan dengan rapi.','2026-09-28 06:03:21','Metode sorogan efektif. Tambahkan latihan soal terapan agar santri terbiasa membaca kitab kuning.','disetujui_mudir',3,'2026-09-28 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21'),(3,5,'Selasa','07:30','09:00','Fikih Ibadah Praktis','VIII-B MTs','Ruang Kelas VIII-B','2026/2027','Ganjil','Fathul Qorib Al-Mujib (Ibnu Qasim Al-Ghazi)','Penguasaan bab Thaharah (wudhu, tayamum, mandi wajib, najis) dan kaifiyat shalat fardhu & sunnah muakkad secara amaliyah.','Kajian Kitab Kuning, Diskusi Masa\'il, dan Praktik Ibadah di Masjid','Kitab Thaharah, Macam-macam Air, Najis & Cara Menyucikannya, Kaifiyat Shalat Berjamaah, Sujud Sahwi & Tilawah.','aktif','Praktik wudhu sempurna sesuai sunnah Rasulullah SAW di tempat wudhu asrama. Santri mempraktikkan satu per satu.','2026-09-27 06:03:21','Pendekatan amaliyah sudah sesuai kurikulum kepesantrenan. Dilanjutkan materi shalat jenazah.','disetujui_mudir',3,'2026-09-27 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21'),(4,2,'Selasa','09:30','11:00','Bahasa Arab (Muhadatsah & Durusul Lughah)','VIII-A MTs','Laboratorium Bahasa Arab','2026/2027','Ganjil','Durusul Lughah Al-\'Arabiyyah Juz 1 (Dr. V. Abdur Rahim)','Santri terbiasa berbicara bahasa Arab fush-ha sehari-hari di lingkungan asrama dan menguasai minimal 250 mufrodat tematik.','Direct Method (Thoriqoh Mubasyirah), Hiwar Interaktif, Roleplay Percakapan','Ad-Darsul Awwal s.d Ad-Darsul \'Asyir, simulasi percakapan di asrama, kelas, perpustakaan, dan kantin.','aktif','Hiwar tema \"Fi Gurfatil Julus wa Maktabah\". Santri mempraktikkan dialog berpasangan di depan kelas tanpa teks.','2026-09-28 06:03:21','Kreatif dan hidup. Pantau santri yang masih pasif dalam berbicara.','disetujui_mudir',3,'2026-09-29 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21'),(5,5,'Rabu','07:30','09:00','Hadits Nabawi & Akhlaq','IX MTs','Aula Utama Abu Bakar','2026/2027','Ganjil','Al-Arba\'un An-Nawawiyyah & Taisirul Khalaq','Hafalan 20 Hadits Arba\'in beserta syarah ringkas serta implementasi adab penuntut ilmu dalam kehidupan asrama.','Hafalan Sanad & Matan, Syarah Hadits, Studi Kasus Akhlaq Santri','Hadits 1 (Innamal a\'malu binniyat) s.d Hadits 20 (Al-Haya\'u minal iman), pembacaan biografi perawi hadits.','aktif','Pengkajian Hadits Ke-2 (Hadits Jibril tentang Islam, Iman, dan Ihsan). Seluruh santri menyetorkan hafalan matan.','2026-09-26 06:03:21','Target hafalan hadits sesuai rencana kerja. Bagus.','disetujui_mudir',3,'2026-09-27 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21'),(6,4,'Kamis','07:30','09:00','Sharaf & Tashrif Lughawi / Istilahi','X MA Unggulan','Ruang X-Aliyah 1','2026/2027','Ganjil','Al-Amtsilah At-Tashrifiyyah (KH. Ma\'shum Ali)','Menguasai wazan Tsulatsi Mujarrad (Bab 1 s.d 6) beserta shighat bina\' (Shohih, Misal, Ajwaf, Naqish, Lafif, Mudho\'af).','Drill Tashrif Irama, Pembagian Tabel Morfologi Arab, Kuis Cepat','Wazan Fa\'ala-Yaf\'ulu s.d Fa\'ula-Yaf\'ulu, Tashrif Istilahi 22 shighat, dan Tashrif Lughawi 14 dhomir.','aktif','Drill Tashrif Bab 1 Fa\'ala Yaf\'ulu Nashoro Yanshuru. Santri mampu melafalkan dengan irama pesantren serentak.','2026-09-27 06:03:21','Pertahankan kedisiplinan hafalan tashrif. Ini pondasi utama membaca kitab kuning.','disetujui_mudir',3,'2026-09-28 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21'),(7,2,'Sabtu','08:00','10:00','Takhasus Tahfidz Al-Qur\'an 30 Juz','Takhasus Tahfidz Aliyah','Saung Tahfidz Putri & Selasar Masjid','2026/2027','Ganjil','Mushaf Al-Qur\'an Rasm Utsmani','Sabaq (hafalan baru) 1 halaman/hari, Sabqi (hafalan kemarin) 5 halaman, dan Manzil (muroja\'ah berkala) 1 juz/hari.','Sistem Mudarosah & Tasmi\' bil Ghoib','Target capaian minimal 5 Juz baru dalam 1 semester dan kelulusan tasmi\' 5 Juz sekali duduk.','aktif','Ujian tasmi\' 3 santriwati tuntas 2 juz sekali duduk. Hasil sangat memuaskan, nilai rata-rata 92.','2026-09-30 06:03:21','Luar biasa capaian takhasus tahfidz. Mohon dipersiapkan untuk seleksi MTQ tingkat Kabupaten.','disetujui_mudir',3,'2026-09-30 06:03:21','2026-09-30 06:03:21','2026-09-30 06:03:21');
/*!40000 ALTER TABLE `jadwal_pelajarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kegiatans`
--

DROP TABLE IF EXISTS `kegiatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kegiatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatans`
--

LOCK TABLES `kegiatans` WRITE;
/*!40000 ALTER TABLE `kegiatans` DISABLE KEYS */;
INSERT INTO `kegiatans` VALUES (1,'Wisuda Tahfidzul Qur\'an & Ujian Tasmi\' 30 Juz','tahfidz','2026-10-02','Masjid Jami\' Li Ulil Albab','kegiatan/kegiatan_1790941608_2ba2d1e0.jpg','Sebanyak 75 santri putra dan putri berhasil menuntaskan ujian tasmi\' Al-Qur\'an 30 juz bil-ghaib sekali duduk dan menerima sanad qira\'ah dari tim masyayikh. Seluruh wisudawan telah melalui ujian tasmi\' bil-ghaib di hadapan dewan juri bersanad internasional. Momentum haru terjadi saat para santri menyematkan mahkota kemuliaan kepada kedua orang tua mereka.','2026-09-30 05:21:23','2026-10-02 04:46:48'),(2,'Kajian Kitab Fathul Qorib & Ihya\' Ulumuddin','tahfidz','2026-05-22','Selasar Utama Asrama','https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80','Pembacaan dan bedah kaidah fiqih madzhab Syafi\'i secara bandongan dan sorogan yang dipimpin langsung oleh Mudir Pesantren KH. Dr. Abdullah Syukri, M.Ag. Kegiatan kajian kitab kuning merupakan urat nadi pendidikan salafiyah di Pondok Pesantren Li Ulil Albab.','2026-09-30 05:21:23','2026-09-30 08:27:55'),(3,'Muhadharah Kubro & Debat Tiga Bahasa','ekskul','2026-05-27','Gedung Auditorium','https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80','Asah kepemimpinan santri dalam berorasi ilmiah menggunakan bahasa Arab, Inggris, dan Indonesia di hadapan ratusan santri dan dewan asatidz. Santri dilatih berfikir kritis dan menyampaikan gagasan secara terstruktur di podium publik.','2026-09-30 05:21:23','2026-09-30 05:21:23'),(4,'Malam Gema Shalawat & Tabligh Akbar','phbi','2026-06-01','Lapangan Hijau Kampus','https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=800&q=80','Lantunan qashidah shalawat Simtudduror dan Burdah bersama grup hadrah santri, dilanjutkan tausiyah kebangsaan oleh ulama tamu dari Tarim Yaman. Ribuan jamaah santri dan wali santri larut dalam kekhusyukan malam cinta Rasulullah SAW.','2026-09-30 05:21:23','2026-09-30 05:21:23'),(5,'Santri Tech Expo: Coding & Robotika MTs-MA','ekskul','2026-06-05','Lab Sains & Komputer','kegiatan/kegiatan_1790788987_c4927d24.jpeg','Pameran inovasi teknologi santri, meliputi website manajemen zakat, sensor IoT penyiram tanaman hidroponik pesantren, dan aplikasi tajwid interaktif karya santri generasi milenial.','2026-09-30 05:21:23','2026-09-30 10:23:07'),(6,'Bakti Sosial & Layanan Kesehatan Masyarakat','sosial','2026-06-08','Desa Binaan Pesantren','kegiatan/kegiatan_1790788439_f33232e3.jpeg','Santri relawan Pos Kesehatan Pesantren (Poskestren) menyalurkan 500 paket sembako dan mengadakan pemeriksaan tensi dan kesehatan gratis bagi lansia dan dhuafa di lingkungan sekitar pondok.','2026-09-30 05:21:23','2026-09-30 10:13:59');
/*!40000 ALTER TABLE `kegiatans` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_28_121418_create_santris_table',1),(5,'2026_09_28_153000_add_role_to_users_table',1),(6,'2026_09_30_121932_create_ppdb_registrations_table',2),(7,'2026_09_30_121933_create_kegiatans_table',2),(8,'2026_09_30_121934_create_videos_table',2),(9,'2026_09_30_130142_create_ppdb_settings_table',3),(10,'2026_09_30_130149_create_jadwal_pelajarans_table',3),(11,'2026_09_30_154422_add_logo_to_ppdb_settings_table',4),(12,'2026_09_30_164119_add_video_file_to_videos_table',5),(13,'2026_10_02_152441_add_profil_visi_misi_struktur_to_ppdb_settings_table',6),(14,'2026_10_02_154327_add_photos_to_ppdb_settings_table',7),(15,'2026_10_07_062806_add_columns_to_users_table',8),(16,'2026_10_07_062813_add_columns_to_santris_table',8),(17,'2026_10_07_062825_create_pembayarans_table',8),(18,'2026_10_08_110143_add_pilar_keunggulan_to_ppdb_settings_table',9),(19,'2026_10_08_114536_create_ppdb_soals_and_exam_results_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayarans`
--

DROP TABLE IF EXISTS `pembayarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) NOT NULL,
  `santri_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `kategori_pembayaran` varchar(255) NOT NULL,
  `bulan_dibayar` varchar(255) DEFAULT NULL,
  `tahun_dibayar` varchar(255) DEFAULT NULL,
  `jumlah` decimal(14,2) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL DEFAULT 'Tunai',
  `status` varchar(255) NOT NULL DEFAULT 'Lunas',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pembayarans_kode_transaksi_unique` (`kode_transaksi`),
  KEY `pembayarans_santri_id_foreign` (`santri_id`),
  KEY `pembayarans_user_id_foreign` (`user_id`),
  CONSTRAINT `pembayarans_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santris` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayarans`
--

LOCK TABLES `pembayarans` WRITE;
/*!40000 ALTER TABLE `pembayarans` DISABLE KEYS */;
INSERT INTO `pembayarans` VALUES (1,'TRX-202610-0001',1,1,'Syahriah / SPP Bulanan','Oktober','2026',350000.00,'2026-10-01','Tunai','Lunas',NULL,'Pembayaran SPP Syahriah bulan Oktober 2026 lunas di loket TU.','2026-10-06 23:40:44','2026-10-06 23:40:44'),(2,'TRX-202610-0002',2,1,'Uang Gedung / Pangkal',NULL,'2026/2027',2500000.00,'2026-10-02','Transfer Bank','Lunas',NULL,'Cicilan uang pangkal gedung tahun pertama via Bank Syariah.','2026-10-06 23:40:44','2026-10-06 23:40:44'),(3,'TRX-202610-0003',3,1,'Kitab & Modul Pelajaran',NULL,'2026/2027',450000.00,'2026-10-03','QRIS','Lunas',NULL,'Paket kitab kuning dan modul pembelajaran semester ganjil.','2026-10-06 23:40:44','2026-10-06 23:40:44');
/*!40000 ALTER TABLE `pembayarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppdb_exam_results`
--

DROP TABLE IF EXISTS `ppdb_exam_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppdb_exam_results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ppdb_registration_id` bigint(20) unsigned NOT NULL,
  `no_pendaftaran` varchar(255) NOT NULL,
  `nama_santri` varchar(255) NOT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `total_soal` int(11) NOT NULL DEFAULT 50,
  `jawaban_benar` int(11) NOT NULL DEFAULT 0,
  `jawaban_salah` int(11) NOT NULL DEFAULT 0,
  `jawaban_kosong` int(11) NOT NULL DEFAULT 0,
  `nilai` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status_kelulusan` varchar(50) NOT NULL DEFAULT 'Menunggu Penilaian',
  `catatan_admin` text DEFAULT NULL,
  `dinilai_oleh` bigint(20) unsigned DEFAULT NULL,
  `detail_jawaban` longtext DEFAULT NULL,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `durasi_menit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ppdb_exam_results_ppdb_registration_id_foreign` (`ppdb_registration_id`),
  KEY `ppdb_exam_results_dinilai_oleh_foreign` (`dinilai_oleh`),
  KEY `ppdb_exam_results_no_pendaftaran_index` (`no_pendaftaran`),
  CONSTRAINT `ppdb_exam_results_dinilai_oleh_foreign` FOREIGN KEY (`dinilai_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ppdb_exam_results_ppdb_registration_id_foreign` FOREIGN KEY (`ppdb_registration_id`) REFERENCES `ppdb_registrations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb_exam_results`
--

LOCK TABLES `ppdb_exam_results` WRITE;
/*!40000 ALTER TABLE `ppdb_exam_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `ppdb_exam_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppdb_registrations`
--

DROP TABLE IF EXISTS `ppdb_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppdb_registrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_pendaftaran` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) NOT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `no_wa` varchar(255) NOT NULL,
  `pekerjaan_wali` varchar(255) DEFAULT NULL,
  `pendidikan_wali` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `jalur` varchar(255) NOT NULL DEFAULT 'Reguler',
  `model_ujian` varchar(255) NOT NULL DEFAULT 'Tatap Muka di Pesantren',
  `catatan_prestasi` varchar(255) DEFAULT NULL,
  `jadwal_ujian` varchar(255) DEFAULT NULL,
  `ruang_ujian` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu Ujian',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppdb_registrations_no_pendaftaran_unique` (`no_pendaftaran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb_registrations`
--

LOCK TABLES `ppdb_registrations` WRITE;
/*!40000 ALTER TABLE `ppdb_registrations` DISABLE KEYS */;
INSERT INTO `ppdb_registrations` VALUES (1,'PPDB-2026-5602','Muhamad Fajri','Laki-laki','Lampung','2009-06-02','2410113548','MTs Al Falah','Madrasah Aliyah (MA Unggulan IPA/Agama)','Samsudin','087754234567','Karyawan Swasta','Sarjana (S1)','Jl. Bungur Rt.004/005, Pondok Terong Ciledug, Tangerang','Reguler','Tatap Muka di Pesantren','Juz 30','Sabtu & Minggu, 13 - 14 Juni 2027 (08.00 - 11.30 WIB)','Gedung Rektorat Lt. 2 (Ruang Al-Fatih) & Online','Menunggu Ujian','2026-10-08 04:24:40','2026-10-08 04:24:40');
/*!40000 ALTER TABLE `ppdb_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppdb_settings`
--

DROP TABLE IF EXISTS `ppdb_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppdb_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pesantren` varchar(255) NOT NULL DEFAULT 'Pondok Pesantren Ulil Albab',
  `logo` varchar(255) DEFAULT NULL,
  `tagline_pesantren` varchar(255) NOT NULL DEFAULT 'Pendidikan Islam Modern Berbasis Tahfidzul Qur''an & Bahasa Internasional',
  `telepon` varchar(255) NOT NULL DEFAULT '(+62) 877-9910-7735',
  `email` varchar(255) NOT NULL DEFAULT 'ppdb@ulilalbab.ac.id',
  `alamat` varchar(255) NOT NULL DEFAULT 'Jl. Pesantren Modern No. 99, Ulil Albab Center',
  `status_ppdb` varchar(255) NOT NULL DEFAULT 'buka',
  `tahun_ajaran` varchar(255) NOT NULL DEFAULT '2026/2027',
  `gelombang_aktif` varchar(255) NOT NULL DEFAULT 'Gelombang I (Jalur Prestasi Tahfidz & Reguler)',
  `kuota_penerimaan` int(11) NOT NULL DEFAULT 350,
  `biaya_pendaftaran` varchar(255) NOT NULL DEFAULT 'Rp 250.000',
  `tanggal_buka_pendaftaran` varchar(255) NOT NULL DEFAULT '01 Januari 2026',
  `tanggal_tutup_pendaftaran` varchar(255) NOT NULL DEFAULT '30 Mei 2026',
  `tanggal_ujian_seleksi` varchar(255) NOT NULL DEFAULT 'Sabtu & Minggu, 13 - 14 Juni 2026',
  `tanggal_pengumuman` varchar(255) NOT NULL DEFAULT '20 Juni 2026',
  `tanggal_daftar_ulang` varchar(255) NOT NULL DEFAULT '25 Juni - 05 Juli 2026',
  `jam_ujian` varchar(255) NOT NULL DEFAULT '08.00 - 11.30 WIB',
  `lokasi_ujian` varchar(255) NOT NULL DEFAULT 'Gedung Rektorat Lt. 2 (Ruang Al-Fatih) & Online',
  `persyaratan_santri` longtext DEFAULT NULL,
  `berkas_wajib` longtext DEFAULT NULL,
  `materi_ujian` longtext DEFAULT NULL,
  `alur_pendaftaran` longtext DEFAULT NULL,
  `biaya_rincian` longtext DEFAULT NULL,
  `pengumuman_banner` text DEFAULT NULL,
  `link_brosur` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sambutan_pengasuh_nama` varchar(255) DEFAULT NULL,
  `sambutan_pengasuh_jabatan` varchar(255) DEFAULT NULL,
  `sambutan_pengasuh_quote` varchar(255) DEFAULT NULL,
  `sambutan_pengasuh_teks` longtext DEFAULT NULL,
  `sambutan_pengasuh_foto` varchar(255) DEFAULT NULL,
  `sejarah_singkat` longtext DEFAULT NULL,
  `sejarah_foto` varchar(255) DEFAULT NULL,
  `filosofi_nama` longtext DEFAULT NULL,
  `pilar_keunggulan_judul` varchar(255) DEFAULT NULL,
  `pilar_keunggulan_deskripsi` text DEFAULT NULL,
  `pilar_keunggulan` longtext DEFAULT NULL,
  `sarana_prasarana` longtext DEFAULT NULL,
  `visi_pesantren` longtext DEFAULT NULL,
  `misi_pesantren` longtext DEFAULT NULL,
  `motto_pesantren` varchar(255) DEFAULT NULL,
  `standar_kelulusan` longtext DEFAULT NULL,
  `visi_misi_foto` varchar(255) DEFAULT NULL,
  `struktur_organisasi` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb_settings`
--

LOCK TABLES `ppdb_settings` WRITE;
/*!40000 ALTER TABLE `ppdb_settings` DISABLE KEYS */;
INSERT INTO `ppdb_settings` VALUES (1,'Pondok Pesantren Li Ulil Albab','logo_pesantren_1790788398_7f0eb2b0.png','Pendidikan Islam Modern Berbasis Tahfidzul Qur\'an & Bahasa Internasional','(+62) 877-9910-7735','ppdb@ulilalbab.ac.id','Jl. Raya Munjul Km.03 Kp. Sukapalas, Ds.Ciherang, Kec.Picung - Pandeglang, Banten 42275','buka','2026/2027','Gelombang I (Jalur Prestasi Tahfidz & Reguler)',300,'Rp 150.000','01 Januari 2027','30 Mei 2027','Sabtu & Minggu, 13 - 14 Juni 2027','20 Juni 2027','25 Juni - 05 Juli 2027','08.00 - 11.30 WIB','Gedung Rektorat Lt. 2 (Ruang Al-Fatih) & Online','Beragama Islam serta memiliki akhlaq dan kepribadian yang santun.\r\nTamat SD/MI untuk jenjang MTs Terpadu, atau Tamat SMP/MTs untuk jenjang MA Unggulan / Takhasus Tahfidz.\r\nSanggup mukim di asrama pesantren selama masa pendidikan berlangsung.\r\nBersedia mematuhi disiplin dan tata tertib yang ditetapkan pimpinan pondok dan dewan pengasuh.\r\nSehat jasmani dan rohani, bebas dari penyakit menular kronis (dibuktikan surat dokter).','Cetak Kartu Ujian Masuk PPDB yang diperoleh setelah mengisi formulir online di website ini.\r\nFotokopi Akta Kelahiran calon santri (2 lembar).\r\nFotokopi Kartu Keluarga (KK) dan KTP kedua Orang Tua / Wali (2 lembar).\r\nFotokopi Rapor 2 semester terakhir yang dilegalisir kepala sekolah asal.\r\nPasfoto Berwarna 3x4 terbaru (4 lembar, latar biru/merah, berbusana muslim rapi).\r\nPiagam / Sertifikat Prestasi (wajib bagi pendaftar Jalur Beasiswa Tahfidz min. 3 Juz).','[{\"judul\":\"Baca Tulis Al-Qur\'an (BTQ)\",\"deskripsi\":\"Kelancaran membaca mushaf, penguasaan hukum tajwid (nun mati, mad, waqaf), dan tes imla\' \\/ menulis ayat.\",\"icon\":\"bi-book-half\",\"color\":\"text-success\"},{\"judul\":\"Hafalan Surat Pilihan\",\"deskripsi\":\"Tes hafalan Juz 30 (Surat An-Naba s.d An-Nas). Bagi jalur beasiswa tahfidz diuji sesuai target juz yang diajukan.\",\"icon\":\"bi-bookmark-star-fill\",\"color\":\"text-warning\"},{\"judul\":\"Tes Potensi Akademik\",\"deskripsi\":\"Matematika dasar, pemahaman nalar bahasa, pengetahuan agama Islam dasar (Fikih Thaharah, Shalat, Akhlaq).\",\"icon\":\"bi-mortarboard\",\"color\":\"text-primary\"},{\"judul\":\"Wawancara Santri & Wali\",\"deskripsi\":\"Penggalian motivasi belajar mondok, kesiapan kemandirian di asrama, serta komitmen kesepakatan wali santri.\",\"icon\":\"bi-people-fill\",\"color\":\"text-danger\"}]','[{\"step\":\"1\",\"judul\":\"Pengisian Formulir Online\",\"deskripsi\":\"Isi data calon santri dan wali melalui formulir pendaftaran di website resmi SIMPONPES.\"},{\"step\":\"2\",\"judul\":\"Cetak Kartu Ujian\",\"deskripsi\":\"Sistem langsung menerbitkan Nomor Registrasi dan Kartu Peserta Ujian Masuk resmi siap cetak PDF.\"},{\"step\":\"3\",\"judul\":\"Pelaksanaan Ujian Seleksi\",\"deskripsi\":\"Mengikuti ujian seleksi Al-Qur\'an, akademik, dan wawancara santri & wali sesuai jadwal.\"},{\"step\":\"4\",\"judul\":\"Pengumuman Kelulusan\",\"deskripsi\":\"Hasil kelulusan diumumkan melalui portal website dan notifikasi resmi WhatsApp panitia PPDB.\"},{\"step\":\"5\",\"judul\":\"Daftar Ulang & Orientasi\",\"deskripsi\":\"Penyelesaian administrasi, fitting seragam, pembagian kamar asrama, dan ta\'aruf santri baru.\"}]',NULL,'Pendaftaran Santri Baru Tahun Ajaran 2026/2027 Resmi Dibuka! Segera amankan kuota pendaftaran putra-putri Anda sebelum batas akhir penutupan gelombang.',NULL,'2026-09-30 06:03:20','2026-10-04 08:02:33','KH. Nahrul Badri S.Q.MA','Pengasuh & Mudir \'Aam','Membina Generasi yang Hafal Al-Qur\'an, Berwawasan Luas, dan Berakhlak Mulia.','Pondok Pesantren Modern Li Ulil Albab berikhtiar mendidik para santri dengan memadukan kedalaman ilmu-ilmu turats salafiyah, kemurnian hafalan Al-Qur\'an 30 juz mutqin, serta penguasaan sains, teknologi informasi, dan bahasa internasional. Kami mendidik dengan hati, keteladanan, dan disiplin kasih sayang 24 jam di asrama.',NULL,'Pondok Pesantren Modern Li Ulil Albab didirikan pada tahun 2012 atas inisiasi KH. Dr. Abdullah Syukri, M.Ag bersama para alim ulama dan tokoh masyarakat. Bermula dari halaqah tahfidz Al-Qur\'an dengan belasan santri, kini pesantren telah berkembang menjadi kompleks pendidikan terpadu di atas lahan wakaf seluas 4,5 hektar dengan jenjang formal MTs Terpadu, MA Unggulan, dan Takhasus Tahfidzul Qur\'an 30 Juz Bersanad.',NULL,'Nama Li Ulil Albab diambil dari terminologi Qur\'ani yang menggambarkan insan paripurna: generasi yang senantiasa menyeimbangkan antara dzikrullah (hubungan ruhani yang kokoh dengan Sang Pencipta) dan fikr (analisis ilmiah, kecerdasan nalar, serta kesadaran sosial yang tajam).',NULL,NULL,NULL,'Masjid Jami\' 2 Lantai (Kapasitas 1.500 Jamaah)\r\nAsrama Representatif Putra & Putri Terpisah\r\nRuang Kelas Multimedia Ber-AC\r\nLaboratorium IT & Sains Komputer Terpadu\r\nMaktabah Digital & Perpustakaan Kitab Salaf\r\nKlinik Poskestren 24 Jam & Dokter Jaga','Menjadi Pondok Pesantren Modern Unggulan Berstandar Nasional dan Internasional yang Melahirkan Generasi Ulil Albab: Berakhlak Qur\'ani, Hafidz 30 Juz, Unggul dalam Ilmu Pengetahuan, Berkarakter Mandiri, dan Berwawasan Global.','Tarbiyah Qur\'aniyah Mutqin: Menyelenggarakan program Tahfidzul Qur\'an 30 Juz secara terstruktur dengan bimbingan sanad muttashil, tajwid tahsin standar, dan pengamalan adab-adab Al-Qur\'an.\r\nTafaqquh Fiddin & Turats: Mengintegrasikan kurikulum kajian kitab kuning ulama salaf dengan kurikulum sains modern kementerian agama secara seimbang dan harmonis.\r\nPenguasaan Bahasa Internasional: Membudayakan penguasaan aktif bahasa Arab dan bahasa Inggris dalam interaksi harian, literasi keilmuan, dan komunikasi global.\r\nPembentukan Karakter Mandiri & Kepemimpinan: Menumbuhkan kedisiplinan, kemandirian asrama 24 jam, kejujuran, etos kerja, serta kepemimpinan santri melalui wadah organisasi santri (OPLU).\r\nPengabdian Masyarakat & Kewirausahaan: Mencetak santri yang memiliki kepekaan sosial tinggi, berjiwa entrepreneurship, dan siap mengabdi untuk kemaslahatan umat, bangsa, dan agama.','Berilmu Amaliah, Beramal Ilmiah, & Berakhlakul Karimah','Tahfidz: Hafal 10 - 30 Juz Al-Qur\'an bersanad muttashil dengan predikat mutqin.\r\nTurats: Mampu membaca dan memahami kitab kuning dasar (Safinah, Taqrib, Jurumiyyah).\r\nBahasa: Aktif berkomunikasi dalam bahasa Arab dan Inggris dengan skor TOAFL/TOEFL kompetitif.\r\nAkademik: Lulus 100% dan siap menembus PTN unggulan, PTKIN (UIN), serta universitas Timur Tengah (Al-Azhar, Yaman).',NULL,'{\"puncak\":{\"nama\":\"KH. Nahrul Badri SQ. MA\",\"jabatan\":\"Pengasuh & Mudir \'Aam Pesantren\",\"badge\":\"PIMPINAN PUNCAK\",\"deskripsi\":\"Penanggung jawab umum seluruh kebijakan arah tarbiyah, akidah, kelembagaan, dan kurikulum Pondok Pesantren Modern Li Ulil Albab.\",\"foto\":null},\"bph\":[{\"nama\":\"Hj. Lely Lathifah, SQ, S.Ag\",\"jabatan\":\"Wakil Mudir Bidang Tarbiyah\",\"deskripsi\":\"Mengkoordinir pengembangan kurikulum terpadu salaf-modern, evaluasi belajar santri, dan supervisi dewan guru.\",\"icon\":\"bi-mortarboard-fill\",\"color\":\"primary\",\"foto\":null},{\"nama\":\"Ustadzah Sri Wahyuni S.pd\",\"jabatan\":\"Sekretaris Yayasan\",\"deskripsi\":\"Mengelola tata usaha kelembagaan, perizinan, sistem informasi manajemen SIMPONPES, dan media center publik.\",\"icon\":\"bi-laptop-fill\",\"color\":\"info\",\"foto\":null},{\"nama\":\"Hj. Lely Lathifah SQ, S.Ag\",\"jabatan\":\"Bendahara Umum Yayasan\",\"deskripsi\":\"Penanggung jawab tata kelola administrasi keuangan pesantren, dana operasional santri, dan akuntabilitas anggaran.\",\"icon\":\"bi-cash-coin\",\"color\":\"warning\",\"foto\":null}],\"divisi\":[{\"nama\":\"KH. Nahrul Badri SQ, MA\",\"jabatan\":\"Kepala Bidang Tahfidzul Qur\'an\",\"deskripsi\":\"Sanad Hafalan 30 Juz, pembimbingan halaqah tahfidz mutqin dan karantina tasmi\'.\",\"icon\":\"bi-book-half\",\"color\":\"success\",\"foto\":null},{\"nama\":\"Hj. Lely Lathifah SQ. S.Ag\",\"jabatan\":\"Kepala Sekolah Madrasah Tsanawiyah\",\"deskripsi\":\"Pengelola kurikulum formal MTs & MA Kemenag, ujian nasional, dan akreditasi madrasah.\",\"icon\":\"bi-mortarboard\",\"color\":\"primary\",\"foto\":null},{\"nama\":\"Ustadz Saprudin S.Pd\",\"jabatan\":\"Kepala Sekolah Madrasah Aliyah\",\"deskripsi\":\"Pembina disiplin asrama santri putra, kepemimpinan organisasi, dan kegiatan ekstrakurikuler.\",\"icon\":\"bi-shield-check\",\"color\":\"info\",\"foto\":null},{\"nama\":\"Ustadz Ahmad Rifa\'i\",\"jabatan\":\"Kepala Bidang Kesantrian Putra\",\"deskripsi\":\"Pembina ketertiban asrama putri, kepribadian muslimah, dan pembinaan ruhiyah santriwati.\",\"icon\":\"bi-heart-pulse-fill\",\"color\":\"danger\",\"foto\":null}]}');
/*!40000 ALTER TABLE `ppdb_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ppdb_soals`
--

DROP TABLE IF EXISTS `ppdb_soals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ppdb_soals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_urut` int(11) NOT NULL DEFAULT 1,
  `kategori` varchar(100) NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi_a` text NOT NULL,
  `opsi_b` text NOT NULL,
  `opsi_c` text NOT NULL,
  `opsi_d` text NOT NULL,
  `kunci_jawaban` varchar(5) NOT NULL,
  `bobot` int(11) NOT NULL DEFAULT 2,
  `penjelasan` text DEFAULT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppdb_soals`
--

LOCK TABLES `ppdb_soals` WRITE;
/*!40000 ALTER TABLE `ppdb_soals` DISABLE KEYS */;
INSERT INTO `ppdb_soals` VALUES (1,1,'PAI & Fiqih Islam','Rukun Islam yang ketiga setelah mengucap dua kalimat syahadat dan mendirikan shalat adalah...','Menunaikan ibadah haji ke Baitullah','Menunaikan zakat','Berpuasa di bulan Ramadhan','Menuntut ilmu setinggi-tingginya','B',2,'Urutan rukun Islam adalah: 1. Syahadat, 2. Shalat, 3. Zakat, 4. Puasa Ramadhan, 5. Haji bagi yang mampu.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(2,2,'PAI & Fiqih Islam','Najis yang cara membersihkannya cukup dengan memercikkan air bersih ke bagian yang terkena najis dinamakan najis...','Mughalladhah (berat)','Mutawassithah (sedang)','Mukhaffafah (ringan)','Hukmiyyah','C',2,'Najis Mukhaffafah adalah najis ringan, contohnya air seni bayi laki-laki yang belum makan selain ASI dan belum berumur 2 tahun.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(3,3,'PAI & Fiqih Islam','Shalat fardhu yang jumlah rakaatnya dapat di-qashar (diringkas) menjadi 2 rakaat saat bepergian jauh (safar) adalah...','Subuh, Dzuhur, dan Ashar','Dzuhur, Ashar, dan Isya','Maghrib dan Isya','Semua shalat lima waktu','B',2,'Shalat yang boleh di-qashar hanya shalat fardhu yang berjumlah 4 rakaat, yaitu Dzuhur, Ashar, dan Isya menjadi masing-masing 2 rakaat.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(4,4,'PAI & Fiqih Islam','Sikap terpuji yang senantiasa menahan diri dari keluh kesah dan ridho atas segala ketetapan takdir Allah SWT disebut...','Qana\'ah','Tawadhu\'','Sabar','Amanah','C',2,'Sabar adalah menahan diri dari amarah, keluh kesah, serta tabah menjalankan perintah dan menjauhi larangan Allah.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(5,5,'PAI & Fiqih Islam','Malaikat yang memiliki tugas mulia mencatat segala amal kebaikan perbuatan manusia adalah...','Malaikat Raqib','Malaikat Atid','Malaikat Jibril','Malaikat Mikail','A',2,'Malaikat Raqib mencatat amal kebaikan, sedangkan Malaikat Atid mencatat perbuatan buruk manusia.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(6,6,'PAI & Fiqih Islam','Nabi dan Rasul yang bergelar \"Ulul Azmi\" karena keteguhan dan kesabarannya yang luar biasa berjumlah...','3 orang Nabi','4 orang Nabi','5 orang Nabi','10 orang Nabi','C',2,'Ada 5 Rasul Ulul Azmi (NIMMI): Nabi Nuh AS, Ibrahim AS, Musa AS, Isa AS, dan Muhammad SAW.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(7,7,'PAI & Fiqih Islam','Peristiwa luar biasa hijrahnya Nabi Muhammad SAW dari Mekkah ke Madinah dijadikan sebagai permulaan penanggalan kalender...','Masehi (Miladiyah)','Hijriyah (Qamariyah)','Syamsiyah','Jawa Kuno','B',2,'Khalifah Umar bin Khattab menetapkan momentum hijrah Rasulullah SAW sebagai awal tahun baru kalender Hijriyah.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(8,8,'PAI & Fiqih Islam','Sahabat Nabi yang dijuluki \"Al-Faruq\" (pembeda antara yang haq dan yang bathil) adalah...','Abu Bakar Ash-Shiddiq RA','Umar bin Khattab RA','Utsman bin Affan RA','Ali bin Abi Thalib RA','B',2,'Umar bin Khattab RA diberi gelar Al-Faruq oleh Rasulullah SAW karena ketegasannya membedakan kebenaran dan kebathilan.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(9,9,'PAI & Fiqih Islam','Zakat yang wajib dikeluarkan oleh setiap jiwa muslim menjelang shalat Idul Fitri untuk mensucikan diri disebut zakat...','Zakat Mal (Harta)','Zakat Fitrah','Zakat Perniagaan','Zakat Pertanian','B',2,'Zakat fitrah diwajibkan kepada setiap jiwa muslim pada bulan Ramadhan sebelum shalat Idul Fitri.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(10,10,'PAI & Fiqih Islam','Kitab suci Injil diturunkan oleh Allah SWT kepada Rasul-Nya, yaitu Nabi...','Nabi Daud AS','Nabi Musa AS','Nabi Isa AS','Nabi Ibrahim AS','C',2,'Zabur untuk Nabi Daud AS, Taurat untuk Nabi Musa AS, Injil untuk Nabi Isa AS, dan Al-Qur\'an untuk Nabi Muhammad SAW.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(11,11,'Tajwid & Bahasa Arab','Apabila terdapat nun mati (نْ) atau tanwin bertemu dengan huruf Ba (ب), maka hukum bacaannya adalah...','Idzhar Halqi','Ikhfa\' Haqiqi','Iqlab','Idgham Bighunnah','C',2,'Iqlab terjadi jika nun mati atau tanwin bertemu huruf ba (ب), bunyinya ditukar menjadi mim (م) disertai dengung.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(12,12,'Tajwid & Bahasa Arab','Hukum bacaan Idgham Bighunnah terjadi apabila nun sukun atau tanwin bertemu dengan salah satu dari 4 huruf berikut...','ي , ن , م , و (Ya, Nun, Mim, Wawu)','ل , ر (Lam, Ra)','ء , هـ , ع , غ (Hamzah, Ha, Ain, Ghain)','ق , ط , ب , ج , د','A',2,'Huruf Idgham Bighunnah disingkat Ya-Nu-Mi-Wa (Yanmu) yaitu ي, ن, م, و.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(13,13,'Tajwid & Bahasa Arab','Huruf-huruf qalqalah (bacaan memantul saat berharakat sukun atau waqaf) terangkum dalam singkatan...','Baju di toko (ب , ج , د , ت , ك)','Quthbu Jadin (ق , ط , ب , ج , د)','Khuruf halq (خ , ر , ف , ح , ل)','Yanmu (ي , ن , م , و)','B',2,'Huruf qalqalah ada lima: Qa (ق), Tha (ط), Ba (ب), Jim (ج), Dal (د), diringkas Quth-bu Ja-din.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(14,14,'Tajwid & Bahasa Arab','Panjang bacaan Mad Thabi\'i (Mad Asli) dalam kaidah ilmu tajwid dibaca sepanjang...','1 harakat','2 harakat (1 alif)','4 harakat','6 harakat (3 alif)','B',2,'Mad Thabi\'i dibaca panjang 2 harakat atau setara 1 alif.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(15,15,'Tajwid & Bahasa Arab','Apa arti dari kosakata bahasa Arab \"مَدْرَسَةٌ\" (Madrasatun)?','Rumah sakit','Sekolah / Tempat belajar','Perpustakaan','Kamar asrama','B',2,'Madrasatun (مَدْرَسَةٌ) bermakna sekolah atau tempat proses belajar mengajar.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(16,16,'Tajwid & Bahasa Arab','Kata ganti orang pertama tunggal (\"Saya\") dalam bahasa Arab adalah...','أَنْتَ (Anta)','هُوَ (Huwa)','أَنَا (Ana)','نَحْنُ (Nahnu)','C',2,'Ana (أَنَا) berarti Saya, Anta (Kamu laki-laki), Huwa (Dia laki-laki), Nahnu (Kami/Kita).',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(17,17,'Tajwid & Bahasa Arab','Jawaban yang tepat untuk sapaan ucapan selamat pagi \"صَبَاحَ الْخَيْرِ\" (Shobahal khair) adalah...','مَسَاءَ الْخَيْرِ (Masa\'al khair)','صَبَاحَ النُّوْرِ (Shobahan nur)','أَهْلًا وَسَهْلًا (Ahlan wa sahlan)','مَعَ السَّلَامَةِ (Ma\'as salamah)','B',2,'Jawaban atas Shobahal khair (Selamat pagi) adalah Shobahan nur (Selamat pagi bercahaya).',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(18,18,'Tajwid & Bahasa Arab','Angka Arab \"خَمْسَةٌ\" (Khamsatun) memiliki arti lambang bilangan...','3 (Tiga)','4 (Empat)','5 (Lima)','7 (Tujuh)','C',2,'Khamsatun artinya angka 5 (lima). Wahid (1), itsnan (2), tsalatsah (3), arba\'ah (4), khamsah (5).',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(19,19,'Tajwid & Bahasa Arab','Kosakata \"كِتَابٌ\" (Kitaabun) jika diartikan ke dalam bahasa Indonesia adalah...','Buku / Kitab','Pena','Papan tulis','Meja belajar','A',2,'Kitaabun (كِتَابٌ) artinya buku/kitab. Qalamun artinya pena, Maq\'adun artinya bangku.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(20,20,'Tajwid & Bahasa Arab','Hukum alif lam (ال) yang dibaca jelas dan tidak melebur ke huruf setelahnya dinamakan...','Al-Qamariyah','Asy-Syamsiyah','Al-Farq','Al-Iqlab','A',2,'Al-Qamariyah adalah alif lam yang dibaca terang/jelas, contohnya Al-Hamdu, Al-Kitabu.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(21,21,'Bahasa Indonesia & Literasi','Ide pokok atau gagasan utama dalam sebuah paragraf biasanya terdapat pada bagian...','Kalimat penjelas','Kalimat pengembang','Kalimat utama','Kalimat tanya','C',2,'Ide pokok paragraf selalu terletak di dalam kalimat utama (baik di awal, akhir, atau campuran).',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(22,22,'Bahasa Indonesia & Literasi','Penulisan kata baku menurut Pedoman Umum Ejaan Bahasa Indonesia (PUEBI/KBBI) yang benar adalah...','Nasehat','Nasihat','Nasihatkan','Nasehad','B',2,'Bentuk kata baku yang tepat dalam Kamus Besar Bahasa Indonesia adalah \"Nasihat\" (menggunakan huruf i).',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(23,23,'Bahasa Indonesia & Literasi','Sinonim (persamaan kata) dari kata \"KOLABORASI\" adalah...','Persaingan','Kerja sama','Pertentangan','Pemisahan','B',2,'Kolaborasi berarti bentuk kerja sama antar individu atau kelompok untuk mencapai tujuan bersama.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(24,24,'Bahasa Indonesia & Literasi','Antonim (lawan kata) dari kata \"DERMAWAN\" adalah...','Ikhlas','Kikir / Pelit','Jujur','Sombong','B',2,'Dermawan berarti suka bersedekah atau memberi harta. Lawan katanya adalah kikir atau pelit.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(25,25,'Bahasa Indonesia & Literasi','Peribahasa \"Bagai air di daun talas\" memiliki makna kiasan yaitu...','Orang yang pendiriannya tidak tetap dan selalu berubah-ubah','Orang yang hidupnya serba berkecukupan','Seseorang yang selalu rajin bekerja tanpa pamrih','Orang yang tidak tahu membalas budi kebaikan','A',2,'Air di daun talas mudah bergoyang ke sana kemari, melambangkan orang yang plin-plan/tidak teguh pendiriannya.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(26,26,'Bahasa Indonesia & Literasi','Kalimat di bawah ini yang menggunakan tanda baca koma (,) secara tepat adalah...','Ibu membeli apel, jeruk, dan mangga di pasar.','Ibu membeli apel jeruk, dan, mangga di pasar.','Ibu membeli, apel, jeruk, dan mangga, di pasar.','Ibu membeli apel, jeruk dan mangga, di pasar','A',2,'Tanda koma dipakai di antara unsur-unsur dalam suatu perincian atau pembilangan sebelum kata hubung \"dan\".',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(27,27,'Bahasa Indonesia & Literasi','Majas yang membandingkan benda mati seolah-olah memiliki sifat dan perilaku seperti manusia hidup disebut...','Majas Hiperbola','Majas Personifikasi','Majas Metafora','Majas Litotes','B',2,'Personifikasi mengumpamakan benda mati berperilaku seperti manusia, contoh: \"Pena itu menari-nari di atas kertas\".',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(28,28,'Bahasa Indonesia & Literasi','Ciri utama dari teks deskripsi adalah...','Menceritakan urutan kejadian fiksi secara dramatis','Menggambarkan objek atau peristiwa secara rinci sehingga pembaca seolah merasakan langsung','Mengajak pembaca untuk membeli suatu produk dagangan','Menyajikan data perdebatan antara dua kubu','B',2,'Teks deskripsi melukiskan objek, tempat, atau suasana secara rinci dengan panca indera.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(29,29,'Bahasa Indonesia & Literasi','Kalimat efektif di bawah ini yang paling tepat susunannya adalah...','Para santri-santri semua sedang mengikuti ujian masuk.','Santri sedang mengikuti ujian masuk pesantren.','Banyak para santri yang datang terlambat hadir.','Di dalam asrama pesantren membicarakan tata tertib.','B',2,'Pilihan B lugas, hemat kata, serta memiliki subjek dan predikat yang utuh tanpa pemborosan kata jamak ganda.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(30,30,'Bahasa Indonesia & Literasi','Pesan moral luhur yang dapat dipetik pembaca dari sebuah cerita fabel atau cerpen dinamakan...','Alur','Latar','Amanat','Sudut pandang','C',2,'Amanat adalah pesan moral atau nilai keteladanan yang disampaikan pengarang kepada pembaca.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(31,31,'Matematika & Logika','Hasil dari operasi hitung: (-18) + 25 - (-7) adalah...','14','0','12','14','A',2,'(-18) + 25 = 7. Kemudian 7 - (-7) = 7 + 7 = 14.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(32,32,'Matematika & Logika','Faktor Persekutuan Terbesar (FPB) dari bilangan 24 dan 36 adalah...','6','8','12','72','C',2,'Faktor 24: 1, 2, 3, 4, 6, 8, 12, 24. Faktor 36: 1, 2, 3, 4, 6, 9, 12, 18, 36. Faktor terbesar yang sama adalah 12.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(33,33,'Matematika & Logika','Kelipatan Persekutuan Terkecil (KPK) dari bilangan 12 dan 15 adalah...','30','60','90','180','B',2,'12 = 2^2 x 3, 15 = 3 x 5. KPK = 2^2 x 3 x 5 = 4 x 3 x 5 = 60.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(34,34,'Matematika & Logika','Bentuk pecahan paling sederhana dari 48/60 adalah...','2/3','3/4','4/5','5/6','C',2,'Bagi pembilang dan penyebut dengan FPB 12: 48 ÷ 12 = 4, 60 ÷ 12 = 5. Hasilnya 4/5.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(35,35,'Matematika & Logika','Berapakah 25% dari Rp 200.000?','Rp 25.000','Rp 40.000','Rp 50.000','Rp 75.000','C',2,'25/100 x 200.000 = 1/4 x 200.000 = Rp 50.000.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(36,36,'Matematika & Logika','Perhatikan deret pola bilangan berikut: 3, 7, 11, 15, ..., bilangan berikutnya adalah...','18','19','20','21','B',2,'Pola bilangan bertambah 4 (+4). Jadi 15 + 4 = 19.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(37,37,'Matematika & Logika','Luas persegi panjang yang memiliki panjang 15 cm dan lebar 8 cm adalah...','46 cm²','120 cm²','150 cm²','23 cm²','B',2,'Luas persegi panjang = Panjang x Lebar = 15 cm x 8 cm = 120 cm².',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(38,38,'Matematika & Logika','Sebuah halaqah santri memulai tilawah pukul 08.15 dan selesai pukul 10.45. Lama waktu kegiatan tersebut adalah...','1 jam 30 menit','2 jam 15 menit','2 jam 30 menit','3 jam','C',2,'10.45 - 08.15 = 2 jam 30 menit.',1,'2026-10-08 04:53:23','2026-10-08 04:53:23'),(39,39,'Matematika & Logika','Perbandingan santri putra dan putri di sebuah kelas adalah 3 : 4. Jika jumlah santri putra adalah 18 orang, maka jumlah santri putri adalah...','20 orang','24 orang','28 orang','32 orang','B',2,'Santri putri = (4/3) x 18 = 4 x 6 = 24 orang.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(40,40,'Matematika & Logika','Sebuah bus pesantren melaju dengan kecepatan rata-rata 60 km/jam selama 3,5 jam. Jarak tempuh bus tersebut adalah...','180 km','200 km','210 km','240 km','C',2,'Jarak = Kecepatan x Waktu = 60 km/jam x 3,5 jam = 210 km.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(41,41,'Bahasa Inggris & Wawasan','Ahmad: \"Good afternoon, Ali. How are you today?\" Ali: \"...\" Kalimat respon yang tepat adalah...','Good night.','I am fine, thank you.','Nice to meet you yesterday.','My name is Ali.','B',2,'Pertanyaan \"How are you today?\" (Bagaimana kabarmu hari ini?) dijawab dengan \"I am fine, thank you\" (Saya baik-baik saja, terima kasih).',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(42,42,'Bahasa Inggris & Wawasan','\"Every morning, the students ... the Holy Qur\'an in the mosque together.\"','recites','reciting','recite','recited','C',2,'Subjek \"the students\" adalah jamak (plural/they), sehingga kata kerja bentuk Simple Present Tense menggunakan verb 1 murni tanpa -s: \"recite\".',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(43,43,'Bahasa Inggris & Wawasan','The opposite meaning (antonym) of the word \"CLEAN\" is...','Tidy','Dirty','Bright','Polite','B',2,'Clean artinya bersih, lawannya adalah Dirty yang artinya kotor.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(44,44,'Bahasa Inggris & Wawasan','\"Where do the students borrow and read reference books in the boarding school?\"','In the dining room','In the library','In the soccer field','In the parking lot','B',2,'Tempat meminjam dan membaca buku referensi adalah library (perpustakaan).',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(45,45,'Bahasa Inggris & Wawasan','Sila pertama dari Pancasila yang mendasari kehidupan religius bangsa Indonesia berbunyi...','Ketuhanan Yang Maha Esa','Kemanusiaan yang adil dan beradab','Persatuan Indonesia','Keadilan sosial bagi seluruh rakyat Indonesia','A',2,'Sila pertama Pancasila adalah Ketuhanan Yang Maha Esa dengan lambang Bintang Emas.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(46,46,'Bahasa Inggris & Wawasan','Semboyan resmi negara Indonesia yang berarti \"Berbeda-beda tetapi tetap satu jua\" adalah...','Tut Wuri Handayani','Bhinneka Tunggal Ika','Ing Ngarso Sung Tulodho','Garuda Pancasila','B',2,'Bhinneka Tunggal Ika tertulis pada pita cengkeraman Garuda Pancasila bermakna persatuan dalam keberagaman.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(47,47,'Bahasa Inggris & Wawasan','Hari Santri Nasional diperingati setiap tanggal 22 Oktober untuk mengenang momentum bersejarah perjuangan para santri dan ulama, yaitu...','Sumpah Pemuda','Resolusi Jihad KH. Hasyim Asy\'ari','Dekrit Presiden','Kemerdekaan RI','B',2,'Hari Santri ditetapkan Presiden RI untuk memperingati Resolusi Jihad 22 Oktober 1945 yang dicetuskan oleh Hadratus Syekh KH. Hasyim Asy\'ari.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(48,48,'Bahasa Inggris & Wawasan','Lagu kebangsaan negara kesatuan Republik Indonesia diciptakan oleh komponis nasional bernama...','W.R. Soepratman','Ismail Marzuki','H. Mutahar','C. Simanjuntak','A',2,'Lagu kebangsaan Indonesia Raya diciptakan oleh Wage Rudolf Soepratman.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(49,49,'Bahasa Inggris & Wawasan','Sikap toleransi dan saling menghormati antarumat beragama dalam kehidupan sehari-hari bertujuan untuk...','Menimbulkan perpecahan bangsa','Menciptakan kerukunan, kedamaian, dan persatuan','Mencampuradukkan ajaran ibadah','Menghilangkan identitas diri','B',2,'Toleransi (tasamuh) bertujuan mewujudkan kerukunan dan keharmonisan bermasyarakat.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24'),(50,50,'Bahasa Inggris & Wawasan','Tindakan nyata seorang santri yang mencerminkan cinta dan kepedulian terhadap kelestarian lingkungan hidup di asrama pesantren adalah...','Membuang sampah ke saluran air','Membiarkan kran air mengalir terus menerus','Memilah sampah, menghemat listrik & air, serta menjaga kebersihan masjid dan kamar','Menebang pohon tanpa menanam kembali','C',2,'Menjaga kebersihan dan hemat energi merupakan perwujudan kepedulian lingkungan sekaligus bagian dari cabang keimanan.',1,'2026-10-08 04:53:24','2026-10-08 04:53:24');
/*!40000 ALTER TABLE `ppdb_soals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `santris`
--

DROP TABLE IF EXISTS `santris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `santris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nis` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `usia` smallint(5) unsigned DEFAULT NULL,
  `nama_orang_tua` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `kamar` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `santris_nis_unique` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `santris`
--

LOCK TABLES `santris` WRITE;
/*!40000 ALTER TABLE `santris` DISABLE KEYS */;
INSERT INTO `santris` VALUES (1,'2026001','Muhammad Al-Fatih Pratama','Laki-laki','Surabaya','2010-04-12',16,'Bambang Supriyanto','081233445566','Al-Ghazali','1 Tsanawiyah','Jl. Ketintang Baru No. 12, Surabaya','2026-09-28 10:44:06','2026-10-06 23:40:43'),(2,'2026002','Aisyah Putri Azzahra','Perempuan','Malang','2009-08-25',17,'H. Hendra Gunawan','081299887766','Aisyah','2 Tsanawiyah','Jl. Ijen No. 45, Malang','2026-09-28 10:44:06','2026-10-06 23:40:43'),(3,'2026003','Ahmad Zaki Mubarak','Laki-laki','Jombang','2008-01-18',18,'H. Ridwan Mansyur','081344556677','Ali bin Abi Thalib','1 Aliyah','Jl. Merdeka No. 8, Jombang','2026-09-28 10:44:06','2026-10-06 23:40:43'),(4,'2026004','Fatimah Az-Zahra Ramadhani','Perempuan','Gresik','2008-11-03',17,'Drs. Suherman','081277889900','Fatimah','2 Aliyah','Jl. Veteran No. 19, Gresik','2026-09-28 10:44:06','2026-10-06 23:40:43'),(5,'2026005','Rizky Rayhan Maulana','Laki-laki','Sidoarjo','2007-06-15',19,'Agus Wahyudi','081388991122','Al-Ghazali','3 Aliyah','Jl. Pahlawan No. 77, Sidoarjo','2026-09-28 10:44:06','2026-10-06 23:40:43');
/*!40000 ALTER TABLE `santris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('4G8XESN3jh1pkmN8oJQf0b0GRPPxd1juQxlW6lBO',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ2TnJ0MHlacVRESHpxTzBlZ2hUWUJ0d0FzOWxSdkQxZkx6WTE0TUNoIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM2ODI3NmY5NjY2M2Q2NjViOWMyNDFmZTI5YjUxNWNkYmQ1MDI1Y2JlMGJkMDQ2MWQxNThkNmNkMWI2MjIyZSJ9',1791904760),('8beAJBX7OykZqnGvwMStaOmHVgP1y9qP8KHmCcxY',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJzS0lOc2JSTUQ5SDhtZ1lmcmVVclJhelY2SjBGbHhnOXRWMWhUS2tBIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiNTIwNDhlNjliNWI4MDAwNjhmY2E1ODQ5ZDY5MGI3NzBlZjZiNzViYThkOTVhOWNhOGNmYjg4MjE0NzgzOWQ2OSJ9',1791878014),('BMDbHptGRCnJtbJAS1tsESgLqqj6pWGOW1p0GlNr',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ4MzRORTQxYjk3MFdRSXg4YnRmMXRvWFBabjdxUDJPQTRGWHBRNzRVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC91amlhbi1tYXN1ayIsInJvdXRlIjoicHBkYi5leGFtLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1791515426),('dkD3iJSOmUn6EIVaGoWDq39m3HwqDnqQcC8NmnAq',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJhZUF1VWR4c2tFRU5OeTN5STduZlBVVzdMME5jRzhWQ08zTzMxV1lGIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiNTIwNDhlNjliNWI4MDAwNjhmY2E1ODQ5ZDY5MGI3NzBlZjZiNzViYThkOTVhOWNhOGNmYjg4MjE0NzgzOWQ2OSJ9',1791462662),('QcbsjYy7lOvF6SWRggHyKouRKwyTCyLwd7CLZZvz',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJaODhENkZhdzdFdm5WRjZoZkhLWG1ocDlSTzNkNjh5R0p4Y1o0TDA3IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=',1791608948),('qRDhQWPvvFxA4Ov1hSZDOHdNCsvISoA8XEjliRG3',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJoT2RObkY5SjR0d1lFcjJKWVlyMUpFbGt1SVdlN2hBbkJlMWl6REdGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJsYW5kaW5nIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiNTIwNDhlNjliNWI4MDAwNjhmY2E1ODQ5ZDY5MGI3NzBlZjZiNzViYThkOTVhOWNhOGNmYjg4MjE0NzgzOWQ2OSJ9',1792422758);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `no_hp` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `usia` smallint(5) unsigned DEFAULT NULL,
  `nama_orang_tua` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ustadz Deri Diantara, S.Kom','admin@ulilalbab.ac.id','admin','081234567890','1992-05-14',34,'H. Ahmad Marzuqi','Komplek Pondok Pesantren Li Ulil Albab','Kepala Tata Usaha & IT',NULL,'$2y$12$d.ponimqsVaHGA8pOUPh/OwoOV/Bq8xDRc1dm4iFMHqvx1uAGdG1C','g69sHHBUjnVKSKDx0UvZtE6GVD4Vud3SzlrNy5r5yw77MAdRp4mizq0SWApC','2026-09-28 10:44:06','2026-10-07 04:10:21'),(2,'Ustadzah Nurul Hidayah, Lc','pengajar@ulilalbab.ac.id','pengajar','081234567891','1995-09-20',31,'Drs. H. Miftahurrahman','Perumahan As-Salam Blok C-12','Dewan Asatidz & Bimbingan Tahfidz',NULL,'$2y$12$vXH72jEXXg55v4yyH/cRheR/PMV/gyKwTJRdvqaDq43iWdTGqubPC',NULL,'2026-09-28 10:44:06','2026-10-06 23:40:43'),(3,'KH. Nahrul Badri, S.Q,. M.A.','pemilik@ulilalbab.ac.id','pemilik','081234567892','1970-03-10',56,'KH. Muhammad Hasan','Ndalam Pimpinan Pondok Pesantren Li Ulil Albab','Pengasuh & Pimpinan Pondok Pesantren',NULL,'$2y$12$GHlaGkB.RsghlWg/wKJqF.F/tiZZQ5.bPe/tmNTLbSjU4jC9s1Ype',NULL,'2026-09-28 10:44:06','2026-10-07 04:11:20'),(4,'Ustadz Ahmad Syauqi, M.Pd','syauqi@ulilalbab.ac.id','pengajar','081399887766',NULL,NULL,NULL,NULL,'Guru Pengampu Gramatika Arab (Nahwu-Sharaf)',NULL,'$2y$12$q8q2dnjKNj0RwWJuMTVGpu12iVynSHINTEYq.cRtQOSsaaQgXQoju',NULL,'2026-09-30 06:03:20','2026-10-06 23:40:44'),(5,'Ustadz Salman Al-Farisi, S.Pd.I','salman@ulilalbab.ac.id','pengajar','081255443322',NULL,NULL,NULL,NULL,'Guru Pengampu Fikih & Hadits Nabawi',NULL,'$2y$12$TFxTptfmhShfb7F4ng6xUu9bZcPX997yfUBe6aTqSlbHKfywXOH7u',NULL,'2026-09-30 06:03:20','2026-10-06 23:40:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `youtube_id` varchar(255) DEFAULT NULL,
  `video_file` varchar(255) DEFAULT NULL,
  `durasi` varchar(255) DEFAULT '10:00',
  `thumbnail` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_hero_slider` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'Dokumenter 24 Jam Kehidupan Santri di Pesantren','Kehidupan Santri','HXe1uNxsT9w',NULL,'14:20','thumbnails/thumb_1790789077_d57132ab.jpg','Mulai dari qiyamul lail pukul 03.30 WIB, shalat subuh berjamaah, halaqah tahfidz shubuh, sekolah formal MTs/MA, pengajian kitab kuning sore, hingga muthola\'ah malam asrama.',1,1,1,'2026-09-30 05:21:23','2026-09-30 10:24:37'),(2,'Khotmil Qur\'an ponpes Li Ulil Albab','Tahfidz Qur\'an','HXe1uNxsT9w',NULL,'08:45','https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=800&q=80','Ujian kelulusan hafalan juz 30 dengan tartil, mahraj fasih, dan tajwid mutqin oleh santri program takhasus.',1,0,2,'2026-09-30 05:21:23','2026-10-19 07:02:38'),(3,'Gagal Sunmori','Bahasa Asing','6BGbDTCv2QU',NULL,'06:12','https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80','Kefasihan penguasaan kosakata bahasa Arab dan dialek fushah santriwati di panggung Festival Bahasa Nasional.',1,0,3,'2026-09-30 05:21:23','2026-10-19 07:06:15'),(4,'Grup Hadrah Santri: Lantunan Qasidah Burdah','Seni Rebana','fD3_P_V0Q3Y',NULL,'11:05','https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=800&q=80','Harmoni tabuhan terbang dan vokal merdu shalawat para santri mengiringi peringatan maulid akbar.',1,0,4,'2026-09-30 05:21:23','2026-09-30 05:21:23'),(5,'Inovasi Robotika & Coding Santri Milenial','Sains & IT','fD3_P_V0Q3Y',NULL,'09:30','https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80','Santri mempresentasikan ciptaan robot line follower, sensor IoT, dan aplikasi web untuk masyarakat.',0,0,5,'2026-09-30 05:21:23','2026-09-30 05:21:23'),(6,'Latihan Silat Pagar Nusa & Olahraga Memanah','Bela Diri & Olahraga','fD3_P_V0Q3Y',NULL,'07:18','https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=800&q=80','Menempa fisik yang tangguh, ketangkasan, dan kedisiplinan santri sesuai ajaran sunnah Rasulullah SAW.',0,0,6,'2026-09-30 05:21:23','2026-09-30 05:21:23');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-19 23:24:06
