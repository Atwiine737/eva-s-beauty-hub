<?php
/**
 * Eva's Beauty Hub - M-Pesa Configuration
 * Using IntaSend for Uganda M-Pesa support
 */

// ============================================
// INTASEND CONFIGURATION (Works for Uganda)
// ============================================

// GET YOUR KEYS FROM: https://intasend.com/
// Sign up for free, go to Settings > API Keys
define('INTASEND_PUBLISHABLE_KEY', 'ISPubKey_TEST_xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
define('INTASEND_SECRET_KEY', 'ISSecretKey_TEST_xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');

// Set to 'live' for production, 'test' for testing
define('INTASEND_ENVIRONMENT', 'test');

// Business phone number for payments
define('BUSINESS_PHONE', '0752546261');
?>
