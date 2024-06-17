<?php
session_start();
setcookie('site_session', session_id(), 0, "/"); // Set session cookie for the browser session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/css/cartStyles.css">
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
            <h1>Cart</h1>
        </div>
        <nav>
            <ul id="nav-list">
                <li><a href="../pages/shops.php" id="shops-link">Shops</a></li>
                <li><a href="../pages/orderHistory.php" id="orderHistory-link">Order History</a></li>
                <li><a href="../pages/howItWorks.php" id="howItWorks-link">How it works</a></li>
                <li><a href="../pages/aboutUs.php" id="aboutUs-link">About us</a></li>
                <li><a href="../pages/cart.php" id="cart-link">Cart</a></li>
                <li><a href="../pages/account.php" id="account-link">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="cart-section">
            <h2>Cart</h2>
            <div class="cart-list" id="cart-list">
                <?php
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
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

                    foreach ($_SESSION['cart'] as $item) {
                        $shopID = $item['shopID'];
                        $quantity = $item['quantity'];

                        $sql = "SELECT shopName, shopLocation, shopProduct, shopPrice, shopImagePath FROM shops WHERE shopID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $shopID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $shopName = htmlspecialchars($row['shopName']);
                                $shopLocation = htmlspecialchars($row['shopLocation']);
                                $shopProduct = htmlspecialchars($row['shopProduct']);
                                $shopPrice = htmlspecialchars($row['shopPrice']);
                                $shopImagePath = htmlspecialchars($row['shopImagePath']);

                                echo "<div class='cart-item'>";
                                echo "<img src='../assets/images/$shopImagePath' alt='Shop Image'>";
                                echo "<h3>$shopName</h3>";
                                echo "<p>Location: $shopLocation</p>";
                                echo "<p>Products: $shopProduct</p>";
                                echo "<p>Price: R$shopPrice per unit</p>";
                                echo "<p>Quantity: $quantity</p>";
                                echo "</div>";
                            }
                        }
                    }

                    $conn->close();
                } else {
                    echo "<p>Your cart is empty.</p>";
                }
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

                
    </script>
</body>
</html>