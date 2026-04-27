-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2026 at 08:44 PM
-- Server version: 10.6.25-MariaDB
-- PHP Version: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salmasho_db_salmashofa`
--
CREATE DATABASE IF NOT EXISTS `salmasho_db_salmashofa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `salmasho_db_salmashofa`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `gazebo_id` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `durasi` varchar(20) NOT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `no_whatsapp` varchar(20) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status` enum('tersedia','terisi') DEFAULT 'terisi',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `gazebo_id`, `tanggal_kunjungan`, `durasi`, `nama_pemesan`, `no_whatsapp`, `jam_mulai`, `jam_selesai`, `status`, `created_at`) VALUES
(1, 21, '2026-04-03', 'sewa_singkat', 'ad', '123', '06:02:00', '07:06:00', 'terisi', '2026-04-02 18:23:33'),
(3, 1, '2026-04-03', 'sewa_lama', 'ad', '123', NULL, NULL, 'terisi', '2026-04-02 18:55:40'),
(6, 5, '2026-04-17', 'sewa_singkat', 'Syawe', '083837965513', '22:44:00', '05:45:00', 'terisi', '2026-04-17 04:30:31'),
(7, 21, '2026-04-17', 'sewa_lama', 'syawe', '081250919745', NULL, NULL, 'terisi', '2026-04-17 05:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `fasilitas_id` char(36) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumentasi`
--

