-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 06:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmis`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `masked_admin`
-- (See below for the actual view)
--
CREATE TABLE `masked_admin` (
`id_admin` int(11)
,`masked_email` varchar(7)
,`masked_password` varchar(7)
,`masked_lname` varchar(7)
,`masked_fname` varchar(7)
,`masked_mi` varchar(7)
,`masked_role` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `masked_users`
-- (See below for the actual view)
--
CREATE TABLE `masked_users` (
`id_user` int(11)
,`masked_email` longtext
,`masked_password` longtext
,`masked_lname` longtext
,`masked_fname` longtext
,`masked_address` longtext
,`masked_position` longtext
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `email`, `password`, `lname`, `fname`, `mi`, `role`) VALUES
(1, 'admin1@gmail.com', '6964f527f011df8756f87c3e8a76884f', 'Tosper', 'Rafael Jr.', 'M', 'administrator'),
(2, 'admin2@gmail.com', '6964f527f011df8756f87c3e8a76884f', 'Simon', 'Marian', 'C', 'administrator'),
(3, 'admin3@gmail.com', '6964f527f011df8756f87c3e8a76884f', 'Obena', 'Katrina', 'T', 'administrator'),
(4, 'admin4@gmail.com', '6964f527f011df8756f87c3e8a76884f', 'Villano', 'Kristine Joy', 'G', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `id_announcement` int(11) NOT NULL,
  `event` varchar(1000) NOT NULL,
  `target` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `addedby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`id_announcement`, `event`, `target`, `start_date`, `addedby`) VALUES
(6, 'Free Consultations available from June 13, 2021 until June 25, 2021', NULL, '2021-06-12', 'vilfamat, vincent');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blotter`
--

CREATE TABLE `tbl_blotter` (
  `id_blotter` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `blot_photo` mediumblob NOT NULL,
  `contact` int(20) NOT NULL,
  `narrative` mediumtext NOT NULL,
  `timeapplied` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blotter`
--

