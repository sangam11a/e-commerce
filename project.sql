-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 01:01 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(8) NOT NULL,
  `otp_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `otp`, `otp_time`) VALUES
(1, 'admin', '$2y$10$oxc6nKScHklAgufLVR6TPufk/QERLmc3JTHsGbu4FN5YNqDwo6.3O', 'sajankhad2@gmail.com', 411446, '2022-02-23 05:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `customer_id`, `qty`) VALUES
(74, 36, 2, 2),
(78, 34, 14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ct_id` bigint(20) NOT NULL,
  `ct_name` varchar(255) NOT NULL,
  `ct_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ct_id`, `ct_name`, `ct_desc`) VALUES
(16, 'Rice Cooker', 'Contains rice cooker of various brand'),
(18, 'IRON', 'Contains irons of various brands.'),
(20, 'MIXER-Grinder', 'Contains mixer and grinders of various brands.'),
(21, 'Refrigerator', 'Freeze till you wish'),
(22, 'Microwave', 'Heat it till its micro particles'),
(23, 'Griller', 'Something smells good &#x263A'),
(24, 'Thermos Flask', 'Your temperature might change but its wont'),
(25, 'Kettle', 'Metal kettle heats it better'),
(26, 'Induction Stove', 'Induction store better than gas'),
(27, 'Coffee Maker', 'Caffine too Fine'),
(28, 'Heater', 'Heats your heart till its warm\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login_type` varchar(255) NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `email`, `password`, `name`, `login_type`, `contact`) VALUES
(1, 'sajankhad1@gmail.com', '$2y$10$obEmTRHHjTWJkE1LlZgxve25CWsYfGkB4ZRLZU11tpV.DnO1VZMP2', 'Ryan Jordan', 'custom', '9865284390'),
(2, 'sajankhad2@gmail.com', '$2y$10$FpxO1WJqz6qGttqdjbzlAebXjvzhKrrZi3Ua3bWOcGFb0IGPipBP.', 'Sajan Khadka', 'custom', '9865284390'),
(14, 'store.homeappliance@gmail.com', 'qwertyuiop', 'Home Appliance Store', 'gmail', '5435643534');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `del_id` bigint(20) NOT NULL,
  `del_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`del_id`, `del_user`, `password`) VALUES
(2, 'Sam WikWiki', '$2y$10$ow0LRvMNu.GJeiAbBta0P.iXhe2PAp7ewqB.22NWz.9RFE5TJHlUO'),
(4, 'SamWIkWIKI 43254', '$2y$10$5DQfsH1rNlJcFSyomweHPedx0ACwiEp5XrRlzv/W./l/Obr1KECCm'),
(6, 'asda', '$2y$10$qqABejJDqjXiApz71A3eKuOiz2.jhnKqFFEvrdBj21wVeKx7HxQNK'),
(7, 'dasda', '$2y$10$lgCk2k6J1w.67yeUFYCoreRuWzk0N18Z/8i.OXHwSuChxS6Jg8sia'),
(8, 'sdadaf', '$2y$10$vlmTP.gtv.QDXgv7Sb5lYOrc7pKMrvgJ.lkuUbVkBgebD3lkXlNzy'),
(9, 'aaaaaaaaaaaaaaaaaaaaaaaaa', '$2y$10$4llemkjuqjS1KTwU9f1NUOPv7lcNZSF6cG9Nz6plGZrRq97/Kp6bG'),
(10, 'WWWWWWWWWWWWWWWWWWWWWWWWW', '$2y$10$4l4tkODY0pDj08aZupnTmOB1g.OdWc2c2sijZzaS88RLr4V.1TFKa');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `productid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_type` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_address` varchar(255) NOT NULL,
  `order_delivered` tinyint(1) NOT NULL,
  `payment_received` tinyint(1) NOT NULL,
  `sold` tinyint(1) NOT NULL,
  `bill_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `productid`, `quantity`, `payment_type`, `amount`, `order_date`, `order_address`, `order_delivered`, `payment_received`, `sold`, `bill_no`) VALUES
(19, 2, 38, 5, 'cash', '2323.00', '2022-02-09 12:16:37', 'dfdf,dfdsfds,AUT,99502', 1, 1, 1, 'COD-2-1644230044'),
(20, 2, 33, 15, 'esewa', '2578.00', '2022-02-09 12:16:51', 'dfdf,dfdsfds,AUT,99502', 1, 1, 1, 'COD-2-1644235287'),
(21, 1, 32, 19, 'esewa', '4000.00', '2021-02-09 13:16:44', 'dfdf,dfdsfds,AUT,99502', 1, 1, 1, 'ES-1-1644236921'),
(22, 14, 34, 5, 'cash', '12500.00', '2022-02-04 13:08:51', 'baluwatar,Kathmandu,NPL,3434', 1, 1, 1, 'COD-14-1644324271'),
(23, 14, 36, 4, 'cash', '8000.00', '2022-01-24 13:09:06', 'baluwatar,Kathmandu,NPL,3434', 1, 1, 1, 'COD-14-1644324271'),
(24, 14, 38, 3, 'cash', '6969.00', '2022-02-18 12:00:47', 'dfdf,dfdsfds,AUT,99502', 1, 1, 1, 'COD-14-1644407099'),
(25, 1, 38, 1, 'cash', '2323.00', '2022-02-18 11:56:11', 'sd,ds,HTI,dsd', 1, 1, 1, 'COD-1-1645185168'),
(26, 1, 34, 1, 'cash', '2500.00', '2022-02-18 12:00:59', 'sd,ds,HTI,dsd', 1, 1, 1, 'COD-1-1645185473'),
(27, 1, 36, 1, 'cash', '2000.00', '2022-02-19 04:16:51', 'sd,ds,HTI,dsd', 1, 1, 1, 'COD-1-1645185807'),
(28, 2, 32, 2, 'cash', '8000.00', '2022-02-19 04:16:32', 'sd,ds,GNB,dsd', 1, 1, 1, 'COD-2-1645244020'),
(29, 14, 32, 1, 'esewa', '4000.00', '2022-02-23 11:41:00', 'sd,ds,HTI,dsd', 1, 1, 1, 'ES-14-1645616366'),
(30, 14, 36, 3, 'esewa', '6000.00', '2022-02-23 11:41:02', 'sd,ds,HTI,dsd', 1, 1, 1, 'ES-14-1645616366');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pr_id` bigint(20) NOT NULL,
  `pr_name` varchar(255) NOT NULL,
  `pr_desc` varchar(255) NOT NULL,
  `pr_img` varchar(255) NOT NULL,
  `pr_price` decimal(10,2) NOT NULL,
  `pr_qty` int(10) NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `pr_brand` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pr_id`, `pr_name`, `pr_desc`, `pr_img`, `pr_price`, `pr_qty`, `cat_id`, `pr_brand`, `stock`) VALUES
(32, 'Cuckoo', 'Cuckoo Rice cooker 3ltrs.', '61739377739746.47834196.png', '4000.00', 43, 16, 'Cucckooo', 52),
(33, 'Pigeon Cooker', 'Volume: 2Ltrs\r\nVoltage: 220V - 50Hz.', '617395003043b8.09776234.jpg', '2579.00', 26, 16, 'Pigeon', 50),
(34, 'Multi Mixture', 'Grinder Mixture with 3 different sizes of mixture cups.', '61739582043542.02911359.png', '2500.00', 16, 20, 'Bajaj', 50),
(35, 'Havels Mixture', 'Warranty: 1 yrs warranty\r\nVoltge: 220V - 50Hz\r\n\r\n\r\n', '61739622039b99.48772257.jpg', '1400.00', 20, 20, 'Havels', 50),
(36, 'Iron', 'Usha Iron \r\nRating: 1500W', '617396be7e1ba5.55034550.jpg', '2000.00', 14, 18, 'Usha', 52),
(38, 'Irony', '1KW 220V Iron with transparent outer cover.', '61e935a8c96e87.77582794.jpg', '2323.00', 190, 18, 'Philips', 200);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `rate_points` decimal(2,1) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `feedback_reply` varchar(255) NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `customer_id`, `rate_points`, `feedback`, `feedback_reply`, `product_id`) VALUES
(9, 14, '3.5', 'nice product', 'Thank you', 36),
(16, 14, '4.5', 'kjkj', '&#x263A', 32),
(20, 2, '4.5', '4.5', 'thank you', 33);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `sales_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `sales_qty`) VALUES
(1, 38, 9),
(6, 33, 15),
(7, 32, 22),
(8, 34, 6),
(9, 36, 8);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `wish_id` bigint(20) NOT NULL,
  `wish_cust` bigint(20) NOT NULL,
  `wish_product` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`wish_id`, `wish_cust`, `wish_product`) VALUES
(22, 14, 37),
(23, 14, 33),
(25, 1, 32),
(27, 2, 36),
(28, 2, 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`del_id`),
  ADD UNIQUE KEY `del_user` (`del_user`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordersss` (`productid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales` (`product_id`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ct_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `del_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `wish_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ordersss` FOREIGN KEY (`productid`) REFERENCES `products` (`pr_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`ct_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales` FOREIGN KEY (`product_id`) REFERENCES `products` (`pr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
