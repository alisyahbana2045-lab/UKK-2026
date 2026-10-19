<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_pelanggaran_kategori ORDER BY id DESC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Pelanggaran</title>

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
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <?php require_once "../../layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Kategori Pelanggaran</h1>
                    <p class="text-muted mb-0">
                        Data kategori pelanggaran siswa
                    </p>
                </div>

                <a href="tambah.php" class="btn btn-primary">
                    + Tambah Kategori
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">

                            <thead class="table-dark">
                                <tr>
                                    <th width="60">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $no = 1;

                                if (mysqli_num_rows($query) > 0):
                                    while ($data = mysqli_fetch_assoc($query)):
                                ?>

                                    <tr>
                                        <td><?= $no++; ?></td>

                                        <td>
                                            <?= htmlspecialchars($data['nama']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($data['deskripsi']); ?>
                                        </td>

                                        <td>
                                            <?php if ($data['status_aktif'] == 1): ?>
                                                <span class="badge bg-success">
                                                    Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">
                                                    Tidak Aktif
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="edit.php?id=<?= $data['id']; ?>"
                                               class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <a href="hapus.php?id=<?= $data['id']; ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Yakin ingin menghapus kategori ini?');">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>

                                <?php
                                    endwhile;
                                else:
                                ?>

                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Belum ada data kategori pelanggaran.
                                        </td>
                                    </tr>

                                <?php endif; ?>

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