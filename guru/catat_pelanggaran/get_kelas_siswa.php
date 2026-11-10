<?php

require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

header('Content-Type: application/json');

$siswa_id = isset($_GET['siswa_id'])
    ? (int) $_GET['siswa_id']
    : 0;

if ($siswa_id <= 0) {

    echo json_encode([
        'success' => false,
        'message' => 'Siswa tidak valid.'
    ]);

    exit;
}

// Mengambil tahun ajaran dan kelas siswa
$query = mysqli_query($conn, "
    SELECT
        s.id AS siswa_id,
        ta.id AS tahun_ajaran_id,
        ta.nama AS tahun_ajaran,
        k.id AS kelas_id,
        k.nama AS nama_kelas

    FROM t_siswa s

    INNER JOIN t_kelas_siswa ks
        ON s.id = ks.siswa_id

    INNER JOIN t_kelas k
        ON ks.kelas_id = k.id

    INNER JOIN t_tahun_ajaran ta
        ON ks.tahun_ajaran_id = ta.id

    WHERE s.id = '$siswa_id'
    AND s.status_aktif = 1
    AND ks.status_aktif = 1
    AND ta.status_aktif = 1

    ORDER BY ks.id DESC
    LIMIT 1
");

if (!$query) {

    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengambil data: ' . mysqli_error($conn)
    ]);

    exit;
}

$data = mysqli_fetch_assoc($query);

if (!$data) {

    echo json_encode([
        'success' => false,
        'message' => 'Penempatan kelas atau tahun ajaran siswa tidak ditemukan.'
    ]);

    exit;
}

// Mengirim data ke JavaScript
echo json_encode([
    'success' => true,
    'tahun_ajaran_id' => $data['tahun_ajaran_id'],
    'tahun_ajaran' => $data['tahun_ajaran'],
    'kelas_id' => $data['kelas_id'],
    'nama_kelas' => $data['nama_kelas']
]);

?>