<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$where = "WHERE nama LIKE '%$cari%'
    OR tingkat LIKE '%$cari%'
    OR jurusan LIKE '%$cari%'";

$query_jumlah = mysqli_query($conn, "SELECT COUNT(*) AS total
    FROM t_kelas
    $where");

if (!$query_jumlah) {
    die("Query jumlah gagal: " . mysqli_error($conn));
}

$total_data = mysqli_fetch_assoc($query_jumlah)['total'];
$total_halaman = ceil($total_data / $per_page);

if ($total_halaman > 0 && $page > $total_halaman) {
    $page = $total_halaman;
    $offset = ($page - 1) * $per_page;
}

$query = mysqli_query($conn, "SELECT * FROM t_kelas
    $where
    ORDER BY id DESC
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
    <title>Kelola Kelas</title>
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

        .menu-sidebar:hover {
            color: white;
            background-color: #0d6efd;
        }

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

        <main class="col-md-9 col-lg-10 p-4 main-content">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Kelola Kelas</h1>
                    <p class="text-muted mb-0">Data Pengelolaan Kelas</p>
                </div>

                <a href="tambah.php" class="btn btn-primary">
                    + Tambah Kelas
                </a>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                <form method="GET" class="d-flex gap-2">
                    <input type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari nama kelas, tingkat, atau jurusan..."
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

                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Tingkat</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $no = $offset + 1;

                                while ($kelas = mysqli_fetch_assoc($query)) {
                                ?>

                                    <tr>
                                        <td><?= $no++; ?></td>

                                        <td>
                                            <?= htmlspecialchars($kelas['nama']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($kelas['tingkat']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($kelas['jurusan']); ?>
                                        </td>

                                        <td>
                                            <?php if ($kelas['status_aktif'] == 1) { ?>

                                                <span class="badge bg-success">
                                                    Aktif
                                                </span>

                                            <?php } else { ?>

                                                <span class="badge bg-danger">
                                                    Tidak Aktif
                                                </span>

                                            <?php } ?>
                                        </td>

                                        <td>
                                            <a href="edit.php?id=<?= $kelas['id']; ?>"
                                                class="badge btn btn-primary btn-sm">
                                                Edit
                                            </a>

                                            <a href="hapus.php?id=<?= $kelas['id']; ?>"
                                                class="badge btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus kategori ini?');">
                                                Nonaktifkan
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                <?php if ($total_data == 0) { ?>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada data kelas.
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>

                        </table>
                    </div>

                    <?php if ($total_halaman > 1) { ?>
                        <nav>
                            <ul class="pagination justify-content-end">

                                <!-- Previous -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link"
                                        href="?cari=<?= urlencode($cari); ?>&page=<?= $page - 1; ?>">
                                        Sebelumnya
                                    </a>
                                </li>

                                <!-- Nomor Halaman -->
                                <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>
                                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                        <a class="page-link"
                                            href="?cari=<?= urlencode($cari); ?>&page=<?= $i; ?>">
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php } ?>

                                <!-- Next -->
                                <li class="page-item <?= ($page >= $total_halaman) ? 'disabled' : ''; ?>">
                                    <a class="page-link"
                                        href="?cari=<?= urlencode($cari); ?>&page=<?= $page + 1; ?>">
                                        Berikutnya
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    <?php } ?>

                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>