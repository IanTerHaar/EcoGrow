CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `shops` (
  `shopID` int(10) UNSIGNED NOT NULL,
  `shopName` varchar(50) NOT NULL,
  `shopLocation` varchar(50) NOT NULL,
  `shopProduct` varchar(100) NOT NULL,
  `shopPrice` int(50) NOT NULL,
  `shopImagePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cart` (
  `cartID` int(10) UNSIGNED NOT NULL,
  `userID` int(255) NOT NULL,
  `shopID` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `fk_cart_userID_users` (`userID`),
  ADD KEY `fk_cart_shopID_users` (`shopID`);