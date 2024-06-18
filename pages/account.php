<?php
session_start();

include '../includes/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$success = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($surname) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET name = ?, surname = ?, email = ?, password = ? WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $surname, $email, $hashed_password, $user_id);

        if ($stmt->execute()) {
            $success = "Account information updated successfully.";
            // Update session data
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = $email;
        } else {
            $error = "Error updating record: " . $conn->error;
        }

        $stmt->close();
    }
}

// Fetch user data
$sql = "SELECT name, surname, email FROM users WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="../assets/css/accountStyle.css">
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
            <h1>Account information</h1>
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
        <section id="account-section">
            <h2>Account Information</h2>

            <?php
            if (!empty($success)) {
                echo "<p style='color: green;'>$success</p>";
            }
            if (!empty($error)) {
                echo "<p style='color: red;'>$error</p>";
            }
            ?>

            <form action="account.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user['surname']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="form-button">Update Information</button>
            </form>

            <form action="../process/logout.php" method="post">
                <button type="submit" class="form-button">Logout</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 EcoGrow</p>
    </footer>

    <script>
        
    </script>
</body>
</html>
