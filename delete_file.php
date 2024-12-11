<?php
session_start();
require 'assets/includes/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ref = isset($_GET['ref']) ? $_GET['ref'] : 'hasil_arsip_penyelenggara.php'; // Default ke penyelenggara

    // Ambil detail file untuk dihapus
    $sql = "SELECT * FROM tb_dokumen WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = "assets/uploads/" . $row['folder'] . "/" . $row['sub_folder'] . "/" . $row['file_name'];

        // Hapus file fisik dari folder
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus data dari database
        $sql_delete = "DELETE FROM tb_dokumen WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param('i', $id);

        if ($stmt_delete->execute()) {
            header("Location: $ref");
            exit();
        } else {
            echo "Gagal menghapus dokumen.";
        }
    } else {
        echo "Dokumen tidak ditemukan.";
    }
}
?>
