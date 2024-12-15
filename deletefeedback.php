<?php
// Include the database connection
include('db.php');

// Get the ID from the POST data (AJAX request)
$data = json_decode(file_get_contents('php://input'), true);
$feedbackId = $data['id'];

if ($feedbackId) {
    // Prepare the DELETE SQL query
    $sql = "DELETE FROM feedback WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameter and execute the query
    $stmt->bindParam(':id', $feedbackId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
