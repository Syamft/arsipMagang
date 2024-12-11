-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2024 pada 14.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id` int(11) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `sub_folder` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `folder`, `sub_folder`, `file_name`, `description`, `upload_date`) VALUES
(34, 'Penataan_Kepegawaian', 'Lupa absen', '06 Agustus_Merfinria.pdf', 'Agustus', '2024-10-13'),
(35, 'Penataan_Kepegawaian', 'Lupa absen', '16 Agustus_Merfinria.pdf', 'Agustus', '2024-10-13'),
(36, 'Penataan_Kepegawaian', 'Lupa absen', '19 Agustus_Aris.pdf', 'Agustus', '2024-10-13'),
(37, 'Penataan_Kepegawaian', 'Lupa absen', '19 Agustus_Mami.pdf', 'Agustus', '2024-10-13'),
(38, 'Penataan_Kepegawaian', 'Lupa absen', '19 Agustus_Merfinria12092024110721.pdf', 'Agustus', '2024-10-13'),
(39, 'Penataan_Kepegawaian', 'Lupa absen', '21 Agustus_Mami12092024111319.pdf', 'Agustus', '2024-10-13'),
(40, 'Penataan_Kepegawaian', 'Lupa absen', '22 Agustus_Allan12092024111048.pdf', 'Agustus', '2024-10-13'),
(41, 'Penataan_Kepegawaian', 'Lupa absen', '22 Agustus_Merfinria.pdf', 'Agustus', '2024-10-13'),
(42, 'Penataan_Kepegawaian', 'Lupa absen', '23 Agustus_Eka.pdf', 'Agustus', '2024-10-13'),
(43, 'Penataan_Kepegawaian', 'Lupa absen', '26 Agustus_Andarias.pdf', 'Agustus', '2024-10-13'),
(44, 'Penataan_Kepegawaian', 'Lupa absen', '26 Agustus_Sri.pdf', 'Agustus', '2024-10-13'),
(45, 'Penataan_Kepegawaian', 'Lupa absen', '27 Agustus_Dede.pdf', 'Agustus', '2024-10-13'),
(46, 'Penataan_Kepegawaian', 'Lupa absen', '30 Agustus_Andarias.pdf', 'Agustus', '2024-10-13'),
(47, 'Penataan_Kepegawaian', 'Lupa absen', '30 Agustus_Hendra.pdf', 'Agustus', '2024-10-13'),
(48, 'Penataan_Kepegawaian', 'Lupa absen', '16 April_Eka.pdf', 'April', '2024-10-13'),
(49, 'Penataan_Kepegawaian', 'Lupa absen', '18 April_Eka.pdf', 'April', '2024-10-13'),
(50, 'Penataan_Kepegawaian', 'Lupa absen', '18 April_Merfin.pdf', 'April', '2024-10-13'),
(51, 'Penataan_Kepegawaian', 'Lupa absen', '19 April_Dede12092024135025.pdf', 'April', '2024-10-13'),
(52, 'Penataan_Kepegawaian', 'Lupa absen', '20 April_Ismail.pdf', 'April', '2024-10-13'),
(53, 'Penataan_Kepegawaian', 'Lupa absen', '23 April_Aris.pdf', 'April', '2024-10-13'),
(54, 'Penataan_Kepegawaian', 'Lupa absen', '23 April_Hendra.pdf', 'April', '2024-10-13'),
(55, 'Penataan_Kepegawaian', 'Lupa absen', '23 April_Merfin.pdf', 'April', '2024-10-13'),
(56, 'Penataan_Kepegawaian', 'Lupa absen', '24 April_Eka.pdf', 'April', '2024-10-13'),
(57, 'Penataan_Kepegawaian', 'Lupa absen', '24 April_Nina12092024135139.pdf', 'April', '2024-10-13'),
(58, 'Penataan_Kepegawaian', 'Lupa absen', '24 April_Oktofianus12092024135217.pdf', 'April', '2024-10-13'),
(59, 'Penataan_Kepegawaian', 'Lupa absen', '25 April_Aris.pdf', 'April', '2024-10-13'),
(60, 'Penataan_Kepegawaian', 'Lupa absen', '01 Februari_Andarias.pdf', 'Februari', '2024-10-13'),
(61, 'Penataan_Kepegawaian', 'Lupa absen', '01 Februari_Hendra.pdf', 'Februari', '2024-10-13'),
(62, 'Penataan_Kepegawaian', 'Lupa absen', '1 Februari_Merfin.pdf', 'Februari', '2024-10-13'),
(63, 'Penataan_Kepegawaian', 'Lupa absen', '7 Februari_Mami.pdf', 'Februari', '2024-10-13'),
(64, 'Penataan_Kepegawaian', 'Lupa absen', '7 Februari_Merfin.pdf', 'Februari', '2024-10-13'),
(65, 'Penataan_Kepegawaian', 'Lupa absen', '12 Februari_Dede.pdf', 'Februari', '2024-10-13'),
(66, 'Penataan_Kepegawaian', 'Lupa absen', '12 Februari_Sri.pdf', 'Februari', '2024-10-13'),
(67, 'Penataan_Kepegawaian', 'Lupa absen', '16 Februari_Revi.pdf', 'Februari', '2024-10-13'),
(68, 'Penataan_Kepegawaian', 'Lupa absen', '19 Februari_Mami.pdf', 'Februari', '2024-10-13'),
(69, 'Penataan_Kepegawaian', 'Lupa absen', '29 Februari_Allan.pdf', 'Februari', '2024-10-13'),
(70, 'Penataan_Kepegawaian', 'Lupa absen', '29 Februari_Mami.pdf', 'Februari', '2024-10-13'),
(71, 'Penataan_Kepegawaian', 'Lupa absen', '29 Februari_Merfin.pdf', 'Februari', '2024-10-13'),
(72, 'Penataan_Kepegawaian', 'Lupa absen', '11 Januari_Almodad.pdf', 'Januari', '2024-12-05'),
(73, 'Penataan_Kepegawaian', 'Lupa absen', '15 Januari_Aris.pdf', 'Januari', '2024-12-05'),
(74, 'Penataan_Kepegawaian', 'Lupa absen', '19 Januari_Allan.pdf', 'Januari', '2024-12-05'),
(99, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '02 November_Revi.pdf', 'Cuti Sakit\r\n', '2024-12-05'),
(100, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '27 Agustus_Nina.pdf', 'Cuti Sakit\r\n', '2024-12-05'),
(101, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '27 November_Revi.pdf', 'Cuti Sakit\r\n', '2024-12-05'),
(102, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '03 November_Revi.pdf', 'Cuti Tahunan', '2024-10-13'),
(103, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '06 Agustus_Eka.pdf', 'Cuti Tahunan', '2024-10-13'),
(104, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '09 November_Revi.pdf', 'Cuti Tahunan', '2024-10-13'),
(105, 'Penataan_Kepegawaian', 'Ijin cuti pegawai', '10 Juni_Hendra.pdf', 'Cuti Tahunan', '2024-10-13'),
(107, 'Penataan_Kepegawaian', 'Lupa absen', '02 Agustus_Allan.pdf', 'Allan (agustus)', '2024-12-09'),
(108, 'Penyelenggaraan_Pelatihan', '', 'Daftar-peserta-Orientasi-PPPK-Kurikulum-Pengenalan-Nilai-dan-Etika-pada-Instansi-Pemerintah(.xlsx', 'Peserta', '2024-12-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`username`, `password`) VALUES
('abdul', 'bapekom'),
('abdul', 'bapekom'),
('user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
