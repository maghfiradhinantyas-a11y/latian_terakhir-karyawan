-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 01:29 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_karyawan_fira`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `performa_nilai` int DEFAULT NULL,
  `gaji_dasar` decimal(12,2) NOT NULL,
  `status_karyawan` enum('Tetap','Kontrak','Magang') NOT NULL,
  `tunjangan_jabatan` decimal(12,2) DEFAULT NULL,
  `bonus_tahunan` decimal(12,2) DEFAULT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `nama_proyek` varchar(100) DEFAULT NULL,
  `insentif_magang` decimal(12,2) DEFAULT NULL,
  `asal_kampus` varchar(100) DEFAULT NULL
) ;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `tanggal_masuk`, `performa_nilai`, `gaji_dasar`, `status_karyawan`, `tunjangan_jabatan`, `bonus_tahunan`, `durasi_kontrak_bulan`, `nama_proyek`, `insentif_magang`, `asal_kampus`) VALUES
('EMP-001', 'Andi Pratama', '2020-01-15', 88, 8500000.00, 'Tetap', 2000000.00, 15000000.00, NULL, NULL, NULL, NULL),
('EMP-002', 'Budi Santoso', '2019-03-22', 92, 9500000.00, 'Tetap', 2500000.00, 18000000.00, NULL, NULL, NULL, NULL),
('EMP-003', 'Citra Lestari', '2021-06-10', 85, 7500000.00, 'Tetap', 1500000.00, 12000000.00, NULL, NULL, NULL, NULL),
('EMP-004', 'Dewi Rahmawati', '2018-11-01', 95, 12000000.00, 'Tetap', 4000000.00, 25000000.00, NULL, NULL, NULL, NULL),
('EMP-005', 'Eko Prasetyo', '2022-02-14', 80, 7000000.00, 'Tetap', 1200000.00, 10000000.00, NULL, NULL, NULL, NULL),
('EMP-006', 'Fitri Handayani', '2020-08-19', 87, 8200000.00, 'Tetap', 1800000.00, 14000000.00, NULL, NULL, NULL, NULL),
('EMP-007', 'Gilang Permana', '2021-12-05', 83, 7800000.00, 'Tetap', 1500000.00, 12500000.00, NULL, NULL, NULL, NULL),
('EMP-008', 'Hendra Wijaya', '2024-01-10', 78, 6000000.00, 'Kontrak', NULL, NULL, 12, 'Migrasi Cloud AWS', NULL, NULL),
('EMP-009', 'Indah Permatasari', '2024-05-20', 84, 6500000.00, 'Kontrak', NULL, NULL, 6, 'Revamp Mobile App', NULL, NULL),
('EMP-010', 'Joko Susilo', '2023-09-15', 81, 5800000.00, 'Kontrak', NULL, NULL, 12, 'Sistem ERP Fase 2', NULL, NULL),
('EMP-011', 'Kartika Putri', '2024-03-01', 89, 7000000.00, 'Kontrak', NULL, NULL, 24, 'Keamanan Siber Migrasi', NULL, NULL),
('EMP-012', 'Lukman Hakim', '2024-07-11', 75, 5500000.00, 'Kontrak', NULL, NULL, 6, 'Audit Data Center', NULL, NULL),
('EMP-013', 'Mega Utami', '2023-11-25', 83, 6200000.00, 'Kontrak', NULL, NULL, 12, 'Otomasi Pabrik', NULL, NULL),
('EMP-014', 'Naufal Abdi', '2024-02-18', 80, 6000000.00, 'Kontrak', NULL, NULL, 12, 'Integrasi API Payment', NULL, NULL),
('EMP-015', 'Oki Setiawan', '2025-01-05', 90, 0.00, 'Magang', NULL, NULL, NULL, NULL, 2500000.00, 'Universitas Indonesia'),
('EMP-016', 'Putri Ayu', '2025-02-01', 85, 0.00, 'Magang', NULL, NULL, NULL, NULL, 2500000.00, 'Institut Teknologi Bandung'),
('EMP-017', 'Rian Hidayat', '2025-01-15', 79, 0.00, 'Magang', NULL, NULL, NULL, NULL, 2200000.00, 'Universitas Gadjah Mada'),
('EMP-018', 'Siti Aminah', '2025-03-10', 88, 0.00, 'Magang', NULL, NULL, NULL, NULL, 2500000.00, 'Universitas Padjadjaran'),
('EMP-019', 'Taufik Hidayat', '2025-02-20', 82, 0.00, 'Magang', NULL, NULL, NULL, NULL, 2200000.00, 'Universitas Diponegoro'),
('EMP-020', 'Wulan Dari', '2025-04-01', 86, 0.00, 'Magang', NULL, NULL, NULL, NULL, 2500000.00, 'Universitas Brawijaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
