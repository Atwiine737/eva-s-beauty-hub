<?php
/**
 * Eva's Beauty Hub - IntaSend M-Pesa Payment API
 * This handles STK Push payments for Uganda
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once 'mpesa-config.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

$action = $_GET['action'] ?? 'initiate';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    switch ($action) {
        case 'initiate':
            // Initiate STK Push
            $amount = intval($input['amount'] ?? 0);
            $phone = $input['phone'] ?? '';
            $email = $input['email'] ?? '';
            $name = $input['name'] ?? '';
            $orderId = $input['orderId'] ?? 'EVA-' . time();
            
            if ($amount <= 0 || empty($phone)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid amount or phone number'
                ]);
                exit;
            }
            
            // Clean phone number
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (substr($phone, 0, 1) == '0') {
                $phone = '256' . substr($phone, 1);
            }
            
            // IntaSend API endpoint
            $url = INTASEND_ENVIRONMENT === 'live' 
                ? 'https://api.intasend.com/payment/stk-push/'
                : 'https://sandbox.intasend.com/payment/stk-push/';
            
            $payload = [
                'publishable_key' => INTASEND_PUBLISHABLE_KEY,
                'phone_number' => $phone,
                'amount' => $amount,
                'currency' => 'UGX',
                'api_secret' => INTASEND_SECRET_KEY,
                'country' => 'UGA',
                'customer' => [
                    'email' => $email,
                    'name' => $name,
                    'phone_number' => $phone
                ],
                'metadata' => [
                    'order_id' => $orderId,
                    'invoice_id' => $orderId
                ]
            ];
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . INTASEND_SECRET_KEY
            ]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
            
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            
            $result = json_decode($response, true);
            
            if ($httpCode == 200 || $httpCode == 201) {
                echo json_encode([
                    'success' => true,
                    'message' => 'STK push sent. Check your phone.',
                    'data' => $result
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => $result['message'] ?? 'Payment failed',
                    'data' => $result
                ]);
            }
            break;
            
        case 'status':
            // Check payment status
            $invoiceId = $input['invoice_id'] ?? '';
            
            if (empty($invoiceId)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Invoice ID required'
                ]);
                exit;
            }
            
            $url = INTASEND_ENVIRONMENT === 'live'
                ? 'https://api.intasend.com/payment/status/' . $invoiceId
                : 'https://sandbox.intasend.com/payment/status/' . $invoiceId;
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . INTASEND_SECRET_KEY
            ]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            
            $result = json_decode($response, true);
            
            echo json_encode([
                'success' => $httpCode == 200,
                'data' => $result
            ]);
            break;
            
        default:
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Unknown action'
            ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
}
?>
