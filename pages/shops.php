<?php
session_start();

include '../includes/db.php';

$logData = 'Session Data: ' . print_r($_SESSION, true) . "\n";
file_put_contents('../logs/session_debug_shops.txt', $logData, FILE_APPEND);

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: ../index.php");
    exit();
}
$userID = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
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
            <h1>Shop</h1>
        </div>
        <nav>
            <ul id="nav-list">
                <li><a href="../pages/shops.php" id="shops-link">Shops</a></li>
                <li><a href="../pages/contactUs.php" id="contactUs-link">Contact us</a></li>
                <li><a href="../pages/howItWorks.php" id="howItWorks-link">How it works</a></li>
                <li><a href="../pages/aboutUs.php" id="aboutUs-link">About us</a></li>
                <li><a href="../pages/cart.php" id="cart-link">Cart</a></li>
                <li><a href="../pages/account.php" id="account-link">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="shops-section">
            <h2>Shop</h2>
            <div class="shop-list" id="shop-list">
                <?php
                $sql = "SELECT shopID, shopName, shopLocation, shopProduct, shopPrice, shopImagePath FROM shops";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $shopID = $row['shopID'];
                        $shopName = htmlspecialchars($row['shopName']);
                        $shopLocation = htmlspecialchars($row['shopLocation']);
                        $shopProduct = htmlspecialchars($row['shopProduct']);
                        $shopPrice = htmlspecialchars($row['shopPrice']);
                        $shopImagePath = htmlspecialchars($row['shopImagePath']);
                        echo "<div class='shop-item' data-shop-id='$shopID'>";
                        echo "<img src='../assets/images/$shopImagePath' alt='Shop Image'>";
                        echo "<h3>$shopProduct</h3>";
                        echo "<p>Location: $shopLocation</p>";
                        echo "<p>Farm Name: $shopName</p>";
                        echo "<p>Price: R$shopPrice per unit</p>";
                        echo "<button class='shop-button' data-shop-id='$shopID'>Add to cart</button>";
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
        const shopID = this.getAttribute('data-shop-id');
        const userID = <?php echo json_encode($userID); ?>; // Pass the userID from PHP
        const originalText = this.textContent;
        const button = this;

        fetch('../process/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ shopID: shopID, userID: userID })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                        button.textContent = 'Added';
                        setTimeout(() => {
                            button.textContent = originalText;
                        }, 1000);
                    } else {
                        console.error('Failed to add item to cart:', data.message);
                    }
            })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    });
        
    </script>
</body>
</html>
