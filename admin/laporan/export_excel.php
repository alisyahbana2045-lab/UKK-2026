
<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? (int) $_GET['tahun_ajaran_id'] : 0;
$kelas_id = isset($_GET['kelas_id']) ? (int) $_GET['kelas_id'] : 0;
$siswa_id = isset($_GET['siswa_id']) ? (int) $_GET['siswa_id'] : 0;

$tanggal_mulai = isset($_GET['tanggal_mulai']) ? trim($_GET['tanggal_mulai']) : '';
$tanggal_selesai = isset($_GET['tanggal_selesai']) ? trim($_GET['tanggal_selesai']) : '';

// Validasi tanggal
if ($tanggal_mulai != '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_mulai)) {
    $tanggal_mulai = '';
}

if ($tanggal_selesai != '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_selesai)) {
    $tanggal_selesai = '';
}

if (
    $tanggal_mulai != '' &&
    $tanggal_selesai != '' &&
    $tanggal_mulai > $tanggal_selesai
) {
    die("Tanggal mulai tidak boleh melebihi tanggal selesai.");
}

// Filter laporan
$where = "WHERE 1=1";

if ($tahun_ajaran_id > 0) {
    $where .= " AND ps.tahun_ajaran_id = $tahun_ajaran_id";
}

if ($kelas_id > 0) {
    $where .= " AND ps.kelas_id = $kelas_id";
}

if ($siswa_id > 0) {
    $where .= " AND ps.siswa_id = $siswa_id";
}

if ($tanggal_mulai != '') {
    $mulai_sql = mysqli_real_escape_string($conn, $tanggal_mulai);
    $where .= " AND DATE(ps.tanggal) >= '$mulai_sql'";
}

if ($tanggal_selesai != '') {
    $selesai_sql = mysqli_real_escape_string($conn, $tanggal_selesai);
    $where .= " AND DATE(ps.tanggal) <= '$selesai_sql'";
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
    die("Query gagal: " . mysqli_error($conn));
}

$filename = "Laporan_Pelanggaran_" . date('Ymd_His') . ".xls";

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
        <th>No</th>
        <th>Tanggal</th>
        <th>Tahun Ajaran</th>
        <th>Kelas</th>
        <th>Nama Siswa</th>
        <th>Pelanggaran</th>
        <th>Poin</th>
        <th>Keterangan</th>
        <th>Tindakan</th>
        <th>Guru</th>
    </tr>

    <?php $no = 1; ?>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['tanggal'] ?? '-'); ?></td>
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
