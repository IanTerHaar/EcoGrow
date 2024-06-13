<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How it works</title>
    <link rel="stylesheet" href="../assets/css/howItWorksStyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon_resized.png">
</head>
<body>
    <header>
    <div class="title-logo-container">
            <div class="logo-container">
                <a href="../pages/dashboard.php"> <!-- Added anchor tag -->
                    <img src="../assets/images/ecogrow logo.png" alt="logo">
                </a>
            </div>
            <h1>How it works</h1>
        </div>
        <nav>
            <ul id="nav-list">
                <li><a href="#" id="shops-link">Shops</a></li>
                <li><a href="#" id="orderHistory-Link">Order History</a></li>
                <li><a href="#" id="howItWorks-link">How it works</a></li>
                <li><a href="#" id="aboutUs-link">About us</a></li>
                <li><a href="#" id="cart-link">Cart</a></li>
                <li><a href="#" id="account-link">Account</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="howItWorks">
            <h2>How It Works</h2>
            <p>Welcome to EcoGrow! Here’s how our platform works:</p>
            <h3>1. Sign Up</h3>
            <p>Create an account by providing your basic information. Farmers and consumers can both join our platform to buy and sell fresh produce.</p>
            <h3>2. Set Up Your Profile</h3>
            <p>Complete your profile with relevant details. Farmers can add their available produce, while consumers can set their preferences for buying.</p>
            <h3>3. Browse and Purchase</h3>
            <p>Consumers can browse through the list of available produce and make purchases. Farmers can manage their orders and inventory from their dashboard.</p>
            <h3>4. Delivery</h3>
            <p>Once an order is placed, farmers will prepare the produce for delivery. We ensure that all deliveries are made in a timely and efficient manner. The option for pick up is also available.</p>
            <h3>5. Feedback</h3>
            <p>After receiving the produce, consumers can leave feedback for the farmers. This helps in maintaining quality and trust within our community.</p>
            <p>Thank you for choosing EcoGrow! We strive to make fresh and local produce accessible to everyone while supporting our local farmers.</p>    
        </section>
    </main>
    <footer>
        <p>&copy; 2024 EcoGrow</p>
    </footer>

    <script>
        
        const shopsLink = document.getElementById('shops-link');
        if (shopsLink) {
            shopsLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = '../pages/shops.php';
            });
        }

        const orderHistoryLink = document.getElementById('orderHistory-link');
        if (orderHistoryLink) {
            orderHistoryLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = '../pages/orderHistory.php';
            });
        }

        const howItWorksLink = document.getElementById('howItWorks-link');
        if (howItWorksLink) {
            howItWorksLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = '../pages/howItWorks.php';
            });
        }

        const aboutUsLink = document.getElementById('aboutUs-link');
        if (aboutUsLink) {
            aboutUsLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = '../pages/aboutUs.php';
            });
        }

        const cartLink = document.getElementById('cart-link');
        if (cartLink) {
            cartLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = '../pages/cart.php';
            });
        }

        const accountLink = document.getElementById('account-link');
        if (accountLink) {
            accountLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = '../pages/account.php';
            });
        }

        window.addEventListener('beforeunload', function () {
        navigator.sendBeacon('../process/logout.php');
    });

    </script>
</body>
</html>