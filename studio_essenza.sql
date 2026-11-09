-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2026 at 12:33 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studio_essenza`
--

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE `corso` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `capienza_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lezione`
--

CREATE TABLE `lezione` (
  `id` int(11) NOT NULL,
  `id_corso` int(11) NOT NULL,
  `id_istruttore` int(11) NOT NULL,
  `data_ora_inizio` datetime NOT NULL,
  `data_ora_fine` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prenotazione`
--

CREATE TABLE `prenotazione` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_lezione` int(11) NOT NULL,
  `data_prenotazione` timestamp NULL DEFAULT current_timestamp(),
  `stato_presenza` enum('da_effettuare','presente','assente','cancellata') DEFAULT 'da_effettuare'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ruolo` enum('allievo','istruttore','admin') NOT NULL DEFAULT 'allievo',
  `crediti_residui` int(11) DEFAULT 0,
  `scadenza_certificato` date DEFAULT NULL,
  `data_registrazione` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_corso` (`id_corso`),
  ADD KEY `id_istruttore` (`id_istruttore`);

--
-- Indexes for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_utente` (`id_utente`,`id_lezione`),
  ADD KEY `id_lezione` (`id_lezione`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lezione`
--
ALTER TABLE `lezione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `lezione_ibfk_1` FOREIGN KEY (`id_corso`) REFERENCES `corso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lezione_ibfk_2` FOREIGN KEY (`id_istruttore`) REFERENCES `utente` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`id_lezione`) REFERENCES `lezione` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