INSERT INTO `tbl_blotter` (`id_blotter`, `id_resident`, `lname`, `fname`, `mi`, `houseno`, `street`, `brgy`, `municipal`, `blot_photo`, `contact`, `narrative`, `timeapplied`) VALUES
(1, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', '', 2147483647, 'sinakal tas binalibag pusa namin', '2021-06-30 09:17:36'),
(2, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', '', 2147483647, 'pinalo yung aso namen', '2021-06-30 09:43:46'),
(3, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', 0x4172726179, 2147483647, 'hinataw yung aso namin', '2021-06-30 09:54:15'),
(4, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', 0x4172726179, 2147483647, 'pinalo yung aso ko ng kapitbahay', '2021-06-30 13:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgyid`
--

CREATE TABLE `tbl_brgyid` (
  `id_brgyid` int(11) DEFAULT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `bplace` varchar(255) NOT NULL,
  `bdate` varchar(255) NOT NULL,
  `res_photo` varchar(255) DEFAULT NULL,
  `inc_lname` varchar(255) NOT NULL,
  `inc_fname` varchar(255) NOT NULL,
  `inc_mi` varchar(255) NOT NULL,
  `inc_contact` varchar(255) NOT NULL,
  `inc_houseno` varchar(255) NOT NULL,
  `inc_street` varchar(255) NOT NULL,
  `inc_brgy` varchar(255) NOT NULL,
  `inc_municipal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brgyid`
--

INSERT INTO `tbl_brgyid` (`id_brgyid`, `id_resident`, `lname`, `fname`, `mi`, `houseno`, `street`, `brgy`, `municipal`, `bplace`, `bdate`, `res_photo`, `inc_lname`, `inc_fname`, `inc_mi`, `inc_contact`, `inc_houseno`, `inc_street`, `inc_brgy`, `inc_municipal`) VALUES
(NULL, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', '2011-06-15', '1999-07-30', NULL, 'Vilfamat', 'Teresita', 'Briongos', '09515496436', 'Antipolo City', '2011-06-15', '1999-07-30', NULL),
(NULL, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', '2011-06-15', '1999-11-29', NULL, 'Vilfamat', 'Teresita', 'Briongos', '09654165465', 'Antipolo City', '2011-06-15', '1999-11-29', 'Array'),
(NULL, 23, 'Vilfamat', 'Vincent', 'Briongos', 'Blk. 2 Lot 5', 'Kamatisan', 'Dalig', 'Antipolo City', 'Antipolo, Rizal', '1999-11-30', NULL, 'Vilfamat', 'Teresita', 'Briongos', '09564815496', 'Antipolo City', 'Antipolo, Rizal', '1999-11-30', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bspermit`
--

CREATE TABLE `tbl_bspermit` (
  `id_bspermit` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mi` varchar(255) DEFAULT NULL,
  `age` tinyint(4) NOT NULL,
  `bsname` varchar(255) DEFAULT NULL,
  `houseno` varchar(255) DEFAULT NULL,
  `street` varchar(252) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `municipal` varchar(255) DEFAULT NULL,
  `bsindustry` varchar(255) DEFAULT NULL,
  `aoe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bspermit`
--

INSERT INTO `tbl_bspermit` (`id_bspermit`, `id_resident`, `lname`, `fname`, `mi`, `age`, `bsname`, `houseno`, `street`, `brgy`, `municipal`, `bsindustry`, `aoe`) VALUES
(3, 45, 'Coloma', 'Charmaine', 'Baldo', 24, 'Coloma\'s Meat Stand', '123', 'Purok 2', 'Yuson', 'Guimba', 'Food', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clearance`
--

CREATE TABLE `tbl_clearance` (
  `id_clearance` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_clearance`
--

INSERT INTO `tbl_clearance` (`id_clearance`, `id_resident`, `lname`, `fname`, `mi`, `purpose`, `houseno`, `street`, `brgy`, `municipal`, `status`, `age`) VALUES
(4, 44, 'Coloma', 'Charmaine', 'Baldo', 'Job Requirement', '123', 'Purok 1', 'Yuson', 'Guimba', 'Single', '24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indigency`
--

CREATE TABLE `tbl_indigency` (
  `id_indigency` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_indigency`
--

INSERT INTO `tbl_indigency` (`id_indigency`, `id_resident`, `lname`, `fname`, `mi`, `nationality`, `houseno`, `street`, `brgy`, `municipal`, `purpose`, `date`) VALUES
(3, 45, 'Coloma', 'Charmaine', 'Baldo', 'Filipino', '123', 'Purok 2', 'Yuson', 'Guimba', 'Financial Transaction', '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rescert`
--

CREATE TABLE `tbl_rescert` (
  `id_rescert` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rescert`
--

INSERT INTO `tbl_rescert` (`id_rescert`, `id_resident`, `lname`, `fname`, `mi`, `age`, `nationality`, `houseno`, `street`, `brgy`, `municipal`, `date`, `purpose`) VALUES
(111112, 44, 'Reyes', 'Hannah Joy', 'Dizon', '24', 'Filipino', '123', 'Purok 1', 'Yuson', 'Guimba', '2024-03-24', 'Certify that you are living in a certain barangay'),
(111113, 46, 'Refugia', 'Lyka', 'Bernardino', '22', 'Filipino', '123', 'Purok 7', 'Yuson', 'Guimba', '2024-03-25', 'Financial Transaction');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `id_resident` int(11) NOT NULL,
  `res_photo` mediumblob DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `houseno` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `municipal` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `bplace` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `family_role` varchar(255) NOT NULL,
  `voter` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `addedby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`id_resident`, `res_photo`, `email`, `password`, `lname`, `fname`, `mi`, `age`, `sex`, `status`, `houseno`, `street`, `brgy`, `municipal`, `address`, `contact`, `bdate`, `bplace`, `nationality`, `family_role`, `voter`, `role`, `addedby`) VALUES
(44, NULL, 'reyeshannahjoy82@gmail.com', '6964f527f011df8756f87c3e8a76884f', 'Reyes', 'Hannah Joy', 'Dizon', 24, 'Female', 'Single', '123', 'Purok 1', 'Yuson', 'Guimba', NULL, '09952650331', '1999-10-26', 'Veronica', 'Filipino', 'No', 'Yes', 'resident', NULL),
(45, NULL, 'coloma@gmail.com', '6964f527f011df8756f87c3e8a76884f', 'Coloma', 'Charmaine', 'Baldo', 24, 'Female', 'Single', '123', 'Purok 2', 'Yuson', 'Guimba', NULL, '09952650331', '1999-11-20', 'Veronica', 'Filipino', 'No', 'Yes', 'resident', NULL),
(46, NULL, 'bernardino@gmail.com', '236737daaaf805cdb1bc88193392f8a6', 'Refugia', 'Lyka', 'Bernardino', 22, 'Female', 'Single', '123', 'Purok 7', 'Yuson', 'Guimba', NULL, '09123456788', '2001-11-25', 'Veronica', 'Filipino', 'No', 'Yes', 'resident', NULL),
(55, NULL, 'santy@gmail.com', '30046529e77eff70742fb774a7c9bd62', 'Balmores', 'Santy', 'Palma', 20, 'Male', 'Single', '1234', 'Purok 7', 'Yuson', 'Guimba', NULL, '09785643128', '2003-04-26', 'Veronica', 'Filipino', 'Yes', 'Yes', 'resident', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_travelpermit`
--

CREATE TABLE `tbl_travelpermit` (
  `id_travel` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `prev_owner` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `brgy` varchar(50) NOT NULL,
  `municipal` varchar(50) NOT NULL,
  `buyers_name` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_travelpermit`
--

INSERT INTO `tbl_travelpermit` (`id_travel`, `id_resident`, `prev_owner`, `breed`, `gender`, `color`, `destination`, `date`, `brgy`, `municipal`, `buyers_name`, `purpose`) VALUES
(2, 44, 'Reyes Hannah Joy', 'Sheep', 'Female', 'Spotted', 'Farm', '2024-03-25', 'Yuson', 'Guimba', 'Charmaine Joyce Coloma', 'Breeding');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `age` int(20) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `addedby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `email`, `password`, `lname`, `fname`, `mi`, `age`, `sex`, `address`, `contact`, `position`, `role`, `addedby`) VALUES
(11, 'obena@gmail.com', 'melinda12345', 'Obena', 'Katrina', 'T', 24, 'Female', 'San Miguel, Guimba', '09564123321', 'Barangay Secretary', 'user', 'Rafael Tosper'),
(12, 'mangalino@gmail.com', 'earl12345', 'Mangalino', 'Jayvee', 'Tayong', 28, 'Male', 'Pasong Inchik, Guimba', '09785631125', 'Barangay Treasurer', 'user', 'Rafael Tosper'),
(13, 'marian@gmail.com', 'adminMarian@', 'Simon', 'Marian', 'Cabiso', 24, 'Female', '1234, Purok 5, Cavite, Guimba', '09876543211', 'Kagawad', 'user', 'Tosper, Rafael Jr.');

-- --------------------------------------------------------

--
-- Structure for view `masked_admin`
--

CREATE VIEW `masked_admin` AS 
SELECT 
    `id_admin`,
    CONCAT(SUBSTR(`email`, 1, 3), RPAD(CONV(FLOOR(RAND() * 9999), 10, 16), 4, 'X')) AS `masked_email`,
    CONCAT(SUBSTR(`password`, 1, 3), RPAD(CONV(FLOOR(RAND() * 9999), 10, 16), 4, 'X')) AS `masked_password`,
    CONCAT(SUBSTR(`lname`, 1, 3), RPAD(CONV(FLOOR(RAND() * 9999), 10, 16), 4, 'X')) AS `masked_lname`,
    CONCAT(SUBSTR(`fname`, 1, 3), RPAD(CONV(FLOOR(RAND() * 9999), 10, 16), 4, 'X')) AS `masked_fname`,
    CONCAT(SUBSTR(`mi`, 1, 3), RPAD(CONV(FLOOR(RAND() * 9999), 10, 16), 4, 'X')) AS `masked_mi`,
    CONCAT(SUBSTR(`role`, 1, 3), RPAD(CONV(FLOOR(RAND() * 9999), 10, 16), 4, 'X')) AS `masked_role`
FROM 
    `tbl_admin`;

-- --------------------------------------------------------

--
-- Structure for view `masked_users`
--
DROP TABLE IF EXISTS `masked_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `masked_users`  AS SELECT `tbl_user`.`id_user` AS `id_user`, concat(repeat('x',octet_length(substring_index(`tbl_user`.`email`,'@',1))),'@',substring_index(`tbl_user`.`email`,'@',-1)) AS `masked_email`, concat(repeat('x',octet_length(`tbl_user`.`password`))) AS `masked_password`, concat(repeat('x',octet_length(`tbl_user`.`lname`))) AS `masked_lname`, concat(repeat('x',octet_length(`tbl_user`.`fname`))) AS `masked_fname`, concat(repeat('x',octet_length(`tbl_user`.`address`))) AS `masked_address`, concat(repeat('x',octet_length(`tbl_user`.`position`))) AS `masked_position` FROM `tbl_user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`id_announcement`);

--
-- Indexes for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  ADD PRIMARY KEY (`id_blotter`);

--
-- Indexes for table `tbl_bspermit`
--
ALTER TABLE `tbl_bspermit`
  ADD PRIMARY KEY (`id_bspermit`);

--
-- Indexes for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  ADD PRIMARY KEY (`id_clearance`);

--
-- Indexes for table `tbl_indigency`
--
ALTER TABLE `tbl_indigency`
  ADD PRIMARY KEY (`id_indigency`);

--
-- Indexes for table `tbl_rescert`
--
ALTER TABLE `tbl_rescert`
  ADD PRIMARY KEY (`id_rescert`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`id_resident`);

--
-- Indexes for table `tbl_travelpermit`
--
ALTER TABLE `tbl_travelpermit`
  ADD PRIMARY KEY (`id_travel`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `id_announcement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  MODIFY `id_blotter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_bspermit`
--
ALTER TABLE `tbl_bspermit`
  MODIFY `id_bspermit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  MODIFY `id_clearance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_indigency`
--
ALTER TABLE `tbl_indigency`
  MODIFY `id_indigency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_rescert`
--
ALTER TABLE `tbl_rescert`
  MODIFY `id_rescert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111114;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id_resident` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_travelpermit`
--
ALTER TABLE `tbl_travelpermit`
  MODIFY `id_travel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
