<?php
// Include the database configuration file
include('db.php');

// Fetch total members with role 'member'
$query_members = "SELECT COUNT(*) FROM users WHERE role = 'member'";
$stmt_members = $pdo->prepare($query_members);
$stmt_members->execute();
$total_members = $stmt_members->fetchColumn(); // Fetch the count

// Fetch total feedback count
$query_feedback = "SELECT COUNT(*) FROM feedback";
$stmt_feedback = $pdo->prepare($query_feedback);
$stmt_feedback->execute();
$total_feedback = $stmt_feedback->fetchColumn(); // Fetch the count

// Fetch total book count
$query_books = "SELECT COUNT(*) FROM books";
$stmt_books = $pdo->prepare($query_books);
$stmt_books->execute();
$total_books = $stmt_books->fetchColumn(); // Fetch the count

// Fetch book categories and their counts
$query_categories = "SELECT category, COUNT(*) as category_count FROM books GROUP BY category";
$stmt_categories = $pdo->prepare($query_categories);
$stmt_categories->execute();
$category_counts = $stmt_categories->fetchAll(); // Fetch category counts
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Book Categories Section */
        .category-counts {
            margin-top: 40px;
        }

        .category-counts h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Category Bar Container */
        .category-bar-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Individual Category Bar */
        .category-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        /* Category Bar Progress */
        .category-progress {
            height: 20px;
            border-radius: 5px;
            background-color: #4CAF50; /* Green progress bar */
            transition: width 0.3s ease-in-out;
        }

        /* Category Bar Text */
        .category-text {
            font-size: 16px;
            font-weight: bold;
            color: #2f4f4f;
            margin-right: 15px;
        }

        /* Category Count */
        .category-count {
            font-size: 14px;
            color: #555;
        }

        /* Responsive Design for Book Categories */
        @media (max-width: 768px) {
            .category-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-progress {
                width: 100%;
                margin-top: 10px;
            }
        }

    </style>
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

        <!-- Stats Boxes -->
        <div class="stats-boxes">
            <div class="box">
                <h3>Total Members</h3>
                <p><?php echo $total_members; ?></p>
            </div>
            <div class="box">
                <h3>Total Feedback</h3>
                <p><?php echo $total_feedback; ?></p>
            </div>
            <div class="box">
                <h3>Total Books</h3>
                <p><?php echo $total_books; ?></p>
            </div>
        </div>

        <!-- Book Categories with Counts -->
        <div class="category-counts">
            <h3>Book Categories</h3>
            <div class="category-bar-container">
                <?php 
                // Get the max count to scale the progress bars
                $max_count = max(array_column($category_counts, 'category_count'));
                foreach ($category_counts as $category): 
                    $category_percentage = ($category['category_count'] / $max_count) * 100;
                ?>
                    <div class="category-bar">
                        <span class="category-text"><?php echo htmlspecialchars($category['category']); ?>:</span>
                        <div class="category-progress" style="width: <?php echo $category_percentage; ?>%;"></div>
                        <span class="category-count"><?php echo $category['category_count']; ?> books</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>
</html>
