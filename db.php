<?php
// Database configuration
$host = 'localhost';      // Host name (usually localhost)
$username = 'root';       // Database username
$password = '';           // Database password (empty by default for local MySQL setups)
$dbname = 'library';      // Database name

// Create a PDO connection to the MySQL database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
