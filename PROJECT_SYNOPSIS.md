# PROJECT SYNOPSIS
## EVA'S BEAUTY HUB - ONLINE BEAUTY STORE

---

## 1. INTRODUCTION

### 1.1 Background of the Project

The beauty industry in Uganda has been experiencing remarkable growth over the past decade, driven by increasing consumer demand for premium beauty products and personalized beauty services. Women across the country are becoming more conscious about their appearance and are actively seeking quality beauty products that help them look and feel their best. This growing demand has created significant opportunities for beauty entrepreneurs who can effectively meet the needs of this expanding market.

Eva's Beauty Hub was established as a response to this growing need, providing women in Uganda with access to premium beauty products and professional beauty services. The business operates from a physical location in Nakawa, a bustling suburb of Kampala, Uganda's capital city. The salon has built a reputation for providing quality beauty products and professional makeup services, earning the trust of many customers within the Kampala region.

However, despite the success of the physical salon, the traditional brick-and-mortar business model presented several limitations that constrained the business's growth potential. The most significant challenge was the limitation of serving only walk-in customers who could physically visit the salon during operating hours. This geographic and temporal constraint meant that potential customers from other parts of Kampala, or from other regions of Uganda, could not easily access the products and services offered by Eva's Beauty Hub.

In today's rapidly evolving digital landscape, having a strong online presence has become essential for business survival and growth. Consumers increasingly expect the convenience of browsing products, comparing prices, and making purchases from the comfort of their homes or offices. The COVID-19 pandemic further accelerated the adoption of online shopping, with more people turning to e-commerce platforms for their shopping needs.

Recognizing these market dynamics and the need to expand business reach beyond physical limitations, Eva's Beauty Hub sought to develop a comprehensive online platform that would combine the convenience of e-commerce with the personal touch that the salon is known for. This project represents an initiative to transform the traditional beauty business into a modern digital enterprise capable of serving customers across Uganda and beyond.

The proposed online platform would not only enable customers to browse and purchase beauty products remotely but also provide multiple secure payment options tailored to the Ugandan market, particularly M-Pesa, which is the most popular mobile money service in the country. By implementing this digital solution, Eva's Beauty Hub aims to overcome the limitations of its traditional business model while maintaining the quality of service that its customers have come to expect.

### 1.2 Purpose of the Project

The primary purpose of this project is to develop a fully functional e-commerce website for Eva's Beauty Hub that serves as a comprehensive online platform for beauty product retail and service delivery. This project aims to achieve several interconnected objectives that together will transform how the business operates and serves its customers.

First and foremost, the project aims to enable customers to browse and purchase beauty products online through an intuitive and user-friendly interface. The website will feature a comprehensive product catalog organized into clear categories, allowing customers to easily find the products they need. Each product will be displayed with high-quality images, detailed descriptions, and pricing information to help customers make informed purchasing decisions.

Secondly, the project seeks to provide multiple secure payment options that cater to the preferences of Ugandan consumers. While credit and debit cards are not widely used in Uganda, mobile money services like M-Pesa have become the preferred payment method for many transactions. Therefore, the system will integrate M-Pesa payment capabilities through two different providers, IntaSend and Daraja API, to provide customers with flexibility in how they pay for their orders.

Thirdly, the project aims to implement a robust order tracking and management system that allows both customers and the business owner to monitor the status of orders from placement to delivery. This feature will significantly improve customer satisfaction by providing transparency in the order fulfillment process and reducing inquiries about order status.

Additionally, the project aims to showcase the salon's beauty services prominently on the website, including professional makeup services and makeup consultations. By featuring these services online, the business can attract new customers who may be interested in booking appointments for salon services.

The project also aims to build customer trust through the inclusion of testimonials from satisfied customers and a comprehensive FAQ section that addresses common questions about products, services, payments, and deliveries. These elements will help overcome the hesitation that some customers may have about purchasing beauty products online.

Finally, the project aims to expand the business reach beyond its physical location in Nakawa, Kampala, to serve customers across Uganda and potentially internationally. This geographic expansion represents a significant growth opportunity for Eva's Beauty Hub.

### 1.3 Scope of the Project

The scope of this project encompasses the development of a complete e-commerce solution for Eva's Beauty Hub, including all the features and functionalities necessary to run a successful online beauty store. The project boundaries are defined as follows:

