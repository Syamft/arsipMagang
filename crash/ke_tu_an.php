<?php
// Mulai sesi
session_start();


// Sertakan koneksi database
require 'assets/includes/koneksi.php';

// Fungsi untuk mendapatkan daftar sub-folder
function get_subfolders($dir) {
    $subfolders = [];
    if (is_dir($dir)) {
        foreach (scandir($dir) as $item) {
            if ($item != '.' && $item != '..' && is_dir("$dir/$item")) {
                $subfolders[] = $item;
            }
        }
    }
    return $subfolders;
}

// Menangani upload file jika form disubmit
if (isset($_POST['upload'])) {
    $main_folder = $_POST['folder'];
    $sub_folder_input = trim($_POST['sub_folder_input']); // Input sub-folder oleh pengguna
    $sub_folder_select = $_POST['sub_folder_select']; // Sub-folder yang dipilih dari dropdown
    $description = $_POST['description'];

    // Tentukan sub-folder yang akan digunakan
    $sub_folder = $sub_folder_select ?: $sub_folder_input; // Pilih input atau dropdown

    // Tentukan direktori tujuan
    $upload_dir = $sub_folder 
        ? "assets/uploads/$main_folder/$sub_folder/"
        : "assets/uploads/$main_folder/";

    // Validasi: Buat folder jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Proses upload file
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
                    echo "File '$file_name' berhasil diupload ke '$upload_dir'.<br>";

                    // Simpan informasi file ke database
                    $upload_date = date("Y-m-d");

                    $stmt = $conn->prepare("INSERT INTO tb_dokumen (folder, sub_folder, file_name, description, upload_date) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param('sssss', $main_folder, $sub_folder, $file_name, $description, $upload_date);
                    $stmt->execute();
                } else {
                    echo "Gagal mengupload file '$file_name'.<br>";
                }
            } else {
                echo "Error saat mengupload file '$file_name'.<br>";
            }
        }
    }
}

// Dapatkan daftar folder utama
$folders = [
    'Keuangan_dan_Perbendaharaan',
    'Penataan_Kepegawaian',
    'Pengelolaan_Asrama',
    'Pengelolaan_BMN',
    'Perencanaan_dan_Program',
    'PPID_ZI_dan_MR'
];

// Dapatkan sub-folder untuk folder utama yang dipilih
$current_folder = isset($_POST['folder']) ? $_POST['folder'] : '';
$subfolders = $current_folder ? get_subfolders("assets/uploads/$current_folder") : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File Ke TU-an</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Banner Section -->
    <div class="banner">
        <!-- Navbar -->
        <div class="navbar">
            <img src="assets/img/logo1.png" class="logo" alt="Logo Bapekom">
            <ul>
                <li><a href="penyelenggara.php">Penyelenggara</a></li>
                <li><a href="ke_tu_an.php">Ke TU an</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Upload File Ke TU-an</h1>
            <p>Gunakan form di bawah untuk mengunggah dokumen terkait ke TU-an.</p>
            <form action="ke_tu_an.php" method="POST" enctype="multipart/form-data">
                <!-- Folder Tujuan -->
                <div>
                    <label for="folder">Pilih Folder Utama:</label>
                    <select name="folder" id="folder" onchange="this.form.submit()" required>
                        <option value="">-- Pilih Folder Utama --</option>
                        <?php foreach ($folders as $folder): ?>
                            <option value="<?= $folder; ?>" <?= $folder == $current_folder ? 'selected' : ''; ?>><?= $folder; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sub Folder -->
                <div>
                    <label for="sub_folder_select">Pilih Sub Folder yang Ada:</label>
                    <select name="sub_folder_select" id="sub_folder_select">
                        <option value="">-- Pilih Sub-Folder yang Ada --</option>
                        <?php foreach ($subfolders as $subfolder): ?>
                            <option value="<?= $subfolder; ?>"><?= $subfolder; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Upload File -->
                <div>
                    <label for="documents">Upload File:</label>
                    <input type="file" name="documents[]" id="documents" multiple required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description">Deskripsi:</label>
                    <textarea name="description" id="description" placeholder="Masukkan deskripsi dokumen" required></textarea>
                </div>

                <button type="submit" name="upload" class="button upload-button"><span></span>Upload</button>
            </form>

            <a href="arsip_ketuan.php" style="color: dodgerBlue;">Lihat Arsip</a>
        </div>
        <footer>
            <p>&copy; 2024 Bapekom 9 Jayapura | All Rights Reserved</p>
        </footer>
    </div>
</body>
</html>