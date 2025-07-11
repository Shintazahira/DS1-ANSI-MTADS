-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2025 pada 07.31
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bimbingan`
--

CREATE TABLE `bimbingan` (
  `bimbingan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `topik_id` int(11) NOT NULL,
  `status` enum('aktif','selesai') DEFAULT 'aktif',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bimbingan`
--

INSERT INTO `bimbingan` (`bimbingan_id`, `mahasiswa_id`, `dosen_id`, `topik_id`, `status`, `tanggal_mulai`, `tanggal_selesai`, `catatan`, `nama_mahasiswa`) VALUES
(16, 16, 1, 4, 'aktif', '2026-06-23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `dosen_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `jabatan_akademik` varchar(100) DEFAULT NULL,
  `bidang_keahlian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`dosen_id`, `user_id`, `nidn`, `jabatan_akademik`, `bidang_keahlian`) VALUES
(1, 21, '987654321', 'Asisten Ahli', 'Analisis Perancangan Sistem Informasi'),
(2, 2, '12345678', 'Lektor', 'Analisis Perancangan Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mahasiswa_id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`mahasiswa_id`, `nim`, `nama`, `jurusan`, `angkatan`, `email`, `user_id`) VALUES
(16, '22000123', 'Hasta Sukran', 'Teknik Informatika', 2022, 'hasta@example.com', 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_proposal` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `alasan_penolakan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `mahasiswa_id`, `judul`, `deskripsi`, `file_proposal`, `status`, `alasan_penolakan`, `created_at`) VALUES
(3, 1, 'cara pakai sepatu yang baik dan benar', 'tutorial pakai sepatu by Hasta', '1749961258_d025f5ca216a64493b53.pdf', 'menunggu', NULL, '2025-06-15 12:20:58'),
(4, 1, 'Wali Kota', 'saya lupa apa ini', '1749961426_d7cb44a480db5a213c2c.pdf', 'menunggu', NULL, '2025-06-15 12:23:46'),
(5, 18, 'jangan lupa makan ya', 'aduh ganteng nya', '1749962449_818ef7da8a5463e6c96f.png', 'menunggu', NULL, '2025-06-15 12:40:49'),
(6, 28, 'ko sapa pu anak', 'tolong ya', '1749963979_558cda1cbf03f25b4318.pdf', 'menunggu', NULL, '2025-06-15 13:06:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `dosen_pembimbing` varchar(100) DEFAULT NULL,
  `status` enum('Diajukan','Disetujui','Ditolak') DEFAULT 'Diajukan',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `proposal`
--

INSERT INTO `proposal` (`id`, `mahasiswa_id`, `judul`, `dosen_pembimbing`, `status`, `created_at`) VALUES
(4, 28, 'hidup senang mati tak mau', 'Ibu Miftah', 'Diajukan', '2025-06-15 13:05:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminar`
--

