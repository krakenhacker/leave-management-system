-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 12 Απρ 2022 στις 12:56:40
-- Έκδοση διακομιστή: 10.4.22-MariaDB
-- Έκδοση PHP: 8.0.13

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
(19, 'GEORGIOS', 'GAROUFALIS', 'george.sot@windowslive.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 2),
(20, 'aikaterini', 'talla', 'katerinatalla28@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1),
(21, 'Ioannis', 'Bouzikas', 'bouzikas@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1);

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
  `reason` varchar(550) DEFAULT NULL,
  `submitkey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `submissions`
--

INSERT INTO `submissions` (`id`, `date_submitted`, `vacstart`, `vacend`, `totaldays`, `statusid`, `employeeid`, `reason`, `submitkey`) VALUES
(40, '2022-04-11', '2022-04-15', '2022-04-18', 3, 2, 20, 'Vacation', 'icPmEUAtD9byMTsXHR75'),
(41, '2022-04-11', '2022-06-16', '2022-06-17', 1, 3, 20, 'i have my birthay on 16 of June', 'zpo2XDRthKBbW7vsTVF4'),
(42, '2022-04-11', '2022-04-30', '2022-05-02', 2, 2, 19, 'Vacation', 'bQ7U68aPhMouc3NTFWn0'),
(43, '2022-04-11', '2023-01-12', '2023-01-20', 8, 3, 19, 'vacation', 'MFUqLcZRkwWjsYIT6nN0'),
(48, '2022-04-12', '2022-04-20', '2022-04-22', 2, 2, 21, 'vacation', '3IisL0m2V4Mta7dolOQ6'),
(57, '2022-04-12', '2022-04-14', '2022-04-17', 3, 2, 20, 'Vacation', 'GN1Rd9Sx86pJf0Oh3kVo');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT για πίνακα `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
