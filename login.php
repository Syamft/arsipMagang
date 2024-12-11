<?php
// Sertakan file koneksi database
require 'assets/includes/koneksi.php';

// Inisialisasi variabel error
$error = '';

// Proses form login
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $sql = "SELECT * FROM tb_login WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // 's' menunjukkan bahwa parameter adalah string
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah user ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Periksa apakah password cocok
        if ($password === $user['password']) {  // Memeriksa password tanpa hash
            // Login berhasil, redirect ke halaman index_admin.php
            session_start();
            $_SESSION['username'] = $user['username']; // Simpan username ke session
            header("Location: index_admin.php"); // Redirect ke halaman index_admin.php
            exit();
        } else {
            // Jika password tidak cocok
            $error = "Username atau password salah.";
        }
    } else {
        // Jika username tidak ditemukan
        $error = "Username atau password salah.";
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login | Earsip</title>
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Login</span>
            </div>
            <img src="assets/img/logo.png" class="logo" alt="Logo Bapekom">
            <h1>E-Arsip Digital Bapekom</h1>
            <?php if (!empty($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="input_box">
                    <input type="text" name="username" id="user" class="input-field" required>
                    <label for="user" class="label">Username</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" name="password" id="pass" class="input-field" required>
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="forgot">
                    </div>
                <div class="input_box">
                    <input type="submit" class="input-submit" value="Login" name="login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
