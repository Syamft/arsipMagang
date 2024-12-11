<?php
// Mulai sesi
session_start();

// Sertakan koneksi database
require 'assets/includes/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Arsip Penyelenggara</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Banner Section -->
    <div class="banner">
        <div class="navbar">
            <img src="assets/img/logo1.png" class="logo" alt="Logo Bapekom">
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="tentang.php">Tentang Aplikasi</a></li>
                <li><a href="penyelenggara.php">Penyelenggara</a></li>
                <li><a href="ke_tu_an.php">Ke TU an</a></li>
                <li><a href="logout.php">Login Sebagai Admin</a></li>
            </ul>
        </div>

        <!-- Content Section -->
        <div class="content">
            <h1>Arsip Penyelenggara</h1>
            <p>Cari dan lihat dokumen terkait penyelenggaraan pelatihan.</p>
            <form action="" method="POST">
                <label>Cari Dokumen:</label>
                <input type="text" name="search" placeholder="Masukkan kata kunci"
                    value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                    <div class="search-section">
                    <button type="submit" class="button search-button">Cari</button>
                </div>
            </form>
            <br>
            <a href="penyelenggara.php">Unggah Dokumen Baru</a>
            <br><br>
            <!-- Tabel Arsip -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Sub Folder</th>
                        <th>Nama File</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query pencarian, jika ada input dari user
                    $search_query = isset($_POST['search']) ? '%' . trim($_POST['search']) . '%' : '%';

                    // Query untuk mengambil data dokumen hanya dari folder 'Penyelenggaraan_Pelatihan'
                    $sql = "SELECT * FROM tb_dokumen WHERE 
                            (file_name LIKE ? OR description LIKE ? OR sub_folder LIKE ?)
                            AND folder = 'Penyelenggaraan_Pelatihan'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sss', $search_query, $search_query, $search_query);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Menampilkan hasil query
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['sub_folder']); ?></td>
                        <td><?= htmlspecialchars($row['file_name']); ?></td>
                        <td><?= htmlspecialchars($row['description']); ?></td>
                        <td><?= htmlspecialchars($row['upload_date']); ?></td>
                        <td>
                            <!-- Link download ke lokasi file -->
                            <a href="assets/uploads/<?= htmlspecialchars($row['folder']) ?>/<?= htmlspecialchars($row['sub_folder']) ?>/<?= htmlspecialchars($row['file_name']) ?>"
                                download>Download</a>
                            |
                            <!-- Tombol Hapus -->
                            <a href="delete_file.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="5">Tidak ada dokumen ditemukan.</td>
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