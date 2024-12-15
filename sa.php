<?php
// Start session if you want to use sessions
session_start();

// Include other files here (if needed)
include('navbar.php');

// Example of PHP code for the Library Page
echo "<h1>Welcome to Our Library</h1>";

echo "<div class='library-container'>";
echo "<div class='library-image'>";
echo "<img src='image/library.png' alt='Library Image'>";
echo "</div>";
echo "<div class='library-description'>";
echo "<p>Our library offers a wide range of books, journals, and digital resources to cater to your learning and research needs. Whether you're looking for the latest bestseller or need access to rare historical texts, we have something for everyone. Visit us today and explore the vast world of knowledge we have to offer!</p>";
echo "</div>";
echo "</div>";

// Add a heading for Categories
echo "<h2>Library Categories</h2>";

echo "<div class='categories-container'>";

// Category 1: Fiction
echo "<div class='category-item'>";
echo "<div class='category-card'>";
echo "<h3><a href='category.php?category=fiction' class='category-link'>Fiction</a></h3>";
echo "<img src='image/fiction.jpg' alt='Fiction Category' class='category-img'>";
echo "<p>This category includes novels, short stories, and literature that explore the imagination. Whether you're a fan of science fiction, fantasy, or classic literary works, this category has something for everyone!</p>";
echo "</div>";
echo "</div>";

// Category 2: Non-Fiction
echo "<div class='category-item'>";
echo "<div class='category-card'>";
echo "<h3><a href='category.php?category=non-fiction' class='category-link'>Non-Fiction</a></h3>";
echo "<img src='image/non-fiction.jpg' alt='Non-Fiction Category' class='category-img'>";
echo "<p>Explore real-world stories, biographies, and factual accounts across various fields, from history to science. This category offers deep insights into the world around us.</p>";
echo "</div>";
echo "</div>";

// Category 3: History
echo "<div class='category-item'>";
echo "<div class='category-card'>";
echo "<h3><a href='category.php?category=history' class='category-link'>History</a></h3>";
echo "<img src='image/history.jpg' alt='History Category' class='category-img'>";
echo "<p>Dive into the past and uncover the events that shaped our world. This category offers books on ancient civilizations, wars, revolutions, and more.</p>";
echo "</div>";
echo "</div>";

// Category 4: Science & Technology
echo "<div class='category-item'>";
echo "<div class='category-card'>";
echo "<h3><a href='category.php?category=science-tech' class='category-link'>Science & Technology</a></h3>";
echo "<img src='image/science-tech.jpg' alt='Science & Technology Category' class='category-img'>";
echo "<p>Stay up-to-date with the latest in scientific discoveries, technological advancements, and research. This category covers everything from physics to computer science.</p>";
echo "</div>";
echo "</div>";

echo "</div>";

// Include footer.php
include('footer.php');
?>

<style>
/* General Styles */
h1, h2 {
  text-align: center;
  margin-bottom: 20px;
}

.library-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 40px;
}

.library-image {
  flex: 1;
  padding: 20px;
}

.library-image img {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.library-description {
  flex: 2;
  padding: 20px;
  font-size: 16px;
}

.categories-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.category-item {
  width: 300px;
  margin: 20px;
}

.category-card {
  border: 1px solid #ddd;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.category-card h3 {
  text-align: center;
}

.category-link {
  text-decoration: none;
  color: #333;
}

.category-img {
  width: 100%;
  height: auto;
  border-radius: 8px;
  margin-bottom: 10px;
}

.category-card p {
  font-size: 14px;
  color: #666;
  text-align: center;
}

/* Media Queries for Responsiveness */

/* Tablets */
@media (max-width: 768px) {
  .library-container {
    flex-direction: column;
    text-align: center;
  }

  .library-image {
    padding: 0;
  }

  .categories-container {
    flex-direction: column;
    align-items: center;
  }

  .category-item {
    width: 80%;
  }
}

/* Mobile devices */
@media (max-width: 480px) {
  h1 {
    font-size: 24px;
  }

  .library-description p {
    font-size: 14px;
  }

  .category-item {
    width: 100%;
  }

  .category-card {
    padding: 15px;
  }

  .category-card p {
    font-size: 12px;
  }
}
</style>
