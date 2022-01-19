-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 08:34 AM
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
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_type` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`, `admin_type`) VALUES
(2, 'ahmad', 'ahmadabotoimah@gmail.com', 'Aa123456', 'uploads/admin_image/61b116331d0c9avatar.png', 1),
(3, 'farah', 'mango@gmail.com', '1234', 'uploads/admin_image/61b1163a1abefavatar.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(11, 'women', 'New Trend', 'uploads/category_image/IMG-61ae3593dc0d1banner-04.jpg'),
(12, 'Men', 'New Trend', 'uploads/category_image/IMG-61ae359cbbe3ebanner-05.jpg'),
(13, 'Bags', 'Spring 2018', 'uploads/category_image/IMG-61ae3574e149fbag.jpg'),
(14, 'Shoes', 'New Trend', 'uploads/category_image/IMG-61b0fd254319ashoes.jpg'),
(15, 'Accessories', 'New Trend', 'uploads/category_image/IMG-61ae3637d7041whatch.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_image` varchar(255) DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_product_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `comment_image`, `comment_date`, `comment_product_id`, `comment_user_id`, `comment_rate`) VALUES
(7, 'I like it', NULL, '2021-12-09 07:26:17', 74, 33, 5),
(8, 'beautiful', 'uploads/61b1afdddd288women-02.jpg', '2021-12-09 07:27:25', 24, 33, 5),
(9, 'beautiful', NULL, '2021-12-09 07:28:19', 41, 33, 5),
(10, 'Not good', NULL, '2021-12-09 07:28:59', 54, 33, 2),
(11, 'beautiful', 'uploads/61b1b087f1040sales-21.jpg', '2021-12-09 07:30:15', 79, 33, 5);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_text` varchar(255) NOT NULL,
  `coupon_percent` varchar(255) NOT NULL,
  `coupon_status` varchar(255) NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_text`, `coupon_percent`, `coupon_status`) VALUES
(36, 'ahmad123', '50', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_details` varchar(255) NOT NULL,
  `order_location` varchar(255) NOT NULL,
  `order_mobile` varchar(255) NOT NULL,
  `order_user_name` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_total` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'preparing',
  `order_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_details`, `order_location`, `order_mobile`, `order_user_name`, `order_date`, `order_total`, `order_status`, `order_user_id`) VALUES
(46, ',Sera Relaxed Tee,22,24,,', 'amman', '1234567', 'farah', '2021-12-09 02:48:35', '88', 'on delevery', 33),
(47, ',Sera Relaxed Tee,22,24,,', 'amman', '1234567', 'farah', '2021-12-09 02:50:26', '88', 'on delevery', 33),
(50, '$cart', '$location', '33', '$name', '2021-12-09 02:53:14', '$total', 'preparing', 33),
(51, ',Drop Shoulder Pullover & Sweatpants Set,55,40,,', 'amman', '792851914', 'farah', '2021-12-09 02:56:47', '550', 'on delevery', 33),
(52, ',Gabbie Panelled Flare,88,39,,', 'amman', '12', 'farah', '2021-12-09 03:03:35', '528', 'blocked', 33),
(53, ',Gabbie Panelled Flare,88,39,,', 'zarqa', '123456789', 'ahmad', '2021-12-09 03:09:56', '352', 'preparing', 35),
(54, ',Drop Shoulder Tie Dye Pullover,71,42,,', 'zarqa', '792851914', 'ahmad', '2021-12-09 06:23:30', '142', 'blocked', 34),
(55, ',Geometric Pattern Dome Bag,55,52,,', 'zarqa', '792851914', 'ahmad', '2021-12-09 06:23:58', '110', 'preparing', 34),
(56, ',Geometric Pattern Dome Bag,55,52,,', 'zarqa', '792851914', 'ahmad', '2021-12-09 06:23:58', '110', 'preparing', 34),
(57, ',Drop Shoulder Tie Dye Pullover,71,42,,', 'zarqa', '792851914', 'ahmad', '2021-12-09 06:23:30', '142', 'arrived', 34),
(58, ',Drop Shoulder Tie Dye Pullover,71,42,,', 'zarqa', '792851914', 'ahmad', '2021-12-09 06:23:30', '142', 'preparing', 34),
(59, ',Sera Relaxed Tee,22,24,,', 'amman', '1234567', 'farah', '2021-12-09 02:48:35', '88', 'preparing', 33);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_rate` int(11) DEFAULT NULL,
  `product_main_image` varchar(255) NOT NULL,
  `product_desc_image_1` varchar(255) DEFAULT NULL,
  `product_desc_image_2` varchar(255) DEFAULT NULL,
  `product_desc_image_3` varchar(255) DEFAULT NULL,
  `product_tag` varchar(255) NOT NULL,
  `product_categorie_id` int(11) NOT NULL,
  `product_nd_color_image` varchar(255) DEFAULT NULL,
  `product_thd_color_image` varchar(255) DEFAULT NULL,
  `product_fourth_color_image` varchar(255) DEFAULT NULL,
  `product_size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_quantity`, `product_rate`, `product_main_image`, `product_desc_image_1`, `product_desc_image_2`, `product_desc_image_3`, `product_tag`, `product_categorie_id`, `product_nd_color_image`, `product_thd_color_image`, `product_fourth_color_image`, `product_size`) VALUES
(24, 'Sera Relaxed Tee', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 333, NULL, 'uploads/61ae3b75f3257women-00.jpg', 'uploads/61ae3b75f3267women-01.jpg', 'uploads/61ae3b75f326cwomen-02.jpg', 'uploads/61ae3b75f3272women-03.jpg', 'women', 11, 'uploads/61ae3b75f326cwomen-02.jpg', 'uploads/61ae3b75f3272women-03.jpg', 'uploads/61ae3b75f326cwomen-02.jpg', 'Small,Medium,L,XL,XXL'),
(25, 'Solana Relaxed Lounge Shirt', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '44', 333, NULL, 'uploads/61ae3eacd28d6women-10.jpg', 'uploads/61ae3eacd28e5women-11.jpg', 'uploads/61ae3eacd28ebwomen-12.jpg', 'uploads/61ae3eacd28f1women-13.jpg', 'women', 11, 'uploads/61ae3eacd28ebwomen-12.jpg\n', 'uploads/61ae3eacd28f1women-13.jpg\n', 'uploads/61ae3eacd28e5women-11.jpg\n', 'Small,Medium,L,XL,XXL'),
(33, 'Gabbie Panelled Flare Skirt', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '21', 444, NULL, 'uploads/61ae57839a5ddacs-20.jpg', 'uploads/61ae57839a5e9acs-21.jpg', 'uploads/61ae57839a5efacs-22.jpg', 'uploads/61ae57839a5f5acs-20.jpg', 'accessories', 15, 'uploads/61ae57839a5fbacs-21.jpg', 'uploads/61ae57839a600acs-22.jpg', 'uploads/61ae57839a607acs-22.jpg', 'Small,Medium,L,XL,XXL'),
(34, 'Inlay baderafic letter 2 cut off', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 33, NULL, 'uploads/61ae57feb8aeeacs-30.jpg', 'uploads/61ae57feb8af6acs-31.jpg', 'uploads/61ae57feb8af9acs-32.jpg', 'uploads/61ae57feb8afcacs-33.jpg', 'accessories', 15, 'uploads/61ae57feb8afeacs-31.jpg', 'uploads/61ae57feb8b01acs-32.jpg', 'uploads/61ae57feb8b03acs-33.jpg', 'Small,Medium,L,XL,XXL'),
(35, 'Gabbie Panelled Flare ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '77', 77, NULL, 'uploads/61ae58ce05ae4bag-70.jpg', 'uploads/61ae58ce05af1bag-71.jpg', 'uploads/61ae58ce05af6bag-72.jpg', 'uploads/61ae58ce05afbbag-72.jpg', 'bag', 13, 'uploads/61ae58ce05b00bag-73.jpg', 'uploads/61ae58ce05b06bag-70.jpg', 'uploads/61ae58ce05b0bbag-71.jpg', 'Small,Medium,L,XL,XXL'),
(36, 'Gabbie Panelled Flare', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '82', 32, NULL, 'uploads/61ae591843385bag-00.jpg', 'uploads/61ae591843396bag-01.jpg', 'uploads/61ae59184339bbag-02.jpg', 'uploads/61ae5918433a0bag-00.jpg', 'bag', 13, 'uploads/61ae5918433a4bag-01.jpg', 'uploads/61ae5918433a8bag-02.jpg', 'uploads/61ae5918433aebag-00.jpg', 'Small,Medium,L,XL,XXL'),
(37, 'Gabbie Panelled Flare ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '73', 52, NULL, 'uploads/61ae599bc30e1acs-00.jpg', 'uploads/61ae599bc30f0acs-01.jpg', 'uploads/61ae599bc30f3acs-02.jpg', 'uploads/61ae599bc30f5acs-03.jpg', 'accessories', 15, 'uploads/61ae599bc30f8acs-00.jpg', 'uploads/61ae599bc30faacs-01.jpg', 'uploads/61ae599bc3102acs-02.jpg', NULL),
(38, 'Gabbie Panelled Flare ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '200', 55, 0, 'uploads/61b14da1063bfmen-00.jpg', 'uploads/61b14da1063cbmen-01.jpg', 'uploads/61b14da1063d0men-02.jpg', 'uploads/61b14da1063d4men-03.jpg', 'men', 12, 'uploads/61b14da1063d8men-00.jpg', 'uploads/61b14da1063demen-01.jpg', 'uploads/61b14da1063e3men-02.jpg', 'Small,Medium,L,XL,XXL'),
(39, 'Gabbie Panelled Flare', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '88', 66, NULL, 'uploads/61ae5a2ccca66men-50.jpg', 'uploads/61ae5a2ccca6fmen-11.jpg', 'uploads/61ae5a2ccca72men-12.jpg', 'uploads/61ae5a2ccca75men-13.jpg', 'men', 12, 'uploads/61ae5a2ccca77men-10.jpg', 'uploads/61ae5a2ccca7amen-11.jpg', 'uploads/61ae5a2ccca7dmen-12.jpg', 'Small,Medium,L,XL,XXL'),
(40, 'Drop Shoulder Pullover & Sweatpants Set', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '55', 333, NULL, 'uploads/61af167ddc4bfwomen-60.jpg', 'uploads/61af167ddc4d4women-61.jpg', 'uploads/61af167ddc4d9women-62.jpg', 'uploads/61af167ddc4dewomen-63.jpg', 'women', 11, 'uploads/61af167ddc4e2women-60.jpg', 'uploads/61af167ddc4e6women-61.jpg', 'uploads/61af167ddc4ebwomen-63.jpg', 'Small,Medium,L,XL,XXL'),
(41, 'Drop Shoulder Pullover & Sweatpants Set', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '33', 55, NULL, 'uploads/61af1716715b7women-20.jpg', 'uploads/61af1716715c6women-21.jpg', 'uploads/61af1716715cawomen-22.jpg', 'uploads/61af1716715cewomen-23.jpg', 'women', 11, 'uploads/61af1716715d1women-20.jpg', 'uploads/61af1716715d5women-21.jpg', 'uploads/61af1716715d8women-23.jpg', 'Small,Medium,L,XL,XXL'),
(42, 'Drop Shoulder Tie Dye Pullover', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '71', 72, NULL, 'uploads/61af17ab3fd37women-30.jpg', 'uploads/61af17ab3fd49women-31.jpg', 'uploads/61af17ab3fd4ewomen-32.jpg', 'uploads/61af17ab3fd53women-33.jpg', 'women', 11, 'uploads/61af17ab3fd58women-30.jpg', 'uploads/61af17ab3fd5dwomen-31.jpg', 'uploads/61af17ab3fd62women-33.jpg', 'Small,Medium,L,XL,XXL'),
(43, 'Drop Shoulder Tie Dye Pullover', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 322, NULL, 'uploads/61af17f1ba9d2women-40.jpg', 'uploads/61af17f1ba9dcwomen-41.jpg', 'uploads/61af17f1ba9e1women-42.jpg', 'uploads/61af17f1ba9e6women-43.jpg', 'women', 11, 'uploads/61af17f1ba9eawomen-40.jpg', 'uploads/61af17f1ba9efwomen-41.jpg', 'uploads/61af17f1ba9f3women-43.jpg', 'Small,Medium,L,XL,XXL'),
(44, 'Drop Shoulder Drawstring Crop Hoodie', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '150', 76, 0, 'uploads/61b14d306e884women-50.jpg', 'uploads/61b14d306e892women-51.jpg', 'uploads/61b14d306e898women-52.jpg', 'uploads/61b14d306e89dwomen-53.jpg', 'women', 11, 'uploads/61b14d306e8a2women-50.jpg', 'uploads/61b14d306e8a8women-52.jpg', 'uploads/61b14d306e8adwomen-53.jpg', 'Small,Medium,L,XL,XXL'),
(45, 'Gabbie Panelled Flare Skirt', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 33, NULL, 'uploads/61af190a7c948women-70.jpg', 'uploads/61af190a7c955women-71.jpg', 'uploads/61af190a7c95cwomen-72.jpg', 'uploads/61af190a7c963women-73.jpg', 'women', 11, 'uploads/61af190a7c96awomen-70.jpg', 'uploads/61af190a7c970women-71.jpg', 'uploads/61af190a7c975women-72.jpg', 'Small,Medium,L,XL,XXL'),
(46, 'Men Buffalo Plaid Print Teddy Top', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 33, NULL, 'uploads/61af19a70e1a5men-10.jpg', 'uploads/61af19a70e1b4men-11.jpg', 'uploads/61af19a70e1b9men-12.jpg', 'uploads/61af19a70e1bemen-13.jpg', 'men', 12, 'uploads/61af19a70e1c3men-10.jpg', 'uploads/61af19a70e1c8men-11.jpg', 'uploads/61af19a70e1cemen-13.jpg', 'Small,Medium,L,XL,XXL'),
(47, 'Men Buffalo Plaid Print Teddy Top', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '250', 44, 0, 'uploads/61b14ea1ddea9men-20.jpg', 'uploads/61b14ea1ddebemen-21.jpg', 'uploads/61b14ea1ddec3men-22.jpg', 'uploads/61b14ea1ddec7men-23.jpg', 'men', 12, 'uploads/61b14ea1ddecbmen-20.jpg', 'uploads/61b14ea1ddecfmen-21.jpg', 'uploads/61b14ea1dded3men-23.jpg', 'Small,Medium,L,XL,XXL'),
(48, 'Gabbie Panelled Flare ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 77, NULL, 'uploads/61af1a46e6727men-30.jpg', 'uploads/61af1a46e6734men-31.jpg', 'uploads/61af1a46e6739men-32.jpg', 'uploads/61af1a46e673fmen-33.jpg', 'men', 12, 'uploads/61af1a46e6744men-30.jpg', 'uploads/61af1a46e6749men-31.jpg', 'uploads/61af1a46e6750men-32.jpg', 'Small,Medium,L,XL,XXL'),
(49, 'Extended Sizes Men Patch Detail Contrast Trim Sweatshirt', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 55, NULL, 'uploads/61af1ac5d7d2amen-60.jpg', 'uploads/61af1ac5d7d32men-61.jpg', 'uploads/61af1ac5d7d36men-62.jpg', 'uploads/61af1ac5d7d39men-63.jpg', 'men', 12, 'uploads/61af1ac5d7d3cmen-60.jpg', 'uploads/61af1ac5d7d40men-61.jpg', 'uploads/61af1ac5d7d43men-62.jpg', 'Small,Medium,L,XL,XXL'),
(50, 'Sweatshirt', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '50', 15, NULL, 'uploads/61af1b1503052men-70.jpg', 'uploads/61af1b150305fmen-71.jpg', 'uploads/61af1b1503065men-72.jpg', 'uploads/61af1b150307amen-73.jpg', 'men', 12, 'uploads/61af1b150307fmen-70.jpg', 'uploads/61af1b1503083men-72.jpg', 'uploads/61af1b1503087men-73.jpg', 'Small,Medium,L,XL,XXL'),
(51, 'Solana ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '32', 88, NULL, 'uploads/61af1b63528bdmen-40.jpg', 'uploads/61af1b63528c9men-41.jpg', 'uploads/61af1b63528cemen-42.jpg', 'uploads/61af1b63528d3men-43.jpg', 'men', 12, 'uploads/61af1b63528d8men-40.jpg', 'uploads/61af1b63528ddmen-41.jpg', 'uploads/61af1b63528e1men-43.jpg', 'Small,Medium,L,XL,XXL'),
(52, 'Geometric Pattern Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '55', 44, NULL, 'uploads/61af1c36e13ebbag-00.jpg', 'uploads/61af1c36e13f1bag-01.jpg', 'uploads/61af1c36e13f4bag-02.jpg', 'uploads/61af1c36e13f6bag-00.jpg', 'bags', 13, 'uploads/61af1c36e13f8bag-01.jpg', 'uploads/61af1c36e13fabag-02.jpg', 'uploads/61af1c36e13fcbag-00.jpg', NULL),
(53, 'Geometric Pattern Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 55, NULL, 'uploads/61af200ef37ffbag-10.jpg', 'uploads/61af200ef380cbag-11.jpg', 'uploads/61af200ef3812bag-12.jpg', 'uploads/61af200ef3816bag-13.jpg', 'bag', 13, 'uploads/61af200ef381bbag-10.jpg', 'uploads/61af200ef3820bag-11.jpg', 'uploads/61af200ef3824bag-12.jpg', NULL),
(54, 'Geometric Pattern Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '77', 44, NULL, 'uploads/61af209728ba9bag-20.jpg', 'uploads/61af209728bb3bag-21.jpg', 'uploads/61af209728bb8bag-22.jpg', 'uploads/61af209728bbbbag-23.jpg', 'bag', 13, 'uploads/61af209728bbfbag-20.jpg', 'uploads/61af209728bc3bag-21.jpg', 'uploads/61af209728bc7bag-22.jpg', NULL),
(55, 'Geometric Pattern Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '88', 55, NULL, 'uploads/61af20dca4260bag-30.jpg', 'uploads/61af20dca426cbag-31.jpg', 'uploads/61af20dca4271bag-32.jpg', 'uploads/61af20dca4275bag-33.jpg', 'bag', 13, 'uploads/61af20dca427abag-30.jpg', 'uploads/61af20dca427ebag-31.jpg', 'uploads/61af20dca4283bag-32.jpg', NULL),
(56, 'Geometric Pattern Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '99', 44, NULL, 'uploads/61af211409d95bag-40.jpg', 'uploads/61af211409da0bag-41.jpg', 'uploads/61af211409da5bag-42.jpg', 'uploads/61af211409da9bag-43.jpg', 'bag', 13, 'uploads/61af211409db0bag-40.jpg', 'uploads/61af211409db4bag-41.jpg', 'uploads/61af211409db9bag-42.jpg', NULL),
(57, 'Pattern Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '84', 78, NULL, 'uploads/61af216520d02bag-50.jpg', 'uploads/61af216520d0dbag-51.jpg', 'uploads/61af216520d12bag-52.jpg', 'uploads/61af216520d16bag-53.jpg', 'bag', 13, 'uploads/61af216520d1bbag-50.jpg', 'uploads/61af216520d1fbag-51.jpg', 'uploads/61af216520d24bag-53.jpg', NULL),
(58, 'Dome Bag', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '77', 51, NULL, 'uploads/61af21c6ef1ccbag-60.jpg', 'uploads/61af21c6ef1d6bag-61.jpg', 'uploads/61af21c6ef1dabag-62.jpg', 'uploads/61af21c6ef1dfbag-63.jpg', 'bag', 13, 'uploads/61af21c6ef1e3bag-60.jpg', 'uploads/61af21c6ef1e6bag-61.jpg', 'uploads/61af21c6ef1ebbag-62.jpg', NULL),
(59, 'Minimalist Plush Inside Combat Boots', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '98', 44, NULL, 'uploads/61af2258e1fffshoes-00.jpg', 'uploads/61af2258e200bshoes-01.jpg', 'uploads/61af2258e2010shoes-02.jpg', 'uploads/61af2258e2015shoes-03.jpg', 'shoes', 14, 'uploads/61af2258e201ashoes-00.jpg', 'uploads/61af2258e201fshoes-02.jpg', 'uploads/61af2258e2025shoes-03.jpg', '37,38,39,40,41,42,43,44,45'),
(60, 'Minimalist Boots', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '62', 44, NULL, 'uploads/61af22b4b4a61shoes-10.jpg', 'uploads/61af22b4b4a73shoes-11.jpg', 'uploads/61af22b4b4a7ashoes-12.jpg', 'uploads/61af22b4b4a81shoes-13.jpg', 'shoes', 14, 'uploads/61af22b4b4a87shoes-10.jpg', 'uploads/61af22b4b4a8dshoes-11.jpg', 'uploads/61af22b4b4a94shoes-12.jpg', '37,38,39,40,41,42,43,44,45'),
(61, 'Minimalist Boots', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '66', 444, NULL, 'uploads/61af22efbc9c1shoes-20.jpg', 'uploads/61af22efbc9d0shoes-21.jpg', 'uploads/61af22efbc9d9shoes-22.jpg', 'uploads/61af22efbc9e5shoes-23.jpg', 'shoes', 14, 'uploads/61af22efbc9edshoes-20.jpg', 'uploads/61af22efbc9f4shoes-21.jpg', 'uploads/61af22efbc9fcshoes-22.jpg', '37,38,39,40,41,42,43,44,45'),
(62, 'Minimalist Boots', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '38', 66, NULL, 'uploads/61af23299f568shoes-30.jpg', 'uploads/61af23299f574shoes-31.jpg', 'uploads/61af23299f579shoes-32.jpg', 'uploads/61af23299f57dshoes-33.jpg', 'shoes', 14, 'uploads/61af23299f582shoes-30.jpg', 'uploads/61af23299f585shoes-31.jpg', 'uploads/61af23299f58ashoes-32.jpg', '37,38,39,40,41,42,43,44,45'),
(63, 'Minimalist Boots', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '51', 44, NULL, 'uploads/61af23674a9c5shoes-40.jpg', 'uploads/61af23674a9d1shoes-41.jpg', 'uploads/61af23674a9dcshoes-42.jpg', 'uploads/61af23674a9e2shoes-43.jpg', 'shoes', 14, 'uploads/61af23674a9e7shoes-40.jpg', 'uploads/61af23674a9ecshoes-42.jpg', 'uploads/61af23674a9f2shoes-43.jpg', '37,38,39,40,41,42,43,44,45'),
(64, 'Minimalist ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '77', 33, NULL, 'uploads/61af23b06e73dshoes-50.jpg', 'uploads/61af23b06e749shoes-51.jpg', 'uploads/61af23b06e74fshoes-52.jpg', 'uploads/61af23b06e755shoes-53.jpg', 'shoes', 14, 'uploads/61af23b06e75ashoes-50.jpg', 'uploads/61af23b06e75fshoes-52.jpg', 'uploads/61af23b06e764shoes-53.jpg', '37,38,39,40,41,42,43,44,45'),
(65, 'Minimalist ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '66', 66, NULL, 'uploads/61af23f6d3dc7shoes-60.jpg', 'uploads/61af23f6d3ddbshoes-61.jpg', 'uploads/61af23f6d3ddfshoes-62.jpg', 'uploads/61af23f6d3de4shoes-60.jpg', 'shoes', 14, 'uploads/61af23f6d3de8shoes-61.jpg', 'uploads/61af23f6d3dedshoes-62.jpg', 'uploads/61af23f6d3df2shoes-60.jpg', '37,38,39,40,41,42,43,44,45'),
(66, 'Letter Graphic High Top Boots', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '55', 33, NULL, 'uploads/61af2451cb5beshoes-70.jpg', 'uploads/61af2451cb5cdshoes-71.jpg', 'uploads/61af2451cb5d1shoes-72.jpg', 'uploads/61af2451cb5d6shoes-70.jpg', 'shoes', 14, 'uploads/61af2451cb5d9shoes-71.jpg', 'uploads/61af2451cb5ddshoes-72.jpg', 'uploads/61af2451cb5e1shoes-70.jpg', '37,38,39,40,41,42,43,44,45'),
(67, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '300', 32, 0, 'uploads/61b1ab96acea0acs-10.jpg', 'uploads/61b1ab96aceaeacs-11.jpg', 'uploads/61b1ab96aceb2acs-12.jpg', 'uploads/61b1ab96aceb5acs-13.jpg', 'accessories', 15, 'uploads/61b1ab96aceb8acs-10.jpg', 'uploads/61b1ab96acebbacs-11.jpg', 'uploads/61b1ab96acebeacs-12.jpg', ''),
(68, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '10', 44, NULL, 'uploads/61af251d30966acs-40.jpg', 'uploads/61af251d30981acs-41.jpg', 'uploads/61af251d30987acs-42.jpg', 'uploads/61af251d3098cacs-43.jpg', 'accessories', 15, 'uploads/61af251d30991acs-40.jpg', 'uploads/61af251d30997acs-41.jpg', 'uploads/61af251d3099cacs-42.jpg', NULL),
(69, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '22', 12, NULL, 'uploads/61af2563598a1acs-50.jpg', 'uploads/61af2563598aeacs-51.jpg', 'uploads/61af2563598b4acs-52.jpg', 'uploads/61af2563598b9acs-53.jpg', 'accessories', 15, 'uploads/61af2563598beacs-50.jpg', 'uploads/61af2563598c3acs-51.jpg', 'uploads/61af2563598c8acs-52.jpg', NULL),
(70, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '77', 22, NULL, 'uploads/61af25b340c97acs-60.jpg', 'uploads/61af25b340c9facs-61.jpg', 'uploads/61af25b340ca2acs-62.jpg', 'uploads/61af25b340ca4acs-63.jpg', 'accessories', 15, 'uploads/61af25b340ca7acs-60.jpg', 'uploads/61af25b340ca9acs-61.jpg', 'uploads/61af25b340cadacs-62.jpg', NULL),
(71, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '19', 66, NULL, 'uploads/61af25e87dd40acs-70.jpg', 'uploads/61af25e87dd4bacs-71.jpg', 'uploads/61af25e87dd4facs-72.jpg', 'uploads/61af25e87dd53acs-70.jpg', 'accessories', 15, 'uploads/61af25e87dd56acs-71.jpg', 'uploads/61af25e87dd5bacs-72.jpg', 'uploads/61af25e87dd5facs-70.jpg', NULL),
(72, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '32', 66, NULL, 'uploads/61af276da04cenew-00.jpg', 'uploads/61af276da04danew-01.jpg', 'uploads/61af276da04ddnew-02.jpg', 'uploads/61af276da04e1new-03.jpg', 'new', 13, 'uploads/61af276da04e4new-00.jpg', 'uploads/61af276da04e7new-01.jpg', 'uploads/61af276da04eanew-02.jpg', NULL),
(73, 'shoes ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '73', 44, NULL, 'uploads/61af28058fec5new-10.jpg', 'uploads/61af28058fed2new-11.jpg', 'uploads/61af28058fed7new-12.jpg', 'uploads/61af28058fedcnew-13.jpg', 'new', 14, 'uploads/61af28058fee1new-10.jpg', 'uploads/61af28058fee6new-11.jpg', 'uploads/61af28058feebnew-12.jpg', '39,40,41,42,43,44,45'),
(74, 'Geometric Rhinestone Decor', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '15', 41, NULL, 'uploads/61af28402a45anew-20.jpg', 'uploads/61af28402a461new-21.jpg', 'uploads/61af28402a464new-22.jpg', 'uploads/61af28402a466new-20.jpg', 'new', 15, 'uploads/61af28402a468new-21.jpg', 'uploads/61af28402a46bnew-22.jpg', 'uploads/61af28402a46dnew-20.jpg', NULL),
(75, 'Geometric  ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '20', 3, NULL, 'uploads/61af28b75fe3csales-30.jpg', 'uploads/61af28b75fe47sales-31.jpg', 'uploads/61af28b75fe4csales-32.jpg', 'uploads/61af28b75fe51sales-33.jpg', 'sales', 15, 'uploads/61af28b75fe56sales-30.jpg', 'uploads/61af28b75fe5asales-31.jpg', 'uploads/61af28b75fe5fsales-32.jpg', NULL),
(76, 'Gabbie Panelled Flare ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '86', 44, NULL, 'uploads/61af28fc9071dnew-30.jpg', 'uploads/61af28fc90728new-31.jpg', 'uploads/61af28fc9072dnew-32.jpg', 'uploads/61af28fc90732new-33.jpg', 'sales', 14, 'uploads/61af28fc90737new-30.jpg', 'uploads/61af28fc9073cnew-31.jpg', 'uploads/61af28fc90741new-32.jpg', '37,38,39,40,41,42,43,44,45'),
(77, 'Minimalist ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '100', 7, NULL, 'uploads/61af295d34f6bsales-10.jpg', 'uploads/61af295d34f78sales-11.jpg', 'uploads/61af295d34f7dsales-12.jpg', 'uploads/61af295d34f83sales-13.jpg', 'new', 12, 'uploads/61af295d34f88sales-10.jpg', 'uploads/61af295d34f8esales-11.jpg', 'uploads/61af295d34f93sales-12.jpg', NULL),
(78, 'Gabbie Panelled ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '26', 111, NULL, 'uploads/61af29c390ed2sales-00.jpg', 'uploads/61af29c390edfsales-01.jpg', 'uploads/61af29c390ee5sales-02.jpg', 'uploads/61af29c390eebsales-00.jpg', 'sales', 15, 'uploads/61af29c390ef0sales-01.jpg', 'uploads/61af29c390ef5sales-02.jpg', 'uploads/61af29c390efbsales-00.jpg', NULL),
(79, 'Minimalist ', 'Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus e', '35', 44, NULL, 'uploads/61af2a0aeb889sales-20.jpg', 'uploads/61af2a0aeb895sales-21.jpg', 'uploads/61af2a0aeb89bsales-22.jpg', 'uploads/61af2a0aeb8a0sales-23.jpg', 'sales', 14, 'uploads/61af2a0aeb8a6sales-20.jpg', 'uploads/61af2a0aeb8absales-21.jpg', 'uploads/61af2a0aeb8b1sales-22.jpg', '37,38,39,40,41,42,43,44,45');

-- --------------------------------------------------------

--
-- Table structure for table `unique_visitors`
--

CREATE TABLE `unique_visitors` (
  `visit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `visitor_ip` varchar(255) NOT NULL,
  `visittor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unique_visitors`
--

INSERT INTO `unique_visitors` (`visit_date`, `visitor_ip`, `visittor_id`) VALUES
('2021-12-05 23:52:41', '::1', 1),
('2021-12-05 23:59:22', '::2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mobile` int(14) DEFAULT NULL,
  `user_location` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'admin\\uploads\\user_image\\61b1067643199avatar.png',
  `user_gender` varchar(255) NOT NULL,
  `user_creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mobile`, `user_location`, `user_image`, `user_gender`, `user_creation_date`) VALUES
(33, 'farah', 'farah@gmail.com', '1234', 1234567, 'amman', '\n\nadmin\\uploads\\user_image\\61b1067643199avatar.png', 'Male', '2021-12-08 21:16:04'),
(34, 'admin', 'mango@gmail.com', '1234', NULL, NULL, '\n\nadmin\\uploads\\user_image\\61b1067643199avatar.png', 'Female', '2021-12-08 21:18:31'),
(35, 'admin', 'farahmangoo@gmail.com', '123', NULL, NULL, 'admin\\uploads\\user_image\\61b1067643199avatar.png', 'femal', '2021-12-08 22:21:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_user` (`comment_user_id`),
  ADD KEY `comment_product` (`comment_product_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user_id` (`order_user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_category` (`product_categorie_id`);

--
-- Indexes for table `unique_visitors`
--
ALTER TABLE `unique_visitors`
  ADD PRIMARY KEY (`visittor_id`),
  ADD UNIQUE KEY `visitor_ip` (`visitor_ip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `unique_visitors`
--
ALTER TABLE `unique_visitors`
  MODIFY `visittor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_product` FOREIGN KEY (`comment_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`comment_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`product_categorie_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
