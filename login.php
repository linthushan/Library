<?php
// Include the database connection
include('db.php');  // PDO connection

// Start the session at the top for session handling
session_start();

// Handle login form submission and validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Initialize error message
    $error_message = '';

    // Check if username and password are provided
    if (empty($username) || empty($password)) {
        $error_message = "Please enter both username and password!";
    } else {
        // Query the database to validate the username using PDO
        try {
            // Prepare SQL query to fetch user details based on the username
            $sql = "SELECT id, username, password, role FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            
            // Check if the user exists
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Validate password using password_verify
                if (password_verify($password, $user['password'])) {
                    // Login successful
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Redirect based on role
                    if ($user['role'] === "admin") {
                        // Redirect to admin dashboard
                        header("Location: dashboard.php");
                        exit();
                    } elseif ($user['role'] === "member") {
                        // Redirect to the index page for members
                        header("Location: index.php");
                        exit();
                    }
                } else {
                    // Invalid password
                    $error_message = "Invalid username or password!";
                }
            } else {
                // User not found
                $error_message = "Invalid username or password!";
            }
        } catch (PDOException $e) {
            // Handle potential errors with the database connection or query execution
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">

    <script>
        // Client-side login validation
        function validateLoginForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Simple validation for empty fields
            if (username === "" || password === "") {
                alert("Please enter both username and password.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="container">
        <div class="left-side">
            <img src="image/login.png" alt="Login Image" class="form-image">
        </div>

        <div class="form-container">
            <h2>Login</h2>

            <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>

            <form action="login.php" method="POST" onsubmit="return validateLoginForm()">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

</body>
</html>
