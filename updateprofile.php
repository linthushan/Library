<?php
session_start();
include('db.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $username = $_POST['username']; // Username cannot be updated
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Always hash passwords

    // Prepare and execute the update query
    $stmt = $pdo->prepare("
        UPDATE users 
        SET name = :name, email = :email, phone = :phone, address = :address, password = :password
        WHERE username = :username
    ");

    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'password' => $password,
        'username' => $username
    ]);

    // Redirect to the profile page upon success
    header("Location: profile.php");
    exit();
}
