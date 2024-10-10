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

// Correct answers
$correctAnswers = [
    "q1" => "B",
    "q2" => "B",
    "q3" => "B",
    "q4" => "D"
];

$score = 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : ''; // Make sure to sanitize the input
$results = [];

// Calculate score
foreach ($correctAnswers as $question => $correctAnswer) {
    if (isset($_POST[$question]) && $_POST[$question] == $correctAnswer) {
        $score++;
        $results[$question] = ["Your Answer: " . $_POST[$question], "Correct!"];
    } else {
        $results[$question] = ["Your Answer: " . ($_POST[$question] ?? 'Not Answered'), "Correct Answer: " . $correctAnswer];
    }
}

// Save results to the database
$totalQuestions = count($correctAnswers);
$stmt = $conn->prepare("INSERT INTO results (name, score, total_questions) VALUES (?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("sii", $name, $score, $totalQuestions);
    $stmt->execute();
    $stmt->close();
} else {
    die("Prepare failed: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Test Results</title>
</head>
<body>
    <div class="container">
        <h1>Test Results</h1>
        <p>Your name: <?php echo htmlspecialchars($name); ?></p>
        <p>Your score: <?php echo $score; ?>/<?php echo $totalQuestions; ?></p>
        
        <h2>Results</h2>
        <?php foreach ($results as $question => $result): ?>
            <p><?php echo $question; ?>: <?php echo $result[0]; ?> - <?php echo $result[1]; ?></p>
        <?php endforeach; ?>
        
        <p><a href="results.php">View All Results</a></p>
    </div>
</body>
</html>
