-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 04:13 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `category_id`, `qty`, `rating`, `description`, `img_url`) VALUES
(1, 'Jonathan Kenrick\'s Laptop', '1000.00', 18, 15, 3, 'KWNDQP:OWNKDIWQNDOPWQNDwpqd', 'https://picsum.photos/id/125/200/300'),
(2, 'Jane\'s Smartphone', '500.00', 12, 10, 4, 'A sleek smartphone with advanced features.', 'https://picsum.photos/id/126/200/300'),
(3, 'Gaming Console', '300.00', 8, 20, 5, 'Next-gen gaming console for immersive gaming experience.', 'https://picsum.photos/id/127/200/300'),
(4, 'Wireless Headphones', '80.00', 15, 50, 4, 'Enjoy music without the hassle of wires.', 'https://picsum.photos/id/128/200/300'),
(5, 'Coffee Maker', '50.00', 10, 25, 4, 'Brew your favorite coffee with ease.', 'https://picsum.photos/id/129/200/300'),
(6, 'Fitness Tracker', '120.00', 5, 15, 4, 'Monitor your health and stay active.', 'https://picsum.photos/id/130/200/300'),
(7, 'Digital Camera', '250.00', 7, 12, 4, 'Capture moments with high-quality photos.', 'https://picsum.photos/id/131/200/300'),
(8, 'Portable Speaker', '70.00', 15, 40, 4, 'Listen to music on the go with this portable speaker.', 'https://picsum.photos/id/132/200/300'),
(9, 'Laptop Stand', '30.00', 18, 50, 3, 'Improve ergonomics with this adjustable laptop stand.', 'https://picsum.photos/id/133/200/300'),
(10, 'Bluetooth Mouse', '20.00', 18, 30, 4, 'Wireless mouse for convenient computing.', 'https://picsum.photos/id/134/200/300'),
(11, 'External Hard Drive', '120.00', 14, 18, 5, 'Expand your storage capacity with this external hard drive.', 'https://picsum.photos/id/135/200/300'),
(12, 'Desktop Monitor', '200.00', 13, 8, 4, 'Large monitor for immersive computing experience.', 'https://picsum.photos/id/136/200/300'),
(13, 'Graphic Tablet', '150.00', 11, 10, 4, 'Ideal for digital artists and illustrators.', 'https://picsum.photos/id/137/200/300');

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
