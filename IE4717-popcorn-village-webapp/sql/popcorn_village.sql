-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 03:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `popcorn_village`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `rid` int(10) UNSIGNED NOT NULL,
  `email` text NOT NULL,
  `custname` text NOT NULL,
  `username` text DEFAULT NULL,
  `spendings` float(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`rid`, `email`, `custname`, `username`, `spendings`) VALUES
(1000, 'tom@localhost', 'Tom', 'tom265', 50.30),
(1001, 'xyc@gmail.com', 'Jerry', 'jerry512', 30.20),
(1002, 'npc@yahoo.sg', 'Ben', 'ben10', 10.40),
(1003, 'popcorn@localhost', 'noDIscount', '', 76.20),
(1004, 'popcorn_village@localhost', 'test', '', 31.20),
(1005, 'demo@localhost', 'aaaaaaaaaa', 'demo1', 15.60);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `mid` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `thumbnail` text NOT NULL,
  `trailer` text NOT NULL,
  `genre` text NOT NULL,
  `rating` text NOT NULL,
  `duration` text NOT NULL,
  `sypnosis` text NOT NULL,
  `director` text NOT NULL,
  `casts` text NOT NULL,
  `release_on` date NOT NULL,
  `price` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`mid`, `title`, `thumbnail`, `trailer`, `genre`, `rating`, `duration`, `sypnosis`, `director`, `casts`, `release_on`, `price`) VALUES
