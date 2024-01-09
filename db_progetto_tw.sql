-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 09, 2024 alle 01:01
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.0

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

CREATE TABLE `abbonamenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `durata` int(11) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `abbonamenti`
--

INSERT INTO `abbonamenti` (`id`, `nome`, `durata`, `costo`) VALUES
(1, 'Mensile', 30, '50.00'),
(2, 'Trimestrale', 90, '140.00'),
(3, 'Annuale', 365, '500.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `allenatori`
--

CREATE TABLE `allenatori` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `allenatori`
--

INSERT INTO `allenatori` (`id`, `nome`, `cognome`, `data_di_nascita`, `descrizione`) VALUES
(1, 'nomeA1', 'cognomeA1', '2000-01-01', ' universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale se questo è leggibile. Lo scopo dell’utilizzo del Lorem Ipsum è che offre una normale distribuzione delle lettere (al contrario di quant'),
(2, 'nomeA2', 'cognomeA2', '2000-01-02', ' universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale se questo è leggibile. Lo scopo dell’utilizzo del Lorem Ipsum è che offre una normale distribuzione delle lettere (al contrario di quant'),
(3, 'nomeA3', 'cognomeA3', '2000-01-01', 'Proprio un pieppero del quartiere!'),
(4, 'nomeA4', 'cognomeA4', '2000-01-01', 'Un altro vero pippero del quartiere!');

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

CREATE TABLE `esercizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `id_macchinario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `esercizi`
--

INSERT INTO `esercizi` (`id`, `nome`, `descrizione`, `id_macchinario`) VALUES
(1, 'Esercizio1', 'Descrizione1', 1),
(2, 'Esercizio2', 'Descrizione2', 2),
(3, 'Esercizio3', 'Descrizione3', 3),
(4, 'Esercizio4', 'Descrizione4', 4),
(5, 'Esercizio5', 'Descrizione5', 5),
(6, 'Esercizio6', 'Descrizione6', 6),
(7, 'Esercizio7', 'Descrizione7', 7),
(8, 'Esercizio8', 'Descrizione8', 8),
(9, 'Esercizio9', 'Descrizione9', 9),
(10, 'Esercizio10', 'Descrizione10', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppimuscolari`
--

