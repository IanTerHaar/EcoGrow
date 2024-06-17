<?php
session_start();
setcookie('site_session', session_id(), 0, "/"); // Set session cookie for the browser session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shops</title>
    <link rel="stylesheet" href="../assets/css/shopsStyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon_resized.png">
</head>
<body>
    <header>
        <div class="title-logo-container">
            <div class="logo-container">
                <a href="../pages/dashboard.php">
                    <img src="../assets/images/ecogrow logo.png" alt="logo">
                </a>
            </div>
            <h1>Shops</h1>
        </div>
        <nav>
            <ul id="nav-list">
                <li><a href="#" id="shops-link">Shops</a></li>
                <li><a href="#" id="orderHistory-link">Order History</a></li>
                <li><a href="#" id="howItWorks-link">How it works</a></li>
                <li><a href="#" id="aboutUs-link">About us</a></li>
                <li><a href="#" id="cart-link">Cart</a></li>
                <li><a href="#" id="account-link">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="shops-section">
            <h2>Shops</h2>
            <div class="shop-list" id="shop-list">
                <?php
                // Start session only once
                // session_start(); // Already started at the top

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ecogrow";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT shopID, shopName, shopLocation, shopProduct, shopPrice, shopImagePath FROM shops";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $shopID = $row['shopID'];
                        $shopName = htmlspecialchars($row['shopName']);
                        $shopLocation = htmlspecialchars($row['shopLocation']);
                        $shopProduct = htmlspecialchars($row['shopProduct']);
                        $shopPrice = htmlspecialchars($row['shopPrice']);
                        $shopImagePath = htmlspecialchars($row['shopImagePath']); // Fetch the image path from the database
                        echo "<div class='shop-item' data-shop-id='$shopID'>";
                        echo "<img src='../assets/images/$shopImagePath' alt='Shop Image'>"; // Reference the image from the assets/images directory
                        echo "<h3>$shopName</h3>";
                        echo "<p>Location: $shopLocation</p>";
                        echo "<p>Products: $shopProduct</p>";
                        echo "<p>Price: R$shopPrice per unit</p>";
                        echo "<button class='shop-button'>Add to cart</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No shops found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 EcoGrow</p>
    </footer>

    <script>
        document.querySelectorAll('.shop-button').forEach(button => {
            button.addEventListener('click', function() {
                const shopItem = this.closest('.shop-item');
                const shopID = shopItem.getAttribute('data-shop-id');

                fetch('../pages/cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ shopID: shopID })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item added to cart');
                    } else {
                        alert('Failed to add item to cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding the item to the cart.');
                });
            });
        });

        document.getElementById('shops-link').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '../pages/shops.php';
        });

        document.getElementById('orderHistory-link').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '../pages/orderHistory.php';
        });

        document.getElementById('howItWorks-link').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '../pages/howItWorks.php';
        });

        document.getElementById('aboutUs-link').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '../pages/aboutUs.php';
        });

        document.getElementById('cart-link').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '../pages/cart.php';
        });

        document.getElementById('account-link').addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = '../pages/account.php';
        });

        // Clear session on tab close or browser close
        window.addEventListener('beforeunload', function () {
            navigator.sendBeacon('../process/unset_session_cookie.php');
        });
    </script>
</body>
</html>
