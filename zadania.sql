-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Sty 2021, 18:55
-- Wersja serwera: 10.4.16-MariaDB
-- Wersja PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zadania`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `nazwa_uz` varchar(16) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `haslo` char(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`nazwa_uz`, `haslo`, `email`) VALUES
('piotr', '2287aedfa4ad488cf7e5bd70affb89bc390b7ad2', 'test@mail.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadanie`
--

CREATE TABLE `zadanie` (
  `id` int(11) NOT NULL,
  `nazwa_uz` varchar(16) COLLATE utf8mb4_polish_ci NOT NULL,
  `zadanie` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `termin` date NOT NULL,
  `szacowany_czas` int(11) NOT NULL,
  `kolumna` enum('do_zrobienia','w_trakcie','gotowe','') COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zadanie`
--

INSERT INTO `zadanie` (`id`, `nazwa_uz`, `zadanie`, `termin`, `szacowany_czas`, `kolumna`) VALUES
(2, 'piotr', 'Zrobić zadanie dla Żabola', '2021-02-05', 5, 'do_zrobienia');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`nazwa_uz`);

--
-- Indeksy dla tabeli `zadanie`
--
ALTER TABLE `zadanie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `zadanie`
--
ALTER TABLE `zadanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
