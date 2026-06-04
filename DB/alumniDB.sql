-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2026 at 11:20 AM
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
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa','alumni') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin Utama', 'admin@alumni.com', 'admin123', 'admin', '2026-05-29 13:27:49'),
(2, 'Budi Santaso Bobon', 'budi@gmail.com', 'budi123', 'alumni', '2026-05-29 13:27:49'),
(3, 'Citra Lestari', 'citra@gmail.com', 'citra123', 'alumni', '2026-05-29 13:27:49'),
(4, 'Dian Faradis', 'dian@gmail.com', 'dian123', 'alumni', '2026-05-29 13:27:49'),
(5, 'Raka', 'raka@gmail.com', 'raka123', 'mahasiswa', '2026-05-29 13:27:49'),
(6, 'Ahmad Fauzi', 'ahmad1@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(7, 'Budi Santoso', 'budi2@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(8, 'Citra Lestari', 'citra3@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(9, 'Dewi Anggraini', 'dewi4@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(10, 'Eko Prasetyo', 'eko5@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(11, 'Fajar Nugroho', 'fajar6@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(12, 'Gina Maharani', 'gina7@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(13, 'Hendra Wijaya', 'hendra8@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(14, 'Indah Permata', 'indah9@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(15, 'Joko Susilo', 'joko10@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(16, 'Kevin Jonathan', 'kevin11@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(17, 'Lina Marlina', 'lina12@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(18, 'Maya Sari', 'maya13@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(19, 'Nanda Saputra', 'nanda14@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(20, 'Oki Pramana', 'oki15@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(21, 'Putri Ayunda', 'putri16@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(22, 'Qori Aulia', 'qori17@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(23, 'Raka Pratama', 'raka18@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(24, 'Salsa Putri', 'salsa19@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(25, 'Teguh Saputra', 'teguh20@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(26, 'Umar Faruq', 'umar21@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(27, 'Vina Oktavia', 'vina22@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(28, 'Wahyu Hidayat', 'wahyu23@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(29, 'Xavier Jonathan', 'xavier24@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(30, 'Yoga Pratama', 'yoga25@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(31, 'Zahra Aulia', 'zahra26@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(32, 'Andi Wijaya', 'andi27@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(33, 'Bella Safitri', 'bella28@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(34, 'Cahyo Nugroho', 'cahyo29@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(35, 'Dimas Ramadhan', 'dimas30@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(36, 'Erika Putri', 'erika31@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(37, 'Farhan Akbar', 'farhan32@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(38, 'Galih Prasetyo', 'galih33@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(39, 'Hani Nurhaliza', 'hani34@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(40, 'Iqbal Ramadhan', 'iqbal35@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(41, 'Jihan Permata', 'jihan36@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(42, 'Kiki Amelia', 'kiki37@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(43, 'Lukman Hakim', 'lukman38@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(44, 'Miftahul Jannah', 'miftah39@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(45, 'Niko Saputra', 'niko40@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(46, 'Olivia Clarissa', 'olivia41@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(47, 'Pandu Wijaya', 'pandu42@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(48, 'Qisthi Rahma', 'qisthi43@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(49, 'Rizky Saputra', 'rizky44@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(50, 'Sint Maharani', 'sinta45@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(51, 'Taufik Hidayat', 'taufik46@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(52, 'Ulfa Nabila', 'ulfa47@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(53, 'Vicky Pratama', 'vicky48@gmail.com', '123', 'mahasiswa', '2026-06-01 14:13:47'),
(54, 'Wulan Sari', 'wulan49@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(55, 'Yusuf Maulana', 'yusuf50@gmail.com', '123', 'alumni', '2026-06-01 14:13:47'),
(56, 'pawas', 'pawas@gmail.com', '202cb962ac59075b964b07152d234b70', 'mahasiswa', '2026-06-03 14:50:41'),
(57, 'test', 'test@gmail.com', '123', 'mahasiswa', '2026-06-03 21:06:05'),
(58, 'lagi', 'lagi@gmail.com', '202cb962ac59075b964b07152d234b70', 'mahasiswa', '2026-06-03 21:13:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
