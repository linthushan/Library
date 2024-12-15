<?php
// Include your db.php file to get the database connection
include('db.php');

// Prepare and execute the SQL query
$sql = "SELECT id, name, email, description, created_at FROM feedback WHERE 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch all feedback from the database
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="feedback.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="usermanage.php">User Management</a></li>
            <li><a href="bookmanage.php">Book Management</a></li>
            <li><a href="feedback.php">Feedback View</a></li>
            <li><a href="addbookpdf.php">Add Book PDF</a></li>
        </ul>

        <!-- Profile and Logout - Bottom section -->
        <div class="sidebar-bottom">
            <a href="logout.php" class="sidebar-bottom-link">Logout</a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Feedback View</h1>

        <!-- Feedback List -->
        <div class="feedback-list">
            <?php foreach ($feedbacks as $feedback) : ?>
                <div class="feedback-item">
                    <div class="feedback-header">
                        <h3><?php echo htmlspecialchars($feedback['name']); ?></h3>
                        <p class="email"><?php echo htmlspecialchars($feedback['email']); ?></p>
                    </div>
                    <p class="description"><?php echo htmlspecialchars($feedback['description']); ?></p>
                    <span class="date"><?php echo htmlspecialchars($feedback['created_at']); ?></span>
                    
                    <!-- Delete Icon -->
                    <div class="delete-icon" onclick="showDeleteModal(<?php echo $feedback['id']; ?>)">
                        🗑️
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Are you sure you want to delete this feedback?</h2>
            <button id="confirmDelete" class="confirm-btn">Yes</button>
            <button id="cancelDelete" class="cancel-btn">No</button>
        </div>
    </div>

    <script>
        // JavaScript to handle modal visibility
        let feedbackIdToDelete = null;

        function showDeleteModal(feedbackId) {
            feedbackIdToDelete = feedbackId;
            document.getElementById('deleteModal').style.display = 'block';
        }

        document.getElementById('confirmDelete').onclick = function() {
            // Perform AJAX to delete feedback
            let feedbackId = feedbackIdToDelete;
            fetch('deletefeedback.php', {
                method: 'POST',
                body: JSON.stringify({ id: feedbackId }),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Feedback deleted successfully');
                    location.reload(); // Reload the page to update the feedback list
                } else {
                    alert('Failed to delete feedback');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred');
            });

            document.getElementById('deleteModal').style.display = 'none';
        };

        document.getElementById('cancelDelete').onclick = function() {
            document.getElementById('deleteModal').style.display = 'none';
        };

        // Close the modal if clicked outside of it
        window.onclick = function(event) {
            if (event.target === document.getElementById('deleteModal')) {
                document.getElementById('deleteModal').style.display = 'none';
            }
        };
    </script>

</body>
</html>