CREATE TABLE `seminar` (
  `seminar_id` int(11) NOT NULL,
  `bimbingan_id` int(11) NOT NULL,
  `judul_seminar` varchar(255) NOT NULL,
  `abstrak` text NOT NULL,
  `tanggal_seminar` datetime NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `status` enum('diajukan','disetujui','ditolak','selesai') DEFAULT 'diajukan',
  `nilai` decimal(4,2) DEFAULT NULL,
  `catatan_penguji` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sidang`
--

CREATE TABLE `sidang` (
  `sidang_id` int(11) NOT NULL,
  `seminar_id` int(11) NOT NULL,
  `tanggal_sidang` datetime NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `status` enum('terjadwal','berlangsung','selesai') DEFAULT 'terjadwal',
  `nilai_akhir` decimal(4,2) DEFAULT NULL,
  `catatan_dewan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `topik`
--

CREATE TABLE `topik` (
  `topik_id` int(11) NOT NULL,
  `judul_topik` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `bidang_ilmu` varchar(100) DEFAULT NULL,
  `status` enum('tersedia','dipilih','selesai') DEFAULT 'tersedia',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `topik`
--

INSERT INTO `topik` (`topik_id`, `judul_topik`, `deskripsi`, `bidang_ilmu`, `status`, `created_by`, `created_at`) VALUES
(3, 'Analisis Sentimen Media Sosial Menggunakan Naive Bayes', 'Skripsi yang menganalisis sentimen dari Twitter dengan metode klasifikasi Naive Bayes', 'Data Mining', 'tersedia', 1, '2025-06-14 20:11:46'),
(4, 'Sistem Rekomendasi Buku Menggunakan Algoritma KNN', 'Topik membahas sistem rekomendasi berbasis konten dengan metode K-Nearest Neighbors', 'Sistem Informasi', 'tersedia', 1, '2025-06-14 20:11:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('dosen','mahasiswa','kaprodi','tim_peninjau') NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `nama_lengkap`, `foto_profil`, `is_active`, `created_at`, `updated_at`) VALUES
(16, 'B02220100', '$2y$10$7KJVq5B.tLcXatfTPI2csuYN8BsgLCvJSxwIy/zHQZSkNuB/zA8Mi', 'suksukran165@gmail.com', 'mahasiswa', 'Sukran Golit', NULL, 1, '2025-06-13 22:37:53', '2025-06-13 22:37:53'),
(18, 'B02220112', '$2y$10$gWKNRdrNtDTVgIloqQ6ShOoQpSqOkUVRKVRYlrmefAS2XJDNAERKG', 'shintazahirahayathunnufus@gmail.com', 'mahasiswa', 'Shinta Zahira Hayathun Nufus', NULL, 1, '2025-06-13 23:25:34', '2025-06-13 23:25:34'),
(21, '987654321', '$2y$10$8y60NqfYnwglXJEReX8pTOiDnjNBAQvjEIDCP8DwnYEZzjjLldeVa', 'pakzumhur123@gmail.com', 'dosen', 'Zumhur Alamin, M.Kom', NULL, 1, '2025-06-14 02:33:57', '2025-06-14 03:24:37'),
(22, '123456789', '$2y$10$cD8yg/5v24jHK5gnlX0eV.662bNxUFchSaq0f9VexkbdzFYFSv9jy', 'pakteguhanshor123@gmail.com', 'kaprodi', 'Teguh Anshor Lorosae, M.Kom', NULL, 1, '2025-06-14 02:41:48', '2025-06-14 02:41:48'),
(24, 'B02220097', '$2y$10$bdnA7XDpL.vCvTl4rCQKdOg/lLxcy3wBNcZl1xkPvS47CuPcxLDIC', 'rukmiati123@gmail.com', 'mahasiswa', 'Rukmiati', NULL, 1, '2025-06-14 04:21:50', '2025-06-14 04:21:50'),
(25, '0987654321', '$2y$10$p97th.CtVYsLAJ0/5Y85KOz0vURD0TSyCtAjCrqzn8Xg8bM789mE6', 'khairunnisa54@gmail.com', 'kaprodi', 'Khairunnisa', NULL, 1, '2025-06-14 05:10:02', '2025-06-14 05:10:02'),
(27, '255555555', '$2y$10$AArCdIxQ.mZ/zCjVSdoxnOjl8rrmit8V6Lz8hI9vNJBxRWe0drQRi', 'ssshintanufus@gmail.com', 'tim_peninjau', 'Zahira', NULL, 1, '2025-06-14 06:40:45', '2025-06-14 14:49:05'),
(28, 'B02220002', '$2y$10$SM42TL2feKmpwC.zVHn9i.2nwg0lh5w5905Wz/RE0xKQLanOQxFpK', 'udin435@gmail.com', 'mahasiswa', 'Udin', NULL, 1, '2025-06-14 21:03:57', '2025-06-14 21:03:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `yudisium`
--

CREATE TABLE `yudisium` (
  `yudisium_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `sidang_id` int(11) NOT NULL,
  `tanggal_yudisium` date NOT NULL,
  `ipk` decimal(3,2) NOT NULL,
  `predikat` varchar(20) NOT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`bimbingan_id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `topik_id` (`topik_id`),
  ADD KEY `bimbingan_ibfk_1` (`mahasiswa_id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`dosen_id`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`seminar_id`),
  ADD KEY `bimbingan_id` (`bimbingan_id`);

--
-- Indeks untuk tabel `sidang`
--
ALTER TABLE `sidang`
  ADD PRIMARY KEY (`sidang_id`),
  ADD KEY `seminar_id` (`seminar_id`);

--
-- Indeks untuk tabel `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`topik_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `yudisium`
--
ALTER TABLE `yudisium`
  ADD PRIMARY KEY (`yudisium_id`),
  ADD UNIQUE KEY `no_ijazah` (`no_ijazah`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `sidang_id` (`sidang_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `bimbingan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `dosen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `seminar`
--
ALTER TABLE `seminar`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sidang`
--
ALTER TABLE `sidang`
  MODIFY `sidang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `topik`
--
ALTER TABLE `topik`
  MODIFY `topik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `yudisium`
--
ALTER TABLE `yudisium`
  MODIFY `yudisium_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD CONSTRAINT `bimbingan_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`mahasiswa_id`),
  ADD CONSTRAINT `bimbingan_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`dosen_id`),
  ADD CONSTRAINT `bimbingan_ibfk_3` FOREIGN KEY (`topik_id`) REFERENCES `topik` (`topik_id`);

--
-- Ketidakleluasaan untuk tabel `seminar`
--
ALTER TABLE `seminar`
  ADD CONSTRAINT `seminar_ibfk_1` FOREIGN KEY (`bimbingan_id`) REFERENCES `bimbingan` (`bimbingan_id`);

--
-- Ketidakleluasaan untuk tabel `sidang`
--
ALTER TABLE `sidang`
  ADD CONSTRAINT `sidang_ibfk_1` FOREIGN KEY (`seminar_id`) REFERENCES `seminar` (`seminar_id`);

--
-- Ketidakleluasaan untuk tabel `topik`
--
ALTER TABLE `topik`
  ADD CONSTRAINT `topik_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `dosen` (`dosen_id`);

--
-- Ketidakleluasaan untuk tabel `yudisium`
--
ALTER TABLE `yudisium`
  ADD CONSTRAINT `yudisium_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`mahasiswa_id`),
  ADD CONSTRAINT `yudisium_ibfk_2` FOREIGN KEY (`sidang_id`) REFERENCES `sidang` (`sidang_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
