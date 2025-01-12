<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "starlearn";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT u.username, s.score, s.created_at 
                        FROM scores s 
                        JOIN users u ON s.user_id = u.id 
                        ORDER BY s.score DESC, s.created_at ASC 
                        LIMIT 10");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Leaderboard</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$rank}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['created_at']}</td>
                            <td>{$row['score']}</td>
                          </tr>";
                    $rank++;
                }
                ?>
            </tbody>
        </table>
        <a href="quiz.php" class="btn btn-primary">Back to Quiz</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
