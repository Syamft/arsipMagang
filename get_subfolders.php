<?php
if (isset($_GET['folder'])) {
    $folder = $_GET['folder'];
    $dir = "assets/uploads/$folder";
// Menggunakan JSON memungkinkan data dikirim secara mudah dan dapat diproses
    echo json_encode(get_subfolders($dir));
    exit();
}
?>
