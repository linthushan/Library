<?php
// Include the database configuration file (your db.php)
include('db.php');

// Fetch users with role 'member'
try {
    $sql = "SELECT id, name, username, email, phone, address, created_at FROM users WHERE role = 'member'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all the results
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching users: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="usermanage.css">
    <script>
        function confirmDelete(userId) {
            const confirmation = confirm("Are you sure you want to delete this user?");
            if (confirmation) {
                window.location.href = 'deletemember.php?id=' + userId;
            }
        }

        function filterUsers() {
            const searchInput = document.getElementById('search-bar').value.toLowerCase();
            const rows = document.querySelectorAll('.user-table tbody tr');
            rows.forEach(row => {
                const nameCell = row.querySelector('td:nth-child(2)');
                const name = nameCell.textContent.toLowerCase();
                row.style.display = name.includes(searchInput) ? '' : 'none';
            });
        }
    </script>
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
        <h1>User Management</h1>
        <p>Manage and view all registered members here.</p>

        <!-- Search Bar -->
        <input type="text" id="search-bar" placeholder="Search by name..." onkeyup="filterUsers()" style="padding: 10px; margin-bottom: 20px; width: 100%; max-width: 400px; font-size: 16px; border: 1px solid #ddd; border-radius: 5px;">

        <!-- User Table -->
        <table class="user-table">
            <thead>
                <tr>
                    <th class="hidden">ID</th> <!-- Hidden column for ID -->
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Joined At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any users in the result
                if ($users) {
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td class='hidden'>" . htmlspecialchars($user['id']) . "</td>"; // Hidden ID
                        echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
                        // Removed Edit button and added Delete button with confirmation
                        echo "<td><button class='delete-btn' onclick='confirmDelete(" . $user['id'] . ")'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No members found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
