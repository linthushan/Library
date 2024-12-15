<?php
// Include database connection (db.php)
require_once 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Get form data and sanitize inputs
    $name = trim(htmlspecialchars($_POST['name']));
    $category = trim(htmlspecialchars($_POST['category']));
    $description = trim(htmlspecialchars($_POST['description']));
    $itemId = $_POST['id']; // Item ID passed via POST

    // Validate required fields
    if (empty($name) || empty($category) || empty($description)) {
        echo "All fields are required.";
        exit;
    }

    // Initialize image variable (set to current image if no new image is uploaded)
    $newImage = null;

    // Fetch the current image from the database to keep it if no new image is uploaded
    $stmt = $pdo->prepare("SELECT image FROM books WHERE id = ?");
    $stmt->execute([$itemId]);
    $currentImage = $stmt->fetchColumn();

    // No need for image upload logic, just keep the current image
    $newImage = $currentImage;

    // Prepare SQL query to update the book record (without image upload)
    $query = "UPDATE books SET name = ?, category = ?, description = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $category, $description, $newImage, $itemId]);

    // Redirect back to the book management page
    header("Location: bookmanage.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
