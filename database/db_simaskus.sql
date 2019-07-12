-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2018 at 01:14 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simaskus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_kekhususan`
--

CREATE TABLE `bidang_kekhususan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_bidang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bimbingan_ke` int(11) DEFAULT '0',
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dospem_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '0',
  `deskripsi_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`id`, `tanggal_bimbingan`, `bimbingan_ke`, `judul`, `dospem_id`, `mahasiswa_id`, `flag`, `deskripsi_bimbingan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2018-10-01', 1, 'Judul FAQ 1', 1, 3, 1, 'Konsultasi Judul Bimbingan', '2018-10-01 07:46:43', '2018-10-01 07:48:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_component` float DEFAULT '0',
  `module_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `bobot_penguji` float DEFAULT '0',
  `bobot_pembimbing_lapangan` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `code_component`, `nama_component`, `category_component`, `bobot_component`, `module_id`, `created_at`, `updated_at`, `deleted_at`, `bobot_penguji`, `bobot_pembimbing_lapangan`) VALUES
(1, 'A2', 'Nikai Presentasi', 'Pembimbing', 20, 1, '2018-07-15 09:30:28', '2018-07-16 04:56:14', NULL, 20, 0),
(2, 'A1', 'Nikai Proses Pembuatan Skripsi', NULL, 20, 1, '2018-07-15 13:06:20', '2018-07-16 04:56:20', NULL, 20, 0),
(3, 'A3', 'Nilai Penguasaan Materi Skripsi', NULL, 40, 1, '2018-07-16 04:57:10', '2018-07-16 04:57:10', NULL, 40, 0),
(4, 'A4', 'Nikai Penguasaan Dasar Umum', NULL, 20, 1, '2018-07-16 04:57:32', '2018-07-16 04:57:32', NULL, 20, 0),
(5, 'TS-001', 'Mengerti Topik yang akan Dikerjakan', NULL, 0, 2, '2018-09-10 04:44:25', '2018-09-10 04:44:25', NULL, 0, 0),
(6, 'TS-002', 'Studi Literatur', NULL, 0, 2, '2018-09-10 04:46:06', '2018-09-10 04:46:06', NULL, 0, 0),
(7, 'TS-003', 'Membuat Alat Eksperimen **', NULL, 0, 2, '2018-09-10 04:46:24', '2018-09-10 04:46:24', NULL, 0, 0),
(8, 'TS-004', 'Membuat Model **', NULL, 0, 2, '2018-09-10 04:46:37', '2018-09-10 04:46:37', NULL, 0, 0),
(9, 'TS-005', 'Pengambilan Data', NULL, 0, 2, '2018-09-10 04:47:07', '2018-09-10 04:47:07', NULL, 0, 0),
(10, 'TS-006', 'Penulisan Buku Skripsi/TA', NULL, 0, 2, '2018-09-10 04:47:23', '2018-09-10 04:47:23', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `component_score`
--

CREATE TABLE `component_score` (
  `id` int(10) UNSIGNED NOT NULL,
  `jadwal_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `component_id` int(11) DEFAULT '0',
  `dosen_id` int(11) DEFAULT '0',
  `score` double(8,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_jenis_dokumen` int(11) NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `tanggal_verifikasi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inisial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` int(11) DEFAULT '0',
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `penugasan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ketua_kelompok` int(11) DEFAULT '0',
  `status_dosen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nip`, `inisial`, `nama`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `email`, `hp`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`, `penugasan`, `status_ketua_kelompok`, `status_dosen`) VALUES
