-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 07:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tbl_petz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `log` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `user_type`, `flag`, `log`) VALUES
(1, 'admin', 'admin', 'A', 1, '2024-02-29 09:55:31'),
(2, 'user', 'user', 'U', 1, '2024-02-29 09:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_navbar_pages`
--

CREATE TABLE `tbl_navbar_pages` (
  `navbar_pages_id` int(11) NOT NULL,
  `navbar_title_id` int(10) NOT NULL,
  `navbar_page` varchar(20) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_navbar_pages`
--

INSERT INTO `tbl_navbar_pages` (`navbar_pages_id`, `navbar_title_id`, `navbar_page`, `flag`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dry Food', 1, '2024-06-18 16:52:55', '2024-06-18 16:52:55'),
(2, 1, 'Wet Food', 1, '2024-06-18 16:53:14', '2024-06-18 16:53:42'),
(3, 1, 'Puppy Food', 1, '2024-06-18 16:57:38', '2024-06-18 16:57:38'),
(4, 1, 'Fresh Food', 1, '2024-06-18 16:57:55', '2024-06-18 16:57:55'),
(5, 1, 'Chicken Treats', 1, '2024-06-18 16:59:00', '2024-06-18 16:59:00'),
(6, 1, 'Chew Toys', 1, '2024-06-18 16:59:36', '2024-06-18 16:59:36'),
(7, 1, 'Plush Toys', 1, '2024-06-18 16:59:51', '2024-06-18 16:59:51'),
(8, 2, 'Dry Food', 1, '2024-06-18 17:01:58', '2024-06-18 17:01:58'),
(9, 2, 'Wet Food', 1, '2024-06-18 17:02:10', '2024-06-18 17:02:10'),
(10, 2, 'Puppy Food', 1, '2024-06-18 17:02:28', '2024-06-18 17:02:28'),
(11, 2, 'Fresh Food', 1, '2024-06-18 17:03:06', '2024-06-18 17:03:06'),
(12, 2, 'Chicken Treats', 1, '2024-06-18 17:03:18', '2024-06-18 17:03:18'),
(13, 3, 'beeboji', 1, '2024-06-18 17:04:16', '2024-06-18 17:04:16'),
(14, 3, 'pedigree', 1, '2024-06-18 17:04:26', '2024-06-18 17:04:26'),
(15, 4, 'Van Grooming', 1, '2024-06-18 17:04:47', '2024-06-18 17:04:47'),
(16, 4, 'At Experience Center', 1, '2024-06-18 17:05:10', '2024-06-18 17:05:10'),
(17, 5, 'vet consultation', 1, '2024-06-18 17:05:34', '2024-06-18 17:05:34'),
(18, 5, 'E-pharmacy', 1, '2024-06-18 17:06:02', '2024-06-18 17:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_navbar_title`
--

CREATE TABLE `tbl_navbar_title` (
  `navbar_title_id` int(11) NOT NULL,
  `navbar_title` varchar(25) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_navbar_title`
--

INSERT INTO `tbl_navbar_title` (`navbar_title_id`, `navbar_title`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'DOGS', 1, '2024-06-18 16:45:53', '2024-06-18 16:45:53'),
(2, 'CATS', 1, '2024-06-18 16:48:38', '2024-06-18 16:48:38'),
(3, 'BRANDS', 1, '2024-06-18 16:48:48', '2024-06-18 16:48:48'),
(4, 'PET GROOMING', 1, '2024-06-18 16:49:05', '2024-06-18 16:49:05'),
(5, 'VET CARE', 1, '2024-06-18 16:49:16', '2024-06-18 16:49:16'),
(6, 'HAPPY PETS', 1, '2024-06-18 16:49:28', '2024-06-18 16:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `navbar_title_id` varchar(11) NOT NULL,
  `navbar_page_id` varchar(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `offer_price` int(11) NOT NULL,
  `discount_percentage` varchar(11) NOT NULL,
  `sizes` varchar(255) NOT NULL,
  `arrival_status` varchar(40) NOT NULL,
  `stock_status` varchar(40) NOT NULL,
  `product_img` varchar(100) NOT NULL,
  `img_1` varchar(100) NOT NULL,
  `img_2` varchar(100) NOT NULL,
  `img_3` varchar(100) NOT NULL,
  `key_feature` varchar(355) NOT NULL,
  `details` varchar(355) NOT NULL,
  `ingredient_details` varchar(355) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `navbar_title_id`, `navbar_page_id`, `product_name`, `brand`, `price`, `offer_price`, `discount_percentage`, `sizes`, `arrival_status`, `stock_status`, `product_img`, `img_1`, `img_2`, `img_3`, `key_feature`, `details`, `ingredient_details`, `keywords`, `flag`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'Royal Canin Mini Puppy Dry Food', 'Royal Canin', 900, 855, '5', '', '0', '1', '/uploads/ProductImg/p11.jpg', '/uploads/Img1/p12.jpg', '/uploads/Img2/p11.jpg', '/uploads/Img3/p13.jpg', 'QUALITY NUTRITION: Meets the energy demands of small breeds puppies.\r\nIMMUNE SYSTEM SUPPORT: Growth is an essential stage in your dog’s life: it is the time of big changes, discoveries and new encounters. During this key period, the puppy’s immune system develops gradually. Mini Puppy helps support your puppy’s natural defences thanks particularly to a ', 'Same day delivery in NCR Region only on Pre Paid orders above ₹1499.\r\nOnly valid on orders placed before 3PM.', 'This Royal Canin formula supports your young pet\'s juvenile immune system when it\'s still maturing. The many beneficial nutrients in this recipe help support your puppy\'s general digestive health. The wet dog food\'s intense energy content meets the high energy demands of your small breed pup.', '', 1, '2024-06-18 17:11:47', '2024-06-18 17:11:47'),
(2, '1', '1', 'Skip to the beginning of the images gallery Pedigree Chicken & Vegetables Adult Dry Dog Food', 'Pedgree', 725, 688, '5', '', '1', '1', '/uploads/ProductImg/p21.jpg', '/uploads/Img1/p22.jpg', '/uploads/Img2/p23.jpg', '/uploads/Img3/p24.jpg', 'Contains special vegetable oils for healthy skin and coat. It contains a special blend of:a) Linoleic Acid (Omega 6)b) Zinc for healthy skin &amp; lustrous coat', '\r\nEnsure your pet grows happy and healthy! Pedigree brings your adult dog a complete and balanced meal. The recipe helps give your pet a shiny coat and stronger bones and muscles. The goodness of cereals, chicken, and nutrients together offer a tasty and healthy diet for your canine friend. NOTE: Pedigree recipes are developed based on research by the W', 'Meat and Meat by-products, Chicken and Chicken by-products, Vegetables and Vegetable by-products, Vegetable oils, Milk powder, Iodised salt, Essential Vitamins and Minerals, Cereals and Cereal by-products, Permitted Preservatives, Antioxidants and Flavours', '', 1, '2024-06-18 17:17:07', '2024-06-18 17:17:07'),
(3, '2', '9', 'Sheba Mix Flavour Wet Cat Food Combo - Pack of 2', 'Sheba', 205, 194, '5', '', '1', '1', '/uploads/ProductImg/p31.jpg', '/uploads/Img1/p31.jpg', '/uploads/Img2/p31.jpg', '/uploads/Img3/p31.jpg', 'OPTIMAL NUTRITION: Provides a natural source of vital protein and minerals.\r\nPREMIUM TASTE: Tender fish cuts in savoury gravy.\r\nHIGHLY PALATABLE: For the complete development and well being of cats.\r\nFOR CATS: Suitable for cats belonging to all breeds.\r\nNO PRESERVATIVES: No added artificial colours', 'That tantalizing aroma doesn’t just get your cat’s mouth-watering, now, does it? Sheba’s Delux Premium Wet Food is the perfect amalgamation of where nutrition meets taste and where taste meets appetite!\r\n\r\nThis is a soft, wet food meal made with real, high-quality meat as the first ingredient. Made with responsibly sourced ingredients, Sheba’s Wet Food ', '', '', 1, '2024-06-18 17:20:00', '2024-06-18 17:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_navbar_pages`
--
ALTER TABLE `tbl_navbar_pages`
  ADD PRIMARY KEY (`navbar_pages_id`);

--
-- Indexes for table `tbl_navbar_title`
--
ALTER TABLE `tbl_navbar_title`
  ADD PRIMARY KEY (`navbar_title_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_navbar_pages`
--
ALTER TABLE `tbl_navbar_pages`
  MODIFY `navbar_pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_navbar_title`
--
ALTER TABLE `tbl_navbar_title`
  MODIFY `navbar_title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