(2001, 'Hamilton', 'https://m.media-amazon.com/images/M/MV5BNjViNWRjYWEtZTI0NC00N2E3LTk0NGQtMjY4NTM3OGNkZjY0XkEyXkFqcGdeQXVyMjUxMTY3ODM@._V1_.jpg', 'https://www.youtube.com/embed/DSCKfXpAGHc', 'Biography, Drama, History', 'PG-13', '2h 40min', 'The real life of one of America\'s foremost founding fathers and first Secretary of the Treasury, Alexander Hamilton. Captured live on Broadway from the Richard Rodgers Theater with the original Broadway cast. \"Hamilton\" is the story of America then, told by America now.', 'Thomas Kail', 'Lin-Manuel Miranda, Phillipa Soo, Leslie Odom Jr, Renee Elise Goldsberry, Daveed Diggs', '2000-10-31', 10.40),
(2101, 'Spider-Man: No way Home', 'https://m.media-amazon.com/images/M/MV5BZWMyYzFjYTYtNTRjYi00OGExLWE2YzgtOGRmYjAxZTU3NzBiXkEyXkFqcGdeQXVyMzQ0MzA0NTM@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/JfVOs4VSpmA', 'Action, Adventure, Fantasy', 'PG-13', '2h 28min', 'With Spider-Man\'s identity now revealed, our friendly neighborhood web-slinger is unmasked and no longer able to separate his normal life as Peter Parker from the high stakes of being a superhero. When Peter asks for help from Doctor Strange, the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.', 'Jon Watts', 'Tom Holland, Zendaya, Benedict Cumberbatch, Jacob Batalon, Jon Favreau', '2000-10-31', 10.40),
(2102, 'Raya and the Last Dragon', 'https://m.media-amazon.com/images/M/MV5BZWNiOTc4NGItNGY4YS00ZGNkLThkOWEtMDE2ODcxODEwNjkwXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/1VIZ89FEjYI', 'Animation, Action, Adventure', 'PG', '1hr 47min', 'Long ago, in the fantasy world of Kumandra, humans and dragons lived together in harmony. However, when sinister monsters known as the Druun threatened the land, the dragons sacrificed themselves to save humanity. Now, 500 years later, those same monsters have returned, and it\'s up to a lone warrior to track down the last dragon and stop the Druun for good.', 'Don Hall, Carlos Lopez Estrada', 'Kelly Marie Tran, Awkwafina, Gemma Chan, Izaac Wang, Daniel Dae Kim', '2000-10-31', 11.20),
(2103, 'Shang-Chi and the Legend of the Ten Rings', 'https://image.tmdb.org/t/p/original/1BIoJGKbXjdFDAqUEiA2VHqkK1Z.jpg', 'https://www.youtube.com/embed/8YjFbMbfXaQ', 'Action, Adventure, Fantasy', 'PG-13', '2h 12min', 'Martial-arts master Shang-Chi confronts the past he thought he left behind when he\'s drawn into the web of the mysterious Ten Rings organization.', 'Destin Daniel Cretton', 'Simu Liu, Awkwafina, Tony Chiu-Wai Leung, Ben Kingsley, Meng\'er Zhang, Fala Chen', '2000-10-31', 10.40),
(2104, 'In the Heights', 'https://www.posterhub.com.sg/images/detailed/121/111763_In_the_Heights_Final.jpg', 'https://www.youtube.com/embed/U0CL-ZSuCrQ', 'Drama, Musical, Romance', 'PG-13', '2h 23min', 'In Washington Heights, N.Y., the scent of warm coffee hangs in the air just outside of the 181st St. subway stop, where a kaleidoscope of dreams rallies a vibrant and tight-knit community. At the intersection of it all is a likable and magnetic bodega owner who hopes, imagines and sings about a better life.', 'Jon M. Chu', 'Anthony Ramos, Corey Hawkins, Leslie Grace, Melissa Barrera, Olga Merediz, Jimmy Smits', '2000-10-31', 12.10),
(2201, 'Top Gun: Maverick', 'https://www.posterhub.com.sg/images/detailed/129/111834_Top_Gun_Maverick_Final.jpeg', 'https://www.youtube.com/embed/giXco2jaZ_4', 'Action, Drama', 'PG-13', '2h 10min', 'After more than 30 years of service as one of the Navy\'s top aviators, Pete \"Maverick\" Mitchell is where he belongs, pushing the envelope as a courageous test pilot and dodging the advancement in rank that would ground him. Training a detachment of graduates for a special assignment, Maverick must confront the ghosts of his past and his deepest fears, culminating in a mission that demands the ultimate sacrifice from those who choose to fly it.', 'Joseph Kosinski', 'Tom Cruise, Jennifer Connelly, Miles Teller, Val Kilmer, Bashir Salahud', '2050-10-31', 10.40),
(2202, 'Black Adam', 'https://m.media-amazon.com/images/M/MV5BYzZkOGUwMzMtMTgyNS00YjFlLTg5NzYtZTE3Y2E5YTA5NWIyXkEyXkFqcGdeQXVyMjkwOTAyMDU@._V1_.jpg', 'https://www.youtube.com/embed/X0tOpBuYasI', 'Action, Adventure, Fantasy', 'PG-13', '2h 5min', 'In ancient Kahndaq, Teth Adam was bestowed the almighty powers of the gods. After using these powers for vengeance, he was imprisoned, becoming Black Adam. Nearly 5,000 years have passed, and Black Adam has gone from man to myth to legend. Now free, his unique form of justice, born out of rage, is challenged by modern-day heroes who form the Justice Society: Hawkman, Dr. Fate, Atom Smasher and Cyclone.', 'Jaume Collet-Serra', 'Dwayne Johnson, Aldis Hodge, Pierce Brosnan, Noah Centineo, Sarah Shahi, Quintessa Swindell', '2050-10-31', 10.40),
(2203, 'Turning Red', 'https://m.media-amazon.com/images/M/MV5BOWYxZDMxYWUtNjNiZC00MDE1LWI2Y2QtNWZhNDAyMGY5ZjVhXkEyXkFqcGdeQXVyODE5NzE3OTE@._V1_.jpg', 'https://www.youtube.com/embed/XdKzUbAiswE', 'Animation, Adventure, Comedy', 'PG', '1hr 40min', 'A thirteen-year-old girl is torn between staying her mother\'s dutiful daughter and the changes of adolescence. And as if the challenges were not enough, whenever she gets overly excited she transforms into a giant red panda.', 'Domee Shi', 'Rosalie Chiang, Sandra Oh, Ava Morse, Hyein Park, Maitreyi Ramakrishnan, Orion Lee', '2050-10-31', 11.20);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `tid` int(10) UNSIGNED NOT NULL,
  `rid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `seat` text NOT NULL,
  `moviedate` date NOT NULL,
  `movietime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`tid`, `rid`, `mid`, `seat`, `moviedate`, `movietime`) VALUES
