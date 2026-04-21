-- Pembuatan Database
CREATE DATABASE IF NOT EXISTS db_toko_baju;
USE db_toko_baju;

-- 1. Tabel Users (Untuk fitur Login/Logout dan hak akses)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Memasukkan data akun default
-- Password default adalah 'password123' (hashed menggunakan password_hash() PHP)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Administrator', 'admin@luxethreads.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(2, 'Customer Satu', 'customer@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer');

-- 2. Tabel Products (Tabel Baju)
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT 'default.jpg',
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Memasukkan data baju (seperti pada dummy data kita sebelumnya)
INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `image`, `description`) VALUES
(1, 'Midnight Velvet Jacket', 'Outerwear', 850000, 15, 'jacket.jpg', 'Premium velvet material for elegant night outs.'),
(2, 'Classic Oxford Shirt', 'Tops', 450000, 30, 'shirt.jpg', 'Comfortable daily wear classic oxford.'),
(3, 'Urban Cargo Pants', 'Bottoms', 550000, 25, 'pants.jpg', 'Stylish urban cargo for modern looks.'),
(4, 'Silk Elegance Dress', 'Dresses', 1200000, 10, 'dress.jpg', '100% pure silk elegant dress.'),
(5, 'Vintage Denim Jacket', 'Outerwear', 750000, 20, 'denim.jpg', 'Classic vintage 90s style denim.'),
(6, 'Cozy Knit Sweater', 'Tops', 350000, 40, 'sweater.jpg', 'Warm and cozy knit sweater for cold weather.');

-- 3. Tabel Transactions (Sistem CRUD Transaksi)
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  `total_amount` int(11) NOT NULL,
  `status` enum('pending','paid','shipped','completed','canceled') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Transaction Details
CREATE TABLE IF NOT EXISTS `transaction_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`transaction_id`) REFERENCES `transactions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
