<?php
// Include the database configuration file (your db.php)
include('db.php');

// Check if the 'id' is present in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare the DELETE SQL query
    try {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the user management page after deletion
        header("Location: usermanage.php");
        exit;
    } catch (PDOException $e) {
        die("Error deleting user: " . $e->getMessage());
    }
} else {
    echo "No user ID provided.";
}
?>
