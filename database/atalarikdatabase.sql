-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 04:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`id`, `nama`, `tingkat`, `jurusan`, `status_aktif`, `created_at`, `updated_at`) VALUES
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kelas_siswa`
--

INSERT INTO `t_kelas_siswa` (`id`, `siswa_id`, `tahun_ajaran_id`, `kelas_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(51, 51, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-05 02:21:58', '2026-11-05 02:21:58'),
(52, 51, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-05 02:22:22', '2026-11-05 02:22:22'),
(53, 51, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-05 02:25:37', '2026-11-05 02:25:37'),
(54, 78, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(55, 79, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(56, 80, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(57, 81, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(58, 82, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(59, 83, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(60, 84, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(61, 85, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(62, 86, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(63, 87, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(64, 88, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(65, 89, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(66, 90, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(67, 91, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(68, 92, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(69, 93, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(70, 94, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(71, 95, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(72, 96, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(73, 97, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(74, 98, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(75, 99, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(76, 100, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(77, 101, 4, 10, '2026-07-13', '2027-06-30', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(85, 52, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(87, 53, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(89, 54, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(91, 55, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(93, 56, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(95, 57, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(97, 58, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(99, 59, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(101, 60, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(103, 61, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(105, 62, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(107, 63, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(109, 64, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(111, 65, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(113, 66, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(115, 67, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(117, 68, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(119, 69, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(121, 70, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(123, 71, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(125, 72, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(127, 73, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(129, 74, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(131, 75, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(133, 76, 4, 9, '2026-07-13', '2027-06-30', 1, '2026-11-09 06:25:38', '2026-11-09 06:25:38'),
(148, 52, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(149, 53, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(150, 54, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(151, 55, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(152, 56, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(153, 57, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(154, 58, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(155, 59, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(156, 60, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(157, 61, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(158, 62, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(159, 63, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(160, 64, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(161, 65, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(162, 66, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(163, 67, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(164, 68, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(165, 69, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(166, 70, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(167, 71, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(168, 72, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(169, 73, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(170, 74, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(171, 75, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20'),
(172, 76, 4, 9, '2026-12-04', '2027-12-04', 1, '2026-11-09 06:33:20', '2026-11-09 06:33:20');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pelanggaran_siswa`
--

INSERT INTO `t_pelanggaran_siswa` (`id`, `tahun_ajaran_id`, `siswa_id`, `nama_siswa`, `kelas_id`, `nama_kelas`, `pelanggaran_id`, `nama_pelanggaran`, `pelanggaran_kategori_id`, `guru_id`, `nama_guru`, `tanggal`, `keterangan`, `poin`, `tindakan`, `status`, `created_at`, `updated_at`) VALUES
(52, 4, 51, 'ADITTIA NUR LANTIP', 9, 'XII RPL 2', 5, 'Alpa', 3, 30, 'Ari Sandriana, S.Kom', '2026-11-05', 'bolos', 15, 'pemanggilan orang tua', 'Sudah Ditindak', '2026-11-05 02:36:19', '2026-11-05 02:36:19'),
(56, 4, 78, 'ALFIN RAHADIAN', 10, 'XII RPL1', 7, 'Berkata tidak sopan', 4, 34, 'Aldi Maulana, S.Pd', '2026-11-09', 'Ngomong kasar', 15, 'peneguran', 'Sudah Ditindak', '2026-11-09 08:46:24', '2026-11-09 08:46:24'),
(57, 4, 51, 'ADITTIA NUR LANTIP', 9, 'XII RPL 2', 12, 'Keluar kelas tanpa izin', 1, 2, 'Wawan Kurniawan, S.Pd.I', '2026-11-10', 'Keluar tanpa izin', 10, 'Peneguran', 'Sudah Ditindak', '2026-11-10 01:24:47', '2026-11-10 01:24:47'),
(58, 4, 63, 'NAZRIL ILHAM', 9, 'XII RPL 2', 10, 'Tidak mengerjakan tugas', 5, 30, 'Ari Sandriana, S.Kom', '2026-11-10', 'Lupa mengerjakan tugas', 10, 'Peneguran', 'Sudah Ditindak', '2026-11-10 05:09:49', '2026-11-10 05:09:49');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_siswa`
--

INSERT INTO `t_siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `status_aktif`, `created_at`, `updated_at`) VALUES
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
(76, '102410568', '0092610026', 'TONI ANTONIO', 'L', '2009-05-20', 'Jl. Cibeureum No. 27, Tasikmalaya', 1, '2026-11-04 05:11:47', '2026-11-04 05:11:47'),
(78, '102410520', '0092610027', 'ALFIN RAHADIAN', 'L', '2009-01-12', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(79, '102410521', '0092610028', 'ALISA RAMADHANI', 'P', '2009-02-15', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(80, '102410522', '0092610029', 'ALMA AURA LIVIA', 'P', '2009-03-18', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(81, '102410523', '0092610030', 'ANIS KHOERUNNISA NUR RAMADANI', 'P', '2009-04-21', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(82, '102410524', '0092610031', 'AZMIL AMIRA', 'P', '2009-05-10', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(83, '102410525', '0092610032', 'AZRIL AKBAR FAWJI ESDILLAH', 'L', '2009-06-14', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(84, '102410527', '0092610033', 'ERLANGGA SAPUTRA HIDAYAT', 'L', '2009-07-17', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(85, '102410528', '0092610034', 'HILMA HUMMA TUNNAJAH', 'P', '2009-08-20', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(86, '102410529', '0092610035', 'ILMA NAJYA', 'P', '2009-09-23', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(87, '102410531', '0092610036', 'JULIANDA DHARMA PANGESTU', 'L', '2009-10-11', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(88, '102410532', '0092610037', 'KAYLA NUR FADILAH', 'P', '2009-11-14', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(89, '102410533', '0092610038', 'MOZA DINA NABILLAH', 'P', '2009-12-17', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(90, '102410534', '0092610039', 'MUHAMAD ALFARIZI', 'L', '2009-01-20', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(91, '102410535', '0092610040', 'MUHAMAD FAHRIN ADAM', 'L', '2009-02-23', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(92, '102410536', '0092610041', 'MUHAMMAD ZIDANE MAULIDAN', 'L', '2009-03-11', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(93, '102410537', '0092610042', 'MUHAMMAD ZULFAN NURALFANSYAH', 'L', '2009-04-14', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(94, '102410538', '0092610043', 'NATIYA NUR AZKIYA', 'P', '2009-05-17', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(95, '102410539', '0092610044', 'NOVITA PUSPITASARI', 'P', '2009-06-20', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(96, '102410540', '0092610045', 'NUCKY ANDREAS FEBRIAN', 'L', '2009-07-23', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(97, '102410743', '0092610046', 'RADITYA JETI PRASETYA', 'L', '2009-08-11', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(98, '102410541', '0092610047', 'RANGGA RAMADIYANTO NURHAKIM', 'L', '2009-09-14', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(99, '102410542', '0092610048', 'RISQI MUHAMAD IHWANI', 'L', '2009-10-17', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(100, '102410753', '0092610049', 'SALWA SABILATUL BARKAH', 'P', '2009-11-20', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31'),
(101, '102410543', '0092610050', 'TAZKIA ZAHRA', 'P', '2009-12-23', 'Tasikmalaya', 1, '2026-11-05 04:12:31', '2026-11-05 04:12:31');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_tahun_ajaran`
--

INSERT INTO `t_tahun_ajaran` (`id`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '2025/2026', '2025-07-14', '2026-06-30', 0, '2026-09-23 02:38:24', '2026-09-23 02:38:24'),
(4, '2026/2027', '2026-07-13', '2027-06-18', 1, '2026-11-05 02:23:55', '2026-11-05 02:23:55');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_wali_kelas`
--

INSERT INTO `t_wali_kelas` (`id`, `tahun_ajaran_id`, `kelas_id`, `guru_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(12, 4, 10, 30, '2026-12-07', '2027-12-06', 1, '2026-11-04 04:29:26', '2026-11-04 04:29:26'),
(13, 4, 9, 34, '2026-07-13', '2027-07-14', 1, '2026-11-05 01:23:07', '2026-11-05 01:23:07');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
