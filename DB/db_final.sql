-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2026 at 02:54 PM
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
-- Table structure for table `alumni_profiles`
--

CREATE TABLE `alumni_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `angkatan` int(4) DEFAULT NULL,
  `tahun_kelulusan` int(11) DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `perusahaan` varchar(100) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `bukti_kelulusan` varchar(255) DEFAULT NULL,
  `status_kelulusan` enum('pending','disetujui','ditolak') DEFAULT 'disetujui',
  `status_validasi` enum('pending','disetujui','ditolak') DEFAULT 'disetujui',
  `verification_status` enum('unverified','pending','verified') DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni_profiles`
--

INSERT INTO `alumni_profiles` (`id`, `user_id`, `angkatan`, `tahun_kelulusan`, `jurusan_id`, `pekerjaan`, `perusahaan`, `linkedin`, `instagram`, `bio`, `foto`, `bukti_kelulusan`, `status_kelulusan`, `status_validasi`, `verification_status`, `created_at`) VALUES
(1, 2, 2020, 2024, 1, 'Dua Tema', 'Dua Tema', '', '', 'Frontend developer dengan fokus React dan UI modern.', 'uploads/budi.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-05-29 13:27:49'),
(2, 3, 2021, 2025, 5, 'UI/UX Designer', 'Creative Studio Indonesia', 'https://linkedin.com/in/citralestari', 'https://instagram.com/citra.uiux', 'UI/UX Designer dengan pengalaman desain mobile app.', 'uploads/citra.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-05-29 13:27:49'),
(3, 4, 2026, 2030, 4, 'Perancangan Jaringan Listrik', 'Tech Solution Asia', 'https://linkedin.com/in/dianfaradis', 'https://instagram.com/dian.backend', 'Spesialiasi dalam pembuatan jaringan listrik pada kereta', 'uploads/dian.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-05-29 13:27:49'),
(10, 2, 2019, 2023, 1, 'Backend Developer', 'Tech Solution', 'linkedin.com/budi', 'instagram.com/budi', 'Backend engineer.', 'uploads/2.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:15:46'),
(11, 3, 2018, 2022, 1, 'Legal Staff', 'Firma Hukum Jaya', 'linkedin.com/citra', 'instagram.com/citra', 'Legal staff junior.', 'uploads/3.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:15:46'),
(12, 4, 2021, 2025, 1, 'Business Analyst', 'Global Tech', 'linkedin.com/dewi', 'instagram.com/dewi', 'Business analyst.', 'uploads/4.jpg', NULL, 'disetujui', 'disetujui', 'unverified', '2026-06-01 14:15:46'),
(13, 5, 2022, 2026, 9, 'UI/UX Designer', 'Creative Studio', 'linkedin.com/eko', 'instagram.com/eko', 'UI designer.', 'uploads/5.jpg', 'uploads/bukti/bukti_lulus_5_1780486871.jpg', 'disetujui', 'pending', 'verified', '2026-06-01 14:15:46'),
(14, 6, 2019, 2023, 1, 'Mobile Developer', 'Startup Maju', 'linkedin.com/fajar', 'instagram.com/fajar', 'Android developer.', 'uploads/6.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:15:46'),
(15, 7, 2018, 2022, 1, 'Data Analyst', 'Data Corp', 'linkedin.com/gina', 'instagram.com/gina', 'Data enthusiast.', 'uploads/7.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:15:46'),
(16, 8, 2021, 2025, 1, 'Paralegal', 'Legal Partner', 'linkedin.com/hendra', 'instagram.com/hendra', 'Paralegal junior.', 'uploads/8.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:15:46'),
(17, 9, 1008, 1012, 1, 'Marketing Staff', 'Creative Agency', 'linkedin.com/indah', 'instagram.com/indah', 'Marketing specialist.', 'uploads/9.jpg', 'uploads/bukti/bukti_lulus_9_1780486644.jpg', 'disetujui', 'pending', 'pending', '2026-06-01 14:15:46'),
(18, 10, 2019, 2023, 1, 'SEO Specialist', 'Media Creative', 'linkedin.com/joko', 'instagram.com/joko', 'SEO specialist.', 'uploads/10.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:15:46'),
(19, 11, 2020, 2024, 1, 'Frontend Developer', 'PT Teknologi Maju', 'linkedin.com/kevin', 'instagram.com/kevin', 'React developer.', 'uploads/11.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(20, 12, 2019, 2023, 1, 'System Analyst', 'Informatika Corp', 'linkedin.com/lina', 'instagram.com/lina', 'System analyst junior.', 'uploads/12.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(21, 13, 2022, 2026, 1, 'Legal Officer', 'Firma Legal', 'linkedin.com/maya', 'instagram.com/maya', 'Legal officer.', 'uploads/13.jpg', '1780487438_Screenshot 2024-03-24 015312.png', 'pending', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(22, 14, 2021, 2025, 1, 'Business Development', 'Startup Digital', 'linkedin.com/nanda', 'instagram.com/nanda', 'Business development.', 'uploads/14.jpg', NULL, 'disetujui', 'disetujui', 'unverified', '2026-06-01 14:21:27'),
(23, 15, 2020, 2024, 1, 'Digital Marketer', 'Creative Media', 'linkedin.com/oki', 'instagram.com/oki', 'Digital marketer.', 'uploads/15.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(24, 16, 2019, 2023, 1, 'Backend Developer', 'Data Solution', 'linkedin.com/putri', 'instagram.com/putri', 'Backend developer.', 'uploads/16.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(25, 17, 2018, 2022, 1, 'Data Scientist', 'AI Company', 'linkedin.com/qori', 'instagram.com/qori', 'Data scientist junior.', 'uploads/17.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(26, 18, 2021, 2025, 1, 'Corporate Legal', 'Corporate Law', 'linkedin.com/raka', 'instagram.com/raka', 'Corporate legal.', 'uploads/18.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(27, 19, 2020, 2024, 1, 'HR Staff', 'People Company', 'linkedin.com/salsa', 'instagram.com/salsa', 'Human resource staff.', 'uploads/19.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(28, 20, 2019, 2023, 1, 'Content Strategist', 'Creative Agency', 'linkedin.com/teguh', 'instagram.com/teguh', 'Content strategist.', 'uploads/20.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(29, 21, 2020, 2024, 2, 'Android Developer', 'Mobile Studio', 'linkedin.com/umar', 'instagram.com/umar', 'Android engineer.', 'uploads/21.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(30, 22, 2019, 2023, 1, 'UI Designer', 'Design Studio', 'linkedin.com/vina', 'instagram.com/vina', 'UI designer.', 'uploads/22.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(31, 23, 2018, 2022, 1, 'Legal Consultant', 'Justice Firm', 'linkedin.com/wahyu', 'instagram.com/wahyu', 'Legal consultant.', 'uploads/23.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(32, 24, 2021, 2025, 1, 'Entrepreneur', 'Startup Hub', 'linkedin.com/xavier', 'instagram.com/xavier', 'Entrepreneur muda.', 'uploads/24.jpg', NULL, 'disetujui', 'disetujui', 'unverified', '2026-06-01 14:21:27'),
(33, 25, 2020, 2024, 1, 'Social Media Specialist', 'Media Agency', 'linkedin.com/yoga', 'instagram.com/yoga', 'Social media specialist.', 'uploads/25.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(34, 26, 2019, 2023, 1, 'AI Engineer', 'AI Labs', 'linkedin.com/zahra', 'instagram.com/zahra', 'AI enthusiast.', 'uploads/26.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(35, 27, 2018, 2022, 1, 'Database Admin', 'Data Center', 'linkedin.com/andi', 'instagram.com/andi', 'Database administrator.', 'uploads/27.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(36, 28, 2021, 2025, 1, 'Legal Researcher', 'International Law', 'linkedin.com/bella', 'instagram.com/bella', 'Legal researcher.', 'uploads/28.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(37, 29, 2020, 2024, 1, 'Project Manager', 'Event Creative', 'linkedin.com/cahyo', 'instagram.com/cahyo', 'Project manager.', 'uploads/29.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(38, 30, 2019, 2023, 1, 'Ads Specialist', 'Ads Media', 'linkedin.com/dimas', 'instagram.com/dimas', 'Ads specialist.', 'uploads/30.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(39, 31, 2020, 2024, 1, 'Web Developer', 'Web Nusantara', 'linkedin.com/erika', 'instagram.com/erika', 'Web developer.', 'uploads/31.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(40, 32, 2019, 2023, 1, 'Business Analyst', 'Business Corp', 'linkedin.com/farhan', 'instagram.com/farhan', 'Business analyst.', 'uploads/32.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(41, 33, 2018, 2022, 1, 'Legal Staff', 'Law Office', 'linkedin.com/galih', 'instagram.com/galih', 'Legal staff.', 'uploads/33.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(42, 34, 2021, 2025, 1, 'Marketing Executive', 'Marketing Pro', 'linkedin.com/hani', 'instagram.com/hani', 'Marketing executive.', 'uploads/34.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(43, 35, 2020, 2024, 1, 'Graphic Designer', 'Creative Design', 'linkedin.com/iqbal', 'instagram.com/iqbal', 'Graphic designer.', 'uploads/35.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(44, 36, 2019, 2023, 1, 'Cloud Engineer', 'Cloud Tech', 'linkedin.com/jihan', 'instagram.com/jihan', 'Cloud engineer.', 'uploads/36.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(45, 37, 2018, 2022, 1, 'ERP Consultant', 'ERP Indonesia', 'linkedin.com/kiki', 'instagram.com/kiki', 'ERP consultant.', 'uploads/37.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(46, 38, 2021, 2025, 1, 'Corporate Lawyer', 'Corporate Firm', 'linkedin.com/lukman', 'instagram.com/lukman', 'Corporate lawyer.', 'uploads/38.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(47, 39, 2020, 2024, 1, 'Business Consultant', 'Consulting Group', 'linkedin.com/miftah', 'instagram.com/miftah', 'Business consultant.', 'uploads/39.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(48, 40, 2019, 2023, 1, 'Campaign Specialist', 'Campaign Media', 'linkedin.com/niko', 'instagram.com/niko', 'Campaign specialist.', 'uploads/40.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(49, 41, 2020, 2024, 1, 'Fullstack Developer', 'Fullstack Studio', 'linkedin.com/olivia', 'instagram.com/olivia', 'Fullstack developer.', 'uploads/41.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(50, 42, 2019, 2023, 1, 'QA Engineer', 'Testing Corp', 'linkedin.com/pandu', 'instagram.com/pandu', 'QA engineer.', 'uploads/42.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(51, 43, 2018, 2022, 1, 'Advocate Assistant', 'Law Consultant', 'linkedin.com/qisthi', 'instagram.com/qisthi', 'Advocate assistant.', 'uploads/43.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(52, 44, 2021, 2025, 1, 'Sales Executive', 'Sales Company', 'linkedin.com/rizky', 'instagram.com/rizky', 'Sales executive.', 'uploads/44.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(53, 45, 2020, 2024, 1, 'Content Creator Manager', 'Creative House', 'linkedin.com/sinta', 'instagram.com/sinta', 'Content manager.', 'uploads/45.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(54, 46, 2019, 2023, 1, 'Security Analyst', 'Cyber Tech', 'linkedin.com/taufik', 'instagram.com/taufik', 'Security analyst.', 'uploads/46.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(55, 47, 2018, 2022, 1, 'BI Analyst', 'Insight Corp', 'linkedin.com/ulfa', 'instagram.com/ulfa', 'BI analyst.', 'uploads/47.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(56, 48, 2021, 2025, 1, 'Legal Intern', 'Law Intern Group', 'linkedin.com/vicky', 'instagram.com/vicky', 'Legal intern.', 'uploads/48.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(57, 49, 2020, 2024, 1, 'Finance Staff', 'Finance Group', 'linkedin.com/wulan', 'instagram.com/wulan', 'Finance staff.', 'uploads/49.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:21:27'),
(58, 50, 2019, 2023, 1, 'Brand Specialist', 'Brand Media', 'linkedin.com/yusuf', 'instagram.com/yusuf', 'Brand specialist.', 'uploads/50.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:21:27'),
(59, 31, 2020, 2024, 1, 'Web Developer', 'Web Nusantara', 'linkedin.com/erika', 'instagram.com/erika', 'Web developer.', 'uploads/31.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(60, 32, 2019, 2023, 1, 'Business Analyst', 'Business Corp', 'linkedin.com/farhan', 'instagram.com/farhan', 'Business analyst.', 'uploads/32.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(61, 33, 2018, 2022, 1, 'Legal Staff', 'Law Office', 'linkedin.com/galih', 'instagram.com/galih', 'Legal staff.', 'uploads/33.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(62, 34, 2021, 2025, 1, 'Marketing Executive', 'Marketing Pro', 'linkedin.com/hani', 'instagram.com/hani', 'Marketing executive.', 'uploads/34.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(63, 35, 2020, 2024, 1, 'Graphic Designer', 'Creative Design', 'linkedin.com/iqbal', 'instagram.com/iqbal', 'Graphic designer.', 'uploads/35.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(64, 36, 2019, 2023, 1, 'Cloud Engineer', 'Cloud Tech', 'linkedin.com/jihan', 'instagram.com/jihan', 'Cloud engineer.', 'uploads/36.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(65, 37, 2018, 2022, 1, 'ERP Consultant', 'ERP Indonesia', 'linkedin.com/kiki', 'instagram.com/kiki', 'ERP consultant.', 'uploads/37.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(66, 38, 2021, 2025, 1, 'Corporate Lawyer', 'Corporate Firm', 'linkedin.com/lukman', 'instagram.com/lukman', 'Corporate lawyer.', 'uploads/38.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(67, 39, 2020, 2024, 1, 'Business Consultant', 'Consulting Group', 'linkedin.com/miftah', 'instagram.com/miftah', 'Business consultant.', 'uploads/39.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(68, 40, 2019, 2023, 1, 'Campaign Specialist', 'Campaign Media', 'linkedin.com/niko', 'instagram.com/niko', 'Campaign specialist.', 'uploads/40.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(69, 41, 2020, 2024, 1, 'Fullstack Developer', 'Fullstack Studio', 'linkedin.com/olivia', 'instagram.com/olivia', 'Fullstack developer.', 'uploads/41.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(70, 42, 2019, 2023, 1, 'QA Engineer', 'Testing Corp', 'linkedin.com/pandu', 'instagram.com/pandu', 'QA engineer.', 'uploads/42.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(71, 43, 2018, 2022, 1, 'Advocate Assistant', 'Law Consultant', 'linkedin.com/qisthi', 'instagram.com/qisthi', 'Advocate assistant.', 'uploads/43.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(72, 44, 2021, 2025, 1, 'Sales Executive', 'Sales Company', 'linkedin.com/rizky', 'instagram.com/rizky', 'Sales executive.', 'uploads/44.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(73, 45, 2020, 2024, 1, 'Content Creator Manager', 'Creative House', 'linkedin.com/sinta', 'instagram.com/sinta', 'Content manager.', 'uploads/45.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(74, 46, 2019, 2023, 1, 'Security Analyst', 'Cyber Tech', 'linkedin.com/taufik', 'instagram.com/taufik', 'Security analyst.', 'uploads/46.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(75, 47, 2018, 2022, 1, 'BI Analyst', 'Insight Corp', 'linkedin.com/ulfa', 'instagram.com/ulfa', 'BI analyst.', 'uploads/47.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(76, 48, 2021, 2025, 1, 'Legal Intern', 'Law Intern Group', 'linkedin.com/vicky', 'instagram.com/vicky', 'Legal intern.', 'uploads/48.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(77, 49, 2020, 2024, 1, 'Finance Staff', 'Finance Group', 'linkedin.com/wulan', 'instagram.com/wulan', 'Finance staff.', 'uploads/49.jpg', NULL, 'disetujui', 'disetujui', 'verified', '2026-06-01 14:22:19'),
(78, 50, 2019, 2023, 1, 'Brand Specialist', 'Brand Media', 'linkedin.com/yusuf', 'instagram.com/yusuf', 'Brand specialist.', 'uploads/50.jpg', NULL, 'disetujui', 'disetujui', 'pending', '2026-06-01 14:22:19'),
(79, 57, 2020, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', 'disetujui', 'unverified', '2026-06-03 21:06:05'),
(80, 58, 2021, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disetujui', 'disetujui', 'unverified', '2026-06-03 21:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama_fakultas`, `created_at`) VALUES
(1, 'Fakultas Ilmu Komputer', '2026-06-03 17:40:17'),
(2, 'Fakultas Teknik', '2026-06-03 17:40:17'),
(3, 'Fakultas Ekonomi dan Bisnis', '2026-06-03 17:40:17'),
(4, 'Fakultas Hukum', '2026-06-03 17:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `fakultas_id`, `nama_jurusan`, `created_at`) VALUES
(1, 1, 'Teknik Informatika', '2026-06-03 17:40:42'),
(2, 1, 'Sistem Informasi', '2026-06-03 17:40:42'),
(3, 1, 'Ilmu Komputer', '2026-06-03 17:40:42'),
(4, 2, 'Teknik Elektro', '2026-06-03 17:40:42'),
(5, 2, 'Teknik Mesin', '2026-06-03 17:40:42'),
(6, 2, 'Teknik Industri', '2026-06-03 17:40:42'),
(7, 3, 'Manajemen', '2026-06-03 17:40:42'),
(8, 3, 'Akuntansi', '2026-06-03 17:40:42'),
(9, 4, 'Ilmu Hukum', '2026-06-03 17:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `update_requests`
--

CREATE TABLE `update_requests` (
  `id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `pekerjaan_baru` varchar(100) DEFAULT NULL,
  `perusahaan_baru` varchar(100) DEFAULT NULL,
  `linkedin_baru` varchar(255) DEFAULT NULL,
  `instagram_baru` varchar(255) DEFAULT NULL,
  `bukti_file` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `update_requests`
--

INSERT INTO `update_requests` (`id`, `alumni_id`, `pekerjaan_baru`, `perusahaan_baru`, `linkedin_baru`, `instagram_baru`, `bukti_file`, `status`, `admin_notes`, `created_at`) VALUES
(1, 1, 'Senior Frontend Developer', 'PT Inovasi Digital', 'https://linkedin.com/in/budisantoso', 'https://instagram.com/budi.dev', 'uploads/bukti_budi.pdf', 'rejected', 'Pengajuan ditolak karena bukti berkas tidak valid', '2026-05-29 13:27:49'),
(2, 2, 'Lead UI/UX Designer', 'Creative Labs Asia', 'https://linkedin.com/in/citralestari', 'https://instagram.com/citra.uiux', 'uploads/bukti_citra.pdf', 'approved', 'Data sudah diverifikasi', '2026-05-29 13:27:49'),
(3, 1, 'Dua Tema', 'Dua Tema', '', '', 'bukti_1_1780480443.pdf', 'approved', 'Data telah divalidasi oleh admin', '2026-06-03 09:54:03');

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
-- Indexes for table `alumni_profiles`
--
ALTER TABLE `alumni_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_alumni_jurusan` (`jurusan_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_fakultas` (`nama_fakultas`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jurusan_fakultas` (`fakultas_id`);

--
-- Indexes for table `update_requests`
--
ALTER TABLE `update_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumni_id` (`alumni_id`);

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
-- AUTO_INCREMENT for table `alumni_profiles`
--
ALTER TABLE `alumni_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `update_requests`
--
ALTER TABLE `update_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni_profiles`
--
ALTER TABLE `alumni_profiles`
  ADD CONSTRAINT `alumni_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_alumni_jurusan` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `fk_jurusan_fakultas` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `update_requests`
--
ALTER TABLE `update_requests`
  ADD CONSTRAINT `update_requests_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni_profiles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
