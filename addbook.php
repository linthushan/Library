<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Form</title>
    <link rel="stylesheet" href="addbook.css">
</head>
<body>

    <div class="form-container">
        <h2>Add a New Book</h2>
        <form action="processbook.php" method="POST" enctype="multipart/form-data">
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="book_image">Upload Image:</label>
            <input type="file" id="book_image" name="book_image" accept="image/*" required>

            <div class="buttons">
                <button type="submit" name="save" class="btn-save">Save</button>
                <button type="button" onclick="window.history.back();" class="btn-cancel">Cancel</button>
            </div>
        </form>
    </div>

</body>
</html>
