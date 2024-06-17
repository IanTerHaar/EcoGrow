<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['shopID'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    $shopID = intval($input['shopID']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $item_found = false;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['shopID'] == $shopID) {
            $item['quantity'] += 1;
            $item_found = true;
            break;
        }
    }

    if (!$item_found) {
        $_SESSION['cart'][] = ['shopID' => $shopID, 'quantity' => 1];
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
