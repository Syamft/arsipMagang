<?php
$host = "localhost";      // Host MySQL, biasanya 'localhost'
$dbname = "arsip_digital"; // Nama database yang digunakan
$username = "root";       // Username MySQL, biasanya 'root' untuk lokal
$password = "";           // Password untuk MySQL (kosong jika tidak ada)

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
