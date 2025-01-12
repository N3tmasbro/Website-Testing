<?php
session_start();

// Cek sesi pengguna
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit();
}

// Ambil data skor dari request
$data = json_decode(file_get_contents("php://input"), true);
$score = intval($data['score']);
$user_id = $_SESSION['user_id'];

// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "starlearn";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Simpan skor ke database
$stmt = $conn->prepare("INSERT INTO scores (user_id, score, created_at) VALUES (?, ?, NOW())");
$stmt->bind_param("ii", $user_id, $score);

if ($stmt->execute()) {
    echo "Score saved successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
