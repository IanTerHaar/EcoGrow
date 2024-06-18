<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/db.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already used
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "This email is already registered. Please use a different email.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $surname, $email, $hashed_password);

          if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/signupStyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon_resized.png">
</head>
<body>
    <div class="container">
        <div class="signup-box">
            <h2>Sign Up</h2>
            <?php
            if (!empty($error_message)) {
                echo '<p class="error-message">' . htmlspecialchars($error_message) . '</p>';
            }
            if (!empty($success_message)) {
                echo '<p class="success-message">' . htmlspecialchars($success_message) . '</p>';
            }
            ?>
            <form id="signup-form" method="POST" action="signup.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
    <script src="/script.js"></script>
</body>
</html>
