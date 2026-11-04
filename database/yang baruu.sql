-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2026 at 06:19 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ukk_2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_guru`
--

CREATE TABLE `t_guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_guru`
--

INSERT INTO `t_guru` (`id`, `nip`, `nama`, `email`, `status_aktif`, `user_id`, `created_at`, `updated_at`) VALUES
(2, '100000000001', 'Wawan Kurniawan, S.Pd.I', 'wawan.kurniawan@gmail.com', 1, 2, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(3, '100000000002', 'Ai Nurhaydah, S.Pd', 'ai.nurhaydah@gmail.com', 1, 3, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(4, '100000000003', 'Maya Permata Endah, S.Pd', 'maya.permata.endah@gmail.com', 1, 4, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(5, '100000000004', 'Dody Jaenudin, S.Pd', 'dody.jaenudin@gmail.com', 1, 5, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(6, '100000000005', 'Dedi Kardiman, S.Pd', 'dedi.kardiman@gmail.com', 1, 6, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(7, '100000000006', 'Uca Musa Yusenda, S.Pd', 'uca.musa.yusenda@gmail.com', 1, 7, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(8, '100000000007', 'Drs. Ahmad Nur Mukhlis', 'ahmad.nur.mukhlis@gmail.com', 1, 8, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(9, '100000000008', 'Drs. Heri', 'heri@gmail.com', 1, 9, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(10, '100000000009', 'Asep Bastaman', 'asep.bastaman@gmail.com', 1, 10, '2026-10-19 07:50:59', '2026-10-19 07:50:59'),
(12, '100000000010', 'H. Encep Maemun, S.T., M.Pd', 'encep.maemun@gmail.com', 1, 12, '2026-11-03 01:23:26', '2026-11-03 01:23:26'),
(13, '100000000011', 'Opik', 'opik@gmail.com', 1, 13, '2026-11-03 01:24:00', '2026-11-03 01:24:00'),
(14, '100000000012', 'Ida Farida, S.Pd', 'ida.farida@gmail.com', 1, 14, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(15, '100000000013', 'Idah Mahmudah, S.Pd', 'idah.mahmudah@gmail.com', 1, 15, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(16, '100000000014', 'Drs. Muhamad Ali', 'muhamad.ali@gmail.com', 1, 16, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(17, '100000000015', 'Helmi Ali Akbar, S.Pd.I', 'helmi.ali.akbar@gmail.com', 1, 17, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(18, '100000000016', 'Syeni Suswarini, S.Pd', 'syeni.suswarini@gmail.com', 1, 18, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(19, '100000000017', 'Wiwid Yulianti, S.Pd', 'wiwid.yulianti@gmail.com', 1, 19, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(20, '100000000018', 'Ansor Muhajir, S.T', 'ansor.muhajir@gmail.com', 1, 20, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(21, '100000000019', 'Ogi Gaosun Gani, S.Pd.I', 'ogi.gaosun.gani@gmail.com', 1, 21, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(22, '100000000020', 'Sandi Mulyana, S.Pd', 'sandi.mulyana@gmail.com', 1, 22, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(23, '100000000021', 'Erna Suryani, S.Pd', 'erna.suryani@gmail.com', 1, 23, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(24, '100000000022', 'Ai Wahidah, S.Ag', 'ai.wahidah@gmail.com', 1, 24, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(25, '100000000023', 'Chandra Aditya Yusup, S.Pd', 'chandra.aditya.yusup@gmail.com', 1, 25, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(26, '100000000024', 'Arif Kusmawan, S.Pd', 'arif.kusmawan@gmail.com', 1, 26, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(27, '100000000025', 'Asep Taufiq Hidayat, S.Kom', 'asep.taufiq.hidayat@gmail.com', 1, 27, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(28, '100000000026', 'Rendy Ichsan Kusumah, S.T', 'rendy.ichsan.kusumah@gmail.com', 1, 28, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(29, '100000000027', 'Feri Rahmawan, S.Pd', 'feri.rahmawan@gmail.com', 1, 29, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(30, '100000000028', 'Ari Sandriana, S.Kom', 'ari.sandriana@gmail.com', 1, 30, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(31, '100000000029', 'Yaneu Nurdian, S.Pd., M.Pd', 'yaneu.nurdian@gmail.com', 1, 31, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(32, '100000000030', 'Ucu Muhammad Khoer N, S.Pd', 'ucu.muhammad.khoer.n@gmail.com', 1, 32, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(33, '100000000031', 'Mira Dwi Rahmawati, S.Ag', 'mira.dwi.rahmawati@gmail.com', 1, 33, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(34, '100000000032', 'Aldi Maulana, S.Pd', 'aldi.maulana@gmail.com', 1, 34, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(35, '100000000033', 'Eli Rosliah, S.Pd', 'eli.rosliah@gmail.com', 1, 35, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(36, '100000000034', 'Isni Nur Fitriani, S.Pd', 'isni.nur.fitriani@gmail.com', 1, 36, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(37, '100000000035', 'Aanisah Putri Nur Aini, S.Pd', 'aanisah.putri.nur.aini@gmail.com', 1, 37, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(38, '100000000036', 'Yusi Luthfiani, S.Sos.I', 'yusi.luthfiani@gmail.com', 1, 38, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(39, '100000000037', 'Lilis Rustandy Mawardi, S.Pd., M.Pd', 'lilis.rustandy.mawardi@gmail.com', 1, 39, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(40, '100000000038', 'Yusrin Noer Sabrina, S.Pd', 'yusrin.noer.sabrina@gmail.com', 1, 40, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(41, '100000000039', 'Senny Indayani, S.Pd', 'senny.indayani@gmail.com', 1, 41, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(42, '100000000040', 'Ilma Amalia, S.Pd', 'ilma.amalia@gmail.com', 1, 42, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(43, '100000000041', 'Alvira Sofwatunnisa, S.Pd', 'alvira.sofwatunnisa@gmail.com', 1, 43, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(44, '100000000042', 'Risna Andriyani, S.Pd', 'risna.andriyani@gmail.com', 1, 44, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(45, '100000000043', 'Dra. Tintin Noorhayati', 'tintin.noorhayati@gmail.com', 1, 45, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(46, '100000000044', 'Rizkia Fahira, S.Pd', 'rizkia.fahira@gmail.com', 1, 46, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(47, '100000000045', 'Frasetio', 'frasetio@gmail.com', 1, 47, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(48, '100000000046', 'Ratnaningsih Hati Aeni, S.Pd', 'ratnaningsih.hati.aeni@gmail.com', 1, 48, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(49, '100000000047', 'Dheny Darajatul Hasani, S.Pd', 'dheny.darajatul.hasani@gmail.com', 1, 49, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(50, '100000000048', 'Fahrullah, S.Pd', 'fahrullah@gmail.com', 1, 50, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(51, '100000000049', 'Aan Andriana, S.T', 'aan.andriana@gmail.com', 1, 51, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(52, '100000000050', 'Fitri Fauziah, S.T', 'fitri.fauziah@gmail.com', 1, 52, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(53, '100000000051', 'Nida Aulia, S.Pd', 'nida.aulia@gmail.com', 1, 53, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(54, '100000000052', 'Sri Nurrizki Putri Krisnadi, S.Pd', 'sri.nurrizki.putri.krisnadi@gmail.com', 1, 54, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(55, '100000000053', 'Riesy Putri Navia, S.Kom', 'riesy.putri.navia@gmail.com', 1, 55, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(56, '100000000054', 'Rurry Febriani Maryadi, S.Pd', 'rurry.febriani.maryadi@gmail.com', 1, 56, '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(57, '100000000055', 'Irvan Rizal, S.Pd', 'irvan.rizal@gmail.com', 1, 57, '2026-11-04 04:22:45', '2026-11-04 04:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas`
--

