<?php
// Include the database connection
include('db.php');

// Simple PHP code to handle the form submission and insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign form data to variables
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $description = htmlspecialchars($_POST['description']);
    
    try {
        // Prepare an SQL statement to insert data into the feedback table
        $stmt = $pdo->prepare("INSERT INTO feedback (name, email, description, created_at) 
                               VALUES (:name, :email, :description, NOW())");
        
        // Bind the values to the SQL statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':description', $description);
        
        // Execute the statement to insert the data
        $stmt->execute();
        
        // Output a success message after the data is successfully inserted
        echo "<h3>Form Submitted Successfully!</h3>";
        echo "<p>Thank you for your feedback, $name. We have received your message.</p>";

        header("Refresh: 2; url=" . $_SERVER['PHP_SELF']);
        exit;
        
    } catch (PDOException $e) {
        // Handle any database connection or query errors
        echo "<h3>There was an error submitting your form.</h3>";
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share your Feedback with us</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var location = { lat: 9.4021, lng: 80.4036 }; // Example location (change this if needed)
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }

        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const description = document.getElementById('description').value;

            if (!name || !email || !description) {
                alert('Please fill in all fields.');
                return false;
            }

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!email.match(emailPattern)) {
                alert('Please enter a valid email address.');
                return false;
            }

            return true;
        }
    </script>

    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and Layout */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Description */
        .description {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1em;
            color: #555;
        }

        /* Contact Form Styles */
        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Map Styles */
        #map {
            height: 400px;
            width: 100%;
            margin-top: 30px;
            border-radius: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .contact-form {
                gap: 10px;
            }

            input[type="text"],
            input[type="email"],
            textarea {
                font-size: 14px;
            }

            button {
                font-size: 14px;
                padding: 10px 18px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 24px;
            }

            .description {
                font-size: 1em;
            }

            .contact-form {
                gap: 8px;
            }

            input[type="text"],
            input[type="email"],
            textarea {
                font-size: 12px;
                padding: 8px;
            }

            button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body onload="initMap()">
    <!-- Include Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container">
        <h1>Share your Feedback with us</h1>

        <div class="description">
            <p>We value your thoughts! Please take a moment to share your feedback, suggestions, or questions with us. Your input helps us improve our services and better serve you.</p>
        </div>

        <!-- Contact Form -->
        <form action="contact.php" method="POST" class="contact-form" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="description">Your Feedback or Description:</label>
                <textarea id="description" name="description" rows="4" required placeholder="Please provide your comments, suggestions, or any questions you may have."></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>

        <!-- Google Map -->
        <div id="map" class="map"></div>
    </div>
</body>
</html>
