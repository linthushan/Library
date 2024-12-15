<?php
// Check if the file parameter exists in the URL
if (isset($_GET['file'])) {
  $file = $_GET['file'];
  $filePath = "pdfs/" . $file; // Folder where your PDF files are stored

  // Check if the file exists
  if (file_exists($filePath)) {
    // Set the headers for downloading the file
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    readfile($filePath); // Output the file content
    exit;
  } else {
    echo "File not found.";
  }
} else {
  echo "No file specified.";
}
?>
