<?php
/**
 * Eva's Beauty Hub - M-Pesa (Daraja API) Configuration
 * 
 * To get your credentials:
 * 1. Go to https://developer.safaricom.co.ke/
 * 2. Create an account and register your application
 * 3. Fill in the credentials below
 */

// ============================================
// M-PESA DARAJA API CREDENTIALS
// ============================================

// Your Daraja API Consumer Key
define('MPESA_CONSUMER_KEY', 'YOUR_CONSUMER_KEY_HERE');

// Your Daraja API Consumer Secret
define('MPESA_CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET_HERE');

// Your Business Short Code (e.g., 174379)
define('MPESA_SHORTCODE', '174379');

// Your Online Checkout Passkey
define('MPESA_PASSKEY', 'YOUR_PASSKEY_HERE');

// Party A - Your Shop Phone Number (without + or country code prefix)
define('MPESA_PARTY_A', 'YOUR_M_PESA_NUMBER_HERE');

// ============================================
// API ENVIRONMENT SETTINGS
// ============================================

// Set to 'production' for live M-Pesa or 'sandbox' for testing
define('MPESA_ENVIRONMENT', 'sandbox');

// Base URL for M-Pesa API
if (defined('MPESA_ENVIRONMENT') && MPESA_ENVIRONMENT === 'production') {
    define('MPESA_BASE_URL', 'https://api.safaricom.co.ke');
} else {
    define('MPESA_BASE_URL', 'https://sandbox.safaricom.co.ke');
}

// ============================================
// CALLBACK SETTINGS
// ============================================

// Your callback URL (make sure this is publicly accessible)
define('MPESA_CALLBACK_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/evas-beauty-hub/mpesa-callback.php');

// ============================================
// LOGGING SETTINGS
// ============================================

// Enable/disable error logging
define('MPESA_DEBUG', true);

// Log file path
define('MPESA_LOG_FILE', __DIR__ . '/logs/mpesa-debug.log');

// Create logs directory if it doesn't exist
if (MPESA_DEBUG && !is_dir(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0755, true);
}
?>
