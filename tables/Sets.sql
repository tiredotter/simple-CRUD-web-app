-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 24 Sty 2023, 13:10
-- Wersja serwera: 8.0.25
-- Wersja PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `21_bojarski`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Sets`
--

CREATE TABLE `Sets` (
  `Set_ID` int NOT NULL,
  `Set_Name` char(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `Set_Content` char(255) COLLATE utf8_polish_ci NOT NULL,
  `Author_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Sets`
--

INSERT INTO `Sets` (`Set_ID`, `Set_Name`, `Set_Content`, `Author_ID`) VALUES
(7, 'sos', 'Napisz skrypt, który zaplanuje uruchomienie skryptu na zdalnym serwerze. Skrypt przyjmuje dwa argumenty: scie ´ zk˛e do ˙\r\npliku ze skryptem i czas w notacji programu at.', 8),
(10, 'zakupy', 'musze isc na zakupuy kiedys', 4),
(11, 'Hej!', ';*', 8);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Sets`
--
ALTER TABLE `Sets`
  ADD PRIMARY KEY (`Set_ID`),
  ADD KEY `Author_ID` (`Author_ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `Sets`
--
ALTER TABLE `Sets`
  MODIFY `Set_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Sets`
--
ALTER TABLE `Sets`
  ADD CONSTRAINT `Sets_ibfk_1` FOREIGN KEY (`Author_ID`) REFERENCES `Users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
