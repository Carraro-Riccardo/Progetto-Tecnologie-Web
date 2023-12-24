-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 24, 2023 alle 17:24
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
-- Database: `db_progetto_tw`
--
CREATE DATABASE IF NOT EXISTS `db_progetto_tw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_progetto_tw`;

-- --------------------------------------------------------

--
-- Struttura della tabella `abbonamenti`
--

DROP TABLE IF EXISTS `abbonamenti`;
CREATE TABLE `abbonamenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `durata` int(11) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `abbonamenti`
--

TRUNCATE TABLE `abbonamenti`;
-- --------------------------------------------------------

--
-- Struttura della tabella `allenatori`
--

DROP TABLE IF EXISTS `allenatori`;
CREATE TABLE `allenatori` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `allenatori`
--

TRUNCATE TABLE `allenatori`;
-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

DROP TABLE IF EXISTS `esercizi`;
CREATE TABLE `esercizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `id_macchinario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `esercizi`
--

TRUNCATE TABLE `esercizi`;
-- --------------------------------------------------------

--
-- Struttura della tabella `gruppimuscolari`
--

DROP TABLE IF EXISTS `gruppimuscolari`;
CREATE TABLE `gruppimuscolari` (
  `ID` int(11) NOT NULL,
  `gruppoMuscolare` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `gruppimuscolari`
--

TRUNCATE TABLE `gruppimuscolari`;
-- --------------------------------------------------------

--
-- Struttura della tabella `macchinari`
--

DROP TABLE IF EXISTS `macchinari`;
CREATE TABLE `macchinari` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `dataDiAcquisto` date DEFAULT NULL,
  `gruppoMuscolare` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `macchinari`
--

TRUNCATE TABLE `macchinari`;
-- --------------------------------------------------------

--
-- Struttura della tabella `schede_esercizi`
--

DROP TABLE IF EXISTS `schede_esercizi`;
CREATE TABLE `schede_esercizi` (
  `id_scheda` int(11) DEFAULT NULL,
  `id_esercizio` int(11) DEFAULT NULL,
  `giorno_settimana` enum('lunedi','martedi','mercoledi','giovedi','venerdi','sabato','domenica') DEFAULT NULL,
  `numero_set` int(11) DEFAULT NULL,
  `numero_ripetizioni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `schede_esercizi`
--

TRUNCATE TABLE `schede_esercizi`;
-- --------------------------------------------------------

--
-- Struttura della tabella `schede_palestra`
--

DROP TABLE IF EXISTS `schede_palestra`;
CREATE TABLE `schede_palestra` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) DEFAULT NULL,
  `id_allenatore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `schede_palestra`
--

TRUNCATE TABLE `schede_palestra`;
-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ruolo` enum('user','admin') DEFAULT NULL,
  `certificatoMedico` enum('approvato','non approvato','assente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `utenti`
--

TRUNCATE TABLE `utenti`;
-- --------------------------------------------------------

--
-- Struttura della tabella `utenti_abbonamenti`
--

DROP TABLE IF EXISTS `utenti_abbonamenti`;
CREATE TABLE `utenti_abbonamenti` (
  `id_utente` int(11) NOT NULL,
  `id_abbonamento` int(11) NOT NULL,
  `data_stipula` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `utenti_abbonamenti`
--

TRUNCATE TABLE `utenti_abbonamenti`;
--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abbonamenti`
--
ALTER TABLE `abbonamenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `allenatori`
--
ALTER TABLE `allenatori`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `esercizi`
--
ALTER TABLE `esercizi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_macchinario` (`id_macchinario`);

--
-- Indici per le tabelle `gruppimuscolari`
--
ALTER TABLE `gruppimuscolari`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `macchinari`
--
ALTER TABLE `macchinari`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `schede_esercizi`
--
ALTER TABLE `schede_esercizi`
  ADD KEY `id_scheda` (`id_scheda`),
  ADD KEY `id_esercizio` (`id_esercizio`);

--
-- Indici per le tabelle `schede_palestra`
--
ALTER TABLE `schede_palestra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_allenatore` (`id_allenatore`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti_abbonamenti`
--
ALTER TABLE `utenti_abbonamenti`
  ADD PRIMARY KEY (`id_utente`,`id_abbonamento`),
  ADD KEY `id_abbonamento` (`id_abbonamento`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `abbonamenti`
--
ALTER TABLE `abbonamenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `allenatori`
--
ALTER TABLE `allenatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `gruppimuscolari`
--
ALTER TABLE `gruppimuscolari`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `macchinari`
--
ALTER TABLE `macchinari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `schede_palestra`
--
ALTER TABLE `schede_palestra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  ADD CONSTRAINT `esercizi_ibfk_1` FOREIGN KEY (`id_macchinario`) REFERENCES `macchinari` (`id`);

--
-- Limiti per la tabella `macchinari`
--
ALTER TABLE `macchinari`
  ADD CONSTRAINT `macchinari_ibfk_1` FOREIGN KEY (`id`) REFERENCES `gruppimuscolari` (`ID`);

--
-- Limiti per la tabella `schede_esercizi`
--
ALTER TABLE `schede_esercizi`
  ADD CONSTRAINT `schede_esercizi_ibfk_1` FOREIGN KEY (`id_scheda`) REFERENCES `schede_palestra` (`id`),
  ADD CONSTRAINT `schede_esercizi_ibfk_2` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`);

--
-- Limiti per la tabella `schede_palestra`
--
ALTER TABLE `schede_palestra`
  ADD CONSTRAINT `schede_palestra_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `schede_palestra_ibfk_2` FOREIGN KEY (`id_allenatore`) REFERENCES `allenatori` (`id`);

--
-- Limiti per la tabella `utenti_abbonamenti`
--
ALTER TABLE `utenti_abbonamenti`
  ADD CONSTRAINT `utenti_abbonamenti_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `utenti_abbonamenti_ibfk_2` FOREIGN KEY (`id_abbonamento`) REFERENCES `abbonamenti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
