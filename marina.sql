-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Cze 2022, 01:40
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `marina`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `boats`
--

CREATE TABLE `boats` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `mmsi` int(9) DEFAULT NULL,
  `opis` text COLLATE utf8_polish_ci DEFAULT NULL,
  `dlugosc` float(5,2) NOT NULL,
  `szerokosc` float(5,2) NOT NULL,
  `zanurzenie` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `boats`
--

INSERT INTO `boats` (`id`, `userid`, `nazwa`, `mmsi`, `opis`, `dlugosc`, `szerokosc`, `zanurzenie`) VALUES
(14, 2, 'Atlantyda3', 111111111, '', 1.00, 1.00, 1.00),
(15, 2, 'Test', 123123122, 'Opis', 12.20, 13.50, 11.00),
(17, 2, 'Neptun2', NULL, '', 1.00, 1.00, 1.00),
(21, 2, 'Nowa', 123123123, 'Opis', 1.00, 2.00, 3.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `place`
--

CREATE TABLE `place` (
  `number` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci DEFAULT NULL,
  `isTaken` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `place`
--

INSERT INTO `place` (`number`, `name`, `description`, `isTaken`) VALUES
(1, 'Miejsce 1', 'dla jednostek o wymiarach maxymalnych dł. 12m, szer. 6m', 1),
(2, 'Miejsce 2', 'Dla małych jednostek', 1),
(3, 'Miejsce 3', 'Dla średnich jednostek', 0),
(4, 'Miejsce 4', NULL, 0),
(5, 'Miejsce 5', NULL, 1),
(6, 'Miejsce 6', NULL, 0),
(7, 'Miejsce 7', NULL, 0),
(8, 'Miejsce 8', NULL, 1),
(9, 'Miejsce 20', NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `pesel` varchar(11) COLLATE utf8_polish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstName`, `lastName`, `email`, `pesel`, `created_at`) VALUES
(2, 'jakub', '$2y$10$bkVn3sDWgWoqdkLW/ZhhJOa7ykBMGSuF2/B/b0T5tm1D1q.NkMJAm', 'Jakub', 'Kleban', 'jakub.kleban2000@gmail.com', NULL, '2022-06-02 22:11:46'),
(5, 'kuba', '$2y$10$eCA89zoxlA5FQepZGZafbupySguV2JsNhKtP9m208LOGWm3myaIXa', 'Kuba', 'Kleban', 'kuba@gmail.com', NULL, '2022-06-02 22:13:11'),
(6, 'lukasz', '$2y$10$JPTjI80eoj039/jUZmLjI.13umd2lMHQuUiph3srTpGuWcAhfGh42', 'Łukasz', 'Kaszewski', 'lukasz@com.pl', NULL, '2022-06-10 21:37:03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wintering`
--

CREATE TABLE `wintering` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `boatId` int(11) NOT NULL,
  `placeNumber` int(11) NOT NULL,
  `startDate` date NOT NULL DEFAULT current_timestamp(),
  `endDate` date NOT NULL,
  `status` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wintering`
--

INSERT INTO `wintering` (`id`, `userId`, `boatId`, `placeNumber`, `startDate`, `endDate`, `status`) VALUES
(10, 2, 21, 2, '2022-06-13', '2022-06-17', 'Requested'),
(11, 2, 21, 1, '2022-06-19', '2022-06-26', 'Requested'),
(12, 2, 14, 5, '2022-06-22', '2022-06-30', 'Requested'),
(13, 2, 17, 8, '2022-06-15', '2022-06-24', 'Requested');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `boats`
--
ALTER TABLE `boats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indeksy dla tabeli `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`number`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeksy dla tabeli `wintering`
--
ALTER TABLE `wintering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boat` (`boatId`),
  ADD KEY `place` (`placeNumber`),
  ADD KEY `user` (`userId`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `boats`
--
ALTER TABLE `boats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `place`
--
ALTER TABLE `place`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `wintering`
--
ALTER TABLE `wintering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `boats`
--
ALTER TABLE `boats`
  ADD CONSTRAINT `boats_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `wintering`
--
ALTER TABLE `wintering`
  ADD CONSTRAINT `boat` FOREIGN KEY (`boatId`) REFERENCES `boats` (`id`),
  ADD CONSTRAINT `place` FOREIGN KEY (`placeNumber`) REFERENCES `place` (`number`),
  ADD CONSTRAINT `user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
