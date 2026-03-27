---
description: Repository Information Overview
alwaysApply: true
---

# Eva's Beauty Hub Information

## Summary
Eva's Beauty Hub is a comprehensive e-commerce platform for a beauty store based in Nakawa, Kampala, Uganda. It provides women in Uganda with access to premium beauty products and professional services. The platform features a responsive frontend, a PHP-powered backend with MySQL database integration, and specialized payment options tailored for the Ugandan market, including M-Pesa STK Push.

## Structure
- `index.html`: Main frontend entry point with sections for home, categories, products, services, about, contact, shopping cart, and order tracking.
- `style.css`: Custom CSS providing responsive design and light/dark theme support.
- `api/`: Backend PHP scripts for order creation and payment processing.
- `mpesa-*.php`: Integration scripts for Safaricom Daraja API (STK Push).
- `images/`: Product and UI-related static assets.
- `database.sql`: MySQL database schema for orders, order items, and products.
- `firebase.json`: Configuration for Firebase Hosting deployment.
- `PROJECT_SYNOPSIS.md`: Detailed project overview and implementation details.

## Language & Runtime
**Language**: HTML5, CSS3, JavaScript (Vanilla), PHP  
**Version**: PHP 7.0+  
**Database**: MySQL  
**Runtime**: Web Browser (Frontend), PHP (Backend)  
**Hosting**: Firebase Hosting

## Dependencies
**Frontend**:
- Google Fonts (Playfair Display, Inter)
- Font Awesome (v6.4.0)

**Backend**:
- Safaricom Daraja API (M-Pesa Integration)
- IntaSend (M-Pesa Integration)

## Build & Installation
### Installation
1. Clone the repository to a local server (e.g., XAMPP/WAMP `htdocs` folder).
2. Import `database.sql` into a MySQL server named `evas_beauty_hub`.
3. Configure database credentials in `db-config.php`.
4. Configure M-Pesa API credentials in `mpesa-config.php`.
5. Access the application via `http://localhost/evas-beauty-hub/`.

### Deployment
The project is configured for Firebase Hosting.
```bash
firebase deploy
```

## Payment Options
- **M-Pesa (STK Push)**: Automated mobile money payment via Safaricom Daraja API or IntaSend.
- **Mobile Money**: Manual transfer instructions.
- **WhatsApp Order**: Direct redirection to WhatsApp for personalized ordering.

## Main Files & Resources
**Entry Point**: `index.html`  
**Configuration**:
- `db-config.php`: Database connection settings.
- `mpesa-config.php`: Safaricom Daraja API credentials and environment settings.
- `firebase.json`: Hosting and project metadata.

## Testing
**Framework**: Manual testing via browser console and dedicated test page.
**Test Location**: Root directory.
**Naming Convention**: `*-tester.html`
**Configuration**: `mpesa-config.php` (Sandbox vs Production)

**Run Command**:
1. Open `mpesa-tester.html` in a browser to test M-Pesa API endpoints (initiate, validate, query).
2. Use the "Place New Order" modal on the main page to test the end-to-end shopping flow.
