<?php
// Include database connection
require_once 'db.php';

try {
    // Prepare the SQL query
    $stmt = $pdo->prepare("SELECT `id`, `name`, `email`, `description`, `created_at` FROM `feedback` WHERE 1");
    $stmt->execute(); // Execute the query
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
} catch (PDOException $e) {
    die("Error fetching feedback: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <!-- Font Awesome for person icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            color: #2c3e50;
        }

        .container1 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .feedback-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .feedback-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .feedback-card .header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feedback-card .header i {
            font-size: 2.5em;
            color: #3498db;
            margin-right: 15px;
        }

        .feedback-card h3 {
            font-size: 1.5em;
            color: #2980b9;
            margin: 0;
        }

        .feedback-card p {
            color: #7f8c8d;
            font-size: 1.1em;
            line-height: 1.5;
            margin: 10px 0;
        }

        .feedback-card small {
            font-size: 0.9em;
            color: #bdc3c7;
            text-align: right;
            display: block;
            margin-top: 15px;
        }

        .feedback-card .email {
            color: #3498db;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .feedback-card {
                padding: 15px;
            }

            h1 {
                font-size: 2em;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>

    <h1>Customer Feedback</h1>
    <div class="container1">
        <?php foreach ($feedbacks as $feedback): ?>
            <div class="feedback-card">
                <div class="header">
                    <!-- Person icon (Font Awesome) -->
                    <i class="fas fa-user-circle"></i>
                    <div>
                        <h3><?php echo htmlspecialchars($feedback['name']); ?></h3>
                        <p class="email"><?php echo htmlspecialchars($feedback['email']); ?></p>
                    </div>
                </div>
                <p><?php echo nl2br(htmlspecialchars($feedback['description'])); ?></p>
                <small>Posted on: <?php echo date('F j, Y', strtotime($feedback['created_at'])); ?></small>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