The frontend development includes the creation of a responsive website using HTML5, CSS3, and JavaScript that works seamlessly across desktop computers, tablets, and mobile phones. The website will feature multiple sections including a home page with hero content and value propositions, an about section describing the business, a comprehensive product catalog with filtering and search capabilities, a services section showcasing salon services, a testimonials section featuring customer reviews, an FAQ section addressing common questions, an orders section for order tracking and history, and a contact section with multiple contact options.

The backend development includes PHP scripts for handling form submissions, processing orders, and communicating with the MySQL database. The backend will also handle API communications with M-Pesa payment providers for processing mobile money transactions.

The database development includes the creation of a MySQL database to store customer information, order details, and other necessary data. The database schema will be designed to support all the required functionalities while ensuring data integrity and security.

The payment integration includes the implementation of M-Pesa payment capabilities through both IntaSend and Daraja API, as well as support for direct mobile money transfers and WhatsApp-based ordering as alternative payment options.

The deployment includes hosting the website on Firebase Hosting, a cloud platform that provides fast, reliable, and secure hosting for web applications. The website will be accessible at a public URL that customers can visit from anywhere with an internet connection.

The project does not include the development of a mobile application, which is planned as future work. Similarly, the project does not include an admin dashboard for the business owner, although this is identified as a future enhancement.

---

## 2. ABSTRACT

### 2.1 Project Summary

Eva's Beauty Hub is a comprehensive online beauty store and service platform designed to provide women in Uganda with convenient access to premium beauty products. The system serves as a digital storefront for a beauty salon and online shop located in Nakawa, Kampala, combining the convenience of online shopping with the trusted local service that customers have come to expect from Eva's Beauty Hub.

The platform represents a significant advancement in how beauty products are sold and delivered in Uganda. By leveraging modern web technologies and integrating with widely-used mobile money services, the system addresses the unique challenges and opportunities present in the Ugandan e-commerce market. The result is a seamless shopping experience that meets customers where they are and provides the convenience they increasingly demand.

The project encompasses the complete development of an e-commerce website from concept to deployment. This includes user interface design, frontend development, backend development, database design, payment integration, and deployment to a live server. The entire system has been designed with the specific needs of the Ugandan market in mind, particularly the preference for mobile money payments over traditional card-based payments.

The website features a modern, responsive design that looks professional on all devices. The color scheme uses purple and pink tones that are traditionally associated with beauty and femininity, creating an appealing visual identity that resonates with the target audience. The layout is clean and intuitive, making it easy for customers to navigate and find what they are looking for.

One of the key strengths of the system is its comprehensive approach to product management. The website includes 23 products organized into five main categories: Skincare, Makeup, Hair Care, Nails, and Accessories. Each product is displayed with an image, name, price, and category badge, making it easy for customers to browse and select products. The products are stored as JavaScript objects in the frontend code, allowing for easy updates and maintenance.

The shopping cart functionality provides a smooth e-commerce experience. Customers can add products to their cart with a single click, view the cart contents and total price, remove items they no longer want, and proceed to checkout when ready. The cart contents are stored in the browser's localStorage, ensuring that items persist even if the customer closes and reopens the browser.

The order management system is comprehensive and user-friendly. Customers fill out an order form with their details, select products and quantities, choose a payment method, and submit their orders. The system automatically generates a unique order ID for each order, which customers can use to track their order status. Orders are stored in both the MySQL database and the browser's localStorage, providing redundancy and ensuring order history is preserved.

The payment integration represents a significant feature of the system. Understanding that Ugandan consumers prefer mobile money over credit cards, the system offers four payment options: M-Pesa via IntaSend, M-Pesa via Daraja API, direct Mobile Money transfer, and WhatsApp ordering. Each option is designed to be simple and convenient, with clear instructions provided to customers on how to complete their payments.

The system also includes several features designed to build customer trust and provide excellent service. These include customer testimonials showcasing satisfaction, an extensive FAQ section addressing common questions, a newsletter subscription option for updates on new products and promotions, and a floating WhatsApp button that allows customers to quickly contact the business for inquiries or support.

### 2.2 Key Features Implemented

The Eva's Beauty Hub website includes numerous features that together create a complete e-commerce experience. These features have been carefully designed to meet the needs of both customers and the business owner.

The product catalog forms the foundation of the website. The catalog includes 23 carefully curated products that represent some of the best offerings in the beauty market. These products have been organized into five distinct categories to make browsing easier for customers.

