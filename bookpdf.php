<?php
include('db.php'); // Including your existing db.php connection

// Fetch books from the database
$sql = "SELECT `id`, `name`, `image`, `pdf_file`, `created_at` FROM `pdfbook` WHERE 1";
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details</title>
  <link rel="stylesheet" href="bookpdf.css">
</head>
<body>
  <!-- Navbar -->
  <?php include('navbar.php'); ?>

  <!-- Search Bar -->
  <div class="search-container">
    <input type="text" id="search" placeholder="Search by book name...">
  </div>

  <!-- Book Cards Section -->
  <div class="book-cards-container" id="book-cards-container">
    <?php
    if ($books) {
      foreach ($books as $row) {
        // Format the upload date to a readable format (optional)
        $uploadDate = date("F j, Y", strtotime($row['created_at']));
        ?>
        <div class="book-card" data-name="<?php echo strtolower($row['name']); ?>">
          <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="book-image">
          <h3><?php echo $row['name']; ?></h3>
          <p class="upload-date">Uploaded on: <?php echo $uploadDate; ?></p>
          <a href="download.php?file=<?php echo urlencode($row['pdf_file']); ?>" class="download-btn">Download PDF</a>
        </div>
        <?php
      }
    } else {
      echo "<p>No books found.</p>";
    }
    ?>
  </div>

  <script>
    // Search functionality
    document.getElementById('search').addEventListener('input', function() {
      const searchQuery = this.value.toLowerCase();
      const cards = document.querySelectorAll('.book-card');

      cards.forEach(card => {
        const bookName = card.getAttribute('data-name');
        if (bookName.includes(searchQuery)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
