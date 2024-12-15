<?php
// Include the database connection file
include('db.php');

// Check if form is submitted
if (isset($_POST['save'])) {
    // Sanitize and assign input values
    $book_name = htmlspecialchars($_POST['book_name']);
    $category = htmlspecialchars($_POST['category']);
    $description = htmlspecialchars($_POST['description']);
    
    // Handle file upload
    if (isset($_FILES['book_image']) && $_FILES['book_image']['error'] == 0) {
        $fileTmpPath = $_FILES['book_image']['tmp_name'];
        $fileName = $_FILES['book_image']['name'];
        $fileSize = $_FILES['book_image']['size'];
        $fileType = $_FILES['book_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Validate file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Create a new file name to avoid conflict
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadPath = 'uploads/' . $newFileName;

            // Move uploaded file to the desired folder
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // Prepare the SQL query to insert the book data
                $query = "INSERT INTO books (name, category, description, image) 
                          VALUES (:book_name, :category, :description, :image)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':book_name', $book_name);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image', $uploadPath);

                // Execute the query
                if ($stmt->execute()) {
                    // Display success message and redirect
                    echo "<p>Book added successfully. Redirecting...</p>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'bookmanage.php?status=success';
                            }, 3000); // 3 seconds delay
                          </script>";
                    exit();
                } else {
                    echo "Error while saving data.";
                }
            } else {
                echo "There was an error uploading the file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
