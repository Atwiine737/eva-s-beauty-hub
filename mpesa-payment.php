<?php
/**
 * Eva's Beauty Hub - M-Pesa Daraja API Integration
 * This file handles M-Pesa payments using Safaricom's Daraja API
 */

// Allow cross-origin requests (CORS)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include M-Pesa configuration
require_once 'mpesa-config.php';

class MpesaAPI {
    private $consumerKey;
    private $consumerSecret;
    private $businessShortCode;
    private $passkey;
    private $partyA;
    private $baseURL;

    public function __construct() {
        $this->consumerKey = MPESA_CONSUMER_KEY;
        $this->consumerSecret = MPESA_CONSUMER_SECRET;
        $this->businessShortCode = MPESA_SHORTCODE;
        $this->passkey = MPESA_PASSKEY;
        $this->partyA = MPESA_PARTY_A;
        $this->baseURL = MPESA_BASE_URL;
    }

    /**
     * Get access token from Daraja API
     */
    public function getAccessToken() {
        $url = $this->baseURL . '/oauth/v1/generate?grant_type=client_credentials';
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $this->consumerKey . ':' . $this->consumerSecret);
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ($httpCode != 200) {
            error_log("M-Pesa Token Error: " . $response);
            return false;
        }

        $result = json_decode($response);
        curl_close($curl);
        
        return $result->access_token ?? false;
    }

    /**
     * Initiate STK Push for customer to enter M-Pesa PIN
     */
    public function initiateSTKPush($amount, $phoneNumber, $orderId) {
        // Clean phone number (remove + and leading 0, ensure starts with 254)
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        if (substr($phoneNumber, 0, 1) == '0') {
            $phoneNumber = '256' . substr($phoneNumber, 1);
        }
        if (substr($phoneNumber, 0, 3) != '256') {
            $phoneNumber = '256' . $phoneNumber;
        }

        // Get access token
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return [
                'success' => false,
                'message' => 'Failed to authenticate with M-Pesa API'
            ];
        }

        // Generate timestamp and password
        $timestamp = date('YmdHis');
        $password = base64_encode($this->businessShortCode . $this->passkey . $timestamp);

        // Prepare the request
        $url = $this->baseURL . '/mpesa/stkpush/v1/processrequest';
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization:Bearer ' . $accessToken
        ));

        $payload = array(
            'BusinessShortCode' => $this->businessShortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPaymentRequest',
            'Amount' => round($amount), // Must be whole number
            'PartyA' => $phoneNumber,
            'PartyB' => $this->businessShortCode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => 'https://' . $_SERVER['HTTP_HOST'] . '/evas-beauty-hub/mpesa-callback.php',
            'AccountReference' => $orderId,
            'TransactionDesc' => 'Eva Beauty Hub Order - ' . $orderId
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Log the response
        error_log("M-Pesa STK Response (" . $httpCode . "): " . $response);

        $result = json_decode($response, true);

        if ($httpCode == 200 && isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
            return [
                'success' => true,
                'message' => 'STK push sent. Please enter your M-Pesa PIN on your phone.',
                'checkoutRequestID' => $result['CheckoutRequestID'] ?? null,
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => $result['ResponseDescription'] ?? 'Failed to initiate payment',
                'data' => $result
            ];
        }
    }

    /**
     * Query payment status
     */
    public function queryPaymentStatus($checkoutRequestID) {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return [
                'success' => false,
                'message' => 'Failed to authenticate with M-Pesa API'
            ];
        }

        $timestamp = date('YmdHis');
        $password = base64_encode($this->businessShortCode . $this->passkey . $timestamp);

        $url = $this->baseURL . '/mpesa/stkpushquery/v1/query';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization:Bearer ' . $accessToken
        ));

        $payload = array(
            'BusinessShortCode' => $this->businessShortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'CheckoutRequestID' => $checkoutRequestID
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $result = json_decode($response, true);

        return [
            'success' => $httpCode == 200,
            'data' => $result
        ];
    }
}

// Handle different requests
$request = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'initiate';

if ($request === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $mpesa = new MpesaAPI();

    switch ($action) {
        case 'initiate':
            // Initiate STK Push
            $amount = $input['amount'] ?? 0;
            $phoneNumber = $input['phoneNumber'] ?? '';
            $orderId = $input['orderId'] ?? 'EVA-ORDER-' . time();

            if ($amount <= 0 || empty($phoneNumber)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid amount or phone number'
                ]);
                exit;
            }

            $result = $mpesa->initiateSTKPush($amount, $phoneNumber, $orderId);
            
            // Save payment record to file for demo purposes
            $paymentRecord = [
                'orderId' => $orderId,
                'phoneNumber' => $phoneNumber,
                'amount' => $amount,
                'timestamp' => date('Y-m-d H:i:s'),
                'status' => 'pending',
                'checkoutRequestID' => $result['checkoutRequestID'] ?? null
            ];
            
            $paymentsFile = __DIR__ . '/payments.json';
            $payments = file_exists($paymentsFile) ? json_decode(file_get_contents($paymentsFile), true) : [];
            $payments[] = $paymentRecord;
            file_put_contents($paymentsFile, json_encode($payments, JSON_PRETTY_PRINT));

            echo json_encode($result);
            break;

        case 'query':
            // Query payment status
            $checkoutRequestID = $input['checkoutRequestID'] ?? '';
            
            if (empty($checkoutRequestID)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Checkout Request ID is required'
                ]);
                exit;
            }

            $result = $mpesa->queryPaymentStatus($checkoutRequestID);
            echo json_encode($result);
            break;

        case 'validate':
            // Validate phone number format
            $phoneNumber = $input['phoneNumber'] ?? '';
            $isValid = preg_match('/^(\+256|0256|256)?[0-9]{9}$/', preg_replace('/[^0-9]/', '', $phoneNumber));
            
            echo json_encode([
                'success' => $isValid === 1,
                'message' => $isValid === 1 ? 'Valid phone number' : 'Invalid Ugandan phone number'
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