The Skincare category includes nine products that address various skin care needs. These products include Sherbet Body Scrub for exfoliation and skin renewal, Skin Care Combo for comprehensive skin care, Luxury Body Spray for long-lasting fragrance, Premium Cotton Pads for gentle cleansing, Exfoliating Glove Sponge for deep cleansing, Vitamin C Brightening Cream for radiant skin, Pearl Cleansing Milk for delicate cleansing, Fruit Wipes for on-the-go refreshment, and Vitamin C Whitening Cream for skin brightening.

The Makeup category includes four products designed to enhance natural beauty. These include Lip Gloss in various shades for adding shine and color to lips, Pink Lips Lip Gloss specifically formulated for a natural pink look, and Matte Lip Gloss Set for those who prefer a matte finish.

The Hair Care category includes three products for hair styling and maintenance. These include Hair Clips for securing hairstyles, Puff Holder for creating volume, and Ribbon Hair Bows for decorative hair accessories.

The Nails category includes two products for nail beauty. These include Luxury Floral Nail Art for beautiful nail designs and Premium Press-on Nails for easy at-home manicures.

The Accessories category includes three complementary products. These include Earrings for adding elegance to any outfit, Portable Mini Fans for staying cool, and Pink Beaded Bracelets for stylish wrist accessories.

The shopping cart system allows customers to accumulate products before purchasing. When a customer clicks the "Add" button on a product, that item is added to their cart. The cart floating button in the corner shows the current number of items in the cart. Customers can view their cart by clicking on this button, which opens a modal displaying all items, their individual prices, and the total amount. Customers can remove items from the cart if they change their mind, and the cart total updates automatically.

The order placement process is straightforward and comprehensive. Customers can initiate an order by clicking the "Place New Order" button, which opens a modal containing an order form. The form collects all necessary information including the customer's full name, email address, phone number, selected product, quantity, delivery address, payment method, and any special notes. Form validation ensures that required fields are filled before submission.

The payment options have been specifically designed to accommodate the Ugandan market. The M-Pesa via IntaSend option uses the IntaSend JavaScript SDK to initiate an STK push to the customer's phone, prompting them to enter their M-Pesa PIN to complete the payment. The M-Pesa via Daraja option uses the Safaricom Daraja API for payment processing. The Mobile Money option provides the business phone number for direct transfers with manual confirmation. The WhatsApp option redirects customers to a WhatsApp conversation with the business for personalized ordering assistance.

The order tracking feature allows customers to find their order status using their unique Order ID. When a customer places an order, they receive an Order ID that they can enter on the Orders page to see the current status of their order. The system automatically updates the order status based on how much time has passed since the order was placed, showing "Pending" for orders less than an hour old, "Processing" for orders between 1-24 hours old, "Shipped" for orders between 24-72 hours old, and "Delivered" for orders older than 72 hours.

The order history feature displays all previous orders that a customer has placed. This helps customers keep track of their purchasing history and makes it easy to reorder favorite products. Order history is stored in both the database and localStorage, ensuring it is preserved even if the customer switches devices.

Additional features include a search functionality that allows customers to find products by typing keywords, category filter buttons that show only products in selected categories, a dark mode toggle for user preference, a newsletter subscription form for marketing communications, customer testimonials that build trust, and a comprehensive FAQ section that addresses common customer questions.

### 2.3 Technology Stack

The Eva's Beauty Hub website has been built using a carefully selected technology stack that balances functionality, performance, ease of development, and deployment convenience.

The frontend is built using HTML5, which provides the structural foundation of the website. HTML5 semantic elements are used throughout the code to improve accessibility and search engine optimization. The use of semantic HTML also makes the code more maintainable and easier to understand.

CSS3 handles all the styling and visual presentation of the website. The CSS includes responsive design elements that adapt the layout to different screen sizes, ensuring the website looks good on both desktop computers and mobile phones. CSS variables are used for theming, making it easy to change colors and styles throughout the website. Animations and transitions add visual polish, creating a premium feel that matches the beauty products being sold.

JavaScript handles all the interactive functionality on the website. This includes rendering products dynamically, managing the shopping cart, handling form submissions, integrating with payment services, and implementing order tracking. Modern JavaScript features like async/await are used for cleaner asynchronous code, and the Fetch API is used for communicating with backend services.

