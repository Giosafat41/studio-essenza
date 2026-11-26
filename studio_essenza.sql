-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 26, 2026 alle 17:08
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

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`id`, `nome`, `descrizione`, `capienza_max`) VALUES
(1, 'Reformer Base', 'Corso di Pilates Reformer per principianti', 10),
(2, 'Reformer Intermedio', 'Corso di Pilates Reformer di livello intermedio', 10);

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

--
-- Dump dei dati per la tabella `lezione`
--

INSERT INTO `lezione` (`id`, `id_corso`, `id_istruttore`, `data_ora_inizio`, `data_ora_fine`, `durata_minuti`) VALUES
(1, 1, 6, '2026-11-27 10:00:00', '2026-11-27 11:00:00', 60),
(2, 2, 7, '2026-11-27 10:00:00', '2026-11-27 11:00:00', 60);

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
  `data_nascita` date DEFAULT NULL,
  `ruolo` enum('allievo','istruttore','segretaria','admin') NOT NULL DEFAULT 'allievo',
  `crediti_residui` int(11) DEFAULT 0,
  `scadenza_certificato` date DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `immagine_profilo` varchar(255) DEFAULT NULL,
  `tariffa_individuale` decimal(6,2) DEFAULT NULL,
  `deve_cambiare_password` tinyint(1) NOT NULL DEFAULT 0,
  `data_registrazione` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `email`, `password`, `telefono`, `data_nascita`, `ruolo`, `crediti_residui`, `scadenza_certificato`, `descrizione`, `immagine_profilo`, `tariffa_individuale`, `deve_cambiare_password`, `data_registrazione`) VALUES
(2, 'admin', '1', 'admin@gmail.com', '$2y$10$..OrjtZy9fDaKZeD5r17OumuqExX3khco2Pt9sBmTWdrOuDMLHGxS', '123456789', NULL, 'admin', 0, NULL, NULL, NULL, NULL, 0, '2026-11-17 15:47:02'),
(4, 'utente', '1', 'utente1@gmail.com', '$2y$10$1MKLEJFREUT76PXH7HMqQOyK6bXQ4XlVoG4q/9KUUWvtvIWH6TrVG', '', NULL, 'allievo', 0, NULL, NULL, NULL, NULL, 0, '2026-11-26 15:05:46'),
(5, 'utente', '2', 'utente2@gmail.com', '$2y$10$SDayxFzKB43HpOu82/8sF.xfY97AIgA0X7ZAc7GPrjngifYVytAlm', '', NULL, 'allievo', 0, NULL, NULL, NULL, NULL, 1, '2026-11-26 15:11:58'),
(6, 'istruttore', '1', 'istruttore1@gmail.com', '$2y$10$v5np/VIJh/voHqjp1BEPV.QhyBlMhDp6nfLwOzdgzZMyqf5miy2DS', '', NULL, 'istruttore', 0, NULL, 'molto bravo', NULL, NULL, 1, '2026-11-26 15:12:34'),
(7, 'istruttore', '2', 'istruttore2@gmail.com', '$2y$10$Xvd/Y/vzPypIfH1BZsIAiuIBGoqZkzwyfSehZOw2yJQ8dMi0kiII.', '', NULL, 'istruttore', 0, NULL, 'ancora più bravo', NULL, NULL, 0, '2026-11-26 15:12:57'),
(8, 'segretaria', '1', 'segretaria1@gmail.com', '$2y$10$bx7/RZWv6wEAoGSkkbNsauG72XKgYsPYx8X.Q5vhDopX.Bft72Cia', '', NULL, 'segretaria', 0, NULL, NULL, NULL, NULL, 0, '2026-11-26 16:00:22'),
(9, 'segretaria', '2', 'segretaria2@gmail.com', '$2y$10$DFxZehfqXN0JPOppVQp2muHwNXR.yedAtYbGetJr.tJF6AFhca50q', '', NULL, 'segretaria', 0, NULL, NULL, NULL, NULL, 1, '2026-11-26 16:00:51'),
(10, 'segretaria', '3', 'segretaria3@gmail.com', '$2y$10$8Xfmqv1R4uCjP78i3c.TUemLFrX/YpaqVP/eW5vk0iTSctKqsWL7u', '', NULL, 'segretaria', 0, NULL, NULL, NULL, NULL, 1, '2026-11-26 16:02:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `lezione`
--
ALTER TABLE `lezione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
