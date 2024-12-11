<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak login, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website E-Arsip Bapekom</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- File CSS terpisah -->
</head>
<body>
    <!-- Banner Section -->
    <div class="banner">
        <!-- Navbar Section -->
        <div class="navbar">
            <img src="assets/img/logo1.png" class="logo" alt="Logo Bapekom"> <!-- Alt ditambahkan -->
            <ul>
                <li><a href="index_admin.php">Beranda</a></li>
                <li><a href="tentang_admin.php">Tentang Aplikasi</a></li>
                <li><a href="penyelenggara_admin.php">Penyelenggara</a></li>
                <li><a href="ke_tu_an_admin.php">Ke TU an</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Content Section -->
        <div class="content home-content">
            <h1>PENGARSIPAN DIGITAL</h1>
            <p>Website Untuk Pengarsipan Digital Bapekom 9 Jayapura,<br>Ini Umum</p>
            <div>
                <button type="button"><span></span>ARSIP</button>
                <button type="button"><span></span>DIGITAL</button>
                <button type="button"><span></span>INSTAGRAM</button>
            </div>

            <!-- Tambahan: Section Info -->
            <section class="info-section">
                <h2>Tentang E-Arsip Bapekom</h2>
                <p>Platform ini menyediakan sistem pengarsipan digital untuk Bapekom 9 Jayapura, yang memudahkan akses dokumen dan arsip dalam format digital. Anda dapat menemukan informasi lebih lanjut tentang aplikasi ini di halaman "Tentang Aplikasi".</p>
            </section>
        </div>
    </div> <!-- Tutup banner -->

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Bapekom 9 Jayapura | All Rights Reserved</p>
    </footer>
</body>
</html>
