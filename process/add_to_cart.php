<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$userID = $data['userID'];
$shopID = $data['shopID'];
$quantity = 1;

// Check if the item already exists in the cart
$sql = "SELECT quantity FROM cart WHERE userID = ? AND shopID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userID, $shopID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Item exists in the cart, update the quantity
    $row = $result->fetch_assoc();
    $newQuantity = $row['quantity'] + $quantity;

    $updateSql = "UPDATE cart SET quantity = ? WHERE userID = ? AND shopID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iii", $newQuantity, $userID, $shopID);

    if ($updateStmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cart updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cart.']);
    }

    $updateStmt->close();
} else {
    // Item does not exist in the cart, insert new entry
    $insertSql = "INSERT INTO cart (userID, shopID, quantity) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iii", $userID, $shopID, $quantity);

    if ($insertStmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item added to cart successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add item to cart.']);
    }

    $insertStmt->close();
}

$stmt->close();
$conn->close();
?>
