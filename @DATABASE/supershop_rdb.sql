-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 06:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supershop_rdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'ADMINS ID',
  `admin_name` varchar(64) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `admin_type` enum('Root Admin','Content Manager','Sales Manager','Technical Operator') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `admin_email`, `admin_image`, `admin_password`, `admin_status`, `admin_type`, `created_at`, `updated_at`) VALUES
(1, 'Nirjhor Anjum Sir', 'nirjhor@adnsl.net', 'ADMINIMAGE_20200706021804_nirjhoranjumsir.png', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Root Admin', '2020-07-06 02:18:04', NULL),
(2, 'Md. Abdullah Al Mamun Roni', 'md.aamroni@hotmail.com', 'ADMINIMAGE_20200706021844_aamroni.png', '04974f51537a701bcdf340064418a10d3895dde1', 'Active', 'Root Admin', '2020-07-06 02:18:44', NULL),
(3, 'Jhon Doe', 'jhondoe@gmail.com', 'ADMINIMAGE_20200706021940_jhon.png', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Content Manager', '2020-07-06 02:19:40', NULL),
(4, 'Al Mamun', 'md.aamroni@yahoo.com', 'ADMINIMAGE_20200706022232_roni.jpg', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Technical Operator', '2020-07-06 02:22:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'CATEGORIES ID',
  `category_name` varchar(64) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'MEN', 'Active', NULL, NULL),
(2, 'WOMEN', 'Active', NULL, NULL),
(3, 'KIDS', 'Active', NULL, NULL),
(4, 'HOME DECOR', 'Active', NULL, NULL),
(5, 'WEDDING', 'Active', NULL, NULL),
(7, 'ELECTRONICS', 'Active', NULL, NULL),
(8, 'WATCHES', 'Active', NULL, NULL),
(9, 'SHOES', 'Active', NULL, NULL),
(10, 'ACCESSORIES', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL COMMENT 'CONTACTS ID',
  `contacts_name` varchar(64) NOT NULL,
  `contacts_email` varchar(64) NOT NULL,
  `contacts_phone` varchar(32) NOT NULL,
  `contacts_overview` varchar(512) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contacts_name`, `contacts_email`, `contacts_phone`, `contacts_overview`, `created_at`, `updated_at`) VALUES
(1, 'Jhon Doe', 'jhondoe@hotmail.com', '01645770422', 'Hi there,\r\nAll in all it was a really easy approach to creating your online store. I have complete control over how and what I want placed within my site, with the additional benefit of being able to change anything as and when I want.', '2020-07-06 10:20:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT 'CUSTOMERS ID',
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(64) NOT NULL,
  `customer_mobile` varchar(16) NOT NULL,
  `customer_address` varchar(256) NOT NULL,
  `customer_password` varchar(128) NOT NULL,
  `customer_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_address`, `customer_password`, `customer_status`, `created_at`, `updated_at`) VALUES
(1, 'Md. Kabir Khan', 'kabirkhan@gmail.com', '01645770422', 'Rampura-1219, Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 08:40:58', NULL),
(2, 'Jhon Doe', 'jhondoe@gmail.com', '01645770422', 'Panthapath-1205, Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 08:54:22', NULL),
(3, 'Al Mamun Roni', 'almamunroni@gmail.com', '01645770422', 'Chasara-1405, Narayanganj, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 08:57:10', NULL),
(4, 'Nirjhor Anjum', 'nirjhorsir@gmail.com', '01645770422', 'Dhaka-1206, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 09:37:53', NULL),
(8, 'Jobayer Tuser', 'jobayertuser@gmail.com', '01645770422', 'Mohammadpur-1216, Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 09:48:31', NULL),
(9, 'Ahsan Habib', 'ahsanhabib@gmail.com', '01645770422', 'Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 09:53:19', NULL),
(13, 'Ahsan Habib', 'ahsanhabib@gmail.com', '01645770422', 'Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 09:55:57', NULL),
(14, 'Ahsan Habib', 'ahsanhabib@gmail.com', '01645770422', 'Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-07-06 09:56:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL COMMENT 'DELIVERIES ID',
  `customer_id` int(11) NOT NULL,
  `shipping_charge` enum('50','120') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL COMMENT 'DISCOUNT ID',
  `discount_code` varchar(256) NOT NULL,
  `price_discount_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL COMMENT 'INVOICE ID',
  `invoice_id` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `customer_id`, `shipping_id`, `order_id`, `transaction_amount`, `created_at`, `updated_at`) VALUES
(1, 'COD#86237', 3, 1, 1, 9470, '2020-07-06 09:04:10', NULL),
(2, '20070695548Tp5hxKeh1HPezyg', 9, 2, 2, 21078, '2020-07-06 10:02:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL COMMENT 'NEWSLETTER ID',
  `newsletter_email` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'ORDERS ID',
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `sub_total` double NOT NULL,
  `tax` double NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `discount_amount` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_method` enum('SSL COMMERZ','PayPal','Cash On Delivery') NOT NULL DEFAULT 'Cash On Delivery',
  `transaction_id` varchar(256) NOT NULL,
  `transaction_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Paid',
  `order_item_status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `sub_total`, `tax`, `delivery_charge`, `discount_amount`, `grand_total`, `payment_method`, `transaction_id`, `transaction_status`, `order_item_status`, `created_at`, `updated_at`) VALUES
(1, 3, '2020-07-06 09:02:32', 8698, 652.35, 120, 0, 9470, 'Cash On Delivery', 'COD#3', 'Unpaid', 'Pending', '2020-07-06 09:02:32', NULL),
(2, 9, '2020-07-06 10:00:01', 19496, 1462.2, 120, 0, 21078, 'SSL COMMERZ', '20070695548h40YeCxaiNzdD8D', 'Paid', 'Pending', '2020-07-06 10:00:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL COMMENT 'ORDER ITEMS ID',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `prod_quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `customer_id`, `order_id`, `product_id`, `product_price`, `prod_quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 38, 5899, 1, '2020-07-06 09:02:32', NULL),
(2, 3, 1, 20, 2799, 1, '2020-07-06 09:02:32', NULL),
(3, 9, 2, 17, 4799, 1, '2020-07-06 10:00:01', NULL),
(4, 9, 2, 39, 7499, 1, '2020-07-06 10:00:01', NULL),
(5, 9, 2, 45, 4899, 1, '2020-07-06 10:00:01', NULL),
(6, 9, 2, 48, 2299, 1, '2020-07-06 10:00:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL COMMENT 'PAGES ID',
  `page_title` text NOT NULL,
  `page_content` text NOT NULL,
  `page_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'PRODUCTS ID',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_summary` text NOT NULL,
  `product_details` text NOT NULL,
  `product_master_image` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_discount_price` double NOT NULL,
  `discount_start` datetime NOT NULL,
  `discount_ends` datetime NOT NULL,
  `product_status` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `product_featured` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `product_tags` varchar(512) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `products_image_one` text DEFAULT NULL,
  `products_image_two` text DEFAULT NULL,
  `products_image_three` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_quantity`, `product_price`, `product_discount_price`, `discount_start`, `discount_ends`, `product_status`, `product_featured`, `product_tags`, `created_at`, `updated_at`, `products_image_one`, `products_image_two`, `products_image_three`) VALUES
(1, 10, 11, 'MEN\'S STYLISH BRACELET', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706030255_bracelet(1).jpg', 2, 699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'bracelet,mens bracelet', '2020-07-06 03:02:55', NULL, 'PRODUCTONE_20200706030255_bracelet(1).jpg', 'PRODUCTTWO_20200706030255_bracelet(1).jpg', 'PRODUCTTHREE_20200706030255_bracelet(1).jpg'),
(2, 10, 11, 'MEN\'S BRACELET', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706030429_bracelet(2).jpg', 1, 699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'bracelet,mens bracelet,bracelet collection 2020', '2020-07-06 03:04:29', NULL, 'PRODUCTONE_20200706030429_bracelet(2).jpg', 'PRODUCTTWO_20200706030429_bracelet(2).jpg', 'PRODUCTTHREE_20200706030429_bracelet(2).jpg'),
(3, 10, 11, 'BRACELET 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706030627_bracelet(4).jpg', 1, 799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'bracelet,mens bracelet', '2020-07-06 03:06:27', NULL, 'PRODUCTONE_20200706030627_bracelet(4).jpg', 'PRODUCTTWO_20200706030627_bracelet(4).jpg', 'PRODUCTTHREE_20200706030627_bracelet(4).jpg'),
(4, 10, 11, 'EXCLUSIVE BRACELET 2020', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706030734_bracelet(3).jpg', 2, 699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'bracelet,mens bracelet', '2020-07-06 03:07:34', NULL, 'PRODUCTONE_20200706030734_bracelet(3).jpg', 'PRODUCTTWO_20200706030734_bracelet(3).jpg', 'PRODUCTTHREE_20200706030734_bracelet(3).jpg'),
(5, 9, 9, 'MEN\'S SANDAL', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031047_shoe(2).jpg', 1, 1599, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'sandal,mens sandal', '2020-07-06 03:10:47', NULL, 'PRODUCTONE_20200706031047_shoe(2).jpg', 'PRODUCTTWO_20200706031047_shoe(2).jpg', 'PRODUCTTHREE_20200706031047_shoe(2).jpg'),
(6, 9, 9, 'MEN\'S SANDAL', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031132_shoe(4).jpg', 1, 1299, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'sandal,mens sandal', '2020-07-06 03:11:32', NULL, 'PRODUCTONE_20200706031132_shoe(4).jpg', 'PRODUCTTWO_20200706031132_shoe(4).jpg', 'PRODUCTTHREE_20200706031132_shoe(4).jpg'),
(7, 9, 10, 'MEN\'S SHOE', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031300_shoe(1).jpg', 1, 3699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'shoe,mens shoe', '2020-07-06 03:13:00', NULL, 'PRODUCTONE_20200706031300_shoe(1).jpg', 'PRODUCTTWO_20200706031300_shoe(1).jpg', 'PRODUCTTHREE_20200706031300_shoe(1).jpg'),
(8, 1, 1, 'MEN\'S PANJABI', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031559_mens_panjabi(4).jpg', 2, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'panjabi,white panjabi,mens panjabi', '2020-07-06 03:15:59', NULL, 'PRODUCTONE_20200706031559_mens_panjabi(4).jpg', 'PRODUCTTWO_20200706031559_mens_panjabi(4).jpg', 'PRODUCTTHREE_20200706031559_mens_panjabi(4).jpg'),
(9, 1, 1, 'MEN\'S PANJABI', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.<br></li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031658_mens_panjabi(3).jpg', 1, 1799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'panjabi,mens panjabi,long panjabi', '2020-07-06 03:16:58', NULL, 'PRODUCTONE_20200706031658_mens_panjabi(3).jpg', 'PRODUCTTWO_20200706031658_mens_panjabi(3).jpg', 'PRODUCTTHREE_20200706031658_mens_panjabi(3).jpg'),
(10, 1, 1, 'MEN\'S PANJABI', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031754_mens_panjabi(2).jpg', 2, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'YES', 'panjabi,mens panjabi,blue panjabi', '2020-07-06 03:17:54', NULL, 'PRODUCTONE_20200706031754_mens_panjabi(2).jpg', 'PRODUCTTWO_20200706031754_mens_panjabi(2).jpg', 'PRODUCTTHREE_20200706031754_mens_panjabi(2).jpg'),
(11, 1, 1, 'MEN\'S PANJABI', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706031845_mens_panjabi(1).jpg', 1, 1499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'panjabi,red panjabi', '2020-07-06 03:18:45', NULL, 'PRODUCTONE_20200706031845_mens_panjabi(1).jpg', 'PRODUCTTWO_20200706031845_mens_panjabi(1).jpg', 'PRODUCTTHREE_20200706031845_mens_panjabi(1).jpg'),
(12, 1, 6, 'SUMMER SUIT 2020', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032108_blazer(8).jpg', 2, 4599, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'pink suit,summer suit', '2020-07-06 03:21:08', NULL, 'PRODUCTONE_20200706032108_blazer(8).jpg', 'PRODUCTTWO_20200706032108_blazer(8).jpg', 'PRODUCTTHREE_20200706032108_blazer(8).jpg'),
(13, 1, 6, 'MEN\'S SUMMER SUIT', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032202_blazer(3).jpg', 1, 4899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'YES', 'mens suit,summer suit', '2020-07-06 03:22:02', NULL, 'PRODUCTONE_20200706032202_blazer(3).jpg', 'PRODUCTTWO_20200706032202_blazer(3).jpg', 'PRODUCTTHREE_20200706032202_blazer(3).jpg'),
(14, 1, 6, 'SUMMER SUIT 2020', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032258_blazer(1).jpg', 1, 4799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'suit,mens suit', '2020-07-06 03:22:58', NULL, 'PRODUCTONE_20200706032258_blazer(1).jpg', 'PRODUCTTWO_20200706032258_blazer(1).jpg', 'PRODUCTTHREE_20200706032258_blazer(1).jpg'),
(15, 1, 6, 'EXCLUSIVE SUMMER SUIT', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032356_blazer(5).jpg', 1, 4899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'YES', 'suit,summer suit', '2020-07-06 03:23:56', NULL, 'PRODUCTONE_20200706032356_blazer(5).jpg', 'PRODUCTTWO_20200706032356_blazer(5).jpg', 'PRODUCTTHREE_20200706032356_blazer(5).jpg'),
(16, 1, 2, 'EXCLUSIVE BLAZER 2020', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032445_blazer(4).jpg', 1, 5799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'YES', 'blazer,mens blazer', '2020-07-06 03:24:45', NULL, 'PRODUCTONE_20200706032445_blazer(4).jpg', 'PRODUCTTWO_20200706032445_blazer(4).jpg', 'PRODUCTTHREE_20200706032445_blazer(4).jpg'),
(17, 1, 2, 'RICHMAN BLAZER', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032541_blazer(2).jpg', 1, 4799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'blazer,mens blazer', '2020-07-06 03:25:41', NULL, 'PRODUCTONE_20200706032541_blazer(2).jpg', 'PRODUCTTWO_20200706032541_blazer(2).jpg', 'PRODUCTTHREE_20200706032541_blazer(2).jpg'),
(18, 1, 2, 'BLAZER COLLECTION 2020', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032628_blazer(7).jpg', 1, 4799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'blazer,mens blazer', '2020-07-06 03:26:28', NULL, 'PRODUCTONE_20200706032628_blazer(7).jpg', 'PRODUCTTWO_20200706032628_blazer(7).jpg', 'PRODUCTTHREE_20200706032628_blazer(7).jpg'),
(19, 1, 2, 'BLUE BLAZER', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032736_blazer(6).jpg', 1, 4699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'blue blazer,blazer', '2020-07-06 03:27:36', NULL, 'PRODUCTONE_20200706032736_blazer(6).jpg', 'PRODUCTTWO_20200706032736_blazer(6).jpg', 'PRODUCTTHREE_20200706032736_blazer(6).jpg'),
(20, 1, 5, 'TANJIM DENIM', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032852_mens_denim(3).jpg', 2, 2799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'denim,tanjim denim,mens denim', '2020-07-06 03:28:52', NULL, 'PRODUCTONE_20200706032852_mens_denim(3).jpg', 'PRODUCTTWO_20200706032852_mens_denim(3).jpg', 'PRODUCTTHREE_20200706032852_mens_denim(3).jpg'),
(21, 1, 5, 'DENIM 2020', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706032939_mens_denim(2).jpg', 1, 2699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'YES', 'denim,jeans', '2020-07-06 03:29:39', NULL, 'PRODUCTONE_20200706032939_mens_denim(2).jpg', 'PRODUCTTWO_20200706032939_mens_denim(2).jpg', 'PRODUCTTHREE_20200706032939_mens_denim(2).jpg'),
(22, 1, 5, 'NON STITCH JEANS', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706033044_mens_denim(4).jpg', 1, 2499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'denim,jeans,non stitch pant', '2020-07-06 03:30:44', NULL, 'PRODUCTONE_20200706033044_mens_denim(4).jpg', 'PRODUCTTWO_20200706033044_mens_denim(4).jpg', 'PRODUCTTHREE_20200706033044_mens_denim(4).jpg'),
(23, 1, 5, 'EXCLUSIVE DENIM', '									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>								', '									<div>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</div><div><br></div><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>								', 'PRODUCT_20200706033134_mens_denim(1).jpg', 1, 2699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'denim,jeans pant', '2020-07-06 03:31:34', NULL, 'PRODUCTONE_20200706033134_mens_denim(1).jpg', 'PRODUCTTWO_20200706033134_mens_denim(1).jpg', 'PRODUCTTHREE_20200706033134_mens_denim(1).jpg'),
(24, 1, 4, 'SOLID T-SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041154_mens_tshirt(2).jpg', 1, 799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'tshirt,solid t-shirt', '2020-07-06 04:11:54', NULL, 'PRODUCTONE_20200706041154_mens_tshirt(2).jpg', 'PRODUCTTWO_20200706041154_mens_tshirt(2).jpg', 'PRODUCTTHREE_20200706041154_mens_tshirt(2).jpg'),
(25, 1, 4, 'PRINTED T-SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041301_mens_tshirt(3).jpg', 1, 799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'tshirt,khakhi', '2020-07-06 04:13:01', NULL, 'PRODUCTONE_20200706041301_mens_tshirt(3).jpg', 'PRODUCTTWO_20200706041301_mens_tshirt(3).jpg', 'PRODUCTTHREE_20200706041301_mens_tshirt(3).jpg'),
(26, 1, 4, 'EXCLUSIVE T-SHIRT 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041433_mens_tshirt(4).jpg', 2, 799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'tshirt,mens t-shirt', '2020-07-06 04:14:33', NULL, 'PRODUCTONE_20200706041433_mens_tshirt(4).jpg', 'PRODUCTTWO_20200706041433_mens_tshirt(4).jpg', 'PRODUCTTHREE_20200706041433_mens_tshirt(4).jpg'),
(27, 1, 4, 'PRINTED T-SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041527_mens_tshirt(1).jpg', 1, 799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'tshirt,white tshirt,printed', '2020-07-06 04:15:27', NULL, 'PRODUCTONE_20200706041527_mens_tshirt(1).jpg', 'PRODUCTTWO_20200706041527_mens_tshirt(1).jpg', 'PRODUCTTHREE_20200706041527_mens_tshirt(1).jpg'),
(28, 1, 3, 'PRINTED LONG SLEEVE SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041703_mens_shirt(3).jpg', 1, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'shirt,long sleeve,mens shirt', '2020-07-06 04:17:03', NULL, 'PRODUCTONE_20200706041703_mens_shirt(3).jpg', 'PRODUCTTWO_20200706041703_mens_shirt(3).jpg', 'PRODUCTTHREE_20200706041703_mens_shirt(3).jpg'),
(29, 1, 3, 'EXCLUSIVE JEANS SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041806_mens_shirt(7).jpg', 2, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'jeans shirt,shirt,mens shirt', '2020-07-06 04:18:06', NULL, 'PRODUCTONE_20200706041806_mens_shirt(7).jpg', 'PRODUCTTWO_20200706041806_mens_shirt(7).jpg', 'PRODUCTTHREE_20200706041806_mens_shirt(7).jpg'),
(30, 1, 3, 'PRINTED WHITE SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706041905_mens_shirt(2).jpg', 1, 1799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'shirt,mens shirt', '2020-07-06 04:19:05', NULL, 'PRODUCTONE_20200706041905_mens_shirt(2).jpg', 'PRODUCTTWO_20200706041905_mens_shirt(2).jpg', 'PRODUCTTHREE_20200706041905_mens_shirt(2).jpg'),
(31, 1, 3, 'SOLID COTTON SHIRT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042010_mens_shirt(1).jpg', 1, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'cotton,shirt', '2020-07-06 04:20:10', NULL, 'PRODUCTONE_20200706042010_mens_shirt(1).jpg', 'PRODUCTTWO_20200706042010_mens_shirt(1).jpg', 'PRODUCTTHREE_20200706042010_mens_shirt(1).jpg'),
(32, 8, 7, 'TISSOT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042129_mens_watch(1).jpg', 1, 4999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'tissot,mens watch,watch', '2020-07-06 04:21:29', NULL, 'PRODUCTONE_20200706042129_mens_watch(1).jpg', 'PRODUCTTWO_20200706042129_mens_watch(1).jpg', 'PRODUCTTHREE_20200706042129_mens_watch(1).jpg'),
(33, 8, 7, 'SEIKO', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042232_mens_watch(2).jpg', 1, 5899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'watch,seiko', '2020-07-06 04:22:32', NULL, 'PRODUCTONE_20200706042232_mens_watch(2).jpg', 'PRODUCTTWO_20200706042232_mens_watch(2).jpg', 'PRODUCTTHREE_20200706042232_mens_watch(2).jpg'),
(34, 8, 7, 'G-SHOCK', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042324_mens_watch(3).jpg', 1, 5899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'gshock,g-shock,watch,mens watch', '2020-07-06 04:23:24', NULL, 'PRODUCTONE_20200706042324_mens_watch(3).jpg', 'PRODUCTTWO_20200706042324_mens_watch(3).jpg', 'PRODUCTTHREE_20200706042324_mens_watch(3).jpg'),
(35, 8, 7, 'FESTINA', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042505_mens_watch(4).jpg', 1, 5899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'festina,watch,mens watch', '2020-07-06 04:25:05', NULL, 'PRODUCTONE_20200706042505_mens_watch(4).jpg', 'PRODUCTTWO_20200706042505_mens_watch(4).jpg', 'PRODUCTTHREE_20200706042505_mens_watch(4).jpg'),
(36, 8, 7, 'TIMEX', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042549_mens_watch(5).jpg', 2, 7499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'timex,watch', '2020-07-06 04:25:49', NULL, 'PRODUCTONE_20200706042549_mens_watch(5).jpg', 'PRODUCTTWO_20200706042549_mens_watch(5).jpg', 'PRODUCTTHREE_20200706042549_mens_watch(5).jpg'),
(37, 8, 7, 'TIMEX', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042657_mens_watch(6).jpg', 1, 6799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'timex,watch', '2020-07-06 04:26:57', NULL, 'PRODUCTONE_20200706042657_mens_watch(6).jpg', 'PRODUCTTWO_20200706042657_mens_watch(6).jpg', 'PRODUCTTHREE_20200706042657_mens_watch(6).jpg'),
(38, 8, 7, 'HUGO BOSS', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042743_mens_watch(7).jpg', 1, 5899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'hugo,watch,hugo boss', '2020-07-06 04:27:43', NULL, 'PRODUCTONE_20200706042743_mens_watch(7).jpg', 'PRODUCTTWO_20200706042743_mens_watch(7).jpg', 'PRODUCTTHREE_20200706042743_mens_watch(7).jpg'),
(39, 8, 7, 'CASIO EDIFICE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706042835_mens_watch(8).jpg', 1, 7499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'casio,edifice,watch', '2020-07-06 04:28:35', NULL, 'PRODUCTONE_20200706042835_mens_watch(8).jpg', 'PRODUCTTWO_20200706042835_mens_watch(8).jpg', 'PRODUCTTHREE_20200706042835_mens_watch(8).jpg'),
(40, 8, 8, 'FOSSIL', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043303_womens_watch(1).jpg', 1, 4799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'fossil,womens watch,watch', '2020-07-06 04:33:03', NULL, 'PRODUCTONE_20200706043303_womens_watch(1).jpg', 'PRODUCTTWO_20200706043303_womens_watch(1).jpg', 'PRODUCTTHREE_20200706043303_womens_watch(1).jpg');
INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_quantity`, `product_price`, `product_discount_price`, `discount_start`, `discount_ends`, `product_status`, `product_featured`, `product_tags`, `created_at`, `updated_at`, `products_image_one`, `products_image_two`, `products_image_three`) VALUES
(41, 8, 8, 'GUCCI', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043352_womens_watch(2).jpg', 1, 7999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'gucci,womes watch', '2020-07-06 04:33:52', NULL, 'PRODUCTONE_20200706043352_womens_watch(2).jpg', 'PRODUCTTWO_20200706043352_womens_watch(2).jpg', 'PRODUCTTHREE_20200706043352_womens_watch(2).jpg'),
(42, 8, 8, 'GUESS', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043540_womens_watch(3).jpg', 1, 8999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'guess,womens watch', '2020-07-06 04:35:40', NULL, 'PRODUCTONE_20200706043540_womens_watch(3).jpg', 'PRODUCTTWO_20200706043540_womens_watch(3).jpg', 'PRODUCTTHREE_20200706043540_womens_watch(3).jpg'),
(43, 8, 8, 'GUESS', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043618_womens_watch(4).jpg', 1, 4799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'guess,watch', '2020-07-06 04:36:18', NULL, 'PRODUCTONE_20200706043618_womens_watch(4).jpg', 'PRODUCTTWO_20200706043618_womens_watch(4).jpg', 'PRODUCTTHREE_20200706043618_womens_watch(4).jpg'),
(44, 8, 8, 'FOSSIL', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043705_womens_watch(5).jpg', 1, 5799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'fossil,watch', '2020-07-06 04:37:05', NULL, 'PRODUCTONE_20200706043705_womens_watch(5).jpg', 'PRODUCTTWO_20200706043705_womens_watch(5).jpg', 'PRODUCTTHREE_20200706043705_womens_watch(5).jpg'),
(45, 8, 8, 'GUCCI', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043756_womens_watch(6).jpg', 1, 4899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'gucci,watch', '2020-07-06 04:37:56', NULL, 'PRODUCTONE_20200706043756_womens_watch(6).jpg', 'PRODUCTTWO_20200706043756_womens_watch(6).jpg', 'PRODUCTTHREE_20200706043756_womens_watch(6).jpg'),
(46, 8, 8, 'FOSSIL', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043847_womens_watch(7).jpg', 1, 5799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'fossil,watch', '2020-07-06 04:38:47', NULL, 'PRODUCTONE_20200706043847_womens_watch(7).jpg', 'PRODUCTTWO_20200706043847_womens_watch(7).jpg', 'PRODUCTTHREE_20200706043847_womens_watch(7).jpg'),
(47, 8, 8, 'GUESS', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706043931_womens_watch(8).jpg', 1, 6799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'guess,watch', '2020-07-06 04:39:31', NULL, 'PRODUCTONE_20200706043931_womens_watch(8).jpg', 'PRODUCTTWO_20200706043931_womens_watch(8).jpg', 'PRODUCTTHREE_20200706043931_womens_watch(8).jpg'),
(48, 2, 17, 'EXCLUSIVE LONG DRESS', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706044536_women_longdress(3).jpg', 1, 2299, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'long dress', '2020-07-06 04:45:36', NULL, 'PRODUCTONE_20200706044536_women_longdress(3).jpg', 'PRODUCTTWO_20200706044536_women_longdress(3).jpg', 'PRODUCTTHREE_20200706044536_women_longdress(3).jpg'),
(49, 2, 17, 'LONG DRESS 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706044622_women_longdress(2).jpg', 1, 1799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'long dress', '2020-07-06 04:46:22', NULL, 'PRODUCTONE_20200706044622_women_longdress(2).jpg', 'PRODUCTTWO_20200706044622_women_longdress(2).jpg', 'PRODUCTTHREE_20200706044622_women_longdress(2).jpg'),
(50, 2, 16, 'FASHION COLLECTION', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706044733_women_longdress(1).jpg', 1, 2499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'fashion,womens fashion', '2020-07-06 04:47:33', NULL, 'PRODUCTONE_20200706044733_women_longdress(1).jpg', 'PRODUCTTWO_20200706044733_women_longdress(1).jpg', 'PRODUCTTHREE_20200706044733_women_longdress(1).jpg'),
(51, 2, 16, 'EXCLUSIVE FASHION COLLECTION', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706044828_women_longdress(4).jpg', 1, 2499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'fashion', '2020-07-06 04:48:28', NULL, 'PRODUCTONE_20200706044828_women_longdress(4).jpg', 'PRODUCTTWO_20200706044828_women_longdress(4).jpg', 'PRODUCTTHREE_20200706044828_women_longdress(4).jpg'),
(52, 2, 16, 'WOMEN\'S FASHION', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045032_womens_fashiontop(2).jpg', 1, 2799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'fashion collection', '2020-07-06 04:50:32', NULL, 'PRODUCTONE_20200706045032_womens_fashiontop(2).jpg', 'PRODUCTTWO_20200706045032_womens_fashiontop(2).jpg', 'PRODUCTTHREE_20200706045032_womens_fashiontop(2).jpg'),
(53, 2, 16, 'FASHION COLLECTION 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045132_womens_fashiontop(3).jpg', 1, 3499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'fashion', '2020-07-06 04:51:32', NULL, 'PRODUCTONE_20200706045132_womens_fashiontop(3).jpg', 'PRODUCTTWO_20200706045132_womens_fashiontop(3).jpg', 'PRODUCTTHREE_20200706045132_womens_fashiontop(3).jpg'),
(54, 2, 17, 'LONG DRESS', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045207_womens_fashiontop(4).jpg', 1, 2699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'long dress', '2020-07-06 04:52:07', NULL, 'PRODUCTONE_20200706045207_womens_fashiontop(4).jpg', 'PRODUCTTWO_20200706045207_womens_fashiontop(4).jpg', 'PRODUCTTHREE_20200706045207_womens_fashiontop(4).jpg'),
(55, 2, 17, 'EXCLUSIVE LOGN DRESS 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045313_womens_fashiontop(1).jpg', 1, 2699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'long dress', '2020-07-06 04:53:13', NULL, 'PRODUCTONE_20200706045313_womens_fashiontop(1).jpg', 'PRODUCTTWO_20200706045313_womens_fashiontop(1).jpg', 'PRODUCTTHREE_20200706045313_womens_fashiontop(1).jpg'),
(56, 2, 13, 'EXCLUSIVE KAMIZ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045455_womens_shalwar_kamiz(1).jpg', 1, 3699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'salwar kamiz,kamiz', '2020-07-06 04:54:55', NULL, 'PRODUCTONE_20200706045455_womens_shalwar_kamiz(1).jpg', 'PRODUCTTWO_20200706045455_womens_shalwar_kamiz(1).jpg', 'PRODUCTTHREE_20200706045455_womens_shalwar_kamiz(1).jpg'),
(57, 2, 13, 'EXCLUSIVE COLLECTION 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045553_womens_shalwar_kamiz(2).jpg', 1, 3499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'kamiz,exclusive', '2020-07-06 04:55:53', NULL, 'PRODUCTONE_20200706045553_womens_shalwar_kamiz(2).jpg', 'PRODUCTTWO_20200706045553_womens_shalwar_kamiz(2).jpg', 'PRODUCTTHREE_20200706045553_womens_shalwar_kamiz(2).jpg'),
(58, 2, 13, 'PRINTED KAMIZ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045636_womens_shalwar_kamiz(3).jpg', 1, 2699, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'kamiz', '2020-07-06 04:56:36', NULL, 'PRODUCTONE_20200706045636_womens_shalwar_kamiz(3).jpg', 'PRODUCTTWO_20200706045636_womens_shalwar_kamiz(3).jpg', 'PRODUCTTHREE_20200706045636_womens_shalwar_kamiz(3).jpg'),
(59, 2, 13, 'PURE COTTON KAMIZ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045724_womens_shalwar_kamiz(4).jpg', 1, 3299, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'kamiz', '2020-07-06 04:57:24', NULL, 'PRODUCTONE_20200706045724_womens_shalwar_kamiz(4).jpg', 'PRODUCTTWO_20200706045724_womens_shalwar_kamiz(4).jpg', 'PRODUCTTHREE_20200706045724_womens_shalwar_kamiz(4).jpg'),
(60, 2, 13, 'FESTIVAL COLLECTION', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045815_womens_shalwar_kamiz(5).jpg', 1, 2999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'kamiz', '2020-07-06 04:58:15', NULL, 'PRODUCTONE_20200706045815_womens_shalwar_kamiz(5).jpg', 'PRODUCTTWO_20200706045815_womens_shalwar_kamiz(5).jpg', 'PRODUCTTHREE_20200706045815_womens_shalwar_kamiz(5).jpg'),
(61, 2, 13, 'COTTON PRINTED KAMIZ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706045858_womens_shalwar_kamiz(6).jpg', 1, 3499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'kamiz', '2020-07-06 04:58:58', NULL, 'PRODUCTONE_20200706045858_womens_shalwar_kamiz(6).jpg', 'PRODUCTTWO_20200706045858_womens_shalwar_kamiz(6).jpg', 'PRODUCTTHREE_20200706045858_womens_shalwar_kamiz(6).jpg'),
(62, 2, 12, 'COTTON SHAREE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050037_womens_sharee(1).jpg', 1, 4999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'sharee', '2020-07-06 05:00:37', NULL, 'PRODUCTONE_20200706050037_womens_sharee(1).jpg', 'PRODUCTTWO_20200706050037_womens_sharee(1).jpg', 'PRODUCTTHREE_20200706050037_womens_sharee(1).jpg'),
(63, 2, 12, 'EXCLUSIVE SHAREE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050136_womens_sharee(2).jpg', 1, 3499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'sharee', '2020-07-06 05:01:36', NULL, 'PRODUCTONE_20200706050136_womens_sharee(2).jpg', 'PRODUCTTWO_20200706050136_womens_sharee(2).jpg', 'PRODUCTTHREE_20200706050136_womens_sharee(2).jpg'),
(64, 2, 12, 'EXCLUSIVE SHAREE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050238_womens_sharee(3).jpg', 1, 3799, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'YES', 'sharee', '2020-07-06 05:02:38', NULL, 'PRODUCTONE_20200706050238_womens_sharee(3).jpg', 'PRODUCTTWO_20200706050238_womens_sharee(3).jpg', 'PRODUCTTHREE_20200706050238_womens_sharee(3).jpg'),
(65, 2, 12, 'EXCLUSIVE SHAREE 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050445_womens_sharee(5).jpg', 2, 3199, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'sharee', '2020-07-06 05:04:45', NULL, 'PRODUCTONE_20200706050445_womens_sharee(5).jpg', 'PRODUCTTWO_20200706050445_womens_sharee(5).jpg', 'PRODUCTTHREE_20200706050445_womens_sharee(5).jpg'),
(66, 2, 12, 'BLUE PRINTED SHAREE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050536_womens_sharee(6).jpg', 1, 2899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'sharee', '2020-07-06 05:05:36', NULL, 'PRODUCTONE_20200706050536_womens_sharee(6).jpg', 'PRODUCTTWO_20200706050536_womens_sharee(6).jpg', 'PRODUCTTHREE_20200706050536_womens_sharee(6).jpg'),
(67, 2, 12, 'EXCLUSIVE SHAREE 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050619_womens_sharee(7).jpg', 1, 3599, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'sharee', '2020-07-06 05:06:19', NULL, 'PRODUCTONE_20200706050619_womens_sharee(7).jpg', 'PRODUCTTWO_20200706050619_womens_sharee(7).jpg', 'PRODUCTTHREE_20200706050619_womens_sharee(7).jpg'),
(68, 2, 12, 'SHAREE COLLECTION 2020', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050713_womens_sharee(10).jpg', 1, 3499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Out of Stock', 'NO', 'sharee', '2020-07-06 05:07:13', NULL, 'PRODUCTONE_20200706050713_womens_sharee(10).jpg', 'PRODUCTTWO_20200706050713_womens_sharee(10).jpg', 'PRODUCTTHREE_20200706050713_womens_sharee(10).jpg'),
(69, 2, 12, 'EXCLUSIVE COTTON SHAREE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br></p>', '<p>Tortor at risus viverra adipiscing at in tellus integer feugiat. Ultrices in iaculis nunc sed augue lacus viverra vitae. A diam sollicitudin tempor id eu nisl nunc. Placerat orci nulla pellentesque dignissim enim sit amet venenatis. Quis auctor elit sed vulputate mi sit amet mauris commodo. Risus nullam eget felis eget nunc.</p><p><br></p><ul><li>Ultrices in iaculis nunc sed. Imperdiet massa tincidunt nunc pulvinar sapien et.</li><li>Euismod nisi porta lorem mollis aliquam ut porttitor.</li><li>Integer feugiat scelerisque varius morbi enim nunc faucibus a.</li><li>Ac felis donec et odio. Duis convallis convallis tellus id interdum velit.</li><li>Placerat orci nulla pellentesque dignissim enim sit amet venenatis.</li></ul>', 'PRODUCT_20200706050803_womens_sharee(13).jpg', 1, 3499, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'NO', 'sharee', '2020-07-06 05:08:03', NULL, 'PRODUCTONE_20200706050803_womens_sharee(13).jpg', 'PRODUCTTWO_20200706050803_womens_sharee(13).jpg', 'PRODUCTTHREE_20200706050803_womens_sharee(13).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(11) NOT NULL COMMENT 'SHIPPING ID',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipcstmr_name` varchar(128) NOT NULL,
  `shipcstmr_mobile` varchar(32) NOT NULL,
  `shipcstmr_profession` varchar(256) DEFAULT NULL,
  `shipcstmr_streetadd` varchar(256) NOT NULL,
  `shipcstmr_city` varchar(64) NOT NULL,
  `shipcstmr_zip` varchar(6) NOT NULL,
  `shipcstmr_country` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `customer_id`, `order_id`, `shipcstmr_name`, `shipcstmr_mobile`, `shipcstmr_profession`, `shipcstmr_streetadd`, `shipcstmr_city`, `shipcstmr_zip`, `shipcstmr_country`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Firoz Ahmed', '01645770422', 'Graphics Designer', 'Police Line, Panchabati', 'Fatullah', '1405', 'Bangladesh', '2020-07-06 09:03:55', NULL),
(2, 9, 2, 'Shahnaz Khanam', '01645770422', 'Housewife', 'Main Road # 2/B', 'Baridhara', '1406', 'Bangladesh', '2020-07-06 10:02:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopcarts`
--

CREATE TABLE `shopcarts` (
  `id` int(11) NOT NULL COMMENT 'SHOPCARTS ID',
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL COMMENT 'SLIDER ID',
  `slider_title` varchar(128) NOT NULL,
  `slider_file` text NOT NULL,
  `slider_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `slider_sequence` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slider_title`, `slider_file`, `slider_status`, `slider_sequence`, `created_at`, `updated_at`) VALUES
(1, 'EID FESTIVAL COLLECTION 2020', 'SLIDER_20200706022816_slide852r.jpg', 'Active', 1, NULL, NULL),
(2, 'HOME DECOR', 'SLIDER_20200706022832_slider.jpg', 'Active', 2, NULL, NULL),
(3, 'PAHELA BAISHAK COLLECTION 2020', 'SLIDER_20200706022906_slid63er.jpg', 'Active', 3, NULL, NULL),
(4, 'EID COLLECTION 2020', 'SLIDER_20200706022921_slid3er.jpg', 'Active', 4, NULL, NULL),
(5, 'KIDS COLLECTION 2020', 'SLIDER_20200706022936_slide1r.jpg', 'Active', 5, NULL, NULL),
(6, 'SUMMER COLLECTION 2020', 'SLIDER_20200706023006_sli74der.jpg', 'Active', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL COMMENT 'SUBCATEGORIES ID',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `subcategory_banner` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_status`, `subcategory_banner`, `created_at`, `updated_at`) VALUES
(1, 1, 'MEN\'S PANJABI', 'Active', 'SUBCATBANNER_20200706024241_banner(5).jpg', '2020-07-06 02:42:41', NULL),
(2, 1, 'MEN\'S BLAZER', 'Active', 'SUBCATBANNER_20200706024406_banner(3).jpg', '2020-07-06 02:44:06', NULL),
(3, 1, 'MEN\'S CASUAL SHIRT', 'Active', 'SUBCATBANNER_20200706024437_banner(6).jpg', '2020-07-06 02:44:37', NULL),
(4, 1, 'MEN\'S T-SHIRT', 'Active', 'SUBCATBANNER_20200706024503_banner(1).jpg', '2020-07-06 02:45:03', NULL),
(5, 1, 'MEN\'S DENIM', 'Active', 'SUBCATBANNER_20200706024527_banner(4).jpg', '2020-07-06 02:45:27', NULL),
(6, 1, 'MEN\'S SUMMER SUIT', 'Active', 'SUBCATBANNER_20200706024542_banner(3).jpg', '2020-07-06 02:45:42', NULL),
(7, 8, 'MEN\'S WATCH', 'Active', 'SUBCATBANNER_20200706024602_banner(5).jpg', '2020-07-06 02:46:02', NULL),
(8, 8, 'WOMEN\'S WATCH', 'Active', 'SUBCATBANNER_20200706024618_banner(9).jpg', '2020-07-06 02:46:18', NULL),
(9, 9, 'MEN\'S SANDAL', 'Active', 'SUBCATBANNER_20200706024821_banner(2).jpg', '2020-07-06 02:48:21', NULL),
(10, 9, 'MEN\'S SHOES', 'Active', 'SUBCATBANNER_20200706024835_banner(2).jpg', '2020-07-06 02:48:35', NULL),
(11, 10, 'BRACELET', 'Active', 'SUBCATBANNER_20200706024914_banner(5).jpg', '2020-07-06 02:49:14', NULL),
(12, 2, 'WOMEN\'S SHAREE', 'Active', 'SUBCATBANNER_20200706025014_banner(8).jpg', '2020-07-06 02:50:14', NULL),
(13, 2, 'WOMEN\'S SALWAR KAMIZ', 'Active', 'SUBCATBANNER_20200706025035_banner(7).jpg', '2020-07-06 02:50:35', NULL),
(14, 2, 'WOMEN TUNIC', 'Active', 'SUBCATBANNER_20200706025048_banner(8).jpg', '2020-07-06 02:50:48', NULL),
(15, 2, 'WOMEN SHRUG', 'Active', 'SUBCATBANNER_20200706025120_banner(7).jpg', '2020-07-06 02:51:20', NULL),
(16, 2, 'WOMEN\'S FASHION', 'Active', 'SUBCATBANNER_20200706025140_banner(9).jpg', '2020-07-06 02:51:40', NULL),
(17, 2, 'WOMEN\'S LONG DRESS', 'Active', 'SUBCATBANNER_20200706025312_banner(9).jpg', '2020-07-06 02:53:12', NULL),
(18, 3, 'BOYS SHIRT', 'Active', 'SUBCATBANNER_20200706034633_banner(6).jpg', '2020-07-06 03:46:33', NULL),
(19, 3, 'GIRLS DRESSES', 'Active', 'SUBCATBANNER_20200706034651_banner(8).jpg', '2020-07-06 03:46:51', NULL),
(20, 3, 'BOYS PANT', 'Active', 'SUBCATBANNER_20200706034723_banner(4).jpg', '2020-07-06 03:47:23', NULL),
(21, 4, 'VAST & FLOWERS', 'Active', 'SUBCATBANNER_20200706034835_banner(9).jpg', '2020-07-06 03:48:35', NULL),
(22, 5, 'MEN\'S COLLECTION', 'Active', 'SUBCATBANNER_20200706034901_banner(1).jpg', '2020-07-06 03:49:01', NULL),
(23, 5, 'WOMEN\'S COLLECTION', 'Active', 'SUBCATBANNER_20200706034914_banner(9).jpg', '2020-07-06 03:49:14', NULL),
(24, 7, 'GADGETS', 'Active', 'SUBCATBANNER_20200706035003_banner(2).jpg', '2020-07-06 03:50:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shipping_id` (`shipping_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ADMINS ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CATEGORIES ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CONTACTS ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CUSTOMERS ID', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DELIVERIES ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DISCOUNT ID';

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'INVOICE ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'NEWSLETTER ID';

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDERS ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDER ITEMS ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PAGES ID';

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRODUCTS ID', AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHIPPING ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shopcarts`
--
ALTER TABLE `shopcarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHOPCARTS ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SLIDER ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SUBCATEGORIES ID', AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shippings_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD CONSTRAINT `shopcarts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shopcarts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
