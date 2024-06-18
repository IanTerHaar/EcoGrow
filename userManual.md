# EcoGrow User Manual

## Table of Contents
1. [Introduction](#introduction)
2. [Getting Started](#getting-started)
    1. [Sign Up](#sign-up)
    2. [Log In](#log-in)
3. [Dashboard](#dashboard)
4. [Navigation Bar](#navigation-bar)
    1. [Shops](#shops)
    2. [Contact Us](#contact-us)
    3. [How It Works](#how-it-works)
    4. [About Us](#about-us)
    5. [Cart](#cart)
    6. [Account](#account)
5. [Database Configuration](#database-configuration)
6. [Conclusion](#conclusion)

## Introduction
EcoGrow is a start-up based in Cape Town, South Africa, aiming to revolutionize the way consumers buy their food by connecting them directly with local farmers. Our platform provides a digital marketplace where consumers can purchase fresh produce directly from local farmers, supporting healthier eating habits, local economies, and reducing carbon emissions associated with long-distance food transportation.

## Getting Started

### Sign Up
1. Go to the EcoGrow website: [EcoGrow](http://ecogrow.free.nf).
2. Click on the "Sign Up Here" link on the login page.
3. Fill in your name, surname, email, and password.
4. Click the "Sign Up" button.
5. You will be redirected to the login page.

### Log In
1. Go to the EcoGrow website: [EcoGrow](http://ecogrow.free.nf).
2. Enter your registered email and password.
3. Click the "Log In" button.
4. You will be redirected to the dashboard.

## Dashboard
Upon successful login, you will be redirected to the dashboard. Here, you can read about the EcoGrow mission and how it benefits farmers and consumers. 

## Navigation Bar
The navigation bar at the top of the page contains links to various sections of the website:

### Shops
1. Click on the "Shops" link in the navigation bar.
2. Browse through the list of items (e.g., apples, oranges, strawberries).
3. Each item includes details such as the farm it comes from, price per unit, and location of the farm.
4. Click the "Add to Cart" button to add an item to your cart.

### Contact Us
1. Click on the "Contact Us" link in the navigation bar.
2. Find various contact information to reach EcoGrow for selling items or general queries.

### How It Works
1. Click on the "How It Works" link in the navigation bar.
2. You will see the following information:
    - **Sign Up**: Create an account by providing your basic information. Farmers and consumers can both join our platform to buy and sell fresh produce.
    - **Set Up Your Profile**: Complete your profile with relevant details.
    - **Browse and Purchase**: Consumers can browse through the list of available produce and make purchases.
    - **Delivery**: Once an order is placed, farmers will prepare the produce for delivery. We ensure that all deliveries are made in a timely and efficient manner.

### About Us
1. Click on the "About Us" link in the navigation bar.
2. You will see the following information:
    - **EcoGrow Mission**: Learn about our mission to revolutionize food purchasing by connecting consumers directly with local farmers, supporting healthier eating habits, local economies, and reducing carbon emissions.

### Cart
1. Click on the "Cart" link in the navigation bar.
2. View the list of items you have added to your cart, along with their details.
3. Each item will have a "Total" line indicating the cost of that specific item.
4. You can remove items from your cart if needed.
5. At the bottom of the cart page, you will see the total cost of your entire cart.
6. Click the "Proceed to Checkout" button to place your order.
    - The button text will change to "Order Placed!" for 1 second, then revert to "Proceed to Checkout."
    - The page will refresh, and your cart will be empty.

### Account
1. Click on the "Account" link in the navigation bar.
2. Update your name, surname, email, and password as needed.
3. Click the "Update Information" button to save changes.
4. Click the "Log Out" button to log out and return to the login page.

## Database Configuration

### Creating the Database
To set up the EcoGrow database in phpMyAdmin, follow these steps:

1. Open phpMyAdmin in your web browser.
2. Click on the "Databases" tab.
3. In the "Create database" field, enter a name for your database (e.g., `ecogrow`).
4. Click the "Create" button.

Next, create the required tables by running the following SQL script:

```sql
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
  ```
  To run the SQL script:

1. In phpMyAdmin, select the database you just created from the left-hand sidebar.
2. Click on the "SQL" tab.
3. Copy and paste the SQL script into the text field.
4. Click the "Go" button to execute the script and create the tables.

### Updating Database Connection Details

To configure the database details, you need to update the `includes/db.php` file in the repository.

1. Open the `includes/db.php` file.
2. Update the database connection details with the correct information.

```php
<?php
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
Replace your_servername, your_username, your_password, and your_dbname with the actual database details.

## Conclusion
Thank you for using EcoGrow! Our platform is designed to provide a seamless and efficient way for consumers to access fresh, locally sourced produce while supporting local farmers. By connecting directly with farmers, you are contributing to a more sustainable and eco-friendly food supply chain. We hope this user manual helps you navigate the EcoGrow platform effectively. 

If you have any questions or need further assistance, please don't hesitate to contact us through the "Contact Us" page. Together, we can make a positive impact on our community and the environment.

Happy shopping!

The EcoGrow Team