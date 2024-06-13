<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../assets/css/aboutUsStyles.css">
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
            <h1>About us</h1>
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
        <section id="about-us">
            <h2>About Us</h2>
            <p>EcoGrow is a start-up based in Cape Town, South Africa, aiming to revolutionize the way consumers buy their food by connecting them directly with local farmers. We understand that our potential customers, the local farmers, are currently facing challenges in reaching a wider market due to the limitations of traditional supply chains. Their operations are impacted as they are often dependent on intermediaries, which can reduce their profit margins and limit their reach to consumers.</p>
            <p>On the other hand, consumers are becoming increasingly conscious of their food choices. They desire fresh, locally sourced produce but often find it difficult to access such products due to the complexities of the current food supply chain.</p>
            <p>Our proposed solution, the EcoGrow platform, aligns with this desired future state by providing a digital marketplace where consumers can directly purchase fresh produce from local farmers. This not only supports healthier eating habits and local economies but also contributes to reducing carbon emissions associated with long-distance food transportation. By bridging this gap, we aim to create a win-win situation for both farmers and consumers.</p>
            <p>Join us on our journey to promote sustainability, support local economies, and enjoy the freshest produce available.</p>
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