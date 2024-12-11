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

// Mendapatkan tanggal pencarian
$search_date = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_date'])) {
    $search_date = $_POST['search_date']; // Tanggal yang dipilih oleh pengguna
}

// Menentukan query pencarian
$search_query = isset($_POST['search']) ? '%' . trim($_POST['search']) . '%' : '%';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Arsip Ke TU-an</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Banner Section -->
    <div class="banner">
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

        <!-- Content Section -->
        <div class="content">
            <h1>Arsip Ke TU-an</h1>
            <p>Cari dan lihat dokumen terkait kegiatan Ke TU-an.</p>
            <form action="" method="POST">
                <label>Cari Dokumen:</label>
                <input type="text" name="search" placeholder="Masukkan kata kunci" value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">

                <label>Pilih Tanggal:</label>
                <input type="date" name="search_date" value="<?= isset($_POST['search_date']) ? $_POST['search_date'] : ''; ?>">

                <div class="search-section"> 
                    <button type="submit" class="button search-button">Cari</button>
                </div>
            </form>

            <?php if ($search_date): ?>
                <p>Tanggal Pencarian: <?= $search_date; ?></p>
            <?php endif; ?>

            <br>
            <a href="ke_tu_an_admin.php">Unggah Dokumen Baru</a>
            <br><br>
            <!-- Tabel Arsip -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Folder Utama</th>
                        <th>Sub Folder</th>
                        <th>Nama File</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data dokumen terkait Ke TU-an
                    $sql = "SELECT * FROM tb_dokumen WHERE 
                            (file_name LIKE ? OR description LIKE ? OR sub_folder LIKE ?)
                            AND folder IN ('Keuangan_dan_Perbendaharaan', 'Penataan_Kepegawaian', 'Pengelolaan_Asrama', 'Pengelolaan_BMN', 'Perencanaan_dan_Program', 'PPID_ZI_dan_MR')";

                    // Menambahkan filter tanggal jika ada
                    if ($search_date) {
                        $sql .= " AND DATE(upload_date) = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('ssss', $search_query, $search_query, $search_query, $search_date);
                    } else {
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('sss', $search_query, $search_query, $search_query);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Menampilkan hasil query
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['folder']); ?></td>
                        <td><?= htmlspecialchars($row['sub_folder']); ?></td>
                        <td><?= htmlspecialchars($row['file_name']); ?></td>
                        <td><?= htmlspecialchars($row['description']); ?></td>
                        <td><?= htmlspecialchars($row['upload_date']); ?></td>
                        <td>
                            <!-- Link download ke lokasi file -->
                            <a href="assets/uploads/<?= htmlspecialchars($row['folder']) ?>/<?= htmlspecialchars($row['sub_folder']) ?>/<?= htmlspecialchars($row['file_name']) ?>"
                                download>Download</a>
                            |
                            <!-- Tombol Edit -->
                            <a href="edit_file.php?id=<?= $row['id']; ?>&redirect=hasil_arsip_ketuan.php">Edit</a>
                            |
                            <!-- Tombol Hapus -->
                            <a href="delete_file.php?id=<?= $row['id']; ?>&ref=<?= urlencode($_SERVER['PHP_SELF']); ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="6">Tidak ada dokumen ditemukan.</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Bapekom 9 Jayapura | All Rights Reserved</p>
    </footer>
</body>

</html>
