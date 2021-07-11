-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2021 at 07:24 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sthaniya_khana`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(26, 'kismat', 'kismat', '96c84fdad49346e6640846b91c661a06'),
(27, 'sushan', 'sushan', '4f5a196bd1ae4f5dc19267e127af76d4'),
(28, 'saurav', 'saurav', '8cf674180ea201eb14b12486eaef9f28'),
(29, '1', '1', 'c81e728d9d4c2f636f067f89cc14862c'),
(31, 'Kushal Shah', 'kushal000', 'c4ca4238a0b923820dcc509a6f75849b'),
(33, 'Wade Armstrong', 'bnb_armstrong', '2589597838b8b4e9a4b99ba59dc4bd3a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(18, 'Newari Khana Set', 'Food_category_829.jpg', 'Yes', 'Yes'),
(19, 'Thakali Khana Set', 'Food_category_73.jpg', 'Yes', 'Yes'),
(20, 'Himalyan Khana Set', 'Food_category_521.jpg', 'Yes', 'Yes'),
(21, 'Mithila Khana Set', 'Food_category555.jpg', 'Yes', 'Yes'),
(22, 'Western Khana', 'Food_category_812.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(11, 'Thakali Khana Set', 'Bhat, dhal, saag, timur taama aachar, taseko aalu, maasu', '450.00', 'Food_name_578.jpg', 19, 'Yes', 'Yes'),
(12, 'Newari Khana Set', 'Chiura, Choila , Kachaila, aalu gravy, bhatmas, taama-bodhi, chana, aalu kakaro aachar, jhaneko lasun', '750.00', 'Food_name_286.jpg', 18, 'Yes', 'Yes'),
(13, 'Mithila Khana Set', 'bhat, daal, tarkari, taruwa, aapko achar, papad, dhungri, tarkari/ khasi maasu, curri-bari', '450.00', 'Food_name_138.jpg', 21, 'Yes', 'Yes'),
(14, 'Himalyan Khana Set', 'dhilo, local kukhura, gundruk bhatmas, tarkari, maseko aalu , mula aachar', '550.00', 'Food_name_2.jpg', 20, 'Yes', 'Yes'),
(15, 'Ramen', 'Chicken ramen with full bowl of tar and pork fat, half boiled egg with lots of magical flavours', '450.00', 'Food_name_297.jpg', 22, 'No', 'Yes'),
(16, 'Burger', 'Veg / Chicken / Cheese ', '250.00', 'Food_name_925.jpg', 22, 'No', 'Yes'),
(17, 'Momo', 'Steam / Fry / Seasoned.\r\n\r\nVeg/ Buff/ Chicken/ Paneer', '250.00', 'Food_name_627.jpg', 18, 'Yes', 'Yes'),
(18, 'Chowmein', 'Veg / Chicken / Buff ', '250.00', 'Food_name_361.jpg', 20, 'Yes', 'Yes'),
(19, 'White Forest Cake ', 'Strawberry toppings with dark chocolate flakes', '900.00', 'Food_name_654.jpg', 22, 'No', 'Yes'),
(20, 'Gujiya', 'Filled with Khoya and soaked in guliyo chasni', '50.00', 'Food_name_829.jpg', 21, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `customer_contact` varchar(10) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `total`) VALUES
(1, 'Thakali Khana Set', '450.00', 3, '2021-07-09 11:05:07', 'Delivered', 'sarry 971', '9876543654', 'abcd@xyz.com', 'Kusunti-04, Lalitpur, Nepal', '1350'),
(2, 'Momo', '250.00', 4, '2021-07-09 11:05:45', 'Ordered', 'Sushan Gautam', '9876543654', 'sushan@sushan.com', 'bkljbkhbkjlbkj', '1000'),
(3, 'Chowmein', '250.00', 3, '2021-07-09 11:06:58', 'Ordered', 'Kismat Khatri', '9876543212', 'kismat@kisamt.com', 'kisamt', '750'),
(4, 'Ramen', '450.00', 2, '2021-07-09 11:11:33', 'Delivered', 'Ramen Boi', '1234567898', 'ramen@ramen.com', 'to the moon', '900'),
(5, 'Gujiya', '50.00', 3, '2021-07-10 12:08:20', 'Cancelled', 'Kushal', '9876543212', 'abcd@xyz.com', 'Baneshwor, Kathmandu', '150'),
(6, 'Mithila Khana Set', '450.00', 2, '2021-07-10 04:45:18', 'Delivered', 'Bnb Armstrong', '9876543212', 'bnb_armstrong345@gmail.co', 'bjkbhkbjljbkj', '900'),
(7, 'Ramen', '450.00', 1, '2021-07-10 04:55:36', 'Delivered', 'Bnb Armstrong', '9876543212', 'bnb_armstrong345@gmail.co', 'hvjhkhkbnb', '450'),
(15, 'Gujiya', '50.00', 1, '2021-07-10 07:03:33', 'Ordered', 'dhungreu', '6677998877', 'dhungreu@live.con', 'dhungreu niwas, sadhan marg', '50'),
(16, 'White Forest Cake ', '900.00', 1, '2021-07-11 06:54:49', 'Ordered', 'dhungreu', '9876543654', 'dhungreu@live.con', 'jhvhhjbjk', '900');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `card_name` varchar(30) NOT NULL,
  `card_number` int(14) NOT NULL,
  `cvv_number` int(3) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `card_name`, `card_number`, `cvv_number`, `expiry_date`) VALUES
(2, 'Dhungreu Styaliov', 2147483647, 123, '2024-11-20'),
(3, 'sarry', 2147483647, 777, '2021-07-20'),
(4, 'sushan gautam', 2147483647, 456, '2021-07-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
