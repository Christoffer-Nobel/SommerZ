-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2021 at 12:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sommerz`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestillinger`
--

CREATE TABLE `bestillinger` (
  `bestillings_id` int(11) NOT NULL,
  `bestillings_tid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `produkt_navn` varchar(30) NOT NULL,
  `antal` float NOT NULL,
  `enhed` varchar(7) NOT NULL,
  `lagerstatus` tinyint(1) DEFAULT '0',
  `bestillingsliste_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestillinger`
--

INSERT INTO `bestillinger` (`bestillings_id`, `bestillings_tid`, `produkt_navn`, `antal`, `enhed`, `lagerstatus`, `bestillingsliste_id`) VALUES
(11, '2021-10-22 16:24:09', 'skal vises 1', 1, 'kg', 0, 6),
(12, '2021-10-22 16:24:26', 'skal vises 2 ', 6, 'stk', 1, 6),
(13, '2021-10-22 16:24:42', 'skal vises 3', 100, 'gr', 0, 6),
(14, '2021-10-23 14:24:38', 'Himmelstund hyldeblomst', 6, 'stk', 0, 7),
(15, '2021-10-23 14:24:58', 'Rooibos røde bær', 1, 'kg', 1, 7),
(16, '2021-10-23 14:25:35', 'Grøn ingefær/citron', 3, 'kg', 1, 7),
(17, '2021-10-23 14:26:05', 'Summerbird Tapas', 5, 'stk', 0, 7),
(18, '2021-10-23 14:26:22', 'Matcha piskeris', 4, 'stk', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `medarbejdere`
--

CREATE TABLE `medarbejdere` (
  `medarbejder_id` int(11) NOT NULL,
  `fornavn` varchar(20) NOT NULL,
  `efternavn` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tlf` int(8) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `rolle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medarbejdere`
--

INSERT INTO `medarbejdere` (`medarbejder_id`, `fornavn`, `efternavn`, `email`, `tlf`, `kode`, `rolle`) VALUES
(1, 'Christian', 'Lint', 'christianlint@gmail.com', 28833392, '123', 1),
(2, 'Christina', 'Nielsen', 'christinanielsen@gmail.com', 12345678, '1231', 2),
(3, 'Emilie', 'Lundval', 'el@gmail.com', 87654321, '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `opslag`
--

CREATE TABLE `opslag` (
  `opslag_id` int(11) NOT NULL,
  `medarbejder_id` int(11) DEFAULT NULL,
  `overskrift` varchar(50) DEFAULT NULL,
  `tekst` varchar(1000) DEFAULT NULL,
  `post_tid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `opslag`
--

INSERT INTO `opslag` (`opslag_id`, `medarbejder_id`, `overskrift`, `tekst`, `post_tid`) VALUES
(4, 1, 'test', 'dette er en test', '2021-10-21 13:24:40'),
(5, 3, 'Jeg vil også lige prøve at lave et opslag', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. ', '2021-10-21 13:50:06');

-- --------------------------------------------------------

--
-- Stand-in structure for view `opslag_med_medarbejder`
-- (See below for the actual view)
--
CREATE TABLE `opslag_med_medarbejder` (
`opslag_id` int(11)
,`fornavn` varchar(20)
,`efternavn` varchar(20)
,`overskrift` varchar(50)
,`tekst` varchar(1000)
,`post_tid` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `roller`
--

CREATE TABLE `roller` (
  `rolle_id` int(11) NOT NULL,
  `rolle_navn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roller`
--

INSERT INTO `roller` (`rolle_id`, `rolle_navn`) VALUES
(1, 'Leder'),
(2, 'Salgsassistent'),
(3, 'Revisor');

-- --------------------------------------------------------

--
-- Structure for view `opslag_med_medarbejder`
--
DROP TABLE IF EXISTS `opslag_med_medarbejder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `opslag_med_medarbejder`  AS SELECT `opslag`.`opslag_id` AS `opslag_id`, `medarbejdere`.`fornavn` AS `fornavn`, `medarbejdere`.`efternavn` AS `efternavn`, `opslag`.`overskrift` AS `overskrift`, `opslag`.`tekst` AS `tekst`, `opslag`.`post_tid` AS `post_tid` FROM (`opslag` join `medarbejdere` on((`opslag`.`medarbejder_id` = `medarbejdere`.`medarbejder_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestillinger`
--
ALTER TABLE `bestillinger`
  ADD PRIMARY KEY (`bestillings_id`);

--
-- Indexes for table `medarbejdere`
--
ALTER TABLE `medarbejdere`
  ADD PRIMARY KEY (`medarbejder_id`),
  ADD KEY `medarbejderRolleRelation` (`rolle`);

--
-- Indexes for table `opslag`
--
ALTER TABLE `opslag`
  ADD PRIMARY KEY (`opslag_id`),
  ADD KEY `opslagMedarbejderRelation` (`medarbejder_id`);

--
-- Indexes for table `roller`
--
ALTER TABLE `roller`
  ADD PRIMARY KEY (`rolle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestillinger`
--
ALTER TABLE `bestillinger`
  MODIFY `bestillings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `medarbejdere`
--
ALTER TABLE `medarbejdere`
  MODIFY `medarbejder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `opslag`
--
ALTER TABLE `opslag`
  MODIFY `opslag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roller`
--
ALTER TABLE `roller`
  MODIFY `rolle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medarbejdere`
--
ALTER TABLE `medarbejdere`
  ADD CONSTRAINT `medarbejderRolleRelation` FOREIGN KEY (`rolle`) REFERENCES `roller` (`rolle_id`);

--
-- Constraints for table `opslag`
--
ALTER TABLE `opslag`
  ADD CONSTRAINT `opslagMedarbejderRelation` FOREIGN KEY (`medarbejder_id`) REFERENCES `medarbejdere` (`medarbejder_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
