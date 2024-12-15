
<?php
$image = $_GET['image'] ?? null;
$path = 'uploads/' . basename($image); // Prevent directory traversal

if (file_exists($path)) {
    header('Content-Type: ' . mime_content_type($path));
    readfile($path);
    exit;
} else {
    echo 'Image not found';
}
