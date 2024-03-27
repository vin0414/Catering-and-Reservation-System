-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20368524_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccount`
--

CREATE TABLE `tblaccount` (
  `userID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Designation` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblaccount`
--

INSERT INTO `tblaccount` (`userID`, `Username`, `Password`, `Fullname`, `Designation`, `Role`, `Status`) VALUES
(1, 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Administrator', 'System Administrator', 'Super-user', 1),
(3, 'AAdmin', '8bc86675c49e72d2f0a66b796ca028b69bad9f90', 'Administrator1', 'System Administrator', 'Super-user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `catID` int(11) NOT NULL,
  `Category_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`catID`, `Category_Name`) VALUES
(1, 'Beef'),
(2, 'Pork'),
(3, 'Chicken'),
(4, 'Vegetables'),
(5, 'Pasta'),
(6, 'Dessert'),
(9, 'Seafood (Additional)'),
(10, 'Kiddie Menu - Meal'),
(11, 'Kiddie Menu - Drinks'),
(12, 'Kiddie Menu - Soup and Appetizer'),
(13, 'Drinks'),
(14, 'Appetizer and Sides');

-- --------------------------------------------------------

--
-- Table structure for table `tblcharge`
--

CREATE TABLE `tblcharge` (
  `chargeID` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcharge`
--

INSERT INTO `tblcharge` (`chargeID`, `pID`, `City`, `Rate`) VALUES
(1, 1, 'Cavite City', 0),
(2, 1, 'Dasmarinas City', 100),
(3, 2, 'Manila', 6000),
(4, 2, 'Mandaluyong', 6000),
(5, 2, 'Marikina', 6000),
(6, 2, 'Pasig', 6000),
(7, 2, 'Quezon City', 6000),
(8, 2, 'San Juan ', 6000),
(9, 2, 'Caloocan', 6000),
(10, 2, 'Malabon', 6000),
(11, 2, 'Navotas', 6000),
(12, 2, 'Valenzuela', 6000),
(13, 2, 'Las Piñas', 6000),
(14, 2, 'Makati', 6000),
(15, 2, 'Muntinlupa', 6000),
(16, 2, 'Parañaque', 6000),
(17, 2, 'Pasay', 6000),
(18, 2, 'Pateros', 6000),
(19, 2, 'Taguig', 6000),
(20, 1, 'Noveleta', 3000),
(21, 1, 'Imus', 3000),
(22, 1, 'Kawit', 3000),
(23, 1, 'Rosario', 3000),
(24, 1, 'General Trias', 3000),
(25, 1, 'Silang', 3000),
(26, 1, 'Amadeo', 3000),
(27, 1, 'Tagaytay', 3000),
(28, 1, 'Indang', 3000),
(29, 1, 'Magallanes', 3000),
(30, 1, 'Maragondon', 3000),
(31, 1, 'Ternate', 3000),
(32, 1, 'Mendez', 3000),
(33, 1, 'Alfonso', 3000),
(34, 1, 'Naic', 3000),
(35, 1, 'Tanza', 3000),
(36, 1, 'General Emilio Aguinaldo', 3000),
(37, 1, 'General Mariano Alvarez', 3000),
(38, 3, 'Pagsanjan', 7000),
(39, 3, 'Magdalena', 7000),
(40, 3, 'Alaminos', 7000),
(41, 3, 'San Pablo', 7000),
(42, 3, 'Rizal', 7000),
(43, 3, 'Nagcarlan', 7000),
(44, 3, 'Liliw', 7000),
(45, 3, 'Majayjay', 7000),
(46, 3, 'Luisiana', 7000),
(47, 3, 'Cavinti', 7000),
(48, 3, 'Lumban', 7000),
(49, 3, 'Kalayaan', 7000),
(50, 3, 'Paete', 7000),
(51, 3, 'Pakil', 7000),
(52, 3, 'Pangil/Panguil', 7000),
(53, 3, 'Siniloan', 7000),
(54, 3, 'Famy', 7000),
(55, 3, 'Mabitac', 7000),
(56, 3, 'Sta. Maria', 7000),
(57, 3, 'Cabuyao', 7000),
(58, 3, 'Calamba', 7000),
(59, 3, 'Los Baños', 7000),
(60, 3, 'Laguna de Bay', 7000),
(61, 3, 'Calaun', 7000),
(62, 3, 'Victoria', 7000),
(63, 3, 'Pila', 7000),
(64, 3, 'Sta. Cruz', 7000),
(65, 3, 'San Pedro', 7000),
(66, 3, 'Biñan', 7000),
(67, 3, 'Sta. Rosa', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `customerID` int(11) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `Status` int(11) NOT NULL,
  `Verification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`customerID`, `EmailAddress`, `Password`, `Fullname`, `Contact`, `Gender`, `Address`, `Status`, `Verification`) VALUES
(12, 'clairegrethelespanola@gmail.com', '71d2251cd94232c2b8e4567a9edc5322a6e78d8b', 'Grethel Jaye Rondola ', '', '', 'N/A', 1, '261442'),
(13, 'clairegrethelespanola@gmail.com', '25a8dd65218b12ab21e253c7e4b47b87dc47521b', 'Sample', '', '', 'N/A', 0, '397790'),
(14, 'clairegrethelespanola@gmail.com', '67a258218f68f6b5f7142593cf4b1f7d87622dd8', '', '', '', '', 1, '397791');

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE `tblevent` (
  `eventID` int(11) NOT NULL,
  `Event_Name` text NOT NULL,
  `Details` text NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`eventID`, `Event_Name`, `Details`, `Image`) VALUES
(6, 'Catering', 'Providing food and beverage service for events or occasions.', '20230520075703_346134165_265007329229914_372098273601197766_n.jpg'),
(7, 'Grazing Table', 'A large spread of various food items arranged aesthetically on a table, typically served for snacking and socializing.', '20230520075940_328532542_735423044575057_5772205204730690097_n.jpg'),
(8, 'Cocktail Station', 'A designated area for preparing and serving cocktails, often including a variety of ingredients, glassware, and bar tools.', '20230520080304_328294304_3811931685700306_1284197756439072711_n.jpg'),
(11, 'Birthday', 'An annual celebration of the day a person was born, often marked with gifts, parties, or special activities.', '20230520093021_lilibday3.jpg'),
(13, 'Food Cart', 'A mobile and compact food-serving outlet or stall typically used in outdoor settings such as street corners or events.', '20230522135927_346103390_274489788348257_1035852185611267123_n.jpg'),
(14, 'Wedding', 'A special ceremony that formally unites two people in marriage, often celebrated with family, friends, and various traditions.\r\n', '20230522140032_346155879_1406875743379681_7172645173071250980_n.jpg'),
(15, 'Set-up / Venue', 'The arrangement and decor of the location where an event takes place, often influenced by the event\'s theme or purpose.', '20230522140209_342209986_544313954545782_9186332313493320352_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `galleryID` int(11) NOT NULL,
  `Filename` varchar(255) NOT NULL,
  `File` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`galleryID`, `Filename`, `File`) VALUES
(1, 'Birthday', 'Birthday 1.jpg'),
(2, 'Birthday', 'Birthday 2.jpg'),
(3, 'Birthday', 'Birthday 3.jpg'),
(4, 'Birthday', 'Birthday 4.jpg'),
(5, 'Birthday', 'Birthday 5.jpg'),
(6, 'Birthday', 'Birthday 6.jpg'),
(7, 'Birthday', 'Birthday 7.jpg'),
(8, 'Birthday', 'Birthday 8.jpg'),
(9, 'Birthday', 'Birthday 9.jpg'),
(10, 'Birthday', 'Birthday 10.jpg'),
(11, 'Birthday', 'Birthday 11.jpg'),
(12, 'Birthday', 'Birthday 12.jpg'),
(13, 'Birthday', 'Birthday 13.jpg'),
(14, 'Birthday', 'Birthday 14.jpg'),
(15, 'Birthday', 'Birthday 15.jpg'),
(16, 'Birthday', 'Birthday 16.jpg'),
(17, 'Wedding', 'Wedding 1.jpg'),
(18, 'Wedding', 'Wedding 2.jpg'),
(19, 'Wedding', 'Wedding 3.jpg'),
(20, 'Wedding', 'Wedding 4.jpg'),
(21, 'Wedding', 'Wedding 5.jpg'),
(22, 'Wedding', 'Wedding 6.jpg'),
(23, 'Wedding', 'Wedding 7.jpg'),
(24, 'Wedding', 'Wedding 8.jpg'),
(25, 'Corporate', 'Event 1.jpg'),
(26, 'Corporate', 'Event 2.jpg'),
(27, 'Corporate', 'Event 3.jpg'),
(28, 'Corporate', 'Event 4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblinquiry`
--

CREATE TABLE `tblinquiry` (
  `inqID` int(11) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblinquiry`
--

INSERT INTO `tblinquiry` (`inqID`, `EmailAddress`, `Fullname`, `Subject`, `Message`) VALUES
(1, 'jdelacruz@gmail.com', 'Juan Dela Cruz', 'Sample inquiry', 'The quick brown fox jumps over the lazy'),
(2, 'sample data', 'sample data', 'sample data ', 'sample data\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tblmenu`
--

CREATE TABLE `tblmenu` (
  `menuID` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `Food_Name` varchar(255) NOT NULL,
  `Details` text NOT NULL,
  `Status` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblmenu`
--

INSERT INTO `tblmenu` (`menuID`, `catID`, `Food_Name`, `Details`, `Status`, `Image`) VALUES
(5, 1, '*Beef Morcon (+1000/50pax)', '', 1, '20230409080241_'),
(6, 1, 'Beef Carajay in Liver Sauce', '', 1, '20230409080711_'),
(8, 1, 'Beef with Broccoli Stir Fry', '', 1, '20230409080752_'),
(10, 1, '*Pastel de Lengua (+1000/50pax)', '', 1, '20230409080852_'),
(11, 1, 'Kare-Kare', '', 1, '20230409080908_'),
(14, 1, '*Roast Beef with Mashed Potato in Tuffle Oil (+1000/50pax)', '', 1, '20230409081055_'),
(15, 2, '*Hamonado Roll', '', 1, '20230409081154_'),
(16, 2, 'Meatball Surprise in Sweet and Sour Sauce ', '', 1, '20230409081237_'),
(18, 2, 'Pork Pastel ', '', 1, '20230409081318_'),
(19, 2, 'Lumpiang Shanghai ', '', 1, '20230409081341_'),
(21, 2, 'Embutido', '', 1, '20230409081416_'),
(22, 2, 'Lechon Kawali', '', 1, '20230409081428_'),
(23, 2, 'Pork Asado', '', 1, '20230409081444_'),
(24, 2, 'Bicol Express', '', 1, '20230409081514_'),
(25, 2, 'Pork Barbeque ', '', 1, '20230409081536_'),
(26, 2, 'Pork Caldereta ', '', 1, '20230409081552_'),
(27, 2, 'Pork in Oyster Sauce ', '', 1, '20230409081625_'),
(28, 2, 'Pork Teriyaki ', '', 1, '20230409081635_'),
(29, 3, 'Chicken Pastel', '', 1, '20230409081802_'),
(30, 3, 'Fried Chicken ', '', 1, '20230409081818_'),
(31, 3, '*Zephaniah\'s Cordon Bleu (All Chicken) ', '', 1, '20230409081847_'),
(32, 3, 'Chinese Style Orange Chicken', '', 1, '20230409081914_'),
(33, 3, '*Lemon Chicken Piccata', '', 1, '20230409081937_'),
(34, 3, 'Buffalo Wings', '', 1, '20230409081948_'),
(36, 3, 'Garlic Chicken ', '', 1, '20230409082018_'),
(37, 3, '*Zephaniah\'s Cheesy Chicken', '', 1, '20230409082118_'),
(41, 4, 'Mixed Vegetables in Butter', '', 1, '20230409082241_'),
(42, 5, '*Spaghetti ', '', 1, '20230409082319_'),
(44, 5, 'Carbonara ', '', 1, '20230409082343_'),
(47, 5, '*Baked Macaroni ', '', 1, '20230409085356_'),
(49, 5, 'Shrimp Scampi', '', 1, '20230409085453_'),
(51, 6, 'Buko Pandan', '', 1, '20230409085555_'),
(58, 6, '*Mango Tapioca ', '', 1, '20230409085956_'),
(61, 9, 'Shrimp in Chili Garlic Sauce ', '', 1, '20230409090233_'),
(62, 9, 'Shrimp in Butter Sauce ', '', 1, '20230409090255_'),
(63, 9, 'Fish Fillet with Tartar Sauce or Sweet and Sour Sauce ', '', 1, '20230409091229_'),
(67, 10, 'Spaghetti ', '', 1, '20230411012855_'),
(68, 10, 'Chicken Lollipops in Honey Glazed Sauce', '', 1, '20230411012917_'),
(69, 10, 'Hotdog with Marshmallows in Stick', '', 1, '20230411012954_'),
(70, 10, 'Juice or Ice Cream Cup', '', 1, '20230411013036_'),
(71, 11, 'Soda', '', 1, '20230411013101_'),
(72, 11, 'Four Season', '', 1, '20230411013118_'),
(73, 11, 'Iced tea (Red Iced Tea or Lemon Iced tea)', '', 1, '20230411013602_'),
(74, 11, 'Blue Lemonade ', '', 1, '20230411013642_'),
(75, 11, 'Lemon Cucumber ', '', 1, '20230411013703_'),
(76, 11, 'Fruit Flavor Juice (Strawberry, Grapes, Mango or Pineapple)', '', 1, '20230411013752_'),
(77, 12, 'Cream of Mushroom ', '', 1, '20230411014021_'),
(78, 12, 'Nido Soup', '', 1, '20230411014035_'),
(79, 12, 'Crab and Corn', '', 1, '20230411014056_'),
(80, 12, 'Chicken Macaroni Salad (+500)', '', 1, '20230411014129_'),
(81, 12, 'Potato Salad (+500)', '', 1, '20230411014200_'),
(82, 12, 'Chef\'s Salad (+800)', '', 1, '20230411014225_'),
(83, 12, 'Chicken Caesar Salad (+1000)', '', 1, '20230411014304_'),
(86, 1, 'Lengua Estofado (+1000/50pax)', '', 1, '20230415114206_'),
(87, 2, 'Bagnet Kare-Kare (+1000/50pax)', '', 1, '20230415114845_'),
(89, 2, '*Pork Shish Kebab', '', 1, '20230415115802_'),
(90, 2, 'Pork Tonkatsu', '', 1, '20230415115943_'),
(93, 2, 'Mongolian Pork', '', 1, '20230415121414_'),
(96, 3, 'Chicken Teriyaki', '', 1, '20230418102653_'),
(97, 3, 'Chicken Galantina (+1000/50pax)', '', 1, '20230418103440_'),
(98, 3, 'Roasted Chicken with Gravy', '', 1, '20230418103540_'),
(99, 3, 'Italian Chicken Parm', '', 1, '20230418103829_'),
(100, 3, 'Chicken BBQ Skewers', '', 1, '20230418103943_'),
(101, 3, 'Chicken Masala (Indian Dish)', '', 1, '20230418104028_'),
(102, 9, '*Mutya ng Kabite (+1500/1kg)', '', 1, '20230418105126_'),
(103, 9, 'Buttered Garlic Shrimp (+900/1kg)', '', 1, '20230418105235_'),
(104, 9, 'Panko Fish in Honey Mustard Sauce (+750/1kg)', '', 1, '20230418105350_'),
(105, 9, 'Relyenadong Camaron (+1200/1kg)', '', 1, '20230418105457_'),
(106, 9, 'Crab Relyeno (+1500/1kg)', '', 1, '20230418105553_'),
(107, 9, '*Shrimp Thermidor (+1500/1kg)', '', 1, '20230418105731_'),
(108, 9, 'Seafood Paella (+2000/1kg)', '', 1, '20230418105824_'),
(109, 9, 'Relyenong Pusit (+2000/1kg)', '', 1, '20230418105910_'),
(110, 5, 'Chicken Pesto Pasta', '', 1, '20230421080807_'),
(111, 5, 'Chicken Alfredo', '', 1, '20230421081009_'),
(112, 5, 'Lasagna (+1000/50pax)', '', 1, '20230421081153_'),
(113, 5, 'Pasta Arrabiatta', '', 1, '20230421081317_'),
(114, 5, 'Seafood Marinara (+1000/50pax)', '', 1, '20230421081554_'),
(115, 5, 'Pancit Canton', '', 1, '20230421081637_'),
(116, 5, 'Pancit Bihon', '', 1, '20230421081712_'),
(117, 5, 'Pancit Puso', '', 1, '20230421081739_'),
(118, 5, '*Pancit Malabon', '', 1, '20230421081847_'),
(119, 5, 'Pansit Palabok', '', 1, '20230421081939_'),
(120, 5, 'Pansit Pusit', '', 1, '20230421082014_'),
(121, 5, 'Mixed Bihon and Canton Pansit', '', 1, '20230421082121_'),
(123, 4, 'Steamed Vegetables in Butter', '', 1, '20230421082958_'),
(124, 4, 'Mashed Potato in Truffle Oil (+500/50pax)', '', 1, '20230421083147_'),
(125, 4, 'Mixed Corn and Veggies', '', 1, '20230421083250_'),
(126, 5, 'Chicken Caesar Salad (+1000/50pax)', '', 1, '20230421083415_'),
(127, 4, '*Spring Roll in Peanut Sauce (+500/50pax)', '', 1, '20230421083643_'),
(128, 13, '*Lemon Cucumber', '', 1, '20230421084250_'),
(129, 13, 'Blue Lemonade', '', 1, '20230421084352_'),
(130, 13, 'Lemon Iced Tea', '', 1, '20230421084525_'),
(131, 13, 'Red Iced Tea', '', 1, '20230421084641_'),
(132, 13, 'Four Seasons', '', 1, '20230421084713_'),
(133, 13, 'Citrus Sangria (+500/50pax)', '', 1, '20230421084838_'),
(134, 6, 'Fruit Salad with Lychee or Buko', '', 1, '20230421085158_'),
(135, 6, 'Maja Blanca', '', 1, '20230421085225_'),
(136, 6, 'Sri Lanka Ube Pudding (+1000/50pax)', '', 1, '20230421085331_'),
(137, 6, 'Chocolate Mousse Shot (+500/50pax)', '', 1, '20230421085431_'),
(138, 6, 'Strawberry Pannacotta', '', 1, '20230421085516_'),
(139, 14, '*Home-Style Cream of Mushroom Soup', '', 1, '20230421111621_'),
(140, 14, 'Crab and Corn Soup', '', 1, '20230421111648_'),
(141, 14, 'Nido Soup', '', 1, '20230421111706_'),
(142, 14, 'Egg-Drop Soup', '', 1, '20230421111727_'),
(143, 14, 'Tomato Bisque', '', 1, '20230421111744_'),
(144, 14, '*Chicken Caesar Salad (+1000/1kg)', '', 1, '20230421111849_'),
(145, 14, 'Chicken Macaroni Salad (+500/1kg)', '', 1, '20230421112636_'),
(146, 14, 'Potato Salad (+500/1kg)', '', 1, '20230421112710_'),
(147, 14, 'Mashed Potato in Truffle Oil (+500/1kg)', '', 1, '20230421112944_'),
(150, 1, 'Beef Caldereta', 'Simmered to tenderness in a spicy tomato sauce. Chock full of potatoes, bell peppers, and green olives.', 1, '20230520070829_Beef Caldereta.jpg'),
(151, 3, 'Chicken Lolipop', 'Generally considered as an appetizer dish. This chicken dish is made from chicken wings', 1, '20230520071817_342887741_942595693430480_7278725729777751527_n.jpg'),
(152, 1, 'Beef Salpicao', 'Beef stir-fry dish flavored with Worcestershire, butter, garlic, and red chili pepper flakes. It\'s quick and simple to make yet packs fantastic flavor.', 1, '20230520072138_343720461_751908366630938_2736557001049660568_n.jpg'),
(153, 4, 'Chopsuey', 'A stir-fried vegetable dish that is cooked with meats such as chicken and pork. Shrimp and seafood can also be added. ', 1, '20230520072511_342041810_1061239971501579_288165430829666552_n.jpg'),
(154, 2, 'Sweet and Sour Pork', 'Sweet and Sour Pork with crisp bell peppers and juicy pineapple chunks', 1, '20230520072710_342591325_644389280828068_8680710152900391210_n.jpg'),
(155, 2, '*Special Menudo ', 'Fatty cuts of pork simmered for a long time in a tomato-based sauce, resulting in a rich stew.', 1, '20230520072916_342200687_3071108996526766_4506245892813523610_n.jpg'),
(156, 1, 'Beef with Mushroom Sauce', 'Extra delicious with fork-tender beef and delectable mushroom gravy served over steam rice, mashed potatoes.', 1, '20230520073144_342599654_576265937866659_6498579110285089969_n.jpg'),
(158, 3, 'Pan Roasted Cheesy Chicken', 'Meaty sauce and cheese topping are sure to be crowd favorite. ', 1, '20230520073522_343772263_1294385768182287_187786496760570734_n.jpg'),
(159, 1, '*Beef Mechado', 'Made of larded beef chunks braised in tomato sauce with potatoes and carrots.', 1, '20230520073714_342612651_785337509462788_996073884193935483_n.jpg'),
(160, 4, '*7 kinds', 'Buttery, creamy and flavorful with loads of 7 kinds of vegetables goodness.', 1, '20230520073906_342646584_174607301811603_500657680135540412_n.jpg'),
(161, 2, '*Pork Hamonado Roll', 'Yields a sweet pork loaf, the pork is marinated in pineapple juice overnight. It is marinated and simply simmered, resulting in flavorful, sweet pork.', 1, '20230520074320_342602324_180244931579688_2837696669233858134_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblothers`
--

CREATE TABLE `tblothers` (
  `oID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Item` text NOT NULL,
  `Amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblothers`
--

INSERT INTO `tblothers` (`oID`, `Code`, `Item`, `Amount`) VALUES
(1, '00000001', 'Cocktail Station', 10000),
(2, '00000001', 'Grazing Table (50pax)', 10000),
(3, '00000003', 'Cocktail Station', 10000),
(4, '00000003', 'Grazing Table (50pax)', 10000),
(5, '00000004', 'Cocktail Station', 10000),
(6, '00000004', 'Grazing Table (50pax)', 10000),
(7, '00000005', 'Cocktail Station', 10000),
(8, '00000005', 'Grazing Table (50pax)', 10000),
(9, '00000006', 'Cocktail Station', 10000),
(10, '00000006', 'Grazing Table (50pax)', 10000),
(11, '00000007', 'Cocktail Station', 10000),
(12, '00000007', 'Grazing Table (50pax)', 10000),
(13, '00000008', 'Cocktail Station', 10000),
(14, '00000008', 'Grazing Table (50pax)', 10000),
(15, '00000008', 'Kakanin Grazing Table (50 pax)', 8000),
(16, '00000010', 'Grazing Table (100pax)', 13000),
(17, '00000013', 'Cocktail Station', 10000),
(18, '00000013', 'Grazing Table (50pax)', 10000),
(19, '00000013', 'Dirty Ice Cream (50-60pax)', 3500),
(20, '00000013', 'Street Food (50-60pax)', 3500),
(21, '00000014', 'Grazing Table (100pax)', 13000),
(22, '00000014', 'Kakanin Grazing Table (100pax)', 12000),
(23, '00000014', 'Street Food (50-60pax)', 3500),
(24, '00000015', 'Grazing Table', 7000),
(25, '00000015', 'Cocktail Station', 10000),
(26, '00000016', 'Grazing Table', 7000),
(27, '00000016', 'Cocktail Station', 10000),
(28, '00000017', 'Grazing Table (150pax)', 15000),
(29, '00000018', 'Grazing Table (100pax)', 13000),
(30, '00000019', 'Kakanin Grazing Table - 150pax', 14000),
(31, '00000020', 'Grazing Table', 7000),
(32, '00000021', 'Candy Buffet', 4000);

-- --------------------------------------------------------
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `Code` int(11) NOT NULL,
  `Fullname` text NOT NULL,
  `Total` smallint(6) NOT NULL,
  `Paid` smallint(6) NOT NULL,
  `Balance` smallint(6) NOT NULL,
  `Date` date NOT NULL,
  `Payment` text NOT NULL,
  `Reference` varchar(255) NOT NULL,
  `Remarks` text NOT NULL
  )
-- --------------------------------------------------------
--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `productID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `Package_Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblprovince`
--

CREATE TABLE `tblprovince` (
  `pID` int(11) NOT NULL,
  `Province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblprovince`
--

INSERT INTO `tblprovince` (`pID`, `Province`) VALUES
(1, 'Cavite'),
(2, 'Las Pinas'),
(3, 'Metro Manila'),
(4, 'Laguna');

-- --------------------------------------------------------

--
-- Table structure for table `tblrental`
--

CREATE TABLE `tblrental` (
  `rentID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Rate` double NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblrental`
--

INSERT INTO `tblrental` (`rentID`, `Name`, `Rate`, `Status`) VALUES
(1, 'Grazing Table', 7000, 1),
(2, 'Cocktail Station', 10000, 1),
(3, 'Candy Buffet', 4000, 1),
(4, 'Grazing Table (50pax)', 10000, 1),
(5, 'Grazing Table (100pax)', 13000, 1),
(6, 'Grazing Table (150pax)', 15000, 1),
(7, 'Grazing Table (200pax)', 18000, 1),
(8, 'Kakanin Grazing Table (50 pax)', 8000, 1),
(9, 'Kakanin Grazing Table (100pax)', 12000, 1),
(10, 'Kakanin Grazing Table - 150pax', 14000, 1),
(11, 'Kakanin Grazing Table (200pax)', 16000, 1),
(12, 'Cotton Candy (50-60pax)', 3000, 1),
(13, 'Popcorn (50-60pax)', 2500, 1),
(14, 'Hotdog (50-60pax)', 2500, 1),
(15, 'Ice Scramble and Snow Cone (50-60pax)', 3000, 1),
(16, 'Dirty Ice Cream (50-60pax)', 3500, 1),
(17, 'Street Food (50-60pax)', 3500, 1),
(18, 'Ihaw-Ihaw (50-60pax)', 3500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblreservation`
--

CREATE TABLE `tblreservation` (
  `reserveID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `Event_date` varchar(255) NOT NULL,
  `Event_time` varchar(255) NOT NULL,
  `Event_name` varchar(255) NOT NULL,
  `Event_location` text NOT NULL,
  `pID` int(11) NOT NULL,
  `City` varchar(255) NOT NULL,
  `eventID` int(11) NOT NULL,
  `Guest` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `Theme` text NOT NULL,
  `Cake` varchar(255) NOT NULL,
  `Amount` double NOT NULL,
  `Status` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `DateCreated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblreservation`
--

INSERT INTO `tblreservation` (`reserveID`, `customerID`, `Fullname`, `Contact`, `EmailAddress`, `Address`, `Event_date`, `Event_time`, `Event_name`, `Event_location`, `pID`, `City`, `eventID`, `Guest`, `productID`, `Theme`, `Cake`, `Amount`, `Status`, `Code`, `DateCreated`) VALUES
(19, 0, 'Claire Espanola', '09654463289', 'clairegrethelespanola@gmail.com', 'Cavite City', '2024-01-26', '15:00', 'Birthday', 'cavite city', 1, '1', 11, 100, 11, 'black and purple', '', 97000, 2, '00000020', '2023-05-20'),
(21, 0, 'Jaye', '01234567891', 'jayecampos@gmail.com', 'LNC', '2023-06-12', '16:00', 'Surprise Birthday', 'Cavite', 1, '21', 11, 50, 11, 'Sci-Fi', '', 93000, 1, '00000022', '2023-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE `tbltransaction` (
  `trxnID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbltransaction`
--

INSERT INTO `tbltransaction` (`trxnID`, `Code`) VALUES
(1, '00000001'),
(2, '00000002'),
(3, '00000003'),
(4, '00000004'),
(5, '00000005'),
(6, '00000006'),
(7, '00000007'),
(8, '00000008'),
(9, '00000009'),
(10, '00000010'),
(11, '00000011'),
(12, '00000012'),
(13, '00000013'),
(14, '00000014'),
(15, '00000015'),
(16, '00000016'),
(17, '00000017'),
(18, '00000018'),
(19, '00000019'),
(20, '00000020'),
(21, '00000021'),
(22, '00000022'),
(23, '00000023'),
(24, '00000024');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_selected_menu`
--

CREATE TABLE `tbl_selected_menu` (
  `sID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Appetizer` tinytext NOT NULL,
  `Beef` text NOT NULL,
  `Pork` text NOT NULL,
  `Chicken` text NOT NULL,
  `Vegetables` text NOT NULL,
  `Pasta` text NOT NULL,
  `Dessert` text NOT NULL,
  `Drinks` text NOT NULL,
  `Seafood` text NOT NULL,
  `KiddieMeal` text NOT NULL,
  `KiddieDrinks` text NOT NULL,
  `Soup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_selected_menu`
--

INSERT INTO `tbl_selected_menu` (`sID`, `Code`, `Appetizer`, `Beef`, `Pork`, `Chicken`, `Vegetables`, `Pasta`, `Dessert`, `Drinks`, `Seafood`, `KiddieMeal`, `KiddieDrinks`, `Soup`) VALUES
(1, '00000001', 'Crab and Corn Soup', 'Beef Salpicao', 'Sweet and Sour Pork', 'Garlic Chicken', 'Mixed Corn and Veggies', 'Shrimp Scampi', 'Fruit Salad with Lychee or Buko', 'Four Seasons', 'Seafood Paella (+2000/1kg)', 'Spaghetti', 'Fruit Flavor Juice (Strawberry, Grapes, Mango or Pineapple)', 'Crab and Corn'),
(2, '00000003', '*Home-Style Cream of Mushroom Soup', 'Beef Caldereta', '*Hamonado Roll', 'Fried Chicken', 'Mixed Vegetables in Butter', '*Spaghetti', '*Mango Tapioca', 'Blue Lemonade', 'Relyenadong Camaron (+1200/1kg)', 'Chicken Lollipops in Honey Glazed Sauce', 'Four Season', 'Chef\'s Salad (+800)'),
(3, '00000004', 'Crab and Corn Soup', 'Beef Carajay in Liver Sauce', 'Sweet and Sour Pork', 'Fried Chicken', 'Chopsuey', '*Baked Macaroni', 'Buko Pandan', 'Blue Lemonade', 'Fish Fillet with Tartar Sauce or Sweet and Sour Sauce', 'Spaghetti', 'Four Season', 'Nido Soup'),
(4, '00000005', 'Crab and Corn Soup', 'Beef with Broccoli Stir Fry', 'Lechon Kawali', 'Buffalo Wings', 'Mixed Corn and Veggies', 'Pancit Bihon', 'Fruit Salad with Lychee or Buko', 'Four Seasons', 'Seafood Paella (+2000/1kg)', 'Chicken Lollipops in Honey Glazed Sauce', 'Four Season', 'Cream of Mushroom'),
(5, '00000006', '*Home-Style Cream of Mushroom Soup', 'Beef Caldereta', '*Hamonado Roll', 'Chicken Pastel', 'Chopsuey', '*Spaghetti', 'Buko Pandan', '*Lemon Cucumber', 'Shrimp in Chili Garlic Sauce', 'Spaghetti', 'Soda', 'Cream of Mushroom'),
(6, '00000007', 'Crab and Corn Soup', 'Beef Caldereta', '*Hamonado Roll', 'Chicken Pastel', 'Chopsuey', '*Spaghetti', 'Buko Pandan', '*Lemon Cucumber', 'Shrimp in Chili Garlic Sauce', 'Spaghetti', 'Soda', 'Cream of Mushroom'),
(7, '00000008', 'Crab and Corn Soup', 'Beef Caldereta', '*Hamonado Roll', 'Chicken Pastel', 'Chopsuey', '*Spaghetti', 'Buko Pandan', '*Lemon Cucumber', 'Shrimp in Chili Garlic Sauce', 'Spaghetti', 'Soda', 'Cream of Mushroom'),
(8, '00000009', 'Egg-Drop Soup', 'Beef with Mushroom Sauce', 'Lechon Kawali', 'Garlic Chicken', 'Mixed Corn and Veggies', 'Chicken Alfredo', 'Sri Lanka Ube Pudding (+1000/50pax)', 'Citrus Sangria (+500/50pax)', 'Fish Fillet with Tartar Sauce or Sweet and Sour Sauce', 'Hotdog with Marshmallows in Stick', 'Iced tea (Red Iced Tea or Lemon Iced tea)', 'Potato Salad (+500)'),
(9, '00000010', '*Home-Style Cream of Mushroom Soup', 'Beef Caldereta', '*Hamonado Roll', 'Chicken Pastel', 'Chopsuey', '*Spaghetti', 'Buko Pandan', '*Lemon Cucumber', 'Shrimp in Chili Garlic Sauce', 'Spaghetti', 'Soda', 'Nido Soup'),
(10, '00000011', 'Nido Soup', 'Beef Carajay in Liver Sauce', 'Sweet and Sour Pork', 'Chinese Style Orange Chicken', 'Mixed Vegetables in Butter', '*Baked Macaroni', '*Mango Tapioca', 'Red Iced Tea', '*Mutya ng Kabite (+1500/1kg)', '', '', ''),
(11, '00000012', '*Home-Style Cream of Mushroom Soup', 'Beef Caldereta', '*Hamonado Roll', 'Fried Chicken', 'Mixed Vegetables in Butter', 'Carbonara', 'Fruit Salad with Lychee or Buko', 'Blue Lemonade', 'Shrimp in Butter Sauce', '', '', 'Chicken Macaroni Salad (+500)'),
(12, '00000013', 'Nido Soup', '*Beef Morcon (+1000/50pax)', '*Hamonado Roll', 'Chicken Pastel', 'Chopsuey', '*Spaghetti', 'Buko Pandan', '*Lemon Cucumber', 'Shrimp in Chili Garlic Sauce', 'Spaghetti', 'Soda', 'Cream of Mushroom'),
(13, '00000014', '*Home-Style Cream of Mushroom Soup', 'Beef Caldereta', '*Hamonado Roll', 'Chicken Pastel', 'Chopsuey', '*Spaghetti', 'Buko Pandan', '*Lemon Cucumber', 'Shrimp in Chili Garlic Sauce', 'Spaghetti', 'Soda', 'Cream of Mushroom'),
(14, '00000015', 'Nido Soup', '*Pastel de Lengua (+1000/50pax)', 'Bicol Express', '*Zephaniah\'s Cordon Bleu (All Chicken)', 'Steamed Vegetables in Butter', 'Pancit Bihon', 'Maja Blanca', 'Blue Lemonade', 'Buttered Garlic Shrimp (+900/1kg)', '', '', ''),
(15, '00000016', 'Nido Soup', '*Pastel de Lengua (+1000/50pax)', 'Bicol Express', '*Zephaniah\'s Cordon Bleu (All Chicken)', 'Steamed Vegetables in Butter', 'Pancit Bihon', 'Maja Blanca', 'Blue Lemonade', 'Buttered Garlic Shrimp (+900/1kg)', '', '', ''),
(16, '00000017', 'Chicken Macaroni Salad (+500/1kg)', '*Pastel de Lengua (+1000/50pax)', 'Lechon Kawali', 'Garlic Chicken', 'Mixed Corn and Veggies', 'Lasagna (+1000/50pax)', 'Sri Lanka Ube Pudding (+1000/50pax)', 'Citrus Sangria (+500/50pax)', 'Buttered Garlic Shrimp (+900/1kg)', '', '', ''),
(17, '00000018', '*Chicken Caesar Salad (+1000/1kg)', '*Beef Mechado', '*Special Menudo', 'Buffalo Wings', 'Mashed Potato in Truffle Oil (+500/50pax)', 'Lasagna (+1000/50pax)', 'Sri Lanka Ube Pudding (+1000/50pax)', 'Red Iced Tea', 'Panko Fish in Honey Mustard Sauce (+750/1kg)', '', '', ''),
(18, '00000019', 'Potato Salad (+500/1kg)', '*Pastel de Lengua (+1000/50pax)', 'Embutido', 'Garlic Chicken', '*Spring Roll in Peanut Sauce (+500/50pax)', 'Lasagna (+1000/50pax)', 'Chocolate Mousse Shot (+500/50pax)', 'Citrus Sangria (+500/50pax)', 'Panko Fish in Honey Mustard Sauce (+750/1kg)', '', '', ''),
(19, '00000020', '*Home-Style Cream of Mushroom Soup', '*Beef Morcon (+1000/50pax)', '*Hamonado Roll', '*Lemon Chicken Piccata', '*7 kinds', '*Spaghetti', '*Mango Tapioca', '*Lemon Cucumber', '*Mutya ng Kabite (+1500/1kg)', '', '', ''),
(20, '00000021', '*Home-Style Cream of Mushroom Soup', '*Beef Morcon (+1000/50pax)', '*Hamonado Roll', '*Zephaniah\'s Cheesy Chicken', '*Spring Roll in Peanut Sauce (+500/50pax)', '*Spaghetti', '*Mango Tapioca', '*Lemon Cucumber', '*Shrimp Thermidor (+1500/1kg)', '', '', ''),
(21, '00000022', '*Home-Style Cream of Mushroom Soup', '*Beef Morcon (+1000/50pax)', '*Hamonado Roll', '*Zephaniah\'s Cordon Bleu (All Chicken)', '*Spring Roll in Peanut Sauce (+500/50pax)', '*Spaghetti', '*Mango Tapioca', '*Lemon Cucumber', '*Mutya ng Kabite (+1500/1kg)', 'Chicken Lollipops in Honey Glazed Sauce', 'Fruit Flavor Juice (Strawberry, Grapes, Mango or Pineapple)', 'Crab and Corn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccount`
--
ALTER TABLE `tblaccount`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `tblcharge`
--
ALTER TABLE `tblcharge`
  ADD PRIMARY KEY (`chargeID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`galleryID`);

--
-- Indexes for table `tblinquiry`
--
ALTER TABLE `tblinquiry`
  ADD PRIMARY KEY (`inqID`);

--
-- Indexes for table `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `tblothers`
--
ALTER TABLE `tblothers`
  ADD PRIMARY KEY (`oID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `tblprovince`
--
ALTER TABLE `tblprovince`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `tblrental`
--
ALTER TABLE `tblrental`
  ADD PRIMARY KEY (`rentID`);

--
-- Indexes for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD PRIMARY KEY (`reserveID`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD PRIMARY KEY (`trxnID`);

--
-- Indexes for table `tbl_selected_menu`
--
ALTER TABLE `tbl_selected_menu`
  ADD PRIMARY KEY (`sID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccount`
--
ALTER TABLE `tblaccount`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcharge`
--
ALTER TABLE `tblcharge`
  MODIFY `chargeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblevent`
--
ALTER TABLE `tblevent`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `galleryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tblinquiry`
--
ALTER TABLE `tblinquiry`
  MODIFY `inqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblmenu`
--
ALTER TABLE `tblmenu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `tblothers`
--
ALTER TABLE `tblothers`
  MODIFY `oID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblprovince`
--
ALTER TABLE `tblprovince`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblrental`
--
ALTER TABLE `tblrental`
  MODIFY `rentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `reserveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  MODIFY `trxnID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_selected_menu`
--
ALTER TABLE `tbl_selected_menu`
  MODIFY `sID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
