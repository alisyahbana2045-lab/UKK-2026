<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($id <= 0) {
    die("ID tahun ajaran tidak valid.");
}

if ($aksi == 'nonaktif') {
    $query = mysqli_query($conn, "UPDATE t_tahun_ajaran SET status_aktif = 0 WHERE id = $id");

    if (!$query) {
        die("Data tahun ajaran gagal dinonaktifkan: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

if ($aksi == 'hapus') {
    $cek_penempatan = mysqli_query(
        $conn,
        "SELECT tahun_ajaran_id FROM t_kelas_siswa WHERE tahun_ajaran_id = $id LIMIT 1"
    );

    if (!$cek_penempatan) {
        die("Query gagal: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($cek_penempatan) > 0) {
        die("Tahun ajaran tidak bisa dihapus karena masih memiliki data penempatan siswa.");
    }

    $query = mysqli_query(
        $conn,
        "DELETE FROM t_tahun_ajaran WHERE id = $id"
    );

    if (!$query) {
        die("Data tahun ajaran gagal dihapus: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;
?>