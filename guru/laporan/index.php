<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = (int) $_SESSION['user_id'];

$guru_query = mysqli_query($conn, "
    SELECT id, nama
    FROM t_guru
    WHERE user_id = $user_id
    LIMIT 1
");

$guru = mysqli_fetch_assoc($guru_query);

if (!$guru) {
    die("Data guru tidak ditemukan.");
}

$guru_id = (int) $guru['id'];

$wali_query = mysqli_query($conn, "
    SELECT wk.id, wk.tahun_ajaran_id, wk.kelas_id,
           ta.nama AS nama_tahun_ajaran,
           k.nama AS nama_kelas
    FROM t_wali_kelas wk
    INNER JOIN t_tahun_ajaran ta ON wk.tahun_ajaran_id = ta.id
    INNER JOIN t_kelas k ON wk.kelas_id = k.id
    WHERE wk.guru_id = $guru_id
    AND wk.status_aktif = 1
    LIMIT 1
");

$wali = mysqli_fetch_assoc($wali_query);

if (!$wali) {
    header("Location: /UKK-2026/dashboard.php");
    exit;
}

$wali_tahun_ajaran_id = (int) $wali['tahun_ajaran_id'];
$wali_kelas_id = (int) $wali['kelas_id'];

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? (int) $_GET['tahun_ajaran_id'] : $wali_tahun_ajaran_id;
$kelas_id = isset($_GET['kelas_id']) ? (int) $_GET['kelas_id'] : $wali_kelas_id;
$siswa_id = isset($_GET['siswa_id']) ? (int) $_GET['siswa_id'] : 0;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$per_page = 10;
$offset = ($page - 1) * $per_page;

$where = "
    WHERE ps.tahun_ajaran_id = $wali_tahun_ajaran_id
    AND ps.kelas_id = $wali_kelas_id
";

if ($siswa_id > 0) {
    $where .= " AND ps.siswa_id = $siswa_id";
}

$tahun_ajaran = mysqli_query($conn, "
    SELECT id, nama
    FROM t_tahun_ajaran
    WHERE id = $wali_tahun_ajaran_id
");

$kelas = mysqli_query($conn, "
    SELECT id, nama
    FROM t_kelas
    WHERE id = $wali_kelas_id
");

$siswa = mysqli_query($conn, "
    SELECT DISTINCT s.id, s.nama
    FROM t_siswa s
    INNER JOIN t_pelanggaran_siswa ps ON ps.siswa_id = s.id
    WHERE ps.tahun_ajaran_id = $wali_tahun_ajaran_id
    AND ps.kelas_id = $wali_kelas_id
    ORDER BY s.nama ASC
");

$count_query = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM t_pelanggaran_siswa ps
    $where
");

$count_data = mysqli_fetch_assoc($count_query);
$total_data = (int) $count_data['total'];
$total_pages = $total_data > 0 ? ceil($total_data / $per_page) : 1;

$total_poin_query = mysqli_query($conn, "
    SELECT COALESCE(SUM(ps.poin), 0) AS total_poin
    FROM t_pelanggaran_siswa ps
    $where
");

$total_poin_data = mysqli_fetch_assoc($total_poin_query);
$total_poin = (int) $total_poin_data['total_poin'];

$query = mysqli_query($conn, "
    SELECT
        ps.*,
        ta.nama AS nama_tahun_ajaran,
        k.nama AS nama_kelas,
        s.nama AS nama_siswa
    FROM t_pelanggaran_siswa ps
    LEFT JOIN t_tahun_ajaran ta ON ps.tahun_ajaran_id = ta.id
    LEFT JOIN t_kelas k ON ps.kelas_id = k.id
    LEFT JOIN t_siswa s ON ps.siswa_id = s.id
    $where
    ORDER BY ps.tanggal DESC, ps.id DESC
    LIMIT $offset, $per_page
");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Sistem Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f1f3f5;
        }
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
        .stat-card {
            border: none;
            border-radius: 12px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background-color: #212529;
            color: white;
            font-size: 22px;
        }
        .table th {
            background-color: #212529;
            color: white;
            white-space: nowrap;
        }
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 25%;
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
                <h1 class="fw-bold mb-1">Laporan Pelanggaran</h1>
                <p class="text-muted mb-0">
                    Laporan pelanggaran siswa di kelas yang Anda walikan.
                </p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="stat-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted">Total Pelanggaran</small>
                                <h3 class="fw-bold mb-0"><?= $total_data; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="stat-icon">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted">Total Poin</small>
                                <h3 class="fw-bold mb-0"><?= $total_poin; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-select">
                                <option value="0">Semua Tahun Ajaran</option>
                                <?php while ($ta = mysqli_fetch_assoc($tahun_ajaran)) { ?>
                                    <option value="<?= $ta['id']; ?>" <?= ($tahun_ajaran_id == $ta['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($ta['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-select">
                                <option value="0">Semua Kelas</option>
                                <?php while ($k = mysqli_fetch_assoc($kelas)) { ?>
                                    <option value="<?= $k['id']; ?>" <?= ($kelas_id == $k['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($k['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Siswa</label>
                            <select name="siswa_id" class="form-select">
                                <option value="0">Semua Siswa</option>
                                <?php while ($s = mysqli_fetch_assoc($siswa)) { ?>
                                    <option value="<?= $s['id']; ?>" <?= ($siswa_id == $s['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($s['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cari
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">
                                <i class="bi bi-file-earmark-text"></i>
                                Data Laporan
                            </h5>
                            <small class="text-muted">
                                Guru: <?= htmlspecialchars($guru['nama']); ?>
                            </small>
                        </div>

                        <a href="cetak.php?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>&kelas_id=<?= $kelas_id; ?>&siswa_id=<?= $siswa_id; ?>"
                           target="_blank"
                           class="btn btn-dark">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Keterangan</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <?php $no = $offset + 1; ?>
                                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                                            <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
                                            <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                                            <td><?= htmlspecialchars($data['nama_pelanggaran']); ?></td>
                                            <td>
                                                <span class="badge bg-danger">
                                                    <?= (int) $data['poin']; ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($data['keterangan'] ?: '-'); ?></td>
                                            <td><?= htmlspecialchars($data['tindakan'] ?: '-'); ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                            Belum ada data pelanggaran.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($total_pages > 1) { ?>
                        <div class="d-flex justify-content-end mt-3">
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                        <a class="page-link"
                                           href="?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>&kelas_id=<?= $kelas_id; ?>&siswa_id=<?= $siswa_id; ?>&page=<?= $page - 1; ?>">
                                            Sebelumnya
                                        </a>
                                    </li>

                                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                        <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                            <a class="page-link"
                                               href="?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>&kelas_id=<?= $kelas_id; ?>&siswa_id=<?= $siswa_id; ?>&page=<?= $i; ?>">
                                                <?= $i; ?>
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                        <a class="page-link"
                                           href="?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>&kelas_id=<?= $kelas_id; ?>&siswa_id=<?= $siswa_id; ?>&page=<?= $page + 1; ?>">
                                            Berikutnya
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>