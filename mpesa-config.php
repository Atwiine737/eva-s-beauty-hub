<?php
/**
 * Eva's Beauty Hub - M-Pesa Configuration
 * Using IntaSend for Uganda M-Pesa support
 */

// ============================================
// INTASEND CONFIGURATION (Works for Uganda)
// ============================================

// Get your keys from: https://intasend.com/
define('INTASEND_PUBLISHABLE_KEY', 'INSERT_INTASEND_PUBLISHABLE_KEY');

define('INTASEND_SECRET_KEY', 'INSERT_INTASEND_SECRET_KEY');

// Set to 'live' for production, 'test' for testing
define('INTASEND_ENVIRONMENT', 'live');

// Business phone number for payments
define('BUSINESS_PHONE', '0752546261');

// ============================================
// BACKWARD COMPATIBILITY (Kenya Daraja - optional)
// ============================================

define('MPESA_CONSUMER_KEY', 'YOUR_CONSUMER_KEY_HERE');
define('MPESA_CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET_HERE');
define('MPESA_SHORTCODE', '174379');
define('MPESA_PASSKEY', 'YOUR_PASSKEY_HERE');
define('MPESA_PARTY_A', '0752546261');
define('MPESA_ENVIRONMENT', 'sandbox');

if (defined('MPESA_ENVIRONMENT') && MPESA_ENVIRONMENT === 'production') {
    define('MPESA_BASE_URL', 'https://api.safaricom.co.ke');
} else {
    define('MPESA_BASE_URL', 'https://sandbox.safaricom.co.ke');
}

define('MPESA_CALLBACK_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/evas-beauty-hub/mpesa-callback.php');
define('MPESA_DEBUG', true);
define('MPESA_LOG_FILE', __DIR__ . '/logs/mpesa-debug.log');

if (MPESA_DEBUG && !is_dir(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0755, true);
}
?>
