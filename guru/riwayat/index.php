<?php
require_once "../../config/session.php";
require_once "../../config/koneksi.php";

$user_id = $_SESSION['user_id'];
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$where = "WHERE guru_id IN (
    SELECT id FROM t_guru WHERE user_id = '$user_id'
)
AND (
    nama_siswa LIKE '%$cari%'
    OR nama_pelanggaran LIKE '%$cari%'
    OR nama_kelas LIKE '%$cari%'
)";

$query_jumlah = mysqli_query($conn, "SELECT COUNT(*) AS total
    FROM t_pelanggaran_siswa
    $where");

if (!$query_jumlah) {
    die("Query gagal: " . mysqli_error($conn));
}

$total_data = mysqli_fetch_assoc($query_jumlah)['total'];
$total_halaman = ceil($total_data / $per_page);

if ($total_halaman > 0 && $page > $total_halaman) {
    $page = $total_halaman;
}

$offset = ($page - 1) * $per_page;

$query = mysqli_query($conn, "SELECT *
    FROM t_pelanggaran_siswa
    $where
    ORDER BY tanggal DESC, id DESC
    LIMIT $offset, $per_page");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat - Sistem Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

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
                    <h3 class="fw-bold mb-1">Riwayat</h3>
                    <p class="text-muted mb-0">
                        Riwayat pelanggaran siswa yang dicatat oleh Anda.
                    </p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" class="d-flex gap-2">

                        <input type="text"
                               name="cari"
                               class="form-control"
                               placeholder="Cari nama siswa, pelanggaran, atau kelas..."
                               value="<?= htmlspecialchars($cari); ?>">

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

                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Tindakan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $no = $offset + 1;

                                while ($data = mysqli_fetch_assoc($query)) {
                                ?>

                                    <tr>

                                        <td>
                                            <?= $no++; ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($data['tanggal']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($data['nama_siswa']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($data['nama_kelas']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($data['nama_pelanggaran']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($data['poin']); ?>
                                        </td>

                                        <td>
                                            <?php if ($data['tindakan'] != '') { ?>

                                                <?= htmlspecialchars($data['tindakan']); ?>

                                            <?php } else { ?>

                                                <span class="text-muted">
                                                    Belum ada tindakan
                                                </span>

                                            <?php } ?>
                                        </td>

                                        <td>
                                            <?php if ($data['status'] == 'Belum Ditindak') { ?>

                                                <span class="badge bg-warning text-dark">
                                                    Belum Ditindak
                                                </span>

                                            <?php } else { ?>

                                                <span class="badge bg-success">
                                                    Sudah Ditindak
                                                </span>

                                            <?php } ?>
                                        </td>

                                    </tr>

                                <?php } ?>

                                <?php if (mysqli_num_rows($query) == 0) { ?>

                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            Belum ada riwayat pelanggaran.
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
                                        <a class="page-link"
                                           href="?page=<?= $page - 1; ?>&cari=<?= urlencode($cari); ?>">
                                            Sebelumnya
                                        </a>
                                    </li>

                                <?php } else { ?>

                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            Sebelumnya
                                        </span>
                                    </li>

                                <?php } ?>

                                <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>

                                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link"
                                           href="?page=<?= $i; ?>&cari=<?= urlencode($cari); ?>">
                                            <?= $i; ?>
                                        </a>
                                    </li>

                                <?php } ?>

                                <?php if ($page < $total_halaman) { ?>

                                    <li class="page-item">
                                        <a class="page-link"
                                           href="?page=<?= $page + 1; ?>&cari=<?= urlencode($cari); ?>">
                                            Berikutnya
                                        </a>
                                    </li>

                                <?php } else { ?>

                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            Berikutnya
                                        </span>
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