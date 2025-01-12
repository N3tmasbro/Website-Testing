<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "starlearn";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Pengguna tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account - STARLearn</title>
  <link rel="stylesheet" href="../css/account.css">
</head>

<body>
  <header>
    <a href="../pages/home.html" style="text-decoration: none;">
      <h1 class='logo'>STARLearn</h1>
    </a>
    <nav>
      <a href="../pages/home.html">Home</a>
      <a href="../pages/courses.html">All Courses</a>
      <a href="../pages/quiz.html">Quiz</a>
      <a href="account.php" style="font-weight: bolder; background-color:lightgrey ;">My Account</a>
      <a href="../backend/logout.php">Log out</a>
    </nav>
    <div class="separator"></div>
  </header>
  <main>
    <div class="outer-container">
      <div class="img-container">
        <img id="profileImage" src="../background/user1.png" />
        <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture>
      </div>
      <div class="detail-container">
        <p>
          <label>First name : </label>
          <input type="text" value="<?= htmlspecialchars($user['username']); ?>" readonly>
        </p>
        <p>
          <label>Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <input type="email" value="<?= htmlspecialchars($user['email']); ?>" readonly>
        </p>
        <p>
          <label>Password : &nbsp;</label>
          <input type="password" value="********" readonly>
        </p>
      </div>
    </div>
  </main>
  <footer>
    <p class="p1"> Happy Learning with STARLearn </p>
    <p class="p2"> Make a part of your journey with us. Enroll now ! </p>
    <hr>
    <p class="p3"><small>Copyright &copy; 2024 tes</small></p>
  </footer>
</body>

</html>
