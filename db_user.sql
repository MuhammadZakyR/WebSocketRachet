-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Mar 2022 pada 07.24
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
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chatroom`
--

CREATE TABLE `tb_chatroom` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `msg` varchar(300) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_chatroom`
--

INSERT INTO `tb_chatroom` (`id`, `userid`, `msg`, `created_on`) VALUES
(1, 8, 'Selamat Sore zaky', '2022-03-07 10:19:50'),
(2, 10, 'Sore juga Admin', '2022-03-07 10:19:57'),
(3, 8, 'Sore Zaky', '2022-03-07 10:34:34'),
(4, 10, 'Sore juga Admin', '2022-03-07 10:34:35'),
(5, 8, 'Sore Zaky', '2022-03-07 10:35:36'),
(6, 10, 'Sore juga Admin', '2022-03-07 10:35:38'),
(7, 8, 'Halo Gan', '2022-03-07 10:37:10'),
(8, 10, 'Nape Bro?', '2022-03-07 10:37:23'),
(9, 8, 'Halo Gan', '2022-03-07 10:41:34'),
(10, 10, 'Nape Bro?', '2022-03-07 10:41:37'),
(11, 8, 'Hallo Ngabs', '2022-03-07 10:52:12'),
(12, 10, 'Nape Bro?', '2022-03-07 10:52:20'),
(13, 8, 'Pagi Zaky', '2022-03-08 04:24:26'),
(14, 10, 'Pagi juga Min', '2022-03-08 04:24:37'),
(15, 8, 'Kau di Kantor kah?', '2022-03-08 05:04:27'),
(16, 10, 'Iya nih', '2022-03-08 05:04:38'),
(17, 8, 'Gimana kemarin tasknya? dah selesai?', '2022-03-08 05:06:10'),
(18, 10, 'Aman, udah kelar', '2022-03-08 05:08:25'),
(19, 8, 'Okee Mantap', '2022-03-08 05:15:07'),
(20, 10, 'Yoi', '2022-03-08 05:15:17'),
(21, 8, 'test', '2022-03-08 07:25:23'),
(22, 10, 'masuk', '2022-03-08 07:31:31'),
(23, 8, 'oke', '2022-03-08 07:32:16'),
(24, 10, 'sip', '2022-03-08 07:32:29'),
(25, 8, 'wkwkwk', '2022-03-08 07:33:14'),
(26, 10, 'wkwkwk', '2022-03-08 07:34:21'),
(27, 8, 'okee', '2022-03-08 07:34:39'),
(28, 10, 'done', '2022-03-08 07:42:59'),
(29, 10, 'p', '2022-03-08 08:07:59'),
(30, 8, 'halo gan', '2022-03-08 09:50:46'),
(31, 9, 'ya Halo', '2022-03-08 09:50:55'),
(32, 8, 'test', '2022-03-09 05:09:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_userwebsocket`
--

CREATE TABLE `tb_userwebsocket` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login_status` tinyint(4) NOT NULL DEFAULT 0,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_userwebsocket`
--

INSERT INTO `tb_userwebsocket` (`id`, `username`, `email`, `login_status`, `last_login`) VALUES
(8, 'admin', 'admin@gmail.com', 1, '2022-03-09 11:51:30'),
(9, 'Zaky', 'zaky12@gmail.com', 1, '2022-03-08 03:50:37'),
(10, 'zaky', 'zaky@gmail.com', 0, '2022-03-08 09:07:00'),
(11, 'Zaky', '', 0, '2022-03-09 04:32:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_chatroom`
--
ALTER TABLE `tb_chatroom`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_userwebsocket`
--
ALTER TABLE `tb_userwebsocket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_chatroom`
--
ALTER TABLE `tb_chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_userwebsocket`
--
ALTER TABLE `tb_userwebsocket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
