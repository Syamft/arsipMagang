<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan koneksi database
require 'assets/includes/koneksi.php';

// Menangani upload file jika form disubmit
if (isset($_POST['upload'])) {
    // Folder tujuan tempat file akan diupload
    $folder = "Penyelenggaraan_Pelatihan"; // Folder yang sudah ditentukan
    $sub_folder = $_POST['sub_folder'] ?? ''; // Mendapatkan sub-folder dari input (kosong jika tidak diisi)
    $description = $_POST['description'];
    $custom_date = $_POST['custom_date'] ?? date("Y-m-d"); // Tanggal upload, default ke tanggal hari ini jika kosong

    // Validasi format tanggal
    if (!DateTime::createFromFormat('Y-m-d', $custom_date)) {
        echo "Format tanggal tidak valid.";
        exit();
    }

    // Tentukan direktori untuk menyimpan file
    $upload_dir = $sub_folder 
        ? "assets/uploads/$folder/$sub_folder/" 
        : "assets/uploads/$folder/";

    // Jika folder tujuan belum ada, buat folder tersebut
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Proses upload file
    $success = true; // Penanda untuk status upload

    if (isset($_FILES['documents']) && !empty($_FILES['documents']['name'][0])) {
        $files = $_FILES['documents'];
        $file_count = count($files['name']);

        for ($i = 0; $i < $file_count; $i++) {
            $file_name = $files['name'][$i];
            $file_tmp = $files['tmp_name'][$i];
            $file_error = $files['error'][$i];

            // Tentukan lokasi file yang diupload
            $file_path = $upload_dir . basename($file_name);

            // Cek apakah ada error dalam upload file
            if ($file_error === UPLOAD_ERR_OK) {
                // Pindahkan file ke folder tujuan
                if (move_uploaded_file($file_tmp, $file_path)) {
                    // Simpan informasi file ke database
                    $stmt = $conn->prepare("INSERT INTO tb_dokumen (folder, sub_folder, file_name, description, upload_date) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param('sssss', $folder, $sub_folder, $file_name, $description, $custom_date);
                    $stmt->execute();
                } else {
                    $success = false;
                }
            } else {
                $success = false;
            }
        }

        // Tampilkan notifikasi sederhana
        if ($success) {
            echo "Upload berhasil.";
        } else {
            echo "Dokumen gagal diupload.";
        }
    } else {
        echo "Tidak ada file yang diupload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File Penyelenggara</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Banner Section -->
    <div class="banner">
        <!-- Navbar -->
        <div class="navbar">
            <img src="assets/img/logo1.png" class="logo" alt="Logo Bapekom">
            <ul>
                <li><a href="index_admin.php">Beranda</a></li>
                <li><a href="tentang_admin.php">Tentang Aplikasi</a></li>
                <li><a href="penyelenggara_admin.php">Penyelenggara</a></li>
                <li><a href="ke_tu_an_admin.php">Ke TU an</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Upload File Penyelenggara</h1>
            <p>Gunakan form di bawah untuk mengunggah dokumen terkait kegiatan penyelenggaraan pelatihan.</p>
            <form action="penyelenggara_admin.php" method="POST" enctype="multipart/form-data">
                <!-- Folder Tujuan dan Sub Folder bersebelahan dan berada di tengah -->
                <div class="form-row">
                    <div>
                        <label for="folder">Pilih Folder:</label>
                        <select name="folder" id="folder" required>
                            <option value="Penyelenggaraan_Pelatihan">Penyelenggaraan Pelatihan</option>
                        </select>
                    </div>
                    <div>
                        <label for="sub_folder">Sub Folder (Opsional):</label>
                        <input type="text" name="sub_folder" id="sub_folder"
                            placeholder="Masukkan sub-folder baru (opsional)">
                    </div>
                </div>

                <!-- Pilih Tanggal -->
                <div>
                    <label for="custom_date">Tanggal Upload (Opsional):</label>
                    <input type="date" name="custom_date" id="custom_date" value="<?= date("Y-m-d"); ?>">
                </div>

                <!-- Upload File -->
                <div>
                    <label for="documents">Upload File:</label>
                    <input type="file" name="documents[]" id="documents" multiple required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description">Deskripsi:</label>
                    <textarea name="description" id="description" placeholder="Masukkan deskripsi dokumen"
                        required></textarea>
                </div>

                <button type="submit" name="upload" class="button upload-button"><span></span>Upload</button>
            </form>

            <a href="hasil_arsip_penyelenggara.php" style="color: dodgerBlue;">Lihat Arsip</a>
        </div>
        <footer>
            <p>&copy; 2024 Bapekom 9 Jayapura | All Rights Reserved</p>
        </footer>
</body>

</html>