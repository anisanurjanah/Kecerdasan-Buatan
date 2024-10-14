-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 07:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penyakit_kulit`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `kd_aturan` varchar(6) NOT NULL,
  `kd_penyakit` varchar(4) NOT NULL,
  `kd_gejala` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`kd_aturan`, `kd_penyakit`, `kd_gejala`) VALUES
('r3655', 'P01', 'A01'),
('r1642', 'P01', 'A02'),
('r5435', 'P01', 'A03'),
('r3555', 'P02', 'B01'),
('r3656', 'P02', 'B02'),
('r5316', 'P02', 'B03'),
('r1442', 'P03', 'C01'),
('r1641', 'P03', 'C02'),
('r3222', 'P03', 'C03'),
('r3342', 'P03', 'C04'),
('r4635', 'P03', 'C05'),
('r2152', 'P04', 'D01'),
('r5321', 'P04', 'D02'),
('r2634', 'P04', 'D03'),
('r1524', 'P04', 'D04'),
('r6162', 'P04', 'D05'),
('r3334', 'P05', 'E01'),
('r6266', 'P05', 'E02'),
('r5311', 'P05', 'E03'),
('r6325', 'P06', 'C01'),
('r4212', 'P06', 'F01'),
('r4523', 'P06', 'F02'),
('r1445', 'P06', 'F03'),
('r5523', 'P06', 'F04'),
('r6345', 'P07', 'G01'),
('r2633', 'P07', 'G02'),
('r6163', 'P07', 'G03'),
('r3153', 'P07', 'G04'),
('r5351', 'P08', 'H01'),
('r3412', 'P08', 'H02'),
('r1615', 'P08', 'H03'),
('r4445', 'P09', 'D01'),
('r5516', 'P09', 'I01'),
('r6332', 'P09', 'I02'),
('r2622', 'P09', 'I03'),
('r3442', 'P09', 'I04'),
('r5654', 'P10', 'D01'),
('r5611', 'P10', 'J01'),
('r1513', 'P10', 'J02'),
('r6361', 'P10', 'J03'),
('r2353', 'P10', 'J04');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `kd_diagnosa` varchar(8) NOT NULL,
  `kd_gejala` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`kd_diagnosa`, `kd_gejala`) VALUES
('d155516', 'A01'),
('d153126', 'F01'),
('d654453', 'I01'),
('d454541', 'J01');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kd_gejala` varchar(4) NOT NULL,
  `nama_gejala` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kd_gejala`, `nama_gejala`) VALUES
('A01', 'Bercak kemerahan pada kulit'),
('A02', 'Adanya plaque, lesi kulit yang permukaannya meninggi dan atasnya rata\r\n'),
('A03', 'Timbul gejala koebner phenomenon, kelainan kulit, dimana jika kulit sehat terkena trauma atau tergores, kulit yang sehat juga akan menjadi kelainan'),
('B01', 'Adanya papula, penonjolan padat terbatas tegas dipermukaan kulit dengan diameter < 1 cm kecil seukuran kepala jarum\r\n'),
('B02', 'Papula tumbuh menonjol'),
('B03', 'Permukaan kulit menjadi lebih gelap dan hyperkeratosis (tebal kasar)\r\n'),
('C01', 'Demam'),
('C02', 'Nyeri perut'),
('C03', 'Lemas'),
('C04', 'Perasaan tidak enak dengan vesikel pada kulit'),
('C05', 'Nafsu makan hilang'),
('D01', 'Gatal'),
('D02', 'Tanda kemerahan pada kulit'),
('D03', 'Kulit terasa kering'),
('D04', 'Kulit menebal'),
('D05', 'Kulit keropeng'),
('E01', 'Adanya makula hipopigmentasi, kelainan kulit dimana kulit warnanya Putih dasar tidak meninggi dibanding kulit sehat sekitarnya pada kulit yang asimtomatik'),
('E02', 'Timbulnya bercak-bercak halus berwarna putih di kulit'),
('E03', 'Kulit terlihat bintik-bintik melebar, putih dan licin'),
('F01', 'Mengigil'),
('F02', 'Sesak nafas'),
('F03', 'Nyeri dipersendian atau pegal disatu bagian tubuh'),
('F04', 'Munculnya bintik kemerahan pada kulit yang akhirnya membentuk sebuah gelembung cair'),
('G01', 'Terdapat lesi kulit yang menyerupai kusta tuberkuloid namun jumlahnya lebih banyak dan tak berguna'),
('G02', 'Bagian yang besar dapat mengganggu seluruh tungkai dan gangguan saraf tepi dengan kelemahan dan kehilangan rasa rangsang'),
('G03', 'Satu atau lebih hipopigmentasi makula kulit dan bagian yang tidak berasa (anestetik)'),
('G04', 'Lesi, nodul, plak kulit simetris, dermis kulit yang menipis'),
('H01', 'Ditemukannya noda-noda yang mudah dibersihkan yang didapati pada dinding dalam mulut (angular cheilitis)\r\n'),
('H02', 'Kulit mengalami retak-retak dan nyeri pada kulit di sudut mulut (angular cheilitis)'),
('H03', 'Menebalnya kuku dan bahkan dapat tanggal sendiri'),
('I01', 'Rambut rontok disekitar telinga'),
('I02', 'Rasa gatal disekitar telinga'),
('I03', 'Dipinggiran daun telinga terlihat ada kerat berwarna putih'),
('I04', 'Penebalan dan keriput pada kulit ditutupi oleh kerak-kerak berwarna abu-abu kekuningan'),
('J01', 'Kemerahan pada kulit'),
('J02', 'Timbul makula pada kulit dalam 12 jam berikutnya, pada mereka yang kurang sesitif makula akan segera hilang'),
('J03', 'Edema di sekitar kulit yang terkena'),
('J04', 'Vesikula kemudian dapat menjadi pustula apabila telat terjadi infeksi bakterial sekunder');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_hasil_diagnosa`
--

