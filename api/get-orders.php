<?php
header('Content-Type: application/json');
require_once '../db-config.php';

// Handle GET request
$orderId = $_GET['order_id'] ?? null;
$customerPhone = $_GET['customer_phone'] ?? null;

$query = "SELECT o.*, oi.product_name, oi.product_price, oi.quantity 
          FROM orders o 
          JOIN order_items oi ON o.order_id = oi.order_id";

if ($orderId) {
    $query .= " WHERE o.order_id = '" . $conn->real_escape_string($orderId) . "'";
} elseif ($customerPhone) {
    $query .= " WHERE o.customer_phone = '" . $conn->real_escape_string($customerPhone) . "'";
}

$query .= " ORDER BY o.created_at DESC";

$result = $conn->query($query);

if (!$result) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error fetching orders: ' . $conn->error]);
    exit;
}

$orders = [];
while ($row = $result->fetch_assoc()) {
    $id = $row['order_id'];
    
    if (!isset($orders[$id])) {
        $orders[$id] = [
            'orderId' => $row['order_id'],
            'customerName' => $row['customer_name'],
            'customerEmail' => $row['customer_email'],
            'customerPhone' => $row['customer_phone'],
            'address' => $row['delivery_address'],
            'paymentMethod' => $row['payment_method'],
            'totalAmount' => floatval($row['total_amount']),
            'status' => $row['status'],
            'notes' => $row['notes'],
            'createdTime' => strtotime($row['created_at']) * 1000, // JavaScript milliseconds
            'items' => []
        ];
    }
    
    $orders[$id]['items'][] = [
        'name' => $row['product_name'],
        'price' => floatval($row['product_price']),
        'quantity' => intval($row['quantity'])
    ];
}

echo json_encode(['success' => true, 'orders' => array_values($orders)]);

$conn->close();
?>
