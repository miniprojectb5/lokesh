<?php
// view_feedback.php
include 'db_connection.php';

$sql = "SELECT id, name, email, feedback, submitted_at FROM feedbacks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="feedback-container">
        <h1>Submitted Feedback</h1>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div><h3>" . $row["name"] . " (" . $row["email"] . ")</h3>";
                echo "<p>" . $row["feedback"] . "</p>";
                echo "<small>Submitted on " . $row["submitted_at"] . "</small></div><hr>";
            }
        } else {
            echo "No feedback submitted yet.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
