<?php
session_start();

include '../includes/db.php';

header('Content-Type: application/json');

$response = ['success' => false];

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
    }

    // Delete items from cart for the user
    $sql = "DELETE FROM cart WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Failed to clear cart';
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
