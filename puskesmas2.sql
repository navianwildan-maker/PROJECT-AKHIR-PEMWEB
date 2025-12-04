-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2025 pada 09.46
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
-- Database: `puskesmas2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(5) NOT NULL,
  `password` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `poli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama`, `poli`) VALUES
(1, 'Dr. Rudi Taputi', 'Umum'),
(2, 'Dr. Andi Cobra', 'Umum'),
(3, 'Drg. Nur Heri Cahyono', 'Gigi'),
(4, 'Bidan Nike Ardila, A.Md.Keb', 'KIA & Imunisasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari_praktik` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id_jadwal`, `id_dokter`, `hari_praktik`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 'Senin', '08:00:00', '14:00:00'),
(2, 1, 'Selasa', '08:00:00', '14:00:00'),
(3, 1, 'Rabu', '08:00:00', '14:00:00'),
(4, 2, 'Kamis', '08:00:00', '14:00:00'),
(5, 2, 'Jumat', '08:00:00', '14:00:00'),
(6, 2, 'Sabtu', '08:00:00', '14:00:00'),
(7, 3, 'Senin', '08:00:00', '12:00:00'),
(8, 3, 'Rabu', '08:00:00', '12:00:00'),
(9, 3, 'Jumat', '08:00:00', '12:00:00'),
(10, 4, 'Senin', '08:00:00', '14:00:00'),
(11, 4, 'Selasa', '08:00:00', '14:00:00'),
(12, 4, 'Rabu', '08:00:00', '14:00:00'),
(13, 4, 'Kamis', '08:00:00', '14:00:00'),
(14, 4, 'Jumat', '08:00:00', '14:00:00'),
(15, 4, 'Sabtu', '08:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_fisik`
--

CREATE TABLE `kamar_fisik` (
  `id_kamar` int(11) NOT NULL,
  `nomor_kamar` varchar(10) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `status_kamar` enum('Tersedia','Terisi','Dibersihkan','Perbaikan') NOT NULL DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar_fisik`
--

INSERT INTO `kamar_fisik` (`id_kamar`, `nomor_kamar`, `id_kelas`, `status_kamar`) VALUES
(1, 'VIP-1', 1, 'Terisi'),
(2, 'VIP-2', 1, 'Tersedia'),
(101, '101', 2, 'Tersedia'),
(102, '102', 2, 'Tersedia'),
(103, '103', 2, 'Tersedia'),
(201, '201', 3, 'Tersedia'),
(202, '202', 3, 'Tersedia'),
(203, '203', 3, 'Tersedia'),
(301, '301', 4, 'Tersedia'),
(302, '302', 4, 'Tersedia'),
(303, '303', 4, 'Tersedia'),
(304, '304', 4, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_kamar`
--

CREATE TABLE `kelas_kamar` (
  `id_kelas` int(1) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `tarif` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_kamar`
--

INSERT INTO `kelas_kamar` (`id_kelas`, `nama_kelas`, `tarif`) VALUES
(1, 'VIP/VVIP', 1000000),
(2, 'Kelas 1', 500000),
(3, 'Kelas 2', 300000),
(4, 'Kelas 3', 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `poli_tujuan` varchar(50) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `id_pasien`, `id_jadwal`, `poli_tujuan`, `tanggal_kunjungan`, `nomor_antrian`, `status`) VALUES
(3, 18, 1, 'Umum', '2025-12-01', 1, 3),
(5, 20, 1, 'Umum', '2025-11-24', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `bpjs` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `nik`, `bpjs`) VALUES
(17, 'Osle', '23443223', '344239494'),
(18, 'Makaroni', '1224332', NULL),
(20, 'Kuromie', '1234456', NULL),
(22, 'Ray', '12111', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesankamar`
--

CREATE TABLE `pesankamar` (
  `id` int(11) NOT NULL,
  `id_pasien` int(1) DEFAULT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesankamar`
--

INSERT INTO `pesankamar` (`id`, `id_pasien`, `id_kamar`, `tanggal_masuk`) VALUES
(18, 20, 1, '2025-12-03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `kamar_fisik`
--
ALTER TABLE `kamar_fisik`
  ADD PRIMARY KEY (`id_kamar`),
  ADD UNIQUE KEY `nomor_kamar` (`nomor_kamar`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `kelas_kamar`
--
ALTER TABLE `kelas_kamar`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `nama_kelas` (`nama_kelas`);

--
-- Indeks untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD UNIQUE KEY `id_pasien` (`id_pasien`,`id_jadwal`,`tanggal_kunjungan`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `UQ_bpjs` (`bpjs`);

--
-- Indeks untuk tabel `pesankamar`
--
ALTER TABLE `pesankamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kamar_fisik`
--
ALTER TABLE `kamar_fisik`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pesankamar`
--
ALTER TABLE `pesankamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);

--
-- Ketidakleluasaan untuk tabel `kamar_fisik`
--
ALTER TABLE `kamar_fisik`
  ADD CONSTRAINT `kamar_fisik_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas_kamar` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_dokter` (`id_jadwal`);

--
-- Ketidakleluasaan untuk tabel `pesankamar`
--
ALTER TABLE `pesankamar`
  ADD CONSTRAINT `pesankamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar_fisik` (`id_kamar`),
  ADD CONSTRAINT `pesankamar_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
