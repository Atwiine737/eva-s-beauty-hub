<?php
/**
 * Eva's Beauty Hub - M-Pesa Callback Handler
 * This file receives callbacks from M-Pesa when payment is completed
 */

require_once 'mpesa-config.php';

// Get the callback data from M-Pesa
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Log the callback
$logMessage = "M-Pesa Callback Received (" . date('Y-m-d H:i:s') . "): \n" . 
              json_encode($data, JSON_PRETTY_PRINT) . "\n" . 
              str_repeat("=", 80) . "\n";

error_log($logMessage);

// Log to file as well
if (MPESA_DEBUG) {
    $logFile = MPESA_LOG_FILE;
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Parse the callback data
$body = $data['Body'] ?? [];
$stkCallback = $body['stkCallback'] ?? [];
$resultCode = $stkCallback['ResultCode'] ?? null;
$checkoutRequestID = $stkCallback['CheckoutRequestID'] ?? null;
$merchantRequestID = $stkCallback['MerchantRequestID'] ?? null;

// Determine payment status
$paymentStatus = 'failed';
if ($resultCode === 0) {
    $paymentStatus = 'success';
    $callbackMetadata = $stkCallback['CallbackMetadata'] ?? [];
    $itemList = $callbackMetadata['Item'] ?? [];
    
    // Extract payment details
    $amount = '';
    $transactionId = '';
    $phoneNumber = '';
    
    foreach ($itemList as $item) {
        if ($item['Name'] === 'Amount') {
            $amount = $item['Value'];
        } elseif ($item['Name'] === 'MpesaReceiptNumber') {
            $transactionId = $item['Value'];
        } elseif ($item['Name'] === 'PhoneNumber') {
            $phoneNumber = $item['Value'];
        }
    }
    
    $logMessage = "✓ PAYMENT SUCCESSFUL\n";
    $logMessage .= "Amount: UGX " . $amount . "\n";
    $logMessage .= "Transaction ID: " . $transactionId . "\n";
    $logMessage .= "Phone: " . $phoneNumber . "\n";
} else {
    $resultDesc = $stkCallback['ResultDesc'] ?? 'Unknown error';
    $logMessage = "✗ PAYMENT FAILED\n";
    $logMessage .= "Result Code: " . $resultCode . "\n";
    $logMessage .= "Description: " . $resultDesc . "\n";
}

// Update payment record
$paymentsFile = __DIR__ . '/payments.json';
if (file_exists($paymentsFile)) {
    $payments = json_decode(file_get_contents($paymentsFile), true);
    
    // Find and update the payment record
    foreach ($payments as &$payment) {
        if ($payment['checkoutRequestID'] === $checkoutRequestID) {
            $payment['status'] = $paymentStatus;
            $payment['resultCode'] = $resultCode;
            $payment['callback_time'] = date('Y-m-d H:i:s');
            if ($paymentStatus === 'success') {
                $payment['transactionId'] = $transactionId ?? '';
                $payment['amount_paid'] = $amount ?? '';
            }
            break;
        }
    }
    
    file_put_contents($paymentsFile, json_encode($payments, JSON_PRETTY_PRINT));
}

// Return success response to M-Pesa
$response = [
    'ResultCode' => 0,
    'ResultDesc' => 'Accepted'
];

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response);
?>
