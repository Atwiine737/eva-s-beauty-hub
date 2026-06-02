const fs = require('fs');
let h = fs.readFileSync('index.html', 'utf8');

// 1. Fix filterCategory function
h = h.replace(
  'function filterCategory(category) {',
  'function filterCategory(category, el) {'
);
h = h.replace(
  "event.target.classList.add('active');",
  "(el || event.target).classList.add('active');"
);
// Update onclick handlers - pass this for all
h = h.replace(
  /onclick="filterCategory\('([^']+)'\)"/g,
  "onclick=\"filterCategory('$1',this)\""
);

// 2. Remove closeOrderModal dead code
h = h.replace(
  "if (e.target.id === 'orderModal') closeOrderModal();\n            ",
  ''
);

// 3. Remove newsletter subscribe function
h = h.replace(
  /\/\/ Newsletter[\s\S]*?function subscribeNewsletter[\s\S]*?\/\/ Filter by Category/,
  '// Filter by Category'
);

// 4. Remove newsletter section
h = h.replace(
  /<!-- Newsletter -->[\s\S]*?<div class="newsletter">[\s\S]*?<\/div>\s*<\/section>/,
  '</section>'
);

// 5. Remove email contact card
h = h.replace(
  /<div class="contact-card">[\s\S]*?<span class="contact-icon"><i class="fas fa-envelope"><\/i><\/span>\s*<h4>Email<\/h4>[\s\S]*?<\/div>/,
  ''
);

// 6. Remove shareEmail function
h = h.replace(
  /function shareEmail\(\)[\s\S]*?\/\/ Close modal on click outside/,
  '// Close modal on click outside'
);

// 7. Remove email from _confirm variables
h = h.replace(
  /let _confirmOrderId = ''([\s\S]*?)_confirmPhone = '';/,
  'let _confirmOrderId = \'\'$1_confirmPhone = \'\';'
);
h = h.replace(
  "_confirmEmail = email;\n            ",
  ''
);

// 8. Remove email from order form
h = h.replace(
  /<div class="form-group">\s*<label>Email \*<\/label>\s*<input type="email" id="orderEmail" required placeholder="your@email.com">\s*<\/div>/,
  ''
);

// 9. Update showConfirmModal call
h = h.replace(
  'showConfirmModal(orderId, total, msgBody, name, email, phone);',
  'showConfirmModal(orderId, total, msgBody, name, phone);'
);

// 10. Update showConfirmModal function signature
h = h.replace(
  'function showConfirmModal(orderId, total, msgBody, name, email, phone) {',
  'function showConfirmModal(orderId, total, msgBody, name, phone) {'
);

// 11. Remove email from customerInfo
h = h.replace(
  "const email = document.getElementById('orderEmail').value;\n            ",
  ''
);
h = h.replace(
  'const customerInfo = { name, email, phone, address };',
  'const customerInfo = { name, phone, address };'
);

// 12. Remove email from backend
h = h.replace(
  'customerEmail: email,\n                        ',
  ''
);

// 13. Remove email from autofill
h = h.replace(
  "document.getElementById('orderEmail').value = savedInfo.email || '';\n                ",
  ''
);

// 14. Remove shareEmail button
h = h.replace(
  /<button onclick="shareEmail\(\)".*?<\/button>\s*/,
  ''
);

// 15. Update confirmation modal text
h = h.replace(
  'Get your order details sent to your WhatsApp or Email.',
  'Your order is saved. Tap below to send it to us on WhatsApp so we can process it.'
);

// 16. Fix WhatsApp share
const newShareWhatsApp = `function shareWhatsApp() {
            closeConfirmModal();
            const text = encodeURIComponent("New Order from Eva's Beauty Hub:\\n\\n" + _confirmMsg);
            setTimeout(function() {
                window.location.href = "https://wa.me/256752546261?text=" + text;
            }, 300);
        }

        // Close modal on click outside`;

h = h.replace(
  /function shareWhatsApp\(\)[\s\S]*?\/\/ Close modal on click outside/,
  newShareWhatsApp
);

// 17. Fix msgBody to include phone and payment
h = h.replace(
  "const msgBody = `New Order: ${orderId}\\nName: ${name}\\nItems:\\n${itemsSummary}\\nTotal: UGX ${total.toLocaleString()}\\nAddress: ${address}`;",
  "const payLabel = payment === 'cash' ? 'Cash on Delivery' : 'Mobile Money';\n            const msgBody = `New Order: ${orderId}\\nName: ${name}\\nPhone: ${phone}\\nPayment: ${payLabel}\\nItems:\\n${itemsSummary}\\nTotal: UGX ${total.toLocaleString()}\\nAddress: ${address}`;"
);

