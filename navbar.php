<!-- navbar.php -->
<?php
// Start the session to check login status
session_start();

// Set login status for demonstration (In a real app, this will be based on user authentication)
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
        /* Basic styling for the navbar */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            box-sizing: border-box;
        }

        .navbar-left {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
        }

        .navbar-right {
            display: flex;
            gap: 20px;
        }

        .navbar-right a {
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .navbar-right a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

        /* Mobile view styling */
        @media screen and (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar-left {
                font-size: 22px;
                margin-bottom: 10px;
            }

            .navbar-right {
                width: 100%;
                flex-direction: column;
                gap: 10px;
            }

            .navbar-right a {
                width: 100%;
                text-align: left;
                padding: 12px;
                font-size: 18px;
            }
        }

        /* Tablet view: refine styles for tablets */
        @media screen and (max-width: 1024px) {
            .navbar {
                padding: 15px 20px;
            }

            .navbar-left {
                font-size: 20px;
            }

            .navbar-right a {
                font-size: 15px;
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <!-- Left side: Library Management -->
        <div class="navbar-left">
            Library Management
        </div>

        <!-- Right side: Menu items -->
        <div class="navbar-right">
            <a href="index.php">Home</a>
            <a href="books.php">Books</a>
            <a href="contact.php">Contact</a>
            <a href="about.php">About</a>
            <?php if ($isLoggedIn): ?>
                <a href="bookpdf.php">Books PDF</a>
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
