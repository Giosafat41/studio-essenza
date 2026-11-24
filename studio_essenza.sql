-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 19, 2026 alle 15:55
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

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
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `capienza_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE `lezione` (
  `id` int(11) NOT NULL,
  `id_corso` int(11) NOT NULL,
  `id_istruttore` int(11) NOT NULL,
  `data_ora_inizio` datetime NOT NULL,
  `data_ora_fine` datetime NOT NULL,
  `durata_minuti` int(11) NOT NULL DEFAULT 60
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lezioneindividuale`
--

CREATE TABLE `lezioneindividuale` (
  `id` int(11) NOT NULL,
  `id_istruttore` int(11) NOT NULL,
  `id_utente` int(11) DEFAULT NULL,
  `data_ora_inizio` datetime NOT NULL,
  `data_ora_fine` datetime NOT NULL,
  `stato` enum('disponibile','prenotata','annullata_istruttore') NOT NULL DEFAULT 'disponibile',
  `motivazione_annullamento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
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
-- Struttura della tabella `utente`
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
  `descrizione` text DEFAULT NULL,
  `immagine_profilo` varchar(255) DEFAULT NULL,
  `tariffa_individuale` decimal(6,2) DEFAULT NULL,
  `data_registrazione` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `email`, `password`, `telefono`, `ruolo`, `crediti_residui`, `scadenza_certificato`, `descrizione`, `immagine_profilo`, `tariffa_individuale`, `data_registrazione`) VALUES
(1, 'Letizia', 'Di Iulio', 'marileti2102@gmail.com', '$2y$10$HIYHmOmRzpz/Sj8cNLxkEOlyVkEYqdNz.nDVZyeuwiboK1rsPgrwO', '388993908', 'allievo', 10, '2027-11-18', NULL, NULL, NULL, '2026-11-11 11:51:16'),
(2, 'admin', 'admin', 'admin@gmail.com', '$2y$10$..OrjtZy9fDaKZeD5r17OumuqExX3khco2Pt9sBmTWdrOuDMLHGxS', '123456789', 'admin', 0, NULL, NULL, NULL, NULL, '2026-11-17 15:47:02'),
(3, 'Mario', 'Mariotto', 'mario.mariotto@gmail.com', '$2y$10$3n/P4FTdQeglDJ0/TpdEAuqQNxKBzOVZEig9FFRvhMC7qBq8jPP9m', '321456', 'allievo', 10, '2027-11-17', NULL, NULL, NULL, '2026-11-17 16:54:54');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_corso` (`id_corso`),
  ADD KEY `id_istruttore` (`id_istruttore`);

--
-- Indici per le tabelle `lezioneindividuale`
--
ALTER TABLE `lezioneindividuale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_istruttore` (`id_istruttore`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_utente` (`id_utente`,`id_lezione`),
  ADD KEY `id_lezione` (`id_lezione`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `lezione`
--
ALTER TABLE `lezione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `lezioneindividuale`
--
ALTER TABLE `lezioneindividuale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `lezione_ibfk_1` FOREIGN KEY (`id_corso`) REFERENCES `corso` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lezione_ibfk_2` FOREIGN KEY (`id_istruttore`) REFERENCES `utente` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `lezioneindividuale`
--
ALTER TABLE `lezioneindividuale`
  ADD CONSTRAINT `lezioneindividuale_ibfk_1` FOREIGN KEY (`id_istruttore`) REFERENCES `utente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lezioneindividuale_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE SET NULL;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`id_lezione`) REFERENCES `lezione` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
