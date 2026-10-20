<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = $_SESSION['user_id'];

$query_guru = mysqli_query($conn, "SELECT id, nama FROM t_guru WHERE user_id = '$user_id' AND status_aktif = 1");

if (!$query_guru || mysqli_num_rows($query_guru) == 0) {
    die("Data guru tidak ditemukan.");
}

$guru = mysqli_fetch_assoc($query_guru);

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$query = mysqli_query($conn, "SELECT * FROM t_pelanggaran_siswa
    WHERE nama_siswa LIKE '%$cari%'
    OR nama_pelanggaran LIKE '%$cari%'
    OR nama_kelas LIKE '%$cari%'
    ORDER BY id DESC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Pelanggaran</title>
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
                    <h1 class="fw-bold mb-1">Catat Pelanggaran</h1>
                    <p class="text-muted mb-0">Mencatat pelanggaran siswa</p>
                </div>
                <a href="tambah.php" class="btn btn-primary">+ Catat Pelanggaran</a>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" class="d-flex gap-2">
                        <input type="text" name="cari" class="form-control"
                            placeholder="Cari nama siswa, pelanggaran, atau kelas..."
                            value="<?= htmlspecialchars($cari); ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="index.php" class="btn btn-secondary">Reset</a>
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
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Guru</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
                                        <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                                        <td><?= htmlspecialchars($data['nama_pelanggaran']); ?></td>
                                        <td><?= htmlspecialchars($data['poin']); ?></td>
                                        <td><?= htmlspecialchars($data['tanggal']); ?></td>
                                        <td><?= htmlspecialchars($data['nama_guru']); ?></td>
                                        <td>
                                            <span class="badge bg-primary">
                                                <?= htmlspecialchars($data['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if (mysqli_num_rows($query) == 0) { ?>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Belum ada data pelanggaran.
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