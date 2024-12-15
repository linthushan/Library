<?php
// Include database connection (db.php)
require_once 'db.php';

// Query to fetch book data from the database
$query = "SELECT `id`, `name`, `category`, `description`, `image` FROM `books` WHERE 1";

// Prepare and execute the query
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch the data into an array
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="bookmanage.css">
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
        <h1>Welcome to the Admin Dashboard</h1>

        <!-- Add Book Button -->
        <div class="add-book-btn">
            <a href="addbook.php" class="btn">+ Add Book</a>
        </div>

        <!-- Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                    <td>
                        <?php
                        $imagePath = htmlspecialchars($item['image']);
                        // Check if the image path exists and the file is accessible
                        if (file_exists($imagePath)) {
                            echo '<img src="' . $imagePath . '" alt="Book Image" width="50">';
                        } else {
                            echo '<span>No image available</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <!-- Removed View link -->
                        <a href="#" class="action-link" onclick="editItem('<?php echo htmlspecialchars($item['name']); ?>', '<?php echo htmlspecialchars($item['category']); ?>', '<?php echo htmlspecialchars($item['description']); ?>', <?php echo $item['id']; ?>)">Edit</a> |
                        <a href="#" class="action-link" onclick="deleteItem(<?php echo $item['id']; ?>)">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Popup -->
    <div id="edit-popup" class="popup">
        <div class="popup-content">
            <button class="close-btn" onclick="closePopup('edit-popup')">&times;</button>
            <h2>Edit Item</h2>
            <form id="edit-form" action="editbook.php" method="POST">
                <input type="hidden" id="edit-id" name="id">
                <input type="text" id="edit-name" name="name" placeholder="Name" required />
                <input type="text" id="edit-category" name="category" placeholder="Category" required />
                <textarea id="edit-description" name="description" placeholder="Description" rows="4" required></textarea>

                <div class="popup-actions">
                    <button type="submit" class="btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Popup -->
    <div id="delete-popup" class="popup">
        <div class="popup-content">
            <button class="close-btn" onclick="closePopup('delete-popup')">&times;</button>
            <h2>Are you sure you want to delete this item?</h2>
            <form id="delete-form" method="POST" action="deletebook.php">
                <input type="hidden" name="id" id="delete-id">
                <div class="popup-actions">
                    <button type="submit" class="btn">Delete</button>
                    <button type="button" class="btn" onclick="closePopup('delete-popup')">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "flex";
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = "none";
        }

        function editItem(name, category, description, id) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-description').value = description;
            openPopup('edit-popup');
        }

        function deleteItem(id) {
            document.getElementById('delete-id').value = id;
            openPopup('delete-popup');
        }
    </script>

</body>
</html>
