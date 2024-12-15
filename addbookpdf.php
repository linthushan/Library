<?php
// Include your db.php file to get the database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $image = $_FILES['image'];
    $pdf = $_FILES['pdf'];

    // File size limit (5MB for image, 50MB for PDF)
    $maxImageFileSize = 5 * 1024 * 1024;  // 5 MB for images
    $maxPdfFileSize = 50 * 1024 * 1024;   // 50 MB for PDFs

    // Validate image file (check MIME type and size)
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($image['type'], $allowedImageTypes)) {
        echo "Invalid image file format. Only JPG, PNG, and GIF are allowed.";
        exit;  // Stop the script if the image type is invalid
    }
    if ($image['size'] > $maxImageFileSize) {
        echo "Image file size exceeds the maximum allowed size of 5MB.";
        exit;
    }

    // Handle image upload
    $imagePath = 'uploads/' . basename($image['name']);
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        echo "Error uploading the image file.";
        exit;
    }

    // Validate PDF file (check MIME type and size)
    if ($pdf['type'] !== 'application/pdf') {
        echo "Invalid PDF file. Only PDF files are allowed.";
        exit;  // Stop the script if the PDF file is invalid
    }
    if ($pdf['size'] > $maxPdfFileSize) {
        echo "PDF file size exceeds the maximum allowed size of 50MB.";
        exit;
    }

    // Handle PDF upload
    $pdfPath = 'uploads/' . basename($pdf['name']);
    if (!move_uploaded_file($pdf['tmp_name'], $pdfPath)) {
        echo "Error uploading the PDF file.";
        exit;
    }

    // Prepare the SQL query to save the data
    $sql = "INSERT INTO pdfbook (name, image, pdf_file) VALUES (:name, :image, :pdf)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $imagePath);
    $stmt->bindParam(':pdf', $pdfPath);
    $stmt->execute();

    // Success message
    echo "Book uploaded successfully!";
    header("Location: addbookpdf.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $sql = "DELETE FROM pdfbook WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $deleteId);
    $stmt->execute();
    header("Location: addbookpdf.php"); // Redirect back after deletion
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="addbookpdf.css">
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
        <h1>Upload New Book</h1>

        <!-- Upload Form -->
        <form action="addbookpdf.php" method="POST" enctype="multipart/form-data" class="upload-form">
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="image">Book Image</label>
                <!-- Accept all image formats (JPG, PNG, GIF) -->
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="pdf">PDF File</label>
                <!-- Accept only PDF files -->
                <input type="file" id="pdf" name="pdf" accept="application/pdf" required>
            </div>

            <button type="submit" class="save-btn">Save</button>
        </form>

        <!-- Book List Table -->
        <h2>Uploaded Books</h2>
        <table class="book-table">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Image</th>
                    <th>PDF</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all uploaded books
                $stmt = $pdo->query("SELECT * FROM pdfbook");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td><img src='{$row['image']}' alt='Book Image' width='50'></td>
                            <td><a href='{$row['pdf_file']}' target='_blank'>Download</a></td>
                            <td><button class='delete-btn' onclick='showDeleteConfirm({$row['id']})'>Delete</button></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this book?</p>
            <button class="confirm-btn" id="confirmDeleteBtn">Yes</button>
            <button class="cancel-btn" onclick="closeDeleteModal()">No</button>
        </div>
    </div>

    <script>
        let deleteId = null;

        function showDeleteConfirm(id) {
            deleteId = id;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteId !== null) {
                window.location.href = `addbookpdf.php?delete_id=${deleteId}`;
            }
        });
    </script>

</body>
</html>
