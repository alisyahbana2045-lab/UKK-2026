<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($id <= 0) {
    die("ID guru tidak valid.");
}

if ($aksi == 'nonaktif') {

    $query = mysqli_query($conn, "UPDATE t_guru
        SET status_aktif = 0
        WHERE id = $id");

    if (!$query) {
        die("Data guru gagal dinonaktifkan: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

if ($aksi == 'hapus') {

    $query_guru = mysqli_query($conn, "SELECT user_id
        FROM t_guru
        WHERE id = $id");

    if (!$query_guru) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $guru = mysqli_fetch_assoc($query_guru);

    if (!$guru) {
        die("Data guru tidak ditemukan.");
    }

    $user_id = (int) $guru['user_id'];

    mysqli_begin_transaction($conn);

    try {

        $hapus_guru = mysqli_query($conn, "DELETE FROM t_guru WHERE id = $id");

        if (!$hapus_guru) {
            throw new Exception(mysqli_error($conn));
        }

        $hapus_user = mysqli_query($conn, "DELETE FROM t_users WHERE id = $user_id");

        if (!$hapus_user) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);

        header("Location: index.php");
        exit;

    } catch (Exception $e) {

        mysqli_rollback($conn);

        die("Data guru gagal dihapus: " . $e->getMessage());
    }
}

header("Location: index.php");
exit;
?>