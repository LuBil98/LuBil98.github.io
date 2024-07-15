-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Erstellungszeit: 15. Jul 2024 um 19:40
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `medhelp`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`) VALUES
(1, 'lucabilinsky16@gmail.com', '', '$2y$10$Ip34iVGfZbBMsEUMc.rizO3M.SbVpLea/QFKQ.l7mxN2vdWQmBFle'),
(2, 'KollederBoss', '', '$2y$10$rUT6PJUcaNPC9HFIbK7bWOypoFy2PFuIbutK886lyOq5b6er0sWD6'),
(3, '1234', '', '$2y$10$5K//3stb3EObosyW8vqUFOzohoW98TMCxj/FrW.WR.g/Ks/rjViEm');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pläne`
--

CREATE TABLE `pläne` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `medikament` varchar(255) NOT NULL,
  `dosierung` varchar(255) NOT NULL,
  `startdatum` date NOT NULL,
  `intervall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `pläne`
--

INSERT INTO `pläne` (`id`, `username`, `medikament`, `dosierung`, `startdatum`, `intervall`) VALUES
(4, 'KollederBoss', 'Aspirin', '1 bis 2 Tabletten', '2024-11-23', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine`
--

CREATE TABLE `termine` (
  `id` int(11) NOT NULL,
  `typ` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `zeitpunkt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pläne`
--
ALTER TABLE `pläne`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `termine`
--
ALTER TABLE `termine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `pläne`
--
ALTER TABLE `pläne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `termine`
--
ALTER TABLE `termine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
