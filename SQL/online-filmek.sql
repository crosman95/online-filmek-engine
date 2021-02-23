-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2020. Dec 22. 14:25
-- Kiszolgáló verziója: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- PHP verzió: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `online-filmek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bekuldott_filmek`
--

CREATE TABLE `bekuldott_filmek` (
  `id` int(11) NOT NULL,
  `db_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cim` text COLLATE utf8_unicode_ci NOT NULL,
  `eredeti_cim` text COLLATE utf8_unicode_ci NOT NULL,
  `leiras` text COLLATE utf8_unicode_ci NOT NULL,
  `megjelenes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hossza` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ertekeles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kategoria` text COLLATE utf8_unicode_ci NOT NULL,
  `kep` text COLLATE utf8_unicode_ci NOT NULL,
  `film_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `felhasznalo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ellenorzes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keresre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `datum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `szuletesi_datum` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kedvenc_film` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `hirlevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `leiras` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_kulcs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `datum`, `username`, `jelszo`, `email`, `rang`, `avatar`, `szuletesi_datum`, `kedvenc_film`, `hirlevel`, `leiras`, `api_kulcs`, `user_id`) VALUES
(1, '2020.12.01', 'username', 'md5_jelszo', 'noreply@localhost.hu', '10', 'img/avatars/3.png', '', '', 'true', '', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filmek`
--

CREATE TABLE `filmek` (
  `id` int(11) NOT NULL,
  `cim` text COLLATE utf8_unicode_ci NOT NULL,
  `leiras` text COLLATE utf8_unicode_ci NOT NULL,
  `megjelenes` text COLLATE utf8_unicode_ci NOT NULL,
  `kategoria` text COLLATE utf8_unicode_ci NOT NULL,
  `kep` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tábla szerkezet ehhez a táblához `film_keres`
--

CREATE TABLE `film_keres` (
  `id` int(11) NOT NULL,
  `db_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cim` text COLLATE utf8_unicode_ci NOT NULL,
  `eredeti_cim` text COLLATE utf8_unicode_ci NOT NULL,
  `leiras` text COLLATE utf8_unicode_ci NOT NULL,
  `megjelenes` text COLLATE utf8_unicode_ci NOT NULL,
  `hossza` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ertekeles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kategoria` text COLLATE utf8_unicode_ci NOT NULL,
  `kep` text COLLATE utf8_unicode_ci NOT NULL,
  `film_link` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `felhasznalo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allapot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teljesitette` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `film_keres`
--

INSERT INTO `film_keres` (`id`, `db_id`, `cim`, `eredeti_cim`, `leiras`, `megjelenes`, `hossza`, `ertekeles`, `kategoria`, `kep`, `film_link`, `felhasznalo`, `allapot`, `teljesitette`) VALUES
(1, '238', 'A keresztapa', 'The Godfather', 'Vito Corleone mindennél fontosabbnak tartja a családot. Emellett a New York-i olasz maffia rettegett keresztapja, aki élet és halál kérdéséről dönt. Lassan azonban gondolnia kell arra, hogy melyik fiának adja át a hatalmat. Sonny forrófejű, Fredo komolytalan, Michael pedig háborús hős, aki mostanáig távol tartotta magát az üzlettől. A kábítószer azonban szembefordítja egymással a régi és a feltörekvő gengsztereket.', '1972', ' 2 óra 55 perc', '8.7', 'Dráma, Bűnügyi', 'https://image.tmdb.org/t/p/original/3wKAcgLPLhzvcdC4MAJDe7QMek7.jpg', NULL, 'crosman', 'false', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hibas_linkek`
--

CREATE TABLE `hibas_linkek` (
  `id` int(11) NOT NULL,
  `film_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `film_cim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hiba` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzaszolasok`
--

CREATE TABLE `hozzaszolasok` (
  `id` int(11) NOT NULL,
  `film_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nev` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hozzaszolas` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uj_filmek`
--

CREATE TABLE `uj_filmek` (
  `id` int(11) NOT NULL,
  `db_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eredeti_cim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `leiras` text COLLATE utf8_unicode_ci NOT NULL,
  `megjelenes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hossza` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ertekeles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kategoria` text COLLATE utf8_unicode_ci NOT NULL,
  `kep` text COLLATE utf8_unicode_ci NOT NULL,
  `film_link` text COLLATE utf8_unicode_ci NOT NULL,
  `megjelenhet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `felhasznalo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `uj_filmek`
--

INSERT INTO `uj_filmek` (`id`, `db_id`, `cim`, `eredeti_cim`, `leiras`, `megjelenes`, `hossza`, `ertekeles`, `kategoria`, `kep`, `film_link`, `megjelenhet`, `felhasznalo`) VALUES
(3, '398978', 'Az ír', 'The Irishman', 'Pennsylvania, 1956. Frank Sheeran, ír származású háborús veterán, aki teherautó-sofőrként dolgozik, véletlenül találkozik Russell Bufalino gengszterrel. Amint Frank megbízható emberévé válik, Bufalino elküldi őt Chicagóba azzal a feladattal, hogy segítsen Jimmy Hoffának, a szervezett bűnözéshez kapcsolódó hatalmas szakszervezeti vezetőnek, akivel Frank közel húsz évig szoros barátságot fog fenntartani.', '2019', '3 óra 29 perc', '7.7', 'Bűnügyi, Dráma, Történelmi', 'https://image.tmdb.org/t/p/original/xjL9g7oBu4PszFiICem4YAMh8YN.jpg', 'http://url.crosman-web.hu/index.php?code=19464', 'true', 'crosman');
--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bekuldott_filmek`
--
ALTER TABLE `bekuldott_filmek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `filmek`
--
ALTER TABLE `filmek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `film_keres`
--
ALTER TABLE `film_keres`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hibas_linkek`
--
ALTER TABLE `hibas_linkek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `uj_filmek`
--
ALTER TABLE `uj_filmek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bekuldott_filmek`
--
ALTER TABLE `bekuldott_filmek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `filmek`
--
ALTER TABLE `filmek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `film_keres`
--
ALTER TABLE `film_keres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `hibas_linkek`
--
ALTER TABLE `hibas_linkek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `uj_filmek`
--
ALTER TABLE `uj_filmek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
