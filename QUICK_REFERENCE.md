# M-Pesa Integration - Quick Reference

## What Was Implemented

✅ **M-Pesa STK Push Payment Integration** for Eva's Beauty Hub using Safaricom's Daraja API

### Features Added:
- ✓ M-Pesa payment method in order form
- ✓ Phone number validation (Ugandan numbers)
- ✓ STK Push initiation for payments
- ✓ Payment status tracking
- ✓ Callback handler for payment confirmation
- ✓ Order creation with M-Pesa payment
- ✓ Payment logging and debugging

## Files Created

| File | Purpose |
|------|---------|
| `mpesa-payment.php` | Main M-Pesa API handler (STK Push, validation, query) |
| `mpesa-callback.php` | Receives payment confirmations from M-Pesa |
| `mpesa-config.php` | Configuration file (add your credentials here) |
| `mpesa-tester.html` | Test console for M-Pesa API endpoints |
| `MPESA_SETUP.md` | Complete setup documentation |
| `QUICK_REFERENCE.md` | This file |

## Quick Setup (5 Minutes)

### 1. Get API Credentials
```
Visit: https://developer.safaricom.co.ke/
Create account → Create app → Copy:
- Consumer Key
- Consumer Secret
- Business Short Code
- Passkey
```

### 2. Fill Configuration
Edit `mpesa-config.php`:
```php
define('MPESA_CONSUMER_KEY', 'YOUR_KEY');
define('MPESA_CONSUMER_SECRET', 'YOUR_SECRET');
define('MPESA_SHORTCODE', '174379');
define('MPESA_PASSKEY', 'YOUR_PASSKEY');
define('MPESA_PARTY_A', '0700000000');
define('MPESA_ENVIRONMENT', 'sandbox'); // or 'production'
```

### 3. Test It
1. Open `mpesa-tester.html` in browser
2. Test validation with: `0708374149`
3. Test STK Push with amount: `50000`
4. Check response

### 4. Use It
- Go to Orders → Place New Order
- Select "M-Pesa (Daraja API)"
- Enter phone number
- Complete order
- STK prompt appears on phone

## API Endpoints

### Initiate Payment (STK Push)
```bash
POST /evas-beauty-hub/mpesa-payment.php?action=initiate
{
  "amount": 50000,
  "phoneNumber": "0700000000",
  "orderId": "EVA-12345"
}
```

### Validate Phone Number
```bash
POST /evas-beauty-hub/mpesa-payment.php?action=validate
{
  "phoneNumber": "0700000000"
}
```

### Query Payment Status
```bash
POST /evas-beauty-hub/mpesa-payment.php?action=query
{
  "checkoutRequestID": "..."
}
```

## Phone Number Formats Supported

All these work:
- `0700000000` (Local format)
- `+256700000000` (International with +)
- `256700000000` (International without +)

## Testing

### Test Account Details (Sandbox)
- **Phone**: 254708374149 (or any variant)
- **Amount**: 1 - 1,000,000 UGX
- **PIN**: 123456

### Test Scenarios
1. ✓ **Success**: Use any valid amount
2. ✗ **Insufficient Funds**: Amount > balance
3. ✗ **Wrong PIN**: Incorrect PIN
4. ⏱ **Timeout**: Don't enter PIN within 10 seconds

## Important URLs

- Main Site: `http://localhost/evas-beauty-hub/`
- Tester: `http://localhost/evas-beauty-hub/mpesa-tester.html`
- Place Order: Scroll to "Your Orders" → "Place New Order"
- View Logs: `logs/mpesa-debug.log`
- Payment Records: `payments.json`

## Troubleshooting

| Error | Fix |
|-------|-----|
| "Failed to authenticate" | Check Consumer Key/Secret |
| "Invalid phone" | Use format: 0700000000 |
| "STK not received" | Check callback URL is public |
| No response | Enable CORS in API response |
| ResultCode 1032 | Phone doesn't exist |

## Payment Flow (How It Works)

```
1. Customer selects M-Pesa
2. Enters phone number: 0700000000
3. System validates phone
4. STK push is initiated
5. Customer's phone shows prompt
6. Customer enters PIN
7. M-Pesa processes payment
8. Callback sent to callback URL
9. Order marked as paid
```

## Going Live (Production)

1. Complete Safaricom business verification
2. Get production credentials
3. Change in `mpesa-config.php`:
   ```php
   define('MPESA_ENVIRONMENT', 'production');
   ```
4. Update credentials with production keys
5. Ensure HTTPS is enabled
6. Update callback URL to production domain
7. Test the full flow
8. Monitor payment logs

## File Locations

```
evas-beauty-hub/
├── mpesa-config.php ← UPDATE WITH YOUR CREDENTIALS
├── mpesa-payment.php ← API Handler (no changes needed)
├── mpesa-callback.php ← Callback Handler (no changes needed)
├── mpesa-tester.html ← Test Console
├── MPESA_SETUP.md ← Detailed Guide
├── QUICK_REFERENCE.md ← This File
├── index.html ← Updated with M-Pesa option
├── payments.json ← Payment records (auto-generated)
└── logs/
    └── mpesa-debug.log ← Debug logs (auto-generated)
```

## Payment Methods Now Available

1. **M-Pesa** ← NEW! Automatic STK push payment
2. **Mobile Money** - Manual payment instructions
3. **WhatsApp** - Order via WhatsApp chat

## Need Help?

1. Check `MPESA_SETUP.md` for detailed documentation
2. Review `logs/mpesa-debug.log` for errors
3. Test with `mpesa-tester.html`
4. Check Safaricom docs: https://developer.safaricom.co.ke/docs
5. Contact Safaricom support if issues persist

## Security Notes

🔒 **Important**:
- Never commit `mpesa-config.php` with real credentials
- Always use HTTPS in production
- Validate all callbacks from M-Pesa
- Monitor logs for suspicious activity
- Keep credentials secret!

## What's Next?

1. ✅ Fill credentials in `mpesa-config.php`
2. ✅ Test with sandbox credentials
3. ✅ Try full payment flow
4. ✅ Monitor logs
5. ✅ Deploy to production
6. ✅ Switch to production credentials

---

**Last Updated**: February 2026
**Safaricom Daraja API Version**: v1
**Tested With**: PHP 7.0+
