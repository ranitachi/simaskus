-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `bidang_kekhususan`;
CREATE TABLE `bidang_kekhususan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_bidang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_id` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `bimbingan`;
CREATE TABLE `bimbingan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bimbingan_ke` int(11) DEFAULT '0',
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dospem_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '0',
  `deskripsi_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pengajuan_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bimbingan` (`id`, `tanggal_bimbingan`, `bimbingan_ke`, `judul`, `dospem_id`, `mahasiswa_id`, `flag`, `deskripsi_bimbingan`, `created_at`, `updated_at`, `deleted_at`, `pengajuan_id`) VALUES
(1,	'2018-11-16',	1,	'Disuksi Awal',	27,	1,	1,	'Diskusi Awal',	'2018-11-16 11:01:08',	'2018-11-16 11:03:37',	NULL,	0),
(2,	'2018-11-16',	2,	'Bimibingan Kedua',	27,	1,	1,	'Bimbingan Kedua',	'2018-11-16 11:02:21',	'2018-11-16 11:03:40',	NULL,	0),
(3,	'2018-11-16',	3,	'Bimbingan Ketiga',	27,	1,	1,	'Keterangan',	'2018-11-16 11:02:35',	'2018-11-16 11:03:43',	NULL,	0),
(4,	'2018-11-16',	4,	'Bimbingan Ke Empat',	27,	1,	1,	'Keterangan',	'2018-11-16 11:02:50',	'2018-11-16 11:03:45',	NULL,	0),
(5,	'2018-11-16',	5,	'Bimbingan K5',	27,	1,	1,	'Keterangan',	'2018-11-16 11:02:59',	'2018-11-16 11:03:47',	NULL,	0),
(6,	'2018-12-11',	1,	'diskusi topik',	27,	4,	1,	'diksui topik',	'2018-12-11 16:11:26',	'2018-12-11 16:11:26',	NULL,	0);

DROP TABLE IF EXISTS `component`;
CREATE TABLE `component` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_component` float DEFAULT '0',
  `module_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `bobot_penguji` float DEFAULT '0',
  `bobot_pembimbing_lapangan` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `component` (`id`, `code_component`, `nama_component`, `category_component`, `bobot_component`, `module_id`, `created_at`, `updated_at`, `deleted_at`, `bobot_penguji`, `bobot_pembimbing_lapangan`) VALUES
(1,	'A2',	'Nikai Presentasi',	'Pembimbing',	20,	1,	'2018-07-15 09:30:28',	'2018-07-16 04:56:14',	NULL,	20,	0),
(2,	'A1',	'Nikai Proses Pembuatan Skripsi',	NULL,	20,	1,	'2018-07-15 13:06:20',	'2018-07-16 04:56:20',	NULL,	20,	0),
(3,	'A3',	'Nilai Penguasaan Materi Skripsi',	NULL,	40,	1,	'2018-07-16 04:57:10',	'2018-07-16 04:57:10',	NULL,	40,	0),
(4,	'A4',	'Nikai Penguasaan Dasar Umum',	NULL,	20,	1,	'2018-07-16 04:57:32',	'2018-07-16 04:57:32',	NULL,	20,	0),
(5,	'TS-001',	'Mengerti Topik yang akan Dikerjakan',	NULL,	0,	2,	'2018-09-10 04:44:25',	'2018-09-10 04:44:25',	NULL,	0,	0),
(6,	'TS-002',	'Studi Literatur',	NULL,	0,	2,	'2018-09-10 04:46:06',	'2018-09-10 04:46:06',	NULL,	0,	0),
(7,	'TS-003',	'Membuat Alat Eksperimen **',	NULL,	0,	2,	'2018-09-10 04:46:24',	'2018-09-10 04:46:24',	NULL,	0,	0),
(8,	'TS-004',	'Membuat Model **',	NULL,	0,	2,	'2018-09-10 04:46:37',	'2018-09-10 04:46:37',	NULL,	0,	0),
(9,	'TS-005',	'Pengambilan Data',	NULL,	0,	2,	'2018-09-10 04:47:07',	'2018-09-10 04:47:07',	NULL,	0,	0),
(10,	'TS-006',	'Penulisan Buku Skripsi/TA',	NULL,	0,	2,	'2018-09-10 04:47:23',	'2018-09-10 04:47:23',	NULL,	0,	0),
(11,	'123',	'Komponen',	NULL,	20,	4,	'2018-10-05 03:03:06',	'2018-10-05 03:03:06',	NULL,	20,	90);