(1, 1000, 2101, 'A1', '2022-11-01', '14:30:00'),
(2, 1000, 2101, 'A2', '2022-11-01', '14:30:00'),
(3, 1001, 2103, 'F3', '2022-11-05', '20:30:00'),
(4, 1002, 2201, 'G5', '2022-11-07', '16:30:00'),
(5, 1002, 2202, 'H1', '2022-11-08', '16:30:00'),
(6, 1003, 2101, 'E6', '2022-10-31', '14:30:00'),
(7, 1003, 2101, 'E7', '2022-10-31', '14:30:00'),
(8, 1003, 2104, 'F8', '2022-11-04', '16:30:00'),
(9, 1003, 2104, 'F9', '2022-11-04', '16:30:00'),
(10, 1003, 2103, 'D5', '2022-10-31', '16:40:00'),
(11, 1003, 2103, 'D6', '2022-10-31', '16:40:00'),
(12, 1003, 2103, 'D7', '2022-10-31', '16:40:00'),
(13, 1004, 2101, 'E5', '2022-10-31', '16:30:00'),
(14, 1004, 2101, 'E6', '2022-10-31', '16:30:00'),
(15, 1004, 2101, 'E7', '2022-10-31', '16:30:00'),
(16, 1005, 2001, 'D8', '2022-10-31', '16:30:00'),
(17, 1005, 2001, 'D9', '2022-10-31', '16:30:00'),
(18, 1005, 2001, 'D10', '2022-10-31', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `stid` int(10) UNSIGNED NOT NULL,
  `mid` int(10) UNSIGNED NOT NULL,
  `takenseats` text NOT NULL,
  `dayofweek` text NOT NULL,
  `timeslot` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`stid`, `mid`, `takenseats`, `dayofweek`, `timeslot`) VALUES
