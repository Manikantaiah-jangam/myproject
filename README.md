# myproject
project about electronic device online shopping website.
🛍️ Electronic Device Online Shopping Website
An online shopping web application for electronic products built with PHP, HTML, CSS, and MySQL. The platform includes both Admin and User sections, providing an end-to-end experience for managing products and placing orders securely.

📌 Features
✅ User Side
👨‍💻 Register/Login with secure password hashing

🛒 View, search, and browse all available electronic products

🧾 Add products to cart and place orders

📦 View order history

🙋‍♂️ Manage personal profile (with update options)

🧠 Passwords are hashed for enhanced security

📜 Informational pages: About Us, Contact Us, Privacy Policy

📱 Integrated links to WhatsApp, Facebook, Twitter, Instagram

🛠️ Admin Side
🔐 Admin login with secured credentials

🗂️ Manage product catalog: Add, Update, Delete products

👥 View and manage user list

📊 View basic dashboard stats (optional)

🧱 Tech Stack
Technology	Purpose
PHP	Server-side scripting
MySQL	Database management
HTML	Page structure
CSS	Styling and responsiveness
JavaScript (optional)	Enhancements (e.g., form validation)
📁 Project Structure
pgsql
Copy
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
