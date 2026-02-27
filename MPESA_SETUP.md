# Eva's Beauty Hub - M-Pesa Integration Guide

## Overview
This guide explains how to set up and configure M-Pesa (Daraja API) integration for Eva's Beauty Hub. This allows customers to pay for orders directly using M-Pesa.

## Files Added

1. **mpesa-payment.php** - Main API handler for M-Pesa transactions
2. **mpesa-callback.php** - Callback handler for M-Pesa payment responses
3. **mpesa-config.php** - Configuration file (you need to fill in your credentials)
4. **Updated index.html** - Added M-Pesa payment method to order form

## Prerequisites

- PHP 7.0+ with cURL enabled
- Active M-Pesa merchant account with Safaricom Uganda
- SSL certificate (HTTPS) for production environment
- Daraja API credentials from Safaricom

## Step 1: Get Your Daraja API Credentials

### For Sandbox (Testing):
1. Visit https://developer.safaricom.co.ke/
2. Create a free account
3. Log in to the developer portal
4. Navigate to the **Projects** section
5. Create a new project or select an existing one
6. Copy your **Consumer Key** and **Consumer Secret**
7. You'll get a default Business Short Code (e.g., 174379)
8. Generate a **Passkey** for STK Push testing

### For Production (Live):
1. Register your business with Safaricom
2. Complete the verification process
3. Get your actual Business Short Code
4. Generate your production Passkey
5. Ensure your callback URL is publicly accessible

## Step 2: Configure M-Pesa Credentials

Edit **mpesa-config.php** and fill in your credentials:

```php
// Your Daraja API Consumer Key
define('MPESA_CONSUMER_KEY', 'YOUR_CONSUMER_KEY_HERE');

// Your Daraja API Consumer Secret
define('MPESA_CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET_HERE');

// Your Business Short Code (e.g., 174379)
define('MPESA_SHORTCODE', '174379');

// Your Online Checkout Passkey
define('MPESA_PASSKEY', 'YOUR_PASSKEY_HERE');

// Party A - Your M-Pesa Shop Number
define('MPESA_PARTY_A', 'YOUR_M_PESA_NUMBER_HERE');

// Set to 'production' for live or 'sandbox' for testing
define('MPESA_ENVIRONMENT', 'sandbox');
```

**Important**: 
- Keep your credentials **secret** and never commit them to public repositories
- Use **sandbox** for testing before going live
- For production, change to **'production'** after verification

## Step 3: Configure Your Callback URL

The callback URL must be publicly accessible. By default, it's set to:
```
https://your-domain.com/evas-beauty-hub/mpesa-callback.php
```

For local testing:
- Use a tunneling service like **ngrok**, **localtunnel**, or **expose**
- Or configure a temporary public domain pointing to your local IP

Example with ngrok:
```bash
ngrok http 80
# Use the generated URL: https://xxxx.ngrok.io/evas-beauty-hub/mpesa-callback.php
```

## Step 4: Enable HTTPS

M-Pesa requires HTTPS in production. For local development:
- Use self-signed certificates with ngrok
- Or generate certificates using Let's Encrypt

## How It Works

### Payment Flow:

1. **Customer selects M-Pesa** payment method in the order form
2. **Customer enters their M-Pesa registered phone number** (format: 0700000000 or +256700000000)
3. **System validates** the phone number
4. **STK Push is initiated** - customer receives a prompt on their phone
5. **Customer enters M-Pesa PIN** to authorize payment
6. **M-Pesa processes** the payment
7. **Callback is sent** to your callback URL
8. **Payment status is updated** in the system

### API Endpoints:

#### 1. Initiate Payment (STK Push)
```bash
POST /evas-beauty-hub/mpesa-payment.php?action=initiate
Content-Type: application/json

{
  "amount": 50000,
  "phoneNumber": "0700000000",
  "orderId": "EVA-12345"
}

Response:
{
  "success": true,
  "message": "STK push sent. Please enter your M-Pesa PIN on your phone.",
  "checkoutRequestID": "...",
  "data": {...}
}
```

#### 2. Query Payment Status
```bash
POST /evas-beauty-hub/mpesa-payment.php?action=query
Content-Type: application/json

{
  "checkoutRequestID": "..."
}
```

#### 3. Validate Phone Number
```bash
POST /evas-beauty-hub/mpesa-payment.php?action=validate
Content-Type: application/json

{
  "phoneNumber": "0700000000"
}
```

## Testing

### Test Credentials (Sandbox):

- **Phone Number**: Use 254708374149 for testing
- **Amount**: Any amount, e.g., 1 UGX to 1,000,000 UGX
- **Test PIN**: 123456

### Supported Test Scenarios:

1. **Successful Payment**: Use any amount
2. **Insufficient Funds**: Use amount > balance
3. **Wrong PIN**: Use wrong PIN multiple times
4. **Timeout**: Don't enter PIN within 10 seconds

### Payment Records:

All transactions are logged in:
- **payments.json** - Payment records
- **logs/mpesa-debug.log** - Debug information

## Troubleshooting

### Common Issues and Solutions:

| Issue | Solution |
|-------|----------|
| "Failed to authenticate with M-Pesa API" | Check Consumer Key and Consumer Secret |
| "Invalid phone number" | Use format: 0700000000 or +256700000000 |
| "Callback not received" | Ensure callback URL is publicly accessible |
| "STK push not received" | Check if phone is M-Pesa enabled |
| "ResultCode: 1032" | Phone number doesn't exist or wrong format |

### Enable Debug Logging:

In **mpesa-config.php**, set:
```php
define('MPESA_DEBUG', true);
```

Then check **logs/mpesa-debug.log** for detailed error messages.

## Security Considerations

1. **HTTPS Only**: Always use HTTPS in production
2. **Validate Callbacks**: Verify callback signatures from M-Pesa
3. **Secure Credentials**: Never hardcode credentials in version control
4. **Rate Limiting**: Implement rate limiting on payment endpoints
5. **Input Validation**: Validate all user inputs before processing
6. **Logging**: Monitor logs for suspicious activity

## Production Deployment Checklist

- [ ] Use production M-Pesa credentials
- [ ] Set `MPESA_ENVIRONMENT` to 'production'
- [ ] Ensure HTTPS is enabled
- [ ] Configure production callback URL
- [ ] Test full payment flow
- [ ] Monitor payment logs
- [ ] Set up email alerts for payment failures
- [ ] Implement payment verification on server
- [ ] Test with real M-Pesa account

## Support & Documentation

- **Safaricom Daraja API**: https://developer.safaricom.co.ke/
- **M-Pesa API Documentation**: https://developer.safaricom.co.ke/docs
- **Contact Safaricom Support**: https://www.safaricom.co.ke/business/corporate-services

## Payment Methods Available

Eva's Beauty Hub now supports:
1. **M-Pesa** - Automated STK Push payment (NEW)
2. **Mobile Money** - Manual payment instructions
3. **WhatsApp** - Order via WhatsApp

## Next Steps

1. Fill in your credentials in `mpesa-config.php`
2. Test with sandbox credentials
3. Verify callback is working
4. Deploy to production
5. Switch to production credentials

---

**Questions?** Contact Eva's Beauty Hub:
- Email: atwiineevalyne@gmail.com
- WhatsApp: +256 752 546 261
- Phone: +256 752 546 261
