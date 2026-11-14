
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

$query_guru = mysqli_query($conn, "
    SELECT id
    FROM t_guru
    WHERE user_id = $user_id
    AND status_aktif = 1
    LIMIT 1
");

if (!$query_guru || mysqli_num_rows($query_guru) == 0) {
    die("Data guru tidak ditemukan atau tidak aktif.");
}

$data_guru = mysqli_fetch_assoc($query_guru);
$guru_id = (int) $data_guru['id'];

// =====================================
// AMBIL TAHUN AJARAN YANG DIAMPU
// =====================================

$query_tahun = mysqli_query($conn, "
    SELECT DISTINCT ta.id, ta.nama, ta.status_aktif
    FROM t_wali_kelas wk
    INNER JOIN t_tahun_ajaran ta ON wk.tahun_ajaran_id = ta.id
    WHERE wk.guru_id = $guru_id
    AND wk.status_aktif = 1
    ORDER BY ta.id DESC
");

if (!$query_tahun || mysqli_num_rows($query_tahun) == 0) {
    die("Kamu belum memiliki penugasan sebagai wali kelas yang aktif.");
}

$daftar_tahun = [];

while ($tahun = mysqli_fetch_assoc($query_tahun)) {
    $daftar_tahun[] = $tahun;
}

// =====================================
// TENTUKAN TAHUN AJARAN
// =====================================

$tahun_aktif = null;

foreach ($daftar_tahun as $tahun) {
    if ($tahun['status_aktif'] == 1) {
        $tahun_aktif = (int) $tahun['id'];
        break;
    }
}

if ($tahun_aktif === null) {
    $tahun_aktif = (int) $daftar_tahun[0]['id'];
}

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id'])
    ? (int) $_GET['tahun_ajaran_id']
    : $tahun_aktif;

$id_tahun_valid = array_column($daftar_tahun, 'id');

if (!in_array($tahun_ajaran_id, array_map('intval', $id_tahun_valid), true)) {
    $tahun_ajaran_id = $tahun_aktif;
}

// =====================================
// AMBIL KELAS YANG DIAMPU
// =====================================

$query_kelas = mysqli_query($conn, "
    SELECT DISTINCT k.id, k.nama
    FROM t_wali_kelas wk
    INNER JOIN t_kelas k ON wk.kelas_id = k.id
    WHERE wk.guru_id = $guru_id
    AND wk.tahun_ajaran_id = $tahun_ajaran_id
    AND wk.status_aktif = 1
    ORDER BY k.nama ASC
");

if (!$query_kelas || mysqli_num_rows($query_kelas) == 0) {
    die("Data kelas untuk tahun ajaran ini tidak ditemukan.");
}

$daftar_kelas = [];

while ($kelas = mysqli_fetch_assoc($query_kelas)) {
    $daftar_kelas[] = $kelas;
}

$kelas_ids = array_map('intval', array_column($daftar_kelas, 'id'));
$kelas_id_sql = implode(',', $kelas_ids);

// =====================================
// RINGKASAN REKAP
// =====================================

$query_ringkasan = mysqli_query($conn, "
    SELECT
        COUNT(DISTINCT ks.siswa_id) AS total_siswa,
        COUNT(DISTINCT CASE
            WHEN ps.id IS NOT NULL THEN ks.siswa_id
        END) AS siswa_melanggar,
        COUNT(DISTINCT ps.id) AS total_pelanggaran,
        COALESCE(SUM(ps.poin), 0) AS total_poin
    FROM t_kelas_siswa ks
    LEFT JOIN t_pelanggaran_siswa ps
        ON ps.siswa_id = ks.siswa_id
        AND ps.tahun_ajaran_id = ks.tahun_ajaran_id
        AND ps.kelas_id = ks.kelas_id
    WHERE ks.tahun_ajaran_id = $tahun_ajaran_id
    AND ks.kelas_id IN ($kelas_id_sql)
    AND ks.status_aktif = 1
");

if (!$query_ringkasan) {
    die("Query ringkasan gagal: " . mysqli_error($conn));
}

$ringkasan = mysqli_fetch_assoc($query_ringkasan);

// =====================================
// DATA REKAP SISWA
// =====================================

$query_rekap = mysqli_query($conn, "
    SELECT
        s.id,
        s.nis,
        s.nama,
        k.nama AS nama_kelas,
        COUNT(DISTINCT ps.id) AS jumlah_pelanggaran,
        COALESCE(SUM(ps.poin), 0) AS total_poin
    FROM t_kelas_siswa ks
    INNER JOIN t_siswa s ON ks.siswa_id = s.id
    INNER JOIN t_kelas k ON ks.kelas_id = k.id
    LEFT JOIN t_pelanggaran_siswa ps
        ON ps.siswa_id = ks.siswa_id
        AND ps.tahun_ajaran_id = ks.tahun_ajaran_id
        AND ps.kelas_id = ks.kelas_id
    WHERE ks.tahun_ajaran_id = $tahun_ajaran_id
    AND ks.kelas_id IN ($kelas_id_sql)
    AND ks.status_aktif = 1
    GROUP BY s.id, s.nis, s.nama, k.nama
    ORDER BY k.nama ASC, s.nama ASC
");

if (!$query_rekap) {
    die("Query rekap gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kelas</title>

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

        .card-rekap {
            border: none;
            border-radius: 12px;
        }

        .badge-status {
            min-width: 100px;
            padding: 7px 12px;
            font-size: 12px;
            border-radius: 20px;
            display: inline-block;
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
                <h2 class="fw-bold mb-1">Rekap Kelas</h2>
                <p class="text-muted mb-0">
                    Rekap pelanggaran siswa berdasarkan kelas yang kamu ampu.
                </p>
            </div>

            <!-- FILTER TAHUN AJARAN -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET">
                        <div class="row align-items-end">
                            <div class="col-md-5">
                                <label class="form-label">Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" class="form-select"
                                    onchange="this.form.submit()">

                                    <?php foreach ($daftar_tahun as $tahun) { ?>
                                        <option value="<?= $tahun['id']; ?>"
                                            <?= $tahun_ajaran_id == $tahun['id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($tahun['nama']); ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RINGKASAN -->
            <div class="row g-3 mb-4">

                <div class="col-md-3">
                    <div class="card card-rekap shadow-sm">
                        <div class="card-body">
                            <div class="text-muted mb-2">Total Siswa</div>
                            <h3 class="fw-bold mb-0">
                                <?= $ringkasan['total_siswa']; ?>
                            </h3>
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-rekap shadow-sm">
                        <div class="card-body">
                            <div class="text-muted mb-2">Siswa Melanggar</div>
                            <h3 class="fw-bold mb-0">
                                <?= $ringkasan['siswa_melanggar']; ?>
                            </h3>
                            <i class="bi bi-person-exclamation text-warning"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-rekap shadow-sm">
                        <div class="card-body">
                            <div class="text-muted mb-2">Jumlah Pelanggaran</div>
                            <h3 class="fw-bold mb-0">
                                <?= $ringkasan['total_pelanggaran']; ?>
                            </h3>
                            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-rekap shadow-sm">
                        <div class="card-body">
                            <div class="text-muted mb-2">Total Poin</div>
                            <h3 class="fw-bold mb-0">
                                <?= $ringkasan['total_poin']; ?>
                            </h3>
                            <i class="bi bi-bar-chart-fill text-success"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- DAFTAR KELAS -->
            <div class="mb-3">
                <h5 class="fw-bold">Kelas yang Diampu</h5>

                <?php foreach ($daftar_kelas as $kelas) { ?>
                    <span class="badge text-bg-primary me-1">
                        <?= htmlspecialchars($kelas['nama']); ?>
                    </span>
                <?php } ?>
            </div>

            <!-- KETERANGAN STATUS -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Keterangan Status Poin</h6>

                    <span class="badge bg-success me-2 mb-1">Aman: 0–19</span>
                    <span class="badge bg-warning text-dark me-2 mb-1">Peringatan: 20–49</span>
                    <span class="badge bg-danger mb-1">Danger: 50+</span>
                </div>
            </div>

            <!-- TABEL REKAP -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Rekap Pelanggaran Siswa</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jumlah Pelanggaran</th>
                                    <th>Total Poin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;

                                if (mysqli_num_rows($query_rekap) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_rekap)) {

                                        $poin = (int) $row['total_poin'];

                                        if ($poin < 20) {
                                            $status = "Aman";
                                            $warna = "bg-success";
                                        } elseif ($poin < 50) {
                                            $status = "Peringatan";
                                            $warna = "bg-warning text-dark";
                                        } else {
                                            $status = "Danger";
                                            $warna = "bg-danger";
                                        }
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['nis']); ?></td>
                                        <td><?= htmlspecialchars($row['nama']); ?></td>
                                        <td><?= htmlspecialchars($row['nama_kelas']); ?></td>
                                        <td><?= $row['jumlah_pelanggaran']; ?></td>

                                        <td>
                                            <span class="badge text-bg-danger">
                                                <?= $poin; ?> poin
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge badge-status <?= $warna; ?>">
                                                <?= $status; ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-wrap gap-1">

                                                <a href="detail.php?id=<?= $row['id']; ?>&tahun_ajaran_id=<?= $tahun_ajaran_id; ?>"
                                                   class="btn btn-sm btn-info text-white">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>

                                                <?php if ($poin >= 50) { ?>
                                                    <a href="surat_pemanggilan.php?id=<?= $row['id']; ?>&tahun_ajaran_id=<?= $tahun_ajaran_id; ?>"
                                                       class="btn btn-sm btn-danger">
                                                        <i class="bi bi-envelope"></i>
                                                        Surat Pemanggilan
                                                    </a>
                                                <?php } ?>

                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            Belum ada data siswa pada kelas ini.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </main>
    </div>
</div>
</body>
</html>
