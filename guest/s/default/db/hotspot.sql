-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Gen 31, 2018 alle 23:11
-- Versione del server: 5.7.21-0ubuntu0.16.04.1
-- Versione PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotspot`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int(11) NOT NULL,
  `device` varchar(17) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `ap` varchar(17) NOT NULL,
  `lastlog` datetime NOT NULL,
  `expire` datetime NOT NULL,
  `remove` datetime NOT NULL,
  `browser` varchar(254) NOT NULL,
  `os` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `email`, `password`, `created`, `modified`) VALUES
(8, 'admin', 'admin@backend.local', '$2y$10$g/Mop8PdCI5rBhdtzuFpge2HgVjZvCYcQtfNxgjj7gyJD.u6e5jTe', '2017-04-13 22:20:59', '2017-04-13 22:53:42');

-- --------------------------------------------------------

--
-- Struttura della tabella `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `minutes` int(5) NOT NULL,
  `blockInterval` int(5) NOT NULL,
  `fakeminutesoffset` int(11) NOT NULL,
  `upload` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `quota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `groups`
--

INSERT INTO `groups` (`id`, `name`, `minutes`, `blockInterval`, `fakeminutesoffset`, `upload`, `download`, `quota`) VALUES
(2, 'staff', 120, 120, 30, 640, 2048, 4096),
(3, 'guest', 90, 360, 30, 640, 1024, 600);

-- --------------------------------------------------------

--
-- Struttura della tabella `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `device` varchar(17) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `ap` varchar(17) NOT NULL,
  `lastlog` datetime NOT NULL,
  `expire` datetime NOT NULL,
  `remove` datetime NOT NULL,
  `browser` varchar(254) NOT NULL,
  `os` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `param` varchar(20) NOT NULL,
  `value` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `device` varchar(17) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `device`, `group_id`, `enabled`, `created`, `modified`) VALUES
(1, 'mario', 'rossi', 'ignore', 2, 1, '2017-03-20 12:05:31', '2017-04-10 15:47:55'),
(2, 'guest', 'password', 'ignore', 3, 1, '2017-03-20 12:13:38', '2017-04-10 15:49:30');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device` (`device`),
  ADD KEY `user_key` (`user_id`);

--
-- Indici per le tabelle `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_key` (`group_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
