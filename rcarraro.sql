-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 28, 2024 alle 00:41
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
-- Database: `rcarraro`
--
CREATE DATABASE IF NOT EXISTS `rcarraro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rcarraro`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `abbonamenti`
--

INSERT INTO `abbonamenti` (`id`, `nome`, `durata`, `costo`) VALUES
(1, 'Mensileeee', 30, '50.00'),
(2, 'Trimestrale', 90, '140.00'),
(3, 'Annuale', 365, '500.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `allenatori`
--

INSERT INTO `allenatori` (`id`, `nome`, `cognome`, `data_di_nascita`, `descrizione`) VALUES
(1, 'Andrea', 'Giurisato', '2002-02-22', ' universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale se questo è leggibile. Lo scopo dell’utilizzo del Lorem Ipsum è che offre una normale distribuzione delle lettere (al contrario di quant'),
(2, 'Riccardo', 'Carraro', '2002-09-28', ' universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale se questo è leggibile. Lo scopo dell’utilizzo del Lorem Ipsum è che offre una normale distribuzione delle lettere (al contrario di quant'),
(3, 'Endy', 'Hysa', '2002-08-18', 'Proprio un pieppero del quartiere!'),
(4, 'Michele', 'Ogniben', '2001-10-02', 'Un altro vero pippero del quartiere!');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `esercizi`
--

INSERT INTO `esercizi` (`id`, `nome`, `descrizione`, `id_macchinario`) VALUES
(1, 'Leg press', 'Benvenuto nel \"Circo della Leg Press\"! Siediti sul trono delle gambe e spingi il peso come se stessi sfidando un polpo gigante. Questo esercizio ti trasforma in un supereroe delle gambe, pronto per sconfiggere qualsiasi nemico con un\'esplosione di potenza. La Leg Press: il divertimento muscolare inizia ora!', 1),
(2, 'Panca piana', 'Benvenuto nel \"Teatro della Panca Piana\"! Distendi le tue ali immaginarie e solleva i pesi come un supereroe in allenamento. Questa panca è il palcoscenico dove il tuo petto diventa la star di uno spettacolo di forza e resistenza. La Panca Piana: dove il tuo corpo diventa la migliore performance!\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 2),
(3, 'Shoulder press', 'Entra nel \"Circo delle Spalle Eroiche\"! Solleva i pesi sopra la testa come se stessi lanciando la sfida ultima. Le tue spalle diventano il palcoscenico, e tu sei la star di uno spettacolo di forza e determinazione. Lo Shoulder Press: dove ogni ripetizione è un applauso al tuo potenziale!', 3),
(4, 'Leg extension', 'Benvenuto nella \"Galleria delle Gambe Scattanti\"! Siediti e solleva le gambe come se stessi inaugurando una mostra d\'arte muscolare. La Leg Extension trasforma i tuoi quadricipiti in opere d\'arte, con ogni estensione che dipinge forza e definizione. Un capolavoro fitness in ogni movimento!', 4),
(5, 'Barra per trazioni', 'Entra nel \"Reame delle Trazioni Aeree\"! Afferra la barra come un acrobata pronto per un numero spettacolare. Le tue mani diventano l\'ancora di un\'emozionante performance, sollevandoti verso la forza e la maestosità. La Barra per Trazioni: dove il tuo corpo diventa un\'opera d\'arte sospesa nell\'arte della forza.', 5),
(6, 'Lat machine', 'Benvenuto nel \"Tempio della Lat Machine\"! Siediti e afferra la barra come un comandante di un\'astronave spaziale. Questa macchina trasforma i tuoi dorsali in potenti ali interstellari, pronte a navigare attraverso il vasto universo della forza. Lat Machine: dove ogni tirata è un salto nell\'infinito della resistenza muscolare!\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 6),
(7, 'Squat rack', 'Benvenuto nella \"Fortezza degli Squat\"! Entra nel rack come un cavaliere pronto per la sfida. Con la barra sulle spalle, immergiti nell\'epica battaglia contro il peso, scendendo e risorgendo come un guerriero intramontabile. Lo Squat Rack: dove la forza diventa la tua arma segreta per conquistare il regno della forma fisica!', 7),
(8, 'Ellittica ', 'Benvenuto nell\'\"Oasi dell\'Ellittica\"! Salta su come se stessi partecipando a una danza cosmica. L\'ellittica diventa la tua navicella spaziale, guidandoti attraverso un viaggio senza fine di resistenza. Con ogni passo ellittico, danzi verso il fitness, trasformando il sudore in una coreografia di benessere. Ellittica: dove la tua forma fisica diventa una performance fluida e avvincente!', 8),
(9, 'Cyclette', 'Benvenuto nel \"Circo della Cyclette\"! Siediti sulla sella come un ciclista intraprendente pronto per una corsa virtuale. Pedala via come se stessi sfrecciando su strade panoramiche o inseguendo il vento. La Cyclette: il palcoscenico dove la tua resistenza diventa la star di uno spettacolo di allenamento circense, senza bisogno di biglietto d\'ingresso!', 9),
(10, 'Tapis roulant', 'Benvenuto nella \"Pista Magica del Tapis Roulant\"! Cammina o corri come se stessi sfrecciando attraverso un paesaggio incantato. Il tapis roulant diventa il tuo sentiero verso la forma fisica, un\'avventura senza fine sotto i tuoi piedi. Sull\'asfalto virtuale, ogni passo è una conquista, trasformando l\'allenamento in un viaggio magico verso il benessere. Tapis Roulant: dove la tua strada diventa una favola di fitness!', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppimuscolari`
--

DROP TABLE IF EXISTS `gruppimuscolari`;
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

DROP TABLE IF EXISTS `macchinari`;
CREATE TABLE `macchinari` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `dataDiAcquisto` date DEFAULT NULL,
  `gruppoMuscolare` int(11) DEFAULT NULL,
  `path` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `macchinari`
--

INSERT INTO `macchinari` (`id`, `nome`, `dataDiAcquisto`, `gruppoMuscolare`, `path`) VALUES
(1, 'Leg press', '2022-01-01', 6, 'leg-press.webp'),
(2, 'Panca piana', '2022-01-02', 5, 'panca-piana.webp'),
(3, 'Shoulder press', '2022-01-03', 2, 'shoulder-press.webp'),
(4, 'Leg extension', '2022-01-04', 6, 'leg-extension.webp'),
(5, 'Barra per trazioni', '2022-01-05', 1, 'barra-trazioni.webp'),
(6, 'Lat Machine', '2022-01-06', 7, 'lat-machine.webp'),
(7, 'Squat rack', '2022-01-07', 6, 'squat-rack.webp'),
(8, 'Ellittica', '2022-01-08', 3, 'elittica.webp'),
(9, 'Cyclette', '2022-01-09', 3, 'cyclette.webp'),
(10, 'Tapis roulant', '2022-01-10', 3, 'tapis-roulant.webp');

-- --------------------------------------------------------

--
-- Struttura della tabella `scheda`
--

DROP TABLE IF EXISTS `scheda`;
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

DROP TABLE IF EXISTS `schede_esercizi`;
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
(2, 1, 5, 'lunedi', 4, 14),
(3, 1, 3, 'lunedi', 5, 10),
(4, 1, 7, 'lunedi', 6, 8),
(5, 1, 6, 'mercoledi', 10, 10),
(6, 1, 9, 'mercoledi', 1, 50),
(7, 1, 10, 'mercoledi', 2, 30),
(8, 1, 1, 'mercoledi', 4, 4),
(9, 1, 2, 'venerdi', 8, 10),
(10, 1, 4, 'venerdi', 7, 30),
(11, 1, 7, 'venerdi', 8, 5),
(12, 1, 6, 'venerdi', 3, 10),
(13, 2, 2, 'martedi', 2, 10),
(14, 2, 6, 'martedi', 3, 12),
(15, 2, 4, 'martedi', 5, 10),
(16, 2, 9, 'martedi', 1, 55),
(17, 2, 7, 'giovedi', 10, 10),
(18, 2, 10, 'giovedi', 1, 50),
(19, 2, 1, 'giovedi', 2, 30),
(20, 2, 2, 'giovedi', 4, 4),
(21, 2, 3, 'venerdi', 8, 10),
(22, 2, 5, 'venerdi', 7, 30),
(23, 2, 8, 'venerdi', 2, 15),
(24, 2, 7, 'venerdi', 3, 10),
(25, 3, 3, 'lunedi', 8, 10),
(26, 3, 7, 'lunedi', 2, 12),
(27, 3, 5, 'lunedi', 4, 10),
(28, 3, 10, 'lunedi', 1, 55),
(29, 3, 8, 'martedi', 1, 60),
(30, 3, 1, 'martedi', 1, 50),
(31, 3, 2, 'martedi', 2, 6),
(32, 3, 3, 'martedi', 4, 7),
(33, 3, 4, 'venerdi', 8, 10),
(34, 3, 6, 'venerdi', 2, 7),
(35, 3, 9, 'venerdi', 2, 40),
(36, 3, 8, 'venerdi', 3, 20),
(37, 4, 4, 'lunedi', 4, 10),
(38, 4, 8, 'lunedi', 3, 25),
(39, 4, 6, 'lunedi', 4, 10),
(40, 4, 1, 'lunedi', 3, 15),
(41, 4, 9, 'martedi', 1, 60),
(42, 4, 2, 'martedi', 5, 20),
(43, 4, 3, 'martedi', 8, 6),
(44, 4, 4, 'martedi', 2, 7),
(45, 4, 5, 'venerdi', 3, 10),
(46, 4, 7, 'venerdi', 4, 7),
(47, 4, 10, 'venerdi', 1, 40),
(48, 4, 9, 'venerdi', 2, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `schede_utente`
--

DROP TABLE IF EXISTS `schede_utente`;
CREATE TABLE `schede_utente` (
  `username` varchar(50) NOT NULL,
  `id_scheda` int(11) NOT NULL
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
CREATE TABLE `utenti` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('user','admin') NOT NULL,
  `certificatoMedico` enum('approvato','non approvato','assente','da validare') DEFAULT NULL,
  `certificatoPath` varchar(100) DEFAULT NULL,
  `scadenzaCertificato` date DEFAULT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `dataRegistrazione` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `email`, `password`, `ruolo`, `certificatoMedico`, `certificatoPath`, `scadenzaCertificato`, `nome`, `cognome`, `dataRegistrazione`) VALUES
('admin', 'admin@gmail.com', 'admin', 'admin', NULL, NULL, NULL, 'Mario', 'Rossi', '2024-01-10'),
('carlos', 'bepus@gmail.com', 'password', 'user', 'da validare', './certificati/certificato_carlos.pdf', NULL, 'carlo', 'bepus', NULL),
('giury', 'andrea@gmail.com', 'password', 'user', 'da validare', './certificati/certificato_giury.pdf', NULL, 'andrea', 'giurisato', NULL),
('marcoz', 'marcoz@gmail.com', 'password', 'user', 'da validare', './certificati/certificato_marcoz.pdf', NULL, 'marco', 'bettin', NULL),
('margherita', 'margherita@gmail.com', 'password', 'user', 'da validare', './certificati/certificato_margherita.pdf', NULL, 'margherita', 'zonan', NULL),
('mati', 'scazzo@gmail.com', 'password', 'user', 'da validare', './certificati/certificato_mati.pdf', NULL, 'matilde', 'scazzon', NULL),
('michiz', 'michiz@gmail.com', 'passsus', 'user', 'da validare', './certificati/certificato_michiz.pdf', NULL, 'michele', 'ognineb', NULL),
('nuovo', 'nuovo@gmail.com', 'pswNuovo', 'user', 'assente', NULL, NULL, 'nome nuovo', 'cognome nuovo', '2024-01-10'),
('sofi', 'sofi@gmail.com', 'password', 'user', 'da validare', './certificati/certificato_sofi.pdf', NULL, 'sofia', 'muggy', NULL),
('SuperLuke', 'luke@gmail.com', 'pswLuke', 'user', 'approvato', './certificati/certificato_6.pdf', '2024-11-30', 'Luca', 'Superbo', '0000-00-00'),
('user', 'user@gmail.com', 'user', 'user', 'da validare', './certificati/certificato_user.pdf', NULL, 'nome user', 'cognome user', '2023-12-01');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti_abbonamenti`
--

DROP TABLE IF EXISTS `utenti_abbonamenti`;
CREATE TABLE `utenti_abbonamenti` (
  `username` varchar(50) NOT NULL,
  `id_abbonamento` int(11) NOT NULL,
  `data_stipula` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti_abbonamenti`
--

INSERT INTO `utenti_abbonamenti` (`username`, `id_abbonamento`, `data_stipula`) VALUES
('SuperLuke', 3, '2023-12-01'),
('user', 1, '2023-12-01'),
('user', 2, '2024-01-01');

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
  ADD PRIMARY KEY (`username`,`id_scheda`),
  ADD KEY `id_scheda` (`id_scheda`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `utenti_abbonamenti`
--
ALTER TABLE `utenti_abbonamenti`
  ADD PRIMARY KEY (`username`,`id_abbonamento`),
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
