-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql210.infinityfree.com
-- Generation Time: Mar 28, 2024 at 02:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36259146_yuri`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama`, `no_hp`, `jk`, `foto`) VALUES
(1, 'furizal', '$2y$10$N0k7Ln0o/.VhEeV02d4CQ.10vupIKrOk9ltjEFgTGMubEcKhH75r.', 'Furizal', '082386092684', 'Laki-laki', 'furizal.jpg'),
(5, 'yuridawilis', '$2y$10$N0k7Ln0o/.VhEeV02d4CQ.10vupIKrOk9ltjEFgTGMubEcKhH75r.', 'Yurida Wilis', '08xxxxxxxxx', 'Perempuan', 'yuridawilis.jpg'),
(6, 'putra', '$2y$10$YoNaoOseDrnNgm1LktU2GeAy1ykW8C6Xvz8TKr9Q03hAaMxLntMUW', 'Agus Mulya Putra', '08xxxxxxxxx', 'laki-laki', 'putra.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar`
--

CREATE TABLE `tb_daftar` (
  `id_daftar` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` char(14) NOT NULL,
  `alamat` text NOT NULL,
  `id_program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_daftar`
--

INSERT INTO `tb_daftar` (`id_daftar`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `alamat`, `id_program`) VALUES
(1, 'Aris', 'Rengat', '2020-06-01', '082386092688', 'Rengat', 2),
(2, 'FURIZAL', 'Kota Tengah', '2020-06-11', '0823', 'sfs', 3),
(3, 'Deni', 'sini', '2020-06-02', '0823', 'kjik', 4),
(4, 'jio', 'hu', '2020-06-04', '0823', 'iji', 3),
(5, 'DENI', 'Rengat', '2020-07-01', '0823', 'ji', 3),
(6, 'FEBRI', 'sss', '2020-06-08', '082386092684', 'css', 3),
(7, 'Ramdani', 'Kota Tengah', '2020-06-08', '2331312312', 'eee', 3),
(8, 'scs', 'cs', '2020-06-14', '33', '44', 4),
(9, 'scsac', 'mnj', '2020-06-16', '8', 'uh', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_galeri`
--

CREATE TABLE `tb_galeri` (
  `id_foto` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_galeri`
--

INSERT INTO `tb_galeri` (`id_foto`, `foto`, `ket`) VALUES
(3, 'foto3.jpg', 'Program Kecakapan Kerja'),
(4, 'foto4.jpg', 'Proses Pendaftaran'),
(5, 'foto4.jpg', 'Hemat'),
(6, 'foto3.jpg', 'COba');

-- --------------------------------------------------------

--
-- Table structure for table `tb_instruktur`
--

CREATE TABLE `tb_instruktur` (
  `id_instruktur` int(10) NOT NULL,
  `nama_instruktur` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_instruktur`
--

INSERT INTO `tb_instruktur` (`id_instruktur`, `nama_instruktur`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `alamat`, `foto`) VALUES
(1, 'RONI', '', '2020-05-08', '08333333', 'Kepayang', 'roni.jpg'),
(2, 'hhh', '', '2020-04-30', '0823', 'ttt', 'furizal.jpg'),
(3, 'Furizal', '', '1999-10-09', '082386092684', 'Pekanbaru', 'g.jpg'),
(4, 'Agus Mulya Putra', '', '2002-08-17', '082288001122', 'Rokan Hulu', 'deni.jpg'),
(5, 'Indah', 'Pekanbaru', '2000-09-09', '087777777777', 'Pekanbaru', '28032024144422Screenshot SiPA FT.png'),
(6, 'Azzahra', 'Pekanbaru', '1999-09-09', '08666666666', 'Rokan Hulu', '28032024145000Pas foto 085101484101.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id_log` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `aksi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id_log`, `status`, `id`, `nama`, `tanggal`, `waktu`, `aksi`) VALUES
(1, 'admin', 1, 'Furizal', '2024-03-29', '01:28:45', 'Logout dari sistem'),
(2, 'admin', 1, 'Furizal', '2024-03-29', '01:28:56', 'Login ke sistem'),
(3, 'admin', 1, 'Furizal', '2024-03-29', '01:30:41', 'Logout dari sistem'),
(4, 'admin', 6, 'Agus Mulya Putra', '2024-03-29', '01:30:57', 'Login ke sistem'),
(5, 'admin', 6, 'Agus Mulya Putra', '2024-03-29', '01:44:22', 'Tambah data instruktur'),
(6, 'admin', 6, 'Agus Mulya Putra', '2024-03-29', '01:50:00', 'Tambah data instruktur'),
(7, 'admin', 6, 'Agus Mulya Putra', '2024-03-29', '01:54:53', 'Logout dari sistem');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pekerjaan_alumni`
--

CREATE TABLE `tb_pekerjaan_alumni` (
  `id_pekerjaan_alumni` int(11) NOT NULL,
  `nama_pekerjaan_alumni` varchar(50) DEFAULT NULL,
  `tempat_kerja` varchar(50) DEFAULT NULL,
  `tgl_terima` date NOT NULL,
  `alamat_kerja` text DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `motivasi` text DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pekerjaan_alumni`
--

INSERT INTO `tb_pekerjaan_alumni` (`id_pekerjaan_alumni`, `nama_pekerjaan_alumni`, `tempat_kerja`, `tgl_terima`, `alamat_kerja`, `jabatan`, `motivasi`, `id_siswa`, `foto`) VALUES
(4, 'Keuangan1', 'Kantor Kepala Desa', '2020-05-08', 'Kerrrr', 'Bendahara', 'HIDUP SENANG', 11, ' foto2.jpg       '),
(5, 'Administrasi', 'Kantor Kepala Desa', '2020-05-13', 'Desa Kepenuhan Barat', 'Bendahara', 'Hidup tidak hanya bermimpi, namun juga bekerja keras untuk segera menggapainya', 8, 'foto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_pembayar` varchar(50) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_siswa`, `id_admin`, `nama_pembayar`, `tgl_pembayaran`, `jumlah_bayar`) VALUES
(2, 3, 1, 'Toni', '2020-05-27', 500000),
(3, 7, 1, 'Rizal', '2020-05-29', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendapat`
--

CREATE TABLE `tb_pendapat` (
  `id_pendapat` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `pendapat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pendapat`
--

INSERT INTO `tb_pendapat` (`id_pendapat`, `id_siswa`, `pendapat`) VALUES
(2, 11, 'YUri Computer oke');

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id_program` int(11) NOT NULL,
  `nama_program` varchar(50) DEFAULT NULL,
  `materi` text DEFAULT NULL,
  `tempo` varchar(20) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id_program`, `nama_program`, `materi`, `tempo`, `biaya`, `ket`) VALUES
(3, 'Kursus 3 Bulan', 'Microsoft Office Word, Microsoft Office Excel', '4', 1500000, 'Sampai Selesai'),
(4, 'Program H', 'Microsoft Office Word, Microsoft Office Excel, Microsoft Office Powerpoint', '2', 1000000, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(50) DEFAULT NULL,
  `jk` varchar(30) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `id_program` int(11) DEFAULT NULL,
  `tagihan` int(11) NOT NULL,
  `alumni` varchar(50) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `sertifikat` varchar(50) NOT NULL,
  `foto` text DEFAULT NULL,
  `foto_sertifikat` text DEFAULT NULL,
  `status_akun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nama_siswa`, `jk`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `alamat`, `tgl_masuk`, `id_program`, `tagihan`, `alumni`, `tgl_selesai`, `sertifikat`, `foto`, `foto_sertifikat`, `status_akun`) VALUES
(6, 'Reza', '', 'Kota Tengah', '2020-05-01', '082386092684', 'rrrr', '2020-05-29', 4, 1000000, 'Ya', '2020-05-29', 'Belum selesai', NULL, NULL, ''),
(7, 'Furizal Furizal', '', 'Kesra', '1999-08-09', '082386092684', 'Kesra', '2020-05-29', 4, 500000, 'Ya', '2020-05-29', 'Belum selesai', NULL, NULL, ''),
(8, 'Furizal Furizal', '', 'Kesra', '2020-04-30', '082386092684', 'ttt', '2020-05-29', 3, 1500000, 'Tidak', '0000-00-00', 'Belum selesai', NULL, NULL, ''),
(9, 'Furi', '', 'Kota Tengah', '2020-05-06', '082386092684', 'fffzzzzzzz', '2020-05-29', 4, 1000000, '', '0000-00-00', '', NULL, NULL, ''),
(10, 'Agustian', '', 'Kota Tengah', '2020-04-29', '082386092684', 'Pekanbaru', '2020-05-29', 4, 1000000, 'Ya', '2020-05-29', 'Belum diambil', NULL, NULL, ''),
(11, 'Nuraini', '', 'Pelalawan', '2020-04-30', '0822889990000', 'Pelalawan', '2020-05-29', 4, 1000000, 'Tidak', '0000-00-00', 'Belum selesai', NULL, NULL, ''),
(12, 'Rita', '', 'Tanjung Alam', '1997-07-01', '0823', 'Tanjung Alam', '2020-05-29', 4, 1000000, 'Tidak', '0000-00-00', 'Ya', NULL, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `tb_instruktur`
--
ALTER TABLE `tb_instruktur`
  ADD PRIMARY KEY (`id_instruktur`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tb_pekerjaan_alumni`
--
ALTER TABLE `tb_pekerjaan_alumni`
  ADD PRIMARY KEY (`id_pekerjaan_alumni`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_pendapat`
--
ALTER TABLE `tb_pendapat`
  ADD PRIMARY KEY (`id_pendapat`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_instruktur`
--
ALTER TABLE `tb_instruktur`
  MODIFY `id_instruktur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pekerjaan_alumni`
--
ALTER TABLE `tb_pekerjaan_alumni`
  MODIFY `id_pekerjaan_alumni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pendapat`
--
ALTER TABLE `tb_pendapat`
  MODIFY `id_pendapat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
