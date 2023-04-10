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
-- Struktura tabeli dla tabeli `Passwords`
--

CREATE TABLE `Passwords` (
  `User_ID` int NOT NULL,
  `Pass` char(128) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Passwords`
--

INSERT INTO `Passwords` (`User_ID`, `Pass`) VALUES
(4, '$2y$10$NaepN7huvfT9DZP01VeJmulCcmPVHZfWIO7j3iQqoaT.yl3eDS7Tm'),
(5, '$2y$10$ANpnaE3.tC6XIeH3NiqYWePG3k3Uv0tRpJXdj3e8p4LWlTLDxnXie'),
(6, '$2y$10$I6CvTZNpE9g4WkPKhZK9JuZ19zOP7ZICb6g49a7boNfdpB4rd1eZa'),
(7, '$2y$10$KRgP1e4K.c3JuplyyVxr7.9r0z8u.9LeNl9ejAGu/OK8seaa2x0ra'),
(8, '$2y$10$dTHvv1o3wVnooHpNVF0QYudjBicJruKwnBHmCr4QVeYNenl8weQTa'),
(9, '$2y$10$.cnZ5r9XoGodboapzfo/oubAH9ORhgZzu/79pP9CPH3m87Xa5Eyty'),
(10, '$2y$10$dvToLWD7BI7uYxvz8bKU4OOsUkUdynFy8pa7SSXi6TM5AOs.qtbpy');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Passwords`
--
ALTER TABLE `Passwords`
  ADD PRIMARY KEY (`User_ID`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Passwords`
--
ALTER TABLE `Passwords`
  ADD CONSTRAINT `Passwords_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