CREATE TABLE `laporan_hasil_diagnosa` (
  `kd_laporan` varchar(16) NOT NULL,
  `kd_pengguna` varchar(16) NOT NULL,
  `kd_diagnosa` varchar(8) NOT NULL,
  `kd_penyakit` varchar(4) NOT NULL,
  `tanggal` date NOT NULL,
  `hari` varchar(16) NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_hasil_diagnosa`
--

INSERT INTO `laporan_hasil_diagnosa` (`kd_laporan`, `kd_pengguna`, `kd_diagnosa`, `kd_penyakit`, `tanggal`, `hari`, `waktu`) VALUES
('lgh7mem9mhfdmnil', '656b4ea681cd1c44', 'd153126', 'P06', '2023-07-13', 'Thursday', '12:32:41'),
('lhd1l21dani5h9mf', '656b4ea681cd1c44', 'd155516', 'P01', '2023-07-05', 'Wednesday', '20:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kd_pengguna` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(16) NOT NULL,
  `no_telepon` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `bergabung_sejak` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(8) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kd_pengguna`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `no_telepon`, `email`, `bergabung_sejak`, `username`, `password`, `level`) VALUES
('656b4ea681cd1c44', 'Anisa Nurjanah', 'Cilegon', '2003-05-27', 'Pondok Cilegon Indah Blok D. 77 No. 18', 'Perempuan', '083813699536', 'anisanurjanah2705@gmail.com', '0 day ago', 'anisa27', 'anisa27', 'user'),
('admin', 'admin', '', '0000-00-00', '', '', '', '', '', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kd_penyakit` varchar(4) NOT NULL,
  `nama_penyakit` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kd_penyakit`, `nama_penyakit`) VALUES
('P01', 'Psioriasis'),
('P02', 'Veruca'),
('P03', 'Varicella'),
('P04', 'Eksim'),
('P05', 'Vitiligo'),
('P06', 'Herpes'),
('P07', 'Kusta'),
('P08', 'Infeksi Jamur Kandida'),
('P09', 'Scabies'),
('P10', 'Serkarial Dermatitis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`kd_aturan`),
  ADD KEY `kd_penyakit` (`kd_penyakit`,`kd_gejala`),
  ADD KEY `kd_gejala` (`kd_gejala`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`kd_diagnosa`),
  ADD KEY `kd_gejala` (`kd_gejala`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kd_gejala`);

--
-- Indexes for table `laporan_hasil_diagnosa`
--
ALTER TABLE `laporan_hasil_diagnosa`
  ADD PRIMARY KEY (`kd_laporan`),
  ADD KEY `kd_pengguna` (`kd_pengguna`,`kd_diagnosa`,`kd_penyakit`),
  ADD KEY `kd_penyakit` (`kd_penyakit`),
  ADD KEY `kd_diagnosa` (`kd_diagnosa`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kd_pengguna`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kd_penyakit`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`kd_penyakit`) REFERENCES `penyakit` (`kd_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`kd_gejala`) REFERENCES `gejala` (`kd_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD CONSTRAINT `diagnosa_ibfk_1` FOREIGN KEY (`kd_gejala`) REFERENCES `aturan` (`kd_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_hasil_diagnosa`
--
ALTER TABLE `laporan_hasil_diagnosa`
  ADD CONSTRAINT `laporan_hasil_diagnosa_ibfk_1` FOREIGN KEY (`kd_pengguna`) REFERENCES `pengguna` (`kd_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_hasil_diagnosa_ibfk_3` FOREIGN KEY (`kd_penyakit`) REFERENCES `aturan` (`kd_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_hasil_diagnosa_ibfk_4` FOREIGN KEY (`kd_diagnosa`) REFERENCES `diagnosa` (`kd_diagnosa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
