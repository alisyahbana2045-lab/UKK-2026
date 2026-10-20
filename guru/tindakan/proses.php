<?php
require_once "../../config/session.php";
require_once "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$tindakan = isset($_POST['tindakan']) ? trim($_POST['tindakan']) : '';

if ($id <= 0 || $tindakan == '') {
    die("Data tindakan tidak valid.");
}

$tindakan = mysqli_real_escape_string($conn, $tindakan);

$query = mysqli_query($conn, "UPDATE t_pelanggaran_siswa
    SET tindakan = '$tindakan',
        status = 'Sudah Ditindak'
    WHERE id = $id");

if ($query) {
    header("Location: index.php");
    exit;
} else {
    die("Tindakan gagal disimpan: " . mysqli_error($conn));
}
?>