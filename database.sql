-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 07:07 PM
-- Server version: 5.6.20
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `0skr_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
`id_file` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `nama_file`, `file`) VALUES
(6, 'Surat Pernyataan', 'surat-pernyataan.pdf'),
(7, 'Pengumuman Penerimaan', 'pengumuman-penerimaan.pdf'),
(8, 'Formulir Ujian', 'formulir-ujian.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `hitung`
--

CREATE TABLE IF NOT EXISTS `hitung` (
`id_hitung` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `vektor_s` float NOT NULL,
  `vektor_v` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `hitung`
--

INSERT INTO `hitung` (`id_hitung`, `id_user`, `id_lowongan`, `vektor_s`, `vektor_v`) VALUES
(13, 14, 11, 74.4872, 0.315871),
(14, 15, 11, 74.7531, 0.316998),
(15, 16, 11, 86.5752, 0.367131);

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE IF NOT EXISTS `lowongan` (
`id_lowongan` int(11) NOT NULL,
  `lowongan` varchar(50) NOT NULL,
  `kuota` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pengumuman` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `lowongan`, `kuota`, `status`, `pengumuman`) VALUES
(11, 'Lowongan Programmer PHP', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_rinci`
--

CREATE TABLE IF NOT EXISTS `lowongan_rinci` (
`id_lowongan_rinci` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `bobot` int(11) NOT NULL,
  `status_nilai` tinyint(4) NOT NULL,
  `status_upload` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `lowongan_rinci`
--

INSERT INTO `lowongan_rinci` (`id_lowongan_rinci`, `id_lowongan`, `kriteria`, `bobot`, `status_nilai`, `status_upload`) VALUES
(37, 11, 'Menguasai PHP (test)', 5, 1, 0),
(38, 11, 'Kemampuan Bahasa Inggris(test)', 4, 1, 0),
(39, 11, 'Melampirkan KTP', 0, 0, 1),
(40, 11, 'Melampirkan Ijazah S1', 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE IF NOT EXISTS `pelamar` (
`id_lamaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`id_lamaran`, `id_user`, `id_lowongan`, `kriteria`, `nilai`, `file`) VALUES
(95, 14, 11, 'Menguasai PHP (test)', '75', ''),
(96, 14, 11, 'Kemampuan Bahasa Inggris(test)', '70', ''),
(97, 14, 11, 'Melampirkan KTP', '', '14_11_Melampirkan KTP.pdf'),
(98, 14, 11, 'Melampirkan Ijazah S1', '80', '14_11_Melampirkan Ijazah S1.pdf'),
(99, 15, 11, 'Menguasai PHP (test)', '77', ''),
(100, 15, 11, 'Kemampuan Bahasa Inggris(test)', '80', ''),
(101, 15, 11, 'Melampirkan KTP', '', '15_11_Melampirkan KTP.pdf'),
(102, 15, 11, 'Melampirkan Ijazah S1', '65', '15_11_Melampirkan Ijazah S1.pdf'),
(103, 16, 11, 'Menguasai PHP (test)', '87', ''),
(104, 16, 11, 'Kemampuan Bahasa Inggris(test)', '85', ''),
(105, 16, 11, 'Melampirkan KTP', '', '16_11_Melampirkan KTP.pdf'),
(106, 16, 11, 'Melampirkan Ijazah S1', '88', '16_11_Melampirkan Ijazah S1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pendidikan` varchar(30) NOT NULL,
  `file_cv` varchar(50) NOT NULL,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `no_hp`, `email`, `pendidikan`, `file_cv`, `foto`) VALUES
(14, 'Rawa Tech', 'rawa1', '4c05c01e16e46d81b318cce00fef3eab', 'jalan jalan sekitar indonesia', 'Indonesia', '1990-10-27', '081263728192', 'techrawa@gmail.com', 'S1 Teknik Informatika', 'cv_14_Rawa Tech.pdf', 'foto_14_Rawa Tech.png'),
(15, 'Juggernaut', 'jugg', 'cf3a6f91a31f6b0d7b397dad7143e1e4', 'jalan ga jauh dari rumah pokoknya', 'Indonesia', '1990-05-05', '081235353535', 'juggernaut@gmail.com', 'S1 Sistem Informasi', 'cv_15_Juggernaut.pdf', 'foto_15_Juggernaut.png'),
(16, 'Rawatech tapi Juggernaut', 'rawa2', 'c23e68318188483766f92f69d6d62268', 'dibelakang mesjid insyaAllah ringan langkah ', 'Indonesia', '1990-01-01', '081345456461', 'rawanaut@gmail.com', 'S1 Manajemen Informatika', 'cv_16_Rawatech tapi Juggernaut.pdf', 'foto_16_Rawatech tapi Juggernaut.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
 ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `hitung`
--
ALTER TABLE `hitung`
 ADD PRIMARY KEY (`id_hitung`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
 ADD PRIMARY KEY (`id_lowongan`);

--
-- Indexes for table `lowongan_rinci`
--
ALTER TABLE `lowongan_rinci`
 ADD PRIMARY KEY (`id_lowongan_rinci`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
 ADD PRIMARY KEY (`id_lamaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hitung`
--
ALTER TABLE `hitung`
MODIFY `id_hitung` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `lowongan_rinci`
--
ALTER TABLE `lowongan_rinci`
MODIFY `id_lowongan_rinci` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `pelamar`
--
ALTER TABLE `pelamar`
MODIFY `id_lamaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;