CREATE TABLE `gruppimuscolari` (
  `ID` int(11) NOT NULL,
  `gruppoMuscolare` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `gruppimuscolari`
--

INSERT INTO `gruppimuscolari` (`ID`, `gruppoMuscolare`) VALUES
(1, 'Schiena'),
(2, 'Spalle'),
(3, 'Bicipiti'),
(4, 'Tricipiti'),
(5, 'Petto'),
(6, 'Gambe'),
(7, 'Addominali');

-- --------------------------------------------------------

--
-- Struttura della tabella `macchinari`
--

CREATE TABLE `macchinari` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `dataDiAcquisto` date DEFAULT NULL,
  `gruppoMuscolare` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `macchinari`
--

INSERT INTO `macchinari` (`id`, `nome`, `dataDiAcquisto`, `gruppoMuscolare`) VALUES
(1, 'Macchina1', '2022-01-01', 1),
(2, 'Macchina2', '2022-01-02', 2),
(3, 'Macchina3', '2022-01-03', 3),
(4, 'Macchina4', '2022-01-04', 4),
(5, 'Macchina5', '2022-01-05', 5),
(6, 'Macchina6', '2022-01-06', 6),
(7, 'Macchina7', '2022-01-07', 7),
(8, 'Macchina8', '2022-01-08', 1),
(9, 'Macchina9', '2022-01-09', 2),
(10, 'Macchina10', '2022-01-10', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `scheda`
--

CREATE TABLE `scheda` (
  `id_scheda` int(11) NOT NULL,
  `id_allenatore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `scheda`
--

INSERT INTO `scheda` (`id_scheda`, `id_allenatore`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `schede_esercizi`
--

CREATE TABLE `schede_esercizi` (
  `id` int(11) NOT NULL,
  `id_scheda` int(11) DEFAULT NULL,
  `id_esercizio` int(11) DEFAULT NULL,
  `giorno_settimana` enum('lunedi','martedi','mercoledi','giovedi','venerdi','sabato','domenica') DEFAULT NULL,
  `numero_set` int(11) DEFAULT NULL,
  `numero_ripetizioni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `schede_esercizi`
--

INSERT INTO `schede_esercizi` (`id`, `id_scheda`, `id_esercizio`, `giorno_settimana`, `numero_set`, `numero_ripetizioni`) VALUES
(1, 1, 1, 'lunedi', 3, 10),
(2, 1, 2, 'lunedi', 3, 10),
(3, 1, 3, 'mercoledi', 3, 10),
(4, 1, 4, 'mercoledi', 3, 10),
(5, 1, 5, 'venerdi', 3, 10),
(6, 2, 6, 'martedi', 3, 10),
(7, 2, 7, 'martedi', 3, 10),
(8, 2, 1, 'giovedi', 3, 10),
(9, 2, 2, 'giovedi', 3, 10),
(10, 2, 3, 'sabato', 3, 10),
(11, 3, 2, 'lunedi', 3, 10),
(12, 3, 2, 'martedi', 3, 10),
(13, 3, 1, 'giovedi', 4, 10),
(14, 3, 4, 'giovedi', 3, 10),
(15, 3, 6, 'lunedi', 3, 10),
(16, 4, 1, 'venerdi', 3, 10),
(17, 4, 7, 'martedi', 4, 10),
(18, 4, 7, 'giovedi', 3, 10),
(19, 4, 1, 'giovedi', 3, 10),
(20, 4, 3, 'giovedi', 3, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `schede_utente`
--

CREATE TABLE `schede_utente` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) DEFAULT NULL,
  `id_scheda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `schede_utente`
--

INSERT INTO `schede_utente` (`id`, `id_utente`, `id_scheda`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ruolo` enum('user','admin') DEFAULT NULL,
  `certificatoMedico` enum('approvato','non approvato','assente') DEFAULT NULL,
  `certificatoPath` varchar(100) DEFAULT NULL,
  `scadenzaCertificato` date DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `email`, `password`, `ruolo`, `certificatoMedico`, `certificatoPath`, `scadenzaCertificato`, `nome`, `cognome`) VALUES
(1, 'user', 'user@gmail.com', 'user', 'user', 'approvato', './certificati/certificato_1.pdf', '2025-01-01', 'nome user', 'cognome user'),
(5, 'nuovo', 'nuovo@gmail.com', 'pswNuovo', 'user', NULL, NULL, NULL, 'nome nuovo', 'cognome nuovo'),
(7, 'admin', 'admin@gmail.com', 'admin', 'admin', NULL, NULL, NULL, 'Mario', 'Rossi');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti_abbonamenti`
--

CREATE TABLE `utenti_abbonamenti` (
  `id_utente` int(11) NOT NULL,
  `id_abbonamento` int(11) NOT NULL,
  `data_stipula` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti_abbonamenti`
--

INSERT INTO `utenti_abbonamenti` (`id_utente`, `id_abbonamento`, `data_stipula`) VALUES
(1, 1, '2023-12-01'),
(1, 2, '2024-01-01');

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
-- Indici per le tabelle `scheda`
--
ALTER TABLE `scheda`
  ADD PRIMARY KEY (`id_scheda`),
  ADD KEY `id_allenatore` (`id_allenatore`);

--
-- Indici per le tabelle `schede_esercizi`
--
ALTER TABLE `schede_esercizi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_scheda` (`id_scheda`),
  ADD KEY `id_esercizio` (`id_esercizio`);

--
-- Indici per le tabelle `schede_utente`
--
ALTER TABLE `schede_utente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_scheda` (`id_scheda`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `allenatori`
--
ALTER TABLE `allenatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `gruppimuscolari`
--
ALTER TABLE `gruppimuscolari`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `macchinari`
--
ALTER TABLE `macchinari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `scheda`
--
ALTER TABLE `scheda`
  MODIFY `id_scheda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `schede_esercizi`
--
ALTER TABLE `schede_esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `schede_utente`
--
ALTER TABLE `schede_utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `scheda`
--
ALTER TABLE `scheda`
  ADD CONSTRAINT `scheda_ibfk_1` FOREIGN KEY (`id_allenatore`) REFERENCES `allenatori` (`id`);

--
-- Limiti per la tabella `schede_utente`
--
ALTER TABLE `schede_utente`
  ADD CONSTRAINT `schede_utente_ibfk_1` FOREIGN KEY (`id_scheda`) REFERENCES `scheda` (`id_scheda`),
  ADD CONSTRAINT `schede_utente_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
