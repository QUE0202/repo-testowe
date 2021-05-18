-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Kwi 2021, 14:15
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `genericbrowsergame`
--
CREATE DATABASE IF NOT EXISTS `genericbrowsergame` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `genericbrowsergame`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `village`
--

CREATE TABLE `village` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `bunkier` int(11) NOT NULL DEFAULT 1 COMMENT 'Poziom budynku',
  `studnia` int(11) NOT NULL DEFAULT 1 COMMENT 'Poziom budynku',
  `apteka` int(11) NOT NULL DEFAULT 0 COMMENT 'Poziom budynku',
  `farm` int(11) NOT NULL DEFAULT 0 COMMENT 'Poziom budynku'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indeksy dla tabeli `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `village`
--
ALTER TABLE `village`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;