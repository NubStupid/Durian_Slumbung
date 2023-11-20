-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 06:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dummy_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Electronics'),
(2, 'Clothing'),
(3, 'Books'),
(4, 'Appliances'),
(5, 'Footwear'),
(6, 'Fiction Books'),
(7, 'Sports Equipment'),
(8, 'Home and Garden'),
(9, 'Toys'),
(10, 'Beauty and Personal Care'),
(11, 'Automotive'),
(12, 'Jewelry'),
(13, 'Movies'),
(14, 'Music'),
(15, 'Pet Supplies'),
(16, 'Office Supplies'),
(17, 'Health and Wellness'),
(18, 'Food and Beverages'),
(19, 'Outdoor Recreation'),
(20, 'Art and Craft');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com'),
(2, 'Jane', 'Smith', 'jane.smith@example.com'),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com'),
(4, 'Bob', 'Williams', 'bob.williams@example.com'),
(5, 'Eva', 'Brown', 'eva.brown@example.com'),
(6, 'Michael', 'Jones', 'michael.jones@example.com'),
(7, 'Olivia', 'Clark', 'olivia.clark@example.com'),
(8, 'William', 'Miller', 'william.miller@example.com'),
(9, 'Sophia', 'Taylor', 'sophia.taylor@example.com'),
(10, 'Jackson', 'Wilson', 'jackson.wilson@example.com'),
(11, 'Emma', 'Davis', 'emma.davis@example.com'),
(12, 'Liam', 'Moore', 'liam.moore@example.com'),
(13, 'Ava', 'Anderson', 'ava.anderson@example.com'),
(14, 'Noah', 'White', 'noah.white@example.com'),
(15, 'Isabella', 'Harris', 'isabella.harris@example.com'),
(16, 'Sophia', 'Johnson', 'sophia.johnson@example.com'),
(17, 'Lucas', 'Brown', 'lucas.brown@example.com'),
(18, 'Mia', 'Garcia', 'mia.garcia@example.com'),
(19, 'Ethan', 'Martinez', 'ethan.martinez@example.com'),
(20, 'Amelia', 'Smith', 'amelia.smith@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_amount`) VALUES
(1, 1, '2023-01-01', '999.99'),
(2, 2, '2023-01-02', '49.98'),
(3, 3, '2023-01-03', '199.99'),
(4, 4, '2023-01-04', '99.97'),
(5, 5, '2023-01-05', '599.95'),
(6, 6, '2023-01-06', '149.97'),
(7, 7, '2023-01-07', '29.98'),
(8, 8, '2023-01-08', '149.95'),
(9, 9, '2023-01-09', '199.92'),
(10, 10, '2023-01-10', '74.97'),
(11, 11, '2023-01-11', '299.94'),
(12, 12, '2023-01-12', '999.90'),
(13, 13, '2023-01-13', '34.97'),
(14, 14, '2023-01-14', '49.98'),
(15, 15, '2023-01-15', '199.92'),
(16, 16, '2023-01-16', '599.97'),
(17, 17, '2023-01-17', '29.99'),
(18, 18, '2023-01-18', '19.98'),
(19, 19, '2023-01-19', '24.99'),
(20, 20, '2023-01-20', '999.99');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, '999.99'),
(2, 2, 2, 2, '39.98'),
(3, 3, 3, 3, '74.97'),
(4, 4, 4, 1, '599.99'),
(5, 5, 5, 5, '199.95'),
(6, 6, 6, 2, '74.98'),
(7, 7, 7, 1, '29.98'),
(8, 8, 8, 3, '149.97'),
(9, 9, 9, 2, '99.96'),
(10, 10, 10, 1, '74.97'),
(11, 11, 11, 4, '119.96'),
(12, 12, 12, 1, '999.90'),
(13, 13, 13, 3, '29.97'),
(14, 14, 14, 2, '99.96'),
(15, 15, 15, 1, '199.92'),
(16, 16, 16, 6, '359.82'),
(17, 17, 17, 1, '29.99'),
(18, 18, 18, 2, '39.96'),
(19, 19, 19, 1, '24.99'),
(20, 20, 20, 1, '999.99');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `category_id`) VALUES
(1, 'Laptop', '999.99', 1),
(2, 'T-shirt', '19.99', 2),
(3, 'Programming Book', '29.99', 3),
(4, 'Smartphone', '599.99', 1),
(5, 'Jeans', '39.99', 2),
(6, 'Web Development Book', '24.99', 3),
(7, 'Blender', '79.99', 4),
(8, 'Running Shoes', '59.99', 5),
(9, 'Mystery Novel', '19.99', 6),
(10, 'Soccer Ball', '24.99', 7),
(11, 'Gardening Tools Set', '49.99', 8),
(12, 'LEGO Set', '39.99', 9),
(13, 'Shampoo', '9.99', 10),
(14, 'Car Battery', '89.99', 11),
(15, 'Diamond Ring', '499.99', 12),
(16, 'Movie DVD', '14.99', 13),
(17, 'Vinyl Record', '29.99', 14),
(18, 'Pet Food', '12.99', 15),
(19, 'Notebook', '5.99', 16),
(20, 'Fitness Tracker', '39.99', 17),
(21, 'Joken', '-5.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
