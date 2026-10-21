<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($id <= 0) {
    die("ID siswa tidak valid.");
}

if ($aksi == 'nonaktif') {
    $query = mysqli_query($conn, "UPDATE t_siswa SET status_aktif = 0 WHERE id = $id");

    if (!$query) {
        die("Data siswa gagal dinonaktifkan: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

if ($aksi == 'hapus') {
    mysqli_begin_transaction($conn);

    try {
        // Hapus data pelanggaran siswa
        $hapus_pelanggaran = mysqli_query(
            $conn,
            "DELETE FROM t_pelanggaran_siswa WHERE siswa_id = $id"
        );

        if (!$hapus_pelanggaran) {
            throw new Exception(mysqli_error($conn));
        }

        // Hapus data penempatan siswa
        $hapus_penempatan = mysqli_query(
            $conn,
            "DELETE FROM t_kelas_siswa WHERE siswa_id = $id"
        );

        if (!$hapus_penempatan) {
            throw new Exception(mysqli_error($conn));
        }

        // Hapus data siswa
        $hapus_siswa = mysqli_query(
            $conn,
            "DELETE FROM t_siswa WHERE id = $id"
        );

        if (!$hapus_siswa) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);

        header("Location: index.php");
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        die("Data siswa gagal dihapus: " . $e->getMessage());
    }
}

header("Location: index.php");
exit;
?>