INSERT INTO `dokumentasi` (`id`, `fasilitas_id`, `gambar`) VALUES
('003bb847-268e-11f1-8332-0a0027000002', '3aee1760-2679-11f1-8332-0a0027000002', 'image_tss/1775453757_k.renang 125 cm.JPG'),
('06679261-2694-11f1-8332-0a0027000002', 'e2f040b6-267b-11f1-8332-0a0027000002', 'image_tss/1775453418_taman atas bukit.JPG'),
('130dd45c-268f-11f1-8332-0a0027000002', '6cda0d96-267f-11f1-8332-0a0027000002', 'image_tss/1775453583_kantin.JPG'),
('1ed67bd3-2693-11f1-8332-0a0027000002', 'acc1206e-2674-11f1-8332-0a0027000002', 'image_tss/1775453224_gazebo 1-6.JPG'),
('393683c7-268e-11f1-8332-0a0027000002', '407fcb32-2687-11f1-8332-0a0027000002', 'image_tss/1775453508_mushola.JPG'),
('519cee99-2694-11f1-8332-0a0027000002', 'ea7d4133-2686-11f1-8332-0a0027000002', 'image_tss/1775453461_museum dalam.JPG'),
('5f2615f3-268f-11f1-8332-0a0027000002', '785c92e6-2671-11f1-8332-0a0027000002', 'image_tss/1775453018_aula.JPG'),
('7972bfc1-2694-11f1-8332-0a0027000002', 'ea7d4133-2686-11f1-8332-0a0027000002', 'image_tss/museum foto.jpg'),
('854b10ee-2692-11f1-8332-0a0027000002', '98da0726-2675-11f1-8332-0a0027000002', 'image_tss/1775453181_gazebo 21.JPG'),
('9554a536-2693-11f1-8332-0a0027000002', 'b878bdd1-267d-11f1-8332-0a0027000002', 'image_tss/1775453267_taman belakang.JPG'),
('971fae25-2694-11f1-8332-0a0027000002', 'ea7d4133-2686-11f1-8332-0a0027000002', 'image_tss/museum musik.jpg'),
('9e37da7f-268e-11f1-8332-0a0027000002', '4bf13e6e-2675-11f1-8332-0a0027000002', 'image_tss/1776395496_0_1775452599_logo.png'),
('aad61a08-268d-11f1-8332-0a0027000002', '01678f38-2679-11f1-8332-0a0027000002', 'image_tss/1775453706_k.renang anak 60cm.JPG'),
('b123adae-268f-11f1-8332-0a0027000002', '7c44715d-2685-11f1-8332-0a0027000002', 'image_tss/1775453078_toilet pria.JPG'),
('d39f6f51-2693-11f1-8332-0a0027000002', 'bdd0668b-267e-11f1-8332-0a0027000002', 'image_tss/1775453299_lapangan.JPG'),
('dbd7be71-2691-11f1-8332-0a0027000002', '8ecfdf9c-2670-11f1-8332-0a0027000002', 'image_tss/1775453137_k.renang balita 40 cm.JPG'),
('e56ec94c-268e-11f1-8332-0a0027000002', '5b137898-2680-11f1-8332-0a0027000002', 'image_tss/1775452944_toilet wanita.JPG'),
('fab18f6c-2694-11f1-8332-0a0027000002', '01678f38-2679-11f1-8332-0a0027000002', 'image_tss/k.renang anak 90cm.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `nama` varchar(100) NOT NULL,
  `kategori` enum('utama','pendukung') NOT NULL DEFAULT 'utama',
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `harga_≤4jam` decimal(12,2) DEFAULT NULL,
  `harga_≥4jam` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`, `kategori`, `deskripsi`, `harga`, `harga_≤4jam`, `harga_≥4jam`) VALUES
('01678f38-2679-11f1-8332-0a0027000002', 'K.Renang Anak', 'utama', 'Kolam luas dengan lanskap pepohonan tropis yang indah dan menyegarkan.', NULL, NULL, NULL),
('3aee1760-2679-11f1-8332-0a0027000002', 'K.Renang Remaja', 'utama', 'Seru dengan wahana perosotan (water slide) dan nyaman dengan area teduh berkanopi di tepi kolam.', NULL, NULL, NULL),
('407fcb32-2687-11f1-8332-0a0027000002', 'Mushola', 'pendukung', 'Mushola bersih dan tenang, suasananya adem.', NULL, NULL, NULL),
('4bf13e6e-2675-11f1-8332-0a0027000002', 'Gazebo 7-20', 'utama', 'Tersedia dalam jumlah banyak, menjamin ketersediaan area istirahat bagi pengunjung rombongan.', NULL, 75000.00, 150000.00),
('5b137898-2680-11f1-8332-0a0027000002', 'Toilet Wanita', 'pendukung', 'Toilet bersih dan cukup nyaman', NULL, NULL, NULL),
('6cda0d96-267f-11f1-8332-0a0027000002', 'Kantin', 'pendukung', 'Tersedia cemilan dan minuman yang dapat dinikmati langsung', NULL, NULL, NULL),
('785c92e6-2671-11f1-8332-0a0027000002', 'Aula', 'utama', 'Semi-terbuka, sejuk, dan lapang, sangat ideal untuk acara besar atau gathering.', 20000.00, NULL, NULL),
('7c44715d-2685-11f1-8332-0a0027000002', 'Toilet Pria', 'pendukung', 'Fasilitas sanitasi yang bersih dan mudah diakses.', NULL, NULL, NULL),
('8ecfdf9c-2670-11f1-8332-0a0027000002', 'Kolam Renang Balita', 'utama', 'Kolam dengan kedalaman 40 cm, bersebelahan langsung dengan bangunan utama sehingga mudah diawasi orang tua.', NULL, NULL, NULL),
('98da0726-2675-11f1-8332-0a0027000002', 'Gazebo 21', 'utama', 'Privat dan eksklusif, dikelilingi hamparan taman hijau yang asri untuk mencari ketenangan.', NULL, 300000.00, 500000.00),
('acc1206e-2674-11f1-8332-0a0027000002', 'Gazebo 1-6', 'utama', 'Teduh, berpagar kokoh, dan aman, tempat bersantai yang nyaman untuk keluarga.', NULL, 100000.00, 200000.00),
('b28be0ef-3a03-11f1-a75e-00163efae806', 'Sewa Baju Tradisional', 'utama', '', NULL, NULL, NULL),
('b878bdd1-267d-11f1-8332-0a0027000002', 'Taman Belakang', 'pendukung', 'menawarkan ruang ekstra yang teduh dan rindang', NULL, NULL, NULL),
('bdd0668b-267e-11f1-8332-0a0027000002', 'Lapangan', 'utama', 'Ruang terbuka hijau yang sangat luas dan terawat, cocok untuk outbound, camping, maupun piknik', NULL, NULL, NULL),
('e2f040b6-267b-11f1-8332-0a0027000002', 'Taman atas', 'pendukung', 'area yang menenangkan untuk bersantai ', NULL, NULL, NULL),
('ea7d4133-2686-11f1-8332-0a0027000002', 'Museum', 'utama', 'Ruangan estetik bernuansa vintage, menawarkan pengalaman nostalgia lewat koleksi piringan hitam dan barang antik.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gazebos`
--

CREATE TABLE `gazebos` (
  `id` int(11) NOT NULL,
  `nomor_gazebo` varchar(10) NOT NULL,
  `zona` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `harga_kurang_4` decimal(10,2) NOT NULL,
  `harga_lebih_4` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gazebos`
--

INSERT INTO `gazebos` (`id`, `nomor_gazebo`, `zona`, `kapasitas`, `harga_kurang_4`, `harga_lebih_4`) VALUES
(1, '01', 'Family Zone', 12, 100000.00, 200000.00),
(2, '02', 'Family Zone', 12, 100000.00, 200000.00),
(3, '03', 'Family Zone', 12, 100000.00, 200000.00),
(4, '04', 'Family Zone', 12, 100000.00, 200000.00),
(5, '05', 'Family Zone', 12, 100000.00, 200000.00),
(6, '06', 'Family Zone', 12, 100000.00, 200000.00),
(7, '07', 'Standard Zone', 9, 75000.00, 150000.00),
(8, '08', 'Standard Zone', 9, 75000.00, 150000.00),
(9, '09', 'Standard Zone', 9, 75000.00, 150000.00),
(10, '10', 'Standard Zone', 9, 75000.00, 150000.00),
(11, '11', 'Standard Zone', 9, 75000.00, 150000.00),
(12, '12', 'Standard Zone', 9, 75000.00, 150000.00),
(13, '13', 'Standard Zone', 9, 75000.00, 150000.00),
(14, '14', 'Standard Zone', 9, 75000.00, 150000.00),
(15, '15', 'Standard Zone', 9, 75000.00, 150000.00),
(16, '16', 'Standard Zone', 9, 75000.00, 150000.00),
(17, '17', 'Standard Zone', 9, 75000.00, 150000.00),
(18, '18', 'Standard Zone', 9, 75000.00, 150000.00),
(19, '19', 'Standard Zone', 9, 75000.00, 150000.00),
(20, '20', 'Standard Zone', 9, 75000.00, 150000.00),
(21, 'G21', 'Big Zone', 30, 300000.00, 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
('c654f9db-386d-11f1-a453-00163efae806', 'admin', '$2y$10$dUusx0wYw2BIo2itmSwDzOZe/kgr.QdtrMmi0WSFUmSPeH4a/910W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gazebo_id` (`gazebo_id`);

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fasilitas_id` (`fasilitas_id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gazebos`
--
ALTER TABLE `gazebos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gazebos`
--
ALTER TABLE `gazebos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`gazebo_id`) REFERENCES `gazebos` (`id`);

--
-- Constraints for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD CONSTRAINT `dokumentasi_ibfk_1` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
