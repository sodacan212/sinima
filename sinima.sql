-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2023 at 05:03 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinima`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_matkul`
--

CREATE TABLE `mahasiswa_matkul` (
  `id` int NOT NULL,
  `nilai_tugas` int NOT NULL,
  `nilai_keaktifan` int NOT NULL,
  `nilai_kehadiran` int NOT NULL,
  `nilai_uts` int NOT NULL,
  `nilai_uas` int NOT NULL,
  `mahasiswa_id` int NOT NULL,
  `matkul_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hari` varchar(7) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('Y','T') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Y',
  `dosen_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `nama`, `hari`, `jam_mulai`, `jam_selesai`, `status`, `dosen_id`) VALUES
(1, 'Pemrograman Web', 'Selasa', '19:00:00', '21:30:00', 'Y', 6),
(2, 'Pemrograman Web II', 'Jumat', '17:00:00', '22:00:00', 'Y', 5),
(3, 'E-Commerce', 'Sabtu', '20:00:00', '21:00:00', 'Y', 5);

-- --------------------------------------------------------

--
-- Table structure for table `peran`
--

CREATE TABLE `peran` (
  `id` int NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peran`
--

INSERT INTO `peran` (`id`, `nama`) VALUES
(1, 'Administrator'),
(2, 'Dosen'),
(3, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomer_induk` int NOT NULL,
  `status` enum('Y','T') NOT NULL DEFAULT 'Y',
  `peran_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `nomer_induk`, `status`, `peran_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin Sinima', 0, 'Y', 1),
(2, 'sodacan212', '21232f297a57a5a743894a0e4a801fc3', ' A. A. Gede Agung Darma Putra', 210010019, 'Y', 3),
(3, 'petertheseepdog', '21232f297a57a5a743894a0e4a801fc3', 'Nanda Bayu Pamungkas', 210010124, 'Y', 3),
(4, 'pauskecetit', '21232f297a57a5a743894a0e4a801fc3', 'Gilbert Galilea Deswanto', 210010102, 'Y', 3),
(5, 'dobler', '21232f297a57a5a743894a0e4a801fc3', 'Wayan Dobler', 1232332311, 'Y', 2),
(6, 'semplar', '21232f297a57a5a743894a0e4a801fc3', 'Ketut Semplar', 210010020, 'Y', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa_matkul`
--
ALTER TABLE `mahasiswa_matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `matkul_id` (`matkul_id`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `peran`
--
ALTER TABLE `peran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nomer_induk` (`nomer_induk`),
  ADD KEY `peran_id` (`peran_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa_matkul`
--
ALTER TABLE `mahasiswa_matkul`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peran`
--
ALTER TABLE `peran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa_matkul`
--
ALTER TABLE `mahasiswa_matkul`
  ADD CONSTRAINT `mahasiswa_matkul_ibfk_1` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_matkul_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`peran_id`) REFERENCES `peran` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
