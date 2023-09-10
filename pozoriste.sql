-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 12:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pozoriste`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `ID_KORISNIKA` int(11) NOT NULL,
  `IME` varchar(20) NOT NULL,
  `PREZIME` varchar(20) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID_KORISNIKA`, `IME`, `PREZIME`, `EMAIL`, `STATUS`, `PASSWORD`) VALUES
(1, 'danilo', 'milanovic', 'danilo@gmail.com', 'korisnik', 'daca'),
(3, 'da', 'Milanovic', 'danilomilanovic123@g', 'korisnik', 'dd'),
(4, 'Danilo', 'Milanovic', 'cccc@gmail.com', 'korisnik', 'ccc'),
(5, 'danilo', 'milanovic', 'daca@gmail.com', 'admin', 'daca');

-- --------------------------------------------------------

--
-- Table structure for table `predstave`
--

CREATE TABLE `predstave` (
  `ID_PREDSTAVE` int(11) NOT NULL,
  `NAZIV_PREDSTAVE` varchar(20) NOT NULL,
  `OPIS_PREDSTAVE` varchar(500) DEFAULT NULL,
  `DATUM_PREDSTAVE` datetime NOT NULL,
  `CENA_KARTE` float NOT NULL,
  `broj_mesta` int(11) NOT NULL,
  `imgPutanja` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predstave`
--

INSERT INTO `predstave` (`ID_PREDSTAVE`, `NAZIV_PREDSTAVE`, `OPIS_PREDSTAVE`, `DATUM_PREDSTAVE`, `CENA_KARTE`, `broj_mesta`, `imgPutanja`) VALUES
(1, '\r\nVelika Drama', 'Велика драма је један од најамбициознијих драмских комада Синише Ковачевића, текст на којем је овај познати драмски аутор радио пуних 13 година. Реч је о потресној саги која се бави преиспитивањем наше прошлости и тиме како се овдашњи бурни послератни историјски догађаји преламају кроз појединце и на који начин одређују њихове судбине.', '2023-07-20 17:30:00', 499, 66, 'imghtml/velika_drama.jpg'),
(2, 'Antigona', 'Mит који је Софокле драматизовао у Антигони припада кругу тебанских легенди и не може се наћи у Хомеровим еповима; можда га је Софокле преузео из неког епа за који ми не знамо. После Едиповог одласка из Тебе, његови синови, близанци Полиник и Етеокле, изабрани су за тебанске владаре', '2023-08-21 16:30:00', 599, 16, 'imghtml/antigona.jpg'),
(3, 'Bela Kafa', 'Нови позоришни комад Александра Поповића, Бела кафа, наводи на помисао да се особени позоришни концепт овога угледног аутора мења у најновијем периоду стваралаштва', '2023-08-02 14:30:00', 23, 20, 'imghtml/bela_kafa.jpg'),
(5, 'Aleksandar', 'Слојевита личност Александра Великог, војсковође, полубога, љубавника, освајача света, отвара различите могућности у драматуршком приступу. Александра чине људи који га окружују. Они га праве Великим, стално га уздижу (наводно су сви клечали  када би он пролазио).', '2023-05-26 21:19:00', 522, 195, 'imghtml/Aleksanar.jpg'),
(6, 'Bal pod maskama', ' Опера Бал под маскама спада међу најпопуларније опере Ђузепеа Вердија. Музика опере је управо у сваком такту инспирисана, мелодијска инвенција неисцрпна, мајсторство аутора у убедљивом', '2023-05-29 22:42:00', 600, 199, 'imghtml/bal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recenzija`
--

CREATE TABLE `recenzija` (
  `ID_RECENZIJE` int(11) NOT NULL,
  `ID_PREDSTAVE` int(11) NOT NULL,
  `ID_KORISNIKA` int(11) NOT NULL,
  `OCENA` int(11) NOT NULL,
  `KOMENTAR` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recenzija`
--

INSERT INTO `recenzija` (`ID_RECENZIJE`, `ID_PREDSTAVE`, `ID_KORISNIKA`, `OCENA`, `KOMENTAR`) VALUES
(1, 1, 1, 6, 'dobroje'),
(2, 3, 1, 6, 'dobroje'),
(3, 1, 1, 6, 'darasdf'),
(26, 2, 1, 10, '$komentar'),
(27, 1, 1, 7, ' super'),
(33, 2, 1, 7, ' bas je dobro'),
(35, 1, 1, 7, ' top'),
(41, 2, 5, 9, ' predstava je bas le'),
(42, 2, 5, 5, ' super je prdstava s'),
(43, 2, 5, 5, ' '),
(44, 6, 5, 8, ' ok');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `ID_REZERVACIJE` int(11) NOT NULL,
  `ID_KORISNIKA` int(11) NOT NULL,
  `ID_PREDSTAVE` int(11) NOT NULL,
  `DATUM_REZERVACIJE` datetime NOT NULL,
  `BROJ_KARATA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`ID_REZERVACIJE`, `ID_KORISNIKA`, `ID_PREDSTAVE`, `DATUM_REZERVACIJE`, `BROJ_KARATA`) VALUES
(34, 1, 1, '2023-05-22 12:53:36', 1),
(35, 1, 1, '2023-05-22 12:53:38', 1),
(52, 1, 1, '2023-05-22 15:13:02', 1),
(53, 1, 2, '2023-05-22 15:39:31', 2),
(54, 1, 1, '2023-05-23 17:04:53', 2),
(55, 4, 1, '2023-05-23 17:46:48', 1),
(60, 1, 1, '2023-05-23 21:19:29', 2),
(66, 5, 5, '2023-05-26 16:45:26', 1),
(67, 5, 5, '2023-05-26 16:45:37', 2),
(68, 5, 1, '2023-05-26 16:45:42', 1),
(69, 5, 3, '2023-05-26 16:45:57', 1),
(70, 1, 1, '2023-05-26 23:59:16', 2),
(71, 1, 1, '2023-05-27 00:00:19', 2),
(72, 1, 1, '2023-05-27 00:00:20', 2),
(73, 1, 1, '2023-05-27 00:00:20', 2),
(74, 1, 1, '2023-05-27 00:00:20', 2),
(75, 1, 1, '2023-05-28 18:40:02', 1),
(76, 1, 1, '2023-05-28 18:47:21', 2),
(77, 1, 2, '2023-05-28 18:49:45', 1),
(79, 1, 1, '2023-05-28 18:50:03', 1),
(80, 1, 1, '2023-05-28 18:50:12', 1),
(81, 5, 6, '2023-05-28 21:02:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sedista`
--

CREATE TABLE `sedista` (
  `ID_SEDISTA` int(11) NOT NULL,
  `ID_REZERVACIJE` int(11) NOT NULL,
  `REDNI_BROJ` int(11) NOT NULL,
  `SALA` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`ID_KORISNIKA`);

--
-- Indexes for table `predstave`
--
ALTER TABLE `predstave`
  ADD PRIMARY KEY (`ID_PREDSTAVE`);

--
-- Indexes for table `recenzija`
--
ALTER TABLE `recenzija`
  ADD PRIMARY KEY (`ID_RECENZIJE`),
  ADD KEY `FK_RELATIONSHIP_4` (`ID_KORISNIKA`),
  ADD KEY `FK_RELATIONSHIP_5` (`ID_PREDSTAVE`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`ID_REZERVACIJE`),
  ADD KEY `FK_PREDSTAVA_REZERVACIJA` (`ID_PREDSTAVE`),
  ADD KEY `FK_RELATIONSHIP_2` (`ID_KORISNIKA`);

--
-- Indexes for table `sedista`
--
ALTER TABLE `sedista`
  ADD PRIMARY KEY (`ID_SEDISTA`),
  ADD KEY `FK_RELATIONSHIP_3` (`ID_REZERVACIJE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `ID_KORISNIKA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `predstave`
--
ALTER TABLE `predstave`
  MODIFY `ID_PREDSTAVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recenzija`
--
ALTER TABLE `recenzija`
  MODIFY `ID_RECENZIJE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `ID_REZERVACIJE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `sedista`
--
ALTER TABLE `sedista`
  MODIFY `ID_SEDISTA` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recenzija`
--
ALTER TABLE `recenzija`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_KORISNIKA`) REFERENCES `korisnik` (`ID_KORISNIKA`),
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`ID_PREDSTAVE`) REFERENCES `predstave` (`ID_PREDSTAVE`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `FK_PREDSTAVA_REZERVACIJA` FOREIGN KEY (`ID_PREDSTAVE`) REFERENCES `predstave` (`ID_PREDSTAVE`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_KORISNIKA`) REFERENCES `korisnik` (`ID_KORISNIKA`);

--
-- Constraints for table `sedista`
--
ALTER TABLE `sedista`
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_REZERVACIJE`) REFERENCES `rezervacija` (`ID_REZERVACIJE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
