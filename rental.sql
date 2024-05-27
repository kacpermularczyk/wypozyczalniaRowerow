-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 28, 2024 at 01:07 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bikes`
--

CREATE TABLE `bikes` (
  `id_bike` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL,
  `price` double NOT NULL,
  `picture` varchar(100) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id_bike`, `model`, `description`, `price`, `picture`, `id_type`) VALUES
(3, 'TCX-05', 'Rower TCX-05, wykonany z wysokiej jakości materiałów, idealny dla miłośników aktywnego spędzania wolnego czasu. Stalowa rama, widoczny amortyzator i duże koło tylne zapewniają komfort i stabilność.', 25.99, 'bike1.jpg', 1),
(4, 'AVN-01', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(5, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(6, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(7, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 3),
(8, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(9, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(10, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 4),
(11, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(12, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(13, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 4),
(14, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(15, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(16, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(17, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(18, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(19, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 1),
(20, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(21, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2),
(22, 'AOP-59', 'Ten rower jest specjalistycznym, profesjonalnym pojazdem, zaprojektowanym dla wytrzymałych i ambitnych kolarzy. Jego stalowa rama jest osadzona w tylnym osiowym ustawieniu, co umożliwia szybkie rozpędzanie i stabilne hamowanie', 15.95, 'bike1.jpg', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `is_activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role`, `is_activated`) VALUES
(5, 'admin', 1),
(6, 'worker', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `types_of_bikes`
--

CREATE TABLE `types_of_bikes` (
  `id_type` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `types_of_bikes`
--

INSERT INTO `types_of_bikes` (`id_type`, `type`) VALUES
(1, 'górski'),
(2, 'miejski'),
(3, 'szosowy'),
(4, 'BMX');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `e-mail` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `when_modified` datetime NOT NULL,
  `who_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `surname`, `e-mail`, `login`, `password`, `when_modified`, `who_modified`) VALUES
(42, 'imie1', 'nazwisko1', 'email1', 'szef', 'szef', '2024-05-28 00:36:32', 42),
(43, 'imie2', 'nazwisko2', 'email2', 'pracownik1', 'pracownik1', '2024-05-28 00:44:56', 43),
(44, 'imie3', 'nazwisko3', 'email3', 'randomLogin123', 'randomLogin123', '2024-05-28 00:46:02', 44);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_role`
--

CREATE TABLE `user_role` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `active_since` datetime NOT NULL,
  `active_until` datetime DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_user`, `id_role`, `active_since`, `active_until`, `is_activated`) VALUES
(42, 5, '2024-05-28 00:38:29', NULL, 1),
(43, 6, '2024-05-28 00:47:52', NULL, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id_bike`),
  ADD KEY `id_type` (`id_type`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeksy dla tabeli `types_of_bikes`
--
ALTER TABLE `types_of_bikes`
  ADD PRIMARY KEY (`id_type`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `who_modified` (`who_modified`);

--
-- Indeksy dla tabeli `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id_bike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `types_of_bikes`
--
ALTER TABLE `types_of_bikes`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bikes`
--
ALTER TABLE `bikes`
  ADD CONSTRAINT `bikes_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types_of_bikes` (`id_type`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`who_modified`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