DROP TABLE IF EXISTS `component_score`;
CREATE TABLE `component_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `component_id` int(11) DEFAULT '0',
  `dosen_id` int(11) DEFAULT '0',
  `score` double(8,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `dokumen`;
CREATE TABLE `dokumen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) NOT NULL,
  `id_jenis_dokumen` int(11) NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `tanggal_verifikasi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `status_dosen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ui` int(11) DEFAULT '1',
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dosen` (`id`, `nip`, `inisial`, `nama`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `email`, `hp`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`, `penugasan`, `status_ketua_kelompok`, `status_dosen`, `nidn`, `status_ui`, `jabatan`, `pendidikan`) VALUES
(1,	'040803012',	NULL,	'Dr. Abdul Halim, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'ahalim@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0329117008',	1,	'Pengajar',	'S3'),
(2,	'197509011999031003',	NULL,	'Dr. Abdul Muis, S.T., M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'muis@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0001097503',	1,	'Lektor',	'S3'),
(3,	'196707011995121001',	NULL,	'Ir. Abdul Wahid, M.T., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'wahid@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0001076703',	1,	'Lektor Kepala',	'S3'),
(4,	'196009101988111001',	NULL,	'Dr. Ir. Achmad Hery Fuad, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'achmad.hery@ui.ac.id',	NULL,	10,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0010096007',	1,	'Lektor',	'S3'),
(5,	'196004291988111001',	NULL,	'Prof. Dr. Ir Adi Surjosatyo, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'adisur@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0029046005',	1,	'Guru Besar',	'S3'),
(6,	'0408050320',	NULL,	'Agung Shamsuddin Saragih, S.T., M.S.Eng., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'ashamsuddin@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0307118102',	1,	'Lektor',	'S3'),
(7,	'195808201986021001',	NULL,	'Ir. Agus R. Utomo, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'arutomo@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:06',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0020085807',	1,	'Lektor',	'S2'),
(8,	'195908011989031012',	NULL,	'Dr. Ir. Agus Santoso Tamsir, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'tamsir@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0001085904',	1,	'Lektor',	'S3'),
(9,	'197608062010121002',	NULL,	'Dr. Agus Sunjarianto Pamitran, ST., M.Eng',	NULL,	NULL,	1,	NULL,	NULL,	'pamitran@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0006087603',	1,	'Lektor',	'S3'),
(10,	'041003025',	NULL,	'Ahmad Gamal, S.Ars., M.U.P., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'ahmadgamal01@gmail.com',	NULL,	10,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0310018302',	1,	'Pengajar',	'S3'),
(11,	'196706111992031002',	NULL,	'Dr. Ir. Ahmad Indra Siswantara,',	NULL,	NULL,	1,	NULL,	NULL,	'a_indra@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0011066703',	1,	'Lektor Kepala',	'S3'),
(12,	'198612202015041003',	NULL,	'Dr.Eng. Ajib Setyo Arifin, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'ajib@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0020128605',	1,	'Pengajar',	'S3'),
(13,	'198209272012121001',	NULL,	'Aji Nur Widyanto, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'widyanto@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'102',	1,	'Pengajar',	'S2'),
(14,	'197006251995121001',	NULL,	'Prof. Dr. Ir. Akhmad Herman Yuwono, M.Phil.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'ahyuwono@eng.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0025067002',	1,	'Guru Besar',	'S3'),
(15,	'197301201997021001',	NULL,	'Dr. Akhmad Hidayatno, ST, MBT',	NULL,	NULL,	1,	NULL,	NULL,	'akhmad@eng.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0020017301',	1,	'Lektor Kepala',	'S3'),
(16,	'195603181985031002',	NULL,	'Ir. Alan Marino, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'alanmarino@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0018035606',	1,	'Asisten Ahli',	'S2'),
(17,	'196211081987031003',	NULL,	'Ir. Alvinsyah, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'alvin@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:07',	'2018-12-09 15:14:22',	NULL,	NULL,	0,	'1',	'0008116205',	1,	'Lektor',	'S2'),
(18,	'197812252010122002',	NULL,	'Dr. -Ing. Amalia Suzianti, S.T., M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'suzianti@eng.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:07',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025127803',	1,	'Lektor Kepala',	'S3'),
(19,	'195706221985031001',	NULL,	'Ir. Amien Rahardjo, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'amien.rahardjo@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:07',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022065704',	1,	'Lektor Kepala',	'S2'),
(20,	'196104241989032002',	NULL,	'Dr. Ir. Anak Agung Putri Ratna, M.Eng.',	NULL,	NULL,	0,	NULL,	NULL,	'ratna@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:07',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024046103',	1,	'Lektor Kepala',	'S3'),
(21,	'100111610231103891',	NULL,	'Andyka Kusuma, S.T., M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'andyka.k@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:07',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0013018305',	1,	'Pengajar',	'S3'),
(22,	'195903311986031001',	NULL,	'Dr. Ir. Andy Noorsaman, DEA',	NULL,	NULL,	1,	NULL,	NULL,	'andy.n.sommeng@gmail.com',	NULL,	9,	'2018-11-13 11:13:07',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0031035904',	1,	'Lektor Kepala',	'S3'),
(23,	'196103231986092001',	NULL,	'Prof. Dr. Ir. Anne Zulfia Syahrial,, M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'anne@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0023036107',	1,	'Guru Besar',	'S3'),
(24,	'196901171993031001',	NULL,	'Prof. Dr. Ir. Anondho Wijanarko, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'anondho@eng.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017016901',	1,	'Guru Besar',	'S3'),
(25,	'195907041993031001',	NULL,	'Ir. Antony Sihombing, MPD., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'a.sihombing@eng.ui.ac.id',	NULL,	10,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0004075904',	1,	'Lektor Kepala',	'S3'),
(26,	'197908052008121001',	NULL,	'Ardiyansyah, S.T., M.Eng., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'ardiyansyah@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005087909',	1,	'Lektor',	'S3'),
(27,	'197904022008121001',	NULL,	'Dr.Eng., Ir. Arief Udhiarto, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'arief@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002047904',	1,	'Lektor Kepala',	'S3'),
(28,	'197003311995121001',	NULL,	'Dr. Ir. Aries Subiantoro, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'biantoro@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0031037004',	1,	'Lektor Kepala',	'S3'),
(29,	'197604261999031002',	NULL,	'Dr. Ario Sunar Baskoro, S.T., M.T., M.Eng',	NULL,	NULL,	1,	NULL,	NULL,	'ario@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0026047603',	1,	'Lektor Kepala',	'S3'),
(30,	'100111610250210991',	NULL,	'Arry Rahmawan Destyanto, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'arry.rahmawan@gmail.com',	NULL,	11,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005129002',	1,	'Pengajar',	'S2'),
(31,	'196501251993031002',	NULL,	'Dr. Ir. Asep Handaya Saputra, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'sasep@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025016505',	1,	'Lektor Kepala',	'S3'),
(32,	'198205172008122001',	NULL,	'Ayomi Dita Rarasati, S.T., M.T., Ph.D.',	NULL,	NULL,	0,	NULL,	NULL,	'ayomi@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017058205',	1,	'Asisten Ahli',	'S3'),
(33,	'197407051998031004',	NULL,	'Dr. Badrul Munir, ST., M.Eng.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'bmunir@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005077403',	1,	'Lektor',	'S3'),
(34,	'197005271997021001',	NULL,	'Dr. Bambang Heru Susanto, S.T., M.T',	NULL,	NULL,	1,	NULL,	NULL,	'bambanghs@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0027057003',	1,	'Lektor',	'S3'),
(35,	'196604141991031002',	NULL,	'Dr. Ir. Bambang Priyono, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'bpriyono@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0014046610',	1,	'Lektor',	'S3'),
(36,	'196107131986021001',	NULL,	'Prof. Dr. Ir. Bambang Sugiarto, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'bangsugi@eng.u.ac.id',	NULL,	2,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0013076103',	1,	'Guru Besar',	'S3'),
(37,	'196304221989031005',	NULL,	'Prof. Dr.-Ing. Ir. Bambang Suharno,',	NULL,	NULL,	1,	NULL,	NULL,	'suharno@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:08',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022046305',	1,	'Guru Besar',	'S3'),
(38,	'197911032012121002',	NULL,	'Dr. Basari, S.T., M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'basyarie@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0303117901',	1,	'Lektor',	'S3'),
(39,	'195711171987031001',	NULL,	'Prof. Dr.Eng. Drs. Benyamin Kusumo Putro, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'kusumo@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017115706',	1,	'Guru Besar',	'S3'),
(40,	'100111610291707891',	NULL,	'Billy Muhamad Iqbal, S.Ds., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'billy.iqbal87@gmail.com',	NULL,	11,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0019078705',	1,	'Pengajar',	'S2'),
(41,	'196904211992022001',	NULL,	'Prof. Dr. Ir. Bondan Tiara, M.Si.',	NULL,	NULL,	0,	NULL,	NULL,	'bondan@eng.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0021046904',	1,	'Guru Besar',	'S3'),
(42,	'195511031985031003',	NULL,	'Ir. Boy Nurtjahyo Moch, MSIE.',	NULL,	NULL,	1,	NULL,	NULL,	'boy.nurtjahyo@ui.ac.id',	NULL,	11,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0003115504',	1,	'Lektor Kepala',	'S2'),
(43,	'195003231979031003',	NULL,	'Prof. Dr. Ir. Budiarso, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'mftbd@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0023035002',	1,	'Guru Besar',	'S3'),
(44,	'197907312008121003',	NULL,	'Dr.-Ing. Budi Sudiarto, S.T., M.T',	NULL,	NULL,	1,	NULL,	NULL,	'budi.sudiarto@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0031077903',	1,	'Asisten Ahli',	'S3'),
(45,	'195410271980031012',	NULL,	'Prof. Dr. Ir. Budi Susilo Soepandji.,',	NULL,	NULL,	1,	NULL,	NULL,	'budisus@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0027105402',	1,	'Guru Besar',	'S3'),
(46,	'100111610250017891',	NULL,	'Dr. Catur Apriono, S.T., M.T., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'catur@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005108701',	1,	'Pengajar',	'S3'),
(47,	'040903027',	NULL,	'Ir. Chairul Hudaya, S.T., M.Eng., Ph.D., IPM.',	NULL,	NULL,	1,	NULL,	NULL,	'c.hudaya@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002058406',	1,	'Lektor',	'S3'),
(48,	'100211610211806891',	NULL,	'Cindy Dianita, S.T., M.Eng.',	NULL,	NULL,	0,	NULL,	NULL,	'cindydianita@yahoo.com',	NULL,	9,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0011088601',	1,	'Pengajar',	'S2'),
(49,	'198401302012122001',	NULL,	'Dr. Cindy Rianti Priadi, S.T., M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'crpriadi@gmail.com',	NULL,	1,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0030018404',	1,	'Lektor',	'S3'),
(50,	'195810141985031005',	NULL,	'Prof. Dr. Ir. Dadang Gunawan, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'guna@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0014105803',	1,	'Guru Besar',	'S3'),
(51,	'196201301991031003',	NULL,	'Dr. Ing. Ir. Dalhar Susanto,',	NULL,	NULL,	1,	NULL,	NULL,	'dalhar@eng.ui.ac.id',	NULL,	10,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0030016201',	1,	'Lektor',	'S3'),
(52,	'195910171988111001',	NULL,	'Prof. Dr. Ir. Dedi Priadi, DEA',	NULL,	NULL,	1,	NULL,	NULL,	'dedi@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017105904',	1,	'Guru Besar',	'S3'),
(53,	'197705282008121001',	NULL,	'Dr. Deni Ferdian, S.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'deni@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:09',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028057708',	1,	'Asisten Ahli',	'S3'),
(54,	'195908121989032001',	NULL,	'Ir. Dewi Tristantini, M.T., PhD.',	NULL,	NULL,	0,	NULL,	NULL,	'detris@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0012085904',	1,	'Lektor Kepala',	'S3'),
(55,	'100211610202908891',	NULL,	'Diandra Pandu Saginatari, S.Ars., M.A.',	NULL,	NULL,	0,	NULL,	NULL,	'diandrasaginatari@gmail.com',	NULL,	10,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020098803',	1,	'Pengajar',	'S2'),
(56,	'197201211997022001',	NULL,	'Dr. Dianursanti, S.T., M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'danti@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0021017205',	1,	'Lektor Kepala',	'S3'),
(57,	'195812081988111001',	NULL,	'Ir. Dijan Supramono, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'dsupramo@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008125806',	1,	'Lektor Kepala',	'S2'),
(58,	'197404301999031004',	NULL,	'Dita Trisnawan, S.T., M.Arch., STD.',	NULL,	NULL,	1,	NULL,	NULL,	'ditadesign@gmail.com',	NULL,	10,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0030047408',	1,	'Asisten Ahli',	'S2'),
(59,	'195209011980031005',	NULL,	'Prof. Dr. Ir. Djoko Mulyo Hartono, S.E., M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'djokomh@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0001095206',	1,	'Guru Besar',	'S3'),
(60,	'195508041984031002',	NULL,	'Dr. Ir. Djoko Sihono Gabriel, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'dsihono@gmail.com',	NULL,	11,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0004085504',	1,	'Lektor Kepala',	'S3'),
(61,	'196601081991031001',	NULL,	'Dr. Ir. Dodi Sudiana, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'dodi.sudiana@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008016603',	1,	'Lektor Kepala',	'S3'),
(62,	'196403261991031008',	NULL,	'Dr. Ir. Donanta Dhaneswara, M.Si',	NULL,	NULL,	1,	NULL,	NULL,	'donanta.dhaneswara@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0026036405',	1,	'Lektor Kepala',	'S3'),
(63,	'197503181998021001',	NULL,	'Dr. Dwi Marta Nurjaya, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'dwi.marta@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0018037502',	1,	'Lektor',	'S3'),
(64,	'195210291979032001',	NULL,	'Prof. Dr. Ing. Ir. Dwita Sutjiningsih, Dipl. HE',	NULL,	NULL,	0,	NULL,	NULL,	'dwita@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0029105203',	1,	'Guru Besar',	'S3'),
(65,	'195603081983031002',	NULL,	'Prof. Dr. Ir. Eddy Sumarno Siradj, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'siradj@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008035601',	1,	'Guru Besar',	'S3'),
(66,	'040803032',	NULL,	'Dr.-Ing. Eko Adhi Setiawan, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'ekoas@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0316107303',	1,	'Lektor',	'S3'),
(67,	'195804221982031003',	NULL,	'Prof. Dr. Ir. Eko Tjipto Rahardjo, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'eko@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022045805',	1,	'Guru Besar',	'S3'),
(68,	'195612081986102001',	NULL,	'Ir. Ellen Sophie Wulan Tangkudung, M.S.',	NULL,	NULL,	0,	NULL,	NULL,	'ellen@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:10',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008125605',	1,	'Lektor Kepala',	'S2'),
(69,	'195402201981032001',	NULL,	'Dr. Ir. Elly Tjahjono, DEA.',	NULL,	NULL,	0,	NULL,	NULL,	'elly@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020025405',	1,	'Lektor Kepala',	'S3'),
(70,	'195906061992031001',	NULL,	'Dr. Ir. Engkos Achmad Kosasih, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'kosri@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006065908',	1,	'Lektor Kepala',	'S3'),
(71,	'100220310282100891',	NULL,	'Enira Arvanda, S.T., M.Dipl.',	NULL,	NULL,	0,	NULL,	NULL,	'enira28@gmail.com',	NULL,	10,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0328018009',	1,	'Pengajar',	'S2'),
(72,	'197610232010122002',	NULL,	'Eny Kusrini, S.Si., Ph.D.',	NULL,	NULL,	0,	NULL,	NULL,	'ekusrini@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0323107607',	1,	'Lektor',	'S3'),
(73,	'196010281988112001',	NULL,	'Ir. Erlinda Muslim, MEE., IPU.',	NULL,	NULL,	0,	NULL,	NULL,	'erlinda@eng.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028106002',	1,	'Lektor Kepala',	'S2'),
(74,	'0407050191',	NULL,	'Erly Bahsan, S.T., M.Kom.',	NULL,	NULL,	1,	NULL,	NULL,	'erlybahsan@ui.ac.id',	NULL,	1,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0307107604',	1,	'Asisten Ahli',	'S2'),
(75,	'197103101997022001',	NULL,	'Dr. Eva Fathul Karamah, S.T., M.T',	NULL,	NULL,	0,	NULL,	NULL,	'eva@eng.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0010037106',	1,	'Lektor Kepala',	'S3'),
(76,	'196203161991022001',	NULL,	'Ir. Evawani Ellisa, M.Eng., Ph.D',	NULL,	NULL,	0,	NULL,	NULL,	'ellisa@eng.ui.ac.id',	NULL,	10,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0016036209',	1,	'Lektor Kepala',	'S3'),
(77,	'040803030',	NULL,	'Farizal, Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'farizal@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0325086608',	1,	'Lektor',	'S3'),
(78,	'197210041997021002',	NULL,	'F. Astha Ekadiyanto, S.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'astha@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0004107204',	1,	'Asisten Ahli',	'S2'),
(79,	'196901231994032002',	NULL,	'Ir. Fauzia Dianawati, M.Si.',	NULL,	NULL,	0,	NULL,	NULL,	'fauzia.dianawati@ui.ac.id',	NULL,	11,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0023016902',	1,	'Lektor',	'S2'),
(80,	'196710081994031002',	NULL,	'Dr. Ir. Feri Yusivar, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'yusivar@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008106707',	1,	'Lektor Kepala',	'S3'),
(81,	'196104211990031001',	NULL,	'Dr. Ir. Firdaus Ali, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'firdausali@ymail.com',	NULL,	1,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0021046107',	1,	'Lektor',	'S3'),
(82,	'100120710222508891',	NULL,	'Firman Ady Nugroho, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'firman_ady@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022058804',	1,	'Pengajar',	'S2'),
(83,	'197407191998022001',	NULL,	'Prof. Dr. Fitri Yuli Zulkifli, S.T., M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'yuli@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:11',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0019077401',	1,	'Guru Besar',	'S3'),
(84,	'196602201993032001',	NULL,	'Dr. Ir. Gabriel Soedarmini Boedi Andari, M.Eng.',	NULL,	NULL,	0,	NULL,	NULL,	'gakristanto@gmail.com',	NULL,	1,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020026601',	1,	'Lektor Kepala',	'S3'),
(85,	'197204201996091001',	NULL,	'Prof. Dr. Ir. Gandjar Kiswanto, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'gandjar_kiswanto@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020047203',	1,	'Guru Besar',	'S3'),
(86,	'195903281986031002',	NULL,	'Dr. Ir. Gatot Prayogo, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'gatot@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028035902',	1,	'Lektor Kepala',	'S3'),
(87,	'199009202015041002',	NULL,	'Gerry Liston Putra, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'gerrylistonp@gmail.com',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020099001',	1,	'Asisten Ahli',	'S2'),
(88,	'196602221991031003',	NULL,	'Ir. Gunawan Wibisono, M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'gunawan@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022026604',	1,	'Lektor Kepala',	'S3'),
(89,	'195510171984031002',	NULL,	'Ir. Hadi Tresno Wibowo, M.T',	NULL,	NULL,	1,	NULL,	NULL,	'hadi.tresno@ui.ac.id',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017105506',	1,	'Lektor',	'S2'),
(90,	'196810301993031001',	NULL,	'Prof. Dr. Ir. Harinaldi, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'harinald@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0030106803',	1,	'Guru Besar',	'S3'),
(91,	'195212311980111001',	NULL,	'Prof. Dr. Ir. Harry Sudibyo S., DEA',	NULL,	NULL,	1,	NULL,	NULL,	'harisudi@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0031125208',	1,	'Guru Besar',	'S3'),
(92,	'195604291986031002',	NULL,	'Dr. Ir. Hendrajaya, M.Sc',	NULL,	NULL,	1,	NULL,	NULL,	'hendrajayaisnaeni@gmail.com',	NULL,	10,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0029045605',	1,	'Lektor',	'S3'),
(93,	'196009091986021001',	NULL,	'Dr. Ir. Hendri Dwi Saptioratri Budiono, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'hendri@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0009096007',	1,	'Lektor Kepala',	'S3'),
(94,	'196407091989031001',	NULL,	'Dr. Ing. Ir. Henki Wibowo Ashadi,',	NULL,	NULL,	1,	NULL,	NULL,	'henki@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0009076409',	1,	'Lektor',	'S3'),
(95,	'196010121990031002',	NULL,	'Dr. Ir. Henky Suskito Nugroho, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'henky.suskito@ui.ac.id',	NULL,	2,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0012106010',	1,	'Lektor',	'S3'),
(96,	'197601181999031002',	NULL,	'Prof. Dr. Heri Hermansyah, S.T., M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'heri@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0018017602',	1,	'Guru Besar',	'S3'),
(97,	'196708101993032001',	NULL,	'Ir. Herlily, M.Urb.Des.',	NULL,	NULL,	0,	NULL,	NULL,	'herlily@ui.ac.id',	NULL,	10,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0010086702',	1,	'Lektor',	'S2'),
(98,	'195501241985031002',	NULL,	'Ir. Herr Soeryantono, M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'herr@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024015502',	1,	'Lektor',	'S3'),
(99,	'195806281986091001',	NULL,	'Dr. Ir. Heru Purnomo, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'herupur@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:12',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028065805',	1,	'Lektor Kepala',	'S3'),
(100,	'100120310270012891',	NULL,	'I Gde Dharma Nugraha, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'i.gde@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0307108203',	1,	'Pengajar',	'S2'),
(101,	'195907051986021001',	NULL,	'Ir. I Made Ardita Y, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'i.made61@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005075909',	1,	'Lektor',	'S2'),
(102,	'195004091979021001',	NULL,	'Prof. Dr. I. Made Kartika Dhiputra, Dipl. Ing',	NULL,	NULL,	1,	NULL,	NULL,	'made.dhiputra@ui.ac.id',	NULL,	2,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0009045002',	1,	'Guru Besar',	'S3'),
(103,	'196811291995011001',	NULL,	'Dr. Ir. Imansyah Ibnu Hakim, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'imansyah@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0029116802',	1,	'Lektor Kepala',	'S3'),
(104,	'198606022012122001',	NULL,	'Inaki Maulida Hakim, S.T., M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'inakimhakim@eng.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002068602',	1,	'Lektor',	'S2'),
(105,	'195501031985032001',	NULL,	'Ir. Irma Gusniani Danumihardja, M.Sc',	NULL,	NULL,	0,	NULL,	NULL,	'irma@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0003015507',	1,	'Lektor',	'S2'),
(106,	'195811131986021001',	NULL,	'Prof. Dr. Ir. Irwan Katili, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'irwan.katili@gmail.com',	NULL,	1,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0013115803',	1,	'Guru Besar',	'S3'),
(107,	'196309151990032002',	NULL,	'Prof. Ir. Isti Surjandari Prajitno, M.T., M.A., Ph.D.',	NULL,	NULL,	0,	NULL,	NULL,	'isti@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0015096304',	1,	'Guru Besar',	'S3'),
(108,	'196105071989031004',	NULL,	'Prof. Dr. Ir. Iwa Garniwa M. K., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'iwa@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0007056104',	1,	'Guru Besar',	'S3'),
(109,	'100211610210215891',	NULL,	'Dr. Jessica Sjah, M.T., M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'jessica_sjah@hotmail.com',	NULL,	1,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0001128502',	1,	'Pengajar',	'S3'),
(110,	'195609171986031003',	NULL,	'Prof. Dr. Ir. Johny Wahyuadi Mudaryoto, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'jwsono@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017095606',	1,	'Guru Besar',	'S3'),
(111,	'040903057',	NULL,	'Joko Adianto, S.T., M.Ars., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'joko.adianto@gmail.com',	NULL,	10,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0314037701',	1,	'Asisten Ahli',	'S3'),
(112,	'197008131998031010',	NULL,	'Dr. -Ing. Josia Irwan, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'jrastandi@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0013087002',	1,	'Lektor',	'S3'),
(113,	'0400500018',	NULL,	'Jos Istiyanto, S.T., M.T., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'josist@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0327017503',	1,	'Lektor',	'S3'),
(114,	'196807151994031003',	NULL,	'Prof. Dr.-Ing. Ir. Kalamullah Ramli, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'k.ramli@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0015076805',	1,	'Guru Besar',	'S3'),
(115,	'196001071986031003',	NULL,	'Ir. Kamarza Mulia, M.Sc., Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'kmulia@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:13',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0007016005',	1,	'Lektor Kepala',	'S3'),
(116,	'197101281995121001',	NULL,	'Prof. Dr. Kemas Ridwan Kurniawan, ST., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'kemas.ridwan@gmail.com',	NULL,	10,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028017104',	1,	'Guru Besar',	'S3'),
(117,	'041003005',	NULL,	'Komarudin, S.T., M.Eng., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'komarudin@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0015028307',	1,	'Lektor',	'S3'),
(118,	'198605192012122003',	NULL,	'Kristanti Dewi Paramita, S.Ars., M.A.',	NULL,	NULL,	0,	NULL,	NULL,	'kristantiparamita@yahoo.com',	NULL,	10,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0019058602',	1,	'Pengajar',	'S2'),
(119,	'0407050182',	NULL,	'Leni Sagita Riantini, S.T., M.T., Ph.D.',	NULL,	NULL,	0,	NULL,	NULL,	'lsagita@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0311067704',	1,	'Pengajar',	'S3'),
(120,	'196308181988111001',	NULL,	'Prof. Ir. Mahmud Sudibandriyo, M.Sc., Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'msudib@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0018086313',	1,	'Guru Besar',	'S3'),
(121,	'196409241989032002',	NULL,	'Ir. Martha Leni Siregar, M.Sc',	NULL,	NULL,	0,	NULL,	NULL,	'leni@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024096403',	1,	'Lektor Kepala',	'S2'),
(122,	'195911201986031002',	NULL,	'Dr. Ir. M. Dachyar, M.Sc',	NULL,	NULL,	1,	NULL,	NULL,	'mdachyar@yahoo.com',	NULL,	11,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020115906',	1,	'Lektor Kepala',	'S3'),
(123,	'100220310231507891',	NULL,	'Dr. Mia Rizkinia, S.T., M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'rizkinia.mia@gmail.com',	NULL,	7,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0313058703',	1,	'Pengajar',	'S3'),
(124,	'100111610260100991',	NULL,	'Mikhael Johanes, S.Ars., M.Ars.',	NULL,	NULL,	1,	NULL,	NULL,	'johanes.mikhael@gmail.com',	NULL,	10,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006019004',	1,	NULL,	'S2'),
(125,	'196809221994031001',	NULL,	'Prof. Dr. Ing. Ir. Misri, M.Tech.',	NULL,	NULL,	1,	NULL,	NULL,	'mgozan@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022096801',	1,	'Guru Besar',	'S3'),
(126,	'197104171997031006',	NULL,	'Dr. Mochamad Chalid, S.Si., M.Sc.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'chalid@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0017047103',	1,	'Lektor Kepala',	'S3'),
(127,	'197703022008121002',	NULL,	'Dr.-Ing. Mohammad Adhitya, S.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'madhitya@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002037705',	1,	'Asisten Ahli',	'S3'),
(128,	'197605282010121001',	NULL,	'Mohammad Nanda Widyarta, B.Arch., M.Arch.',	NULL,	NULL,	1,	NULL,	NULL,	'm.n.widyarta@gmail.com',	NULL,	10,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0328057601',	1,	'Lektor',	'S2'),
(129,	'196105011986091001',	NULL,	'Prof. Dr. Ir. Mohammad Nasikin, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'mnasikin@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0001056105',	1,	'Guru Besar',	'S3'),
(130,	'197606152010121002',	NULL,	'Mohammed Ali Berawi, M.Eng.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'maberawi@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0215067601',	1,	'Lektor Kepala',	'S3'),
(131,	'196804061994031014',	NULL,	'Dr. Ir. Muhamad Asvial, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'asvial@ee.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:14',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006046801',	1,	'Lektor Kepala',	'S3'),
(132,	'198007162015041002',	NULL,	'Dr. Muhamad Sahlan, S.Si., M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'muhamad.sahlan@gmail.com',	NULL,	9,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0016078010',	1,	'Lektor',	'S3'),
(133,	'195706261985031002',	NULL,	'Prof. Dr. Ir. Muhammad Anis, M.Met.',	NULL,	NULL,	1,	NULL,	NULL,	'anis@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0026065704',	1,	'Guru Besar',	'S3'),
(134,	'195405121980031002',	NULL,	'Prof. Dr. Ir. Muhammad Idrus Alhamid,',	NULL,	NULL,	1,	NULL,	NULL,	'mamak@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0012055402',	1,	'Guru Besar',	'S3'),
(135,	'198105142012121001',	NULL,	'Dr. Muhammad Suryanegara, S.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'm.suryanegara@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0314058102',	1,	'Lektor',	'S3'),
(136,	'197203061998022001',	NULL,	'Mulia Orientilize, S.T., M.Eng',	NULL,	NULL,	0,	NULL,	NULL,	'mulia@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006037205',	1,	'Lektor',	'S2'),
(137,	'196004201987032001',	NULL,	'Dr. Ir. Myrna Ariati Mochtar, M.S.',	NULL,	NULL,	0,	NULL,	NULL,	'myrna@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020046005',	1,	'Lektor Kepala',	'S3'),
(138,	'196605301991032001',	NULL,	'Dr. Ir. Nahry, M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'nahry@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0030056602',	1,	'Lektor Kepala',	'S3'),
(139,	'197010251995021001',	NULL,	'Prof. Dr. -Ing. Nandy Setiadi Djaya Putra,',	NULL,	NULL,	1,	NULL,	NULL,	'nandyputra@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025107002',	1,	'Guru Besar',	'S3'),
(140,	'197204111995121001',	NULL,	'Dr.-Ing. Ir. Nasruddin, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'nasruddin@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0011047202',	1,	'Lektor Kepala',	'S3'),
(141,	'196711081994031002',	NULL,	'Prof. Dr. Ir. Nelson Saksono, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'nelson@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008116702',	1,	'Guru Besar',	'S3'),
(142,	'198704082015042002',	NULL,	'Nevine Rafa Kusuma, S.Ars., M.A.',	NULL,	NULL,	0,	NULL,	NULL,	'nevine_rk@yahoo.co.id',	NULL,	10,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008048704',	1,	'Pengajar',	'S2'),
(143,	'196101241986022001',	NULL,	'Prof. Dr. Ir. Nji Raden Poespawati, M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'pupu@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024016104',	1,	'Guru Besar',	'S3'),
(144,	'196712151993031003',	NULL,	'Nofrijon Bin Imam Sofyan, Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'nofrijon.sofyan@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0015126701',	1,	'Lektor',	'S3'),
(145,	'041003015',	NULL,	'Nyoman Suwartha, M.T., M.Agr., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'nsuwartha@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0328017407',	1,	'Lektor',	'S3'),
(146,	'197203251998032001',	NULL,	'Prof. Paramita Atmodiwirjo, S.T., M.Arch., Ph.D.',	NULL,	NULL,	0,	NULL,	NULL,	'paramita@eng.ui.ac.id',	NULL,	10,	'2018-11-13 11:13:15',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025037201',	1,	'Guru Besar',	'S3'),
(147,	'196805061992032001',	NULL,	'Dr. Ir. Praswasti Pembangun Dyah Kencana Wulan, M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'wulan@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006056810',	1,	'Lektor Kepala',	'S3'),
(148,	'0407050192',	NULL,	'Ir. Purnomo Sidi Priambodo, M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'p.s.priambodo@ieee.org',	NULL,	7,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0321016203',	1,	'Lektor Kepala',	'S3'),
(149,	'198003102008122001',	NULL,	'Dr. Raden Rara Dwinanti Rika Marthanty, S.T., M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'dwinanti@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0010038005',	1,	'Lektor',	'S3'),
(150,	'100111610242706891',	NULL,	'Dr.Eng. Radon Dhelika, B.Eng., M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'radon@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024078604',	1,	'Pengajar',	'S3'),
(151,	'196906021995121001',	NULL,	'Dr. Ir. Rahmat Nurcahyo, M.Eng. Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'rahmat@eng.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002066902',	1,	'Lektor Kepala',	'S3'),
(152,	'196909221995021001',	NULL,	'Ir. Rahmat Saptono, M.Sc.Tech., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'rahmat.saptono@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022096904',	1,	'Lektor Kepala',	'S3'),
(153,	'195409211979031001',	NULL,	'Prof. Dr. Ir. Raldiartono, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'koestoer@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0021095402',	1,	'Guru Besar',	'S3'),
(154,	'195903071985031001',	NULL,	'Prof. Dr. Ir. R. Danardono Agus Sumarsono, DEA. PE',	NULL,	NULL,	1,	NULL,	NULL,	'danardon@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0007035904',	1,	'Guru Besar',	'S3'),
(155,	'196203231987032001',	NULL,	'Dr. Ir. Retno Wigajatri Purnamaningsih, M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'retno.wigajatri@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0023036214',	1,	'Lektor Kepala',	'S3'),
(156,	'195604241985031002',	NULL,	'Prof. Ir. Rinaldy, M.Sc., Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'rinald@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024045606',	1,	'Guru Besar',	'S3'),
(157,	'195901051986032001',	NULL,	'Dr. Ir. Rini Riastuti, M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'riastuti@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005015906',	1,	'Lektor Kepala',	'S3'),
(158,	'100220310242209791',	NULL,	'Rini Suryantini, S.T., M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'rinisuryantini@gmail.com',	NULL,	10,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028027902',	1,	'Asisten Ahli',	'S2'),
(159,	'197007071995012003',	NULL,	'Prof. Dr. Ir. Riri Fitri Sari, M.M., M.Sc.',	NULL,	NULL,	0,	NULL,	NULL,	'riri@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:16',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0007077010',	1,	'Guru Besar',	'S3'),
(160,	'196902021995122001',	NULL,	'Ir. Rita Arbianti, M.Si.',	NULL,	NULL,	0,	NULL,	NULL,	'arbianti@che.ui.edu',	NULL,	9,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002026902',	1,	'Lektor Kepala',	'S2'),
(161,	'196205281991031009',	NULL,	'Ir. R. Jachrizal Sumabrata, M.Sc (Eng)., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'rjs@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028056205',	1,	'Lektor Kepala',	'S3'),
(162,	'100211610232806891',	NULL,	'Rossa Turpuk Gabe, S.Ars., M.Ars.',	NULL,	NULL,	0,	NULL,	NULL,	'ro_saturpuk_gabe@yahoo.com',	NULL,	10,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0023088605',	1,	'Pengajar',	'S2'),
(163,	'195410071984031001',	NULL,	'Prof. Dr. Ir. Rudy Setiabudy, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'rudy@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0007105404',	1,	'Guru Besar',	'S3'),
(164,	'196008191987031001',	NULL,	'Dr. Ir. Setiadi, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'setiadi@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0019086005',	1,	'Lektor Kepala',	'S3'),
(165,	'196005141986031001',	NULL,	'Prof. Dr. Ir. Setijo Bismo, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'setijo.bismo@ui.ac.id',	NULL,	9,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0014056006',	1,	'Guru Besar',	'S3'),
(166,	'195603241985031003',	NULL,	'Dr. Ir. Setyo Sarwanto Mursidik, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'smoersidik@yahoo.com',	NULL,	1,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024035604',	1,	'Lektor',	'S3'),
(167,	'195805301986091001',	NULL,	'Prof. Dr. Ir. Sigit Pranowo Hadiwardoyo, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'sigit@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0030055804',	1,	'Guru Besar',	'S3'),
(168,	'195512281980032001',	NULL,	'Ir. Siti Murniningsih, MS.',	NULL,	NULL,	0,	NULL,	NULL,	'sitimurni@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028125506',	1,	'Lektor Kepala',	'S2'),
(169,	'196605041993031002',	NULL,	'Prof. Dr. Ir. Slamet, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'slamet@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0004056605',	1,	'Guru Besar',	'S3'),
(170,	'196705101992032002',	NULL,	'Dr. Ir. Sotya Astutiningsih, M.Eng',	NULL,	NULL,	0,	NULL,	NULL,	'sotya.astutiningsih@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0010056706',	1,	'Lektor Kepala',	'S3'),
(171,	'196905261994031002',	NULL,	'Dr. Ir. Sri Harjanto.,',	NULL,	NULL,	1,	NULL,	NULL,	'harjanto@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0026056905',	1,	'Lektor Kepala',	'S3'),
(172,	'198207282008121002',	NULL,	'Sugeng Supriadi, S.T., M.S.Eng., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'sugeng@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028078203',	1,	'Lektor Kepala',	'S3'),
(173,	'196102281989031002',	NULL,	'Dr. Ir. Sukirno, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'sukirnos@che.ui.edu',	NULL,	9,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028026102',	1,	'Lektor Kepala',	'S3'),
(174,	'195408031985031001',	NULL,	'Prof. Dr. Ir. Sunaryo, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'naryo@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0003085406',	1,	'Guru Besar',	'S3'),
(175,	'196205061987031003',	NULL,	'Prof. Dr. Ir. Sutanto, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'sutantos@ui.ac.id',	NULL,	1,	'2018-11-13 11:13:17',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006056202',	1,	'Guru Besar',	'S3'),
(176,	'196301061988111001',	NULL,	'Prof. Ir. Sutrasno Kartohardjono, M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'sutrasno@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0006016308',	1,	'Guru Besar',	'S3'),
(177,	'197405121998022001',	NULL,	'Dr. Tania Surya Utami, S.T., M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'nana@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0012057404',	1,	'Lektor Kepala',	'S3'),
(178,	'195509081984031001',	NULL,	'Ir. Teguh Utomo, MURP.',	NULL,	NULL,	1,	NULL,	NULL,	'tiua@eng.ui.ac.id',	NULL,	10,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008095501',	1,	'Lektor',	'S2'),
(179,	'196303201989031002',	NULL,	'Prof. Dr. Ir. Teuku Yuri M. Zagloel, M.Eng. Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'yuri@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020036302',	1,	'Guru Besar',	'S3'),
(180,	'195401251986031001',	NULL,	'Dr. Ir. Toga H. Panjaitan, A.A.Grad.Dipl.',	NULL,	NULL,	1,	NULL,	NULL,	'toga.panjaitan@ui.edu.id',	NULL,	10,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025015402',	1,	'Lektor',	'S3'),
(181,	'0407050188',	NULL,	'Toha Saleh, S.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'tohasaleh@yahoo.com',	NULL,	1,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0329067303',	1,	'Pengajar',	'S2'),
(182,	'195105051978021001',	NULL,	'Prof. Dr. Ir. Tommy Ilyas, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	't.ilyas@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005055107',	1,	'Guru Besar',	'S3'),
(183,	'100140310203217891',	NULL,	'Tomy Abuzairi, S.T., M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'tomy.abuzairi@gmail.com',	NULL,	7,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0330128701',	1,	'Lektor',	'S3'),
(184,	'195509011985031003',	NULL,	'Prof. Dr. Ir. Tresna Priyana Soemardi,, M.Si., S.E.',	NULL,	NULL,	1,	NULL,	NULL,	'tresdi@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0001095505',	1,	'Guru Besar',	'S3'),
(185,	'194906291979031002',	NULL,	'Prof. Ir. Triatno Judo Harjoko, M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'gotty@eng.ui.ac.id',	NULL,	10,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0029064902',	1,	'Guru Besar',	'S3'),
(186,	'195611221983031001',	NULL,	'Dr. Ir. Tri Tjahjono, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'tri.tjahjono@ui.ac.id',	NULL,	1,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022115605',	1,	'Lektor Kepala',	'S3'),
(187,	'195311251979021001',	NULL,	'Ir. Wahidin Wahab, M.Sc., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'wahidin.wahab@ui.ac.id',	NULL,	7,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025115305',	1,	'Lektor',	'S3'),
(188,	'198301052012121005',	NULL,	'Wahyuaji Narottama Putra, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'wahyuaji@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005018305',	1,	'Asisten Ahli',	'S2'),
(189,	'195707081985031003',	NULL,	'Dr. Ir. Wahyu Nirbito, MSME.',	NULL,	NULL,	1,	NULL,	NULL,	'wahyu.nirbito@ui.ac.id',	NULL,	2,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008075707',	1,	'Lektor Kepala',	'S3'),
(190,	'196308081990031002',	NULL,	'Ir. Warjito, M.Sc., Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'warjito.sph@ui.ac.id',	NULL,	2,	'2018-11-13 11:13:18',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008086305',	1,	'Lektor Kepala',	'S3'),
(191,	'197004271995011001',	NULL,	'Prof. Ir. Widjojo Adi Prakoso, M.Sc., Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'wprakoso@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0027047005',	1,	'Guru Besar',	'S3'),
(192,	'196011111986031004',	NULL,	'Prof. Dr. Ir. Widodo Wahyu Purwanto, DEA.',	NULL,	NULL,	1,	NULL,	NULL,	'widodo@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0011116005',	1,	'Guru Besar',	'S3'),
(193,	'196407241988111001',	NULL,	'Prof. Dr. Ir. Winarto, M.Sc',	NULL,	NULL,	1,	NULL,	NULL,	'winarto.msc@ui.ac.id',	NULL,	8,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0024076402',	1,	'Guru Besar',	'S3'),
(194,	'196904211994032001',	NULL,	'Dr. Ir. Wiwik Rahayu, DEA',	NULL,	NULL,	0,	NULL,	NULL,	'wrahayu@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0021046905',	1,	'Lektor',	'S3'),
(195,	'195505161985031003',	NULL,	'Ir. Yadrifil, M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'yadrifil@eng.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0016055505',	1,	'Lektor Kepala',	'S2'),
(196,	'197101091997031001',	NULL,	'Prof. Yandi Andri Yatmo, S.T., M.Arch., Ph.D.',	NULL,	NULL,	1,	NULL,	NULL,	'yandi.andri@ui.ac.id',	NULL,	10,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0009017104',	1,	'Guru Besar',	'S3'),
(197,	'100140310211100891',	NULL,	'Yan Maraden, S.T., M.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'maradens@eng.ui.ac.id',	NULL,	7,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0311018002',	1,	'Pengajar',	'S2'),
(198,	'196001121987031003',	NULL,	'Prof. Dr. Ir. Yanuar, M.Eng., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'yanuar@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0012016011',	1,	'Guru Besar',	'S3'),
(199,	'0408050280',	NULL,	'Dr. Yudan Whulanza, S.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'yudan@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0316097603',	1,	'Lektor Kepala',	'S3'),
(200,	'198801252015041001',	NULL,	'Yudha Pratesa, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'yudha.pratesa@gmail.com',	NULL,	8,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0025018803',	1,	'Asisten Ahli',	'S2'),
(201,	'196807281993031001',	NULL,	'Prof. Ir. Yulianto Sulistyo Nugroho, M.Sc., Ph.D',	NULL,	NULL,	1,	NULL,	NULL,	'yulianto.nugroho@ui.ac.id',	NULL,	2,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0028076802',	1,	'Guru Besar',	'S3'),
(202,	'197507042000032001',	NULL,	'Dr. Ing. Yulia Nurliani Harahap, S.T., M.Des.S.',	NULL,	NULL,	0,	NULL,	NULL,	'yulianurliani@yahoo.com',	NULL,	10,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0004077502',	1,	'Lektor',	'S3'),
(203,	'196607201995011001',	NULL,	'Dr. Ir. Yuliusman, M.Eng.',	NULL,	NULL,	1,	NULL,	NULL,	'usman@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0020076602',	1,	'Lektor',	'S3'),
(204,	'195512051983032001',	NULL,	'Dr. Ir. Yunita Sadeli, M.Sc',	NULL,	NULL,	0,	NULL,	NULL,	'yunce@metal.ui.ac.id',	NULL,	8,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0005125509',	1,	'Lektor Kepala',	'S3'),
(205,	'196106081987031003',	NULL,	'Dr. Ir. Yuskar Lase, DEA',	NULL,	NULL,	1,	NULL,	NULL,	'yuskar@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:19',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0008066111',	1,	'Lektor Kepala',	'S3'),
(206,	'196003071993031001',	NULL,	'Prof. Dr. Ir. Yusuf Latief, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'latief73@eng.ui.ac.id',	NULL,	1,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0007036010',	1,	'Guru Besar',	'S3'),
(207,	'196405131995121001',	NULL,	'Dr. rer. nat. Ir. Yuswan Muharam, M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'muharam@che.ui.ac.id',	NULL,	9,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0001076714',	1,	'Lektor Kepala',	'S3'),
(208,	'197604092009122001',	NULL,	'Arian Dhini, S.T., M.T',	NULL,	NULL,	0,	NULL,	NULL,	'arian@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0309047601',	1,	'Asisten Ahli',	'S2'),
(209,	'197804022008121001',	NULL,	'Armand Omar Moeis, S.T., M.Sc',	NULL,	NULL,	1,	NULL,	NULL,	'armand.omar@ui.ac.id',	NULL,	11,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0002047805',	1,	'Lektor',	'S2'),
(210,	'041003004',	NULL,	'Ir. Dendi P. Ishak, MSIE.',	NULL,	NULL,	1,	NULL,	NULL,	'dendi@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'103',	1,	'Pengajar',	'S2'),
(211,	'198801122014041001',	NULL,	'Gunawan, S.T., M.T.',	NULL,	NULL,	1,	NULL,	NULL,	'gunawan_kapal@eng.ui.ac.id',	NULL,	2,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0012018802',	1,	'Asisten Ahli',	'S2'),
(212,	'198803222012122003',	NULL,	'Maya Arlini Puspasari, S.T., M.T.',	NULL,	NULL,	0,	NULL,	NULL,	'maya@ie.ui.ac.id',	NULL,	11,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0022038801',	1,	'Asisten Ahli',	'S2'),
(213,	'100120310242807891',	NULL,	'Taufiq Alif Kurniawan, M.T., M.Sc.',	NULL,	NULL,	1,	NULL,	NULL,	'taufiq.alif@gmail.com',	NULL,	7,	'2018-11-13 11:13:20',	'2018-12-09 15:14:23',	NULL,	NULL,	0,	'1',	'0324088701',	1,	'Pengajar',	'S2');

DROP TABLE IF EXISTS `evaluasi_a_c_c_sidang`;
CREATE TABLE `evaluasi_a_c_c_sidang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `evaluasi_a_c_c_sidang` (`id`, `pengajuan_id`, `mahasiswa_id`, `dept_id`, `dosen_id`, `component_id`, `nilai`, `keterangan`, `catatan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	1,	7,	27,	5,	'100%',	'keterangan',	'Catatan 1\r\nCatatan 2',	'2018-11-16 11:07:40',	'2018-11-16 11:07:40',	NULL),
(2,	1,	1,	7,	27,	6,	'100%',	'keterangan',	'Catatan 1\r\nCatatan 2',	'2018-11-16 11:07:41',	'2018-11-16 11:07:41',	NULL),
(3,	1,	1,	7,	27,	7,	'100%',	'keterangan',	'Catatan 1\r\nCatatan 2',	'2018-11-16 11:07:41',	'2018-11-16 11:07:41',	NULL),
(4,	1,	1,	7,	27,	8,	'100%',	'keterangan',	'Catatan 1\r\nCatatan 2',	'2018-11-16 11:07:41',	'2018-11-16 11:07:41',	NULL),
(5,	1,	1,	7,	27,	9,	'100%',	'keterangan',	'Catatan 1\r\nCatatan 2',	'2018-11-16 11:07:41',	'2018-11-16 11:07:41',	NULL),
(6,	1,	1,	7,	27,	10,	'100%',	'keterangan',	'Catatan 1\r\nCatatan 2',	'2018-11-16 11:07:41',	'2018-11-16 11:07:41',	NULL);

DROP TABLE IF EXISTS `informasi_k_p`;
CREATE TABLE `informasi_k_p` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `grup_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `informasi_k_p` (`id`, `judul`, `isi`, `status`, `departemen_id`, `grup_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Judul Kerja Praktek',	'Judul KP',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(2,	'Instansi/Perusahaan',	'PT. Nganu',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(3,	'Alamat Perusahaan',	'Nganu',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(4,	'Pimpinan Perusahaan / Penanggung Jawab',	'Bapak Nganu',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(5,	'Dept./Divisi/Seksi',	'Nganu',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(6,	'Periode Awal',	'10-09-2018',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(7,	'Periode Selesai',	'05-10-2018',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(8,	'Deskripsi',	'Deskripsi Nganu',	'utama',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(9,	'Konsentrasi Bidang Yang Dipelajari',	'Isi 1',	'tambahan',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(10,	'Nama Kontraktor',	'Isi 2',	'tambahan',	1,	-1,	'2018-09-10 03:42:59',	'2018-09-10 03:42:59',	NULL),
(11,	'Judul Kerja Praktek',	'Judul KP',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(12,	'Instansi/Perusahaan',	'PT. Lorem Ipsum',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(13,	'Alamat Perusahaan',	'Kelurahan Nganu',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(14,	'Pimpinan Perusahaan / Penanggung Jawab',	'Dr. LoremNganu,M.Sc',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(15,	'Dept./Divisi/Seksi',	'HRD',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(16,	'Periode Awal',	'10-09-2018',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(17,	'Periode Selesai',	'05-10-2018',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(18,	'Deskripsi',	'Deskripsi',	'utama',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL),
(19,	'Informasi Tambahan',	'Isi Info Tambahan',	'tambahan',	1,	2510109,	'2018-09-10 03:45:46',	'2018-09-10 03:45:46',	NULL);

DROP TABLE IF EXISTS `izin_dosen`;
CREATE TABLE `izin_dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jadwals`;
CREATE TABLE `jadwals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `waktu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jadwals` (`id`, `code`, `nama`, `ruangan_id`, `tanggal`, `hari`, `jenis_jadwal`, `staf_id`, `created_at`, `updated_at`, `deleted_at`, `departemen_id`, `waktu`) VALUES
(1,	NULL,	NULL,	0,	NULL,	NULL,	'Pembimbing Seminar',	NULL,	'2018-11-16 11:05:05',	'2018-11-16 11:05:05',	NULL,	7,	NULL),
(2,	NULL,	NULL,	29,	'2018-11-22',	'Thu',	NULL,	NULL,	'2018-11-16 11:13:31',	'2018-11-16 11:13:31',	NULL,	7,	'15.30');

DROP TABLE IF EXISTS `jadwal_sidang_k_p`;
CREATE TABLE `jadwal_sidang_k_p` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jenis_dokumen`;
CREATE TABLE `jenis_dokumen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_dokumen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jenjang`;
CREATE TABLE `jenjang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_active` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jenjang` (`id`, `jenjang`, `desc`, `flag_active`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'S1 Reguler',	'S1 Reguler',	1,	3,	'2018-06-02 11:25:04',	'2018-07-15 08:59:56',	'2018-07-15 08:59:56'),
(2,	'S1 Ekstensi',	'S1 Ekstensi',	1,	3,	'2018-06-02 11:25:45',	'2018-06-02 11:26:20',	NULL),
(3,	'S1 International',	'S1 International',	1,	3,	'2018-06-02 11:26:32',	'2018-06-02 11:27:50',	NULL),
(4,	'S2 Reguler',	'S2 Reguler',	1,	3,	'2018-06-02 11:26:54',	'2018-06-02 11:26:54',	NULL),
(5,	'S2 Khusus',	'S2 Khusus',	1,	3,	'2018-06-02 11:27:02',	'2018-06-02 11:27:02',	NULL),
(6,	'S3',	'S3',	1,	3,	'2018-06-02 11:27:17',	'2018-06-02 11:27:17',	NULL),
(7,	'S1 Paralel',	'S1 Paralel',	1,	3,	'2018-06-02 11:27:32',	'2018-06-02 11:27:32',	NULL),
(8,	'S2 International',	'S2 International',	1,	3,	'2018-06-02 11:27:42',	'2018-06-02 11:27:42',	NULL);

DROP TABLE IF EXISTS `judul_tugas_akhir`;
CREATE TABLE `judul_tugas_akhir` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staf_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `kalender_akademik`;
CREATE TABLE `kalender_akademik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `status_sidang` int(11) DEFAULT '0',
  `kategori_khusus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `kelompok_k_ps`;
CREATE TABLE `kelompok_k_ps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kelompok` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_kp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembimbing_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `kerja_praktek`;
CREATE TABLE `kerja_praktek` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `publish_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `jenjang_id` int(11) NOT NULL DEFAULT '0',
  `status_mahasiswa` int(11) DEFAULT '0',
  `bukti_siak_ng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mahasiswa` (`id`, `npm`, `nama`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `email`, `hp`, `tahun_masuk`, `departemen_id`, `program_studi_id`, `created_at`, `updated_at`, `deleted_at`, `jenjang_id`, `status_mahasiswa`, `bukti_siak_ng`) VALUES
(1,	'123',	'Fachran Nazarullah',	NULL,	NULL,	0,	NULL,	NULL,	'fachran.nazarullah@gmail.com',	'085214320808',	0,	7,	30,	'2018-11-16 10:33:56',	'2018-11-16 10:33:56',	NULL,	30,	0,	NULL),
(2,	'0401040487',	'Wahyuaji Dummy',	NULL,	NULL,	0,	NULL,	NULL,	'wahyuaji.np@gmail.com',	'0811177165',	0,	8,	26,	'2018-11-16 10:47:23',	'2018-11-16 10:47:23',	NULL,	26,	0,	NULL),
(3,	'11223344',	'Widya Wuri Handayani',	NULL,	NULL,	0,	NULL,	NULL,	'widya.wuri.handayani@gmail.com',	'08111127808',	0,	11,	38,	'2018-12-09 13:58:10',	'2018-12-09 13:58:10',	NULL,	38,	0,	NULL),
(4,	'54321',	'Salman',	NULL,	NULL,	0,	NULL,	NULL,	'salman@email.com',	'5412',	0,	7,	45,	'2018-12-11 15:58:05',	'2018-12-11 15:58:05',	NULL,	45,	0,	'siak-ng/test AFM.jpg');

DROP TABLE IF EXISTS `master_departemen`;
CREATE TABLE `master_departemen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_departemen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pimpinan_id` int(11) NOT NULL DEFAULT '0',
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_departemen` (`id`, `code`, `nama_departemen`, `pimpinan_id`, `flag`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'DTS',	'Departemen Teknik Sipil',	-1,	'1',	NULL,	'2018-07-12 18:11:11',	NULL),
(2,	'DTM',	'Departemen Teknik Mesin',	1,	'1',	'2018-05-27 11:55:40',	'2018-07-12 18:10:42',	NULL),
(7,	'DTE',	'Departemen Teknik Elektro',	0,	'1',	'2018-10-05 01:54:16',	'2018-10-05 01:54:16',	NULL),
(8,	'DTMM',	'Departemen Teknik Metalurgi dan Material',	0,	'1',	'2018-10-19 12:39:15',	'2018-10-19 12:39:25',	NULL),
(9,	'DTK',	'Departemen Teknik Kimia',	0,	'1',	'2018-10-19 12:39:40',	'2018-10-19 12:39:40',	NULL),
(10,	'DTA',	'Departemen Arsitektur',	0,	'1',	'2018-10-19 12:40:03',	'2018-11-05 09:20:33',	NULL),
(11,	'DTI',	'Departemen Teknik Industri',	0,	'1',	'2018-10-19 12:40:16',	'2018-11-01 20:42:44',	NULL);

DROP TABLE IF EXISTS `master_jenis_pengajuan`;
CREATE TABLE `master_jenis_pengajuan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) DEFAULT '0',
  `urutan` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_jenis_pengajuan` (`id`, `code`, `jenis`, `keterangan`, `created_at`, `updated_at`, `deleted_at`, `departemen_id`, `urutan`) VALUES
(2,	'JNS002',	'Kerja Praktek',	'S1',	'2018-05-27 12:30:46',	'2018-07-10 08:23:14',	NULL,	7,	0),
(3,	'JNS003',	'Pembimbing Skripsi',	'S1',	'2018-05-27 12:31:03',	'2018-11-09 14:59:20',	NULL,	7,	0),
(4,	'JNS004',	'Pembimbing Seminar',	'S1',	'2018-07-10 08:22:34',	'2018-07-10 08:23:29',	NULL,	7,	0),
(6,	'JNS006',	'Pembimbing Thesis',	'S2',	'2018-07-10 08:23:41',	'2018-07-10 08:23:41',	NULL,	7,	0),
(8,	'JNS008',	'Pembimbing Disertasi',	'S3',	'2018-07-10 08:24:19',	'2018-07-10 08:24:19',	NULL,	7,	0),
(10,	'JNS010',	'Tugas Skripsi',	'Tugas Syarat Mengajukan Sidang',	'2018-09-10 04:33:02',	'2018-09-10 04:33:02',	NULL,	7,	0),
(11,	'Seminar 1',	'Seminar 1',	'S1',	'2018-11-16 10:27:49',	'2018-11-16 10:27:49',	NULL,	11,	0),
(12,	'Seminar 2',	'Seminar 2',	'S1',	'2018-11-16 10:28:06',	'2018-11-16 10:28:06',	NULL,	11,	0),
(13,	'ENMT600036',	'Seminar',	'S1',	'2018-11-16 10:28:15',	'2018-11-16 10:28:15',	NULL,	8,	0),
(14,	'Sidang Skripsi',	'Sidang Skripsi',	'S1',	'2018-11-16 10:28:24',	'2018-11-16 10:28:24',	NULL,	11,	0),
(15,	'ENMT600037',	'Skripsi',	'S1',	'2018-11-16 10:28:42',	'2018-11-16 10:28:42',	NULL,	8,	0),
(16,	'JNS011',	'Ujian Proposal Riset',	'S3',	'2018-12-11 15:48:19',	'2018-12-11 15:48:19',	NULL,	7,	1),
(17,	'JNS012',	'Ujian Hasil Riset',	'S3',	'2018-12-11 15:48:35',	'2018-12-11 15:48:35',	NULL,	7,	2),
(18,	'JNS013',	'Sidang Promosi',	'S3',	'2018-12-11 15:48:47',	'2018-12-11 15:48:47',	NULL,	7,	3);

DROP TABLE IF EXISTS `master_pimpinan`;
CREATE TABLE `master_pimpinan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_pimpinan` (`id`, `dosen_id`, `departemen_id`, `jabatan`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	31,	1,	'Ketua Departemen',	'1',	'2018-07-12 18:29:09',	'2018-07-12 18:29:09',	NULL),
(2,	43,	1,	'Sekretaris Departemen',	'1',	'2018-07-12 18:29:19',	'2018-07-12 18:29:19',	NULL),
(3,	-1,	1,	'Ketua Departemen',	'1',	'2018-10-05 02:20:35',	'2018-12-09 13:01:35',	'2018-12-09 13:01:35'),
(4,	28,	7,	'Ketua Departemen',	'1',	'2018-11-13 11:17:28',	'2018-11-13 11:17:28',	NULL),
(5,	18,	11,	'Ketua Departemen',	'1',	'2018-11-16 10:21:01',	'2018-11-16 10:21:01',	NULL),
(6,	117,	11,	'Sekretaris Departemen',	'1',	'2018-11-16 10:21:22',	'2018-11-16 10:21:22',	NULL),
(7,	1,	7,	'Sekretaris Departemen',	'1',	'2018-11-16 10:26:48',	'2019-01-11 00:15:35',	'2019-01-11 00:15:35');

DROP TABLE IF EXISTS `master_ruangan`;
CREATE TABLE `master_ruangan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `lokasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `master_ruangan` (`id`, `code_ruangan`, `nama_ruangan`, `deskripsi`, `departemen_id`, `lokasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	NULL,	'S.101',	NULL,	1,	'Gedung S',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(2,	NULL,	'EC. 101',	NULL,	1,	'Gedung Engineering Center',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(3,	NULL,	'R. Dosen Hidrolika',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(4,	'R.502',	'R.502',	NULL,	1,	'Gedung F',	'2018-07-12 18:34:30',	'2018-10-05 01:11:04',	NULL),
(5,	NULL,	'Departemen Teknik Sipil',	NULL,	1,	'R. Lab Struktur dan Material',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(6,	NULL,	'Lab Transportasi',	NULL,	1,	'Gedung Engineering Center Lt.5',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(7,	NULL,	'R. 503',	NULL,	1,	'Gedung DTS',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(8,	NULL,	'Ruang Sayap Kiri 1 - Lt. 1',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(9,	NULL,	'Ruang Kaprodi Teknik Lingkungan - Lt. 1',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(10,	NULL,	'Kelas Internasional Lt.1',	NULL,	1,	'Gedung Engineering Center',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(11,	NULL,	'R. Rapat Lt.2',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(12,	NULL,	'A. 118 Lt.1',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(13,	NULL,	'A108',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(14,	NULL,	'A.113',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(15,	NULL,	'Ruang KaProdi Teknik Lingkungan',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(16,	NULL,	'Ruang Rapat Lt.5',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(17,	NULL,	'S 103',	NULL,	1,	'Gedung S',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(18,	NULL,	'S 102',	NULL,	1,	'Gedung S',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(20,	NULL,	'S. 201',	NULL,	1,	'Gedung S',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(21,	NULL,	'S. 202',	NULL,	1,	'Gedung S',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(22,	NULL,	'EC. 103',	NULL,	1,	'Gedung Engineering Center',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(23,	NULL,	'A.114 Lt.1',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(24,	NULL,	'A.104',	NULL,	1,	'DTS',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(25,	NULL,	'Ruang Rapat PSTL - Lantai 4',	NULL,	1,	'Departemen Teknik Sipil',	'2018-07-12 18:34:30',	'2018-07-12 18:34:30',	NULL),
(28,	'-',	'R.Rapat Lt 1',	NULL,	7,	'Gd. A Lt 1',	'2018-11-14 09:47:44',	'2018-11-14 09:47:44',	NULL),
(29,	'02',	'R. Multimedia A',	NULL,	7,	'Gd. B. Lt. 2',	'2018-11-14 09:48:12',	'2018-11-14 09:48:12',	NULL),
(30,	NULL,	'Ruang Rapat Gatrik',	NULL,	7,	'Departemen Teknik Elektro',	'2018-11-21 09:40:37',	'2018-11-21 09:40:37',	NULL);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39,	'2014_10_12_000000_create_users_table',	1),
(40,	'2014_10_12_100000_create_password_resets_table',	1),
(41,	'2017_10_25_020112_create_jenis_dokumen_table',	1),
(42,	'2017_10_25_021242_create_dokumen_table',	1),
(43,	'2017_10_25_022132_create_revisi_table',	1),
(44,	'2018_05_27_022056_create_mahasiswas_table',	1),
(45,	'2018_05_27_022119_create_dosens_table',	1),
(46,	'2018_05_27_022126_create_stafs_table',	1),
(47,	'2018_05_27_022153_create_master_jenis_pengajuans_table',	1),
(48,	'2018_05_27_022338_create_judul_tugas_akhirs_table',	1),
(49,	'2018_05_27_022701_create_jadwals_table',	1),
(50,	'2018_05_27_022728_create_kelompok_k_ps_table',	1),
(51,	'2018_05_27_022754_create_master_ruangans_table',	1),
(52,	'2018_05_27_022805_create_master_pimpinans_table',	1),
(53,	'2018_05_27_022815_create_master_departemens_table',	1),
(54,	'2018_05_27_022851_create_pivot_bimbingans_table',	1),
(55,	'2018_05_27_022901_create_pivot_pengujis_table',	1),
(56,	'2018_05_27_022915_create_pivot_jadwals_table',	1),
(57,	'2018_05_27_061416_create_progam_studis_table',	1),
(59,	'2018_05_27_193334_create_syarat_pengajuans_table',	2),
(60,	'2018_05_28_041853_create_notifikasis_table',	3),
(61,	'2018_05_28_063213_create_pengajuan_skripsis_table',	4),
(62,	'2018_06_02_180630_create_jenjangs_table',	5),
(63,	'2018_06_02_181058_add_column_departemen',	5),
(64,	'2018_06_02_182910_add_column_jenjang',	6),
(65,	'2018_06_06_210921_create_pengajuans_table',	7),
(68,	'2018_06_08_014258_create_table_bimbingan',	8),
(69,	'2018_07_01_161915_add_allow_sidang_pengajuan',	9),
(70,	'2018_07_02_175551_create_pivot_setuju_sidangs_table',	10),
(72,	'2018_07_06_143830_create_pivot_document_sidangs_table',	11),
(73,	'2018_07_08_094449_add_kolum_jenis_dokumen',	12),
(74,	'2018_07_08_100040_add_kolum_departemen_id',	13),
(84,	'2018_07_08_203748_create_create_table_izin_dosens_table',	14),
(85,	'2018_07_08_205418_create_create_table_tahun_ajarans_table',	14),
(86,	'2018_07_08_205431_create_create_table_kalender_akademiks_table',	14),
(87,	'2018_07_08_233941_add_colom_tahun_ajaran',	15),
(89,	'2018_07_10_163727_add_column_status_ketua_kelompok',	16),
(90,	'2018_07_12_213622_create_bidang_kekhususans_table',	17),
(91,	'2018_07_12_235944_create_modules_table',	17),
(92,	'2018_07_12_235955_create_components_table',	17),
(93,	'2018_07_13_000017_create_sub_components_table',	17),
(94,	'2018_07_13_140330_add_kolom_ujian_sidang',	18),
(95,	'2018_07_15_193949_add_bobot',	19),
(96,	'2018_07_15_205147_add_bobot',	20),
(97,	'2018_07_16_111900_create_perbaikan_skripsis_table',	21),
(98,	'2018_07_16_114126_create_perubahan_juduls_table',	21),
(99,	'2018_08_01_104719_add_waktu_jadwal',	22),
(100,	'2018_07_15_205147_add_bobot2',	23),
(101,	'2018_08_06_234740_create_component_scores_table',	23),
(104,	'2018_08_22_015039_create_kerja_prakteks_table',	24),
(105,	'2018_08_24_004308_create_pembimbing_k_ps_table',	25),
(106,	'2018_08_24_004336_create_penguji_k_ps_table',	25),
(108,	'2018_08_29_091751_create_informasi_k_ps_table',	26),
(109,	'2018_09_02_233123_add_status_kp',	27),
(110,	'2018_09_03_104551_create_jadwal_sidang_k_ps_table',	28),
(111,	'2018_09_09_094622_create_quota_bimbingans_table',	29),
(112,	'2018_09_10_142159_create_evaluasi_a_c_c_sidangs_table',	30),
(113,	'2018_10_01_012608_create_quota_pengujis_table',	31),
(114,	'2018_10_01_032605_create_quota_pembimbings_table',	32),
(115,	'2018_10_04_093656_add_colum_mahasiswa',	33),
(116,	'2018_11_12_060217_add_column_dosen',	34),
(117,	'2018_11_14_130958_add_quota_maksimal',	35),
(118,	'2018_11_14_131115_create_quota_jumlah_bimbingans_table',	35),
(119,	'2018_11_14_160230_add_departemen_table_master_pengajuan',	35),
(120,	'2018_11_16_011253_add_jenjang_program_studi',	36),
(121,	'2018_11_16_012407_add_kategori_khusus',	36),
(122,	'2018_11_16_013550_add_status_mahasiswa',	36),
(123,	'2018_12_09_090828_add_pendidikan_dosen',	37),
(124,	'2018_12_09_194601_create_topik_pengajuans_table',	38),
(125,	'2018_12_09_194905_add_bukti_mahasiswa',	38),
(126,	'2018_12_09_201353_add_ielts',	38),
(127,	'2018_12_10_071129_create_nilais_table',	38),
(128,	'2018_12_11_011445_add_urutan_jenis_pengajuan',	38),
(129,	'2018_12_11_030623_add_keterangan_quota_jlh_pembimbing',	39),
(130,	'2018_12_11_052729_add_keterangan_pivot_pembimbing',	39),
(131,	'2018_12_11_053528_add_sk_rektor_pengajuan',	39),
(132,	'2018_12_18_064638_add_pengajuan_id_bimbingan',	40),
(133,	'2018_12_19_011153_add_minimal_penguji',	40),
(134,	'2018_12_19_022904_create_publikasis_table',	40),
(135,	'2018_12_19_031720_add_acc_akademik',	40);

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_module` int(11) DEFAULT '0',
  `jenis_id` int(11) DEFAULT '0',
  `departemen_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `module` (`id`, `code_module`, `nama_module`, `bobot_module`, `jenis_id`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'mod-1-986',	'Penilaian Skripsi',	100,	1,	7,	'2018-07-15 08:57:52',	'2018-07-16 04:55:00',	NULL),
(2,	'mod-1-383',	'Uraian',	100,	10,	7,	'2018-09-10 04:43:32',	'2018-09-10 04:43:32',	NULL),
(3,	'mod-1-638',	'Nilai Seminar',	290,	1,	7,	'2018-10-05 02:57:54',	'2018-10-05 03:01:10',	NULL),
(4,	'mod-1-884',	'Seminar Skripsi',	100,	4,	7,	'2018-10-05 03:02:12',	'2018-10-05 03:02:12',	NULL);

DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penilai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal_id` int(11) DEFAULT '0',
  `pengajuan_id` int(11) DEFAULT '0',
  `nilai_angka` int(11) DEFAULT '0',
  `persen` double(8,2) DEFAULT '0.00',
  `subtotal` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `huruf` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `komponen_id` int(11) DEFAULT '0',
  `dosen_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE `notifikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `seen` datetime DEFAULT NULL,
  `flag_active` int(11) NOT NULL DEFAULT '0',
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notifikasi` (`id`, `title`, `from`, `to`, `seen`, `flag_active`, `pesan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Menunggu Verifikasi Pengajuan',	1,	168,	NULL,	0,	'Mahasiswa : Ramadhan Melakukan Pengajuan, Harap Segera Di Verifikasi<br>\n                <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-15 09:34:54',	'2019-01-11 00:01:19',	NULL),
(2,	'Pengajuan Dosen Pembimbing',	400,	213,	NULL,	1,	'Mahasiswa : Ramadhan Mengajukan untuk menjadi Dosen Pembimbing Pembimbing Seminar<br><a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-15 09:34:54',	'2018-11-15 09:34:54',	NULL),
(3,	'Pengajuan Dosen Pembimbing',	400,	369,	NULL,	1,	'Mahasiswa : Ramadhan Mengajukan untuk menjadi Dosen Pembimbing Pembimbing Seminar<br><a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-15 09:34:54',	'2018-11-15 09:34:54',	NULL),
(4,	'Pengajuan Dosen Pembimbing',	400,	334,	NULL,	1,	'Mahasiswa : Ramadhan Mengajukan untuk menjadi Dosen Pembimbing Pembimbing Seminar<br><a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-15 09:34:54',	'2018-11-15 09:34:54',	NULL),
(5,	'Pengajuan Bimbingan Telah Di Setujui',	213,	158,	NULL,	1,	'Dosen <b>Dr.Eng., Ir. Arief Udhiarto, S.T., M.T.</b> : Pengajuan Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui',	'2018-11-15 09:45:44',	'2018-11-15 09:45:44',	NULL),
(6,	'Pengajuan Telah Di Verifikasi',	3,	158,	NULL,	1,	'Staf : Pengajuan Anda dengan Judul <b>-</b>Telah Di Verifikasi',	'2018-11-15 09:46:28',	'2018-11-15 09:46:28',	NULL),
(7,	'Menunggu Verifikasi Data Bimbingan',	400,	213,	NULL,	1,	'Mahasiswa : Ramadhan Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-15 09:48:39',	'2018-11-15 09:48:39',	NULL),
(8,	'Menunggu Verifikasi Data Bimbingan',	400,	213,	NULL,	1,	'Mahasiswa : Ramadhan Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-15 09:49:12',	'2018-11-15 09:49:12',	NULL),
(9,	'Menunggu Verifikasi Data Bimbingan',	400,	213,	NULL,	1,	'Mahasiswa : Ramadhan Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-15 09:50:01',	'2018-11-15 09:50:01',	NULL),
(10,	'Menunggu Verifikasi Data Bimbingan',	400,	213,	NULL,	1,	'Mahasiswa : Ramadhan Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-15 10:04:26',	'2018-11-15 10:04:26',	NULL),
(11,	'Menunggu Verifikasi Pengajuan Sidang',	1,	168,	NULL,	0,	'Mahasiswa : Ramadhan Melakukan Pengajuan Sidang, Harap Segera Di Verifikasi',	'2018-11-15 10:06:07',	'2019-01-11 00:01:19',	NULL),
(12,	'Jadwal Menguji Sidang',	168,	213,	NULL,	1,	'Anda Mendapatkan Jadwal Menguji Sidang Mahasiswa :<u></u> <br>Pada Tanggal : <u>30 November 2018 </u>\n                    <br>Ruangan : - - R.Rapat Lt 1',	'2018-11-15 10:20:18',	'2018-11-15 10:20:18',	NULL),
(13,	'Menunggu Verifikasi',	401,	168,	NULL,	0,	'Mahasiswa : Fachran Nazarullah Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/1\'>Klik Disini</a>',	'2018-11-16 10:33:56',	'2018-11-16 10:34:34',	NULL),
(14,	'Menunggu Verifikasi Pengajuan',	1,	168,	NULL,	0,	'Mahasiswa : Fachran Nazarullah Melakukan Pengajuan, Harap Segera Di Verifikasi<br>\n                <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-16 10:41:26',	'2019-01-11 00:01:17',	NULL),
(15,	'Pengajuan Dosen Pembimbing',	401,	187,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Mengajukan untuk menjadi Dosen Pembimbing Pembimbing Seminar<br><a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-16 10:41:26',	'2018-11-16 10:41:26',	NULL),
(16,	'Pengajuan Dosen Pembimbing',	401,	213,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Mengajukan untuk menjadi Dosen Pembimbing Pembimbing Seminar<br><a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-16 10:41:26',	'2018-11-16 10:41:26',	NULL),
(17,	'Pengajuan Dosen Pembimbing',	401,	321,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Mengajukan untuk menjadi Dosen Pembimbing Pembimbing Seminar<br><a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1\'>Klik Disini</a>',	'2018-11-16 10:41:26',	'2018-11-16 10:41:26',	NULL),
(18,	'Menunggu Verifikasi',	402,	169,	NULL,	0,	'Mahasiswa : Wahyuaji Dummy Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/2\'>Klik Disini</a>',	'2018-11-16 10:47:23',	'2018-11-16 10:47:36',	NULL),
(19,	'Sudah Di Verifikasi',	169,	402,	NULL,	0,	'Akun Anda Sudah Di Verifikasi Oleh Sekretariat, Silahkan Lakukan Update Profil Anda<br>\n                        <a href=\'http://sima-sp.abrisamedia.com/profil\'>Klik Disini</a>',	'2018-11-16 10:48:02',	'2018-11-16 10:56:00',	NULL),
(20,	'Pengajuan Bimbingan Telah Di Setujui',	213,	158,	NULL,	1,	'Dosen <b>Dr.Eng., Ir. Arief Udhiarto, S.T., M.T.</b> : Pengajuan Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui',	'2018-11-16 10:57:35',	'2018-11-16 10:57:35',	NULL),
(21,	'Pengajuan Telah Di Verifikasi',	3,	158,	NULL,	1,	'Staf : Pengajuan Anda dengan Judul <b>-</b>Telah Di Verifikasi',	'2018-11-16 10:59:36',	'2018-11-16 10:59:36',	NULL),
(22,	'Menunggu Verifikasi Data Bimbingan',	401,	213,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-16 11:01:08',	'2018-11-16 11:01:08',	NULL),
(23,	'Menunggu Verifikasi Data Bimbingan',	401,	213,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-16 11:02:21',	'2018-11-16 11:02:21',	NULL),
(24,	'Menunggu Verifikasi Data Bimbingan',	401,	213,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-16 11:02:35',	'2018-11-16 11:02:35',	NULL),
(25,	'Menunggu Verifikasi Data Bimbingan',	401,	213,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-16 11:02:50',	'2018-11-16 11:02:50',	NULL),
(26,	'Menunggu Verifikasi Data Bimbingan',	401,	213,	NULL,	1,	'Mahasiswa : Fachran Nazarullah Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/1/1#tab_5_2\'>Klik Disini</a>',	'2018-11-16 11:02:59',	'2018-11-16 11:02:59',	NULL),
(27,	'Data Bimbingan Telah DI Setujui',	213,	158,	NULL,	1,	'Dosen : Data Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui<br>\n        <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1#tab_5_2\'></a>',	'2018-11-16 11:03:37',	'2018-11-16 11:03:37',	NULL),
(28,	'Data Bimbingan Telah DI Setujui',	213,	158,	NULL,	1,	'Dosen : Data Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui<br>\n        <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1#tab_5_2\'></a>',	'2018-11-16 11:03:40',	'2018-11-16 11:03:40',	NULL),
(29,	'Data Bimbingan Telah DI Setujui',	213,	158,	NULL,	1,	'Dosen : Data Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui<br>\n        <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1#tab_5_2\'></a>',	'2018-11-16 11:03:43',	'2018-11-16 11:03:43',	NULL),
(30,	'Data Bimbingan Telah DI Setujui',	213,	158,	NULL,	1,	'Dosen : Data Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui<br>\n        <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1#tab_5_2\'></a>',	'2018-11-16 11:03:45',	'2018-11-16 11:03:45',	NULL),
(31,	'Data Bimbingan Telah DI Setujui',	213,	158,	NULL,	1,	'Dosen : Data Bimbingan Mahasiswa <u>Staf Admin Sipil</u> Sudah Setujui<br>\n        <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/1#tab_5_2\'></a>',	'2018-11-16 11:03:47',	'2018-11-16 11:03:47',	NULL),
(32,	'Menunggu Verifikasi Pengajuan Sidang',	1,	168,	NULL,	0,	'Mahasiswa : Fachran Nazarullah Melakukan Pengajuan Sidang, Harap Segera Di Verifikasi',	'2018-11-16 11:05:05',	'2019-01-11 00:01:10',	NULL),
(33,	'Jadwal Menguji Sidang',	168,	213,	NULL,	1,	'Anda Mendapatkan Jadwal Menguji Sidang Mahasiswa :<u></u> <br>Pada Tanggal : <u>22 November 2018 </u>\n                    <br>Ruangan : 02 - R. Multimedia A',	'2018-11-16 11:13:31',	'2018-11-16 11:13:31',	NULL),
(34,	'Menunggu Verifikasi',	403,	122,	NULL,	1,	'Mahasiswa : Widya Wuri Handayani Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/3\'>Klik Disini</a>',	'2018-12-09 13:58:10',	'2018-12-09 13:58:10',	NULL),
(35,	'Menunggu Verifikasi',	403,	123,	NULL,	1,	'Mahasiswa : Widya Wuri Handayani Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/3\'>Klik Disini</a>',	'2018-12-09 13:58:10',	'2018-12-09 13:58:10',	NULL),
(36,	'Menunggu Verifikasi',	403,	173,	NULL,	0,	'Mahasiswa : Widya Wuri Handayani Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/3\'>Klik Disini</a>',	'2018-12-09 13:58:10',	'2018-12-09 13:58:28',	NULL),
(37,	'Menunggu Verifikasi',	403,	183,	NULL,	1,	'Mahasiswa : Widya Wuri Handayani Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/3\'>Klik Disini</a>',	'2018-12-09 13:58:10',	'2018-12-09 13:58:10',	NULL),
(38,	'Menunggu Verifikasi',	403,	184,	NULL,	1,	'Mahasiswa : Widya Wuri Handayani Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/3\'>Klik Disini</a>',	'2018-12-09 13:58:10',	'2018-12-09 13:58:10',	NULL),
(39,	'Sudah Di Verifikasi',	173,	403,	NULL,	1,	'Akun Anda Sudah Di Verifikasi Oleh Sekretariat, Silahkan Lakukan Update Profil Anda<br>\n                        <a href=\'http://sima-sp.abrisamedia.com/profil\'>Klik Disini</a>',	'2018-12-09 13:58:33',	'2018-12-09 13:58:33',	NULL),
(40,	'Menunggu Verifikasi',	404,	168,	NULL,	0,	'Mahasiswa : Salman Melakukan Registrasi, Harap Segera Di Verifikasi<br><a href=\'http://sima-sp.abrisamedia.com/mahasiswa-detail/4\'>Klik Disini</a>',	'2018-12-11 15:58:05',	'2018-12-11 15:58:18',	NULL),
(41,	'Sudah Di Verifikasi',	168,	404,	NULL,	1,	'Akun Anda Sudah Di Verifikasi Oleh Sekretariat, Silahkan Lakukan Update Profil Anda<br>\n                        <a href=\'http://sima-sp.abrisamedia.com/profil\'>Klik Disini</a>',	'2018-12-11 15:59:57',	'2018-12-11 15:59:57',	NULL),
(42,	'Menunggu Verifikasi Pengajuan',	4,	168,	NULL,	0,	'Mahasiswa : Salman Melakukan Pengajuan, Harap Segera Di Verifikasi<br>\n                <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/2\'>Klik Disini</a>',	'2018-12-11 16:08:27',	'2019-01-11 00:01:08',	NULL),
(43,	'Menunggu Verifikasi Pengajuan',	4,	168,	NULL,	0,	'Mahasiswa : Salman Melakukan Pengajuan, Harap Segera Di Verifikasi<br>\n                <a href=\'http://sima-sp.abrisamedia.com/pengajuan-detail/3\'>Klik Disini</a>',	'2018-12-11 16:08:32',	'2019-01-11 00:01:05',	NULL),
(44,	'Menunggu Verifikasi Data Bimbingan',	404,	213,	NULL,	1,	'Mahasiswa : Salman Menambahkan Data Bimbingan, Mohon Dapat Segera Di Verifikasi<br>\n        <a href=\'http://sima-sp.abrisamedia.com/bimbingan-detail/2/4#tab_5_2\'>Klik Disini</a>',	'2018-12-11 16:11:26',	'2018-12-11 16:11:26',	NULL),
(45,	'Pengajuan Telah Di Verifikasi',	3,	169,	NULL,	1,	'Staf : Pengajuan Anda dengan Judul <b>-Fabrikasi OLED dengan metode laminasi</b>Telah Di Verifikasi',	'2018-12-11 16:13:07',	'2018-12-11 16:13:07',	NULL);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pembimbing_k_p`;
CREATE TABLE `pembimbing_k_p` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `departemen_id` int(11) DEFAULT '0',
  `grup_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `tahunajaran_id` int(11) DEFAULT '1',
  `ielts` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ielts` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_rektor_promotor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_manager_akademik` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pengajuan` (`id`, `jenis_id`, `ipk_terakhir`, `jumlah_sks_lulus`, `topik_diajukan`, `bidang`, `skema`, `judul_ind`, `judul_eng`, `deskripsi_rencana`, `abstrak_ind`, `abstrak_eng`, `pengambilan_ke`, `dospem1`, `dospem2`, `dospem3`, `dosen_ketua`, `pembimbing_sebelumnya`, `alasan_mengulang`, `status_pengajuan`, `departemen_id`, `mahasiswa_id`, `created_at`, `updated_at`, `deleted_at`, `allow_sidang`, `tahunajaran_id`, `ielts`, `file_ielts`, `sk_rektor_promotor`, `acc_manager_akademik`) VALUES
(1,	4,	0.00,	0,	'Topik Usulan',	'-',	'Penelitian Dosen',	'-',	'-',	'Deskripsi&nbsp;',	'-',	'-',	1,	0,	0,	0,	-1,	0,	NULL,	2,	7,	1,	'2018-11-16 10:41:26',	'2018-11-16 11:13:31',	NULL,	0,	5,	NULL,	NULL,	NULL,	0),
(2,	16,	0.00,	0,	'-Organic LED',	'-',	'Penelitian Dosen',	'-Fabrikasi OLED dengan metode laminasi',	'-OLED fabicration using lamination method',	'-oled aja<br>',	'-',	'-',	1,	0,	0,	0,	-1,	0,	NULL,	1,	7,	4,	'2018-12-11 16:08:27',	'2018-12-11 16:13:07',	NULL,	0,	5,	NULL,	NULL,	'sk-rektor/masukan SIMASP.txt',	0),
(3,	16,	0.00,	0,	'-Organic LED',	'-',	'Penelitian Dosen',	'-Fabrikasi OLED dengan metode laminasi',	'-OLED fabicration using lamination method',	'-oled aja<br>',	'-',	'-',	1,	0,	0,	0,	-1,	0,	NULL,	0,	7,	4,	'2018-12-11 16:08:32',	'2018-12-11 16:08:38',	'2018-12-11 16:08:38',	0,	5,	NULL,	NULL,	NULL,	0);

DROP TABLE IF EXISTS `pengajuan_skripsi`;
CREATE TABLE `pengajuan_skripsi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `penguji_k_p`;
CREATE TABLE `penguji_k_p` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pivot_jadwal_id` int(11) DEFAULT '0',
  `grup_id` int(11) DEFAULT '0',
  `penguji_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `perbaikan_skripsi`;
CREATE TABLE `perbaikan_skripsi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `pembimbing_id` int(11) DEFAULT '0',
  `perbaikan` text COLLATE utf8mb4_unicode_ci,
  `batas_waktu` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `perubahan_judul`;
CREATE TABLE `perubahan_judul` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengajuan_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `judul_ind` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_ing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pivot_bimbingan`;
CREATE TABLE `pivot_bimbingan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `jenis_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pivot_bimbingan` (`id`, `dosen_id`, `mahasiswa_id`, `jenis_bimbingan`, `judul_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `keterangan`) VALUES
(1,	1,	1,	'Pembimbing Seminar',	1,	'1',	'2018-11-16 10:41:26',	'2018-11-16 10:58:35',	NULL,	NULL),
(2,	27,	1,	'Pembimbing Seminar',	1,	'1',	'2018-11-16 10:41:26',	'2018-11-16 10:57:35',	NULL,	NULL),
(3,	135,	1,	'Pembimbing Seminar',	1,	'1',	'2018-11-16 10:41:26',	'2018-11-16 10:58:39',	NULL,	NULL),
(7,	27,	4,	'Ujian Proposal Riset',	3,	'1',	'2018-12-11 16:08:32',	'2018-12-11 16:08:32',	NULL,	'promotor'),
(8,	91,	4,	'Ujian Proposal Riset',	3,	'1',	'2018-12-11 16:08:32',	'2018-12-11 16:08:32',	NULL,	'co-promotor'),
(9,	143,	4,	'Ujian Proposal Riset',	3,	'1',	'2018-12-11 16:08:32',	'2018-12-11 16:08:32',	NULL,	'co-promotor');

DROP TABLE IF EXISTS `pivot_document_sidang`;
CREATE TABLE `pivot_document_sidang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pivot_document_sidang` (`id`, `file`, `type`, `pengajuan_id`, `mahasiswa_id`, `jadwal_id`, `created_at`, `updated_at`, `deleted_at`, `jenis_dokumen`, `departemen_id`, `status`) VALUES
(1,	'dokumen_doc/1-181116-curriculum-vitae.doc',	'doc',	1,	1,	1,	'2018-11-16 11:05:05',	'2018-11-16 11:06:16',	NULL,	'\'dokumen_doc\'',	7,	1),
(2,	'dokumen_pdf/1-181116-kwitansi ziswaf.pdf',	'pdf',	1,	1,	1,	'2018-11-16 11:05:05',	'2018-11-16 11:06:19',	NULL,	'\'dokumen_pdf\'',	7,	1);

DROP TABLE IF EXISTS `pivot_jadwal`;
CREATE TABLE `pivot_jadwal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) NOT NULL DEFAULT '0',
  `ruangan_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `judul_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pivot_jadwal` (`id`, `jadwal_id`, `ruangan_id`, `mahasiswa_id`, `judul_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	0,	1,	1,	'0',	'2018-11-16 11:05:05',	'2018-11-16 11:05:05',	NULL),
(2,	2,	29,	1,	1,	'0',	'2018-11-16 11:13:31',	'2018-11-16 11:13:31',	NULL);

DROP TABLE IF EXISTS `pivot_penguji`;
CREATE TABLE `pivot_penguji` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pivot_jadwal_id` int(11) NOT NULL DEFAULT '0',
  `penguji_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT '0',
  `pengajuan_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pivot_penguji` (`id`, `pivot_jadwal_id`, `penguji_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `mahasiswa_id`, `pengajuan_id`) VALUES
(1,	0,	27,	0,	'2018-11-16 11:08:36',	'2018-11-16 11:08:36',	NULL,	1,	1);

DROP TABLE IF EXISTS `pivot_setuju_sidang`;
CREATE TABLE `pivot_setuju_sidang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL DEFAULT '0',
  `mahasiswa_id` int(11) NOT NULL DEFAULT '0',
  `jenis_bimbingan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengajuan_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pivot_setuju_sidang` (`id`, `dosen_id`, `mahasiswa_id`, `jenis_bimbingan`, `pengajuan_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	27,	1,	'Skripsi',	1,	'1',	'2018-11-16 11:07:41',	'2018-11-16 11:07:41',	NULL),
(2,	1,	1,	'Pembimbing Seminar',	1,	'1',	'2018-11-16 11:10:04',	'2018-11-16 11:10:04',	NULL),
(3,	135,	1,	'Pembimbing Seminar',	1,	'1',	'2018-11-16 11:10:04',	'2018-11-16 11:10:04',	NULL);

DROP TABLE IF EXISTS `progam_studis`;
CREATE TABLE `progam_studis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_program_studi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pimpinan_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jenjang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `progam_studis` (`id`, `code`, `nama_program_studi`, `departemen_id`, `keterangan`, `pimpinan_id`, `created_at`, `updated_at`, `deleted_at`, `jenjang`) VALUES
(12,	NULL,	'Reguler Teknik Lingkungan',	1,	NULL,	145,	'2018-07-12 18:23:37',	'2018-11-16 10:22:37',	NULL,	'S1'),
(13,	NULL,	'S1 Reguler Teknik Sipil',	1,	NULL,	-1,	'2018-07-12 18:23:54',	'2018-07-12 18:23:54',	NULL,	NULL),
(14,	NULL,	'Paralel Teknik Sipil',	1,	NULL,	161,	'2018-07-12 18:24:04',	'2018-11-16 10:22:00',	NULL,	'S1'),
(15,	NULL,	'Paralel Teknik Lingkungan',	1,	NULL,	145,	'2018-07-12 18:24:19',	'2018-11-16 10:21:31',	NULL,	'S1'),
(16,	NULL,	'S2 Reguler Depok Teknik Sipil',	1,	NULL,	-1,	'2018-07-12 18:24:32',	'2018-07-12 18:24:32',	NULL,	NULL),
(17,	NULL,	'S2 Kelas Khusus Salemba Teknik Sipil',	1,	NULL,	-1,	'2018-07-12 18:24:42',	'2018-07-12 18:24:42',	NULL,	NULL),
(18,	NULL,	'Kelas Khusus Internasional',	1,	NULL,	161,	'2018-07-12 18:24:52',	'2018-11-16 10:22:17',	NULL,	'S1'),
(19,	NULL,	'Program Studi Ekstensi',	1,	NULL,	-1,	'2018-07-12 18:25:02',	'2018-11-16 10:18:02',	'2018-11-16 10:18:02',	NULL),
(20,	NULL,	'Kelas Khusus Internasional',	1,	NULL,	-1,	'2018-10-05 01:56:57',	'2018-11-16 10:17:47',	'2018-11-16 10:17:47',	NULL),
(21,	NULL,	NULL,	-1,	NULL,	-1,	'2018-10-05 02:08:51',	'2018-10-05 02:08:51',	NULL,	NULL),
(22,	NULL,	'S1 Reguler Teknik Lingkungan',	1,	NULL,	-1,	'2018-10-05 02:15:29',	'2018-11-16 10:17:52',	'2018-11-16 10:17:52',	NULL),
(23,	NULL,	NULL,	1,	NULL,	-1,	'2018-10-05 02:16:33',	'2018-10-05 02:16:33',	NULL,	NULL),
(24,	NULL,	NULL,	-1,	NULL,	-1,	'2018-10-05 02:17:05',	'2018-10-05 02:17:05',	NULL,	NULL),
(25,	NULL,	'Reguler Teknik Perkapalan',	2,	NULL,	2,	'2018-10-26 18:43:25',	'2018-10-26 18:43:25',	NULL,	NULL),
(26,	NULL,	'S1 Reguler - Teknik Metalurgi dan Material',	8,	NULL,	14,	'2018-10-26 18:43:31',	'2018-11-16 10:21:47',	NULL,	'S1'),
(27,	NULL,	'S2 - Teknik Metalurgi dan Material',	8,	NULL,	14,	'2018-10-26 18:43:44',	'2018-11-16 10:18:30',	NULL,	'S2'),
(28,	NULL,	'S3 - Teknik Metalurgi dan Material',	8,	NULL,	14,	'2018-10-26 18:43:59',	'2018-11-16 10:18:40',	NULL,	'S3'),
(29,	NULL,	'S1 Teknik Elektro',	7,	'ini cuma testing',	28,	'2018-10-26 18:48:04',	'2018-11-16 10:34:42',	NULL,	'S1'),
(30,	NULL,	'S1 Teknik Komputer',	7,	NULL,	28,	'2018-11-13 11:16:39',	'2018-11-16 10:35:07',	NULL,	'S1'),
(31,	NULL,	'S1 Teknik Industri Depok',	11,	NULL,	18,	'2018-11-16 10:18:26',	'2018-11-16 10:19:09',	NULL,	'S1'),
(32,	NULL,	'Arsitektur',	10,	NULL,	51,	'2018-11-16 10:18:42',	'2018-11-16 10:18:42',	NULL,	'S1'),
(33,	NULL,	'S1 Teknik Biomedik',	7,	NULL,	38,	'2018-11-16 10:18:52',	'2018-11-16 10:34:25',	NULL,	'S1'),
(34,	NULL,	'Arsitektur Interior',	10,	NULL,	51,	'2018-11-16 10:19:05',	'2018-11-16 10:19:05',	NULL,	'S1'),
(35,	NULL,	'Arsitektur',	10,	NULL,	51,	'2018-11-16 10:19:23',	'2018-11-16 10:19:23',	NULL,	'S2'),
(36,	NULL,	'S1 Teknik Industri KKI',	11,	NULL,	18,	'2018-11-16 10:19:35',	'2018-11-16 10:19:35',	NULL,	'S1'),
(37,	NULL,	'Arsitektur',	10,	NULL,	51,	'2018-11-16 10:19:49',	'2018-11-16 10:19:49',	NULL,	'S3'),
(38,	NULL,	'S2 Teknik Industri Depok',	11,	NULL,	18,	'2018-11-16 10:19:56',	'2018-11-16 10:20:34',	NULL,	'S2'),
(39,	NULL,	'S2 Teknik Industri Salemba',	11,	NULL,	18,	'2018-11-16 10:20:22',	'2018-11-16 10:20:22',	NULL,	'S2'),
(40,	NULL,	'S1 Paralel - Teknik Metalurgi dan Material',	8,	NULL,	14,	'2018-11-16 10:22:15',	'2018-11-16 10:22:15',	NULL,	'S1'),
(41,	NULL,	'S1 KKI - Teknik Metalurgi dan Material',	8,	NULL,	14,	'2018-11-16 10:22:33',	'2018-11-16 10:22:33',	NULL,	'S1'),
(42,	NULL,	'S2 Teknik Elektro',	7,	NULL,	28,	'2018-11-16 10:23:17',	'2018-11-16 10:34:55',	NULL,	'S2'),
(43,	NULL,	'Teknik',	7,	NULL,	-1,	'2018-11-16 10:23:55',	'2018-11-16 10:25:21',	'2018-11-16 10:25:21',	'S1'),
(44,	NULL,	'S2 Teknologi Biomedis',	7,	NULL,	38,	'2018-11-16 10:25:07',	'2018-11-16 10:35:17',	NULL,	'S2'),
(45,	NULL,	'S3 Teknik  Elektro',	7,	NULL,	28,	'2018-11-16 10:26:18',	'2018-11-16 10:34:13',	NULL,	'S3');

DROP TABLE IF EXISTS `publikasi`;
CREATE TABLE `publikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengajuan_id` int(11) DEFAULT '0',
  `mahasiswa_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_publikasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `quota_bimbingan`;
CREATE TABLE `quota_bimbingan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quota` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quota_bimbingan` (`id`, `departemen_id`, `level`, `quota`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5,	1,	'Total',	14,	'2018-09-30 19:03:37',	'2018-09-30 19:03:37',	NULL),
(6,	1,	'S2',	8,	'2018-09-30 19:10:53',	'2018-09-30 19:10:53',	NULL),
(7,	1,	'S3',	6,	'2018-09-30 19:11:03',	'2018-11-09 14:58:07',	NULL),
(8,	1,	'S1',	2,	'2018-09-30 19:11:10',	'2018-09-30 19:11:39',	NULL),
(9,	1,	'S1',	0,	'2018-10-05 02:38:33',	'2018-10-05 02:40:31',	'2018-10-05 02:40:31'),
(10,	7,	'Total',	14,	'2018-11-15 10:30:16',	'2018-11-15 10:30:16',	NULL),
(11,	7,	'S3',	6,	'2018-11-15 10:30:33',	'2018-11-15 10:30:33',	NULL),
(12,	7,	'S2',	8,	'2018-11-15 10:30:40',	'2018-11-15 10:30:40',	NULL),
(13,	7,	'S1',	0,	'2018-11-15 10:30:45',	'2018-11-15 10:30:45',	NULL),
(14,	8,	'Total',	14,	'2018-11-16 11:35:10',	'2018-11-16 11:35:10',	NULL);

DROP TABLE IF EXISTS `quota_jumlah_bimbingan`;
CREATE TABLE `quota_jumlah_bimbingan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimal` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quota_jumlah_bimbingan` (`id`, `departemen_id`, `level`, `minimal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	7,	'4',	4,	'2018-11-15 09:49:34',	'2018-11-15 10:03:57',	NULL),
(2,	7,	'16',	1,	'2018-12-11 16:20:28',	'2018-12-11 16:20:28',	NULL);

DROP TABLE IF EXISTS `quota_pembimbing`;
CREATE TABLE `quota_pembimbing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quota` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `maksimal` int(11) DEFAULT '0',
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quota_pembimbing` (`id`, `departemen_id`, `level`, `quota`, `created_at`, `updated_at`, `deleted_at`, `maksimal`, `keterangan`) VALUES
(1,	1,	'S1',	2,	'2018-09-30 20:30:03',	'2018-09-30 20:30:38',	'2018-09-30 20:30:38',	0,	NULL),
(2,	1,	'3',	2,	'2018-09-30 20:41:20',	'2018-09-30 20:41:20',	NULL,	0,	NULL),
(3,	1,	'1',	2,	'2018-09-30 20:44:02',	'2018-09-30 20:44:02',	NULL,	0,	NULL),
(4,	1,	'2',	1,	'2018-09-30 20:44:09',	'2018-09-30 20:44:09',	NULL,	0,	NULL),
(5,	1,	'5',	2,	'2018-09-30 20:44:30',	'2018-09-30 20:44:30',	NULL,	0,	NULL),
(6,	1,	'1',	0,	'2018-10-05 02:51:30',	'2018-10-05 02:51:30',	NULL,	0,	NULL),
(7,	1,	'3',	0,	'2018-10-05 02:53:20',	'2018-10-05 02:56:19',	'2018-10-05 02:56:19',	0,	NULL),
(8,	1,	'3',	1,	'2018-10-05 02:53:29',	'2018-10-05 02:53:29',	NULL,	0,	NULL),
(9,	7,	'4',	1,	'2018-11-15 09:33:45',	'2018-11-15 09:33:45',	NULL,	3,	NULL),
(10,	7,	'16',	1,	'2018-12-11 15:51:38',	'2018-12-11 15:51:38',	NULL,	3,	'Promotor'),
(11,	7,	'16',	2,	'2018-12-11 15:52:06',	'2018-12-11 15:52:06',	NULL,	5,	'Co-Promotor'),
(12,	7,	'17',	1,	'2018-12-11 15:52:27',	'2018-12-11 15:52:27',	NULL,	3,	'Promotor'),
(13,	7,	'17',	2,	'2018-12-11 15:53:11',	'2018-12-11 15:53:11',	NULL,	5,	'Co-Promotor'),
(14,	7,	'18',	1,	'2018-12-11 15:55:21',	'2018-12-11 15:55:21',	NULL,	3,	'Promotor'),
(15,	7,	'18',	1,	'2018-12-11 15:55:31',	'2018-12-11 15:55:51',	'2018-12-11 15:55:51',	3,	'Co-Promotor'),
(16,	7,	'18',	2,	'2018-12-11 15:55:43',	'2018-12-11 15:55:43',	NULL,	5,	'Co-Promotor');

DROP TABLE IF EXISTS `quota_penguji`;
CREATE TABLE `quota_penguji` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departemen_id` int(11) DEFAULT '0',
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quota` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `minimal` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quota_penguji` (`id`, `departemen_id`, `level`, `quota`, `created_at`, `updated_at`, `deleted_at`, `minimal`) VALUES
(1,	1,	'1',	0,	'2018-10-05 02:43:41',	'2018-10-05 02:43:41',	NULL,	0),
(2,	1,	'1',	1,	'2018-10-05 02:43:57',	'2018-10-05 02:43:57',	NULL,	0),
(3,	1,	'1',	2,	'2018-10-05 02:44:04',	'2018-10-05 02:44:04',	NULL,	0),
(4,	7,	'4',	1,	'2018-11-09 15:07:37',	'2018-11-09 15:07:37',	NULL,	0),
(5,	7,	'3',	1,	'2018-11-09 15:10:42',	'2018-11-09 15:10:42',	NULL,	0);

DROP TABLE IF EXISTS `revisi`;
CREATE TABLE `revisi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_dokumen` int(11) NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `staf`;
CREATE TABLE `staf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `staf` (`id`, `nip`, `inisial`, `nama`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `kota`, `email`, `hp`, `departemen_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'123123123',	'ASIP',	'Staf Admin Sipil',	NULL,	'2018-07-13',	1,	NULL,	NULL,	'admin.sipil@email.com',	NULL,	1,	'2018-07-12 18:10:08',	'2018-07-12 18:10:08',	NULL),
(2,	'123123123',	NULL,	'Staf Admin Sipil',	NULL,	'2018-10-04',	1,	NULL,	NULL,	NULL,	NULL,	-1,	'2018-10-05 02:05:05',	'2018-10-19 12:16:46',	'2018-10-19 12:16:46'),
(3,	'111111',	'sa-e',	'Staf Admin Elektro',	NULL,	'2018-10-19',	1,	NULL,	NULL,	'admin.elektro@email.com',	NULL,	7,	'2018-10-19 12:16:37',	'2018-10-19 12:16:37',	NULL),
(4,	'11223344',	'sa-mm',	'Staf Admin Metalurgi dan Material',	NULL,	'2018-10-19',	1,	NULL,	NULL,	'admin.metal@email.com',	NULL,	8,	'2018-10-19 12:41:17',	'2018-10-19 12:41:17',	NULL),
(5,	'11223355',	'sa-m',	'Staf Admin Mesin',	NULL,	'2018-10-19',	1,	NULL,	NULL,	'admin.mesin@email.com',	NULL,	2,	'2018-10-19 12:42:03',	'2018-10-19 12:42:03',	NULL),
(6,	'11223366',	'sa-k',	'Staf Admin Kimia',	NULL,	'2018-10-19',	1,	NULL,	NULL,	'admin.kimia@email.com',	NULL,	9,	'2018-10-19 12:43:18',	'2018-10-19 12:43:18',	NULL),
(7,	'11223377',	'sa-a',	'Staf Admin Arsitek',	NULL,	'2018-10-19',	1,	NULL,	NULL,	'admin.arsitek@email.com',	NULL,	10,	'2018-10-19 12:43:49',	'2018-10-19 12:43:49',	NULL),
(8,	'11223388',	'sa-i',	'Staf Admin Industri',	NULL,	'2018-10-19',	1,	NULL,	NULL,	'admin.industri@email.com',	NULL,	11,	'2018-10-19 12:44:17',	'2018-10-19 12:44:17',	NULL),
(9,	'123456',	'IAY',	'Indah Ayu Yuliani',	'Tangerang',	'2018-11-01',	2,	NULL,	NULL,	'ayu@email.com',	NULL,	11,	'2018-11-01 20:48:39',	'2018-11-01 20:48:58',	NULL),
(10,	'1234567',	'DFA',	'Dudy Fathan Ali',	'Depok',	'2018-11-01',	1,	NULL,	NULL,	'dfa@email.com',	NULL,	11,	'2018-11-01 20:58:44',	'2018-11-01 20:58:56',	NULL);

DROP TABLE IF EXISTS `sub_component`;
CREATE TABLE `sub_component` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sub_component` (`id`, `code_sub_component`, `nama_sub_component`, `category_sub_component`, `bobot_sub_component`, `component_id`, `created_at`, `updated_at`, `deleted_at`, `nilai_min`, `nilai_max`, `huruf_mutu`, `keterangan`) VALUES
(1,	NULL,	'Pemahaman',	NULL,	0,	2,	'2018-07-15 23:52:41',	'2018-07-16 00:06:31',	NULL,	90,	100,	'A',	'Menyeluruh dan demonstrasi pengetahuan yang sangat baik'),
(2,	NULL,	'Pemahaman',	NULL,	0,	2,	'2018-07-15 23:58:31',	'2018-07-16 00:04:18',	NULL,	85,	90,	'A',	'Menyeluruh'),
(3,	NULL,	'Sumber Rujukan',	NULL,	0,	1,	'2018-07-16 00:06:23',	'2018-07-16 00:06:23',	NULL,	90,	100,	'A',	'Jelas dan Lengkap dalam membuktikan uraian dengan rujukan terbaru'),
(4,	NULL,	'Pendetilan',	NULL,	0,	2,	'2018-07-16 00:06:52',	'2018-07-16 00:06:52',	NULL,	90,	100,	'A',	'Sangat Rinci');

DROP TABLE IF EXISTS `syarat_pengajuans`;
CREATE TABLE `syarat_pengajuans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `syarat` longtext COLLATE utf8mb4_unicode_ci,
  `pengajuan_id` int(11) NOT NULL DEFAULT '0',
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `departemen_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tahun_ajaran`;
CREATE TABLE `tahun_ajaran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`, `jenis`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'2016 / 2017',	'Gasal',	'2018-07-07 17:00:00',	'2018-07-07 17:00:00',	NULL),
(2,	'2016 / 2017',	'Genap',	'2018-07-07 17:00:00',	'2018-07-07 17:00:00',	NULL),
(3,	'2017 / 2018',	'Gasal',	'2018-07-07 17:00:00',	'2018-07-07 17:00:00',	NULL),
(4,	'2017 / 2018',	'Genap',	'2018-07-07 17:00:00',	'2018-07-07 17:00:00',	NULL),
(5,	'2018 / 2019',	'Gasal',	'2018-07-07 17:00:00',	'2018-07-07 17:00:00',	NULL),
(6,	'2018 / 2019',	'Genap',	'2018-07-07 17:00:00',	'2018-07-07 17:00:00',	NULL);

DROP TABLE IF EXISTS `topik_pengajuan`;
CREATE TABLE `topik_pengajuan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengajuan_id` int(11) DEFAULT '0',
  `dosen_id` int(11) DEFAULT '0',
  `topik` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` int(11) NOT NULL,
  `kat_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `flag`, `kat_user`, `id_user`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Administrator',	'admin@email.com',	'$2y$10$Niu6ThReEVrRaeEhaMyvgeZRvcfCRAZTFGrZHbatp4xLJZVMi.5Be',	1,	0,	0,	'zeJRyeVGV5e8mz2z0S36pEe0sfHR7bnn6DMan7IRa1vmCItzZqhcIVMrDPrK',	'2018-05-27 08:03:23',	'2018-05-27 08:03:23',	NULL),
(122,	'Dr. Ir. Yuskar Lase, DEA',	'yuskar.lase@eng.ui.ac.id',	'$2y$10$g67QV4mxY0YOis73kbN.x.yUgswdjMmd1EPIf0gXEXAW3UEdBx2Fy',	1,	1,	9,	NULL,	'2018-07-12 18:04:09',	'2018-11-01 20:48:58',	NULL),
(123,	'Prof. Dr.-Ing.Ir. Dwita Sutjiningsih, Dipl HE',	'dwita.sutjiningsih@eng.ui.ac.id',	'$2y$10$q1hLNUZsup.8giKXnCo.5OOM0sxfoAyZzS4KnL.rYNH8z9atnnoiC',	1,	1,	10,	NULL,	'2018-07-12 18:04:09',	'2018-11-01 20:58:56',	NULL),
(158,	'Staf Admin Sipil',	'admin.sipil@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	1,	'7ZUfjT3K95LXT3zmwhiLcat7VEnEd5AN6h0dU1z18bbNdYuoRx91ZohfIaXM',	'2018-07-12 18:10:08',	'2018-07-12 18:10:08',	NULL),
(168,	'Staf Admin Elektro',	'admin.elektro@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	3,	'MMUJjOiRovDVdLRD6T6xiyETnDNgfZ62dP8FrGit0iiEFqRoGicttI7sxlJz',	'2018-10-19 12:16:37',	'2018-10-19 12:16:37',	NULL),
(169,	'Staf Admin Metalurgi dan Material',	'admin.metal@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	4,	'o1pR70alXucqVxKpBKpD1p0e2t3y1t1u80NZF4rofODoN9GPtzoxXEA0bJor',	'2018-10-19 12:41:17',	'2018-10-19 12:41:17',	NULL),
(170,	'Staf Admin Mesin',	'admin.mesin@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	5,	NULL,	'2018-10-19 12:42:04',	'2018-10-19 12:42:04',	NULL),
(171,	'Staf Admin Kimia',	'admin.kimia@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	6,	'8zV5iterWSpdeW3pI1tt9xTXAsJ1HaEt87ZYM0AH9C7CUlGS6VgID1qAkq6B',	'2018-10-19 12:43:18',	'2018-10-19 12:43:18',	NULL),
(172,	'Staf Admin Arsitek',	'admin.arsitek@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	7,	'PrYOEAdKdO52wSUxqOnbnp8ISgkmFYRuyofvdKDTVCobbPW2zeW43bWBGmcT',	'2018-10-19 12:43:50',	'2018-10-19 12:43:50',	NULL),
(173,	'Staf Admin Industri',	'admin.industri@email.com',	'$2y$12$hy8NXxuNxiep2SNGO1c5Te5/iMHDhjjcxcmEI55tr2oeVjLjsAhGS',	1,	1,	8,	'mZrbkF24SiyF6tPO9GUEpYgYO6M45eaH0GoXASDhQUX3PU8KrM9LKRFMp5w5',	'2018-10-19 12:44:17',	'2018-10-19 12:44:17',	NULL),
(183,	'Indah Ayu Yuliani',	'ayu@email.com',	'$2y$10$uSEPnddIfyEcHDy82IJTE.o9fTV5h9yxjyvmRigxxA0eF2fjrLa.q',	1,	1,	9,	NULL,	'2018-11-01 20:48:39',	'2018-11-01 20:48:39',	NULL),
(184,	'Dudy Fathan Ali',	'dfa@email.com',	'$2y$10$GEpxzCUaIReaFym/ylDkuelxav2M/JxYdKK5zajTCEF951mmZS/KO',	1,	1,	10,	'NVG2JhahePERxJ1ddOLEMQkTMkXxav0tYw7og0DqnmFoGTvfsNeEV7DC5CIx',	'2018-11-01 20:58:44',	'2018-11-01 20:58:44',	NULL),
(187,	'Dr. Abdul Halim, M.Eng.',	'ahalim@ee.ui.ac.id',	'$2y$10$J5Ql238ZM8Ep8oTNC1M.6egL0z7hlu8S6GoOJum4Z4Z7HUKwyMwqq',	1,	2,	1,	NULL,	'2018-11-13 11:13:06',	'2018-11-13 11:13:06',	NULL),
(188,	'Dr. Abdul Muis, S.T., M.Eng.',	'muis@ee.ui.ac.id',	'$2y$10$0rYG.HFrZh7QyQoKahgJN.78LtSHEOM77wK0U3dbzxDg9bZdJ3rfu',	1,	2,	2,	NULL,	'2018-11-13 11:13:06',	'2018-11-13 11:13:06',	NULL),
(189,	'Ir. Abdul Wahid, M.T., Ph.D.',	'wahid@che.ui.ac.id',	'$2y$10$ptWuFXE6pIUBH9tW470LmesfeIWpnlyF9hbXIkCThWF/eFSotk4wK',	1,	2,	3,	NULL,	'2018-11-13 11:13:06',	'2018-11-13 11:13:06',	NULL),
(190,	'Dr. Ir. Achmad Hery Fuad, M.Eng.',	'achmad.hery@ui.ac.id',	'$2y$10$zcJPv.47iEK5ZYjp3MaeeefDrXBVDihwVPgo9R0aEk55XPaNymRIy',	1,	2,	4,	NULL,	'2018-11-13 11:13:06',	'2018-11-13 11:13:06',	NULL),
(191,	'Prof. Dr. Ir Adi Surjosatyo, M.Eng.',	'adisur@eng.ui.ac.id',	'$2y$10$jLiFG70qfH1WlP7I5OiMmOXwSufp7MEzhx53t08GTfnr1PJLzajUm',	1,	2,	5,	NULL,	'2018-11-13 11:13:06',	'2018-11-13 11:13:06',	NULL),
(192,	'Agung Shamsuddin Saragih, S.T., M.S.Eng., Ph.D.',	'ashamsuddin@eng.ui.ac.id',	'$2y$10$5O39w20X.hATTT.Dv7XL1u4nhSjYNFnZBPn8zevlZlg6Qad9QeDvK',	1,	2,	6,	NULL,	'2018-11-13 11:13:06',	'2018-11-13 11:13:06',	NULL),
(193,	'Ir. Agus R. Utomo, M.T.',	'arutomo@eng.ui.ac.id',	'$2y$10$msfCadSGm.7jFWJVJlxkNOpVA.qId5T/SKUiYAQ7HEaXm.dZsXXwK',	1,	2,	7,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(194,	'Dr. Ir. Agus Santoso Tamsir, M.T.',	'tamsir@ee.ui.ac.id',	'$2y$10$hzKsaP07zhConeiC.y9EjOvqeH.KGY86NwwCnWq1i0g2RpX/cX.ZS',	1,	2,	8,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(195,	'Dr. Agus Sunjarianto Pamitran, ST., M.Eng',	'pamitran@eng.ui.ac.id',	'$2y$10$yWpb3kJ81JKo2b8OAdUvJObjRs0PjhQQGztcWAIQvaahdzo15o5Ee',	1,	2,	9,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(196,	'Ahmad Gamal, S.Ars., M.U.P., Ph.D.',	'ahmadgamal01@gmail.com',	'$2y$10$FFgtmG7fUiOdMB3Odv70FeTBHM/TVfEpCdQST1xhlEgVD154y5ZCG',	1,	2,	10,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(197,	'Dr. Ir. Ahmad Indra Siswantara,',	'a_indra@eng.ui.ac.id',	'$2y$10$S5sTwZGoYHTxdOSCmsRIe.wB4u4t559cOu9GthjJxPnaSKj58MO3K',	1,	2,	11,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(198,	'Dr.Eng. Ajib Setyo Arifin, S.T., M.T.',	'ajib@eng.ui.ac.id',	'$2y$10$FgC66yue/qM5DObZqiVF7uYeAB.FndSU3Him/mb9eKZUgDrNS8BV.',	1,	2,	12,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(199,	'Aji Nur Widyanto, S.T., M.T.',	'widyanto@eng.ui.ac.id',	'$2y$10$FHZKfRoE/8unmQeFM3/vje.9nDm4oNPF8LS5i2MyXSOXhj5ltdnSa',	1,	2,	13,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(200,	'Prof. Dr. Ir. Akhmad Herman Yuwono, M.Phil.Eng.',	'ahyuwono@eng.ui.ac.id',	'$2y$10$KZNJiG82/qukactPuK5.9.KupTlNrUBfxoydPqPlwwEQjxawXNcxu',	1,	2,	14,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(201,	'Dr. Akhmad Hidayatno, ST, MBT',	'akhmad@eng.ui.ac.id',	'$2y$10$9YrTrCGEHrjbvIOdA2V.BO9hmyKfniVHScNiV1vHBEMvtVQjciIte',	1,	2,	15,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(202,	'Ir. Alan Marino, M.Sc.',	'alanmarino@eng.ui.ac.id',	'$2y$10$uOKJVQyvTjoqDnRrhCBO4erQqtmIP8IIIt3fKpo57Md0Bv6FDbhWu',	1,	2,	16,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(203,	'Ir. Alvinsyah, M.Sc.',	'alvin@eng.ui.ac.id',	'$2y$10$ALX1ACNnc36mv0FFjIA15Ou49QatiwrbqYhqNpvWA1zX4H.x6FZPK',	1,	2,	17,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(204,	'Dr. -Ing. Amalia Suzianti, S.T., M.Sc.',	'suzianti@eng.ui.ac.id',	'$2y$10$qkJT4n2vVvU5wrAW62y6au3VG6/66MGsg.rTrKBXKQqpFw8j/b4qq',	1,	2,	18,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(205,	'Ir. Amien Rahardjo, M.T.',	'amien.rahardjo@ui.ac.id',	'$2y$10$ilDinbO6TTWePR9dIDEIt.c58kHkTmlU2thFFcGzxHPjrt2M8odj2',	1,	2,	19,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(206,	'Dr. Ir. Anak Agung Putri Ratna, M.Eng.',	'ratna@eng.ui.ac.id',	'$2y$10$.X1XNDzuJZ1uzYoRXHW5He63isEBq.WBWQc5QGxQFBYgJ0qtoRsJC',	1,	2,	20,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(207,	'Andyka Kusuma, S.T., M.Sc., Ph.D.',	'andyka.k@eng.ui.ac.id',	'$2y$10$OEiNqpRPlJK9hwaAxK924O1B0uI8qsbsxuGGgGFK9uJD.9vVX2vWC',	1,	2,	21,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(208,	'Dr. Ir. Andy Noorsaman, DEA',	'andy.n.sommeng@gmail.com',	'$2y$10$DTgUHU1K/A/xu6bw3wgIKOeFwtkrr0ky.fFf..hsX0olWvKMuXUtu',	1,	2,	22,	NULL,	'2018-11-13 11:13:07',	'2018-11-13 11:13:07',	NULL),
(209,	'Prof. Dr. Ir. Anne Zulfia Syahrial,, M.Sc.',	'anne@metal.ui.ac.id',	'$2y$10$WJDe8wN66DcUyCDl1X73R.t9Pt1MdmizrBBcrKeX6yzmHbq76UCWa',	1,	2,	23,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(210,	'Prof. Dr. Ir. Anondho Wijanarko, M.Eng.',	'anondho@eng.ui.ac.id',	'$2y$10$iJDkzOiM7hEXVHrRmXoFBeNOlccaiuIk51G2rsO5j5/3nGg0KJBQO',	1,	2,	24,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(211,	'Ir. Antony Sihombing, MPD., Ph.D.',	'a.sihombing@eng.ui.ac.id',	'$2y$10$zWrli4J2BXtLxJIAnTsu9OsXtgdnb1su6SHXMOaT9HWLNaz.NSUSG',	1,	2,	25,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(212,	'Ardiyansyah, S.T., M.Eng., Ph.D.',	'ardiyansyah@eng.ui.ac.id',	'$2y$10$OG/gfabz8xcd91Vd8Qm8IeBQnXd41fuBfLO9MPeDQkqCGAx2s.MVK',	1,	2,	26,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(213,	'Dr.Eng., Ir. Arief Udhiarto, S.T., M.T.',	'arief@ee.ui.ac.id',	'$2y$10$KyUfnnO2yR6O.tfXvU31fuJMCAagjSxd2aYkiNIgHpm8bE6WpsKq6',	1,	2,	27,	'SrYY1HaYn1HVLoLwA67FDz6HlBrKzYZ71QGNLiQGV1NSEC2DU6gjtcZHOSnJ',	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(214,	'Dr. Ir. Aries Subiantoro, M.Sc.',	'biantoro@eng.ui.ac.id',	'$2y$10$xoQQ3xT3Qkt.nlzd2qyl8.6jBjOkmRNGGX0GnWzkmE6cMGymWZMeq',	1,	2,	28,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(215,	'Dr. Ario Sunar Baskoro, S.T., M.T., M.Eng',	'ario@eng.ui.ac.id',	'$2y$10$Jxn/8l8I9FCEjl8ZYDquvuIesVHh95h8TQBWGKekqVeckZSV.kOLS',	1,	2,	29,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(216,	'Arry Rahmawan Destyanto, S.T., M.T.',	'arry.rahmawan@gmail.com',	'$2y$10$xbBfuxcb7ULAIULqj3r.bOlF4NIkLYPtA8sennLXsZ8Kl3t9GXiBG',	1,	2,	30,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(217,	'Dr. Ir. Asep Handaya Saputra, M.Eng.',	'sasep@che.ui.ac.id',	'$2y$10$WkGuKW5Op7tLQBGqOaBPLu1Z.PFPOnndOFw7HQTWPSMRt4oyYEvji',	1,	2,	31,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(218,	'Ayomi Dita Rarasati, S.T., M.T., Ph.D.',	'ayomi@eng.ui.ac.id',	'$2y$10$bDpnEB31woK.P1Idp7Y3ze/zxpy36Gk1QHWduQzBQ.w.y92FR62am',	1,	2,	32,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(219,	'Dr. Badrul Munir, ST., M.Eng.Sc.',	'bmunir@ui.ac.id',	'$2y$10$UGZv.vwnrKwD3vAIj.uocubg/55tOANGYuzWqW/.jb1X8Il61/CIC',	1,	2,	33,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(220,	'Dr. Bambang Heru Susanto, S.T., M.T',	'bambanghs@che.ui.ac.id',	'$2y$10$KbHpl0X2phRZAOEjLbvCnuuJ.juj4uIqCUj0bA74zApaeRKjyTyh.',	1,	2,	34,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(221,	'Dr. Ir. Bambang Priyono, M.T.',	'bpriyono@metal.ui.ac.id',	'$2y$10$CHvsd2C00yauui//XtCTu.EtLGvsF6deNw3j7XoKtwgywPtf7SBzO',	1,	2,	35,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(222,	'Prof. Dr. Ir. Bambang Sugiarto, M.Eng.',	'bangsugi@eng.u.ac.id',	'$2y$10$I8HHNnBlvJ3t2yMtr/.VWeuPa4dWqjEW0n8K3FsNudjFEET6sJtNe',	1,	2,	36,	NULL,	'2018-11-13 11:13:08',	'2018-11-13 11:13:08',	NULL),
(223,	'Prof. Dr.-Ing. Ir. Bambang Suharno,',	'suharno@metal.ui.ac.id',	'$2y$10$Cg4GTCLU/.Zjj69hZCW5YekLGb9ckqLMxNVIlqiCKzWlHTmwqnf0.',	1,	2,	37,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(224,	'Dr. Basari, S.T., M.Eng.',	'basyarie@eng.ui.ac.id',	'$2y$10$1gb.Gzlj7LRJJuPOzhgCxucVUxa85gVWx/./rOwaxYDjStB297CvC',	1,	2,	38,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(225,	'Prof. Dr.Eng. Drs. Benyamin Kusumo Putro, M.Eng.',	'kusumo@ee.ui.ac.id',	'$2y$10$pUWS21fR.igetNxKVcaN4egxizs20rouXJMZsvIBSwZmgsgv1h87O',	1,	2,	39,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(226,	'Billy Muhamad Iqbal, S.Ds., M.T.',	'billy.iqbal87@gmail.com',	'$2y$10$epu87CpO/Ww.F8gdU8pW0ua7shVJsrfCDl5rauTmJ4aNgluuJFxka',	1,	2,	40,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(227,	'Prof. Dr. Ir. Bondan Tiara, M.Si.',	'bondan@eng.ui.ac.id',	'$2y$10$BeRHCLbnM/2OPzGasZnMdelzTS.UTq2L1aAkOwRi8X4L6WFhat4e2',	1,	2,	41,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(228,	'Ir. Boy Nurtjahyo Moch, MSIE.',	'boy.nurtjahyo@ui.ac.id',	'$2y$10$wBZe0t6OXxmfXyv5P4JB8erwGAq1Slej92Px5gYtnw8l3a2amsT5m',	1,	2,	42,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(229,	'Prof. Dr. Ir. Budiarso, M.Eng.',	'mftbd@eng.ui.ac.id',	'$2y$10$T3HoCtCIJkJN8B/wWu3HR.N7fW/0TFAggngBxelDM.VTaKQKiglhq',	1,	2,	43,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(230,	'Dr.-Ing. Budi Sudiarto, S.T., M.T',	'budi.sudiarto@ui.ac.id',	'$2y$10$uLaao5fMmgrju7FDrfSk5./4.PMNYlWihc1akcBXxSmEa/IDvnMuW',	1,	2,	44,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(231,	'Prof. Dr. Ir. Budi Susilo Soepandji.,',	'budisus@eng.ui.ac.id',	'$2y$10$tUCkL9O9Y06i7qTrHgyCDeO9zIDdgxV04rAlaVRvcYlzut6l5DH0u',	1,	2,	45,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(232,	'Dr. Catur Apriono, S.T., M.T., Ph.D.',	'catur@eng.ui.ac.id',	'$2y$10$UjABtVH86R3CSfdTltoJmOSK0YYJkHamas.IhgAmk/BfhBCgVYRdy',	1,	2,	46,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(233,	'Ir. Chairul Hudaya, S.T., M.Eng., Ph.D., IPM.',	'c.hudaya@eng.ui.ac.id',	'$2y$10$dtm6D6tQD7epPbe6u07pLetzREl1HsC5UbVXx2L8tOnr.aTQ84Vge',	1,	2,	47,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(234,	'Cindy Dianita, S.T., M.Eng.',	'cindydianita@yahoo.com',	'$2y$10$P95Nn.CIYdcRTshRmHOaLOL6SIQ4u/p2Z0DUbj58zvG0waclEw.wS',	1,	2,	48,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(235,	'Dr. Cindy Rianti Priadi, S.T., M.Sc.',	'crpriadi@gmail.com',	'$2y$10$ELyxPJJdG9sOk/Z24PCIMuaXvz3EFNxB0rcYo0Swpb5u2G0zvwElK',	1,	2,	49,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(236,	'Prof. Dr. Ir. Dadang Gunawan, M.Eng.',	'guna@eng.ui.ac.id',	'$2y$10$iZw4dToZdkusLImByAEmNe6QDUOqaIrvHLtJqz/0roONIYSfqD/IO',	1,	2,	50,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(237,	'Dr. Ing. Ir. Dalhar Susanto,',	'dalhar@eng.ui.ac.id',	'$2y$10$rz4a24xpJaIq17sszk/.i..ZI1AtRlezm12kbsNWru08iySPuiY2O',	1,	2,	51,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(238,	'Prof. Dr. Ir. Dedi Priadi, DEA',	'dedi@metal.ui.ac.id',	'$2y$10$xKaXy7IW63OcbyJf2bihTe/vVdoJdcT3QAIUuzwNF50GbWaX8MHbm',	1,	2,	52,	NULL,	'2018-11-13 11:13:09',	'2018-11-13 11:13:09',	NULL),
(239,	'Dr. Deni Ferdian, S.T., M.Sc.',	'deni@metal.ui.ac.id',	'$2y$10$MSiv3VXg.uoeAqv.lGOVU.SSpJFLVVBcgM7VLCsP1x7xB3QXTDegO',	1,	2,	53,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(240,	'Ir. Dewi Tristantini, M.T., PhD.',	'detris@che.ui.ac.id',	'$2y$10$zBeOQ5WN/nibP/YEGSX0meRIijCNIRpa.9iZvHNJPNnHX3BJ1f6Xe',	1,	2,	54,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(241,	'Diandra Pandu Saginatari, S.Ars., M.A.',	'diandrasaginatari@gmail.com',	'$2y$10$XKhlxF5bkdZVGXKIL99ptumUv3qsWLc6dFua4gL0CUoKN/98Mn9I.',	1,	2,	55,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(242,	'Dr. Dianursanti, S.T., M.T.',	'danti@che.ui.ac.id',	'$2y$10$ZHLlfsCrl0A.eFlw1s1fduCA/JaeqNWrmaEFe2fOS.VcVvkHDXAse',	1,	2,	56,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(243,	'Ir. Dijan Supramono, M.Sc.',	'dsupramo@che.ui.ac.id',	'$2y$10$umBhXNL1rVspJTT3UOrVmOJyjMnhY3arwjph1AIyyRV6bFYf5C0gi',	1,	2,	57,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(244,	'Dita Trisnawan, S.T., M.Arch., STD.',	'ditadesign@gmail.com',	'$2y$10$LcK2hJCmWRgZzUz2F6Xuru4Yxu7pKHk79c7IMLVtchtHCwi4iHqI6',	1,	2,	58,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(245,	'Prof. Dr. Ir. Djoko Mulyo Hartono, S.E., M.Eng.',	'djokomh@eng.ui.ac.id',	'$2y$10$o3ZoMpSng5HRiabT6oCT8.TpSRpdYr7w.NRq8zA02ryS85gnWSeLy',	1,	2,	59,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(246,	'Dr. Ir. Djoko Sihono Gabriel, M.T.',	'dsihono@gmail.com',	'$2y$10$lh7n6qtYzQrKVC6oR54e9uwGRca8Fi9nS6QGGpe3RnGhxSnsggFNK',	1,	2,	60,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(247,	'Dr. Ir. Dodi Sudiana, M.Eng.',	'dodi.sudiana@ui.ac.id',	'$2y$10$Y9D6D14Qfppty8Cd0r3xA.8d3IRleWHCaB7gPOf4avAyZknfiBgFC',	1,	2,	61,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(248,	'Dr. Ir. Donanta Dhaneswara, M.Si',	'donanta.dhaneswara@ui.ac.id',	'$2y$10$AZMF1o6bg3pcc8.Zpedvk.r0E7JelyqSqDVqGi1qFvMBwpma2j.2m',	1,	2,	62,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(249,	'Dr. Dwi Marta Nurjaya, S.T., M.T.',	'dwi.marta@ui.ac.id',	'$2y$10$ovXzel4UzZ2OhYR89uiaEODHrVRB8YRXYrYwU0YMDtKzT1yqnzYhi',	1,	2,	63,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(250,	'Prof. Dr. Ing. Ir. Dwita Sutjiningsih, Dipl. HE',	'dwita@eng.ui.ac.id',	'$2y$10$cR/NrXZTqS1c/w3RRe8lquMeaJntO6NQlhF0tVPT8gA10QZgihXUm',	1,	2,	64,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(251,	'Prof. Dr. Ir. Eddy Sumarno Siradj, M.Sc.',	'siradj@metal.ui.ac.id',	'$2y$10$i6o5OBY8L29W3aa2ncHOWus3t6sjz56jS6dQRp2EPFAq17Dl2oqv.',	1,	2,	65,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(252,	'Dr.-Ing. Eko Adhi Setiawan, S.T., M.T.',	'ekoas@eng.ui.ac.id',	'$2y$10$J57INLaEfUfagvwusNV7nu9tgPl.xOef5lvkemESWXDfjiR1aB4jy',	1,	2,	66,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(253,	'Prof. Dr. Ir. Eko Tjipto Rahardjo, M.Sc.',	'eko@ee.ui.ac.id',	'$2y$10$4qWLePtsv.6r2tG3gwy4muZocKzhVM38qDfdEPt9otOjqzWsm0Xf2',	1,	2,	67,	NULL,	'2018-11-13 11:13:10',	'2018-11-13 11:13:10',	NULL),
(254,	'Ir. Ellen Sophie Wulan Tangkudung, M.S.',	'ellen@eng.ui.ac.id',	'$2y$10$H0CMKoHk4gPUrqiTHc9xC.RtO5IHIDkZaBLYv2Gs6GAD3eHW7QPP6',	1,	2,	68,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(255,	'Dr. Ir. Elly Tjahjono, DEA.',	'elly@eng.ui.ac.id',	'$2y$10$m2Qtmf6V.X4LGbdMJpQljOT2yl8U71qDhVyZE1ctGXFIsG7/SywZe',	1,	2,	69,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(256,	'Dr. Ir. Engkos Achmad Kosasih, M.T.',	'kosri@eng.ui.ac.id',	'$2y$10$56FCzShLcDmXt2JH4axH9uutIfzQMJmLi0tCYmzoF.657oUDgr5T2',	1,	2,	70,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(257,	'Enira Arvanda, S.T., M.Dipl.',	'enira28@gmail.com',	'$2y$10$uEm27W75hIn2bzuvbVUyROuKWZKCgfBAOr7512B5S9cAbXDQvZKU.',	1,	2,	71,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(258,	'Eny Kusrini, S.Si., Ph.D.',	'ekusrini@che.ui.ac.id',	'$2y$10$5BQLWfC8cL5hr0gf/a2ahuNWB2Rwv/PfwnJfNHa.caawNYmbxiAdm',	1,	2,	72,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(259,	'Ir. Erlinda Muslim, MEE., IPU.',	'erlinda@eng.ui.ac.id',	'$2y$10$18lAptJgi8j2AWhgTLEnXOPax7XEtWXfRmS38efyL6T79vB.w/GY.',	1,	2,	73,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(260,	'Erly Bahsan, S.T., M.Kom.',	'erlybahsan@ui.ac.id',	'$2y$10$plTDDPqUQGF2fFEVFn1R0OsLaqs2bqCswSf0qSbpLZhXrl87EWORW',	1,	2,	74,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(261,	'Dr. Eva Fathul Karamah, S.T., M.T',	'eva@eng.ui.ac.id',	'$2y$10$qNqTUoxcfm6/zoD2V.HZ8OoigaL8ZtX6QfRKLMODMmIky.0w8iSVG',	1,	2,	75,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(262,	'Ir. Evawani Ellisa, M.Eng., Ph.D',	'ellisa@eng.ui.ac.id',	'$2y$10$b13f8woMdAdGYeIZ/Gd1puTduiOCbGJ.jaiM6xe6hcDNuq2wSmhrO',	1,	2,	76,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(263,	'Farizal, Ph.D.',	'farizal@ie.ui.ac.id',	'$2y$10$JdFkLXSzd/0y4k5xKEAVX.81mf33rt0f6Kx.cE6rRatI3bSW1YNLy',	1,	2,	77,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(264,	'F. Astha Ekadiyanto, S.T., M.Sc.',	'astha@ee.ui.ac.id',	'$2y$10$4TKSsVaQceh22jO4KFkxvu5bmS/XyT5kxxamKLIdI4gOLAu1uzAra',	1,	2,	78,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(265,	'Ir. Fauzia Dianawati, M.Si.',	'fauzia.dianawati@ui.ac.id',	'$2y$10$c7dtQCynMpLp/9aI15NGZOAD4OsFkOmXl978ulqttn6Iufs03N4uO',	1,	2,	79,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(266,	'Dr. Ir. Feri Yusivar, M.Eng.',	'yusivar@eng.ui.ac.id',	'$2y$10$6As5bx0lLEgpt/NJVG/cm.a31MJnfexihnT9211PkQp.1FQezqpE2',	1,	2,	80,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(267,	'Dr. Ir. Firdaus Ali, M.Sc.',	'firdausali@ymail.com',	'$2y$10$zlhVJEtzaeUy6kjRt1ZTnOnO2V3aYdcDjqr8EZI/EfWRteTneyqaS',	1,	2,	81,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(268,	'Firman Ady Nugroho, S.T., M.T.',	'firman_ady@eng.ui.ac.id',	'$2y$10$pT8ZMXGmIYqefMX9Gx5Iger11hjgCZcLjkB2dJ9AXQ649sVf9RsHq',	1,	2,	82,	NULL,	'2018-11-13 11:13:11',	'2018-11-13 11:13:11',	NULL),
(269,	'Prof. Dr. Fitri Yuli Zulkifli, S.T., M.Sc.',	'yuli@eng.ui.ac.id',	'$2y$10$z6.1KWxQ2F5JpJp0jcXwZO9ftR90oNPigvzE3cNrs/IjsSpaEK9PS',	1,	2,	83,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(270,	'Dr. Ir. Gabriel Soedarmini Boedi Andari, M.Eng.',	'gakristanto@gmail.com',	'$2y$10$BItrBuZGkAwE67.n8m1dfuS6kxSRINew1qRDvGAYsgDeGxfZhgbGS',	1,	2,	84,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(271,	'Prof. Dr. Ir. Gandjar Kiswanto, M.Eng.',	'gandjar_kiswanto@eng.ui.ac.id',	'$2y$10$4ZSFMGuZZocupss7u6Y4qOktfUMXYMR26k6iNFr38dNU2G./o8W2q',	1,	2,	85,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(272,	'Dr. Ir. Gatot Prayogo, M.Eng.',	'gatot@eng.ui.ac.id',	'$2y$10$lGhzgm4.fc1Mgh7IUuSEIeuCCWBHlQnq5cvTqaoZFeKOxs8aOIsH.',	1,	2,	86,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(273,	'Gerry Liston Putra, S.T., M.T.',	'gerrylistonp@gmail.com',	'$2y$10$ZuBRwg.nOCuXVQ7sbBrs3.QRWGc68u9mqdEfAKrXdwEeNtno0QwOC',	1,	2,	87,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(274,	'Ir. Gunawan Wibisono, M.Sc., Ph.D.',	'gunawan@eng.ui.ac.id',	'$2y$10$CKi9xRCV6kjTWY.NT3PA2.WgZ6fGc6jsCuJ7ogf2etsmgpeMWJkQi',	1,	2,	88,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(275,	'Ir. Hadi Tresno Wibowo, M.T',	'hadi.tresno@ui.ac.id',	'$2y$10$/wF8Zq.b4y/b6BvNsuT9q.S/TyhpnE0xtEabZyxrtNgZ2vRhzr/hC',	1,	2,	89,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(276,	'Prof. Dr. Ir. Harinaldi, M.Eng.',	'harinald@eng.ui.ac.id',	'$2y$10$qWH5i/8kPxhFA65f5EYj3OKfIZ7WhXP9q7LJtxzrSi/5X2IRFmigq',	1,	2,	90,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(277,	'Prof. Dr. Ir. Harry Sudibyo S., DEA',	'harisudi@eng.ui.ac.id',	'$2y$10$P89iFbRmeDNq4sm6ApOcJejFA/XlLSy0GfxFlt2/lO0GR3xmRBUGO',	1,	2,	91,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(278,	'Dr. Ir. Hendrajaya, M.Sc',	'hendrajayaisnaeni@gmail.com',	'$2y$10$R1Qf.lmCf0Tfsa3USj0cv.GVY8EyVJJWUqugEmxt6szOzovbzw6bC',	1,	2,	92,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(279,	'Dr. Ir. Hendri Dwi Saptioratri Budiono, M.Eng.',	'hendri@eng.ui.ac.id',	'$2y$10$XJv26asStCF7TddgvjWFfO2Co6q0zvHbI9Fclckfa6f3M7sng0AWW',	1,	2,	93,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(280,	'Dr. Ing. Ir. Henki Wibowo Ashadi,',	'henki@eng.ui.ac.id',	'$2y$10$UBcbBDxonX4XhrVo9iaymuEHFjGCeBJNFJfEgP3nZVAItI0ThoG8y',	1,	2,	94,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(281,	'Dr. Ir. Henky Suskito Nugroho, M.T.',	'henky.suskito@ui.ac.id',	'$2y$10$KXs/hsQWrKkj37okkE3Q.Og/.BTrVdBx8rXY/kFsSBr13kD75AS5S',	1,	2,	95,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(282,	'Prof. Dr. Heri Hermansyah, S.T., M.Eng.',	'heri@che.ui.ac.id',	'$2y$10$y46WsY5UrN2.qg0vDhLRRuvmYxHhWiAzgjuquhpoD.H3s3jS/s/5S',	1,	2,	96,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(283,	'Ir. Herlily, M.Urb.Des.',	'herlily@ui.ac.id',	'$2y$10$l2cIdB17y6JeUmQFg5qiDuwfkN.IUWgD/gjrX38UNsqaRdY96O9M6',	1,	2,	97,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(284,	'Ir. Herr Soeryantono, M.Sc., Ph.D.',	'herr@eng.ui.ac.id',	'$2y$10$a6N8M6XMhagDepn2JC8Oo.Ki6gZeKcVI7L1XNoMjtRi28JK6/qpIO',	1,	2,	98,	NULL,	'2018-11-13 11:13:12',	'2018-11-13 11:13:12',	NULL),
(285,	'Dr. Ir. Heru Purnomo, DEA.',	'herupur@eng.ui.ac.id',	'$2y$10$2N3yKOTpgE.qS.43u6Ze7.E/2sWYnTcqzIwAoODlKK9YpUDYNdZBK',	1,	2,	99,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(286,	'I Gde Dharma Nugraha, S.T., M.T.',	'i.gde@ui.ac.id',	'$2y$10$VvY504OFV1otciP4RRWKSevLz/esafV5FKZL43rUe3BpG1SlFnJ8.',	1,	2,	100,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(287,	'Ir. I Made Ardita Y, M.T.',	'i.made61@ui.ac.id',	'$2y$10$facAx/6UjQakuKoGweWqkewONrPPhfO26kgHrd/66zhd2cZzWIQIC',	1,	2,	101,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(288,	'Prof. Dr. I. Made Kartika Dhiputra, Dipl. Ing',	'made.dhiputra@ui.ac.id',	'$2y$10$uE3uDuCk8p9AwQW/Db9KXepcY2.PYr76UENpjMgnD9JB0gzzNZ4lq',	1,	2,	102,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(289,	'Dr. Ir. Imansyah Ibnu Hakim, M.Eng.',	'imansyah@eng.ui.ac.id',	'$2y$10$oF40zuk.bVRCYa8VABhOAOrmKg8QrcLlF0f/9vM.k7hkijQMOFo2a',	1,	2,	103,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(290,	'Inaki Maulida Hakim, S.T., M.T.',	'inakimhakim@eng.ui.ac.id',	'$2y$10$I7VS30oDGMbMkJrw5HXEIew916foR8i.xFAMluGoWCdEYJlrX5waC',	1,	2,	104,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(291,	'Ir. Irma Gusniani Danumihardja, M.Sc',	'irma@eng.ui.ac.id',	'$2y$10$/sWrL0rj2zCpqqmG/bEcJuL1F8wEI3c398/ivOEng28MlmNy0kQmW',	1,	2,	105,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(292,	'Prof. Dr. Ir. Irwan Katili, DEA.',	'irwan.katili@gmail.com',	'$2y$10$4BDu1xdYXNbn3st9.G/9k.1E1zkcOOsD7QumvQe4IA19MOJQYoB0a',	1,	2,	106,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(293,	'Prof. Ir. Isti Surjandari Prajitno, M.T., M.A., Ph.D.',	'isti@ie.ui.ac.id',	'$2y$10$9PARv7hcPDvhLY6gsFt3fOBT2MVWrIfs72q75m3F8cqe3esAPj58.',	1,	2,	107,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(294,	'Prof. Dr. Ir. Iwa Garniwa M. K., M.T.',	'iwa@eng.ui.ac.id',	'$2y$10$ylBvhFpYKei28Oac2dREKOkwKgQ0xkV0sr7Pfvix14dK02iklnI0u',	1,	2,	108,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(295,	'Dr. Jessica Sjah, M.T., M.Sc.',	'jessica_sjah@hotmail.com',	'$2y$10$bbV3xBvSx/BlFaICk2DooO6Qk9MkZR5WmbjuYo7DhsfWxmy7SfQVG',	1,	2,	109,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(296,	'Prof. Dr. Ir. Johny Wahyuadi Mudaryoto, DEA.',	'jwsono@metal.ui.ac.id',	'$2y$10$XtAS2TxCrqmNX7aJK2MfkOeirCyTSgaIxkFS3Oy/okypGGbc0NRHG',	1,	2,	110,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(297,	'Joko Adianto, S.T., M.Ars., Ph.D.',	'joko.adianto@gmail.com',	'$2y$10$y7Q2/g45nrQZLsySwg8JkuOSs9L8tCmtSDQAH5n7ooAgLugD1nEQe',	1,	2,	111,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(298,	'Dr. -Ing. Josia Irwan, S.T., M.T.',	'jrastandi@eng.ui.ac.id',	'$2y$10$xvkfpytijejyMSmTClth.uJmE2ojyCmsEw15f1fwqBcjkQLO4Yz6y',	1,	2,	112,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(299,	'Jos Istiyanto, S.T., M.T., Ph.D.',	'josist@eng.ui.ac.id',	'$2y$10$G9IDZLFCPW6KM0hx3HRYHeT92n.3k63Sr6YzaloOQA3EsYHiVp3Ki',	1,	2,	113,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(300,	'Prof. Dr.-Ing. Ir. Kalamullah Ramli, M.Eng.',	'k.ramli@ee.ui.ac.id',	'$2y$10$E8mOk56O8dtciISntiA2muA3b9WpJ4MSCv/FSv1s2.1cfp4v1UpGS',	1,	2,	114,	NULL,	'2018-11-13 11:13:13',	'2018-11-13 11:13:13',	NULL),
(301,	'Ir. Kamarza Mulia, M.Sc., Ph.D',	'kmulia@che.ui.ac.id',	'$2y$10$w3h4T044iPvVY5gxjv84puB2U94gtj8LHvRXUljqEPaMiDO/GGt3q',	1,	2,	115,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(302,	'Prof. Dr. Kemas Ridwan Kurniawan, ST., M.Sc.',	'kemas.ridwan@gmail.com',	'$2y$10$JTK8u5i6lg6htCED5jZJludEhQJkRKXBvV7vCFICVTMS6/04WoFpi',	1,	2,	116,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(303,	'Komarudin, S.T., M.Eng., Ph.D.',	'komarudin@ie.ui.ac.id',	'$2y$10$ktm3sWXpQaUWD1UxMImtPOYuRYio9j02/jlDsAEMd3N5NKU8LDD5a',	1,	2,	117,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(304,	'Kristanti Dewi Paramita, S.Ars., M.A.',	'kristantiparamita@yahoo.com',	'$2y$10$cQ4bVn3jBR0VOifPSOoua.wIY/BYDyd/t8G/O.q4uFUKk2LrMB9QK',	1,	2,	118,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(305,	'Leni Sagita Riantini, S.T., M.T., Ph.D.',	'lsagita@eng.ui.ac.id',	'$2y$10$sd8HLeCrsHzzW3UNKgZy4.5p7nj0Rk4cWOtiEHFR4nFf.9vJWC0vm',	1,	2,	119,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(306,	'Prof. Ir. Mahmud Sudibandriyo, M.Sc., Ph.D',	'msudib@che.ui.ac.id',	'$2y$10$PRl83DGLLoMnpmk2YdLtRu6Kx6PG49HEpm9JOfgZF9jLEcN7XcGVm',	1,	2,	120,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(307,	'Ir. Martha Leni Siregar, M.Sc',	'leni@eng.ui.ac.id',	'$2y$10$zSrfUvR21R2kX2Kpi2EUy.mQOWBUzPLXTYreJ3gFWqgAIITIz1IJe',	1,	2,	121,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(308,	'Dr. Ir. M. Dachyar, M.Sc',	'mdachyar@yahoo.com',	'$2y$10$1qNNWkQpBSWxx1sh1dzpc.rvL2qilQkDabdH1QUlhzmWVvDzGmWly',	1,	2,	122,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(309,	'Dr. Mia Rizkinia, S.T., M.T.',	'rizkinia.mia@gmail.com',	'$2y$10$jPTVTzWdvp6yQrwC99a.f.OK0dphTA3hUtFsO01/WZS7dExnd6Br6',	1,	2,	123,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(310,	'Mikhael Johanes, S.Ars., M.Ars.',	'johanes.mikhael@gmail.com',	'$2y$10$Lkf3VISSNe.lIwZW3Mju.OxChiE4AOfVIiAQvXbZqPzjtPcpvQ9eu',	1,	2,	124,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(311,	'Prof. Dr. Ing. Ir. Misri, M.Tech.',	'mgozan@che.ui.ac.id',	'$2y$10$A.HOjaUiI2tCTxcYf/eXTOpZmkEcT1XR2rnv.nCrporRbaLGbFKTi',	1,	2,	125,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(312,	'Dr. Mochamad Chalid, S.Si., M.Sc.Eng.',	'chalid@metal.ui.ac.id',	'$2y$10$u35C0XXLwf/kYmBU8dpIUeDcRrWfAjSlhYLqkOUaG2Wj2ODi.zz7.',	1,	2,	126,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(313,	'Dr.-Ing. Mohammad Adhitya, S.T., M.Sc.',	'madhitya@eng.ui.ac.id',	'$2y$10$9VpG5Uy5JjOB4thG1hLKYeedpUDDvEC01tQtPZmjZOgbJqiAcIEla',	1,	2,	127,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(314,	'Mohammad Nanda Widyarta, B.Arch., M.Arch.',	'm.n.widyarta@gmail.com',	'$2y$10$/grpSKR/sIM9X01zEWwQj.FS/QpeS8q.3A0AlOo80ySJFXu6YPgqK',	1,	2,	128,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(315,	'Prof. Dr. Ir. Mohammad Nasikin, M.Eng.',	'mnasikin@che.ui.ac.id',	'$2y$10$eSW18Nru0lizoqd1SKMKgemeDV0xOHIifLxlqx8fxAAUIt1ujtiJO',	1,	2,	129,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(316,	'Mohammed Ali Berawi, M.Eng.Sc., Ph.D.',	'maberawi@eng.ui.ac.id',	'$2y$10$8roCa88RWoubFjj0Z5LsMewFFRLOcwcGJaY7R3U6RNWFkl5TkdSta',	1,	2,	130,	NULL,	'2018-11-13 11:13:14',	'2018-11-13 11:13:14',	NULL),
(317,	'Dr. Ir. Muhamad Asvial, M.Eng.',	'asvial@ee.ui.ac.id',	'$2y$10$04e1gxrQhGyORPWx3hjOgur61MUdj2jdZfwbSGRTGKCmwWwNHzz4y',	1,	2,	131,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(318,	'Dr. Muhamad Sahlan, S.Si., M.Eng.',	'muhamad.sahlan@gmail.com',	'$2y$10$t2KRV.Q0N7ZwHZi76sm25eLq2P5A2R3gGLmLuj.8OmO9N3bSkKPiO',	1,	2,	132,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(319,	'Prof. Dr. Ir. Muhammad Anis, M.Met.',	'anis@metal.ui.ac.id',	'$2y$10$qOY5N44LUB8RGZR179DgxO51xO763zdnWXR2LKrD/H48lKQHeTV36',	1,	2,	133,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(320,	'Prof. Dr. Ir. Muhammad Idrus Alhamid,',	'mamak@eng.ui.ac.id',	'$2y$10$gkRDHjNEOYG/nrdl3DdQk.tTNJQiHRQpprsX3WWeGhxccUTO0JvWy',	1,	2,	134,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(321,	'Dr. Muhammad Suryanegara, S.T., M.Sc.',	'm.suryanegara@ui.ac.id',	'$2y$10$sM4.YhhQBEkmkB9juwFqrux5oCbmqpTRRXowfDE9GtDBr2Kkmvwl2',	1,	2,	135,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(322,	'Mulia Orientilize, S.T., M.Eng',	'mulia@eng.ui.ac.id',	'$2y$10$DENTvprVIhSXjAgU/9BZE.4THd/QiIvRbv1QTqg9qsb1aoAHD9Sq.',	1,	2,	136,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(323,	'Dr. Ir. Myrna Ariati Mochtar, M.S.',	'myrna@metal.ui.ac.id',	'$2y$10$wcSYIetI9.Gtj09ZQGRtJe0RkpLF3aKLW4ZORMj7D/ddKNHPHVsz2',	1,	2,	137,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(324,	'Dr. Ir. Nahry, M.T.',	'nahry@eng.ui.ac.id',	'$2y$10$RF/FV3.7SsqsHbKs3vv32O9VlrmEVCfg465LaV.u2/hDlYBcbN2Na',	1,	2,	138,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(325,	'Prof. Dr. -Ing. Nandy Setiadi Djaya Putra,',	'nandyputra@eng.ui.ac.id',	'$2y$10$xqtSZKMIaXmgNjv4Ty5NJu65J3hmEutLPddBnwP/X0OttyjeK6rMy',	1,	2,	139,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(326,	'Dr.-Ing. Ir. Nasruddin, M.Eng.',	'nasruddin@eng.ui.ac.id',	'$2y$10$gp.yhGiJ.LdDamxb3TMq5.KhFaweUmi5JPi4O7eZQ6ljUe6jRkPR2',	1,	2,	140,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(327,	'Prof. Dr. Ir. Nelson Saksono, M.T.',	'nelson@che.ui.ac.id',	'$2y$10$wNnwSY00Gu0PI/sgYCG51et5dZ5C30o5AL6UBm.1kk/EbkJtzh22e',	1,	2,	141,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(328,	'Nevine Rafa Kusuma, S.Ars., M.A.',	'nevine_rk@yahoo.co.id',	'$2y$10$5nhlsdlZvSvrNkEIanN73uZdUwkiJJGXRWkViVHRrQS82wC.nWglW',	1,	2,	142,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(329,	'Prof. Dr. Ir. Nji Raden Poespawati, M.T.',	'pupu@eng.ui.ac.id',	'$2y$10$ehekcfAuMJUkSBADxWJvmepa3iEIl4TDrQ3HPJydxi0DJou49TJnS',	1,	2,	143,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(330,	'Nofrijon Bin Imam Sofyan, Ph.D',	'nofrijon.sofyan@ui.ac.id',	'$2y$10$.aIbwl/h9pCniMMmHwCsh.yM19zpPbKpfe11zRM9OFtFtp2cwBUXe',	1,	2,	144,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(331,	'Nyoman Suwartha, M.T., M.Agr., Ph.D.',	'nsuwartha@eng.ui.ac.id',	'$2y$10$MhAQwNg2XQKKZ4TMrSK7lerh33iShaLCPi9nwzxt42fZMTQ0zWaY6',	1,	2,	145,	NULL,	'2018-11-13 11:13:15',	'2018-11-13 11:13:15',	NULL),
(332,	'Prof. Paramita Atmodiwirjo, S.T., M.Arch., Ph.D.',	'paramita@eng.ui.ac.id',	'$2y$10$BPMLsB4Ze.Sr7rx6GjEzw.cFx4iAnOzTAp46GtE1yQ1YIBYwuKd0y',	1,	2,	146,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(333,	'Dr. Ir. Praswasti Pembangun Dyah Kencana Wulan, M.T.',	'wulan@che.ui.ac.id',	'$2y$10$ZeajgKRC27fT/JELsC7mEOBG64i1TBtnznJtS/UgXR4MBQImJxVw2',	1,	2,	147,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(334,	'Ir. Purnomo Sidi Priambodo, M.Sc., Ph.D.',	'p.s.priambodo@ieee.org',	'$2y$10$YEj6jo2Wm6MBIvyN2qi3PO9qJf8EMXDMot8mc.09Guffo4DyIrBeS',	1,	2,	148,	'JmMmJZFscDjRm1KoJn5pnu37Szv7SvlBKz2n7Eh5AlP0CyyV55u8pWG8YnhA',	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(335,	'Dr. Raden Rara Dwinanti Rika Marthanty, S.T., M.T.',	'dwinanti@eng.ui.ac.id',	'$2y$10$T/s/6YiPMrLU0QgPZSy8PO.7znCmgGB1kyhoKoab6jKvRgrS7tVn.',	1,	2,	149,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(336,	'Dr.Eng. Radon Dhelika, B.Eng., M.Eng.',	'radon@eng.ui.ac.id',	'$2y$10$.Mjl/etgNFX1dkF0JgagKOHek8tzQLMaV4FU4Mddx1bsFhP.YlzkW',	1,	2,	150,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(337,	'Dr. Ir. Rahmat Nurcahyo, M.Eng. Sc.',	'rahmat@eng.ui.ac.id',	'$2y$10$t9atTO/3Y7KISOmCSJON0.CL80en3ukrIRhbhWjEAQ3rUY.KVH1K2',	1,	2,	151,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(338,	'Ir. Rahmat Saptono, M.Sc.Tech., Ph.D.',	'rahmat.saptono@ui.ac.id',	'$2y$10$X0R6KQOqdewq6GVRSOmdSOQ0G7D2Ol6WB3eOGHUjdCWcku3PMionu',	1,	2,	152,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(339,	'Prof. Dr. Ir. Raldiartono, DEA.',	'koestoer@eng.ui.ac.id',	'$2y$10$TCz8piKETennSVNuOf43EOAPEM3uI3qRhFcXDmvIbKvQBlff.f8pu',	1,	2,	153,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(340,	'Prof. Dr. Ir. R. Danardono Agus Sumarsono, DEA. PE',	'danardon@eng.ui.ac.id',	'$2y$10$ZkQSBBqV7HSZ4z5Dyb8Ct.B99uxxIN8FumTD1d1UvvepD/rbpOwc.',	1,	2,	154,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(341,	'Dr. Ir. Retno Wigajatri Purnamaningsih, M.T.',	'retno.wigajatri@ui.ac.id',	'$2y$10$FCcetMoILlcaquC9YKO4auAlhfOZVtpKz5vUAEq2uT65rqI23yHZW',	1,	2,	155,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(342,	'Prof. Ir. Rinaldy, M.Sc., Ph.D',	'rinald@eng.ui.ac.id',	'$2y$10$M3kIaPVWPg/3Sj56clYsfuvMVAaVHnkR7ZXP84uWbBhJiPV24QMZK',	1,	2,	156,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(343,	'Dr. Ir. Rini Riastuti, M.Sc.',	'riastuti@metal.ui.ac.id',	'$2y$10$RiUJHgNqcI21SMvyNLt7zeptuqkF6.IFQnMF4spcX/LJCunUyHt6m',	1,	2,	157,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(344,	'Rini Suryantini, S.T., M.Sc.',	'rinisuryantini@gmail.com',	'$2y$10$.U4erS1Lzh9n/GuPDrkxDO7eWZ4LwCMVdAS.TYtHJjRCY5bhK/x9O',	1,	2,	158,	NULL,	'2018-11-13 11:13:16',	'2018-11-13 11:13:16',	NULL),
(345,	'Prof. Dr. Ir. Riri Fitri Sari, M.M., M.Sc.',	'riri@ui.ac.id',	'$2y$10$uQdZEyiGuJnl5sbczVbKUO5mx7k3H22rwU3oAosGtBPluiVmzb8yC',	1,	2,	159,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(346,	'Ir. Rita Arbianti, M.Si.',	'arbianti@che.ui.edu',	'$2y$10$z7c8d6h/AwE5RG0M/XY1Ne3TVpNzgBkpMz/VA7jvNZjSm6Gp0fR4S',	1,	2,	160,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(347,	'Ir. R. Jachrizal Sumabrata, M.Sc (Eng)., Ph.D.',	'rjs@eng.ui.ac.id',	'$2y$10$AblfGN4.AWtYK5r4Of/k1.07ekGYzOBW9.mXAEzsaUchtwulbaowC',	1,	2,	161,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(348,	'Rossa Turpuk Gabe, S.Ars., M.Ars.',	'ro_saturpuk_gabe@yahoo.com',	'$2y$10$wsdI9a1LPHDsNurBUIhBtO3YlRuTjfwXdZZH1yoYNRWERuQw70tMW',	1,	2,	162,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(349,	'Prof. Dr. Ir. Rudy Setiabudy, DEA.',	'rudy@eng.ui.ac.id',	'$2y$10$Lpgu32Ag.da3C7PF3n1pJuKRU6J.DcOEz3qXVz0nPCM/c9Sgi2jnq',	1,	2,	163,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(350,	'Dr. Ir. Setiadi, M.Eng.',	'setiadi@che.ui.ac.id',	'$2y$10$DE0IpzRXjxjOLqjvJ2q4Qu05Iu9LR6i6v71X81ezCG1Ks1e3VJ.Jy',	1,	2,	164,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(351,	'Prof. Dr. Ir. Setijo Bismo, DEA.',	'setijo.bismo@ui.ac.id',	'$2y$10$mP1mtMznGtrmHPXUv9GuNONfBuBKjl16OoDB3Kpn0mVqQEp2yJfOK',	1,	2,	165,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(352,	'Dr. Ir. Setyo Sarwanto Mursidik, DEA.',	'smoersidik@yahoo.com',	'$2y$10$URmQJXjD2zri7L4N8spLiuP.gwbrbFMV2foZTlm26KL90eTrUJAiK',	1,	2,	166,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(353,	'Prof. Dr. Ir. Sigit Pranowo Hadiwardoyo, DEA.',	'sigit@eng.ui.ac.id',	'$2y$10$3nz38sgSBO6ANNqIGUlnt.dailnzOop.tfD9pggYiziFL4fJJzN0.',	1,	2,	167,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(354,	'Ir. Siti Murniningsih, MS.',	'sitimurni@eng.ui.ac.id',	'$2y$10$2Q42b3q4DQpzaYtX.pE9Zucuxk4S6Zi/U1mPgHuOWrDauCTWFuHTa',	1,	2,	168,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(355,	'Prof. Dr. Ir. Slamet, M.T.',	'slamet@che.ui.ac.id',	'$2y$10$43vfjpSRg03YKu8uw6wowuFOMul1.stw0vYYxDwtv7FxI.N3el7wm',	1,	2,	169,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(356,	'Dr. Ir. Sotya Astutiningsih, M.Eng',	'sotya.astutiningsih@ui.ac.id',	'$2y$10$nqokABdSttJ5gZjeDGe8xeMYLWwUiQxt2nxYajeuprGr1zae6TRG6',	1,	2,	170,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(357,	'Dr. Ir. Sri Harjanto.,',	'harjanto@metal.ui.ac.id',	'$2y$10$7gDOILQSIM/tcedSMI5z8OoEA0U62.B6fUdAcbkBhIw4W.KI5mJxW',	1,	2,	171,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(358,	'Sugeng Supriadi, S.T., M.S.Eng., Ph.D.',	'sugeng@eng.ui.ac.id',	'$2y$10$uF6bEOnvaSzODShF6uhRBed8OMP4zkfaHXsxnf3IB3vec2arJtO5i',	1,	2,	172,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(359,	'Dr. Ir. Sukirno, M.Eng.',	'sukirnos@che.ui.edu',	'$2y$10$g/7Fp5jMjgHLKbd536HsHeY7cI28LInTn0mlpF8yjmR33dtzzNOUu',	1,	2,	173,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(360,	'Prof. Dr. Ir. Sunaryo, M.Sc.',	'naryo@eng.ui.ac.id',	'$2y$10$RhA3pa/3TnCaLaXlgQNV4ewevDlGznPMChwPz.PuCp0bz9hIKxAWu',	1,	2,	174,	NULL,	'2018-11-13 11:13:17',	'2018-11-13 11:13:17',	NULL),
(361,	'Prof. Dr. Ir. Sutanto, M.Eng.',	'sutantos@ui.ac.id',	'$2y$10$aSS926OcgLE39z30UgpBnOYaEZyi590c8aiONtW.KwXOTlPQCSrw6',	1,	2,	175,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(362,	'Prof. Ir. Sutrasno Kartohardjono, M.Sc., Ph.D.',	'sutrasno@che.ui.ac.id',	'$2y$10$xD/orzUp5IWnSqUVULJS0.zc2Bda8uDG4lz54I1.vQT4MTrIAyuFu',	1,	2,	176,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(363,	'Dr. Tania Surya Utami, S.T., M.T.',	'nana@che.ui.ac.id',	'$2y$10$7DAnfQ8zEX9wnXKoRa/mFegny9.QiueIegQX3EBaFULotiLUxowmW',	1,	2,	177,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(364,	'Ir. Teguh Utomo, MURP.',	'tiua@eng.ui.ac.id',	'$2y$10$izALzxlnxWGwVpqmgFqR/e4O9Jmgj84wXr8T7ogaCSBJIhgKhHT3u',	1,	2,	178,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(365,	'Prof. Dr. Ir. Teuku Yuri M. Zagloel, M.Eng. Sc.',	'yuri@ie.ui.ac.id',	'$2y$10$Y9SATViSHcQ.mhMg/jC7MOAr/qK/D58sdsytmiOUjdlkdruKlSbQ.',	1,	2,	179,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(366,	'Dr. Ir. Toga H. Panjaitan, A.A.Grad.Dipl.',	'toga.panjaitan@ui.edu.id',	'$2y$10$Ad82N84/f2Y97jaXcqb4suYN1Y1pmRhbtWFH0/80T7Ps1Qg2eJNT2',	1,	2,	180,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(367,	'Toha Saleh, S.T., M.Sc.',	'tohasaleh@yahoo.com',	'$2y$10$LD6N4RPL9J7TM32j00xVL.6iYuA7nXrPjhGx7IltvwCNpBtTrOMYq',	1,	2,	181,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(368,	'Prof. Dr. Ir. Tommy Ilyas, M.Eng.',	't.ilyas@eng.ui.ac.id',	'$2y$10$reaRV7.0wE6szXlbseOB1uETSFzahihZtK7X1aazEKbHdclzjcRkq',	1,	2,	182,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(369,	'Tomy Abuzairi, S.T., M.Sc., Ph.D.',	'tomy.abuzairi@gmail.com',	'$2y$10$JAHDDS.U2yIBDlCigpAYJ.tZ7dd8mu1HlUqFi3sZIBHWSrY2ivsqu',	1,	2,	183,	'6KIyFWTyBJtJJwOWodLkcggREsSJVj92KhkyBnOGvaNpYopc1vQlCn8tTmIn',	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(370,	'Prof. Dr. Ir. Tresna Priyana Soemardi,, M.Si., S.E.',	'tresdi@eng.ui.ac.id',	'$2y$10$dBxzqUMmJnza9ania1dOPu6UedJX4CakGIO000YxypKb.uifNQ/7e',	1,	2,	184,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(371,	'Prof. Ir. Triatno Judo Harjoko, M.Sc., Ph.D.',	'gotty@eng.ui.ac.id',	'$2y$10$BdbApDyLpjvtevci6iv8vOzAsxZ1TYmQYbhWq6abrrrgzEFcANdi2',	1,	2,	185,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(372,	'Dr. Ir. Tri Tjahjono, M.Sc.',	'tri.tjahjono@ui.ac.id',	'$2y$10$jaymPbAFaNrnshw90AfTK.9Py.opr7Ub1PBWXiHaByLKcJnByEoU6',	1,	2,	186,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(373,	'Ir. Wahidin Wahab, M.Sc., Ph.D.',	'wahidin.wahab@ui.ac.id',	'$2y$10$HRuQYY1yLdtH4wXCkX49j.RqmjS8/9Co3RFkNv2VG/WX96PXBQDlC',	1,	2,	187,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(374,	'Wahyuaji Narottama Putra, S.T., M.T.',	'wahyuaji@metal.ui.ac.id',	'$2y$10$RDUpkkcBQE5w8rEPJznA2uJU6uP6wUCrJfHnncuFQx1iQcj4SuJMq',	1,	2,	188,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(375,	'Dr. Ir. Wahyu Nirbito, MSME.',	'wahyu.nirbito@ui.ac.id',	'$2y$10$G/K51q97ZtXrSEowc8pLWeC0ulkx/CAScPyQL7w7/ltfe3lDg6s56',	1,	2,	189,	NULL,	'2018-11-13 11:13:18',	'2018-11-13 11:13:18',	NULL),
(376,	'Ir. Warjito, M.Sc., Ph.D',	'warjito.sph@ui.ac.id',	'$2y$10$7NKbq8whXEJJa/x2ISpI4OaSFeZcc.ZGNxoSIDq2F86WEB/TrpTJi',	1,	2,	190,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(377,	'Prof. Ir. Widjojo Adi Prakoso, M.Sc., Ph.D',	'wprakoso@eng.ui.ac.id',	'$2y$10$6HQEmQxNt3spu4uXYVizcOZyajDxg3a.SH7L3v2k6.7mmcjd5jeGC',	1,	2,	191,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(378,	'Prof. Dr. Ir. Widodo Wahyu Purwanto, DEA.',	'widodo@che.ui.ac.id',	'$2y$10$NyFnwHEpCbl25sZtpO3TbuZtNBWTroKuYFlSV9abdYx4eLV3CZHl.',	1,	2,	192,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(379,	'Prof. Dr. Ir. Winarto, M.Sc',	'winarto.msc@ui.ac.id',	'$2y$10$pam7q7WP3dRnGHWzdvvSVehanGKu6NM7aDKoG2xYXpNSo.xmIxAoK',	1,	2,	193,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(380,	'Dr. Ir. Wiwik Rahayu, DEA',	'wrahayu@eng.ui.ac.id',	'$2y$10$1f8h21XOIlGy5w8HlkbfleyhvBnZVFb7BL.aa5ZfsNuawdE55dNLu',	1,	2,	194,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(381,	'Ir. Yadrifil, M.Sc.',	'yadrifil@eng.ui.ac.id',	'$2y$10$VWodM.ty19ke0iMrtHJE4OrT5f2OR2jkitKKXzzu7X2FTRvozNHKK',	1,	2,	195,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(382,	'Prof. Yandi Andri Yatmo, S.T., M.Arch., Ph.D.',	'yandi.andri@ui.ac.id',	'$2y$10$a12wsy6ZAaMJYoWS3vtaTu5F7yLICKd/L1G5WzTU.MazYv4tuld7O',	1,	2,	196,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(383,	'Yan Maraden, S.T., M.T., M.Sc.',	'maradens@eng.ui.ac.id',	'$2y$10$fYRBG6UWaM4JU2rsL8MrT.pvwr2M4h9utxoQfn8fc0NM0wv9v7XIq',	1,	2,	197,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(384,	'Prof. Dr. Ir. Yanuar, M.Eng., M.Sc.',	'yanuar@eng.ui.ac.id',	'$2y$10$9DvWe4GP3PQ8m1nPOtMmYetJpihuwyuShlGQ0d6a0/p2ecd2YVgoW',	1,	2,	198,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(385,	'Dr. Yudan Whulanza, S.T., M.Sc.',	'yudan@eng.ui.ac.id',	'$2y$10$R/kWM1SPc1xHjRHfcQhyX.UT9/Uj3DEYq5tqKCDObhYt1Ax8LnSva',	1,	2,	199,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(386,	'Yudha Pratesa, S.T., M.T.',	'yudha.pratesa@gmail.com',	'$2y$10$VS5duedG6DrZhWB0p1ZDLOSjNhfUCHTk7OrZZN7SG4h4Od2EFwcaK',	1,	2,	200,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(387,	'Prof. Ir. Yulianto Sulistyo Nugroho, M.Sc., Ph.D',	'yulianto.nugroho@ui.ac.id',	'$2y$10$5LIb7hbe09.zOyaxEcEpY.iDBzXvGdksvpKTtxK1X2qGkpZfqXmim',	1,	2,	201,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(388,	'Dr. Ing. Yulia Nurliani Harahap, S.T., M.Des.S.',	'yulianurliani@yahoo.com',	'$2y$10$DK/UVclQBU5SvU93mXU8jeXndI7BwnYuzf6K6jr.HzvIVplTzhZ4i',	1,	2,	202,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(389,	'Dr. Ir. Yuliusman, M.Eng.',	'usman@che.ui.ac.id',	'$2y$10$DWGiY8KB6bxTa7VQb2oYKOXhH.lUds2kSUAsXsDWRDwy62jTkFFA.',	1,	2,	203,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(390,	'Dr. Ir. Yunita Sadeli, M.Sc',	'yunce@metal.ui.ac.id',	'$2y$10$3mD1xy6evyNKcN.RVVFqUeqDPfjQnviPgYbYGQuXDnOS6v4YpyPLG',	1,	2,	204,	NULL,	'2018-11-13 11:13:19',	'2018-11-13 11:13:19',	NULL),
(391,	'Dr. Ir. Yuskar Lase, DEA',	'yuskar@eng.ui.ac.id',	'$2y$10$Aaq7R7/2Usa.wiUTFzbwvuMbWjbXVrxAAuItliTvG1OutHUPPbiTe',	1,	2,	205,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(392,	'Prof. Dr. Ir. Yusuf Latief, M.T.',	'latief73@eng.ui.ac.id',	'$2y$10$HVG1Ln43mTTOCDglCLEq8uluKFYKtroy8E4fP5E9s0OAuPICklMUO',	1,	2,	206,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(393,	'Dr. rer. nat. Ir. Yuswan Muharam, M.T.',	'muharam@che.ui.ac.id',	'$2y$10$YC8kr1HiW/uyQWihscJtoutdFFTOONoD3Zsa5uKLZVLH8rghYoa9S',	1,	2,	207,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(394,	'Arian Dhini, S.T., M.T',	'arian@ie.ui.ac.id',	'$2y$10$O5Os5m1ahpXvtyBQJfSqT.eAocbKVd4HwSm4LPJiNJ9YCHnDBw.h.',	1,	2,	208,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(395,	'Armand Omar Moeis, S.T., M.Sc',	'armand.omar@ui.ac.id',	'$2y$10$JlIZF4FaDw6ysE2qakMvXeBmwLabPtb1pFfU6GD7YDFbEuY1Spj0K',	1,	2,	209,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(396,	'Ir. Dendi P. Ishak, MSIE.',	'dendi@ie.ui.ac.id',	'$2y$10$0CVjuAXW1hLsaltAhdohCeJEwvXXIx2ZlW8pg/OW/WGPGl9W.nz1m',	1,	2,	210,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(397,	'Gunawan, S.T., M.T.',	'gunawan_kapal@eng.ui.ac.id',	'$2y$10$VAzp7uWvH8hBoh7dWd9dK.ixhihZAzeXPoFoVj86w42FZXnfee18i',	1,	2,	211,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(398,	'Maya Arlini Puspasari, S.T., M.T.',	'maya@ie.ui.ac.id',	'$2y$10$bIyyC5lXfyMZF.SBH7Wu.u7Go1OmlsmgPrUlJ3mcHiI14lUDY1xq6',	1,	2,	212,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(399,	'Taufiq Alif Kurniawan, M.T., M.Sc.',	'taufiq.alif@gmail.com',	'$2y$10$N3NUChF8gqaERfmeIAbZPesnOPFOTZOOsowjRX1X3PKiODX7kaT.W',	1,	2,	213,	NULL,	'2018-11-13 11:13:20',	'2018-11-13 11:13:20',	NULL),
(400,	'Ramadhan',	'ramadhan@email.com',	'$2y$10$y4dmFHTyxyeYmpHEjWH8MueyVcB3W8BPusybcehEMrlLeEsyQULqu',	1,	3,	1,	's4qFizV1fwV18JXMD4Bs9ZyKRtD3CV2J5aflxqrAXSBDyu9LcsW44nOaWXZe',	'2018-11-13 11:21:36',	'2018-11-13 11:22:23',	NULL),
(401,	'Fachran Nazarullah',	'fachran.nazarullah@gmail.com',	'$2y$10$zjCQCia7cxgPQ1VnYGvWHe/X4UQPgl7m9V9wVNc0MKHul9Fr.kqGC',	1,	3,	1,	'fNbEAFpCaGZQHvpHCTlTsNs6uPkxR5GMqVn1bogfpaBBouHCbzNlCocSitOx',	'2018-11-16 10:33:56',	'2018-11-16 10:33:56',	NULL),
(402,	'Wahyuaji Dummy',	'wahyuaji.np@gmail.com',	'$2y$10$3kX17LqXWIMlJscwdP7SW.pr8BsWxZAtHT/2/5vVzzqDRumxHGjQ.',	1,	3,	2,	NULL,	'2018-11-16 10:47:23',	'2018-11-16 10:48:02',	NULL),
(403,	'Widya Wuri Handayani',	'widya.wuri.handayani@gmail.com',	'$2y$10$cIM23vrUQwOFIzYQ5STiked9z24cu.2imsacT1CYspcwLw8c2z1aC',	1,	3,	3,	'YCzsGf82VrfRXevHXNO5aicLCEccWWwFT7n2kVMzUzNdtkRKMKn5873H7meu',	'2018-12-09 13:58:10',	'2018-12-09 13:58:33',	NULL),
(404,	'Salman',	'salman@email.com',	'$2y$10$LlX5zXzP3GUX6Gi/iWIYR.F/Z.Yqu7LD8bfyDHONAXahpFklYgRo2',	1,	3,	4,	'UZeXq6oW2hD5Ayb5B5ALaxK2HBYc0Q7KzKOO9xCG6u6BvI4WUwkrfG4uOf3V',	'2018-12-11 15:58:05',	'2018-12-11 15:59:57',	NULL);

-- 2019-01-18 06:48:45
