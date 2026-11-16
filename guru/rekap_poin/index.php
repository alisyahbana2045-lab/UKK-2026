
<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = (int) $_SESSION['user_id'];

$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, trim($_GET['cari'])) : '';

$per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

// Filter pencarian
$where = "WHERE 1=1";

if ($cari != '') {
    $where .= " AND (
        s.nama LIKE '%$cari%'
        OR s.nis LIKE '%$cari%'
        OR k.nama_kelas LIKE '%$cari%'
    )";
}

// Hitung jumlah siswa
$query_jumlah = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM t_siswa s
    LEFT JOIN (
        SELECT
            ks.siswa_id,
            GROUP_CONCAT(DISTINCT k.nama ORDER BY k.nama SEPARATOR ', ') AS nama_kelas
        FROM t_kelas_siswa ks
        LEFT JOIN t_kelas k ON k.id = ks.kelas_id
        WHERE ks.status_aktif = 1
        GROUP BY ks.siswa_id
    ) k ON k.siswa_id = s.id
    $where
");

if (!$query_jumlah) {
    die("Query jumlah gagal: " . mysqli_error($conn));
}

$total_data = (int) mysqli_fetch_assoc($query_jumlah)['total'];
$total_halaman = (int) ceil($total_data / $per_page);

if ($total_halaman > 0 && $page > $total_halaman) {
    $page = $total_halaman;
}

$offset = ($page - 1) * $per_page;

// Ambil rekap poin seluruh siswa
$query = mysqli_query($conn, "
    SELECT
        s.id,
        s.nis,
        s.nama,
        COALESCE(k.nama_kelas, '-') AS nama_kelas,
        COALESCE(r.jumlah_pelanggaran, 0) AS jumlah_pelanggaran,
        COALESCE(r.total_poin, 0) AS total_poin
    FROM t_siswa s

    LEFT JOIN (
        SELECT
            ks.siswa_id,
            GROUP_CONCAT(DISTINCT k.nama ORDER BY k.nama SEPARATOR ', ') AS nama_kelas
        FROM t_kelas_siswa ks
        LEFT JOIN t_kelas k ON k.id = ks.kelas_id
        WHERE ks.status_aktif = 1
        GROUP BY ks.siswa_id
    ) k ON k.siswa_id = s.id

    LEFT JOIN (
        SELECT
            siswa_id,
            COUNT(*) AS jumlah_pelanggaran,
            SUM(poin) AS total_poin
        FROM t_pelanggaran_siswa
        GROUP BY siswa_id
    ) r ON r.siswa_id = s.id

    $where
    ORDER BY total_poin DESC, s.nama ASC
    LIMIT $offset, $per_page
");

if (!$query) {
    die("Query rekap gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Poin - Sistem Pelanggaran Siswa</title>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Rekap Poin</h3>
                    <p class="text-muted mb-0">
                        Rekap total poin pelanggaran seluruh siswa.
                    </p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" class="d-flex gap-2">
                        <input
                            type="text"
                            name="cari"
                            class="form-control"
                            placeholder="Cari nama siswa, NIS, atau kelas..."
                            value="<?= htmlspecialchars($cari); ?>"
                        >
                        <button type="submit" class="btn btn-primary">
                            Cari
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            Reset
                        </a>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jumlah Pelanggaran</th>
                                    <th>Total Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = $offset + 1;

                                if (mysqli_num_rows($query) > 0) {
                                    while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($data['nis']); ?></td>
                                        <td><?= htmlspecialchars($data['nama']); ?></td>
                                        <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                                        <td><?= (int) $data['jumlah_pelanggaran']; ?></td>
                                        <td>
                                            <?php if ((int) $data['total_poin'] > 0) { ?>
                                                <span class="badge bg-danger">
                                                    <?= (int) $data['total_poin']; ?> Poin
                                                </span>
                                            <?php } else { ?>
                                                <span class="badge bg-success">
                                                    0 Poin
                                                </span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Belum ada data rekap poin.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <nav>
                            <ul class="pagination mb-0">
                                <?php if ($page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $page - 1; ?>&cari=<?= urlencode($cari); ?>">
                                            Sebelumnya
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                <?php } ?>

                                <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?= $i; ?>&cari=<?= urlencode($cari); ?>">
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php if ($page < $total_halaman) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $page + 1; ?>&cari=<?= urlencode($cari); ?>">
                                            Berikutnya
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">Berikutnya</span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
