<?php
// Include the database connection and navigation bar
include('db.php');
include('navbar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Design Example</title>

    <!-- Embedded CSS -->
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Navbar Styling */
        nav {
            background-color: #333;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        nav ul li a:hover {
            background-color: #575757;
        }

        /* Card Container */
        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Card Styling */
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* Card Image */
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Card Content */
        .card-content {
            padding: 15px;
        }

        /* Card Title */
        .card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        /* Card Category */
        .category {
            color: #888;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        /* Card Description */
        .description {
            font-size: 1em;
            color: #555;
        }

        /* Search Bar */
        .search-bar {
            margin: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 1200px) {
            .card-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .card-container {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>

<div class="search-bar">
    <input type="text" id="nameSearch" class="search-input" placeholder="Search by Name" onkeyup="filterCards()">
    <input type="text" id="categorySearch" class="search-input" placeholder="Search by Category" onkeyup="filterCards()">
</div>

<div class="card-container" id="cardContainer">
    <?php
    // Fetch data from the database
    $stmt = $pdo->query("SELECT `id`, `name`, `category`, `description`, `image` FROM `books`");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Store data in variables
        $id = $row['id'];
        $name = htmlspecialchars($row['name']);
        $category = htmlspecialchars($row['category']);
        $description = htmlspecialchars($row['description']);
        $image = htmlspecialchars($row['image']); // Assume the image path is stored in the database
    ?>
    <!-- Dynamic Card -->
    <div class="card" data-name="<?php echo $name; ?>" data-category="<?php echo $category; ?>">
        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="card-image">
        <div class="card-content">
            <h3><?php echo $name; ?></h3>
            <p class="category"><?php echo $category; ?></p>
            <p class="description"><?php echo $description; ?></p>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<?php include('footer.php'); ?>

<script>
    function filterCards() {
        const nameQuery = document.getElementById('nameSearch').value.toLowerCase();
        const categoryQuery = document.getElementById('categorySearch').value.toLowerCase();
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name').toLowerCase();
            const category = card.getAttribute('data-category').toLowerCase();

            if (name.includes(nameQuery) && category.includes(categoryQuery)) {
                card.style.display = 'block'; // Show card
            } else {
                card.style.display = 'none'; // Hide card
            }
        });
    }
</script>

</body>
</html>
