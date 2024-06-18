<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
include 'includes/db.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();

            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['email'] = $user['email'];
            
            header("Location: pages/dashboard.php");
            exit;
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
}

ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/loginStyles.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon_resized.png">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form" method="POST" action="index.php">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>

        </form>
        <?php if (!empty($error_message)): ?>
            <p id="error-message" class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <p class="signup-message">Don't yet have an account? <a href="pages/signup.php">Sign up here</a></p>
    </div>
</body>
</html>
