<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Mani's Shoppee</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        .contact-info {
            margin: 30px 0;
            font-size: 18px;
        }

        .contact-info p {
            margin: 10px 0;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        .social-links a {
            text-decoration: none;
            color: #fff;
            background-color: #2980b9;
            padding: 12px 20px;
            border-radius: 8px;
            transition: 0.3s ease;
            font-weight: bold;
        }

        .social-links a:hover {
            background-color: #1c4f7c;
        }

        .continue-btn {
            text-align: center;
            margin-top: 40px;
        }

        .continue-btn a {
            text-decoration: none;
            background-color: #27ae60;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .continue-btn a:hover {
            background-color: #1e8449;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }

        @media (max-width: 600px) {
            .social-links {
                flex-direction: column;
                align-items: center;
            }

            .social-links a {
                width: 80%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Contact Us</h1>
</header>

<main>
    <h2>We’d love to hear from you!</h2>

    <div class="contact-info">
        <p><strong>Phone:</strong> +91-9876543210</p>
        <p><strong>Email:</strong> support@manisshoppee.com</p>
        <p><strong>Address:</strong> 123 Market Street, Chennai, India</p>
    </div>

    <div class="social-links">
        <a href="https://wa.me/919876543210" target="_blank">WhatsApp</a>
        <a href="https://www.facebook.com/manisshoppee" target="_blank">Facebook</a>
        <a href="https://twitter.com/manisshoppee" target="_blank">Twitter</a>
        <a href="https://instagram.com/manisshoppee" target="_blank">Instagram</a>
    </div>

    <div class="continue-btn">
        <a href="products.php">← Continue Shopping</a>
    </div>
</main>

<footer>
    <p>&copy; 2025 Mani's Shoppee. All Rights Reserved.</p>
</footer>

</body>
</html>
