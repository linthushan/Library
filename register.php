<?php
// Include the database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Default role is "member"
    $role = "member";

    // Initialize error messages
    $error_message = '';

    // Check if passwords match
    if ($password != $confirm_password) {
        $error_message = "Passwords do not match!";
    } 
    // Check if username is at least 6 characters long
    elseif (strlen($username) < 6) {
        $error_message = "Username must be at least 6 characters long!";
    }
    // Check if password is at least 8 characters long and contains at least one number, one uppercase letter, and one lowercase letter
    elseif (strlen($password) < 8 || !preg_match('/\d/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        $error_message = "Password must be at least 8 characters long and include at least one number, one uppercase letter, and one lowercase letter!";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert user data into the database
        $sql = "INSERT INTO users (name, username, email, phone, address, password, role) 
                VALUES (:name, :username, :email, :phone, :address, :password, :role)";

        try {
            // Prepare and execute the statement
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':role', $role);

            // Execute the query
            if ($stmt->execute()) {
                $success_message = "Registration successful! You are a $role. Now you can login...";

                // Redirect to login.php after 5 seconds
                $redirect_delay = 5; // seconds
            } else {
                $error_message = "An error occurred during registration. Please try again.";
            }
        } catch (PDOException $e) {
            // Log the error to a file for debugging purposes
            error_log($e->getMessage(), 3, 'errors.log');
            $error_message = "An error occurred during registration. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="register.css">

    <script>
        // Client-side password validation
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var email = document.getElementById("email").value;
            
            // Username validation
            if (username.length < 6) {
                alert("Username must be at least 6 characters long.");
                return false;
            }

            // Password validation (must be at least 8 characters, include at least one number, one uppercase, and one lowercase letter)
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.");
                return false;
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            // Email validation
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true;
        }

        // Redirect after a delay if the registration is successful
        <?php if (isset($success_message)) { ?>
            setTimeout(function() {
                window.location.href = "login.php";
            }, <?php echo $redirect_delay * 1000; ?>); // 5 seconds
        <?php } ?>
    </script>
</head>
<body>

    <div class="container">
        <div class="left-side">
            <img src="image/register.png" alt="Image" class="form-image">
        </div>

        <div class="form-container">
            <h2>Register</h2>

            <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
            <?php if (isset($success_message)) { echo "<p class='success'>$success_message</p>"; } ?>

            <form action="register.php" method="POST" onsubmit="return validateForm()">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required minlength="6">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required minlength="8" pattern=".*\d.*" title="Password must be at least 8 characters long and contain at least one number.">

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="register-btn">Register</button>
            </form>

            <p>Already a member? <a href="login.php">Login here</a></p>
        </div>
    </div>

</body>
</html>
