<?php
session_start();
include('db.php'); // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];

    // Query the database for the user with the entered username
    $stmt = $pdo->prepare("SELECT id, name, username, email, phone, address, password FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If a user is found, populate the form
    if ($user) {
        $name = $user['name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        $password = $user['password']; // Never display plain password, should be hashed
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <!-- Include the navbar -->
    <?php include('navbar.php'); ?>

    <div class="form-container">
        <h2>Profile Details</h2>

        <!-- Display error if username not found -->
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?= $error; ?></p>
        <?php endif; ?>

        <!-- Form to enter username first -->
        <?php if (!isset($user)): ?>
            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="update-btn">Next</button>
                </div>
            </form>
        <?php else: ?>
            <!-- Form to edit profile after username is validated -->
            <form action="updateprofile.php" method="POST">
                <input type="hidden" name="username" value="<?= $user['username']; ?>">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?= $name; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $email; ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?= $phone; ?>" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="4" required><?= $address; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?= $password; ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="update-btn">Update</button>
                    <button type="button" class="cancel-btn" onclick="window.location.href='index.php'">Cancel</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
