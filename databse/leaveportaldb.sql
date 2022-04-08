-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 08 Απρ 2022 στις 16:47:53
-- Έκδοση διακομιστή: 10.4.24-MariaDB
-- Έκδοση PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `leaveportaldb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roleid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `employees`
--

INSERT INTO `employees` (`id`, `firstname`, `lastname`, `email`, `password`, `roleid`) VALUES
(1, 'Georgios', 'Garoufalis', 'geogar@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 2),
(3, 'marinos', 'charitos', 'charitos@gmail.com', '8ccb35431fea39f0cb950790af1c55fa', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `emp_role`
--

CREATE TABLE `emp_role` (
  `id` int(10) NOT NULL,
  `role` varchar(50) NOT NULL,
  `employeeid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `emp_role`
--

INSERT INTO `emp_role` (`id`, `role`, `employeeid`) VALUES
(1, 'Employee', 3),
(2, 'Admin', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `stsubmission`
--

CREATE TABLE `stsubmission` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `stsubmission`
--

INSERT INTO `stsubmission` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `date_submitted` date NOT NULL DEFAULT current_timestamp(),
  `vacstart` date NOT NULL,
  `vacend` date NOT NULL,
  `totaldays` int(11) NOT NULL,
  `statusid` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `reason` varchar(550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `submissions`
--

INSERT INTO `submissions` (`id`, `date_submitted`, `vacstart`, `vacend`, `totaldays`, `statusid`, `employeeid`, `reason`) VALUES
(1, '2022-04-07', '2022-04-22', '2022-04-25', 3, 1, 1, 'summer vacations'),
(5, '2022-04-08', '2022-04-08', '2022-04-23', 15, 1, 1, 'test'),
(15, '2022-04-08', '2022-04-12', '2022-04-15', 3, 1, 1, '3'),
(16, '2022-04-08', '2022-04-10', '2022-04-13', 3, 1, 1, 'i got hurt my leg'),
(18, '2022-04-08', '2022-04-15', '2022-05-20', 35, 1, 1, 'testlong\r\n');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `emp_role`
--
ALTER TABLE `emp_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Ευρετήρια για πίνακα `stsubmission`
--
ALTER TABLE `stsubmission`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeeid` (`employeeid`),
  ADD KEY `statusid` (`statusid`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `emp_role`
--
ALTER TABLE `emp_role`
  ADD CONSTRAINT `emp_role_ibfk_1` FOREIGN KEY (`employeeid`) REFERENCES `employees` (`id`);

--
-- Περιορισμοί για πίνακα `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`employeeid`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`statusid`) REFERENCES `stsubmission` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
