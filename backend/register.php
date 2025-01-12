<?php
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

// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Email tidak valid!');
                window.location.href='../pages/signup.html';
              </script>";
        exit();
    }

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Simpan ke database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Periksa apakah prepare() berhasil
    if (!$stmt) {
        die("Error pada prepare statement: " . $conn->error);
    }

    // Bind parameter dan eksekusi
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registrasi Berhasil!');
                window.location.href='../pages/login.html';
              </script>";
    } else {
        echo "<script>
                alert('Registrasi Gagal. Silakan coba lagi.');
                window.location.href='../pages/signup.html';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>