PHP serves as the backend scripting language, handling server-side processing that cannot be done in the browser. This includes processing order submissions, communicating with the MySQL database, and handling payment-related operations. PHP provides the necessary server-side capabilities while remaining widely supported on web hosting platforms.

MySQL serves as the relational database management system for storing and retrieving data. The database stores order information, customer details, and other persistent data. MySQL was chosen for its reliability, performance, and widespread support.

The LocalStorage API in web browsers provides client-side data persistence for features like shopping cart contents and order history. This allows the website to provide a seamless experience even when the server is unavailable or when the customer is browsing offline.

M-Pesa payment integration is achieved through two providers. IntaSend provides a JavaScript SDK that simplifies the integration process and offers STK push functionality. The Safaricom Daraja API provides an alternative payment method with direct API integration. Both services enable customers to pay using M-Pesa, the dominant mobile money service in Uganda.

Firebase Hosting provides the cloud infrastructure for deploying and serving the website. Firebase offers free hosting suitable for small to medium-sized websites, with fast loading times and global content delivery network distribution.

---

## 3. EXISTING SYSTEMS

### 3.1 Traditional Beauty Shop Model

Eva's Beauty Hub originally operated as a traditional brick-and-mortar beauty salon and retail store located in Nakawa, a suburb of Kampala, Uganda. This business model, while successful in its own right, faced several inherent limitations that constrained its growth potential and operational efficiency.

The physical salon offered a range of beauty services including professional makeup application and makeup consultations. Customers would visit the salon in person to receive these services or to purchase beauty products from the retail inventory. The business relied on walk-in customers and word-of-mouth referrals to attract new clients. While this model worked reasonably well, it placed significant limitations on the business's ability to scale and reach a broader customer base.

#### 3.1.1 Current Business Model

The current business model of Eva's Beauty Hub as a physical retail establishment involves several key components that define how the business operates and serves its customers.

The service offerings include professional makeup services where skilled makeup artists apply makeup for various occasions including weddings, parties, photoshoots, and other special events. The salon also provides makeup consultation services where customers receive personalized advice on makeup techniques and product selection based on their skin type, features, and preferences.

The retail component involves selling beauty products directly to customers who visit the physical store. Products are displayed on shelves and customers select items to purchase at the counter. Payment is typically made in cash at the time of purchase.

Customer acquisition relies primarily on walk-in traffic from the local Nakawa area, referrals from satisfied customers, and potentially some social media presence. The business hours are typically daytime hours when the physical salon is open, limiting the ability to serve customers who work during these hours.

Inventory management is done manually, with the business owner tracking which products are selling well and reordering as needed. This manual process is prone to errors and can lead to stockouts or overstock situations.

#### 3.1.2 Limitations of the Current System

Despite its successes, the traditional business model presents several significant limitations that impact the business's growth potential and operational efficiency.

**Limited Customer Reach and Geographic Constraints**

The most significant limitation of the physical store model is its geographic constraint. Only customers who can physically visit the salon in Nakawa can access the products and services offered. This means potential customers from other parts of Kampala, from other cities in Uganda, or from outside Uganda cannot easily purchase from Eva's Beauty Hub. This geographic limitation significantly restricts the potential customer base and revenue opportunities.

Furthermore, the business cannot attract customers who prefer to shop online, a rapidly growing segment of consumers who expect the convenience of browsing and purchasing from anywhere at any time. The lack of an online presence means missing out on this growing market segment.

**Manual Order Processing Inefficiencies**

All order processing in the current system is done manually, using paper records or basic spreadsheets. When a customer wants to purchase products, staff must manually record the order details, calculate totals, and track the order through fulfillment. This manual process is time-consuming and prone to human error.

Order history is difficult to maintain and retrieve. When a customer calls to inquire about a previous purchase, staff must search through paper records, which can be time-consuming and sometimes fruitless if records are lost or disorganized. This poor order tracking capability leads to customer frustration and decreased satisfaction.

The lack of systematic customer database management means that the business cannot easily identify repeat customers, track purchase patterns, or implement customer loyalty programs. Every customer is essentially treated as a new customer, missing opportunities for personalized service and targeted marketing.

**Payment Limitations**

The current payment system accepts only cash payments, which presents multiple challenges. Customers who do not have sufficient cash on hand cannot complete their purchases, potentially leading to lost sales. The business must handle and store cash on-site, which presents security risks. Additionally, the lack of digital payment records makes accounting and financial tracking more difficult.

