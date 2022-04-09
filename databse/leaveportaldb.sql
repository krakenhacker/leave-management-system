-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 09 Απρ 2022 στις 10:54:51
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
(19, 'GEORGIOS', 'GAROUFALIS', 'george.sot@windowslive.com', '21232f297a57a5a743894a0e4a801fc3', 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `emp_role`
--

CREATE TABLE `emp_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `emp_role`
--

INSERT INTO `emp_role` (`id`, `role`) VALUES
(1, 'Employee'),
(2, 'Admin');

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
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `roleid` (`roleid`);

--
-- Ευρετήρια για πίνακα `emp_role`
--
ALTER TABLE `emp_role`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT για πίνακα `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `emp_role` (`id`);

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
