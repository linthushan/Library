<?php
// about.php
$pageTitle = "About Us - Library";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #4CAF50;
            color: white;
            padding: 1em 0;
            text-align: center;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header h1 {
            font-size: 2rem;
        }
        
        .about-section {
            background: white;
            padding: 2em 0;
            text-align: center;
        }

        .about-section .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        /* About content */
        .about-content {
            width: 50%;
        }

        .about-content h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .about-content p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        /* About image */
        .about-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: auto;
        }

        /* Vision and Mission Section Styles */
        .vision-mission-section {
            background: #eaeaea;
            padding: 2em 0;
            text-align: center;
        }

        .vision-mission-section .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            flex-wrap: wrap;
        }

        .vision-mission-content {
            width: 45%;
            margin-bottom: 20px;
        }

        .vision-mission-content h3 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .vision-mission-content p {
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Mobile and Tablet view */
        @media (max-width: 768px) {
            .vision-mission-section .container {
                flex-direction: column;
                text-align: center;
            }

            .vision-mission-content {
                width: 100%;
                margin-bottom: 20px;
            }

            header .container {
                flex-direction: column;
                align-items: center;
            }

            header h1 {
                font-size: 1.5rem;
            }

            .about-section .container {
                flex-direction: column;
                text-align: center;
            }

            .about-content {
                width: 100%;
                margin-bottom: 20px;
            }

            .about-image img {
                max-width: 100%;
                margin-top: 20px;
            }
        }

        /* Desktop view (for larger screens) */
        @media (min-width: 769px) {
            .about-section .container {
                flex-direction: row;
                text-align: left;
            }

            .about-content {
                width: 50%;
            }

            .about-image img {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Include Navbar -->
    <?php include('navbar.php'); ?>

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h2>About Our Library</h2>
                <p>Our library is a community hub dedicated to fostering a love of reading and learning. With a wide variety of books, digital resources, and engaging programs, we strive to support lifelong learning for all ages.</p>
                <p>We are passionate about providing resources and spaces for individuals to explore, discover, and connect with knowledge.</p>
            </div>

            <div class="about-image">
                <img src="image/library.png" alt="Library Image">
            </div>
        </div>
    </section>

    <!-- Vision and Mission Section -->
    <section class="vision-mission-section">
        <div class="container">
            <div class="vision-mission-content">
                <h3>Our Vision</h3>
                <p>Our vision is to be a dynamic resource center that fosters lifelong learning, creativity, and collaboration. We aim to empower individuals of all ages by providing access to knowledge and promoting a love of reading in a welcoming and inclusive environment.</p>
            </div>

            <div class="vision-mission-content">
                <h3>Our Mission</h3>
                <p>Our mission is to provide access to a wide range of educational and cultural resources, create programs that enhance learning, and serve as a community hub that inspires curiosity, collaboration, and creativity.</p>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include('footer.php'); ?>

</body>
</html>