The absence of mobile money payment options means the business cannot serve the large segment of Ugandan consumers who prefer using M-Pesa for their transactions. M-Pesa has become the dominant payment method in Uganda, with millions of users. By not offering this payment option, Eva's Beauty Hub excludes a significant portion of potential customers.

**Inventory Management Challenges**

The manual inventory tracking system makes it difficult to maintain optimal stock levels. Without real-time visibility into product availability, the business may run out of popular items, leading to disappointed customers and lost sales. Conversely, overstocking unpopular items ties up capital that could be invested in better-selling products.

The lack of automated reordering means the business owner must constantly monitor inventory levels and manually place reorders, taking time away from other important business activities. There is no systematic way to identify which products are selling well and which are not, making it difficult to make informed inventory decisions.

**Time and Operational Constraints**

The business is limited to its physical operating hours, typically during the day on weekdays and possibly weekends. This means the business cannot process orders outside these hours, missing potential sales from customers who browse outside operating hours. Customers cannot make purchases at their convenience, which may lead them to choose competitors who offer 24/7 online shopping.

The limited staff capacity means there is a ceiling on how many customers can be served at once. During peak times, this can lead to long wait times and frustrated customers. The business cannot easily scale to handle increased demand without hiring additional staff and potentially expanding the physical space.

### 3.2 Market Analysis

The beauty retail market in Uganda presents both opportunities and challenges that informed the development of the Eva's Beauty Hub online platform.

#### 3.2.1 Current Market Gaps in Uganda

The Ugandan beauty retail market has several gaps that present opportunities for innovative e-commerce solutions.

The first significant gap is the lack of dedicated online beauty stores in Uganda. While general e-commerce platforms exist, there are few specifically focused on beauty products. This presents an opportunity for Eva's Beauty Hub to establish itself as the go-to online destination for beauty products in Uganda.

The second gap is the limited understanding and implementation of mobile money payment integration among small businesses. Many businesses recognize the need for M-Pesa integration but lack the technical knowledge or resources to implement it. By successfully integrating multiple M-Pesa options, Eva's Beauty Hub can differentiate itself from competitors and provide a superior customer experience.

The third gap is the absence of comprehensive product information and customer support online. Many customers are hesitant to purchase beauty products online because they cannot see the products in person or ask questions. By providing detailed product information, customer testimonials, and FAQ sections, Eva's Beauty Hub can build trust and overcome these hesitations.

The fourth gap is the lack of order tracking capabilities in most local retail businesses. Customers often have no way to know when their orders will arrive, leading to uncertainty and frustration. By implementing order tracking, Eva's Beauty Hub can provide a superior customer experience that builds loyalty and repeat business.

---

## 4. PROPOSED SYSTEM

### 4.1 System Overview

The proposed system for Eva's Beauty Hub is a comprehensive e-commerce platform that addresses all the limitations of the traditional business model while introducing new capabilities that enhance the customer experience and business operations.

#### 4.1.1 Project Objectives

The main objectives of the proposed system are:

To create a professional online presence for Eva's Beauty Hub that represents the brand effectively and provides customers with a seamless shopping experience. The website will feature a modern design that reflects the quality and professionalism of the business.

To enable 24/7 product browsing and ordering capabilities, allowing customers to shop at their convenience regardless of the time of day. This removes the temporal constraints of the physical store and expands the potential customer base to include those who work during traditional business hours.

To integrate M-Pesa payment options that Ugandan customers prefer, providing multiple ways to pay including IntaSend, Daraja API, direct transfer, and WhatsApp ordering. This comprehensive payment integration will reduce cart abandonment and increase conversion rates.

To automate order management processes, replacing manual paper-based systems with efficient digital workflows. Orders will be automatically recorded in the database, assigned unique IDs, and tracked through fulfillment.

To enhance customer experience through features like shopping cart, order tracking, product search, category filtering, and personalized support via WhatsApp. These features will differentiate Eva's Beauty Hub from competitors.

To build customer trust through the display of testimonials, comprehensive FAQs, secure payment processing, and transparent order tracking. These trust-building elements will help overcome customer hesitations about online beauty purchases.

### 4.2 Key Features

The proposed system includes numerous features organized into customer-facing features and business owner features.

