-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.5-10.1.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             7.0.0.4389
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for sample
DROP DATABASE IF EXISTS `sample`;
CREATE DATABASE IF NOT EXISTS `sample` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sample`;


-- Dumping structure for table sample.artikel_berita
DROP TABLE IF EXISTS `artikel_berita`;
CREATE TABLE IF NOT EXISTS `artikel_berita` (
  `ID_BERITA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_KATEGORI_BERITA` int(11) NOT NULL,
  `TITLE` varchar(100) NOT NULL,
  `CONTENT` text NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `VISIBLE` tinyint(4) NOT NULL DEFAULT '1',
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `ID_LOGIN` int(11) NOT NULL,
  `PICTURE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_BERITA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sample.artikel_berita: ~2 rows (approximately)
/*!40000 ALTER TABLE `artikel_berita` DISABLE KEYS */;
INSERT INTO `artikel_berita` (`ID_BERITA`, `ID_KATEGORI_BERITA`, `TITLE`, `CONTENT`, `CREATED_AT`, `UPDATED_AT`, `VISIBLE`, `STATUS`, `ID_LOGIN`, `PICTURE`) VALUES
	(4, 1, 'coba', 'awdlksdjlakjsdlkjasd', '2016-07-13 20:27:33', '2016-07-13 20:27:33', 1, 1, 1, '4872666_orig.jpg');
/*!40000 ALTER TABLE `artikel_berita` ENABLE KEYS */;


-- Dumping structure for table sample.artikel_gambar
DROP TABLE IF EXISTS `artikel_gambar`;
CREATE TABLE IF NOT EXISTS `artikel_gambar` (
  `ID_GAMBAR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_KATEGORI_GAMBAR` int(11) NOT NULL,
  `FILE` varchar(100) NOT NULL,
  `LINK` varchar(100) NOT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `VISIBLE` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_GAMBAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sample.artikel_gambar: ~0 rows (approximately)
/*!40000 ALTER TABLE `artikel_gambar` DISABLE KEYS */;
/*!40000 ALTER TABLE `artikel_gambar` ENABLE KEYS */;


-- Dumping structure for table sample.artikel_kategori_berita
DROP TABLE IF EXISTS `artikel_kategori_berita`;
CREATE TABLE IF NOT EXISTS `artikel_kategori_berita` (
  `ID_KATEGORI_BERITA` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(50) NOT NULL,
  `KETERANGAN` text NOT NULL,
  `VISIBLE` tinyint(4) NOT NULL DEFAULT '1',
  `STATUS` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_KATEGORI_BERITA`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sample.artikel_kategori_berita: ~2 rows (approximately)
/*!40000 ALTER TABLE `artikel_kategori_berita` DISABLE KEYS */;
INSERT INTO `artikel_kategori_berita` (`ID_KATEGORI_BERITA`, `NAMA`, `KETERANGAN`, `VISIBLE`, `STATUS`) VALUES
	(1, 'Kesehatan', 'Terkait kesehatan para jemaah calon haji ONHs', 1, 1),
	(2, 'Makanan', 'Makanan yang disajikkan ketika dalam perjalanan', 1, 1),
	(3, 'Pelayanan', 'Pelayanan bagi jemaah haji', 1, 1);
/*!40000 ALTER TABLE `artikel_kategori_berita` ENABLE KEYS */;


-- Dumping structure for table sample.artikel_kategori_gambar
DROP TABLE IF EXISTS `artikel_kategori_gambar`;
CREATE TABLE IF NOT EXISTS `artikel_kategori_gambar` (
  `ID_KATEGORI_GAMBAR` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(50) NOT NULL,
  `KETERANGAN` text NOT NULL,
  `VISIBLE` tinyint(4) NOT NULL DEFAULT '1',
  `STATUS` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_KATEGORI_GAMBAR`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sample.artikel_kategori_gambar: ~2 rows (approximately)
/*!40000 ALTER TABLE `artikel_kategori_gambar` DISABLE KEYS */;
INSERT INTO `artikel_kategori_gambar` (`ID_KATEGORI_GAMBAR`, `NAMA`, `KETERANGAN`, `VISIBLE`, `STATUS`) VALUES
	(1, 'Mekkah', 'Suasana Mekah saat Ramadhan', 1, 1),
	(2, 'Mina', 'Tempat yang digunakan untuk bermalam (Mabit)', 1, 1),
	(3, 'coba', 'ooiuoiuoi', 0, 1);
/*!40000 ALTER TABLE `artikel_kategori_gambar` ENABLE KEYS */;


-- Dumping structure for table sample.artikel_login
DROP TABLE IF EXISTS `artikel_login`;
CREATE TABLE IF NOT EXISTS `artikel_login` (
  `ID_LOGIN` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(45) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `VISIBLE` tinyint(4) NOT NULL DEFAULT '1',
  `LEVEL` int(11) NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_LOGIN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sample.artikel_login: ~0 rows (approximately)
/*!40000 ALTER TABLE `artikel_login` DISABLE KEYS */;
INSERT INTO `artikel_login` (`ID_LOGIN`, `USERNAME`, `PASSWORD`, `NAME`, `VISIBLE`, `LEVEL`, `CREATED_AT`, `UPDATED_AT`, `STATUS`) VALUES
	(1, 'yrvvan', 'yrvvan', 'Irwan Rosyadi', 1, 0, '2016-07-13 20:32:22', '2016-07-13 20:36:04', 1);
/*!40000 ALTER TABLE `artikel_login` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
