<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecogrow Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboardStyles.css">
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
            <h1>Dashboard</h1>
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
        <section id="statistics">
            <h2>Statistics</h2>
            <!-- Display statistics here -->
        </section>

        <section id="latest-orders">
            <h2>Latest Orders</h2>
            <!-- Display latest orders here -->
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
