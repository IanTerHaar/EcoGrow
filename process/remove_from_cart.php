<?php
session_start();

include '../includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['shopID']) && isset($_SESSION['user_id'])) {
        $shopID = $input['shopID'];
        $userID = $_SESSION['user_id'];

        // Check connection
        if ($conn->connect_error) {
            echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
            exit;
        }

        $sql = "DELETE FROM cart WHERE shopID = ? AND userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $shopID, $userID);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove item from cart']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
