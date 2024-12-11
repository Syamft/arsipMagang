<?php
session_start();
require 'assets/includes/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dokumen berdasarkan ID
    $sql = "SELECT * FROM tb_dokumen WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Dokumen tidak ditemukan.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_description = $_POST['description'];
    $new_upload_date = $_POST['upload_date']; // Ambil tanggal upload baru

    // Validasi format tanggal
    if (!DateTime::createFromFormat('Y-m-d', $new_upload_date)) {
        echo "Format tanggal tidak valid.";
        exit();
    }

    // Perbarui deskripsi dan tanggal upload
    $sql_update = "UPDATE tb_dokumen SET description = ?, upload_date = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('ssi', $new_description, $new_upload_date, $id);

    if ($stmt_update->execute()) {
        // Ambil nilai redirect dari URL
        $redirect_page = isset($_GET['redirect']) ? $_GET['redirect'] : 'hasil_arsip_penyelenggara.php'; // Default ke hasil_arsip_penyelenggara.php jika tidak ada parameter
        header("Location: $redirect_page"); // Redirect ke halaman yang sesuai
        exit();
    } else {
        echo "Gagal memperbarui dokumen.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokumen</title>
</head>
<body>
    <h1>Edit Dokumen</h1>
    <form action="" method="POST">
        <label>Deskripsi:</label>
        <textarea name="description" rows="5"><?= htmlspecialchars($row['description']); ?></textarea><br>

        <label>Tanggal Upload:</label>
        <input type="date" name="upload_date" value="<?= htmlspecialchars($row['upload_date']); ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <!-- Link kembali sesuai halaman asal -->
    <a href="<?= isset($_GET['redirect']) ? $_GET['redirect'] : 'hasil_arsip_penyelenggara.php'; ?>">Kembali</a>
</body>
</html>