(1, '40903011', NULL, 'Dr. Ir. Paulus Kurniawan Koesoemowidagdo', NULL, NULL, 0, NULL, NULL, 'paulus@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL, 'Geoteknik', 0, NULL),
(2, '197203061998022001', NULL, 'Mulia Orientilize, ST. M.Eng', NULL, NULL, 0, NULL, NULL, 'mulia@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL, 'Struktur', 0, NULL),
(3, '196003071993031001', NULL, 'Prof. Dr. Ir. Yusuf Latief, MT', NULL, NULL, 0, NULL, NULL, 'yusuf.latief@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL, 'MK/MP', 1, NULL),
(4, '195410271980031012', NULL, 'Prof. Dr. Ir. Budi Susilo Soepandji', NULL, NULL, 0, NULL, NULL, 'budi.susilo@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL, 'Geoteknik', 0, NULL),
(5, '1951051978021001', NULL, 'Prof. Dr. Ir. Tommy Ilyas, M.Eng', NULL, NULL, 0, NULL, NULL, 'tommy.ilyas@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL, 'Geoteknik', 0, NULL),
(6, '195811131986021001', NULL, 'Prof. Dr. Ir. Irwan Katili, DEA', NULL, NULL, 0, NULL, NULL, 'irwan.katili@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Struktur', 0, NULL),
(7, '196205061987031003', NULL, 'Prof. Dr. Ir. Sutanto Soehodho', NULL, NULL, 0, NULL, NULL, 'sutanto.soedhono@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Transportasi', 0, NULL),
(8, '195104111979031001', NULL, 'Ir. Heddy R. Agah, M.Eng', NULL, NULL, 0, NULL, NULL, 'heddy@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Transportasi', 0, NULL),
(9, '196106081987031003', NULL, 'Dr. Ir. Yuskar Lase, DEA', NULL, NULL, 0, NULL, NULL, 'yuskar.lase@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Struktur', 0, NULL),
(10, '195210291979032001', NULL, 'Prof. Dr.-Ing.Ir. Dwita Sutjiningsih, Dipl HE', NULL, NULL, 0, NULL, NULL, 'dwita.sutjiningsih@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'MSDA', 1, NULL),
(11, '194707251979031001', NULL, 'Ir. Syahril A. Rahim, M.Eng', NULL, NULL, 0, NULL, NULL, 'syahril@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Struktur', 0, NULL),
(12, '195805301986091001', NULL, 'Prof. Dr. Ir. Sigit P. Hadiwardoyo, DEA', NULL, NULL, 0, NULL, NULL, 'sigit.hadiwardoyo@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Transportasi', 0, NULL),
(13, '195108101978112002', NULL, 'Ir. Essy Arijoeni, Ph.D', NULL, NULL, 0, NULL, NULL, 'essy.arijoeni@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Struktur', 0, NULL),
(14, '195209011980031005', NULL, 'Prof. Dr. Ir. Djoko M. Hartono, SE, M.Eng', NULL, NULL, 0, NULL, NULL, 'djoko.hartono@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL, 'Teknik Lingkungan', 0, NULL),
(15, '195611221983031001', NULL, 'Ir. Tri Tjahjono, Ph.D', NULL, NULL, 0, NULL, NULL, 'tri.tjahjono@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Transportasi', 1, NULL),
(16, '195102101980111001', NULL, 'Dr. Ir. Damrizal Damoerin, M.Sc', NULL, NULL, 0, NULL, NULL, 'damrizal.damoerin@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Geoteknik', 0, NULL),
(17, '195201231985031001', NULL, 'Ir. El Khobar M.N, M.Eng', NULL, NULL, 0, NULL, NULL, 'el.khobar@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Teknik Lingkungan', 0, NULL),
(18, '195612081986102001', NULL, 'Ir. Ellen S.W. Tangkudung, M.Sc', NULL, NULL, 0, NULL, NULL, 'ellen@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Transportasi', 0, NULL),
(19, '195012101978021001', NULL, 'Ir. Iwan Renadi, M.Sc, Ph.D', NULL, NULL, 0, NULL, NULL, 'iwan.renadi@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Struktur', 0, NULL),
(20, '195108101979031001', NULL, 'Ir. Madsuri, MT', NULL, NULL, 0, NULL, NULL, 'madsuri@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Struktur', 0, NULL),
(21, '195806281986091001', NULL, 'Dr. Ir. Heru Purnomo', NULL, NULL, 0, NULL, NULL, 'heru.purnomo@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Struktur', 1, NULL),
(22, '195402201981032001', NULL, 'Dr. Ir. Elly Tjahjono, DEA', NULL, NULL, 0, NULL, NULL, 'elly.tjahjono@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Struktur', 0, NULL),
(23, '195210251980031006', NULL, 'Ir. Bambang Setiadi', NULL, NULL, 0, NULL, NULL, 'bambang.setiadi@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Struktur', 0, NULL),
(24, '195603241985031003', NULL, 'Dr. Ir. Setyo Sarwanto M', NULL, NULL, 0, NULL, NULL, 'setyo.sarwanto@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL, 'Teknik Lingkungan', 0, NULL),
(25, '195009051980031002', NULL, 'Ir. Setyo Supriyadi, M.Si', NULL, NULL, 0, NULL, NULL, 'setyo.supriyadi@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Struktur', 0, NULL),
(26, '196409241989032002', NULL, 'Ir. Martha Leni Siregar, M.Sc', NULL, NULL, 0, NULL, NULL, 'martha.leni@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Transportasi', 0, NULL),
(27, '195501031985032001', NULL, 'Ir. Irma Gusniani, M.Sc', NULL, NULL, 0, NULL, NULL, 'irma.gusniani@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Teknik Lingkungan', 0, NULL),
(28, '195512281980032001', NULL, 'Ir. Siti Murniningsih, M.Sc', NULL, NULL, 0, NULL, NULL, 'siti.murniningsih@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'MSDA', 0, NULL),
(29, '196211081987031003', NULL, 'Ir. Alvinsyah, M.Sc', NULL, NULL, 0, NULL, NULL, 'alviansyah@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Transportasi', 0, NULL),
(30, '196407091989031001', NULL, 'Dr.-Ing.Ir. Henki W. Ashadi', NULL, NULL, 0, NULL, NULL, 'henki@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Struktur', 0, NULL),
(31, '196205281991031009', NULL, 'Ir. R. Jachrizal Sumabrata, M.Sc., Ph.D', NULL, NULL, 0, NULL, NULL, 'jachrizal@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Transportasi', 0, NULL),
(32, '195501241985031002', NULL, 'Ir. Herr Soeryantono, Ph.D', NULL, NULL, 0, NULL, NULL, 'herr.soeryantono@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'MSDA', 0, NULL),
(33, '196104211990031001', NULL, 'Dr. Ir. Firdaus Ali', NULL, NULL, 0, NULL, NULL, 'firdaus.ali@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Teknik Lingkungan', 0, NULL),
(34, '197004271995011001', NULL, 'Prof. Ir. Widjojo A. Prakoso, Ph.D', NULL, NULL, 0, NULL, NULL, 'widjojo@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Geoteknik', 0, NULL),
(35, '196904211994032001', NULL, 'Dr. Ir. Wiwik Rahayu', NULL, NULL, 0, NULL, NULL, 'wiwik.rahayu@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL, 'Geoteknik', 0, NULL),
(36, '197606152010121002', NULL, 'Mohammed Ali Berawi, M.Eng.Sc, Ph.D', NULL, NULL, 0, NULL, NULL, 'mohammed.ali.berawi@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'MK/MP', 0, NULL),
(37, '196605301991032001', NULL, 'Dr. Ir. Nahry, MT', NULL, NULL, 0, NULL, NULL, 'nahry@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'Transportasi', 0, NULL),
(38, '196602201993032001', NULL, 'Ir. GS Boedi Andari, Ph.D', NULL, NULL, 0, NULL, NULL, 'boedi.andari@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'Teknik Lingkungan', 0, NULL),
(39, '198205172008122001', NULL, 'Ayomi Dita Rarasati, ST, MT, Ph.D', NULL, NULL, 0, NULL, NULL, 'ayomi.dita@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'MK/MP', 0, NULL),
(40, '198003102008122001', NULL, 'Dr. RR. Dwinanti Rika M, ST, MT', NULL, NULL, 0, NULL, NULL, 'dwinanti.rika@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'MSDA', 0, NULL),
(41, '195603181985031002', NULL, 'Ir. Alan Marino, M.Sc', NULL, NULL, 0, NULL, NULL, 'alan.marino@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'Transportasi', 0, NULL),
(42, '132207741', NULL, 'Dr.-Ing. Josia Irwan R, ST', NULL, NULL, 0, NULL, NULL, 'josia.irwan@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'Struktur', 0, NULL),
(43, '198401302012122001', NULL, 'Dr. Cindy Rianti Priadi, ST, MSc', NULL, NULL, 0, NULL, NULL, 'cindy.rianti@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'Teknik Lingkungan', 0, NULL),
(44, '041003015', NULL, 'Dr. Nyoman Suwartha, ST, MT, MAgr', NULL, NULL, 0, NULL, NULL, 'nyoman.suwartha@eng.ui.ac.id', NULL, 1, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL, 'Teknik Lingkungan', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_a_c_c_sidang`
--

CREATE TABLE `evaluasi_a_c_c_sidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengajuan_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `dept_id` int(11) DEFAULT '0',
  `dosen_id` int(11) DEFAULT '0',
  `component_id` int(11) DEFAULT '0',
  `nilai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi_k_p`
--

CREATE TABLE `informasi_k_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `grup_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasi_k_p`
--

INSERT INTO `informasi_k_p` (`id`, `judul`, `isi`, `status`, `departemen_id`, `grup_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Judul Kerja Praktek', 'Judul KP', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(2, 'Instansi/Perusahaan', 'PT. Nganu', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(3, 'Alamat Perusahaan', 'Nganu', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(4, 'Pimpinan Perusahaan / Penanggung Jawab', 'Bapak Nganu', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(5, 'Dept./Divisi/Seksi', 'Nganu', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(6, 'Periode Awal', '10-09-2018', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(7, 'Periode Selesai', '05-10-2018', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(8, 'Deskripsi', 'Deskripsi Nganu', 'utama', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(9, 'Konsentrasi Bidang Yang Dipelajari', 'Isi 1', 'tambahan', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(10, 'Nama Kontraktor', 'Isi 2', 'tambahan', 1, -1, '2018-09-10 03:42:59', '2018-09-10 03:42:59', NULL),
(11, 'Judul Kerja Praktek', 'Judul KP', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(12, 'Instansi/Perusahaan', 'PT. Lorem Ipsum', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(13, 'Alamat Perusahaan', 'Kelurahan Nganu', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(14, 'Pimpinan Perusahaan / Penanggung Jawab', 'Dr. LoremNganu,M.Sc', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(15, 'Dept./Divisi/Seksi', 'HRD', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(16, 'Periode Awal', '10-09-2018', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(17, 'Periode Selesai', '05-10-2018', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(18, 'Deskripsi', 'Deskripsi', 'utama', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL),
(19, 'Informasi Tambahan', 'Isi Info Tambahan', 'tambahan', 1, 2510109, '2018-09-10 03:45:46', '2018-09-10 03:45:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `izin_dosen`
--

CREATE TABLE `izin_dosen` (
  `id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(11) DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruangan_id` int(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_jadwal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staf_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `waktu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidang_k_p`
--

CREATE TABLE `jadwal_sidang_k_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_grup` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruangan_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `hari` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_jadwal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staf_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

CREATE TABLE `jenis_dokumen` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_dokumen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenjang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_active` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id`, `jenjang`, `desc`, `flag_active`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S1 Reguler', 'S1 Reguler', 1, 3, '2018-06-02 11:25:04', '2018-07-15 08:59:56', '2018-07-15 08:59:56'),
(2, 'S1 Ekstensi', 'S1 Ekstensi', 1, 3, '2018-06-02 11:25:45', '2018-06-02 11:26:20', NULL),
(3, 'S1 International', 'S1 International', 1, 3, '2018-06-02 11:26:32', '2018-06-02 11:27:50', NULL),
(4, 'S2 Reguler', 'S2 Reguler', 1, 3, '2018-06-02 11:26:54', '2018-06-02 11:26:54', NULL),
(5, 'S2 Khusus', 'S2 Khusus', 1, 3, '2018-06-02 11:27:02', '2018-06-02 11:27:02', NULL),
(6, 'S3', 'S3', 1, 3, '2018-06-02 11:27:17', '2018-06-02 11:27:17', NULL),
(7, 'S1 Paralel', 'S1 Paralel', 1, 3, '2018-06-02 11:27:32', '2018-06-02 11:27:32', NULL),
(8, 'S2 International', 'S2 International', 1, 3, '2018-06-02 11:27:42', '2018-06-02 11:27:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `judul_tugas_akhir`
--

CREATE TABLE `judul_tugas_akhir` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staf_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kalender_akademik`
--

CREATE TABLE `kalender_akademik` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `tahunajaran_id` int(11) DEFAULT '1',
  `departemen_id` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_sidang` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_k_ps`
--

CREATE TABLE `kelompok_k_ps` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kelompok` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_kp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembimbing_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kerja_praktek`
--

CREATE TABLE `kerja_praktek` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `file_riwayat_akademis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `tahunajaran_id` int(11) DEFAULT '0',
  `status_pengajuan` int(11) DEFAULT '0',
  `waktu` date DEFAULT NULL,
  `nama_perusahaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_perusahaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak_perusahaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_kp` int(11) DEFAULT '0',
  `balasan_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_pernyataan_selesai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `npm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `program_studi_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jenjang_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `email`, `hp`, `tahun_masuk`, `departemen_id`, `program_studi_id`, `created_at`, `updated_at`, `deleted_at`, `jenjang_id`) VALUES
(3, '123456789', 'Fachran Nazarullah', NULL, NULL, 0, NULL, NULL, 'fachran.nazarullah@gmail.com', '085214320808', 0, 1, 14, '2018-09-30 20:05:14', '2018-09-30 20:05:14', NULL, 14);

-- --------------------------------------------------------

--
-- Table structure for table `master_departemen`
--

CREATE TABLE `master_departemen` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_departemen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pimpinan_id` int(11) NOT NULL DEFAULT '0',
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_departemen`
--

INSERT INTO `master_departemen` (`id`, `code`, `nama_departemen`, `pimpinan_id`, `flag`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DTS', 'Departemen Teknik Sipil', -1, '1', NULL, '2018-07-12 18:11:11', NULL),
(2, 'DTM', 'Departemen Teknik Mesin', 1, '1', '2018-05-27 11:55:40', '2018-07-12 18:10:42', NULL),
(3, 'DTE', 'Departemen Teknik Elektro', 3, '1', '2018-05-27 11:56:12', '2018-07-12 18:11:00', NULL),
(4, 'asdasda', 'asdasdasd', 3, '1', '2018-05-27 12:02:15', '2018-05-27 12:02:33', '2018-05-27 12:02:33'),
(5, 'asdasd', 'asdasd', 1, '1', '2018-05-27 12:02:24', '2018-05-27 12:02:37', '2018-05-27 12:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_pengajuan`
--

CREATE TABLE `master_jenis_pengajuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_jenis_pengajuan`
--

INSERT INTO `master_jenis_pengajuan` (`id`, `code`, `jenis`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JNS001', 'Seminar Kerja Praktek', 'S1', '2018-05-27 12:30:30', '2018-07-10 08:23:07', NULL),
(2, 'JNS002', 'Sidang Kerja Praktek', 'S1', '2018-05-27 12:30:46', '2018-07-10 08:23:14', NULL),
(3, 'JNS003', 'Bimbingan Skripsi', 'S1', '2018-05-27 12:31:03', '2018-05-27 12:31:14', NULL),
(4, 'JNS004', 'Seminar Skripsi', 'S1', '2018-07-10 08:22:34', '2018-07-10 08:23:29', NULL),
(5, 'JNS005', 'Sidang Skripsi', 'S1', '2018-07-10 08:22:59', '2018-07-10 08:22:59', NULL),
(6, 'JNS006', 'Seminar Thesis', 'S2', '2018-07-10 08:23:41', '2018-07-10 08:23:41', NULL),
(7, 'JNS007', 'Sidang Thesis', 'S2', '2018-07-10 08:23:54', '2018-07-10 08:24:01', NULL),
(8, 'JNS008', 'Sidang Disertasi', 'S3', '2018-07-10 08:24:19', '2018-07-10 08:24:19', NULL),
(9, 'JNS009', 'Ujian Promotor', 'S3', '2018-07-10 08:24:36', '2018-07-10 08:24:36', NULL),
(10, 'JNS010', 'Tugas Skripsi', 'Tugas Syarat Mengajukan Sidang', '2018-09-10 04:33:02', '2018-09-10 04:33:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pimpinan`
--

CREATE TABLE `master_pimpinan` (
  `id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_pimpinan`
--

INSERT INTO `master_pimpinan` (`id`, `dosen_id`, `departemen_id`, `jabatan`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 31, 1, 'Ketua Departemen', '1', '2018-07-12 18:29:09', '2018-07-12 18:29:09', NULL),
(2, 43, 1, 'Sekretaris Departemen', '1', '2018-07-12 18:29:19', '2018-07-12 18:29:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_ruangan`
--

CREATE TABLE `master_ruangan` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `lokasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_ruangan`
--

INSERT INTO `master_ruangan` (`id`, `code_ruangan`, `nama_ruangan`, `deskripsi`, `departemen_id`, `lokasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'S.101', NULL, 1, 'Gedung S', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(2, NULL, 'EC. 101', NULL, 1, 'Gedung Engineering Center', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(3, NULL, 'R. Dosen Hidrolika', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(4, NULL, 'Departemen Teknik Sipil', NULL, 1, 'R.502', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(5, NULL, 'Departemen Teknik Sipil', NULL, 1, 'R. Lab Struktur dan Material', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(6, NULL, 'Lab Transportasi', NULL, 1, 'Gedung Engineering Center Lt.5', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(7, NULL, 'R. 503', NULL, 1, 'Gedung DTS', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(8, NULL, 'Ruang Sayap Kiri 1 - Lt. 1', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(9, NULL, 'Ruang Kaprodi Teknik Lingkungan - Lt. 1', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(10, NULL, 'Kelas Internasional Lt.1', NULL, 1, 'Gedung Engineering Center', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(11, NULL, 'R. Rapat Lt.2', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(12, NULL, 'A. 118 Lt.1', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(13, NULL, 'A108', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(14, NULL, 'A.113', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(15, NULL, 'Ruang KaProdi Teknik Lingkungan', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(16, NULL, 'Ruang Rapat Lt.5', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(17, NULL, 'S 103', NULL, 1, 'Gedung S', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(18, NULL, 'S 102', NULL, 1, 'Gedung S', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(19, NULL, 'S 101', NULL, 1, 'Gedung S', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(20, NULL, 'S. 201', NULL, 1, 'Gedung S', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(21, NULL, 'S. 202', NULL, 1, 'Gedung S', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(22, NULL, 'EC. 103', NULL, 1, 'Gedung Engineering Center', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(23, NULL, 'A.114 Lt.1', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(24, NULL, 'A.104', NULL, 1, 'DTS', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL),
(25, NULL, 'Ruang Rapat PSTL - Lantai 4', NULL, 1, 'Departemen Teknik Sipil', '2018-07-12 18:34:30', '2018-07-12 18:34:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2014_10_12_000000_create_users_table', 1),
(40, '2014_10_12_100000_create_password_resets_table', 1),
(41, '2017_10_25_020112_create_jenis_dokumen_table', 1),
(42, '2017_10_25_021242_create_dokumen_table', 1),
(43, '2017_10_25_022132_create_revisi_table', 1),
(44, '2018_05_27_022056_create_mahasiswas_table', 1),
(45, '2018_05_27_022119_create_dosens_table', 1),
(46, '2018_05_27_022126_create_stafs_table', 1),
(47, '2018_05_27_022153_create_master_jenis_pengajuans_table', 1),
(48, '2018_05_27_022338_create_judul_tugas_akhirs_table', 1),
(49, '2018_05_27_022701_create_jadwals_table', 1),
(50, '2018_05_27_022728_create_kelompok_k_ps_table', 1),
(51, '2018_05_27_022754_create_master_ruangans_table', 1),
(52, '2018_05_27_022805_create_master_pimpinans_table', 1),
(53, '2018_05_27_022815_create_master_departemens_table', 1),
(54, '2018_05_27_022851_create_pivot_bimbingans_table', 1),
(55, '2018_05_27_022901_create_pivot_pengujis_table', 1),
(56, '2018_05_27_022915_create_pivot_jadwals_table', 1),
(57, '2018_05_27_061416_create_progam_studis_table', 1),
(59, '2018_05_27_193334_create_syarat_pengajuans_table', 2),
(60, '2018_05_28_041853_create_notifikasis_table', 3),
(61, '2018_05_28_063213_create_pengajuan_skripsis_table', 4),
(62, '2018_06_02_180630_create_jenjangs_table', 5),
(63, '2018_06_02_181058_add_column_departemen', 5),
(64, '2018_06_02_182910_add_column_jenjang', 6),
(65, '2018_06_06_210921_create_pengajuans_table', 7),
(68, '2018_06_08_014258_create_table_bimbingan', 8),
(69, '2018_07_01_161915_add_allow_sidang_pengajuan', 9),
(70, '2018_07_02_175551_create_pivot_setuju_sidangs_table', 10),
(72, '2018_07_06_143830_create_pivot_document_sidangs_table', 11),
(73, '2018_07_08_094449_add_kolum_jenis_dokumen', 12),
(74, '2018_07_08_100040_add_kolum_departemen_id', 13),
(84, '2018_07_08_203748_create_create_table_izin_dosens_table', 14),
(85, '2018_07_08_205418_create_create_table_tahun_ajarans_table', 14),
(86, '2018_07_08_205431_create_create_table_kalender_akademiks_table', 14),
(87, '2018_07_08_233941_add_colom_tahun_ajaran', 15),
(89, '2018_07_10_163727_add_column_status_ketua_kelompok', 16),
(90, '2018_07_12_213622_create_bidang_kekhususans_table', 17),
(91, '2018_07_12_235944_create_modules_table', 17),
(92, '2018_07_12_235955_create_components_table', 17),
(93, '2018_07_13_000017_create_sub_components_table', 17),
(94, '2018_07_13_140330_add_kolom_ujian_sidang', 18),
(95, '2018_07_15_193949_add_bobot', 19),
(96, '2018_07_15_205147_add_bobot', 20),
(97, '2018_07_16_111900_create_perbaikan_skripsis_table', 21),
(98, '2018_07_16_114126_create_perubahan_juduls_table', 21),
(99, '2018_08_01_104719_add_waktu_jadwal', 22),
(100, '2018_07_15_205147_add_bobot2', 23),
(101, '2018_08_06_234740_create_component_scores_table', 23),
(104, '2018_08_22_015039_create_kerja_prakteks_table', 24),
(105, '2018_08_24_004308_create_pembimbing_k_ps_table', 25),
(106, '2018_08_24_004336_create_penguji_k_ps_table', 25),
(108, '2018_08_29_091751_create_informasi_k_ps_table', 26),
(109, '2018_09_02_233123_add_status_kp', 27),
(110, '2018_09_03_104551_create_jadwal_sidang_k_ps_table', 28),
(111, '2018_09_09_094622_create_quota_bimbingans_table', 29),
(112, '2018_09_10_142159_create_evaluasi_a_c_c_sidangs_table', 30),
(113, '2018_10_01_012608_create_quota_pengujis_table', 31),
(114, '2018_10_01_032605_create_quota_pembimbings_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_module` int(11) DEFAULT '0',
  `jenis_id` int(11) DEFAULT '0',
  `departemen_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `code_module`, `nama_module`, `bobot_module`, `jenis_id`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'mod-1-986', 'Penilaian Skripsi', 100, 1, 1, '2018-07-15 08:57:52', '2018-07-16 04:55:00', NULL),
(2, 'mod-1-383', 'Uraian', 100, 10, 1, '2018-09-10 04:43:32', '2018-09-10 04:43:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `seen` datetime DEFAULT NULL,
  `flag_active` int(11) NOT NULL DEFAULT '0',
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `title`, `from`, `to`, `seen`, `flag_active`, `pesan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Menunggu Verifikasi Pengajuan', 3, 158, NULL, 0, 'Mahasiswa : Fachran Nazarullah Melakukan Pengajuan, Harap Segera Di Verifikasi<br>\n                <a href=\'\'>Klik Disini</a>', '2018-10-01 04:44:57', '2018-10-01 07:36:12', NULL),
(2, 'Pengajuan Dosen Pembimbing', 161, 114, NULL, 0, 'Mahasiswa : Fachran Nazarullah Mengajukan untuk menjadi Dosen Pembimbing Bimbingan Skripsi', '2018-10-01 04:44:57', '2018-10-01 07:35:10', NULL),
(3, 'Pengajuan Dosen Pembimbing', 161, 115, NULL, 0, 'Mahasiswa : Fachran Nazarullah Mengajukan untuk menjadi Dosen Pembimbing Bimbingan Skripsi', '2018-10-01 04:44:57', '2018-10-01 07:35:37', NULL),
(4, 'Pengajuan Bimbingan Telah Di Setujui', 114, 116, NULL, 1, 'Dosen <b>Dr. Ir. Paulus Kurniawan Koesoemowidagdo</b> : Pengajuan Bimbingan Mahasiswa <u>Prof. Dr. Ir. Yusuf Latief, MT</u> Sudah Setujui', '2018-10-01 07:35:20', '2018-10-01 07:35:20', NULL),
(5, 'Pengajuan Bimbingan Telah Di Setujui', 115, 116, NULL, 1, 'Dosen <b>Mulia Orientilize, ST. M.Eng</b> : Pengajuan Bimbingan Mahasiswa <u>Prof. Dr. Ir. Yusuf Latief, MT</u> Sudah Setujui', '2018-10-01 07:35:46', '2018-10-01 07:35:46', NULL),
(6, 'Pengajuan Telah Di Verifikasi', 1, 116, NULL, 1, 'Staf : Pengajuan Anda dengan Judul <b>-</b>Telah Di Verifikasi', '2018-10-01 07:36:23', '2018-10-01 07:36:23', NULL),
(7, 'Menunggu Verifikasi Data Bimbingan', 161, 114, NULL, 0, 'Mahasiswa : Fachran Nazarullah Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://localhost/simaskus/public/daftar-bimbingan\'></a>', '2018-10-01 07:46:43', '2018-10-01 07:47:04', NULL),
(8, 'Data Bimbingan Telah DI Setujui', 114, 116, NULL, 1, 'Dosen : Data Bimbingan Mahasiswa <u>Prof. Dr. Ir. Yusuf Latief, MT</u> Sudah Setujui<br>\n        <a href=\'http://localhost/simaskus/public/pengajuan-detail/1#tab_5_2\'></a>', '2018-10-01 07:48:44', '2018-10-01 07:48:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing_k_p`
--

CREATE TABLE `pembimbing_k_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `departemen_id` int(11) DEFAULT '0',
  `grup_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_id` int(11) NOT NULL DEFAULT '0',
  `ipk_terakhir` double(8,2) DEFAULT '0.00',
  `jumlah_sks_lulus` int(11) DEFAULT '0',
  `topik_diajukan` text COLLATE utf8mb4_unicode_ci,
  `bidang` text COLLATE utf8mb4_unicode_ci,
  `skema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `judul_ind` text COLLATE utf8mb4_unicode_ci,
  `judul_eng` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_rencana` text COLLATE utf8mb4_unicode_ci,
  `abstrak_ind` text COLLATE utf8mb4_unicode_ci,
  `abstrak_eng` text COLLATE utf8mb4_unicode_ci,
  `pengambilan_ke` int(11) NOT NULL DEFAULT '0',
  `dospem1` int(11) NOT NULL DEFAULT '0',
  `dospem2` int(11) NOT NULL DEFAULT '0',
  `dospem3` int(11) NOT NULL DEFAULT '0',
  `dosen_ketua` int(11) NOT NULL DEFAULT '0',
  `pembimbing_sebelumnya` int(11) NOT NULL DEFAULT '0',
  `alasan_mengulang` text COLLATE utf8mb4_unicode_ci,
  `status_pengajuan` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `allow_sidang` int(11) NOT NULL DEFAULT '0',
  `tahunajaran_id` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `jenis_id`, `ipk_terakhir`, `jumlah_sks_lulus`, `topik_diajukan`, `bidang`, `skema`, `judul_ind`, `judul_eng`, `deskripsi_rencana`, `abstrak_ind`, `abstrak_eng`, `pengambilan_ke`, `dospem1`, `dospem2`, `dospem3`, `dosen_ketua`, `pembimbing_sebelumnya`, `alasan_mengulang`, `status_pengajuan`, `departemen_id`, `mahasiswa_id`, `created_at`, `updated_at`, `deleted_at`, `allow_sidang`, `tahunajaran_id`) VALUES
(1, 3, 0.00, 0, 'Topik 1', 'Bidang', 'Sendiri', '-', '-', 'Deskripsi / Rencana', '-', '-', 1, 1, 2, 0, 3, 0, NULL, 1, 1, 3, '2018-10-01 04:44:57', '2018-10-01 07:36:23', NULL, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_skripsi`
--

CREATE TABLE `pengajuan_skripsi` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `pembimbing_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `judul_id` int(11) NOT NULL DEFAULT '0',
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `jenis_id` int(11) NOT NULL DEFAULT '0',
  `disetujui` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penguji_k_p`
--

CREATE TABLE `penguji_k_p` (
  `id` int(10) UNSIGNED NOT NULL,
  `pivot_jadwal_id` int(11) DEFAULT '0',
  `grup_id` int(11) DEFAULT '0',
  `penguji_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_skripsi`
--

CREATE TABLE `perbaikan_skripsi` (
  `id` int(10) UNSIGNED NOT NULL,
  `jadwal_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `pembimbing_id` int(11) DEFAULT '0',
  `perbaikan` text COLLATE utf8mb4_unicode_ci,
  `batas_waktu` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_judul`
--

CREATE TABLE `perubahan_judul` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengajuan_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `judul_ind` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_ing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_bimbingan`
--

CREATE TABLE `pivot_bimbingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `jenis_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pivot_bimbingan`
--

INSERT INTO `pivot_bimbingan` (`id`, `dosen_id`, `mahasiswa_id`, `jenis_bimbingan`, `judul_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'Bimbingan Skripsi', 0, '1', '2018-10-01 04:44:57', '2018-10-01 07:35:20', NULL),
(2, 2, 3, 'Bimbingan Skripsi', 0, '1', '2018-10-01 04:44:57', '2018-10-01 07:35:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pivot_document_sidang`
--

CREATE TABLE `pivot_document_sidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengajuan_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `jadwal_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jenis_dokumen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_jadwal`
--

CREATE TABLE `pivot_jadwal` (
  `id` int(10) UNSIGNED NOT NULL,
  `jadwal_id` int(11) NOT NULL DEFAULT '0',
  `ruangan_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `judul_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_penguji`
--

CREATE TABLE `pivot_penguji` (
  `id` int(10) UNSIGNED NOT NULL,
  `pivot_jadwal_id` int(11) NOT NULL DEFAULT '0',
  `penguji_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pivot_setuju_sidang`
--

CREATE TABLE `pivot_setuju_sidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `jenis_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengajuan_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progam_studis`
--

CREATE TABLE `progam_studis` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_program_studi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pimpinan_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progam_studis`
--

INSERT INTO `progam_studis` (`id`, `code`, `nama_program_studi`, `departemen_id`, `keterangan`, `pimpinan_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, NULL, 'S1 Reguler Teknik Lingkungan', 1, NULL, -1, '2018-07-12 18:23:37', '2018-07-12 18:23:37', NULL),
(13, NULL, 'S1 Reguler Teknik Sipil', 1, NULL, -1, '2018-07-12 18:23:54', '2018-07-12 18:23:54', NULL),
(14, NULL, 'S1 Paralel Teknik Sipil', 1, NULL, -1, '2018-07-12 18:24:04', '2018-07-12 18:24:04', NULL),
(15, NULL, 'S1 Paralel Teknik Lingkungan', 1, NULL, -1, '2018-07-12 18:24:19', '2018-07-12 18:24:19', NULL),
(16, NULL, 'S2 Reguler Depok Teknik Sipil', 1, NULL, -1, '2018-07-12 18:24:32', '2018-07-12 18:24:32', NULL),
(17, NULL, 'S2 Kelas Khusus Salemba Teknik Sipil', 1, NULL, -1, '2018-07-12 18:24:42', '2018-07-12 18:24:42', NULL),
(18, NULL, 'Kelas Khusus Internasional', 1, NULL, -1, '2018-07-12 18:24:52', '2018-07-12 18:24:52', NULL),
(19, NULL, 'Program Studi Ekstensi', 1, NULL, -1, '2018-07-12 18:25:02', '2018-07-12 18:25:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quota_bimbingan`
--

CREATE TABLE `quota_bimbingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quota` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quota_bimbingan`
--

INSERT INTO `quota_bimbingan` (`id`, `departemen_id`, `level`, `quota`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, 'Total', 14, '2018-09-30 19:03:37', '2018-09-30 19:03:37', NULL),
(6, 1, 'S2', 8, '2018-09-30 19:10:53', '2018-09-30 19:10:53', NULL),
(7, 1, 'S3', 4, '2018-09-30 19:11:03', '2018-09-30 19:12:34', NULL),
(8, 1, 'S1', 2, '2018-09-30 19:11:10', '2018-09-30 19:11:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quota_pembimbing`
--

CREATE TABLE `quota_pembimbing` (
  `id` int(10) UNSIGNED NOT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quota` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quota_pembimbing`
--

INSERT INTO `quota_pembimbing` (`id`, `departemen_id`, `level`, `quota`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'S1', 2, '2018-09-30 20:30:03', '2018-09-30 20:30:38', '2018-09-30 20:30:38'),
(2, 1, '3', 2, '2018-09-30 20:41:20', '2018-09-30 20:41:20', NULL),
(3, 1, '1', 2, '2018-09-30 20:44:02', '2018-09-30 20:44:02', NULL),
(4, 1, '2', 1, '2018-09-30 20:44:09', '2018-09-30 20:44:09', NULL),
(5, 1, '5', 2, '2018-09-30 20:44:30', '2018-09-30 20:44:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quota_penguji`
--

CREATE TABLE `quota_penguji` (
  `id` int(10) UNSIGNED NOT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quota` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revisi`
--

CREATE TABLE `revisi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staf`
--

CREATE TABLE `staf` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inisial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staf`
--

INSERT INTO `staf` (`id`, `nip`, `inisial`, `nama`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `email`, `hp`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '123123123', 'ASIP', 'Staf Admin Sipil', NULL, '2018-07-13', 1, NULL, NULL, 'admin.sipil@email.com', NULL, 1, '2018-07-12 18:10:08', '2018-07-12 18:10:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_component`
--

CREATE TABLE `sub_component` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_sub_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_sub_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_sub_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_sub_component` int(11) DEFAULT '0',
  `component_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nilai_min` int(11) DEFAULT '0',
  `nilai_max` int(11) DEFAULT '0',
  `huruf_mutu` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_component`
--

INSERT INTO `sub_component` (`id`, `code_sub_component`, `nama_sub_component`, `category_sub_component`, `bobot_sub_component`, `component_id`, `created_at`, `updated_at`, `deleted_at`, `nilai_min`, `nilai_max`, `huruf_mutu`, `keterangan`) VALUES
(1, NULL, 'Pemahaman', NULL, 0, 2, '2018-07-15 23:52:41', '2018-07-16 00:06:31', NULL, 90, 100, 'A', 'Menyeluruh dan demonstrasi pengetahuan yang sangat baik'),
(2, NULL, 'Pemahaman', NULL, 0, 2, '2018-07-15 23:58:31', '2018-07-16 00:04:18', NULL, 85, 90, 'A', 'Menyeluruh'),
(3, NULL, 'Sumber Rujukan', NULL, 0, 1, '2018-07-16 00:06:23', '2018-07-16 00:06:23', NULL, 90, 100, 'A', 'Jelas dan Lengkap dalam membuktikan uraian dengan rujukan terbaru'),
(4, NULL, 'Pendetilan', NULL, 0, 2, '2018-07-16 00:06:52', '2018-07-16 00:06:52', NULL, 90, 100, 'A', 'Sangat Rinci');

-- --------------------------------------------------------

--
-- Table structure for table `syarat_pengajuans`
--

CREATE TABLE `syarat_pengajuans` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `syarat` longtext COLLATE utf8mb4_unicode_ci,
  `pengajuan_id` int(11) NOT NULL DEFAULT '0',
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`, `jenis`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2016 / 2017', 'Gasal', '2018-07-07 17:00:00', '2018-07-07 17:00:00', NULL),
(2, '2016 / 2017', 'Genap', '2018-07-07 17:00:00', '2018-07-07 17:00:00', NULL),
(3, '2017 / 2018', 'Gasal', '2018-07-07 17:00:00', '2018-07-07 17:00:00', NULL),
(4, '2017 / 2018', 'Genap', '2018-07-07 17:00:00', '2018-07-07 17:00:00', NULL),
(5, '2018 / 2019', 'Gasal', '2018-07-07 17:00:00', '2018-07-07 17:00:00', NULL),
(6, '2018 / 2019', 'Genap', '2018-07-07 17:00:00', '2018-07-07 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` int(11) NOT NULL,
  `kat_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `flag`, `kat_user`, `id_user`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'admin@email.com', '$2y$10$Niu6ThReEVrRaeEhaMyvgeZRvcfCRAZTFGrZHbatp4xLJZVMi.5Be', 1, 0, 0, 'XQ8kpPZl0u4F3oQuE0Bkl89Y7NH4180usLLTTW3YQTbciPbJQPYgunnrp3Di', '2018-05-27 08:03:23', '2018-05-27 08:03:23', NULL),
(114, 'Dr. Ir. Paulus Kurniawan Koesoemowidagdo', 'paulus@eng.ui.ac.id', '$2y$10$QkTs8rCayKevjp4ExqcXIuUQKC8ets81.cvo6Hc8kZHB0jgFFCHqy', 1, 2, 1, 's7vivCGh178DiLA0aX6LbH5sB8tAJMck9898IMru8yEvKyYxZtZBXAz5Movu', '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL),
(115, 'Mulia Orientilize, ST. M.Eng', 'mulia@eng.ui.ac.id', '$2y$10$Gaob1/SSiBUTgdZ/2cydm.RhlMjJ2u0uAcEaE28VaduaXX0K0eSFK', 1, 2, 2, 'PUXwypY1e4ikdyWYot0Y0dWMDoerC9yJYTMyUYGmHOy3StE7EWJazsfScxuH', '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL),
(116, 'Prof. Dr. Ir. Yusuf Latief, MT', 'yusuf.latief@eng.ui.ac.id', '$2y$10$MHqWzdh7aWo7TUNDsM727.ACHCMxgz413hLKd2RVuCjrQchXR3afS', 1, 2, 3, 'UnMnvBa61SNg592osFuJbt0dPKNjKUzZGrWtrl7BFVSbomcVg6peIU2ZvTho', '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL),
(117, 'Prof. Dr. Ir. Budi Susilo Soepandji', 'budi.susilo@eng.ui.ac.id', '$2y$10$yi.8HCKcD3ZslAWMmEAt/O8S/oT7lykjD77f8o4EbXQy0YvXRLJ0m', 1, 2, 4, 'mosGCTlUy4UmBiZy9FSZHZSQEvmZGS32Eaggch0xSmPrMa45LkDbpWq1z0QX', '2018-07-12 18:04:08', '2018-07-12 18:04:08', NULL),
(118, 'Prof. Dr. Ir. Tommy Ilyas, M.Eng', 'tommy.ilyas@eng.ui.ac.id', '$2y$10$6YUjPeuvHg1JNtRgloa/Vuboi7Bt81fvBFee5zmVD1tP1t/RmuyrC', 1, 2, 5, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(119, 'Prof. Dr. Ir. Irwan Katili, DEA', 'irwan.katili@eng.ui.ac.id', '$2y$10$fS37yjJ/bSR56ap/sJNVyOQoGTPL3aAZgTr5e39pc9KVtGl8w2vYa', 1, 2, 6, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(120, 'Prof. Dr. Ir. Sutanto Soehodho', 'sutanto.soedhono@eng.ui.ac.id', '$2y$10$4c2o1P.12XAmtTbXJP7WietSs4sT59BiWWZbIqIb4wMySCuV6kJWa', 1, 2, 7, 'YZGin3DNiyIQIKM3aJT09ekRZOjxTAymuR5fFUP2UAANk4kpEHTgDZEfTwcJ', '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(121, 'Ir. Heddy R. Agah, M.Eng', 'heddy@eng.ui.ac.id', '$2y$10$39FjPb42fbPepXUqNNwpaejd2zV7scP6UBTsPqTHlmfGznUMDILne', 1, 2, 8, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(122, 'Dr. Ir. Yuskar Lase, DEA', 'yuskar.lase@eng.ui.ac.id', '$2y$10$g67QV4mxY0YOis73kbN.x.yUgswdjMmd1EPIf0gXEXAW3UEdBx2Fy', 1, 2, 9, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(123, 'Prof. Dr.-Ing.Ir. Dwita Sutjiningsih, Dipl HE', 'dwita.sutjiningsih@eng.ui.ac.id', '$2y$10$q1hLNUZsup.8giKXnCo.5OOM0sxfoAyZzS4KnL.rYNH8z9atnnoiC', 1, 2, 10, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(124, 'Ir. Syahril A. Rahim, M.Eng', 'syahril@eng.ui.ac.id', '$2y$10$TQBQvHvwCJihLMJFRgDhWeYhAW0xVLvxMkQv59QtbqlYOtNaGVM5O', 1, 2, 11, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(125, 'Prof. Dr. Ir. Sigit P. Hadiwardoyo, DEA', 'sigit.hadiwardoyo@eng.ui.ac.id', '$2y$10$e/tUJec32gk.IK4lusgUCuCY4ZtBoNeSgK0DMwCIfzbeBZXLETGMm', 1, 2, 12, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(126, 'Ir. Essy Arijoeni, Ph.D', 'essy.arijoeni@eng.ui.ac.id', '$2y$10$KUJ1nFDHLuxdXt/dVdSKeuy9wVNxAbyKli.9lP9HUSQyaarDOsoku', 1, 2, 13, NULL, '2018-07-12 18:04:09', '2018-07-12 18:04:09', NULL),
(127, 'Prof. Dr. Ir. Djoko M. Hartono, SE, M.Eng', 'djoko.hartono@eng.ui.ac.id', '$2y$10$mtmaKdj4U1GeY/9icaKCx.hVW7nofo31xqwC.S99WqFDMi4DaM56y', 1, 2, 14, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(128, 'Ir. Tri Tjahjono, Ph.D', 'tri.tjahjono@eng.ui.ac.id', '$2y$10$Ouf6B0UWzLQEDOPiQPH66.Jlu9FWIodGZOXVC7UABB/PjqakbGQXC', 1, 2, 15, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(129, 'Dr. Ir. Damrizal Damoerin, M.Sc', 'damrizal.damoerin@eng.ui.ac.id', '$2y$10$ZQwSVp5WEWZnZpDXyXltAuiN8iBtHMcN3xWz9Z5lwgq6/3.AkbEp2', 1, 2, 16, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(130, 'Ir. El Khobar M.N, M.Eng', 'el.khobar@eng.ui.ac.id', '$2y$10$tKdeePaumSgJz3MseJcLJenBsjcajDZQJN/udRx225tW0967VbzoG', 1, 2, 17, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(131, 'Ir. Ellen S.W. Tangkudung, M.Sc', 'ellen@eng.ui.ac.id', '$2y$10$iLElKjXH9TRlMzGqXiGDXusQ4o5WzHRrqA7zaqmIPKjduudfNNNAK', 1, 2, 18, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(132, 'Ir. Iwan Renadi, M.Sc, Ph.D', 'iwan.renadi@eng.ui.ac.id', '$2y$10$LPmH2Twb7wYSedMgs.ZacOlxCtmXshCoZKseDlG0.FofvhULpF5yK', 1, 2, 19, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(133, 'Ir. Madsuri, MT', 'madsuri@eng.ui.ac.id', '$2y$10$m4Ug4CjYiRX6Rxb3r1BzqeLsIkNfa28cPQMliJdMV5hk0VDqD7WHe', 1, 2, 20, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(134, 'Dr. Ir. Heru Purnomo', 'heru.purnomo@eng.ui.ac.id', '$2y$10$vB.jpQIiTOVuBtvqcvJQe.jgh.cF0NMENfWWhcn5PBKTmxBC14cuq', 1, 2, 21, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(135, 'Dr. Ir. Elly Tjahjono, DEA', 'elly.tjahjono@eng.ui.ac.id', '$2y$10$U4z6h9XeLd/ZSKLhC65xO.VAi9u.8j2lapVVqpcE4pEqF/Y6qIjd.', 1, 2, 22, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(136, 'Ir. Bambang Setiadi', 'bambang.setiadi@eng.ui.ac.id', '$2y$10$B.9KEzVOl9nIlXh8IZUOyOqvgAFzhRuKOQJeQqW0yt2d14EVY1oVC', 1, 2, 23, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(137, 'Dr. Ir. Setyo Sarwanto M', 'setyo.sarwanto@eng.ui.ac.id', '$2y$10$1yRYZl6/RkSiacoAh9s/neTz3FbG8XZeFhziF0/qUcje6P7CAgI4O', 1, 2, 24, NULL, '2018-07-12 18:04:10', '2018-07-12 18:04:10', NULL),
(138, 'Ir. Setyo Supriyadi, M.Si', 'setyo.supriyadi@eng.ui.ac.id', '$2y$10$aD8VaBxZnyYuWFFWFqMfeOqz22JCCNhLQZBovrOO.RFzFoaJwBhmK', 1, 2, 25, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(139, 'Ir. Martha Leni Siregar, M.Sc', 'martha.leni@eng.ui.ac.id', '$2y$10$ZRPw7MwJ6NpwDEGbUsPwvucQC7FUI0R1LFt3nwvTYOBRH6NV.1PIq', 1, 2, 26, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(140, 'Ir. Irma Gusniani, M.Sc', 'irma.gusniani@eng.ui.ac.id', '$2y$10$pPE.FWEo2Et8O6QFG1ANmuBgdY.3dg/D7A4og7rthzafi9.up53Gy', 1, 2, 27, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(141, 'Ir. Siti Murniningsih, M.Sc', 'siti.murniningsih@eng.ui.ac.id', '$2y$10$H9rQPe90n4/pJaj48Dj4lek4GUbzM3ajXNo5gXHQPrQP7siUlBXFu', 1, 2, 28, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(142, 'Ir. Alvinsyah, M.Sc', 'alviansyah@eng.ui.ac.id', '$2y$10$HeFfZLfT3hFYhEFBqKaSd.UGwf7SjQjzcmrGux6JQ1WzAr4hrUxnG', 1, 2, 29, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(143, 'Dr.-Ing.Ir. Henki W. Ashadi', 'henki@eng.ui.ac.id', '$2y$10$D8WoIA8uaxnt.M2KdhK2c.e/TtlOuOZZfj3XuFkL8WyCgK.B.3HzK', 1, 2, 30, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(144, 'Ir. R. Jachrizal Sumabrata, M.Sc., Ph.D', 'jachrizal@eng.ui.ac.id', '$2y$10$9oYgLeZQygPktuEQLdvdHegno.ZA2oBLVB2LyU15RcB0we8yrMziu', 1, 2, 31, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(145, 'Ir. Herr Soeryantono, Ph.D', 'herr.soeryantono@eng.ui.ac.id', '$2y$10$gt1rwmTwF.GoIsccCDLN6O1Vfb9mXMWToYy9tJv27b2xdEKULfWXi', 1, 2, 32, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(146, 'Dr. Ir. Firdaus Ali', 'firdaus.ali@eng.ui.ac.id', '$2y$10$5gN87sX1tj517NPRqehbjefls4aemmAYhsHrXae4T7gUSms.iL1jS', 1, 2, 33, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(147, 'Prof. Ir. Widjojo A. Prakoso, Ph.D', 'widjojo@eng.ui.ac.id', '$2y$10$iTTpfpusgij1vhWhVygLo.EgAo7qjjVbe34EuDOtIuRcdg/sZLLOa', 1, 2, 34, NULL, '2018-07-12 18:04:11', '2018-07-12 18:04:11', NULL),
(148, 'Dr. Ir. Wiwik Rahayu', 'wiwik.rahayu@eng.ui.ac.id', '$2y$10$Bho6vA3Rik2xKtLUGdncv.fvhCL0JxS56AdmB5mx5itVcvgZjy.hO', 1, 2, 35, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(149, 'Mohammed Ali Berawi, M.Eng.Sc, Ph.D', 'mohammed.ali.berawi@eng.ui.ac.id', '$2y$10$pOPMtzj4LhRYfOtuEa0E0.V.KFru4/391V3PZvwxD4N6frmq50qXO', 1, 2, 36, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(150, 'Dr. Ir. Nahry, MT', 'nahry@eng.ui.ac.id', '$2y$10$SpP3ZLAllMS1rQbvEf3/XexM5gRmhYWBgLILFmuE1dLF8lz1p9AqC', 1, 2, 37, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(151, 'Ir. GS Boedi Andari, Ph.D', 'boedi.andari@eng.ui.ac.id', '$2y$10$9sueq8ESINqI/qR68r.3N.5VHg1X2Gm9vN3P3QsLKAcOU3R3nPH7y', 1, 2, 38, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(152, 'Ayomi Dita Rarasati, ST, MT, Ph.D', 'ayomi.dita@eng.ui.ac.id', '$2y$10$L6L35G/i14LAM89bDnFuQebH7jfbu4nDm0oTeAZ4qVZZCOOkdP4JS', 1, 2, 39, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(153, 'Dr. RR. Dwinanti Rika M, ST, MT', 'dwinanti.rika@eng.ui.ac.id', '$2y$10$mP/mEwQVx7WB54dCuLYb7.9BTLO8B/FBapec33Tnj0itAS3rUZ7Ta', 1, 2, 40, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(154, 'Ir. Alan Marino, M.Sc', 'alan.marino@eng.ui.ac.id', '$2y$10$7EYzVkMiHiZT5jdOASr6Xu62.VQUNcFoKOMZO4guvESy/WayslBy6', 1, 2, 41, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(155, 'Dr.-Ing. Josia Irwan R, ST', 'josia.irwan@eng.ui.ac.id', '$2y$10$yq3Xl/oivhlXgLplrWYj5uJ5ibriis9onVdE2T2j3z/s2AF5viNhe', 1, 2, 42, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(156, 'Dr. Cindy Rianti Priadi, ST, MSc', 'cindy.rianti@eng.ui.ac.id', '$2y$10$gkb8cakRqE81UaPylAVWMeuAodM0bcCFBI42.5OG46cZeLM8044G2', 1, 2, 43, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(157, 'Dr. Nyoman Suwartha, ST, MT, MAgr', 'nyoman.suwartha@eng.ui.ac.id', '$2y$10$V6gj4FV8.C/3DL8mj6RjYuHwGGwkWseT6idfaN0Z9h0bSMRUyE7gK', 1, 2, 44, NULL, '2018-07-12 18:04:12', '2018-07-12 18:04:12', NULL),
(158, 'Staf Admin Sipil', 'admin.sipil@email.com', '$2y$10$V6gj4FV8.C/3DL8mj6RjYuHwGGwkWseT6idfaN0Z9h0bSMRUyE7gK', 1, 1, 1, 'WjDVAna9jRLBR0kRVGZ5c44nHmKLObeJwGqZi8VW4Qmg8iEsNsOZmMhLreLm', '2018-07-12 18:10:08', '2018-07-12 18:10:08', NULL),
(159, 'Fachran Nazarullah', 'f.nazarullah@gmail.com', '$2y$10$KGOCkTRvJgmHT99NLMZ1n.9lS071/HcE8YKHzXHK57IK325tKsyCa', 1, 3, 1, 'axBanmL07k7dniRLXPA2EMVr79tGacISFfiNzTadVxy7SSI8HoriAaRbDIjT', '2018-07-16 02:05:23', '2018-07-16 02:05:23', NULL),
(160, 'Dudy Ali', 'dudyali@gmail.com', '$2y$10$LNkePrmJckr4sZchePxYOeFbsz5oDN3pB.zrdnm/uOdnE1B1OJKli', 1, 3, 2, 'Wp7FgPgU6EH0mvrmn8lZYEgZUs9SwT6EApH2nI55aB3sDO6JfSzjs9KLYXmp', '2018-08-28 09:35:13', '2018-08-28 09:45:17', NULL),
(161, 'Fachran Nazarullah', 'fachran.nazarullah@gmail.com', '$2y$10$Qonx0kT5XoMOfAnuLZUEOu6AtK4D3idR/ARDOCa.iXkLJOI2XZeO2', 1, 3, 3, 'jdOpZUnqfLiZT5w5uRanjXnLoK7bwzQhKifUkgilMzvdoVK89k7dMBMzZYeG', '2018-09-30 20:05:14', '2018-09-30 20:06:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_kekhususan`
--
ALTER TABLE `bidang_kekhususan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `component_score`
--
ALTER TABLE `component_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluasi_a_c_c_sidang`
--
ALTER TABLE `evaluasi_a_c_c_sidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi_k_p`
--
ALTER TABLE `informasi_k_p`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `izin_dosen`
--
ALTER TABLE `izin_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_sidang_k_p`
--
ALTER TABLE `jadwal_sidang_k_p`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judul_tugas_akhir`
--
ALTER TABLE `judul_tugas_akhir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalender_akademik`
--
ALTER TABLE `kalender_akademik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok_k_ps`
--
ALTER TABLE `kelompok_k_ps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerja_praktek`
--
ALTER TABLE `kerja_praktek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_departemen`
--
ALTER TABLE `master_departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jenis_pengajuan`
--
ALTER TABLE `master_jenis_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pimpinan`
--
ALTER TABLE `master_pimpinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_ruangan`
--
ALTER TABLE `master_ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembimbing_k_p`
--
ALTER TABLE `pembimbing_k_p`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_skripsi`
--
ALTER TABLE `pengajuan_skripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penguji_k_p`
--
ALTER TABLE `penguji_k_p`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perbaikan_skripsi`
--
ALTER TABLE `perbaikan_skripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perubahan_judul`
--
ALTER TABLE `perubahan_judul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot_bimbingan`
--
ALTER TABLE `pivot_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot_document_sidang`
--
ALTER TABLE `pivot_document_sidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot_jadwal`
--
ALTER TABLE `pivot_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot_penguji`
--
ALTER TABLE `pivot_penguji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot_setuju_sidang`
--
ALTER TABLE `pivot_setuju_sidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progam_studis`
--
ALTER TABLE `progam_studis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quota_bimbingan`
--
ALTER TABLE `quota_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quota_pembimbing`
--
ALTER TABLE `quota_pembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quota_penguji`
--
ALTER TABLE `quota_penguji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisi`
--
ALTER TABLE `revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_component`
--
ALTER TABLE `sub_component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syarat_pengajuans`
--
ALTER TABLE `syarat_pengajuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_kekhususan`
--
ALTER TABLE `bidang_kekhususan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `component_score`
--
ALTER TABLE `component_score`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `evaluasi_a_c_c_sidang`
--
ALTER TABLE `evaluasi_a_c_c_sidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi_k_p`
--
ALTER TABLE `informasi_k_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `izin_dosen`
--
ALTER TABLE `izin_dosen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_sidang_k_p`
--
ALTER TABLE `jadwal_sidang_k_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `judul_tugas_akhir`
--
ALTER TABLE `judul_tugas_akhir`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kalender_akademik`
--
ALTER TABLE `kalender_akademik`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelompok_k_ps`
--
ALTER TABLE `kelompok_k_ps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerja_praktek`
--
ALTER TABLE `kerja_praktek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_departemen`
--
ALTER TABLE `master_departemen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_jenis_pengajuan`
--
ALTER TABLE `master_jenis_pengajuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_pimpinan`
--
ALTER TABLE `master_pimpinan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_ruangan`
--
ALTER TABLE `master_ruangan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembimbing_k_p`
--
ALTER TABLE `pembimbing_k_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan_skripsi`
--
ALTER TABLE `pengajuan_skripsi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penguji_k_p`
--
ALTER TABLE `penguji_k_p`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perbaikan_skripsi`
--
ALTER TABLE `perbaikan_skripsi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perubahan_judul`
--
ALTER TABLE `perubahan_judul`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pivot_bimbingan`
--
ALTER TABLE `pivot_bimbingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pivot_document_sidang`
--
ALTER TABLE `pivot_document_sidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pivot_jadwal`
--
ALTER TABLE `pivot_jadwal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pivot_penguji`
--
ALTER TABLE `pivot_penguji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pivot_setuju_sidang`
--
ALTER TABLE `pivot_setuju_sidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progam_studis`
--
ALTER TABLE `progam_studis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quota_bimbingan`
--
ALTER TABLE `quota_bimbingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quota_pembimbing`
--
ALTER TABLE `quota_pembimbing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quota_penguji`
--
ALTER TABLE `quota_penguji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revisi`
--
ALTER TABLE `revisi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staf`
--
ALTER TABLE `staf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_component`
--
ALTER TABLE `sub_component`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `syarat_pengajuans`
--
ALTER TABLE `syarat_pengajuans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
