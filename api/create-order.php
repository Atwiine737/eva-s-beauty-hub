<?php
header('Content-Type: application/json');
require_once '../db-config.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Basic validation
if (empty($input['customerName']) || empty($input['customerPhone']) || empty($input['items'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$orderId = $input['orderId'] ?? 'ORD-' . time();
$customerName = $conn->real_escape_string($input['customerName']);
$customerEmail = $conn->real_escape_string($input['customerEmail'] ?? '');
$customerPhone = $conn->real_escape_string($input['customerPhone']);
$deliveryAddress = $conn->real_escape_string($input['address'] ?? '');
$paymentMethod = $conn->real_escape_string($input['paymentMethod'] ?? '');
$totalAmount = floatval($input['totalAmount'] ?? 0);
$status = $conn->real_escape_string($input['status'] ?? 'Pending');
$notes = $conn->real_escape_string($input['notes'] ?? '');

// Start transaction
$conn->begin_transaction();

try {
    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, customer_email, customer_phone, delivery_address, payment_method, total_amount, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss dss", $orderId, $customerName, $customerEmail, $customerPhone, $deliveryAddress, $paymentMethod, $totalAmount, $status, $notes);
    
    if (!$stmt->execute()) {
        throw new Exception("Error inserting order: " . $stmt->error);
    }

    // Insert into order_items table
    $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, product_price, quantity) VALUES (?, ?, ?, ?)");
    
    foreach ($input['items'] as $item) {
        $productName = $conn->real_escape_string($item['name']);
        $productPrice = floatval(preg_replace('/[^0-9.]/', '', $item['price']));
        $quantity = intval($item['quantity'] ?? 1);
        
        $itemStmt->bind_param("ssdi", $orderId, $productName, $productPrice, $quantity);
        if (!$itemStmt->execute()) {
            throw new Exception("Error inserting order item: " . $itemStmt->error);
        }
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Order created successfully', 'order_id' => $orderId]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
