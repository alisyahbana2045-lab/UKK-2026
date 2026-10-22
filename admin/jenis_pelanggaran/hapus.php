<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($id <= 0) {
    die("ID jenis pelanggaran tidak valid.");
}

if ($aksi == 'nonaktif') {
    $query = mysqli_query(
        $conn,
        "UPDATE t_pelanggaran SET status_aktif = 0 WHERE id = $id"
    );

    if (!$query) {
        die("Jenis pelanggaran gagal dinonaktifkan: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

if ($aksi == 'hapus') {
    $cek_pelanggaran = mysqli_query(
        $conn,
        "SELECT id FROM t_pelanggaran_siswa WHERE pelanggaran_id = $id LIMIT 1"
    );

    if (!$cek_pelanggaran) {
        die("Query gagal: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($cek_pelanggaran) > 0) {
        die("Jenis pelanggaran tidak bisa dihapus karena sudah digunakan pada data pelanggaran siswa.");
    }

    $query = mysqli_query(
        $conn,
        "DELETE FROM t_pelanggaran WHERE id = $id"
    );

    if (!$query) {
        die("Jenis pelanggaran gagal dihapus: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;
?>