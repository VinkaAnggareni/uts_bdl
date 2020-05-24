-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 10:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahasiswa`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `detail` (IN `id` INT(20))  NO SQL
BEGIN
SELECT dosen.Nama_Dosen, detailkrs.Nilai, matakuliah.NamaMatakuliah
    FROM detailkrs
    JOIN dosen
    ON dosen.Id_Dosen =detailkrs.Id_Dosen
    JOIN matakuliah
    ON matakuliah.Id_Matakuliah =detailkrs.Id_Matakuliah
    WHERE dosen.Id_Dosen= id;
   END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hitung` () RETURNS INT(11) RETURN(SELECT COUNT(id)  FROM mahasiswa)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detailkrs`
--

CREATE TABLE `detailkrs` (
  `Id_Detail` int(11) NOT NULL,
  `Id_KRS` int(11) NOT NULL,
  `Id_Matakuliah` int(11) NOT NULL,
  `Kelas` enum('A','B','C','D') NOT NULL,
  `Nilai` enum('1','2','3','4','') NOT NULL,
  `Id_Dosen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailkrs`
--

INSERT INTO `detailkrs` (`Id_Detail`, `Id_KRS`, `Id_Matakuliah`, `Kelas`, `Nilai`, `Id_Dosen`) VALUES
(26, 1, 1, 'A', '1', 8),
(27, 12, 2, 'C', '2', 8),
(28, 9, 2, 'B', '3', 8),
(29, 1, 2, 'A', '4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `Id_Dosen` int(11) NOT NULL,
  `NIP_Dosen` int(11) NOT NULL,
  `Nama_Dosen` varchar(50) NOT NULL,
  `Id_Jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`Id_Dosen`, `NIP_Dosen`, `Nama_Dosen`, `Id_Jurusan`) VALUES
(8, 1234567891, 'Arif Suryanto ', 3),
(9, 1234567890, 'arif1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `Id_Fakultas` int(11) NOT NULL,
  `Nama_Fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`Id_Fakultas`, `Nama_Fakultas`) VALUES
(1, 'Fakultas Ilmu Pendidikan'),
(2, 'Fakultas Bahasa dan Seni'),
(3, 'Fakultas Matematika '),
(4, 'Fakultas Ilmu Sosial'),
(5, 'Fakultas Teknik dan Kejuruan '),
(6, 'Fakultas Ekonomi'),
(7, 'Pasca Sarjana'),
(8, 'Fakultas Ilmu Pendidikan'),
(9, 'Fakultas Bahasa dan Seni'),
(10, 'Fakultas Matematika '),
(11, 'Fakultas Ilmu Sosial'),
(12, 'Fakultas Teknik dan Kejuruan '),
(13, 'Fakultas Ekonomi'),
(14, 'Pasca Sarjana');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `Id_Jurusan` int(11) NOT NULL,
  `Nama_Jurusan` varchar(50) NOT NULL,
  `Id_Fakultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`Id_Jurusan`, `Nama_Jurusan`, `Id_Fakultas`) VALUES
(1, 'Manajemen Informatika', 5),
(2, 'Teknik Elektronika', 5),
(3, 'Boga Perhotelan', 5),
(4, 'Pendidikan Kesejahteraan Keluarga', 5),
(5, 'Pendidikan Teknik Informatika', 5),
(6, 'Pendidikan Teknik Elektro', 5),
(7, 'Pendidikan Teknik Mesin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `Id_KRS` int(11) NOT NULL,
  `Id_Mahasiswa` int(11) NOT NULL,
  `TahunAkademik` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`Id_KRS`, `Id_Mahasiswa`, `TahunAkademik`) VALUES
(1, 1, 2007),
(3, 2, 2007),
(4, 1, 2017),
(5, 1, 2007),
(6, 1, 2007),
(7, 1, 2007),
(8, 1, 2007),
(9, 1, 2007),
(10, 1, 2020),
(11, 1, 2009),
(12, 1, 2020);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kuliah_id`
-- (See below for the actual view)
--
CREATE TABLE `kuliah_id` (
`Jumlah` bigint(21)
,`Nama` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `log_mahasiswa`
--

CREATE TABLE `log_mahasiswa` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `waktu` datetime NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_mahasiswa`
--

