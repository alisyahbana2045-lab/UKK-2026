<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = (int) $_SESSION['user_id'];

// Ambil data guru yang sedang login
$guru_query = mysqli_query($conn, "
    SELECT id, nama
    FROM t_guru
    WHERE user_id = $user_id
    LIMIT 1
");

if (!$guru_query) {
    die("Query guru gagal: " . mysqli_error($conn));
}

$guru = mysqli_fetch_assoc($guru_query);

if (!$guru) {
    die("Data guru tidak ditemukan. Periksa user_id pada tabel t_guru.");
}

$guru_id = (int) $guru['id'];

// Ambil kelas yang sedang diwalikan
$wali_query = mysqli_query($conn, "
    SELECT tahun_ajaran_id, kelas_id
    FROM t_wali_kelas
    WHERE guru_id = $guru_id
    AND status_aktif = 1
    LIMIT 1
");

if (!$wali_query) {
    die("Query wali kelas gagal: " . mysqli_error($conn));
}

$wali = mysqli_fetch_assoc($wali_query);

if (!$wali) {
    die("Data wali kelas aktif tidak ditemukan.");
}

$wali_tahun_ajaran_id = (int) $wali['tahun_ajaran_id'];
$wali_kelas_id = (int) $wali['kelas_id'];

$siswa_id = isset($_GET['siswa_id']) ? (int) $_GET['siswa_id'] : 0;
$tanggal = isset($_GET['tanggal']) ? trim($_GET['tanggal']) : '';

// Filter wajib sesuai kelas wali
$where = "
    WHERE ps.tahun_ajaran_id = $wali_tahun_ajaran_id
    AND ps.kelas_id = $wali_kelas_id
";

if ($siswa_id > 0) {
    $where .= " AND ps.siswa_id = $siswa_id";
}

// Filter berdasarkan satu tanggal
if ($tanggal !== '') {
    $tanggal_valid = DateTime::createFromFormat('Y-m-d', $tanggal);

    if ($tanggal_valid && $tanggal_valid->format('Y-m-d') === $tanggal) {
        $tanggal_sql = mysqli_real_escape_string($conn, $tanggal);
        $where .= " AND ps.tanggal = '$tanggal_sql'";
    }
}

// Ambil data laporan
$query = mysqli_query($conn, "
    SELECT
        ps.*,
        ta.nama AS nama_tahun_ajaran,
        k.nama AS nama_kelas,
        s.nama AS nama_siswa,
        g.nama AS nama_guru
    FROM t_pelanggaran_siswa ps
    LEFT JOIN t_tahun_ajaran ta ON ps.tahun_ajaran_id = ta.id
    LEFT JOIN t_kelas k ON ps.kelas_id = k.id
    LEFT JOIN t_siswa s ON ps.siswa_id = s.id
    LEFT JOIN t_guru g ON ps.guru_id = g.id
    $where
    ORDER BY ps.tanggal DESC, ps.id DESC
");

if (!$query) {
    die("Query laporan gagal: " . mysqli_error($conn));
}

// Nama file Excel
$filename = "Laporan_Pelanggaran_Guru_" . date('Ymd_His') . ".xls";

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
    <tr>
        <th colspan="10">LAPORAN PELANGGARAN SISWA</th>
    </tr>
    <tr>
        <th colspan="10">
            Guru: <?= htmlspecialchars($guru['nama']); ?>
        </th>
    </tr>
    <?php if ($tanggal !== '') { ?>
        <tr>
            <th colspan="10">
                Tanggal: <?= htmlspecialchars(date('d-m-Y', strtotime($tanggal))); ?>
            </th>
        </tr>
    <?php } ?>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Tahun Ajaran</th>
        <th>Kelas</th>
        <th>Nama Siswa</th>
        <th>Pelanggaran</th>
        <th>Poin</th>
        <th>Keterangan</th>
        <th>Tindakan</th>
        <th>Guru Pelapor</th>
    </tr>

    <?php $no = 1; ?>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
            <td><?= htmlspecialchars($data['nama_tahun_ajaran'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($data['nama_kelas'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($data['nama_siswa'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($data['nama_pelanggaran'] ?? '-'); ?></td>
            <td><?= (int) $data['poin']; ?></td>
            <td><?= htmlspecialchars($data['keterangan'] ?: '-'); ?></td>
            <td><?= htmlspecialchars($data['tindakan'] ?: '-'); ?></td>
            <td><?= htmlspecialchars($data['nama_guru'] ?? '-'); ?></td>
        </tr>
    <?php } ?>
</table>