
<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

// =====================================
// CEK AKUN GURU
// =====================================

if ($_SESSION['user_role'] !== 'guru') {
    header("Location: /UKK-2026/dashboard.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

if (
    !isset($_GET['id'], $_GET['tahun_ajaran_id']) ||
    !is_numeric($_GET['id']) ||
    !is_numeric($_GET['tahun_ajaran_id'])
) {
    header("Location: index.php");
    exit;
}

$siswa_id = (int) $_GET['id'];
$tahun_ajaran_id = (int) $_GET['tahun_ajaran_id'];

// =====================================
// AMBIL DATA GURU
// =====================================

$query_guru = mysqli_query($conn, "
    SELECT id
    FROM t_guru
    WHERE user_id = $user_id
    AND status_aktif = 1
    LIMIT 1
");

if (!$query_guru || mysqli_num_rows($query_guru) == 0) {
    die("Data guru tidak ditemukan.");
}

$data_guru = mysqli_fetch_assoc($query_guru);
$guru_id = (int) $data_guru['id'];

// =====================================
// CEK PENUGASAN WALI KELAS
// =====================================

$stmt_wali = mysqli_prepare($conn, "
    SELECT wk.kelas_id, k.nama AS nama_kelas, ta.nama AS nama_tahun
    FROM t_wali_kelas wk
    INNER JOIN t_kelas k ON wk.kelas_id = k.id
    INNER JOIN t_tahun_ajaran ta ON wk.tahun_ajaran_id = ta.id
    WHERE wk.guru_id = ?
    AND wk.tahun_ajaran_id = ?
    AND wk.status_aktif = 1
");

mysqli_stmt_bind_param($stmt_wali, "ii", $guru_id, $tahun_ajaran_id);
mysqli_stmt_execute($stmt_wali);

$hasil_wali = mysqli_stmt_get_result($stmt_wali);

$daftar_kelas = [];
while ($wali = mysqli_fetch_assoc($hasil_wali)) {
    $daftar_kelas[] = $wali;
}

mysqli_stmt_close($stmt_wali);

if (count($daftar_kelas) == 0) {
    die("Kamu tidak memiliki akses ke rekap kelas ini.");
}

$kelas_ids = array_map('intval', array_column($daftar_kelas, 'kelas_id'));
$kelas_id_sql = implode(',', $kelas_ids);

// =====================================
// CEK PENEMPATAN SISWA
// =====================================

$query_siswa = mysqli_query($conn, "
    SELECT
        s.id,
        s.nis,
        s.nama,
        k.nama AS nama_kelas,
        ks.kelas_id
    FROM t_kelas_siswa ks
    INNER JOIN t_siswa s ON ks.siswa_id = s.id
    INNER JOIN t_kelas k ON ks.kelas_id = k.id
    WHERE ks.siswa_id = $siswa_id
    AND ks.tahun_ajaran_id = $tahun_ajaran_id
    AND ks.kelas_id IN ($kelas_id_sql)
    AND ks.status_aktif = 1
    LIMIT 1
");

if (!$query_siswa || mysqli_num_rows($query_siswa) == 0) {
    die("Data siswa tidak ditemukan atau bukan bagian dari kelas yang kamu ampu.");
}

$siswa = mysqli_fetch_assoc($query_siswa);
$kelas_id = (int) $siswa['kelas_id'];

// =====================================
// AMBIL RIWAYAT PELANGGARAN
// =====================================

$stmt_pelanggaran = mysqli_prepare($conn, "
    SELECT
        tanggal,
        nama_pelanggaran,
        poin,
        keterangan,
        nama_guru,
        tindakan,
        status
    FROM t_pelanggaran_siswa
    WHERE siswa_id = ?
    AND tahun_ajaran_id = ?
    AND kelas_id = ?
    ORDER BY tanggal DESC, id DESC
");

mysqli_stmt_bind_param(
    $stmt_pelanggaran,
    "iii",
    $siswa_id,
    $tahun_ajaran_id,
    $kelas_id
);

mysqli_stmt_execute($stmt_pelanggaran);
$query_pelanggaran = mysqli_stmt_get_result($stmt_pelanggaran);

// =====================================
// HITUNG RINGKASAN
// =====================================

$total_pelanggaran = 0;
$total_poin = 0;

while ($item = mysqli_fetch_assoc($query_pelanggaran)) {
    $total_pelanggaran++;
    $total_poin += (int) $item['poin'];
}

mysqli_data_seek($query_pelanggaran, 0);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggaran Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .main-content {
            margin-left: 16.666667%;
            padding: 30px;
        }

        .menu-sidebar {
            color: white;
            background-color: transparent;
            transition: 0.3s;
        }

        .menu-sidebar:hover,
        .menu-sidebar.active {
            color: white;
            background-color: #0d6efd;
        }

        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <?php require_once "../../layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">

            <div class="mb-4">
                <h2 class="fw-bold mb-1">Detail Pelanggaran Siswa</h2>
                <p class="text-muted mb-0">
                    Riwayat pelanggaran siswa pada tahun ajaran terpilih.
                </p>
            </div>

            <!-- IDENTITAS SISWA -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-muted">NIS</div>
                            <strong><?= htmlspecialchars($siswa['nis']); ?></strong>
                        </div>

                        <div class="col-md-4">
                            <div class="text-muted">Nama Siswa</div>
                            <strong><?= htmlspecialchars($siswa['nama']); ?></strong>
                        </div>

                        <div class="col-md-4">
                            <div class="text-muted">Kelas</div>
                            <strong><?= htmlspecialchars($siswa['nama_kelas']); ?></strong>
                        </div>

                        <div class="col-md-4">
                            <div class="text-muted">Tahun Ajaran</div>
                            <strong><?= htmlspecialchars($daftar_kelas[0]['nama_tahun']); ?></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RINGKASAN -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="text-muted">Jumlah Pelanggaran</div>
                            <h3 class="fw-bold mb-0"><?= $total_pelanggaran; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="text-muted">Total Poin</div>
                            <h3 class="fw-bold mb-0"><?= $total_poin; ?> Poin</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIWAYAT PELANGGARAN -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Riwayat Pelanggaran</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Keterangan</th>
                                    <th>Guru Pencatat</th>
                                    <th>Tindakan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;

                                if (mysqli_num_rows($query_pelanggaran) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_pelanggaran)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                        <td><?= htmlspecialchars($row['nama_pelanggaran']); ?></td>
                                        <td>
                                            <span class="badge text-bg-danger">
                                                <?= (int) $row['poin']; ?> Poin
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($row['keterangan'] ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($row['nama_guru'] ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($row['tindakan'] ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($row['status'] ?? '-'); ?></td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            Siswa ini belum memiliki catatan pelanggaran.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <a href="index.php?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>"
                       class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Rekap Kelas
                    </a>

                </div>
            </div>

        </main>
    </div>
</div>
</body>
</html>

<?php
mysqli_stmt_close($stmt_pelanggaran);
?>