// 18. Add back-to-top HTML
h = h.replace(
  'class="float-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>',
  'class="float-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>\n\n    <!-- Back to Top -->\n    <button onclick="window.scrollTo({top:0,behavior:\'smooth\'})" class="back-to-top" id="backToTop" title="Back to top"><i class="fas fa-chevron-up"></i></button>'
);

// 19. Add scroll to top on DOMContentLoaded
h = h.replace(
  "document.addEventListener('DOMContentLoaded', function() {\n            loadOrderHistory();\n            initCircularCarousel();",
  "document.addEventListener('DOMContentLoaded', function() {\n            loadOrderHistory();\n            initCircularCarousel();\n            window.scrollTo(0, 0);"
);

// 20. Add scroll listener for back-to-top visibility
h = h.replace(
  '</script>',
  "window.addEventListener('scroll', function() {\n            const btn = document.getElementById('backToTop');\n            if (btn) {\n                if (window.scrollY > 400) btn.classList.add('visible');\n                else btn.classList.remove('visible');\n            }\n        });\n    </script>"
);

// 21. Remove remove Google Maps link
h = h.replace(
  /<a href="https:\/\/maps\.google\.com\/\?q=Nakawa\+Kampala\+Uganda".*?<\/a>/,
  ''
);

// 22. Update payment method to dropdown
h = h.replace(
  /<div class="form-group">\s*<label><i class="fas fa-mobile-alt".*?Payment via Mobile Money<\/label>\s*<input type="hidden"[^>]*>\s*<div style="background:var\(--primary-lighter\)[^<]*<\/div>\s*<\/div>/,
  '<div class="form-group">\n                        <label>Payment Method *</label>\n                        <select id="orderPayment" required>\n                            <option value="">-- Select Payment --</option>\n                            <option value="mobilemoney">Mobile Money</option>\n                            <option value="cash">Cash on Delivery</option>\n                        </select>\n                        <div id="paymentInfo" style="display:none;margin-top:10px;background:var(--primary-lighter);padding:14px;border-radius:12px;font-weight:500;font-size:0.9rem;"></div>\n                    </div>'
);

// 23. Add payment method event listener
h = h.replace(
  "document.getElementById('checkoutForm').scrollIntoView({ behavior: 'smooth' });\n        }\n\n\n\n        // Get current location via GPS",
  "document.getElementById('checkoutForm').scrollIntoView({ behavior: 'smooth' });\n        }\n\n        // Payment method info\n        document.getElementById('orderPayment').addEventListener('change', function() {\n            const info = document.getElementById('paymentInfo');\n            if (this.value === 'mobilemoney') {\n                info.style.display = 'block';\n                info.innerHTML = '<i class=\"fas fa-mobile-alt\" style=\"color:var(--primary);\"></i> Send payment to <strong>+256 752546261</strong> (use your Order ID as reference)';\n            } else if (this.value === 'cash') {\n                info.style.display = 'block';\n                info.innerHTML = '<i class=\"fas fa-money-bill-wave\" style=\"color:var(--primary);\"></i> Pay with cash when you receive your order';\n            } else {\n                info.style.display = 'none';\n            }\n        });\n\n        // Get current location via GPS"
);

// 24. Update payment display in order tracking
h = h.replace(
  'Payment: Mobile Money</p>',
  "Payment: ${order.paymentMethod === 'cash' ? 'Cash on Delivery' : 'Mobile Money'}</p>"
);

// 25. Update payment display in order history  
h = h.replace(
  "<p><strong>Payment:</strong> Mobile Money</p>",
  "<p><strong>Payment:</strong> ${order.paymentMethod === 'cash' ? 'Cash on Delivery' : 'Mobile Money'}</p>"
);

// 26. Update FAQ payment methods
h = h.replace(
  'We accept Mobile Money (send to +256 752546261).',
  'We accept Mobile Money (send to +256 752546261) or Cash on Delivery.'
);

h = h.replace(
  'We accept Mobile Money (send to +256 752546261) or Cash on Delivery.',
  'We accept Mobile Money (send to +256 752546261) or Cash on Delivery.'
);

h = h.replace(
  'Choose Mobile Money (send to +256 752546261 using your Order ID as reference) at checkout.',
  'Choose Mobile Money (send to +256 752546261 using your Order ID as reference) or Cash on Delivery at checkout.'
);

h = h.replace(
  'Choose Mobile Money (send to +256 752546261 using your Order ID as reference) or Cash on Delivery at checkout.',
  'Choose Mobile Money (send to +256 752546261 using your Order ID as reference) or Cash on Delivery at checkout.'
);

// 27. Remove Google Maps and newsletter footer CSS reference
h = h.replace(
  '<link rel="stylesheet" href="style.css">',
  '<link rel="stylesheet" href="style.css?v=3.5">'
);

fs.writeFileSync('index.html', h);
console.log('All changes applied successfully!');