(200101, 2001, 'E1 E10', 'Mon', '13:30:00'),
(200102, 2001, 'F6 F7 F8 D8 D9 D10', 'Mon', '16:30:00'),
(200103, 2001, 'G2 G12', 'Mon', '20:00:00'),
(200104, 2001, 'G4 G14', 'Mon', '23:00:00'),
(200105, 2001, 'A1 A9', 'Tue', '13:00:00'),
(200106, 2001, 'B2', 'Tue', '16:00:00'),
(200107, 2001, 'C7', 'Tue', '19:00:00'),
(200108, 2001, 'B1 B2 B3', 'Tue', '22:00:00'),
(200109, 2001, 'C1 C2 C3', 'Wed', '12:00:00'),
(200110, 2001, 'D1 D2', 'Wed', '15:00:00'),
(200111, 2001, 'E5', 'Wed', '18:00:00'),
(200112, 2001, 'F8', 'Wed', '21:00:00'),
(200113, 2001, 'G2 G3', 'Thu', '13:00:00'),
(200114, 2001, 'A10 A11', 'Thu', '16:00:00'),
(200115, 2001, 'B8 B9', 'Thu', '19:00:00'),
(200116, 2001, 'A1 A9', 'Thu', '22:00:00'),
(200117, 2001, 'B2', 'Fri', '13:30:00'),
(200118, 2001, 'C7', 'Fri', '16:30:00'),
(200119, 2001, 'D8', 'Fri', '20:00:00'),
(200120, 2001, 'E1 E10', 'Fri', '23:00:00'),
(200121, 2001, 'F8', 'Sat', '12:00:00'),
(200122, 2001, 'F8', 'Sat', '15:00:00'),
(200123, 2001, 'F8', 'Sat', '18:00:00'),
(200124, 2001, 'F8', 'Sat', '21:00:00'),
(200125, 2001, 'C7', 'Sun', '11:00:00'),
(200126, 2001, 'B1 B2 B3', 'Sun', '14:00:00'),
(200127, 2001, 'C1 C2 C3', 'Sun', '17:00:00'),
(200128, 2001, 'D1 D2', 'Sun', '20:00:00'),
(210101, 2101, 'A1 A2 A3 E6 E7', 'Mon', '14:30:00'),
(210102, 2101, 'B1 B2 B3 E5 E6 E7', 'Mon', '16:30:00'),
(210103, 2101, 'C1 C2 C3', 'Mon', '20:30:00'),
(210104, 2101, 'D1 D2', 'Mon', '22:50:00'),
(210105, 2101, 'E5', 'Tue', '14:00:00'),
(210106, 2101, 'F8', 'Tue', '16:00:00'),
(210107, 2101, 'G2 G3', 'Tue', '20:00:00'),
(210108, 2101, 'A10 A11', 'Tue', '22:00:00'),
(210109, 2101, 'B8 B9', 'Wed', '14:30:00'),
(210110, 2101, 'C5 C6 C7 C8', 'Wed', '16:30:00'),
(210111, 2101, 'D13', 'Wed', '20:30:00'),
(210112, 2101, 'E11 E12', 'Wed', '22:50:00'),
(210113, 2101, 'F10 F11', 'Thu', '14:30:00'),
(210114, 2101, 'G9 G10', 'Thu', '16:30:00'),
(210115, 2101, 'A5', 'Thu', '20:30:00'),
(210116, 2101, 'B3 B4', 'Thu', '22:50:00'),
(210117, 2101, 'C10 C11 C12', 'Fri', '14:00:00'),
(210118, 2101, 'D14', 'Fri', '16:00:00'),
(210119, 2101, 'E2 E3', 'Fri', '20:00:00'),
(210120, 2101, 'F1 F2 F3', 'Fri', '22:00:00'),
(210121, 2101, 'G4 G14', 'Sat', '14:30:00'),
(210122, 2101, 'A1 A9', 'Sat', '16:30:00'),
(210123, 2101, 'B2', 'Sat', '20:30:00'),
(210124, 2101, 'C7', 'Sat', '22:50:00'),
(210125, 2101, 'D8', 'Sun', '14:00:00'),
(210126, 2101, 'E1 E10', 'Sun', '16:00:00'),
(210127, 2101, 'F6 F7 F8', 'Sun', '20:00:00'),
(210128, 2101, 'G2 G12', 'Sun', '22:00:00'),
(210201, 2102, 'E5', 'Mon', '14:40:00'),
(210202, 2102, 'B1 B2 B3', 'Mon', '16:40:00'),
(210203, 2102, 'C1 C2 C3', 'Mon', '20:40:00'),
(210204, 2102, 'D13', 'Mon', '22:40:00'),
(210205, 2102, 'E11 E12', 'Tue', '14:10:00'),
(210206, 2102, 'F10 F11', 'Tue', '16:10:00'),
(210207, 2102, 'G2 G3', 'Tue', '20:10:00'),
(210208, 2102, 'A10 A11', 'Tue', '22:10:00'),
(210209, 2102, 'B8 B9', 'Wed', '14:40:00'),
(210210, 2102, 'E1 E10', 'Wed', '16:40:00'),
(210211, 2102, 'F6 F7 F8', 'Wed', '20:40:00'),
(210212, 2102, 'G2 G12', 'Wed', '22:40:00'),
(210213, 2102, 'G4 G14', 'Thu', '14:40:00'),
(210214, 2102, 'A1 A9', 'Thu', '16:40:00'),
(210215, 2102, 'B2', 'Thu', '20:40:00'),
(210216, 2102, 'C7', 'Thu', '22:40:00'),
(210217, 2102, 'B1 B2 B3', 'Fri', '14:10:00'),
(210218, 2102, 'C1 C2 C3', 'Fri', '16:10:00'),
(210219, 2102, 'D1 D2', 'Fri', '20:10:00'),
(210220, 2102, 'E5', 'Fri', '22:10:00'),
(210221, 2102, 'F8', 'Sat', '14:40:00'),
(210222, 2102, 'G2 G3', 'Sat', '16:40:00'),
(210223, 2102, 'A10 A11', 'Sat', '20:40:00'),
(210224, 2102, 'B8 B9', 'Sat', '22:40:00'),
(210225, 2102, 'A1 A9', 'Sun', '14:10:00'),
(210226, 2102, 'B2', 'Sun', '16:10:00'),
(210227, 2102, 'C7', 'Sun', '20:10:00'),
(210228, 2102, 'D8', 'Sun', '22:10:00'),
(210301, 2103, 'E1 E10', 'Mon', '14:20:00'),
(210302, 2103, 'F8 D5 D6 D7', 'Mon', '16:40:00'),
(210303, 2103, 'F8', 'Mon', '20:20:00'),
(210304, 2103, 'F8', 'Mon', '22:40:00'),
(210305, 2103, 'F8', 'Tue', '14:10:00'),
(210306, 2103, 'C7', 'Tue', '16:40:00'),
(210307, 2103, 'B1 B2 B3', 'Tue', '20:10:00'),
(210308, 2103, 'C1 C2 C3', 'Tue', '22:40:00'),
(210309, 2103, 'D1 D2', 'Wed', '14:00:00'),
(210310, 2103, 'E1 E10', 'Wed', '17:00:00'),
(210311, 2103, 'F8', 'Wed', '19:30:00'),
(210312, 2103, 'F8', 'Wed', '22:30:00'),
(210313, 2103, 'G2 G3', 'Thu', '14:15:00'),
(210314, 2103, 'A10 A11', 'Thu', '17:15:00'),
(210315, 2103, 'B8 B9', 'Thu', '20:00:00'),
(210316, 2103, 'A1 A9', 'Thu', '22:30:00'),
(210317, 2103, 'G2 G12', 'Fri', '14:00:00'),
(210318, 2103, 'G4 G14', 'Fri', '17:00:00'),
(210319, 2103, 'A1 A9', 'Fri', '19:30:00'),
(210320, 2103, 'B2', 'Fri', '22:30:00'),
(210321, 2103, 'C7', 'Sat', '14:20:00'),
(210322, 2103, 'B1 B2 B3', 'Sat', '16:40:00'),
(210323, 2103, 'G4 G14', 'Sat', '20:20:00'),
(210324, 2103, 'A1 A9', 'Sat', '22:40:00'),
(210325, 2103, 'B2', 'Sun', '14:10:00'),
(210326, 2103, 'C7', 'Sun', '16:40:00'),
(210327, 2103, 'B1 B2 B3', 'Sun', '20:10:00'),
(210328, 2103, 'C1 C2 C3', 'Sun', '22:40:00'),
(210401, 2104, 'D1 D2', 'Mon', '14:00:00'),
(210402, 2104, 'E5', 'Mon', '17:00:00'),
(210403, 2104, 'F8', 'Mon', '20:00:00'),
(210404, 2104, 'G2 G3', 'Mon', '23:00:00'),
(210405, 2104, 'A10 A11', 'Tue', '13:00:00'),
(210406, 2104, 'B8 B9', 'Tue', '16:00:00'),
(210407, 2104, 'A1 A9', 'Tue', '19:00:00'),
(210408, 2104, 'B2', 'Tue', '22:00:00'),
(210409, 2104, 'A1 A2 A3', 'Wed', '13:30:00'),
(210410, 2104, 'B1 B2 B3', 'Wed', '16:30:00'),
(210411, 2104, 'C1 C2 C3', 'Wed', '20:00:00'),
(210412, 2104, 'D1 D2', 'Wed', '23:00:00'),
(210413, 2104, 'E5', 'Thu', '12:00:00'),
(210414, 2104, 'F8', 'Thu', '15:00:00'),
(210415, 2104, 'G2 G3', 'Thu', '18:00:00'),
(210416, 2104, 'A10 A11', 'Thu', '21:00:00'),
(210417, 2104, 'B8 B9', 'Fri', '13:30:00'),
(210418, 2104, 'C5 C6 C7 C8 F8 F9', 'Fri', '16:30:00'),
(210419, 2104, 'D13', 'Fri', '20:00:00'),
(210420, 2104, 'E11 E12', 'Fri', '23:00:00'),
(210421, 2104, 'F10 F11', 'Sat', '12:00:00'),
(210422, 2104, 'G9 G10', 'Sat', '15:00:00'),
(210423, 2104, 'D13', 'Sat', '18:00:00'),
(210424, 2104, 'E11 E12', 'Sat', '21:00:00'),
(210425, 2104, 'F10 F11', 'Sun', '11:00:00'),
(210426, 2104, 'G2 G3', 'Sun', '14:00:00'),
(210427, 2104, 'A10 A11', 'Sun', '17:00:00'),
(210428, 2104, 'B8 B9', 'Sun', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usid` int(10) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `passwords` varchar(40) NOT NULL,
  `email` text NOT NULL,
  `discount` text DEFAULT NULL,
  `featured` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usid`, `username`, `passwords`, `email`, `discount`, `featured`) VALUES
(1, 'test1', '161ebd7d45089b3446ee4e0d86dbcf92', 'popcorn@localhost', '0.1', '2101,2103,2202'),
(2, 'user2', '161ebd7d45089b3446ee4e0d86dbcf92', 'popcorn@localhost', '0.2', '2102,2203'),
(3, 'demo1', '161ebd7d45089b3446ee4e0d86dbcf92', 'demo@localhost', '0.5', '2101,2103,2202,2102,2203');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `tid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
