-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Júl 09. 17:24
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `termek_rendeles_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `felh_nev` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(150) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jogosultsag` smallint(6) NOT NULL DEFAULT 0 COMMENT '0 - vásárló | 1 - dolgozó | 2 - admin',
  `telj_nev` varchar(150) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `cim` varchar(200) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `szin_tema` int(11) NOT NULL DEFAULT 0 COMMENT '0 - világos | 1 - sötét'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `felh_nev`, `jelszo`, `jogosultsag`, `telj_nev`, `email`, `cim`, `szin_tema`) VALUES
(1, 'elso_user', '$2y$10$54WNj4rq0YYI3kQautNn4ei/7ZqRPodW9rNwsz0oaDY4CtOY3MTI.', 2, 'Első Felhasználó', 'valami@example.com', 'Budapest, Hős utca 21.', 1),
(2, 'masodik_user', '$2y$10$HlLPtckv.FXOdAbLiD9PxuCp0RAibmNvlXnM1j8BhEhbRwX0PbyS2', 1, 'Második Felhasználó', 'masodik@example.com', 'Budapest, Hős utca 20.', 1),
(3, 'harmadik_user', '$2y$10$LWHqmO3UhO3QNoG3zbbv.eUtATlyUPxIyzWAkEpoUxy8aQXIAMHl2', 0, 'Hármaska', 'harmadik@example.com', 'Budapest, Hős utca 5.', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles`
--

CREATE TABLE `rendeles` (
  `id` int(11) NOT NULL,
  `rendelo_id` int(11) NOT NULL,
  `szallitasi_cim` varchar(200) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `rendeles_idopontja` datetime NOT NULL DEFAULT current_timestamp(),
  `megjegyzes` text COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `rendeles`
--

INSERT INTO `rendeles` (`id`, `rendelo_id`, `szallitasi_cim`, `rendeles_idopontja`, `megjegyzes`) VALUES
(1, 1, 'Budapest, Hős utca 11', '2021-05-18 15:21:03', ''),
(2, 1, 'Budapest, Hős utca 11', '2021-05-18 15:22:07', ''),
(3, 2, 'Budapest, Hős utca 13', '2021-06-01 15:21:47', 'Valami megjegyzés');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles_tetel`
--

CREATE TABLE `rendeles_tetel` (
  `id` int(11) NOT NULL,
  `rendeles_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `darab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `rendeles_tetel`
--

INSERT INTO `rendeles_tetel` (`id`, `rendeles_id`, `termek_id`, `darab`) VALUES
(1, 2, 1, 2),
(2, 2, 2, 1),
(3, 3, 3, 2),
(4, 3, 4, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek`
--

CREATE TABLE `termek` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `leiras` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `kep` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ar` int(11) NOT NULL,
  `kiemelt` tinyint(1) NOT NULL DEFAULT 0,
  `arhiv` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `termek`
--

INSERT INTO `termek` (`id`, `nev`, `leiras`, `kep`, `ar`, `kiemelt`, `arhiv`) VALUES
(1, 'Random termék', 'Ne vedd meg! Nem éri meg!', 'random_termek_2021_02_23_04_21_17.jpg', 123456, 0, 1),
(2, 'Elefánt', 'Igen jól látod egy elefánt. Nem tudom miért akarnád megvenni.', 'elefant_2021_03_02_03_03_03.jpg', 9999999, 1, 0),
(3, 'Kék narancs', 'Kékre festett narancs. Nem tudjuk mire gondolt a művész amikor ezt készítette.', 'kek_narancs_2021_03_02_03_03_58.jpeg', 1499, 0, 1),
(4, 'Egér', 'Ez egy számítógépes egér. Nem, ez nem egy hörcsög bármennyire is úgy néz ki. Igen mondom én, hogy egér.', 'eger_2021_03_02_03_05_11.png', 14999, 0, 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendelo_id` (`rendelo_id`);

--
-- A tábla indexei `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendeles_id` (`rendeles_id`),
  ADD KEY `termek_id` (`termek_id`);

--
-- A tábla indexei `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `rendeles`
--
ALTER TABLE `rendeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `termek`
--
ALTER TABLE `termek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `rendeles`
--
ALTER TABLE `rendeles`
  ADD CONSTRAINT `rendeles_ibfk_1` FOREIGN KEY (`rendelo_id`) REFERENCES `felhasznalo` (`id`);

--
-- Megkötések a táblához `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  ADD CONSTRAINT `rendeles_tetel_ibfk_1` FOREIGN KEY (`rendeles_id`) REFERENCES `rendeles` (`id`),
  ADD CONSTRAINT `rendeles_tetel_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `termek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
