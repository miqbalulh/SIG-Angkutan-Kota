-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2021 at 07:03 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig_angkutan`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkutan`
--

DROP TABLE IF EXISTS `angkutan`;
CREATE TABLE IF NOT EXISTS `angkutan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_angkutan` varchar(100) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `rute` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkutan`
--

INSERT INTO `angkutan` (`id`, `nama_angkutan`, `id_kabupaten`, `rute`) VALUES
(2, 'Candi - Gedangan', 2, 'rute1.geojson');

-- --------------------------------------------------------

--
-- Table structure for table `halte`
--

DROP TABLE IF EXISTS `halte`;
CREATE TABLE IF NOT EXISTS `halte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_halte` varchar(100) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halte`
--

INSERT INTO `halte` (`id`, `nama_halte`, `id_kabupaten`, `latitude`, `longitude`) VALUES
(1, 'Halte Candi', 2, '-7.47768', '112.714296'),
(2, 'Halte Larangan', 2, '-7.466801', '112.713014'),
(3, 'Halte Buduran', 2, '-7.435759', '112.720922');

-- --------------------------------------------------------

--
-- Table structure for table `halte_angkutan`
--

DROP TABLE IF EXISTS `halte_angkutan`;
CREATE TABLE IF NOT EXISTS `halte_angkutan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_angkutan` int(11) DEFAULT '0',
  `id_halte` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halte_angkutan`
--

INSERT INTO `halte_angkutan` (`id`, `id_angkutan`, `id_halte`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 3),
(5, 2, 1),
(6, 0, 1),
(8, 2, 2),
(9, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

DROP TABLE IF EXISTS `kabupaten`;
CREATE TABLE IF NOT EXISTS `kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kabupaten` varchar(100) NOT NULL,
  `file_geojson` varchar(150) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama_kabupaten`, `file_geojson`, `latitude`, `longitude`) VALUES
(2, 'Sidoarjo', 'kabupaten_sidoarjo.geojson', '-7.447241', '112.716584');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(100) NOT NULL,
  `id_kabupaten` int(255) NOT NULL,
  `file_geojson` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `id_kabupaten`, `file_geojson`) VALUES
(7, 'test', 7, 'kec_sedati.geojson'),
(10, 'Candi', 2, 'kec_candi.geojson');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `status_driver` int(11) DEFAULT '0',
  `status_halte` int(11) DEFAULT '0',
  `status_angkutan` int(11) NOT NULL DEFAULT '0',
  `id_angkutan` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nama`, `foto`, `alamat`, `status`, `id_kabupaten`, `status_driver`, `status_halte`, `status_angkutan`, `id_angkutan`, `updated_at`, `created_at`) VALUES
(2, 'iqbalul.hidayat280199@gmail.com', '$2y$08$GvtSgaJQLAPbXCz2eCqy8ujjdok/lbK.4bp67NQf0pH8VHAhtrWom', 'Iqbalul Hidayat', 'Screen Shot 12-05-20 at 11.53 AM 001.PNG', NULL, '1', 0, 1, 0, 0, NULL, NULL, NULL),
(21, 'iqbalul.hidayat2801@gmail.com', '$2y$08$GvtSgaJQLAPbXCz2eCqy8ujjdok/lbK.4bp67NQf0pH8VHAhtrWom', 'Sulistyanto Laili', 'Screen Shot 12-05-20 at 11.56 AM.PNG', 'asd', '2', 2, 0, 0, 0, NULL, NULL, NULL),
(25, 'muhammad.17051204011@mhs.unesa.ac.id', '$2y$08$GvtSgaJQLAPbXCz2eCqy8ujjdok/lbK.4bp67NQf0pH8VHAhtrWom', 'iqbal driver', 'Screen Shot 11-24-20 at 09.19 AM.PNG', 'Palem Putri R/3', '3', 2, 0, 1, 2, NULL, NULL, NULL),
(27, 'shope.natusi2020@gmail.com', '$2y$08$mAmUg7RtsARixuRo19Zul.PzL8DgggishoDL./pWYlf4UY.zxdKLq', 'qwe', '', 'qwe', '3', 2, 0, 0, 2, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
