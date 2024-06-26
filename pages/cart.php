<?php
session_start();
include '../includes/db.php';
//setcookie('site_session', session_id(), 0, "/");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $shopID = $input['shopID'];
    
    $quantity = 1;
    $userID = $_SESSION['user_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $_SESSION['cart'][] = ['userID' => $userID, 'shopID' => $shopID, 'quantity' => $quantity];

    echo json_encode(['success' => true]);
    exit;
}
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
                <li><a href="../pages/contactUs.php" id="contactUs-link">Contact us</a></li>
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
                $totalPrice = 0;
                if (isset($_SESSION['user_id'])) {
                    $userID = $_SESSION['user_id'];
                    $sql = "SELECT c.shopID, c.quantity, s.shopName, s.shopLocation, s.shopProduct, s.shopPrice, s.shopImagePath 
                            FROM cart c
                            JOIN shops s ON c.shopID = s.shopID
                            WHERE c.userID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $shopName = htmlspecialchars($row['shopName']);
                            $shopLocation = htmlspecialchars($row['shopLocation']);
                            $shopProduct = htmlspecialchars($row['shopProduct']);
                            $shopPrice = htmlspecialchars($row['shopPrice']);
                            $shopImagePath = htmlspecialchars($row['shopImagePath']);
                            $quantity = htmlspecialchars($row['quantity']);
                            $itemTotal = $shopPrice * $quantity;
                            $totalPrice += $itemTotal;

                            echo "<div class='cart-item'>";
                            echo "<div class='image-container'>";
                            echo "<img src='../assets/images/$shopImagePath' alt='Shop Image'>";
                            echo "<button class='remove-button' data-shop-id='$row[shopID]'>Remove</button>";
                            echo "</div>";
                            echo "<div class='details'>";
                            echo "<h3>$shopName</h3>";
                            echo "<p>Location: $shopLocation</p>";
                            echo "<p>Products: $shopProduct</p>";
                            echo "<p>Price: R$shopPrice per unit</p>";
                            echo "<p>Quantity: $quantity</p>";
                            echo "<p>Total: R$itemTotal</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Your cart is empty.</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p>Your cart is empty.</p>";
                }
                ?>
            </div>
            <div class="cart-total">
                <h3>Total Price: R<?php echo $totalPrice; ?></h3>
                <button id="checkout-button">Proceed to Checkout</button>
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

        document.querySelectorAll('.remove-button').forEach(button => {
            button.addEventListener('click', function() {
                const shopID = this.getAttribute('data-shop-id');
                fetch('../process/remove_from_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ shopID: shopID })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to remove item from cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the item from the cart.');
                });
            });
        });

        document.getElementById('checkout-button').addEventListener('click', function() {
            const button = this;
            const originalText = button.textContent;
            
            fetch('../process/checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.textContent = 'Order Placed!';
                    setTimeout(() => {
                        button.textContent = originalText;
                        location.reload();
                    }, 1000);
                } else {
                    alert('Failed to place order');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while placing the order.');
            });
        });
    </script>
</body>
</html>
<?php
$conn->close();
?>
