-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Bulan Mei 2023 pada 00.20
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `103599`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `role`) VALUES
(1, 'ADM-1', 'admin', 'admin'),
(2, 'KAS-1', 'kasir', 'kasir'),
(3, 'MO-1', 'mo', 'manager'),
(4, 'INS-7', 'instruktur', 'instruktur'),
(5, '23.04.2', '2023-04-11', 'member'),
(6, '23.05.3', 'margareth', 'member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id` int NOT NULL,
  `nama` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id`, `nama`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jum\'at'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ijin_instruktur`
--

CREATE TABLE `ijin_instruktur` (
  `id` int NOT NULL,
  `id_instruktur` int NOT NULL,
  `id_jadwalhar` int NOT NULL,
  `keterangan` text NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `id_pengganti` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ijin_instruktur`
--

INSERT INTO `ijin_instruktur` (`id`, `id_instruktur`, `id_jadwalhar`, `keterangan`, `status`, `id_pengganti`) VALUES
(1, 15, 15, 'ada acara keluarga', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruktur`
--

CREATE TABLE `instruktur` (
  `id` int NOT NULL,
  `instrukturid` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `instruktur`
--

INSERT INTO `instruktur` (`id`, `instrukturid`, `nama`, `alamat`, `jenis_kelamin`) VALUES
(1, 'INS-1', 'Budi', 'jakarta', 'Laki-laki'),
(5, 'INS-5', 'Joon', '', ''),
(6, 'INS-6', 'JK', '', ''),
(7, 'INS-7', 'Lisa', '', ''),
(8, 'INS-8', 'Hobby', '', ''),
(9, 'INS-9', 'V', '', ''),
(10, 'INS-10', 'Jenny', '', ''),
(11, 'INS-11', 'Suga', '', ''),
(12, 'INS-12', 'Rose', '', ''),
(13, 'INS-13', 'Jin', '', ''),
(14, 'INS-14', 'Jisoo', '', ''),
(15, 'INS-15', 'Jimin', '', ''),
(16, 'INS-16', 'Jessi', '', ''),
(17, 'INS-17', 'Jerry', 'Pepaya', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_default`
--

CREATE TABLE `jadwal_default` (
  `id` int NOT NULL,
  `id_kelas` int NOT NULL DEFAULT '0',
  `id_jam` int DEFAULT '0',
  `id_instruktur` int NOT NULL DEFAULT '0',
  `id_hari` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_default`
--

INSERT INTO `jadwal_default` (`id`, `id_kelas`, `id_jam`, `id_instruktur`, `id_hari`) VALUES
(4, 2, 2, 6, 1),
(5, 3, 3, 14, 1),
(6, 4, 4, 8, 1),
(7, 5, 1, 7, 2),
(8, 6, 2, 8, 2),
(9, 7, 3, 14, 2),
(10, 1, 3, 11, 2),
(11, 8, 4, 12, 2),
(12, 9, 1, 9, 3),
(13, 10, 1, 10, 3),
(14, 11, 2, 11, 3),
(15, 12, 3, 16, 3),
(16, 13, 3, 13, 3),
(17, 14, 4, 15, 3),
(18, 15, 1, 12, 4),
(19, 13, 2, 13, 4),
(20, 16, 3, 10, 4),
(21, 9, 4, 9, 4),
(22, 11, 1, 13, 5),
(23, 3, 2, 14, 5),
(24, 10, 3, 10, 5),
(25, 2, 4, 6, 5),
(26, 14, 1, 15, 6),
(27, 17, 2, 7, 6),
(28, 18, 2, 6, 6),
(29, 19, 3, 16, 6),
(31, 14, 3, 15, 6),
(32, 7, 1, 5, 7),
(33, 1, 1, 5, 1),
(34, 8, 4, 12, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_harian`
--

CREATE TABLE `jadwal_harian` (
  `id` int NOT NULL,
  `tgl` date NOT NULL,
  `id_kelas` int NOT NULL,
  `id_jam` int NOT NULL,
  `id_instruktur` int NOT NULL,
  `id_hari` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `id_instruktur2` int NOT NULL DEFAULT '0',
  `mulai_kelas` datetime DEFAULT NULL,
  `terlambat` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_harian`
--

INSERT INTO `jadwal_harian` (`id`, `tgl`, `id_kelas`, `id_jam`, `id_instruktur`, `id_hari`, `status`, `id_instruktur2`, `mulai_kelas`, `terlambat`) VALUES
(1, '2023-05-01', 1, 1, 5, 1, 0, 0, NULL, 0),
(2, '2023-05-01', 2, 2, 6, 1, 0, 0, NULL, 0),
(3, '2023-05-01', 3, 3, 14, 1, 0, 0, NULL, 0),
(4, '2023-05-01', 4, 4, 8, 1, 0, 0, NULL, 0),
(5, '2023-05-02', 5, 1, 7, 2, 0, 0, NULL, 0),
(6, '2023-05-02', 6, 2, 8, 2, 0, 0, NULL, 0),
(7, '2023-05-02', 7, 3, 14, 2, 0, 0, NULL, 0),
(8, '2023-05-02', 1, 3, 11, 2, 0, 0, NULL, 0),
(9, '2023-05-02', 8, 4, 12, 2, 0, 0, NULL, 0),
(10, '2023-05-03', 9, 1, 9, 3, 0, 0, NULL, 0),
(11, '2023-05-03', 10, 1, 10, 3, 0, 0, NULL, 0),
(12, '2023-05-03', 11, 2, 11, 3, 0, 0, NULL, 0),
(13, '2023-05-03', 12, 3, 16, 3, 0, 0, NULL, 0),
(14, '2023-05-03', 13, 3, 13, 3, 0, 0, NULL, 0),
(15, '2023-05-03', 14, 4, 15, 3, 0, 0, NULL, 0),
(16, '2023-05-04', 15, 1, 12, 4, 0, 0, NULL, 0),
(17, '2023-05-04', 13, 2, 13, 4, 0, 0, NULL, 0),
(18, '2023-05-04', 16, 3, 10, 4, 0, 0, NULL, 0),
(19, '2023-05-04', 9, 4, 9, 4, 0, 0, NULL, 0),
(20, '2023-05-05', 11, 1, 13, 5, 0, 0, NULL, 0),
(21, '2023-05-05', 3, 2, 14, 5, 0, 0, NULL, 0),
(22, '2023-05-05', 10, 3, 10, 5, 0, 0, NULL, 0),
(23, '2023-05-05', 2, 4, 6, 5, 0, 0, NULL, 0),
(24, '2023-05-06', 14, 1, 15, 6, 0, 0, NULL, 0),
(25, '2023-05-06', 17, 2, 7, 6, 0, 0, NULL, 0),
(26, '2023-05-06', 18, 2, 6, 6, 0, 0, NULL, 0),
(27, '2023-05-06', 19, 3, 16, 6, 0, 0, NULL, 0),
(28, '2023-05-06', 14, 3, 15, 6, 0, 0, NULL, 0),
(29, '2023-05-06', 8, 4, 12, 6, 0, 0, NULL, 0),
(30, '2023-05-07', 7, 1, 5, 7, 0, 0, NULL, 0),
(31, '2023-05-22', 1, 1, 5, 1, 0, 0, NULL, 0),
(32, '2023-05-22', 2, 2, 6, 1, 0, 0, NULL, 0),
(33, '2023-05-22', 3, 3, 14, 1, 0, 0, NULL, 0),
(34, '2023-05-22', 4, 4, 8, 1, 0, 0, NULL, 0),
(35, '2023-05-23', 5, 1, 7, 2, 0, 0, NULL, 0),
(36, '2023-05-23', 6, 2, 8, 2, 0, 0, NULL, 0),
(37, '2023-05-23', 7, 3, 14, 2, 0, 0, NULL, 0),
(38, '2023-05-23', 1, 3, 11, 2, 0, 0, NULL, 0),
(39, '2023-05-23', 8, 4, 12, 2, 0, 0, NULL, 0),
(40, '2023-05-24', 9, 1, 9, 3, 0, 0, NULL, 0),
(41, '2023-05-24', 10, 1, 10, 3, 0, 0, NULL, 0),
(42, '2023-05-24', 11, 2, 11, 3, 0, 0, NULL, 0),
(43, '2023-05-24', 12, 3, 16, 3, 0, 0, NULL, 0),
(44, '2023-05-24', 13, 3, 13, 3, 0, 0, NULL, 0),
(45, '2023-05-24', 14, 4, 15, 3, 0, 0, NULL, 0),
(46, '2023-05-25', 15, 1, 12, 4, 0, 0, NULL, 0),
(47, '2023-05-25', 13, 2, 13, 4, 0, 0, NULL, 0),
(48, '2023-05-25', 16, 3, 10, 4, 0, 0, NULL, 0),
(49, '2023-05-25', 9, 4, 9, 4, 0, 0, NULL, 0),
(50, '2023-05-26', 11, 1, 13, 5, 0, 0, NULL, 0),
(51, '2023-05-26', 3, 2, 14, 5, 0, 0, NULL, 0),
(52, '2023-05-26', 10, 3, 10, 5, 0, 0, NULL, 0),
(53, '2023-05-26', 2, 4, 6, 5, 0, 0, NULL, 0),
(54, '2023-05-27', 14, 1, 15, 6, 0, 0, NULL, 0),
(55, '2023-05-27', 17, 2, 7, 6, 0, 0, NULL, 0),
(56, '2023-05-27', 18, 2, 6, 6, 0, 0, NULL, 0),
(57, '2023-05-27', 19, 3, 16, 6, 0, 0, NULL, 0),
(58, '2023-05-27', 14, 3, 15, 6, 0, 0, NULL, 0),
(59, '2023-05-27', 8, 4, 12, 6, 0, 0, NULL, 0),
(60, '2023-05-28', 7, 1, 5, 7, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam`
--

CREATE TABLE `jam` (
  `id` int NOT NULL,
  `slot` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jam`
--

INSERT INTO `jam` (`id`, `slot`) VALUES
(1, '07:00-09:00'),
(2, '09:00-11:00'),
(3, '11:00-13:00'),
(4, '13:00-15:00'),
(5, '15:00-17:00'),
(6, '17:00-19:00'),
(7, '19:00-21:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_kelas`
--

CREATE TABLE `jam_kelas` (
  `id` int NOT NULL,
  `slot` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jam_kelas`
--

INSERT INTO `jam_kelas` (`id`, `slot`) VALUES
(1, '08:00'),
(2, '09:30'),
(3, '17:00'),
(4, '18:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id` int NOT NULL,
  `kode` varchar(6) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id`, `kode`, `keterangan`) VALUES
(1, '01', 'Aktivasi Tahunan'),
(2, '02', 'Deposit Reguler'),
(3, '03', 'Deposit Kelas Paket'),
(4, '04', 'Presensi Gym'),
(5, '05', 'Presensi Kelas'),
(6, '06', 'Presensi Kelas Paket');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id` int NOT NULL,
  `kasirid` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id`, `kasirid`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `tgl_lahir`) VALUES
(1, 'KAS-1', 'Agus', '', '', 'Laki-laki', '2023-04-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `kapasitas` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `harga`, `kapasitas`, `deskripsi`) VALUES
(1, 'Spine Corrector', '150000', '', ''),
(2, 'MUAYTHAI', '150000', '', ''),
(3, 'Bellydance', '150000', '', ''),
(4, 'Pound Fit', '150000', '', ''),
(5, 'PILATES', '150000', '', ''),
(6, 'ASTHANGA', '150000', '', ''),
(7, 'Calisthenics', '150000', '', ''),
(8, 'Trampoline Workout', '200000', '', ''),
(9, 'Body Combat', '150000', '', ''),
(10, 'ZUMBA', '150000', '', ''),
(11, 'HATHA', '150000', '', ''),
(12, 'Yoga For Kids', '150000', '', ''),
(13, 'Basic Swing', '150000', '', ''),
(14, 'BUNGEE', '200000', '', ''),
(15, 'Wall Swing', '150000', '', ''),
(16, 'Abs Pilates', '150000', '', ''),
(17, 'Yogalates', '150000', '', ''),
(18, 'BOXING', '150000', '', ''),
(19, 'Swing For Kids', '150000', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_deposit`
--

CREATE TABLE `kelas_deposit` (
  `id` int NOT NULL,
  `memberid` varchar(20) NOT NULL,
  `id_kelas` int NOT NULL,
  `sisa_deposit` int NOT NULL DEFAULT '0',
  `masa_aktif` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_deposit`
--

INSERT INTO `kelas_deposit` (`id`, `memberid`, `id_kelas`, `sisa_deposit`, `masa_aktif`) VALUES
(1, '23.05.3', 5, 6, '2023-06-02 15:30:43'),
(2, '23.04.2', 5, 5, '2023-06-07 21:05:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_paket`
--

CREATE TABLE `kelas_paket` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` varchar(20) NOT NULL DEFAULT '0',
  `kelas` int NOT NULL DEFAULT '0',
  `jenis_promo` varchar(10) DEFAULT NULL,
  `sesi` int NOT NULL DEFAULT '0',
  `gratis` int NOT NULL DEFAULT '0',
  `durasi` int NOT NULL DEFAULT '0',
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_paket`
--

INSERT INTO `kelas_paket` (`id`, `nama`, `harga`, `kelas`, `jenis_promo`, `sesi`, `gratis`, `durasi`, `deskripsi`) VALUES
(1, 'bayar 5 gratis 1', '750000', 5, NULL, 5, 1, 1, 'Bayar 5 sesi, gratis 1. Berlaku 1 bulan sejak pembayaran.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manager`
--

CREATE TABLE `manager` (
  `id` int NOT NULL,
  `managerid` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `manager`
--

INSERT INTO `manager` (`id`, `managerid`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `tgl_lahir`) VALUES
(1, 'MO-1', 'Albert', '', '', '', '2023-04-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int NOT NULL,
  `memberid` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `masa_aktif` datetime DEFAULT NULL,
  `sisa_deposit` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `memberid`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `tgl_lahir`, `status`, `masa_aktif`, `sisa_deposit`) VALUES
(2, '23.04.2', 'Budi', 'jalan jalan', '085123', 'Laki-laki', '2023-04-11', 1, '2024-04-30 15:10:35', '3800000'),
(3, '23.05.3', 'Catherine Margareth', 'Jakarta', '085123434', 'Perempuan', '1994-11-01', 0, NULL, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `detail` text,
  `jenis` varchar(10) NOT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id`, `nama`, `detail`, `jenis`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, 'Promo Top Up Reguler', 'Member harus memiliki deposit, dengan minimal deposit Rp.500.000.\r\nSetiap deposit Rp.3.000.000,- mendapat bonus deposit Rp.300.000,-\r\nUang yang sudah didepositkan tidak dapat diminta kembali.', 'reguler', '2023-05-29 11:02:00', '2023-06-30 11:03:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `no_struk` varchar(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jenis_transaksi` varchar(5) NOT NULL,
  `member` varchar(20) NOT NULL,
  `kasir` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktu` varchar(11) DEFAULT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `masa_aktif_member` datetime DEFAULT NULL,
  `jadwal_har` int NOT NULL DEFAULT '0',
  `kelas_paket` int NOT NULL DEFAULT '0',
  `bonus_deposit` varchar(20) NOT NULL DEFAULT '0',
  `sisa_deposit` varchar(20) NOT NULL DEFAULT '0',
  `total_deposit` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `no_struk`, `tanggal`, `jenis_transaksi`, `member`, `kasir`, `waktu`, `jumlah`, `masa_aktif_member`, `jadwal_har`, `kelas_paket`, `bonus_deposit`, `sisa_deposit`, `total_deposit`) VALUES
(1, '23.04.1', '2023-04-26 10:49:07', '01', '23.04.2', 'KAS-1', NULL, 3000000, '2023-04-26 10:49:07', 0, 0, '0', '0', '0'),
(2, '23.04.2', '2023-04-30 15:27:55', '02', '23.04.2', 'KAS-1', NULL, 3500000, NULL, 0, 0, '300000', '0', '3800000'),
(3, '23.04.3', '2023-04-30 15:43:51', '02', '23.04.2', 'KAS-1', NULL, 200000, NULL, 0, 0, '0', '3800000', '4000000'),
(4, '23.05.4', '2023-05-02 15:30:43', '03', '23.05.3', 'KAS-1', NULL, 750000, '2023-06-02 15:30:43', 0, 1, '0', '0', '0'),
(5, '23.05.5', '2023-05-07 21:05:10', '03', '23.04.2', 'KAS-1', NULL, 750000, '2023-06-07 21:05:10', 0, 1, '0', '0', '0'),
(6, '23.05.6', '2023-05-09 19:31:39', '04', '23.04.2', 'KAS-1', '15:00-17:00', 0, NULL, 0, 0, '0', '0', '0'),
(7, '23.05.7', '2023-05-15 10:55:41', '04', '23.04.2', 'KAS-1', '09:00-11:00', 0, NULL, 0, 0, '0', '0', '0'),
(8, '23.05.8', '2023-05-15 10:59:41', '04', '23.04.2', 'KAS-1', '11:00-13:00', 0, NULL, 0, 0, '0', '0', '0'),
(9, '23.05.9', '2023-05-19 14:54:05', '05', '23.04.2', NULL, NULL, 200000, NULL, 28, 0, '0', '3800000', '0'),
(10, '23.05.10', '2023-05-20 08:01:20', '06', '23.04.2', NULL, NULL, 0, '2023-06-07 21:05:10', 5, 0, '0', '5', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ijin_instruktur`
--
ALTER TABLE `ijin_instruktur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_default`
--
ALTER TABLE `jadwal_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_harian`
--
ALTER TABLE `jadwal_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jam_kelas`
--
ALTER TABLE `jam_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas_deposit`
--
ALTER TABLE `kelas_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas_paket`
--
ALTER TABLE `kelas_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ijin_instruktur`
--
ALTER TABLE `ijin_instruktur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `jadwal_default`
--
ALTER TABLE `jadwal_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `jadwal_harian`
--
ALTER TABLE `jadwal_harian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `jam`
--
ALTER TABLE `jam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jam_kelas`
--
ALTER TABLE `jam_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `kelas_deposit`
--
ALTER TABLE `kelas_deposit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelas_paket`
--
ALTER TABLE `kelas_paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
