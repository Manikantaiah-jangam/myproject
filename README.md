# myproject
->project about an online store for buying electronic devices. Online Shopping Website for Electronic Devices  PHP, HTML, CSS, and MySQL were used to create this electronic product shopping web application. The platform offers a secure end-to-end experience for managing products and placing orders, with both admin and user sections.
->Features  User Side Use secure password hashing to register or log in.
->Browse, search, and view every electronic product that is available.
->Place orders and add items to your cart.
->Examine your order history.
->Control your personal profile (with update options) 
->To improve security, passwords are hashed.
->Informational pages: Privacy Policy, Contact Us, and About Us
->Integrated connections to Instagram, Twitter, Facebook, and WhatsApp
->Admin Side  Admin login using secure credentials
->Manage the product catalog by adding, editing, and removing items.
->See and control the user list
->See the basic dashboard statistics (optional)
-----File Structure:--------
Edit
/project-root
│
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   └── manage_products.php
│
├── images/
│   └── logo.png, product images
│
├── includes/
│   └── db.php (database connection)
│
├── user/
│   ├── register.php
│   ├── login.php
│   ├── user_profile.php
│   ├── cart.php
│   ├── products.php
│   └── order_history.php
│
├── contact_us.php
├── about_us.php
├── privacy_policy.php
├── index.php
├── logout.php
├── README.md
└── shopping_db.sql
🔒 Security Features
Password Hashing: All user passwords are hashed using password_hash() before storage.
Prepared Statements: Database queries use prepared statements to prevent SQL injection.
Session Handling: Sessions are securely managed to maintain login states.
⚙️ How to Set It Up Locally
✅ Install Requirements
XAMPP/WAMP (PHP, MySQL server)
Web browser
✅ Clone or Copy the Project
Place the folder inside htdocs (XAMPP) or www (WAMP)
✅ Create Database
Open phpMyAdmin
Import shopping_db.sql file to set up tables
✅ Edit DB Connection
In includes/db.php, ensure your DB credentials match your setup:
php
Copy
Edit
$conn = new mysqli("localhost", "root", "", "shopping_db");
✅ Run the Project

Visit: http://localhost/myproject/products.php

🙋‍♂️ Admin Credentials (for demo)
Username: admin
Password: admin@123 (ensure password is stored hashed in DB)
📣 Pages Overview
Page	Description
products.php	Main product listing with add-to-cart
cart.php	View & manage cart items
user_profile.php	Update personal info
about_us.php	Information about the store
contact_us.php	Contact form + social media links
privacy_policy.php	Privacy terms
🌐 Social Media Links
In Contact Us, clickable icons or text direct users to:
WhatsApp
Facebook
Twitter
Instagram
📌 Future Improvements (Optional Ideas)
✅ Email verification after signup
🧾 Invoice generation after order
📦 Order tracking system
📱 Mobile-friendly enhancements
🛡️ CSRF Token implementation
📜 License
This project is open source and free to use for learning and development purposes.