#### 4.2.1 Customer Features

The customer-facing features are designed to provide an excellent shopping experience from product discovery to order delivery.

**Product Catalog and Browsing**: The website displays all products in an attractive grid layout with images, names, prices, and category badges. Products are organized by category with clear section headers. Featured and new product badges highlight special items.

**Product Search and Filter**: Customers can search for products by typing in the search box. Results update in real-time as the customer types. Category filter buttons allow customers to view only products in specific categories.

**Shopping Cart**: Customers can add products to their cart with a single click. The cart floating button shows the current item count. Cart contents persist across browser sessions using localStorage, so customers can return to their cart later.

**Order Placement**: The order form collects all necessary information including customer name, email, phone, product selection, quantity, delivery address, payment method, and special notes. Form validation ensures data completeness before submission.

**Payment Options**: Four payment methods are supported. M-Pesa via IntaSend provides instant STK push. M-Pesa via Daraja provides direct API integration. Mobile Money allows direct transfer with manual confirmation. WhatsApp enables personalized ordering assistance.

**Order Tracking**: Customers can track their orders using their unique Order ID. The system shows the current order status based on how much time has passed since order placement.

**Order History**: All past orders are stored and displayed in the orders section. Customers can view details of each order including products, totals, and status.

**Additional Features**: Newsletter subscription allows customers to receive updates. Testimonials build trust. The FAQ section addresses common questions. The WhatsApp floating button provides quick access to customer support.

---

## 5. SYSTEM REQUIREMENTS

### 5.1 Functional Requirements

The functional requirements define what the system must do to meet user needs.

**Product Display (FR-01)**: The system must display all products with images, names, prices, and category badges.

**Category Filter (FR-02)**: Users must be able to filter products by category including Skincare, Makeup, Hair Care, Nails, and Accessories.

**Search (FR-03)**: Users must be able to search products by name with real-time results.

**Add to Cart (FR-05)**: Users must be able to add products to the shopping cart.

**View Cart (FR-06)**: Users must be able to view cart contents and total price.

**Remove from Cart (FR-07)**: Users must be able to remove items from the cart.

**Order Form (FR-09)**: The system must provide an order form with validation for all required fields.

**Order ID Generation (FR-10)**: The system must generate unique Order IDs for each order.

**Order Storage (FR-11)**: Orders must be stored in the database and localStorage.

**Order Tracking (FR-12)**: Users must be able to track orders by entering their Order ID.

**M-Pesa IntaSend (FR-14)**: The system must support M-Pesa payments via IntaSend.

**M-Pesa Daraja (FR-15)**: The system must support M-Pesa payments via Daraja API.

**WhatsApp Contact (FR-19)**: The system must provide a floating WhatsApp button for quick contact.

---

## 6. FUTURE WORK

### 6.1 User Authentication System

Future development will implement user registration and login functionality using JWT tokens for secure authentication. Users will be able to create accounts, manage saved addresses, and access order history across devices.

### 6.2 Admin Dashboard

A comprehensive admin panel will be developed using React.js to provide product management, order management, customer management, inventory tracking, sales reports, and analytics.

### 6.3 Mobile Application

A React Native mobile application will be developed for iOS and Android with push notifications, offline mode, and mobile-specific features.

---

## 7. CONCLUSION

Eva's Beauty Hub represents a significant advancement in beauty retail in Uganda. By combining e-commerce capabilities with mobile money integration, the system addresses the unique needs of the Ugandan market and provides a foundation for continued growth and success.

---

## APPENDIX

### Appendix A: Project Information

| Item | Details |
|------|---------|
| Project Name | Eva's Beauty Hub |
| Project Type | E-commerce Website |
| Location | Nakawa, Kampala, Uganda |
| Contact | +256 752546261 |
| Email | atwiineevalyne@gmail.com |
| Live URL | https://evas-beauty-hub.web.app |

### Appendix B: Technology Summary

| Category | Technology |
|----------|------------|
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP |
| Database | MySQL |
| Payments | M-Pesa (IntaSend, Daraja) |
| Hosting | Firebase |

### Appendix C: Product Categories

1. Skincare - 9 products
2. Makeup - 4 products
3. Hair Care - 3 products
4. Nails - 2 products
5. Accessories - 3 products

**Total: 23 products**

---

*This document was prepared for academic/institutional purposes*
*Last Updated: March 2026*
