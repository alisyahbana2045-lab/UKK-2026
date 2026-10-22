<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$query_jumlah = mysqli_query($conn, "SELECT COUNT(*) AS total FROM t_tahun_ajaran");

if (!$query_jumlah) {
    die("Query jumlah gagal: " . mysqli_error($conn));
}

$total_data = mysqli_fetch_assoc($query_jumlah)['total'];
$total_halaman = ceil($total_data / $per_page);

if ($total_halaman > 0 && $page > $total_halaman) {
    $page = $total_halaman;
    $offset = ($page - 1) * $per_page;
}

$query = mysqli_query($conn, "SELECT * FROM t_tahun_ajaran
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
    <title>Kelola Tahun Ajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>

</head>

<body>

<div class="container-fluid">

<table width="100%" border="0">

    <tr>

        <!-- MENU -->
        <td width="200" valign="top">
            <?php require_once "../../layout/sidebar.php"; ?>
        </td>

        <!-- KONTEN -->
        <td class="col-md-9 col-lg-10 p-4 main-content">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="fw-bold mb-1">
                        Kelola Tahun Ajaran
                    </h1>
                    <p class="text-muted mb-0">
                        Pengelolaan Tahun Ajaran
                    </p>
                </div>

                <a href="tambah.php" class="btn btn-primary">
                    + Tambah Tahun Ajaran
                </a>

            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $no = $offset + 1;

                            while ($tahun_ajaran = mysqli_fetch_assoc($query)) {
                            ?>

                                <tr>

                                    <td>
                                        <?= $no++; ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($tahun_ajaran['nama']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($tahun_ajaran['tanggal_mulai']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($tahun_ajaran['tanggal_selesai']); ?>
                                    </td>

                                    <td>
                                        <?php if ($tahun_ajaran['status_aktif'] == 1) { ?>

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

                                        <a href="edit.php?id=<?= $tahun_ajaran['id']; ?>"
                                            class="badge btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <?php if ($tahun_ajaran['status_aktif'] == 1) { ?>

                                            <a href="hapus.php?id=<?= $tahun_ajaran['id']; ?>&aksi=nonaktif"
                                                class="badge btn btn-secondary btn-sm"
                                                onclick="return confirm('Yakin ingin menonaktifkan tahun ajaran ini?');">
                                                Nonaktifkan
                                            </a>

                                        <?php } else { ?>

                                            <a href="hapus.php?id=<?= $tahun_ajaran['id']; ?>&aksi=hapus"
                                                class="badge btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus permanen tahun ajaran ini?');">
                                                Hapus
                                            </a>

                                        <?php } ?>

                                    </td>

                                </tr>

                            <?php } ?>

                            <?php if ($total_data == 0) { ?>

                                <tr>
                                    <td colspan="6" class="text-center">
                                        Data tahun ajaran tidak ditemukan.
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                    <?php if ($total_halaman > 1) { ?>

                        <div class="d-flex justify-content-end mt-3">

                            <nav>
                                <ul class="pagination mb-0">

                                    <?php if ($page > 1) { ?>

                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?page=<?= $page - 1; ?>">
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
                                                href="?page=<?= $i; ?>">
                                                <?= $i; ?>
                                            </a>
                                        </li>

                                    <?php } ?>

                                    <?php if ($page < $total_halaman) { ?>

                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?page=<?= $page + 1; ?>">
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

                    <?php } ?>

                </div>
            </div>

        </td>

    </tr>

</table>

</div>

</body>
</html>