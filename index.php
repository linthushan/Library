<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Library</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Container and Flex Layout */
        .container {
            margin: 20px;
        }

        .content {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            gap: 20px; /* Add space between the image and description */
        }

        .image img {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
        }

        .description {
            width: 60%;
            padding-left: 20px;
            font-size: 18px;
            color: #555;
        }

        /* Join as a Member Section */
        .join-member {
            background-color: #4CAF50;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            margin-top: 40px;
        }

        .join-member h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .join-member p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .join-member a {
            font-size: 18px;
            text-decoration: none;
            background-color: #fff;
            color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .join-member a:hover {
            background-color: #45a049;
            color: white;
        }

        /* Services Section */
        .services {
            margin-top: 40px;
            text-align: center;
            padding: 40px;
            background-color: #e2e2e2;
            border-radius: 8px;
        }

        .services h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .services ul {
            list-style-type: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .services ul li {
            font-size: 18px;
            color: #555;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .services ul li i {
            font-size: 30px;
            color: #4CAF50;
        }

        .services ul li .service-description {
            flex: 1;
        }

        /* Social Media & Contact Section */
        .social-contact {
            margin-top: 40px;
            text-align: center;
            background-color: #333;
            color: white;
            padding: 40px;
            border-radius: 8px;
        }

        .social-contact h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Cards Container */
        .cards-container {
            display: flex;
            justify-content: space-between;
            gap: 30px; /* Space between the cards */
            flex-wrap: wrap; /* To allow the cards to wrap on smaller screens */
            margin-top: 20px;
        }

        /* Card Design */
        .card {
            background-color: #444;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .card .social-icons a {
            font-size: 40px;
            margin: 0 10px;
            color: white;
            transition: color 0.3s ease;
        }

        .card .social-icons a:hover {
            color: #4CAF50;
        }

        .card .whatsapp-link {
            font-size: 18px;
            text-decoration: none;
            color: #25D366;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        .card .whatsapp-link:hover {
            color: #128C7E;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .description {
                width: 80%;
                padding-left: 0;
                margin-top: 20px;
            }

            .image img {
                max-width: 90%;
            }

            .services ul {
                grid-template-columns: 1fr;
            }

            .join-member h2 {
                font-size: 28px;
            }

            .join-member p {
                font-size: 16px;
            }

            /* Stacking the cards on smaller screens */
            .cards-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .card {
                width: 80%; /* Make cards take full width on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .description {
                font-size: 16px;
            }

            .services ul li {
                font-size: 16px;
            }
        }
    </style>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Main Content Section -->
    <div class="container">
        <h1>Welcome to Our Library</h1>
        <div class="content">
            <div class="image">
                <img src="image/libraryf.png" alt="Library Image" />
            </div>
            <div class="description">
                <p>Our library offers a wide range of books, journals, and multimedia resources. Whether you're here to study, research, or simply enjoy a quiet reading space, we have something for everyone. Join us and explore the wealth of knowledge waiting for you!</p>
            </div>
        </div>
    </div>

    <!-- Join as a Member Section -->
    <div class="join-member">
        <h2>Become a Member</h2>
        <p>Join our library today and enjoy access to a world of knowledge! As a member, you’ll receive exclusive benefits such as borrowing privileges, access to premium resources, and more.</p>
        <a href="register.php">Register Now</a>
    </div>

    <!-- Services Section -->
    <div class="services">
        <h2>Our Services</h2>
        <ul>
            <li>
                <i class="fas fa-wifi"></i>
                <div class="service-description">
                    <h3>Free Wi-Fi</h3>
                    <p>Enjoy fast and reliable Wi-Fi access throughout the library. Perfect for studying, browsing the web, and conducting research.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-book"></i>
                <div class="service-description">
                    <h3>Book Borrowing & Returning</h3>
                    <p>Borrow books for your personal reading or research. Return them at your convenience using our self-service kiosks or at the front desk.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-door-open"></i>
                <div class="service-description">
                    <h3>Reading Rooms</h3>
                    <p>Our quiet reading rooms are designed for uninterrupted reading and study. Available for individual or group sessions.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-chalkboard-teacher"></i>
                <div class="service-description">
                    <h3>Study and Research Assistance</h3>
                    <p>Our librarians are available to assist with research, finding resources, and providing study tips to help you succeed.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-search"></i>
                <div class="service-description">
                    <h3>Online Book Search</h3>
                    <p>Easily find books and resources available in the library using our online catalog. Search by title, author, or subject.</p>
                </div>
            </li>
        </ul>
    </div>

    <!-- Social Media & Contact Section -->
    <div class="social-contact">
        <h2>Follow Us & Contact Us</h2>

        <div class="cards-container">
            <!-- Social Media Card -->
            <div class="card">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.x.com" target="_blank"><i class="fab fa-x"></i></a>
                    <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <!-- WhatsApp Community Card -->
            <div class="card">
                <h3>Join Our WhatsApp Community</h3>
                <a href="https://wa.me/yourwhatsapplink" class="whatsapp-link" target="_blank">Click to Join</a>
            </div>

            <!-- Contact Info Card -->
            <div class="card">
                <h3>Contact</h3>
                <p><strong>WhatsApp:</strong> <a href="https://wa.me/yourwhatsapplink" target="_blank">Click to Message</a></p>
                <p><strong>Email:</strong> library@yourdomain.com</p>
                <p><strong>Phone:</strong> 0763220600</p>
            </div>
        </div>
    </div>

    <!-- feedbackview Section -->
    <?php include('feedbackview.php'); ?>

    <!-- Footer Section -->
    <?php include('footer.php'); ?>

</body>
</html>
