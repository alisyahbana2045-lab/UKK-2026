<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($id <= 0) {
    die("ID wali kelas tidak valid.");
}

if ($aksi == 'nonaktif') {
    $query = mysqli_query(
        $conn,
        "UPDATE t_walikelas SET status_aktif = 0 WHERE id = $id"
    );

    if (!$query) {
        die("Data wali kelas gagal dinonaktifkan: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

if ($aksi == 'hapus') {
    $query = mysqli_query(
        $conn,
        "DELETE FROM t_walikelas WHERE id = $id"
    );

    if (!$query) {
        die("Data wali kelas gagal dihapus: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;
?>