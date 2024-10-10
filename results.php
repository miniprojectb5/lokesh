<?php
// Database connection
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = ""; // replace with your MySQL password
$dbname = "mock_test_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch results from the database
$sql = "SELECT name, score, total_questions, created_at FROM results ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>All Results</title>
</head>
<body>
    <div class="container">
        <h1>All Test Results</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Score</th>
                <th>Total Questions</th>
                <th>Date</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo $row['score']; ?></td>
                        <td><?php echo $row['total_questions']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No results found.</td>
                </tr>
            <?php endif; ?>
        </table>
        <p><a href="index.html">Take the Mock Test Again</a></p>
    </div>
</body>
</html>