CREATE TABLE `t_kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`id`, `nama`, `tingkat`, `jurusan`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', 'X', 'IPA', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(2, 'X IPA 2', 'X', 'IPA', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(3, 'X IPS 1', 'X', 'IPS', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(4, 'X IPS 2', 'X', 'IPS', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(5, 'XI IPA 1', 'XI', 'IPA', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(6, 'XI IPA 2', 'XI', 'IPA', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(7, 'XI IPS 1', 'XI', 'IPS', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(8, 'XI IPS 2', 'XI', 'IPS', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(9, 'XII RPL 2', 'XII', 'Rekayasa Perangkat Lunak', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(10, 'XII RPL1', 'XII', 'Rekayasa Perangkat Lunak', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas_siswa`
--

CREATE TABLE `t_kelas_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kelas_siswa`
--

INSERT INTO `t_kelas_siswa` (`id`, `siswa_id`, `tahun_ajaran_id`, `kelas_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(2, 2, 2, 1, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(3, 3, 2, 1, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(4, 4, 2, 1, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(5, 5, 2, 1, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(6, 6, 2, 2, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(7, 7, 2, 2, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(8, 8, 2, 2, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(9, 9, 2, 2, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(10, 10, 2, 2, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(11, 11, 2, 3, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(12, 12, 2, 3, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(13, 13, 2, 3, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(14, 14, 2, 3, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(15, 15, 2, 3, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(16, 16, 2, 4, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(17, 17, 2, 4, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(18, 18, 2, 4, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(19, 19, 2, 4, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(20, 20, 2, 4, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(21, 21, 2, 5, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(22, 22, 2, 5, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(23, 23, 2, 5, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(24, 24, 2, 5, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(25, 25, 2, 5, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(26, 26, 2, 6, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(27, 27, 2, 6, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(28, 28, 2, 6, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(29, 29, 2, 6, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(30, 30, 2, 6, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(31, 31, 2, 7, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(32, 32, 2, 7, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(33, 33, 2, 7, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(34, 34, 2, 7, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(35, 35, 2, 7, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(36, 36, 2, 8, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(37, 37, 2, 8, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(38, 38, 2, 8, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(39, 39, 2, 8, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(40, 40, 2, 8, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(41, 41, 2, 9, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(42, 42, 2, 9, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(43, 43, 2, 9, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(44, 44, 2, 9, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(45, 45, 2, 9, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(46, 46, 2, 10, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(47, 47, 2, 10, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(48, 48, 2, 10, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(49, 49, 2, 10, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25'),
(50, 50, 2, 10, '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:25', '2026-09-23 02:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran`
--

CREATE TABLE `t_pelanggaran` (
  `id` int(11) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `poin` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pelanggaran`
--

INSERT INTO `t_pelanggaran` (`id`, `pelanggaran_kategori_id`, `kode`, `nama`, `poin`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 'D01', 'Terlambat masuk sekolah', 10, 'Siswa datang melewati batas waktu masuk sekolah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(2, 1, 'D02', 'Tidak mengikuti upacara', 10, 'Siswa tidak mengikuti upacara tanpa alasan yang sah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(3, 2, 'K01', 'Tidak memakai atribut lengkap', 5, 'Atribut seragam tidak lengkap.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(4, 2, 'K02', 'Seragam tidak sesuai ketentuan', 5, 'Seragam tidak sesuai ketentuan sekolah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(5, 3, 'H01', 'Alpa', 15, 'Tidak hadir tanpa keterangan.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(6, 3, 'H02', 'Izin melebihi ketentuan', 5, 'Ketidakhadiran dengan izin yang melebihi ketentuan.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(7, 4, 'P01', 'Berkata tidak sopan', 15, 'Menggunakan kata-kata tidak sopan di lingkungan sekolah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(8, 4, 'P02', 'Mengganggu teman saat pembelajaran', 10, 'Mengganggu kegiatan belajar mengajar.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(9, 4, 'P03', 'Berkelahi', 30, 'Terlibat perkelahian dengan siswa lain.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(10, 5, 'A01', 'Tidak mengerjakan tugas', 10, 'Tidak mengumpulkan tugas sesuai batas waktu.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(11, 5, 'A02', 'Mencontek', 20, 'Melakukan tindakan mencontek saat evaluasi.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(12, 1, 'D03', 'Keluar kelas tanpa izin', 10, 'Meninggalkan kelas tanpa izin guru.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(13, 2, 'K03', 'Rambut tidak sesuai ketentuan', 5, 'Potongan rambut tidak sesuai ketentuan sekolah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(14, 3, 'H03', 'Terlambat kembali setelah istirahat', 5, 'Kembali ke kelas setelah jam istirahat berakhir.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(15, 4, 'P04', 'Menggunakan HP saat pembelajaran', 10, 'Menggunakan telepon genggam tanpa izin saat pembelajaran.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran_kategori`
--

CREATE TABLE `t_pelanggaran_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pelanggaran_kategori`
--

INSERT INTO `t_pelanggaran_kategori` (`id`, `nama`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Kedisiplinan', 'Pelanggaran yang berkaitan dengan disiplin siswa.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(2, 'Kerapian', 'Pelanggaran terkait kerapian dan atribut sekolah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(3, 'Kehadiran', 'Pelanggaran terkait absensi dan kehadiran.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(4, 'Perilaku', 'Pelanggaran terkait perilaku siswa di lingkungan sekolah.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(5, 'Akademik', 'Pelanggaran yang berkaitan dengan ketertiban akademik.', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran_siswa`
--

CREATE TABLE `t_pelanggaran_siswa` (
  `id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama_siswa` varchar(150) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `nama_pelanggaran` varchar(150) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pelanggaran_siswa`
--

INSERT INTO `t_pelanggaran_siswa` (`id`, `tahun_ajaran_id`, `siswa_id`, `nama_siswa`, `kelas_id`, `nama_kelas`, `pelanggaran_id`, `nama_pelanggaran`, `pelanggaran_kategori_id`, `guru_id`, `nama_guru`, `tanggal`, `keterangan`, `poin`, `tindakan`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Ahmad Pratama', 1, 'X IPA 1', 1, 'Terlambat masuk sekolah', 1, 1, 'Agus Setiawan', '2026-08-01', 'Pelanggaran Terlambat masuk sekolah oleh Ahmad Pratama.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(2, 2, 2, 'Budi Saputra', 1, 'X IPA 1', 2, 'Tidak mengikuti upacara', 1, 1, 'Agus Setiawan', '2026-08-02', 'Pelanggaran Tidak mengikuti upacara oleh Budi Saputra.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(3, 2, 3, 'Citra Lestari', 1, 'X IPA 1', 3, 'Tidak memakai atribut lengkap', 2, 1, 'Agus Setiawan', '2026-08-03', 'Pelanggaran Tidak memakai atribut lengkap oleh Citra Lestari.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(4, 2, 4, 'Dimas Ramadhan', 1, 'X IPA 1', 4, 'Seragam tidak sesuai ketentuan', 2, 1, 'Agus Setiawan', '2026-08-04', 'Pelanggaran Seragam tidak sesuai ketentuan oleh Dimas Ramadhan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(5, 2, 5, 'Eka Permata', 1, 'X IPA 1', 5, 'Alpa', 3, 1, 'Agus Setiawan', '2026-08-05', 'Pelanggaran Alpa oleh Eka Permata.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(6, 2, 6, 'Fajar Setiawan', 2, 'X IPA 2', 6, 'Izin melebihi ketentuan', 3, 2, 'Wawan Kurniawan, S.Pd.I', '2026-08-06', 'Pelanggaran Izin melebihi ketentuan oleh Fajar Setiawan.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(7, 2, 7, 'Gilang Maulana', 2, 'X IPA 2', 7, 'Berkata tidak sopan', 4, 2, 'Wawan Kurniawan, S.Pd.I', '2026-08-07', 'Pelanggaran Berkata tidak sopan oleh Gilang Maulana.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(8, 2, 8, 'Hana Putri', 2, 'X IPA 2', 8, 'Mengganggu teman saat pembelajaran', 4, 2, 'Wawan Kurniawan, S.Pd.I', '2026-08-08', 'Pelanggaran Mengganggu teman saat pembelajaran oleh Hana Putri.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(9, 2, 9, 'Intan Kurniawan', 2, 'X IPA 2', 9, 'Berkelahi', 4, 2, 'Wawan Kurniawan, S.Pd.I', '2026-08-09', 'Pelanggaran Berkelahi oleh Intan Kurniawan.', 30, 'Pembinaan dan pemanggilan orang tua', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(10, 2, 10, 'Joko Sari', 2, 'X IPA 2', 10, 'Tidak mengerjakan tugas', 5, 2, 'Wawan Kurniawan, S.Pd.I', '2026-08-10', 'Pelanggaran Tidak mengerjakan tugas oleh Joko Sari.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(11, 2, 11, 'Kiki Pratama', 3, 'X IPS 1', 11, 'Mencontek', 5, 3, 'Ai Nurhaydah, S.Pd', '2026-08-11', 'Pelanggaran Mencontek oleh Kiki Pratama.', 20, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(12, 2, 12, 'Laila Saputra', 3, 'X IPS 1', 12, 'Keluar kelas tanpa izin', 1, 3, 'Ai Nurhaydah, S.Pd', '2026-08-12', 'Pelanggaran Keluar kelas tanpa izin oleh Laila Saputra.', 10, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(13, 2, 13, 'Maya Lestari', 3, 'X IPS 1', 13, 'Rambut tidak sesuai ketentuan', 2, 3, 'Ai Nurhaydah, S.Pd', '2026-08-13', 'Pelanggaran Rambut tidak sesuai ketentuan oleh Maya Lestari.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(14, 2, 14, 'Nanda Ramadhan', 3, 'X IPS 1', 14, 'Terlambat kembali setelah istirahat', 3, 3, 'Ai Nurhaydah, S.Pd', '2026-08-14', 'Pelanggaran Terlambat kembali setelah istirahat oleh Nanda Ramadhan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(15, 2, 15, 'Oki Permata', 3, 'X IPS 1', 15, 'Menggunakan HP saat pembelajaran', 4, 3, 'Ai Nurhaydah, S.Pd', '2026-08-15', 'Pelanggaran Menggunakan HP saat pembelajaran oleh Oki Permata.', 10, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(16, 2, 16, 'Putri Setiawan', 4, 'X IPS 2', 1, 'Terlambat masuk sekolah', 1, 4, 'Maya Permata Endah, S.Pd', '2026-08-16', 'Pelanggaran Terlambat masuk sekolah oleh Putri Setiawan.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(17, 2, 17, 'Raka Maulana', 4, 'X IPS 2', 2, 'Tidak mengikuti upacara', 1, 4, 'Maya Permata Endah, S.Pd', '2026-08-17', 'Pelanggaran Tidak mengikuti upacara oleh Raka Maulana.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(18, 2, 18, 'Salsa Putri', 4, 'X IPS 2', 3, 'Tidak memakai atribut lengkap', 2, 4, 'Maya Permata Endah, S.Pd', '2026-08-18', 'Pelanggaran Tidak memakai atribut lengkap oleh Salsa Putri.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(19, 2, 19, 'Taufik Kurniawan', 4, 'X IPS 2', 4, 'Seragam tidak sesuai ketentuan', 2, 4, 'Maya Permata Endah, S.Pd', '2026-08-19', 'Pelanggaran Seragam tidak sesuai ketentuan oleh Taufik Kurniawan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(20, 2, 20, 'Vina Sari', 4, 'X IPS 2', 5, 'Alpa', 3, 4, 'Maya Permata Endah, S.Pd', '2026-08-20', 'Pelanggaran Alpa oleh Vina Sari.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(21, 2, 21, 'Wahyu Pratama', 5, 'XI IPA 1', 6, 'Izin melebihi ketentuan', 3, 5, 'Dody Jaenudin, S.Pd', '2026-08-21', 'Pelanggaran Izin melebihi ketentuan oleh Wahyu Pratama.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(22, 2, 22, 'Yuni Saputra', 5, 'XI IPA 1', 7, 'Berkata tidak sopan', 4, 5, 'Dody Jaenudin, S.Pd', '2026-08-22', 'Pelanggaran Berkata tidak sopan oleh Yuni Saputra.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(23, 2, 23, 'Zaki Lestari', 5, 'XI IPA 1', 8, 'Mengganggu teman saat pembelajaran', 4, 5, 'Dody Jaenudin, S.Pd', '2026-08-23', 'Pelanggaran Mengganggu teman saat pembelajaran oleh Zaki Lestari.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(24, 2, 24, 'Alya Ramadhan', 5, 'XI IPA 1', 9, 'Berkelahi', 4, 5, 'Dody Jaenudin, S.Pd', '2026-08-24', 'Pelanggaran Berkelahi oleh Alya Ramadhan.', 30, 'Pembinaan dan pemanggilan orang tua', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(25, 2, 25, 'Bagas Permata', 5, 'XI IPA 1', 10, 'Tidak mengerjakan tugas', 5, 5, 'Dody Jaenudin, S.Pd', '2026-08-25', 'Pelanggaran Tidak mengerjakan tugas oleh Bagas Permata.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(26, 2, 26, 'Cahya Setiawan', 6, 'XI IPA 2', 11, 'Mencontek', 5, 6, 'Dedi Kardiman, S.Pd', '2026-08-26', 'Pelanggaran Mencontek oleh Cahya Setiawan.', 20, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(27, 2, 27, 'Daffa Maulana', 6, 'XI IPA 2', 12, 'Keluar kelas tanpa izin', 1, 6, 'Dedi Kardiman, S.Pd', '2026-08-27', 'Pelanggaran Keluar kelas tanpa izin oleh Daffa Maulana.', 10, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(28, 2, 28, 'Elsa Putri', 6, 'XI IPA 2', 13, 'Rambut tidak sesuai ketentuan', 2, 6, 'Dedi Kardiman, S.Pd', '2026-08-28', 'Pelanggaran Rambut tidak sesuai ketentuan oleh Elsa Putri.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(29, 2, 29, 'Farhan Kurniawan', 6, 'XI IPA 2', 14, 'Terlambat kembali setelah istirahat', 3, 6, 'Dedi Kardiman, S.Pd', '2026-08-01', 'Pelanggaran Terlambat kembali setelah istirahat oleh Farhan Kurniawan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(30, 2, 30, 'Gita Sari', 6, 'XI IPA 2', 15, 'Menggunakan HP saat pembelajaran', 4, 6, 'Dedi Kardiman, S.Pd', '2026-08-02', 'Pelanggaran Menggunakan HP saat pembelajaran oleh Gita Sari.', 10, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(31, 2, 31, 'Hendra Pratama', 7, 'XI IPS 1', 1, 'Terlambat masuk sekolah', 1, 7, 'Uca Musa Yusenda, S.Pd', '2026-08-03', 'Pelanggaran Terlambat masuk sekolah oleh Hendra Pratama.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(32, 2, 32, 'Indah Saputra', 7, 'XI IPS 1', 2, 'Tidak mengikuti upacara', 1, 7, 'Uca Musa Yusenda, S.Pd', '2026-08-04', 'Pelanggaran Tidak mengikuti upacara oleh Indah Saputra.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(33, 2, 33, 'Jefri Lestari', 7, 'XI IPS 1', 3, 'Tidak memakai atribut lengkap', 2, 7, 'Uca Musa Yusenda, S.Pd', '2026-08-05', 'Pelanggaran Tidak memakai atribut lengkap oleh Jefri Lestari.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(34, 2, 34, 'Karin Ramadhan', 7, 'XI IPS 1', 4, 'Seragam tidak sesuai ketentuan', 2, 7, 'Uca Musa Yusenda, S.Pd', '2026-08-06', 'Pelanggaran Seragam tidak sesuai ketentuan oleh Karin Ramadhan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(35, 2, 35, 'Lukman Permata', 7, 'XI IPS 1', 5, 'Alpa', 3, 7, 'Uca Musa Yusenda, S.Pd', '2026-08-07', 'Pelanggaran Alpa oleh Lukman Permata.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(36, 2, 36, 'Mila Setiawan', 8, 'XI IPS 2', 6, 'Izin melebihi ketentuan', 3, 8, 'Drs. Ahmad Nur Mukhlis', '2026-08-08', 'Pelanggaran Izin melebihi ketentuan oleh Mila Setiawan.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(37, 2, 37, 'Naufal Maulana', 8, 'XI IPS 2', 7, 'Berkata tidak sopan', 4, 8, 'Drs. Ahmad Nur Mukhlis', '2026-08-09', 'Pelanggaran Berkata tidak sopan oleh Naufal Maulana.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(38, 2, 38, 'Olivia Putri', 8, 'XI IPS 2', 8, 'Mengganggu teman saat pembelajaran', 4, 8, 'Drs. Ahmad Nur Mukhlis', '2026-08-10', 'Pelanggaran Mengganggu teman saat pembelajaran oleh Olivia Putri.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(39, 2, 39, 'Rizky Kurniawan', 8, 'XI IPS 2', 9, 'Berkelahi', 4, 8, 'Drs. Ahmad Nur Mukhlis', '2026-08-11', 'Pelanggaran Berkelahi oleh Rizky Kurniawan.', 30, 'Pembinaan dan pemanggilan orang tua', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(40, 2, 40, 'Sinta Sari', 8, 'XI IPS 2', 10, 'Tidak mengerjakan tugas', 5, 8, 'Drs. Ahmad Nur Mukhlis', '2026-08-12', 'Pelanggaran Tidak mengerjakan tugas oleh Sinta Sari.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(41, 2, 41, 'Teguh Pratama', 9, 'XII IPA 1', 11, 'Mencontek', 5, 9, 'Drs. Heri', '2026-08-13', 'Pelanggaran Mencontek oleh Teguh Pratama.', 20, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(42, 2, 42, 'Ulfa Saputra', 9, 'XII IPA 1', 12, 'Keluar kelas tanpa izin', 1, 9, 'Drs. Heri', '2026-08-14', 'Pelanggaran Keluar kelas tanpa izin oleh Ulfa Saputra.', 10, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(43, 2, 43, 'Vito Lestari', 9, 'XII IPA 1', 13, 'Rambut tidak sesuai ketentuan', 2, 9, 'Drs. Heri', '2026-08-15', 'Pelanggaran Rambut tidak sesuai ketentuan oleh Vito Lestari.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(44, 2, 44, 'Wulan Ramadhan', 9, 'XII IPA 1', 14, 'Terlambat kembali setelah istirahat', 3, 9, 'Drs. Heri', '2026-08-16', 'Pelanggaran Terlambat kembali setelah istirahat oleh Wulan Ramadhan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(45, 2, 45, 'Yusuf Permata', 9, 'XII IPA 1', 15, 'Menggunakan HP saat pembelajaran', 4, 9, 'Drs. Heri', '2026-08-17', 'Pelanggaran Menggunakan HP saat pembelajaran oleh Yusuf Permata.', 10, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(46, 2, 46, 'Zahra Setiawan', 10, 'XII IPS 1', 1, 'Terlambat masuk sekolah', 1, 10, 'Asep Bastaman', '2026-08-18', 'Pelanggaran Terlambat masuk sekolah oleh Zahra Setiawan.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(47, 2, 47, 'Ardi Maulana', 10, 'XII IPS 1', 2, 'Tidak mengikuti upacara', 1, 10, 'Asep Bastaman', '2026-08-19', 'Pelanggaran Tidak mengikuti upacara oleh Ardi Maulana.', 10, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(48, 2, 48, 'Bella Putri', 10, 'XII IPS 1', 3, 'Tidak memakai atribut lengkap', 2, 10, 'Asep Bastaman', '2026-08-20', 'Pelanggaran Tidak memakai atribut lengkap oleh Bella Putri.', 5, 'Pembinaan dan teguran', 'proses', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(49, 2, 49, 'Dani Kurniawan', 10, 'XII IPS 1', 4, 'Seragam tidak sesuai ketentuan', 2, 10, 'Asep Bastaman', '2026-08-21', 'Pelanggaran Seragam tidak sesuai ketentuan oleh Dani Kurniawan.', 5, 'Pembinaan dan teguran', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(50, 2, 50, 'Nia Sari', 10, 'XII IPS 1', 5, 'Alpa', 3, 10, 'Asep Bastaman', '2026-08-22', 'Pelanggaran Alpa oleh Nia Sari.', 15, 'Pemanggilan wali kelas', 'selesai', '2026-09-23 02:39:57', '2026-09-23 02:39:57'),
(51, 2, 2, 'Budi Saputra', 1, 'X IPA 1', 5, 'Alpa', 3, 2, 'Wawan Kurniawan, S.Pd.I', '2026-11-04', '', 15, 'Peneguran', 'Sudah Ditindak', '2026-11-04 02:40:34', '2026-11-04 02:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `t_siswa`
--

CREATE TABLE `t_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_siswa`
--

INSERT INTO `t_siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '2026001', 'NIM2026001', 'Ahmad Pratama', 'L', '2008-04-06', 'Jl. Pendidikan No. 1, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(2, '2026002', 'NIM2026002', 'Budi Saputra', 'P', '2009-07-11', 'Jl. Pendidikan No. 2, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(3, '2026003', 'NIM2026003', 'Citra Lestari', 'L', '2010-10-16', 'Jl. Pendidikan No. 3, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(4, '2026004', 'NIM2026004', 'Dimas Ramadhan', 'P', '2007-01-21', 'Jl. Pendidikan No. 4, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(5, '2026005', 'NIM2026005', 'Eka Permata', 'L', '2008-04-26', 'Jl. Pendidikan No. 5, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(6, '2026006', 'NIM2026006', 'Fajar Setiawan', 'P', '2009-07-04', 'Jl. Pendidikan No. 6, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(7, '2026007', 'NIM2026007', 'Gilang Maulana', 'L', '2010-10-09', 'Jl. Pendidikan No. 7, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(8, '2026008', 'NIM2026008', 'Hana Putri', 'P', '2007-01-14', 'Jl. Pendidikan No. 8, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(9, '2026009', 'NIM2026009', 'Intan Kurniawan', 'L', '2008-04-19', 'Jl. Pendidikan No. 9, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(10, '2026010', 'NIM2026010', 'Joko Sari', 'P', '2009-07-24', 'Jl. Pendidikan No. 10, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(11, '2026011', 'NIM2026011', 'Kiki Pratama', 'L', '2010-10-02', 'Jl. Pendidikan No. 11, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(12, '2026012', 'NIM2026012', 'Laila Saputra', 'P', '2007-01-07', 'Jl. Pendidikan No. 12, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(13, '2026013', 'NIM2026013', 'Maya Lestari', 'L', '2008-04-12', 'Jl. Pendidikan No. 13, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(14, '2026014', 'NIM2026014', 'Nanda Ramadhan', 'P', '2009-07-17', 'Jl. Pendidikan No. 14, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(15, '2026015', 'NIM2026015', 'Oki Permata', 'L', '2010-10-22', 'Jl. Pendidikan No. 15, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(16, '2026016', 'NIM2026016', 'Putri Setiawan', 'P', '2007-01-27', 'Jl. Pendidikan No. 16, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(17, '2026017', 'NIM2026017', 'Raka Maulana', 'L', '2008-04-05', 'Jl. Pendidikan No. 17, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(18, '2026018', 'NIM2026018', 'Salsa Putri', 'P', '2009-07-10', 'Jl. Pendidikan No. 18, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(19, '2026019', 'NIM2026019', 'Taufik Kurniawan', 'L', '2010-10-15', 'Jl. Pendidikan No. 19, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(20, '2026020', 'NIM2026020', 'Vina Sari', 'P', '2007-01-20', 'Jl. Pendidikan No. 20, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(21, '2026021', 'NIM2026021', 'Wahyu Pratama', 'L', '2008-04-25', 'Jl. Pendidikan No. 21, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(22, '2026022', 'NIM2026022', 'Yuni Saputra', 'P', '2009-07-03', 'Jl. Pendidikan No. 22, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(23, '2026023', 'NIM2026023', 'Zaki Lestari', 'L', '2010-10-08', 'Jl. Pendidikan No. 23, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(24, '2026024', 'NIM2026024', 'Alya Ramadhan', 'P', '2007-01-13', 'Jl. Pendidikan No. 24, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(25, '2026025', 'NIM2026025', 'Bagas Permata', 'L', '2008-04-18', 'Jl. Pendidikan No. 25, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(26, '2026026', 'NIM2026026', 'Cahya Setiawan', 'P', '2009-07-23', 'Jl. Pendidikan No. 26, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(27, '2026027', 'NIM2026027', 'Daffa Maulana', 'L', '2010-10-01', 'Jl. Pendidikan No. 27, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(28, '2026028', 'NIM2026028', 'Elsa Putri', 'P', '2007-01-06', 'Jl. Pendidikan No. 28, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(29, '2026029', 'NIM2026029', 'Farhan Kurniawan', 'L', '2008-04-11', 'Jl. Pendidikan No. 29, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(30, '2026030', 'NIM2026030', 'Gita Sari', 'P', '2009-07-16', 'Jl. Pendidikan No. 30, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(31, '2026031', 'NIM2026031', 'Hendra Pratama', 'L', '2010-10-21', 'Jl. Pendidikan No. 31, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(32, '2026032', 'NIM2026032', 'Indah Saputra', 'P', '2007-01-26', 'Jl. Pendidikan No. 32, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(33, '2026033', 'NIM2026033', 'Jefri Lestari', 'L', '2008-04-04', 'Jl. Pendidikan No. 33, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(34, '2026034', 'NIM2026034', 'Karin Ramadhan', 'P', '2009-07-09', 'Jl. Pendidikan No. 34, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(35, '2026035', 'NIM2026035', 'Lukman Permata', 'L', '2010-10-14', 'Jl. Pendidikan No. 35, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(36, '2026036', 'NIM2026036', 'Mila Setiawan', 'P', '2007-01-19', 'Jl. Pendidikan No. 36, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(37, '2026037', 'NIM2026037', 'Naufal Maulana', 'L', '2008-04-24', 'Jl. Pendidikan No. 37, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(38, '2026038', 'NIM2026038', 'Olivia Putri', 'P', '2009-07-02', 'Jl. Pendidikan No. 38, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(39, '2026039', 'NIM2026039', 'Rizky Kurniawan', 'L', '2010-10-07', 'Jl. Pendidikan No. 39, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(40, '2026040', 'NIM2026040', 'Sinta Sari', 'P', '2007-01-12', 'Jl. Pendidikan No. 40, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(41, '2026041', 'NIM2026041', 'Teguh Pratama', 'L', '2008-04-17', 'Jl. Pendidikan No. 41, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(42, '2026042', 'NIM2026042', 'Ulfa Saputra', 'P', '2009-07-22', 'Jl. Pendidikan No. 42, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(43, '2026043', 'NIM2026043', 'Vito Lestari', 'L', '2010-10-27', 'Jl. Pendidikan No. 43, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(44, '2026044', 'NIM2026044', 'Wulan Ramadhan', 'P', '2007-01-05', 'Jl. Pendidikan No. 44, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(45, '2026045', 'NIM2026045', 'Yusuf Permata', 'L', '2008-04-10', 'Jl. Pendidikan No. 45, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(46, '2026046', 'NIM2026046', 'Zahra Setiawan', 'P', '2009-07-15', 'Jl. Pendidikan No. 46, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(47, '2026047', 'NIM2026047', 'Ardi Maulana', 'L', '2010-10-20', 'Jl. Pendidikan No. 47, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(48, '2026048', 'NIM2026048', 'Bella Putri', 'P', '2007-01-25', 'Jl. Pendidikan No. 48, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(49, '2026049', 'NIM2026049', 'Dani Kurniawan', 'L', '2008-04-03', 'Jl. Pendidikan No. 49, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(50, '2026050', 'NIM2026050', 'Nia Sari', 'P', '2009-07-08', 'Jl. Pendidikan No. 50, Tasikmalaya', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(51, '102410544', '0092610001', 'ADITTIA NUR LANTIP', 'L', '2009-01-12', 'Jl. Cihideung No. 12, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(52, '102410545', '0092610002', 'AGNIA ROSYA NOERIILLAH', 'P', '2009-03-21', 'Jl. Nagarawangi No. 15, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(53, '102410546', '0092610003', 'ANISA AMIRULLA', 'P', '2009-05-14', 'Jl. Tentara Pelajar No. 8, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(54, '102410547', '0092610004', 'ARADEA KANDI', 'P', '2009-07-09', 'Jl. Sutisna Senjaya No. 21, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(55, '102410548', '0092610005', 'AREA DIESA OKMALELIZA', 'P', '2009-02-17', 'Jl. RE Martadinata No. 10, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(56, '102410549', '0092610006', 'FITRI NUR SYAMI', 'P', '2009-04-25', 'Jl. HZ Mustofa No. 17, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(57, '102410550', '0092610007', 'JUNITA PUTRI NUR RAHMAN', 'P', '2009-06-11', 'Jl. Ir. H. Juanda No. 5, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(58, '102410551', '0092610008', 'MOHAMMAD ATALARIK ALI SYAHBANA', 'L', '2009-08-19', 'Jl. Perintis Kemerdekaan No. 14, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(59, '102410552', '0092610009', 'MUHAMAD FAHRIL FAHRUROZI', 'L', '2009-09-13', 'Jl. BKR No. 9, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(60, '102410750', '0092610010', 'MUHAMMAD ADNAN SYAEFUL ISLAMI', 'L', '2009-10-22', 'Jl. Siliwangi No. 18, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(61, '102410553', '0092610011', 'MUHAMMAD ZAHRU AQILLA FIKRI', 'L', '2009-11-16', 'Jl. Pancasila No. 7, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(62, '102410554', '0092610012', 'NADIA ZULFA SORAYA', 'P', '2009-12-05', 'Jl. Galunggung No. 20, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(63, '102410555', '0092610013', 'NAZRIL ILHAM', 'L', '2009-03-08', 'Jl. Letjen Mashudi No. 11, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(64, '102410556', '0092610014', 'PUSPITA DEWI', 'P', '2009-04-19', 'Jl. Ampera No. 6, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(65, '102410558', '0092610015', 'RAKHA MUHAMMAD HAYKAL', 'L', '2009-05-27', 'Jl. Paseh No. 13, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(66, '102410559', '0092610016', 'RANI MEILANI', 'P', '2009-06-15', 'Jl. Cieunteung No. 4, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(67, '102410560', '0092610017', 'REIHAN MUZAKI', 'L', '2009-07-23', 'Jl. Sambong No. 16, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(68, '102410561', '0092610018', 'RESA JULIANSAH', 'L', '2009-08-04', 'Jl. Gunung Sabeulah No. 3, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(69, '102410562', '0092610019', 'RIZKI PERMATA SUGIANTO', 'L', '2009-09-18', 'Jl. Cikalang No. 19, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(70, '102410563', '0092610020', 'SAHIRA FIRAJ', 'P', '2009-10-07', 'Jl. Mangkubumi No. 22, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(71, '102410564', '0092610021', 'SENDI MARDIAN', 'L', '2009-11-24', 'Jl. Sukarindik No. 2, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(72, '102410755', '0092610022', 'SHAHAIDAN NIZZAR', 'L', '2009-12-12', 'Jl. Tamansari No. 25, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(73, '102410565', '0092610023', 'SHERLY SATRIANI', 'P', '2009-02-28', 'Jl. Awipari No. 23, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(74, '102410566', '0092610024', 'SOFI NURJANAH', 'P', '2009-03-16', 'Jl. Sukalaya No. 24, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(75, '102410567', '0092610025', 'SURAIYA SALSABILA AZZAHRA', 'P', '2009-04-06', 'Jl. Kawalu No. 26, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(76, '102410568', '0092610026', 'TONI ANTONIO', 'L', '2009-05-20', 'Jl. Cibeureum No. 27, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `t_tahun_ajaran`
--

CREATE TABLE `t_tahun_ajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_tahun_ajaran`
--

INSERT INTO `t_tahun_ajaran` (`id`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '2025/2026', '2025-07-14', '2026-06-30', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(2, '2026/2027', '2026-07-13', '2027-06-30', 1, '2026-09-23 02:38:24', '2026-09-23 02:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Wawan Kurniawan, S.Pd.I', 'wawan.kurniawan@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(3, 'Ai Nurhaydah, S.Pd', 'ai.nurhaydah@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(4, 'Maya Permata Endah, S.Pd', 'maya.permata.endah@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(5, 'Dody Jaenudin, S.Pd', 'dody.jaenudin@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(6, 'Dedi Kardiman, S.Pd', 'dedi.kardiman@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(7, 'Uca Musa Yusenda, S.Pd', 'uca.musa.yusenda@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(8, 'Drs. Ahmad Nur Mukhlis', 'ahmad.nur.mukhlis@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(9, 'Drs. Heri', 'heri@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(10, 'Asep Bastaman', 'asep.bastaman@gmail.com', '2026-01-01 01:00:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(11, 'Administrator', 'admin@gmail.com', '2026-01-01 01:00:00', '$2y$10$58TDXYEi0KPrIMgJPYB5OOv8UOHdjfdA23f9JqzxVCNnnojFWCHAm', '', 'admin', '2026-09-23 02:37:22', '2026-09-23 02:37:22'),
(12, 'H. Encep Maemun, S.T., M.Pd', 'encep.maemun@gmail.com', '2026-11-03 01:23:26', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-03 01:23:26', '2026-11-03 01:23:26'),
(13, 'Opik', 'opik@gmail.com', '2026-11-03 01:24:00', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-03 01:24:00', '2026-11-03 01:24:00'),
(14, 'Ida Farida, S.Pd', 'ida.farida@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(15, 'Idah Mahmudah, S.Pd', 'idah.mahmudah@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(16, 'Drs. Muhamad Ali', 'muhamad.ali@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(17, 'Helmi Ali Akbar, S.Pd.I', 'helmi.ali.akbar@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(18, 'Syeni Suswarini, S.Pd', 'syeni.suswarini@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(19, 'Wiwid Yulianti, S.Pd', 'wiwid.yulianti@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(20, 'Ansor Muhajir, S.T', 'ansor.muhajir@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(21, 'Ogi Gaosun Gani, S.Pd.I', 'ogi.gaosun.gani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(22, 'Sandi Mulyana, S.Pd', 'sandi.mulyana@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(23, 'Erna Suryani, S.Pd', 'erna.suryani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(24, 'Ai Wahidah, S.Ag', 'ai.wahidah@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(25, 'Chandra Aditya Yusup, S.Pd', 'chandra.aditya.yusup@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(26, 'Arif Kusmawan, S.Pd', 'arif.kusmawan@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(27, 'Asep Taufiq Hidayat, S.Kom', 'asep.taufiq.hidayat@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(28, 'Rendy Ichsan Kusumah, S.T', 'rendy.ichsan.kusumah@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(29, 'Feri Rahmawan, S.Pd', 'feri.rahmawan@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(30, 'Ari Sandriana, S.Kom', 'ari.sandriana@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(31, 'Yaneu Nurdian, S.Pd., M.Pd', 'yaneu.nurdian@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(32, 'Ucu Muhammad Khoer N, S.Pd', 'ucu.muhammad.khoer.n@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(33, 'Mira Dwi Rahmawati, S.Ag', 'mira.dwi.rahmawati@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(34, 'Aldi Maulana, S.Pd', 'aldi.maulana@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(35, 'Eli Rosliah, S.Pd', 'eli.rosliah@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(36, 'Isni Nur Fitriani, S.Pd', 'isni.nur.fitriani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(37, 'Aanisah Putri Nur Aini, S.Pd', 'aanisah.putri.nur.aini@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(38, 'Yusi Luthfiani, S.Sos.I', 'yusi.luthfiani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(39, 'Lilis Rustandy Mawardi, S.Pd., M.Pd', 'lilis.rustandy.mawardi@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(40, 'Yusrin Noer Sabrina, S.Pd', 'yusrin.noer.sabrina@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(41, 'Senny Indayani, S.Pd', 'senny.indayani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(42, 'Ilma Amalia, S.Pd', 'ilma.amalia@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(43, 'Alvira Sofwatunnisa, S.Pd', 'alvira.sofwatunnisa@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(44, 'Risna Andriyani, S.Pd', 'risna.andriyani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(45, 'Dra. Tintin Noorhayati', 'tintin.noorhayati@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(46, 'Rizkia Fahira, S.Pd', 'rizkia.fahira@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(47, 'Frasetio', 'frasetio@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(48, 'Ratnaningsih Hati Aeni, S.Pd', 'ratnaningsih.hati.aeni@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(49, 'Dheny Darajatul Hasani, S.Pd', 'dheny.darajatul.hasani@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(50, 'Fahrullah, S.Pd', 'fahrullah@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(51, 'Aan Andriana, S.T', 'aan.andriana@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(52, 'Fitri Fauziah, S.T', 'fitri.fauziah@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(53, 'Nida Aulia, S.Pd', 'nida.aulia@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(54, 'Sri Nurrizki Putri Krisnadi, S.Pd', 'sri.nurrizki.putri.krisnadi@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(55, 'Riesy Putri Navia, S.Kom', 'riesy.putri.navia@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(56, 'Rurry Febriani Maryadi, S.Pd', 'rurry.febriani.maryadi@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45'),
(57, 'Irvan Rizal, S.Pd', 'irvan.rizal@gmail.com', '2026-11-04 04:22:45', '$2y$12$xmgSc6N67agxcBlYNNPOmuvcY.68KCnocas2vzGkvauWV68B8Z1pK', '', 'guru', '2026-11-04 04:22:45', '2026-11-04 04:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_wali_kelas`
--

CREATE TABLE `t_wali_kelas` (
  `id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_wali_kelas`
--

INSERT INTO `t_wali_kelas` (`id`, `tahun_ajaran_id`, `kelas_id`, `guru_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(12, 2, 10, 30, '2026-12-07', '2027-12-06', 1, '2026-11-04 04:29:26', '2026-11-04 04:29:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`);

--
-- Indexes for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggaran_kategori_id` (`pelanggaran_kategori_id`);

--
-- Indexes for table `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `pelanggaran_id` (`pelanggaran_id`),
  ADD KEY `pelanggaran_kategori_id` (`pelanggaran_kategori_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_guru`
--
ALTER TABLE `t_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_guru`
--
ALTER TABLE `t_guru`
  ADD CONSTRAINT `t_guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`);

--
-- Constraints for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD CONSTRAINT `t_kelas_siswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`),
  ADD CONSTRAINT `t_kelas_siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`),
  ADD CONSTRAINT `t_kelas_siswa_ibfk_3` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`);

--
-- Constraints for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD CONSTRAINT `t_pelanggaran_ibfk_1` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
