<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$tindakan = isset($_POST['tindakan']) ? trim($_POST['tindakan']) : '';

if ($id <= 0 || $tindakan == '') {
    die("Data tindakan tidak valid.");
}

$tindakan = mysqli_real_escape_string($conn, $tindakan);

$query = mysqli_query($conn, "
    UPDATE t_pelanggaran_siswa
    SET tindakan = '$tindakan',
        status = 'Sudah Ditindak'
    WHERE id = $id
    AND status = 'Belum Ditindak'
    AND guru_id IN (
        SELECT id FROM t_guru WHERE user_id = $user_id
    )
");

if (!$query) {
    die("Tindakan gagal disimpan: " . mysqli_error($conn));
}

if (mysqli_affected_rows($conn) > 0) {
    header("Location: index.php");
    exit;
} else {
    die("Data pelanggaran tidak ditemukan atau sudah ditindak.");
}
?>
