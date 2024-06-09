-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2022 at 11:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prj_locoshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(9) NOT NULL,
  `cat_name` varchar(45) NOT NULL,
  `regdate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cat_name`, `regdate`, `status`, `uid`) VALUES
(1, 'Todays Deal', '2020-11-03', 2, 1),
(2, 'Within Week Deal', '2020-11-03', 2, 1),
(3, 'Jewellery Deal', '2020-11-15', 1, 1),
(4, 'Clothing Deal', '2020-11-04', 1, 1),
(31, 'SKIRT', '2020-12-07', 0, 8),
(32, 'Skirt', '2020-12-07', 0, 8),
(33, 'Kaze', '2021-08-12', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `comp_id` int(9) NOT NULL,
  `comp_name` varchar(90) NOT NULL,
  `comp_tag_line` varchar(120) NOT NULL,
  `pro_pra_name` varchar(90) NOT NULL,
  `comp_add` varchar(90) NOT NULL,
  `comp_mob` varchar(13) NOT NULL,
  `comp_mob1` varchar(13) NOT NULL,
  `comp_web` varchar(120) NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`comp_id`, `comp_name`, `comp_tag_line`, `pro_pra_name`, `comp_add`, `comp_mob`, `comp_mob1`, `comp_web`, `uid`) VALUES
