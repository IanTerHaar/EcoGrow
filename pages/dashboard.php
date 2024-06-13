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
                <li><a href="#" id="orderHistory-link">Order History</a></li>
                <li><a href="#" id="howItWorks-link">How it works</a></li>
                <li><a href="#" id="aboutUs-link">About us</a></li>
                <li><a href="#" id="cart-link">Cart</a></li>
                <li><a href="#" id="account-link">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <section id = ourMission>
            <h2>Our Mission</h2>
            <p>At EcoGrow, we aim to revolutionize the way consumers buy their food by connecting them 
            directly with local farmers. Our mission is to support healthier eating habits, promote sustainability, and 
            boost local economies.</p>
        </section>

        <section id="benefits">
            <h2>Benefits</h2>
            <h3>For Farmers:</h3>
            <ul>
                <li>Direct access to a broader market</li>
                <li>Increased profit margins by reducing intermediaries</li>
                <li>Better control over pricing and inventory</li>
            </ul>
            <h3>For Consumers</h3>
            <ul>
                <li>Access to fresh, locally sourced produce</li>
                <li>Support for local economies</li>
                <li>Reduced carbon footprint from shorter supply chains</li>
            </ul>

        </section>

        <section id="latest-orders">
            <h2>Reach us</h2>
            <p>Message us: 084 985 0541</p>
            <p>Email us: ecogrowsupport@gmail.com</p>
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
