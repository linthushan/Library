<?php
// deletebook.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the DELETE query
    $query = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Redirect back to the book manage page after deletion
        header("Location: bookmanage.php");
        exit();
    } else {
        echo "Error deleting item.";
    }
}
?>