(1, 'locoshop.com', 'Online Shopping', 'Soham Solat', 'Pune', '9130210793', '7066326068', 'sohamsolat@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `end_user`
--

CREATE TABLE `end_user` (
  `euid` int(9) NOT NULL,
  `euname` varchar(30) NOT NULL,
  `eumob` varchar(10) NOT NULL,
  `eupass` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bdate` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `euregdate` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `end_user`
--

INSERT INTO `end_user` (`euid`, `euname`, `eumob`, `eupass`, `email`, `bdate`, `address`, `euregdate`, `status`) VALUES
(26, 'Ashvita Kachare', '9119453233', 'anvitkachare869', '', '0000-00-00', 'Pune', '2020-11-30', 1),
(27, 'Rajlaxmi', '8793515673', 'raj1288', '', '0000-00-00', 'Pune', '2020-11-30', 1),
(28, 'Sampada Gore', '9922029029', 'sampadagore@2111988', '', '0000-00-00', 'Badlapur', '2020-11-30', 1),
(29, 'Shweta Dalal', '9766280662', 'shweta1377', '', '0000-00-00', 'Pune', '2020-11-30', 1),
(30, 'Sugandha Raorane', '8879546599', 'Veer*2204', '', '0000-00-00', 'Mumbai', '2020-12-01', 1),
(31, 'Vina upasani', '9325712610', 'Aayush@2019', '', '0000-00-00', 'Pune', '2020-12-01', 1),
(32, 'Pratiksha', '9049240444', 'pratiksha01', '', '0000-00-00', 'Aurangabad', '2020-12-01', 1),
(33, 'Rajitha', '7386599118', '7386599118', '', '0000-00-00', 'Warangal', '2020-12-01', 0),
(34, 'Hema', '9096307400', 'Hemagawade249', '', '0000-00-00', 'Pune', '2020-12-01', 1),
(35, 'Pratima singh', '7526066697', 'raginisingh123456', '', '0000-00-00', 'Lucknow', '2020-12-02', 1),
(37, 'Subhan', '8888789402', '123', '', '0000-00-00', 'Manchar', '2020-12-02', 1),
(38, 'Neha', '8655545851', '12345678890q', '', '0000-00-00', 'Kalyam', '2020-12-02', 1),
(39, 'Harish', '9082778590', 'surekhahn1984', '', '0000-00-00', 'Mumbai', '2020-12-02', 1),
(40, 'Neha', '8275957868', 'neha12345', '', '0000-00-00', 'Kalyan', '2020-12-03', 0),
(41, 'Neha', '8275957868', 'neha12345', '', '0000-00-00', 'Kalyan', '2020-12-03', 0),
(42, 'Shravya', '8275957868', 'neha14270428', '', '0000-00-00', 'Kalyan', '2020-12-03', 0),
(43, 'Kusum', '9307704827', 'dada', '', '0000-00-00', 'Ulhasnagar', '2020-12-03', 1),
(44, 'Sunita Mahale', '9637805494', 'sunita mahale', '', '0000-00-00', 'Kannad, Aurangabad', '2020-12-03', 0),
(45, 'Sunita Mahale', '9595611195', 'sunitamahale', '', '0000-00-00', 'Kannad, Aurangabad', '2020-12-03', 1),
(46, 'Samruddhi', '9527134813', 'samruddhi', '', '0000-00-00', 'Pune', '2020-12-09', 0),
(47, 'Samruddhi', '9527134813', 'samruddhi', '', '0000-00-00', 'Pune', '2020-12-09', 0),
(48, 'dolly', '9699782122', '112233', '', '0000-00-00', 'pune', '2020-12-12', 0),
(49, 'Samruddhi', '9527134813', 'samruddhi', '', '0000-00-00', 'Manchar', '2020-12-15', 0),
(50, 'Sunita Mahale', '9637805494', 'sunita123', '', '0000-00-00', 'Kannad, Aurangabad', '2020-12-15', 0),
(51, 'Sunita Mahale', '9637805494', 'sunita123', '', '0000-00-00', 'Kannad, Aurangabad', '2020-12-15', 0),
(52, 'Swati', '9838342020', 'market0000@@', '', '0000-00-00', 'Mumbai', '2020-12-18', 0),
(53, 'Swati', '9738342020', 'market@1212', '', '0000-00-00', 'Pune', '2020-12-18', 0),
(54, 'Swati', '9738342050', 'market1111', '', '0000-00-00', 'Mumbai', '2020-12-21', 0),
(55, 'Swati', '9738342020', 'market1111', '', '0000-00-00', 'Mumbai', '2020-12-21', 0),
(56, 'Seema', '7719833444', 'seemashinde', '', '0000-00-00', 'Dhule', '2020-12-21', 1),
(57, 'Mahee collection', '9920842989', 'maheeveer143', '', '0000-00-00', 'Dombevali', '2020-12-23', 0),
(58, 'Priyanka', '9493044876', 'srihitha2*', '', '0000-00-00', 'Srikakulam', '2020-12-24', 0),
(59, 'Mahee collection', '9920842989', 'mahee143', '', '0000-00-00', 'Dombevali', '2020-12-24', 0),
(60, 'Mahee collection', '9920842989', 'maheeveer', '', '0000-00-00', 'Dombevali', '2020-12-24', 0),
(61, 'Poonam dama', '9920842989', 'mahee143', '', '0000-00-00', 'Maharashtra', '2020-12-24', 0),
(62, 'Farzeen Shaikh', '8208229311', '78697869farzeen', '', '0000-00-00', 'Nirgudsar', '2021-01-01', 0),
(63, 'Khushi', '8459297372', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(64, 'Khushi', '8459297372', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(65, 'Khushi', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(66, 'Khushi', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(67, 'Khushi jagtap', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(68, 'Khushi jagtap', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(69, 'Khushi jagtap', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(70, 'Khushi jagtap', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(71, 'Khushi jagtap', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(72, 'Khushi jagtap', '8459297372', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(73, 'Khushi jagtap', '8459297372', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(74, 'Khushi jagtap', '9850135889', 'Anaya03', '', '0000-00-00', 'Nagpur', '2021-01-04', 0),
(75, 'Jagtap', '9850135889', 'Anaya0317', '', '0000-00-00', 'Nagpur', '2021-01-06', 0),
(76, 'Jagtap', '9850135889', 'Anaya0317', '', '0000-00-00', 'Nagpur', '2021-01-06', 0),
(77, 'Jagtap', '9850135889', 'Anaya9850135889', '', '0000-00-00', 'Nagpur', '2021-01-06', 0),
(78, 'Jagtap', '9850135889', 'Anaya9850135889', '', '0000-00-00', 'Nagpur', '2021-01-06', 0),
(79, 'Khushbu vinay jagtap', '9850135889', 'Anaya0317', '', '0000-00-00', 'Nagpur', '2021-01-06', 0),
(80, 'Khushbu vinay jagtap', '9850135889', 'Anaya0317', '', '0000-00-00', 'Nagpur', '2021-01-06', 0),
(81, 'Ashvita Kachare', '9834966689', 'anvit689', '', '0000-00-00', 'Pune', '2021-01-06', 0),
(82, 'Ashvita Kachare', '9834966689', 'anvitkachare689', '', '0000-00-00', 'Pune', '2021-01-06', 0),
(83, 'Ashvita Kachare', '9834966689', 'anviykachare689', '', '0000-00-00', 'Pune', '2021-01-06', 0),
(84, 'Jannareddy Sowmya', '9701566860', '9701566860', '', '0000-00-00', 'Telangana', '2021-01-08', 0),
(85, 'Jannareddy Sowmya', '9701566860', '9701566860', '', '0000-00-00', 'Telangana', '2021-01-08', 0),
(86, 'Jannareddy Sowmya', '9701566860', '9701566860', '', '0000-00-00', 'Telangana', '2021-01-21', 0),
(87, 'Jannareddy Sowmya', '9059769118', '9701566860', '', '0000-00-00', 'Telangana', '2021-01-21', 0),
(88, 'Jannareddy Sowmya', '9491116860', '9701566860', '', '0000-00-00', 'Telangana', '2021-01-21', 0),
(89, 'Ratna Bhadauria', '9021669169', 'rohubhumi2913@#', '', '0000-00-00', 'Pune', '2021-01-27', 0),
(90, 'Satwinder kaur', '9654258929', 'Vinni88', '', '0000-00-00', 'New delhi', '2021-02-21', 0),
(91, 'Satwinder kaur', '9654258929', 'Vinni88', '', '0000-00-00', 'New delhi', '2021-02-21', 1),
(92, 'az', '5415616515', 'az', '', '0000-00-00', 'az', '2021-04-13', 0),
(93, 'yawa', '1231231231', 'P@55word2', '', '0000-00-00', 'adwa', '2021-04-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `franchise`
--

CREATE TABLE `franchise` (
  `fr_id` int(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `altmob` varchar(10) NOT NULL,
  `shop_location` varchar(250) NOT NULL,
  `map_location` varchar(500) NOT NULL,
  `rent_owner` varchar(150) NOT NULL,
  `shop_area` varchar(250) NOT NULL,
  `partner_owner` varchar(150) NOT NULL,
  `fr_status` tinyint(1) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `franchise`
--

INSERT INTO `franchise` (`fr_id`, `name`, `address`, `mob`, `pass`, `altmob`, `shop_location`, `map_location`, `rent_owner`, `shop_area`, `partner_owner`, `fr_status`, `regdate`) VALUES
(1, 'Peter+Winter', '', '555-555-01', 'Aura@2020', '555-555-01', '555-555-0199@example.com', '555-555-0199@example.com', 'Rent', '555', 'Partnership', 2, '2021-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(9) NOT NULL,
  `euid` int(9) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `euid`, `order_date`, `order_status`) VALUES
(5, 37, '2022-02-15', 1),
(6, 37, '2022-02-15', 1),
(7, 37, '2022-02-15', 2),
(8, 37, '2022-02-16', 0),
(9, 37, '2022-02-16', 2),
(10, 37, '2022-02-17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `pid` int(9) NOT NULL,
  `rate_id` int(9) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `order_item_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `pid`, `rate_id`, `qty`, `order_item_status`) VALUES
(12, 5, 4, 4, 1.00, 1),
(13, 6, 4, 4, 1.00, 1),
(14, 7, 2, 2, 2.00, 1),
(15, 8, 6, 6, 1.00, 1),
(16, 9, 6, 6, 2.00, 1),
(17, 6, 5, 5, 1.00, 1),
(18, 6, 6, 6, 1.00, 1),
(19, 7, 4, 4, 2.00, 1),
(20, 10, 7, 7, 1.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(9) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `pcode` varchar(25) NOT NULL,
  `hsncode` varchar(25) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `avbl_qty` varchar(50) NOT NULL,
  `pur_price` double(10,2) NOT NULL,
  `full_price` double(10,2) NOT NULL,
  `pdesc` varchar(5000) NOT NULL,
  `cod` varchar(50) NOT NULL,
  `delivery_charges` varchar(250) NOT NULL,
  `imgpath` varchar(100) NOT NULL,
  `sc_id` int(9) NOT NULL,
  `sid` int(9) NOT NULL,
  `regdate` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcode`, `hsncode`, `manufacturer`, `color`, `size`, `avbl_qty`, `pur_price`, `full_price`, `pdesc`, `cod`, `delivery_charges`, `imgpath`, `sc_id`, `sid`, `regdate`, `status`) VALUES
(1, 'saree', '', '', 'Zeel', 'Multi', 'NA', '10', 500.00, 999.00, 'saree', 'Not Available', 'Applicable', '/uploads/products/3_20211226070950.jpeg', 1, 3, '2021-12-26', 0),
(2, 'kurti with plazzo', '', '', 'devadi', 'yellow', 'L,XL,XXL', '100', 400.00, 1499.00, 'Heavy[sp][sp]rayon[sp][sp]16[sp][sp]kg.[sp][sp]neck[sp][sp]embroidery&amp;[sp][sp]dori[sp][sp]3/4[sp][sp]hand[sp][sp]length[sp][sp]40&quot;[nl]plazzo:-[sp][sp]Bottom[sp][sp]one[sp][sp]side[sp][sp]pocket[sp][sp][nl]length[sp][sp]-[sp][sp]39&quot;[nl]bottom[sp][sp]-24&quot;', 'Not Available', 'Not Applicable', '/uploads/products/3_20220125105000.png', 2, 3, '2022-01-25', 1),
(3, 'Ramjat', '', '', 'fvd', '8', 'L,XL,XXL', '150', 499.00, 1899.00, 'Catalog[sp][sp]name-[sp][sp]??[sp][sp]Ramzat[sp][sp]??[nl][nl]??????Fabric[sp][sp]Details??????[nl][nl]??????TOP??????[nl]??Fabric:[sp][sp][sp][sp]semi[sp][sp]satin[sp][sp]Cotton[sp][sp]with[sp][sp]inner[sp][sp][nl]??Size-[sp][sp]L(40)[sp][sp]XL(42)[sp][sp]XXL(44)[nl]??Length:40[sp][sp]Inches[nl][nl][nl]??????BOTTOM??????[nl]??Fabric:[sp][sp][sp][sp][sp][sp]cotton[sp][sp]with[sp][sp]embroidery[sp][sp]work[sp][sp][nl][nl]With[sp][sp]Embroidery[sp][sp]work[sp][sp][nl][nl]??Size-[sp][sp]Free[sp][sp]Size[sp][sp]Fits[sp][sp]34[sp][sp]to[sp][sp]42waist[nl][nl]??Length:40[sp][sp]Inches[nl][nl]??Bottom[sp][sp]Style:Patiyala[nl][nl]??????DUPATTA??????[nl]Fabric:[sp][sp]Shiburi[sp][sp]Duppata[sp][sp][nl]Length:2.metre[sp][sp]fancy[sp][sp]shiboori[sp][sp]Duppata[sp][sp][nl]Fully[sp][sp]Stitched[sp][sp][nl]', 'Not Available', 'Not Applicable', '/uploads/products/3_20220125110015.jpeg', 4, 3, '2022-01-25', 0),
(4, 'Bandhani work', '', '', 'FVD', '4', 'Unstitch', '16', 450.00, 1099.00, 'Bandhani[sp][sp]work[sp][sp]Dress[sp][sp]Material[sp][sp][nl]Top-[sp][sp][sp][sp][sp][sp]Slubcotton[sp][sp]with[sp][sp]embroidery[sp][sp]work[sp][sp](2[sp][sp]mtr[sp][sp])[nl]Bottom[sp][sp]-[sp][sp]COTTON[sp][sp]2.mtr[sp][sp])[nl]Dupatta[sp][sp][sp][sp]-[sp][sp]chiffon[sp][sp]with[sp][sp]foil[sp][sp]print[sp][sp][sp][sp][sp][sp][sp][sp](2.[sp][sp]MTR[sp][sp]', 'Not Available', 'Not Applicable', '/uploads/products/3_20220126103409.jpeg', 4, 3, '2022-01-26', 1),
(5, 'kurtis with bottom', '', '', 'FVD', '8', 'L,XL,XXL', '16', 750.00, 1599.00, 'TOP[sp][sp]:-[sp][sp]PURE[sp][sp]RAYON[sp][sp]14[sp][sp]KG[nl]BOTTOM[sp][sp]:-[sp][sp]PURE[sp][sp]RAYON[sp][sp]14[sp][sp]KG[sp][sp]WITH[sp][sp]BEAUTIFUL[sp][sp]WORK[nl]?Size[sp][sp]-[sp][sp]L-40,xl-42,xxl-44[nl]', 'Not Available', 'Not Applicable', '/uploads/products/3_20220126104555.jpeg', 2, 3, '2022-01-26', 1),
(6, 'cotton kurti', '', '', 'zenny', 'SINGLE', 'M,L,XL,XXL', '8', 230.00, 899.00, 'Fabric:[sp][sp][sp][sp]Cotton[nl]Neck:[sp][sp]Round[nl]Style:[sp][sp][sp][sp]Straight[sp][sp][nl]Work:[sp][sp]Digital[sp][sp]Print[nl]Sleeves:[sp][sp]3/4[nl]Stitch[sp][sp]Type:[sp][sp]Full[sp][sp]Stitched[nl]Size:[sp][sp]M,[sp][sp]L,[sp][sp]XL,[sp][sp]XXL[nl]Length[sp][sp]46', 'Not Available', 'Not Applicable', '/uploads/products/3_20220126122724.jpeg', 2, 3, '2022-01-26', 1),
(7, 'sample', '', '', 'ABC', 'Red', 'None', '5', 500.00, 700.00, 'None', 'Available', 'Applicable', '/uploads/products/2_20220217075113.jpg', 6, 2, '2022-02-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `pimg_id` int(9) NOT NULL,
  `imgpath` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pid` int(9) NOT NULL,
  `sid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_img`
--

INSERT INTO `product_img` (`pimg_id`, `imgpath`, `status`, `pid`, `sid`) VALUES
(1, '/uploads/products_images/3_0_20211226070951.jpeg', 1, 1, 3),
(2, '/uploads/products_images/3_1_20211226070951.jpeg', 1, 1, 3),
(3, '/uploads/products_images/3_2_20211226070951.jpeg', 1, 1, 3),
(4, '/uploads/products_images/3_3_20211226070951.jpeg', 1, 1, 3),
(5, '/uploads/products_images/3_4_20211226070951.jpeg', 1, 1, 3),
(6, '/uploads/products_images/3_5_20211226070951.jpeg', 1, 1, 3),
(7, '/uploads/products_images/3_0_20220125105000.png', 1, 2, 3),
(8, '/uploads/products_images/3_1_20220125105000.png', 1, 2, 3),
(9, '/uploads/products_images/3_2_20220125105000.png', 1, 2, 3),
(10, '/uploads/products_images/3_4_20220125105000.png', 1, 2, 3),
(11, '/uploads/products_images/3_0_20220125110015.jpeg', 1, 3, 3),
(12, '/uploads/products_images/3_1_20220125110015.jpeg', 1, 3, 3),
(13, '/uploads/products_images/3_2_20220125110015.jpeg', 1, 3, 3),
(14, '/uploads/products_images/3_3_20220125110015.jpeg', 1, 3, 3),
(15, '/uploads/products_images/3_4_20220125110015.jpeg', 1, 3, 3),
(16, '/uploads/products_images/3_5_20220125110015.jpeg', 1, 3, 3),
(17, '/uploads/products_images/3_6_20220125110015.jpeg', 1, 3, 3),
(18, '/uploads/products_images/3_0_20220126103409.jpeg', 1, 4, 3),
(19, '/uploads/products_images/3_1_20220126103409.jpeg', 1, 4, 3),
(20, '/uploads/products_images/3_2_20220126103409.jpeg', 1, 4, 3),
(21, '/uploads/products_images/3_3_20220126103409.jpeg', 1, 4, 3),
(22, '/uploads/products_images/3_0_20220126104555.jpeg', 1, 5, 3),
(23, '/uploads/products_images/3_1_20220126104555.jpeg', 1, 5, 3),
(24, '/uploads/products_images/3_2_20220126104555.jpeg', 1, 5, 3),
(25, '/uploads/products_images/3_3_20220126104555.jpeg', 1, 5, 3),
(26, '/uploads/products_images/3_4_20220126104555.jpeg', 1, 5, 3),
(27, '/uploads/products_images/3_5_20220126104555.jpeg', 1, 5, 3),
(28, '/uploads/products_images/3_6_20220126104555.jpeg', 1, 5, 3),
(29, '/uploads/products_images/3_0_20220126122724.jpeg', 1, 6, 3),
(30, '/uploads/products_images/2_0_20220217075114.jpg', 1, 7, 2),
(31, '/uploads/products_images/2_1_20220217075114.jpg', 1, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(9) NOT NULL,
  `pid` int(9) NOT NULL,
  `price` double(10,2) NOT NULL,
  `cgst` double(10,2) NOT NULL,
  `sgst` double(10,2) NOT NULL,
  `igst` double(10,2) NOT NULL,
  `rate_status` tinyint(1) NOT NULL,
  `rate_date` date NOT NULL,
  `sid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `pid`, `price`, `cgst`, `sgst`, `igst`, `rate_status`, `rate_date`, `sid`) VALUES
(1, 1, 600.00, 0.00, 0.00, 0.00, 1, '2021-12-26', 3),
(2, 2, 699.00, 0.00, 0.00, 0.00, 1, '2022-01-25', 3),
(3, 3, 949.00, 0.00, 0.00, 0.00, 1, '2022-01-25', 3),
(4, 4, 649.00, 0.00, 0.00, 0.00, 1, '2022-01-26', 3),
(5, 5, 949.00, 0.00, 0.00, 0.00, 1, '2022-01-26', 3),
(6, 6, 429.00, 0.00, 0.00, 0.00, 1, '2022-01-26', 3),
(7, 7, 600.00, 0.00, 0.00, 0.00, 1, '2022-02-17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `sid` int(9) NOT NULL,
  `sname` varchar(250) NOT NULL,
  `smob` varchar(13) NOT NULL,
  `spass` varchar(50) NOT NULL,
  `altmob` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `pincode` int(6) NOT NULL,
  `btype` varchar(100) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `ac_no` varchar(20) NOT NULL,
  `ac_name` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `ifsc` varchar(50) NOT NULL,
  `regdate` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sid`, `sname`, `smob`, `spass`, `altmob`, `email`, `address`, `pincode`, `btype`, `gst`, `ac_no`, `ac_name`, `bank_name`, `ifsc`, `regdate`, `status`) VALUES
(2, 'Zelos Infotech', '8888789402', '123456', '9975508577', 'zelosinfotech@gmail.com', 'Pasaydan Complex, Manchar', 410503, '', '0123456789', '550001010050703', 'Zelos Infotech', 'Union Bank Of India', 'UBIN00012', '2021-07-17', 1),
(3, 'Loco Seller', '8698208208', '123', '8888789402', 'zelosit@gmail.com', 'chakan', 410501, 'Partnership', '12457896', '550001010050703', 'Loco Sale', 'union bank of india', 'UBIN0570575', '2021-12-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(9) NOT NULL,
  `slider_name` varchar(100) NOT NULL,
  `imgpath` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `regdate` date NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_name`, `imgpath`, `status`, `regdate`, `uid`) VALUES
(4, 'Slider 1', '/uploads/slider/7_20211023042137.png', 1, '2021-10-23', 7),
(5, 'Slider2', '/uploads/slider/7_20211023042226.png', 1, '2021-10-23', 7),
(6, 'Slider 3', '/uploads/slider/7_20211023042319.png', 1, '2021-10-23', 7);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sc_id` int(9) NOT NULL,
  `sc_name` varchar(150) NOT NULL,
  `imgpath` varchar(150) NOT NULL,
  `regdate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uid` int(9) NOT NULL,
  `cid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sc_id`, `sc_name`, `imgpath`, `regdate`, `status`, `uid`, `cid`) VALUES
(1, 'Saree', '/uploads/subcategory/1_20210318082441.png', '2021-03-18', 1, 1, 4),
(2, 'Kurtiz', '/uploads/subcategory/1_20210318082542.png', '2021-03-18', 1, 1, 4),
(3, 'Lehanga Choli', '/uploads/subcategory/1_20210318082903.png', '2021-03-18', 1, 1, 4),
(4, 'Dress Material', '/uploads/subcategory/1_20210318082937.png', '2021-03-18', 1, 1, 4),
(5, 'Plazoo &amp; Pants', '/uploads/subcategory/1_20210318083005.png', '2021-03-18', 1, 1, 4),
(6, 'Dupatta', '/uploads/subcategory/1_20210318083030.png', '2021-03-18', 1, 1, 4),
(7, 'T Shirt', '/uploads/subcategory/1_20210318083052.png', '2021-03-18', 1, 1, 4),
(8, 'jeans &amp; Jeggings', '/uploads/subcategory/1_20210318083259.png', '2021-03-18', 0, 1, 4),
(9, 'Jeans &amp; Jeggings', '/uploads/subcategory/1_20210318083337.png', '2021-03-18', 1, 1, 4),
(10, 'Tops', '/uploads/subcategory/1_20210318083552.png', '2021-03-18', 1, 1, 4),
(11, 'Dresses', '/uploads/subcategory/1_20210318083620.png', '2021-03-18', 1, 1, 4),
(12, 'Maternity&amp; feeding', '/uploads/subcategory/1_20210318083713.png', '2021-03-18', 1, 1, 4),
(13, 'Skirts', '/uploads/subcategory/1_20210318084046.png', '2021-03-18', 1, 1, 4),
(14, 'KAZE', '/uploads/subcategory/1_20210812034452.jpg', '2021-08-12', 0, 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(9) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `uregdate` datetime NOT NULL,
  `utype` int(9) NOT NULL,
  `ustatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `pass`, `uregdate`, `utype`, `ustatus`) VALUES
(1, 'admin', 'admin', '2019-11-01 00:00:00', 1, 1),
(7, 'soham', 'soham', '2020-11-02 18:28:25', 1, 1),
(8, 'tata', 'tata', '2020-11-16 16:41:23', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`comp_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `end_user`
--
ALTER TABLE `end_user`
  ADD PRIMARY KEY (`euid`);

--
-- Indexes for table `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`fr_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fr_id` (`euid`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `rate_id` (`rate_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `sc_id` (`sc_id`),
  ADD KEY `uid` (`sid`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`pimg_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`sid`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`sid`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sc_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `comp_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `end_user`
--
ALTER TABLE `end_user`
  MODIFY `euid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `franchise`
--
ALTER TABLE `franchise`
  MODIFY `fr_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `pimg_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `sid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sc_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD CONSTRAINT `company_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`euid`) REFERENCES `end_user` (`euid`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`rate_id`) REFERENCES `rate` (`rate_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`sc_id`) REFERENCES `sub_category` (`sc_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `seller` (`sid`);

--
-- Constraints for table `product_img`
--
ALTER TABLE `product_img`
  ADD CONSTRAINT `product_img_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
  ADD CONSTRAINT `product_img_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `seller` (`sid`);

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `seller` (`sid`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `sub_category_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
