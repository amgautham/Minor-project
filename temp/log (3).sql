-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 09:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `log`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `rollno` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `rollno`, `name`, `periods_attended`, `attendance_date`) VALUES
(8, '002', 'Jane Smith', 1, '2024-02-20'),
(9, '004', 'Emily Wilson', 1, '2024-02-20'),
(10, '005', 'Christopher Brown', 1, '2024-02-20'),
(11, '002', 'Jane Smith', 2, '2024-02-19'),
(12, '003', 'Michael Johnson', 2, '2024-02-19'),
(13, '004', 'Emily Wilson', 2, '2024-02-19'),
(14, '005', 'Christopher Brown', 2, '2024-02-19'),
(15, '002', 'Jane Smith', 2, '2024-02-19'),
(16, '003', 'Michael Johnson', 2, '2024-02-19'),
(17, '004', 'Emily Wilson', 2, '2024-02-19'),
(18, '005', 'Christopher Brown', 2, '2024-02-19'),
(19, '002', 'Jane Smith', 2, '2024-02-19'),
(20, '003', 'Michael Johnson', 2, '2024-02-19'),
(21, '004', 'Emily Wilson', 2, '2024-02-19'),
(22, '005', 'Christopher Brown', 2, '2024-02-19'),
(23, '002', 'Jane Smith', 1, '2024-02-19'),
(24, '004', 'Emily Wilson', 1, '2024-02-19'),
(25, '005', 'Christopher Brown', 1, '2024-02-19'),
(26, '002', 'Jane Smith', 1, '2024-02-19'),
(27, '004', 'Emily Wilson', 1, '2024-02-19'),
(28, '005', 'Christopher Brown', 1, '2024-02-19'),
(29, '002', 'Jane Smith', 2, '2024-02-19'),
(30, '003', 'Michael Johnson', 2, '2024-02-19'),
(31, '004', 'Emily Wilson', 2, '2024-02-19'),
(32, '005', 'Christopher Brown', 2, '2024-02-19'),
(33, '002', 'Jane Smith', 1, '2024-02-20'),
(34, '003', 'Michael Johnson', 1, '2024-02-20'),
(35, '004', 'Emily Wilson', 1, '2024-02-20'),
(36, '005', 'Christopher Brown', 1, '2024-02-20'),
(37, '002', 'Jane Smith', 1, '2024-02-20'),
(38, '003', 'Michael Johnson', 1, '2024-02-20'),
(39, '004', 'Emily Wilson', 1, '2024-02-20'),
(40, '005', 'Christopher Brown', 1, '2024-02-20'),
(41, '002', 'Jane Smith', 3, '2024-02-23'),
(42, '003', 'Michael Johnson', 3, '2024-02-23'),
(43, '004', 'Emily Wilson', 2, '2024-02-23'),
(44, '005', 'Christopher Brown', 3, '2024-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `cloud_computing_attendance`
--

CREATE TABLE `cloud_computing_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `computer_aided_design_and_manufacturing_attendance`
--

CREATE TABLE `computer_aided_design_and_manufacturing_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `concepts_of_iot_attendance`
--

CREATE TABLE `concepts_of_iot_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contemporary_electronics_attendance`
--

CREATE TABLE `contemporary_electronics_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disaster_management_ce_attendance`
--

CREATE TABLE `disaster_management_ce_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electric_vehicles_traction_attendance`
--

CREATE TABLE `electric_vehicles_traction_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electrification_of_residential_buildings_attendance`
--

CREATE TABLE `electrification_of_residential_buildings_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `energy_conservation_management_attendance`
--

CREATE TABLE `energy_conservation_management_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fundamentals_of_web_technology_attendance`
--

CREATE TABLE `fundamentals_of_web_technology_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fundamentals_of_web_technology_attendance`
--

INSERT INTO `fundamentals_of_web_technology_attendance` (`id`, `rollno`, `name`, `periods_attended`, `attendance_date`) VALUES
(1, 2, 'Jane Smith', 3, '2024-03-22'),
(2, 3, 'Michael Johnson', 3, '2024-03-22'),
(3, 4, 'Emily Wilson', 2, '2024-03-22'),
(4, 5, 'Christopher Brown', 3, '2024-03-22'),
(5, 7, 'Matthew Taylor', 3, '2024-03-22'),
(6, 9, 'Daniel Anderson', 2, '2024-03-22'),
(7, 12, 'Emma Rodriguez', 3, '2024-03-22'),
(8, 14, 'Olivia Garcia', 3, '2024-03-22'),
(9, 17, 'Logan Wilson', 3, '2024-03-22'),
(10, 19, 'Ethan Moore', 3, '2024-03-22'),
(11, 22, 'Mia Thomas', 3, '2024-03-22'),
(12, 24, 'Harper White', 3, '2024-03-22'),
(13, 27, 'Benjamin Young', 3, '2024-03-22'),
(14, 29, 'William Lewis', 3, '2024-03-22'),
(15, 32, 'Scarlett Brown', 3, '2024-03-22'),
(16, 34, 'Aria Perez', 3, '2024-03-22'),
(17, 37, 'Leo Walker', 3, '2024-03-22'),
(18, 39, 'Jackson Adams', 3, '2024-03-22'),
(19, 42, 'Zoe Nelson', 3, '2024-03-22'),
(20, 44, 'Madison Cook', 2, '2024-03-22'),
(21, 47, 'Ethan Stewart', 2, '2024-03-22'),
(22, 49, 'Ella Cooper', 3, '2024-03-22'),
(23, 2, 'Jane Smith', 1, '2024-03-06'),
(24, 3, 'Michael Johnson', 1, '2024-03-06'),
(25, 2, 'Jane Smith', 1, '2024-03-12'),
(26, 3, 'Michael Johnson', 1, '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `introduction_to_hybrid_and_electric_vehicles_attendance`
--

CREATE TABLE `introduction_to_hybrid_and_electric_vehicles_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `introduction_to_iot_attendance`
--

CREATE TABLE `introduction_to_iot_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `introduction_to_multimedia_attendance`
--

CREATE TABLE `introduction_to_multimedia_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multimedia_attendance`
--

CREATE TABLE `multimedia_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operation_research_attendance`
--

CREATE TABLE `operation_research_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_design_attendance`
--

CREATE TABLE `product_design_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renewable_energy_and_environment_attendance`
--

CREATE TABLE `renewable_energy_and_environment_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renewable_energy_technologies_attendance`
--

CREATE TABLE `renewable_energy_technologies_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rural_technology_attendance`
--

CREATE TABLE `rural_technology_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solar_power_technologies_attendance`
--

CREATE TABLE `solar_power_technologies_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `rollno` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `open_elective` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `rollno`, `name`, `branch`, `open_elective`) VALUES
(1, '001', 'John Doe', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(2, '002', 'Jane Smith', 'Civil Engineering(CE)', 'Fundamentals of Web Technology'),
(3, '003', 'Michael Johnson', 'Mechanical Engineering(ME)', 'Fundamentals of Web Technology'),
(4, '004', 'Emily Wilson', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(5, '005', 'Christopher Brown', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(6, '006', 'Sarah Lee', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(7, '007', 'Matthew Taylor', 'Civil Engineering(CE)', 'Introduction to IoT'),
(8, '008', 'Olivia Martinez', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(9, '009', 'Daniel Anderson', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(10, '010', 'Ava Garcia', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(11, '011', 'Liam Brown', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(12, '012', 'Emma Rodriguez', 'Civil Engineering(CE)', 'Introduction to IoT'),
(13, '013', 'Noah Wilson', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(14, '014', 'Olivia Garcia', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(15, '015', 'Mason Martinez', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(16, '016', 'Sophia Hernandez', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(17, '017', 'Logan Wilson', 'Civil Engineering(CE)', 'Introduction to IoT'),
(18, '018', 'Amelia Lee', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(19, '019', 'Ethan Moore', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(20, '020', 'Isabella Anderson', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(21, '021', 'Lucas Taylor', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(22, '022', 'Mia Thomas', 'Civil Engineering(CE)', 'Introduction to IoT'),
(23, '023', 'Liam Jackson', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(24, '024', 'Harper White', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(25, '025', 'Alexander Martinez', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(26, '026', 'Evelyn Harris', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(27, '027', 'Benjamin Young', 'Civil Engineering(CE)', 'Introduction to IoT'),
(28, '028', 'Avery King', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(29, '029', 'William Lewis', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(30, '030', 'Sofia Davis', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(31, '031', 'Henry Wright', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(32, '032', 'Scarlett Brown', 'Civil Engineering(CE)', 'Introduction to IoT'),
(33, '033', 'Sebastian Moore', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(34, '034', 'Aria Perez', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(35, '035', 'Gabriel Gonzalez', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(36, '036', 'Luna Rivera', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(37, '037', 'Leo Walker', 'Civil Engineering(CE)', 'Introduction to IoT'),
(38, '038', 'Stella Hill', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(39, '039', 'Jackson Adams', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(40, '040', 'Victoria Baker', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(41, '041', 'Nathan Mitchell', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(42, '042', 'Zoe Nelson', 'Civil Engineering(CE)', 'Introduction to IoT'),
(43, '043', 'David Perez', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(44, '044', 'Madison Cook', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(45, '045', 'Liam Sanchez', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(46, '046', 'Hannah Turner', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(47, '047', 'Ethan Stewart', 'Civil Engineering(CE)', 'Introduction to IoT'),
(48, '048', 'Brooklyn Morris', 'Mechanical Engineering(ME)', 'Renewable Energy and Environment'),
(49, '049', 'Ella Cooper', 'Electrical & Electronics Engineering(EEE)', 'Renewable Energy and Environment'),
(50, '050', 'Andrew Ward', 'Electronics Engineering(EE)', 'Renewable Energy and Environment'),
(51, '45', 'James Cameroon', 'Computer Engineering(CT)', 'Renewable Energy and Environment'),
(52, '69', 'Not Nabeel', 'Computer Engineering(CT)', 'Renewable Energy and Environment');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `branch`, `subject`, `table_name`) VALUES
(1, 'Civil Engineering(CE)', 'Renewable Energy and Environment', 'renewable_energy_and_environment_attendance'),
(2, 'Civil Engineering(CE)', 'Sustainable Development', 'sustainable_development_attendance'),
(3, 'Civil Engineering(CE)', 'Disaster Management', 'disaster_management_attendance'),
(4, 'Civil Engineering(CE)', 'Rural Technology', 'rural_technology_attendance'),
(5, 'Computer Engineering(CT)', 'Introduction to IoT', 'introduction_to_iot_attendance'),
(6, 'Computer Engineering(CT)', 'Fundamentals of Web Technology', 'fundamentals_of_web_technology_attendance'),
(7, 'Computer Engineering(CT)', 'Multimedia', 'multimedia_attendance'),
(8, 'Computer Engineering(CT)', 'Cloud Computing', 'cloud_computing_attendance'),
(9, 'Mechanical Engineering(ME)', 'Computer Aided Design and Manufacturing', 'computer_aided_design_and_manufacturing_attendance'),
(10, 'Mechanical Engineering(ME)', 'Operation Research', 'operation_research_attendance'),
(11, 'Mechanical Engineering(ME)', 'Renewable Energy Technologies', 'renewable_energy_technologies_attendance'),
(12, 'Mechanical Engineering(ME)', 'Product Design', 'product_design_attendance'),
(13, 'Electrical & Electronics Engineering(EEE)', 'Solar Power Technologies', 'solar_power_technologies_attendance'),
(14, 'Electrical & Electronics Engineering(EEE)', 'Energy Conservation & Management', 'energy_conservation_management_attendance'),
(15, 'Electrical & Electronics Engineering(EEE)', 'Electrification of Residential Buildings', 'electrification_of_residential_buildings_attendance'),
(16, 'Electrical & Electronics Engineering(EEE)', 'Electric Vehicles & Traction', 'electric_vehicles_traction_attendance'),
(17, 'Electronics Engineering(EE)', 'Concepts of IoT', 'concepts_of_iot_attendance'),
(18, 'Electronics Engineering(EE)', 'Contemporary Electronics', 'contemporary_electronics_attendance'),
(19, 'Electronics Engineering(EE)', 'Introduction to Hybrid and Electric Vehicles', 'introduction_to_hybrid_and_electric_vehicles_attendance'),
(20, 'Electronics Engineering(EE)', 'Introduction to Multimedia', 'introduction_to_multimedia_attendance');

-- --------------------------------------------------------

--
-- Table structure for table `sustainable_development_attendance`
--

CREATE TABLE `sustainable_development_attendance` (
  `id` int(11) NOT NULL,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `periods_attended` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `total_periods_tracker`
--

CREATE TABLE `total_periods_tracker` (
  `subject` varchar(255) NOT NULL,
  `total_periods` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_periods_tracker`
--

INSERT INTO `total_periods_tracker` (`subject`, `total_periods`, `date`) VALUES
('Fundamentals of Web Technology', 3, '2024-03-22'),
('Fundamentals of Web Technology', 1, '2024-03-06'),
('Fundamentals of Web Technology', 1, '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `subject`, `user_type`) VALUES
(1, 'jibinesh', '$2y$10$aWclcpz88BMsIAwF/LpL7OIt2JLvqvGYJmhFj6UG.bTJ4Q/EqHHzi', 'Fundamentals of Web Technology', NULL),
(2, 'admin', '$2y$10$XFvDIhL5XHyWb/tDFB1lT.OZATzASU6SYdwcLztvz.JdVW4d2Bl62', '', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cloud_computing_attendance`
--
ALTER TABLE `cloud_computing_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `computer_aided_design_and_manufacturing_attendance`
--
ALTER TABLE `computer_aided_design_and_manufacturing_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concepts_of_iot_attendance`
--
ALTER TABLE `concepts_of_iot_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contemporary_electronics_attendance`
--
ALTER TABLE `contemporary_electronics_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disaster_management_ce_attendance`
--
ALTER TABLE `disaster_management_ce_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electric_vehicles_traction_attendance`
--
ALTER TABLE `electric_vehicles_traction_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electrification_of_residential_buildings_attendance`
--
ALTER TABLE `electrification_of_residential_buildings_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `energy_conservation_management_attendance`
--
ALTER TABLE `energy_conservation_management_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fundamentals_of_web_technology_attendance`
--
ALTER TABLE `fundamentals_of_web_technology_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `introduction_to_hybrid_and_electric_vehicles_attendance`
--
ALTER TABLE `introduction_to_hybrid_and_electric_vehicles_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `introduction_to_iot_attendance`
--
ALTER TABLE `introduction_to_iot_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `introduction_to_multimedia_attendance`
--
ALTER TABLE `introduction_to_multimedia_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multimedia_attendance`
--
ALTER TABLE `multimedia_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation_research_attendance`
--
ALTER TABLE `operation_research_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_design_attendance`
--
ALTER TABLE `product_design_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renewable_energy_and_environment_attendance`
--
ALTER TABLE `renewable_energy_and_environment_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renewable_energy_technologies_attendance`
--
ALTER TABLE `renewable_energy_technologies_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rural_technology_attendance`
--
ALTER TABLE `rural_technology_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solar_power_technologies_attendance`
--
ALTER TABLE `solar_power_technologies_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sustainable_development_attendance`
--
ALTER TABLE `sustainable_development_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cloud_computing_attendance`
--
ALTER TABLE `cloud_computing_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `computer_aided_design_and_manufacturing_attendance`
--
ALTER TABLE `computer_aided_design_and_manufacturing_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `concepts_of_iot_attendance`
--
ALTER TABLE `concepts_of_iot_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contemporary_electronics_attendance`
--
ALTER TABLE `contemporary_electronics_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disaster_management_ce_attendance`
--
ALTER TABLE `disaster_management_ce_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electric_vehicles_traction_attendance`
--
ALTER TABLE `electric_vehicles_traction_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electrification_of_residential_buildings_attendance`
--
ALTER TABLE `electrification_of_residential_buildings_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `energy_conservation_management_attendance`
--
ALTER TABLE `energy_conservation_management_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fundamentals_of_web_technology_attendance`
--
ALTER TABLE `fundamentals_of_web_technology_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `introduction_to_hybrid_and_electric_vehicles_attendance`
--
ALTER TABLE `introduction_to_hybrid_and_electric_vehicles_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `introduction_to_iot_attendance`
--
ALTER TABLE `introduction_to_iot_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `introduction_to_multimedia_attendance`
--
ALTER TABLE `introduction_to_multimedia_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multimedia_attendance`
--
ALTER TABLE `multimedia_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operation_research_attendance`
--
ALTER TABLE `operation_research_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_design_attendance`
--
ALTER TABLE `product_design_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renewable_energy_and_environment_attendance`
--
ALTER TABLE `renewable_energy_and_environment_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renewable_energy_technologies_attendance`
--
ALTER TABLE `renewable_energy_technologies_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rural_technology_attendance`
--
ALTER TABLE `rural_technology_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solar_power_technologies_attendance`
--
ALTER TABLE `solar_power_technologies_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sustainable_development_attendance`
--
ALTER TABLE `sustainable_development_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
