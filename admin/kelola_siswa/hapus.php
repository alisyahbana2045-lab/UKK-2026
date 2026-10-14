<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "
    UPDATE t_siswa
    SET status_aktif = 0
    WHERE id = '$id'
");

if ($query) {
    header("Location: index.php");
    exit;
} else {
    echo "Data gagal dinonaktifkan: " . mysqli_error($conn);
}

?>