INSERT INTO `log_mahasiswa` (`id`, `deskripsi`, `waktu`, `user`) VALUES
(1, 'Perubahan mahasiswa ID=12', '2020-05-23 21:25:49', 'root@localhost'),
(2, 'Berhasil di mahasiswa ID=12', '2020-05-23 21:28:08', 'root@localhost');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `NIM_Mahasiswa` varchar(10) NOT NULL,
  `Nama_Mahasiswa` varchar(50) NOT NULL,
  `Id_Jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `NIM_Mahasiswa`, `Nama_Mahasiswa`, `Id_Jurusan`) VALUES
(1, '1215051001', 'Ngurah Alit Keniten', 2),
(2, '1215051002', 'Made Kristian Dwidana Putra', 4),
(12, '098765432', 'yogi pras', 7);

--
-- Triggers `mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `int` AFTER INSERT ON `mahasiswa` FOR EACH ROW INSERT INTO log_mahasiswa VALUES('',CONCAT('Penambahan mahasiswa ID=',NEW.id),NOW(),USER())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update` BEFORE UPDATE ON `mahasiswa` FOR EACH ROW INSERT INTO log_mahasiswa VALUES('',CONCAT('Berhasil di mahasiswa ID=',OLD.id),NOW(),USER())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `Id_Matakuliah` int(11) NOT NULL,
  `NamaMatakuliah` varchar(100) NOT NULL,
  `Semester` int(11) NOT NULL,
  `SKS` int(11) NOT NULL,
  `Kurikulum` year(4) NOT NULL,
  `Id_Jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`Id_Matakuliah`, `NamaMatakuliah`, `Semester`, `SKS`, `Kurikulum`, `Id_Jurusan`) VALUES
(1, 'Pendidikan Agama (Religion)', 1, 4, 2012, 1),
(2, 'Pendidikan Kewarganegaraan (Citizenship/Civics)', 1, 2, 2012, 3),
(3, 'Ilmu Sosial Dasar (Basic Social Studies)\r\n', 1, 2, 2012, 5);

-- --------------------------------------------------------

--
-- Structure for view `kuliah_id`
--
DROP TABLE IF EXISTS `kuliah_id`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kuliah_id`  AS  select count(`NIM_Mahasiswa`) AS `Jumlah`,`matakuliah`.`NamaMatakuliah` AS `Nama` from (((`detailkrs` join `matakuliah` on((`matakuliah`.`Id_Matakuliah` = `detailkrs`.`Id_Matakuliah`))) join `krs` on((`krs`.`Id_KRS` = `detailkrs`.`Id_KRS`))) join `mahasiswa` on((`id` = `krs`.`Id_Mahasiswa`))) group by `matakuliah`.`Id_Matakuliah` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailkrs`
--
ALTER TABLE `detailkrs`
  ADD PRIMARY KEY (`Id_Detail`),
  ADD KEY `Id_KRS` (`Id_KRS`),
  ADD KEY `Id_Matakuliah` (`Id_Matakuliah`),
  ADD KEY `Id_Dosen` (`Id_Dosen`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`Id_Dosen`),
  ADD KEY `Id_Jurusan` (`Id_Jurusan`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`Id_Fakultas`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`Id_Jurusan`),
  ADD KEY `Id_Fakultas` (`Id_Fakultas`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`Id_KRS`),
  ADD KEY `Id_Mahasiswa` (`Id_Mahasiswa`);

--
-- Indexes for table `log_mahasiswa`
--
ALTER TABLE `log_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_Jurusan` (`Id_Jurusan`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`Id_Matakuliah`),
  ADD KEY `Id_Jurusan` (`Id_Jurusan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailkrs`
--
ALTER TABLE `detailkrs`
  MODIFY `Id_Detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `Id_Dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `Id_Fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `Id_Jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `Id_KRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `log_mahasiswa`
--
ALTER TABLE `log_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `Id_Matakuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailkrs`
--
ALTER TABLE `detailkrs`
  ADD CONSTRAINT `detailkrs_ibfk_1` FOREIGN KEY (`Id_KRS`) REFERENCES `krs` (`Id_KRS`),
  ADD CONSTRAINT `detailkrs_ibfk_2` FOREIGN KEY (`Id_Matakuliah`) REFERENCES `matakuliah` (`Id_Matakuliah`),
  ADD CONSTRAINT `detailkrs_ibfk_3` FOREIGN KEY (`Id_Dosen`) REFERENCES `dosen` (`Id_Dosen`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`Id_Jurusan`) REFERENCES `jurusan` (`Id_Jurusan`);

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`Id_Fakultas`) REFERENCES `fakultas` (`Id_Fakultas`);

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`Id_Mahasiswa`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`Id_Jurusan`) REFERENCES `jurusan` (`Id_Jurusan`);

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`Id_Jurusan`) REFERENCES `jurusan` (`Id_Jurusan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
