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

session_start(); // Mulai sesi

// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitisasi dan validasi input
    $username_email = htmlspecialchars(trim($_POST['username_email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Batasi panjang input
    if (strlen($username_email) > 50 || strlen($password) > 255) {
        echo "<script>
                alert('Input terlalu panjang. Silakan coba lagi.');
                window.location.href='../pages/login.html';
              </script>";
        exit();
    }

    // Query untuk memeriksa apakah username atau email ada
    $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error pada prepare statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna di sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Redirect ke halaman akun
            header("Location: ../pages/account.php");
            exit();
        } else {
            // Password salah
            echo "<script>
                    alert('Password salah. Silakan coba lagi.');
                    window.location.href='../pages/login.html';
                  </script>";
        }
    } else {
        // Username/email tidak ditemukan
        echo "<script>
                alert('Username atau email tidak ditemukan.');
                window.location.href='../pages/login.html';
              </script>";
    }

    $stmt->close();
}

$conn->close();