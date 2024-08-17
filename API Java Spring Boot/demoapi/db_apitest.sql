-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2024 pada 19.00
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apitest`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kota` varchar(255) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `created_at`, `kota`, `nama_lokasi`, `negara`, `provinsi`) VALUES
(1, '2024-08-16 19:41:51', 'Bandung', 'Dago', 'Indonesia', 'Jawa Barat'),
(2, '2024-08-16 20:32:17', 'Bandung', 'Gegerkalong', 'Indonesia', 'Jawa Barat'),
(4, '2024-08-17 15:37:41', 'Bandung', 'Sariwangi', 'Indonesia', 'Jawa Barat'),
(6, '2024-08-17 16:53:56', 'Bandung', 'Gegerkalong Girang', 'Indonesia', 'Jawa Barat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `tgl_mulai` datetime(6) NOT NULL,
  `tgl_selesai` datetime(6) NOT NULL,
  `pimpinan_proyek` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_lokasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `client`, `tgl_mulai`, `tgl_selesai`, `pimpinan_proyek`, `keterangan`, `created_at`, `id_lokasi`) VALUES
(1, 'Pembangunan Hotel', 'Company', '2024-08-13 19:42:17.000000', '2024-08-23 19:42:17.000000', 'Riska', 'Waktu 2 Bulan', '2024-08-16 19:43:05', 1),
(2, 'Pembangunan Rumah', 'Company', '2024-08-13 19:42:17.000000', '2024-08-23 19:42:17.000000', 'Riska', 'Waktu 2 Bulan', '2024-08-16 20:51:17', 1),
(3, 'Pembangunan Sekolah', 'Company', '2024-08-13 19:42:17.000000', '2024-08-23 19:42:17.000000', 'Riska', 'Waktu 2 Bulan', '2024-08-16 20:53:02', 2),
(5, 'Pembangunan Restoran', 'Pak Bajang', '2024-08-17 00:00:00.000000', '2024-08-24 00:00:00.000000', 'Riska', 'Waktu 3 Bulan', '2024-08-17 12:14:12', 2),
(7, 'Pembangunan Kantor', 'Pak Kim', '2024-08-23 00:00:00.000000', '2024-08-31 00:00:00.000000', 'Tiara', 'Waktu 1 Tahun', '2024-08-17 13:52:00', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKe47c23b8wh06ur6ewj7g9owuf` (`id_lokasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD CONSTRAINT `FKe47c23b8wh06ur6ewj7g9owuf` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
