<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID kategori tidak valid.");
}

$id = (int) $_GET['id'];

$query = mysqli_query($conn, "UPDATE t_pelanggaran_kategori SET status_aktif = 0 WHERE id = $id");

if ($query) {
    header("Location: index.php");
    exit;
} else {
    die("Kategori gagal dinonaktifkan: " . mysqli_error($conn));
}
?>