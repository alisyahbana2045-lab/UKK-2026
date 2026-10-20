<?php
require_once "../../config/session.php";
require_once "../../config/koneksi.php";

$user_id = $_SESSION['user_id'];
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$query = mysqli_query($conn, "SELECT * FROM t_pelanggaran_siswa
    WHERE guru_id IN (
        SELECT id FROM t_guru WHERE user_id = '$user_id'
    )
    AND (
        nama_siswa LIKE '%$cari%'
        OR nama_pelanggaran LIKE '%$cari%'
        OR nama_kelas LIKE '%$cari%'
    )
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
    <title>Tindakan - Sistem Pelanggaran Siswa</title>
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
                    <h3 class="fw-bold mb-1">Tindakan</h3>
                    <p class="text-muted mb-0">
                        Kelola tindakan terhadap pelanggaran siswa.
                    </p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" class="d-flex gap-2">
                        <input type="text" name="cari" class="form-control"
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
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
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
                                        <td>
                                            <?php if ($data['status'] == 'Belum Ditindak') { ?>
                                                <button type="button"
                                                    class="btn btn-sm btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalTindakan<?= $data['id']; ?>">
                                                    Beri Tindakan
                                                </button>

                                                <div class="modal fade"
                                                    id="modalTindakan<?= $data['id']; ?>"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="proses.php" method="POST">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Beri Tindakan
                                                                    </h5>
                                                                    <button type="button"
                                                                        class="btn-close"
                                                                        data-bs-dismiss="modal">
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <input type="hidden"
                                                                        name="id"
                                                                        value="<?= $data['id']; ?>">

                                                                    <div class="mb-3">
                                                                        <label class="form-label">
                                                                            Nama Siswa
                                                                        </label>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="<?= htmlspecialchars($data['nama_siswa']); ?>"
                                                                            readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">
                                                                            Pelanggaran
                                                                        </label>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="<?= htmlspecialchars($data['nama_pelanggaran']); ?>"
                                                                            readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">
                                                                            Tindakan
                                                                        </label>
                                                                        <textarea name="tindakan"
                                                                            class="form-control"
                                                                            rows="3"
                                                                            placeholder="Masukkan tindakan yang diberikan..."
                                                                            required></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Batal
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">
                                                                        Simpan Tindakan
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <span class="text-success">
                                                    <?= htmlspecialchars($data['tindakan']); ?>
                                                </span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if (mysqli_num_rows($query) == 0) { ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>