-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 04:44 AM
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
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(3) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'hanis@email.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_id` int(4) NOT NULL,
  `patient_ic` varchar(20) NOT NULL,
  `patient_email` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_phone` varchar(20) NOT NULL,
  `patient_address` varchar(250) NOT NULL,
  `patient_date_reg` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `patient_ic`, `patient_email`, `patient_name`, `patient_phone`, `patient_address`, `patient_date_reg`) VALUES
(1, '750101-12-1244', 'slumberjer@gmail.com ', 'Ahmad Hanis Mohd Shabli', '0194702493', 'No 597, Jalan Teja 21\r\nTaman Teja Fasa 2', '2024-05-08 09:19:59.885416'),
(2, '957101-11-1234', 'ali@email.com ', 'Ali bin Abu', '0594949323', 'Jalan A\r\nTaman B', '2024-05-08 09:22:43.566614'),
(3, '950101-12-1234', 'john_doe@example.com', 'John Doe', '0123456789', '123 Jalan Malaysia, Kuala Lumpur', '2024-05-08 09:42:23.487631'),
(4, '980202-08-2345', 'jane_smith@example.com', 'Jane Smith', '0198765432', '456 Jalan Malaysia, Petaling Jaya', '2024-05-08 09:42:23.487631'),
(5, '970303-06-3456', 'ahmad_ali@example.com', 'Ahmad Ali', '0161234567', '789 Jalan Malaysia, Penang', '2024-05-08 09:42:23.487631'),
(6, '940404-10-4567', 'siti_rahmah@example.com', 'Siti Rahmah', '0112345678', '101 Jalan Malaysia, Johor Bahru', '2024-05-08 09:42:23.487631'),
(7, '990505-04-5678', 'mohd_hanif@example.com', 'Mohd Hanif', '0139876543', '202 Jalan Malaysia, Shah Alam', '2024-05-08 09:42:23.487631'),
(8, '960606-02-6789', 'linda_tan@example.com', 'Linda Tan', '0173456789', '303 Jalan Malaysia, Subang Jaya', '2024-05-08 09:42:23.487631'),
(9, '920707-09-7890', 'muhammad_ismail@example.com', 'Muhammad Ismail', '0146789123', '404 Jalan Malaysia, Kuching', '2024-05-08 09:42:23.487631'),
(10, '930808-07-8901', 'nurul_azizah@example.com', 'Nurul Azizah', '0158912345', '505 Jalan Malaysia, Kota Kinabalu', '2024-05-08 09:42:23.487631'),
(11, '910909-05-9012', 'cheng_yong@example.com', 'Cheng Yong', '0184567890', '606 Jalan Malaysia, Melaka', '2024-05-08 09:42:23.487631'),
(12, '000101-03-1234', 'mei_ling@example.com', 'Mei Ling', '0101234567', '707 Jalan Malaysia, Ipoh', '2024-05-08 09:42:23.487631'),
(13, '001212-04-2345', 'abdul_rahman@example.com', 'Abdul Rahman', '0123456789', '808 Jalan Malaysia, Seremban', '2024-05-08 09:42:23.487631'),
(14, '002323-06-3456', 'siew_ping@example.com', 'Siew Ping', '0112345678', '909 Jalan Malaysia, Alor Setar', '2024-05-08 09:42:23.487631'),
(15, '003434-05-4567', 'lee_seng@example.com', 'Lee Seng', '0198765432', '1010 Jalan Malaysia, Taiping', '2024-05-08 09:42:23.487631'),
(16, '004545-01-5678', 'tan_wan@example.com', 'Tan Wan', '0161234567', '1111 Jalan Malaysia, Putrajaya', '2024-05-08 09:42:23.487631'),
(17, '005656-02-6789', 'jennifer_khoo@example.com', 'Jennifer Khoo', '0139876543', '1212 Jalan Malaysia, Cyberjaya', '2024-05-08 09:42:23.487631'),
(18, '006767-07-7890', 'raja_gopal@example.com', 'Raja Gopal', '0173456789', '1313 Jalan Malaysia, Batu Pahat', '2024-05-08 09:42:23.487631'),
(19, '007878-08-8901', 'arun_silva@example.com', 'Arun Silva', '0146789123', '1414 Jalan Malaysia, Sungai Petani', '2024-05-08 09:42:23.487631'),
(20, '008989-09-9012', 'kavitha_rao@example.com', 'Kavitha Rao', '0158912345', '1515 Jalan Malaysia, Kulim', '2024-05-08 09:42:23.487631'),
(21, '009090-10-0123', 'muhammad_hassan@example.com', 'Muhammad Hassan', '0184567890', '1616 Jalan Malaysia, Muar', '2024-05-08 09:42:23.487631'),
(22, '011111-11-1234', 'vicky_liew@example.com', 'Vicky Liew', '0101234567', '1717 Jalan Malaysia, Bintulu', '2024-05-08 09:42:23.487631');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
