-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 22, 2024 alle 01:11
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
CREATE DATABASE IF NOT EXISTS `rcarraro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rcarraro`;

-- --------------------------------------------------------

--
-- Struttura della tabella `abbonamenti`
--

DROP TABLE IF EXISTS `abbonamenti`;
CREATE TABLE IF NOT EXISTS `abbonamenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `durata` int(11) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `allenatori`;
CREATE TABLE IF NOT EXISTS `allenatori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `esercizi`;
CREATE TABLE IF NOT EXISTS `esercizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `id_macchinario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_macchinario` (`id_macchinario`)
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

DROP TABLE IF EXISTS `gruppimuscolari`;
CREATE TABLE IF NOT EXISTS `gruppimuscolari` (
  `ID` int(11) NOT NULL,
  `gruppoMuscolare` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
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

DROP TABLE IF EXISTS `macchinari`;
CREATE TABLE IF NOT EXISTS `macchinari` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `dataDiAcquisto` date DEFAULT NULL,
  `gruppoMuscolare` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `scheda`;
CREATE TABLE IF NOT EXISTS `scheda` (
  `id_scheda` int(11) NOT NULL AUTO_INCREMENT,
  `id_allenatore` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_scheda`),
  KEY `id_allenatore` (`id_allenatore`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `schede_esercizi`;
CREATE TABLE IF NOT EXISTS `schede_esercizi` (
  `id` int(11) NOT NULL,
  `id_scheda` int(11) DEFAULT NULL,
  `id_esercizio` int(11) DEFAULT NULL,
  `giorno_settimana` enum('lunedi','martedi','mercoledi','giovedi','venerdi','sabato','domenica') DEFAULT NULL,
  `numero_set` int(11) DEFAULT NULL,
  `numero_ripetizioni` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_scheda` (`id_scheda`),
  KEY `id_esercizio` (`id_esercizio`)
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

DROP TABLE IF EXISTS `schede_utente`;
CREATE TABLE IF NOT EXISTS `schede_utente` (
  `username` varchar(50) NOT NULL,
  `id_scheda` int(11) NOT NULL,
  PRIMARY KEY (`username`,`id_scheda`),
  KEY `id_scheda` (`id_scheda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `schede_utente`
--

INSERT INTO `schede_utente` (`username`, `id_scheda`) VALUES
('user', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE IF NOT EXISTS `utenti` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('user','admin') NOT NULL,
  `certificatoMedico` enum('approvato','non approvato','assente','da validare') DEFAULT NULL,
  `certificatoPath` varchar(100) DEFAULT NULL,
  `scadenzaCertificato` date DEFAULT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `dataRegistrazione` date DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `email`, `password`, `ruolo`, `certificatoMedico`, `certificatoPath`, `scadenzaCertificato`, `nome`, `cognome`, `dataRegistrazione`) VALUES
('admin', 'admin@gmail.com', 'admin', 'admin', NULL, NULL, NULL, 'Mario', 'Rossi', '2024-01-10'),
('nuovo', 'nuovo@gmail.com', 'pswNuovo', 'user', 'da validare', NULL, NULL, 'nome nuovo', 'cognome nuovo', '2024-01-10'),
('SuperLuke', 'luke@gmail.com', 'pswLuke', 'user', 'approvato', './certificati/certificato_6.pdf', '2024-11-30', 'Luca', 'Superbo', '0000-00-00'),
('user', 'user@gmail.com', 'user', 'user', 'da validare', './certificati/certificato_1.pdf', '2025-01-18', 'nome user', 'cognome user', '2023-12-01');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti_abbonamenti`
--

DROP TABLE IF EXISTS `utenti_abbonamenti`;
CREATE TABLE IF NOT EXISTS `utenti_abbonamenti` (
  `username` varchar(50) NOT NULL,
  `id_abbonamento` int(11) NOT NULL,
  `data_stipula` date DEFAULT NULL,
  PRIMARY KEY (`username`,`id_abbonamento`),
  KEY `id_abbonamento` (`id_abbonamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti_abbonamenti`
--

INSERT INTO `utenti_abbonamenti` (`username`, `id_abbonamento`, `data_stipula`) VALUES
('SuperLuke', 3, '2023-12-01'),
('user', 1, '2023-12-01'),
('user', 2, '2024-01-01');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `scheda`
--
ALTER TABLE `scheda`
  ADD CONSTRAINT `scheda_ibfk_1` FOREIGN KEY (`id_allenatore`) REFERENCES `allenatori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
