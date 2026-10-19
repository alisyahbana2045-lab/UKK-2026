<?php
require_once "../../config/admin.php";
require_once "../../config/koneksi.php";

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? $_GET['tahun_ajaran_id'] : '';
$kelas_id = isset($_GET['kelas_id']) ? $_GET['kelas_id'] : '';
$siswa_id = isset($_GET['siswa_id']) ? $_GET['siswa_id'] : '';

$where = "WHERE 1=1";

if ($tahun_ajaran_id != '') {
    $tahun_ajaran_id = mysqli_real_escape_string($conn, $tahun_ajaran_id);
    $where .= " AND tahun_ajaran_id = '$tahun_ajaran_id'";
}

if ($kelas_id != '') {
    $kelas_id = mysqli_real_escape_string($conn, $kelas_id);
    $where .= " AND kelas_id = '$kelas_id'";
}

if ($siswa_id != '') {
    $siswa_id = mysqli_real_escape_string($conn, $siswa_id);
    $where .= " AND siswa_id = '$siswa_id'";
}

$query = mysqli_query($conn, "SELECT * FROM t_pelanggaran_siswa $where ORDER BY tanggal DESC, id DESC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

$query_tahun = mysqli_query($conn, "SELECT id, nama FROM t_tahun_ajaran ORDER BY id DESC");
$query_kelas = mysqli_query($conn, "SELECT id, nama FROM t_kelas ORDER BY nama ASC");
$query_siswa = mysqli_query($conn, "SELECT id, nama FROM t_siswa ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran</title>
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
                    <h1 class="fw-bold mb-1">Laporan Pelanggaran</h1>
                    <p class="text-muted mb-0">Data laporan pelanggaran siswa.</p>
                </div>
                <a href="cetak.php?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>&kelas_id=<?= $kelas_id; ?>&siswa_id=<?= $siswa_id; ?>" target="_blank" class="btn btn-success">
                    🖨 Cetak Laporan
                </a>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" class="form-select">
                                    <option value="">-- Semua Tahun Ajaran --</option>
                                    <?php while ($tahun = mysqli_fetch_assoc($query_tahun)) { ?>
                                        <option value="<?= $tahun['id']; ?>" <?= $tahun_ajaran_id == $tahun['id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($tahun['nama']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kelas</label>
                                <select name="kelas_id" class="form-select">
                                    <option value="">-- Semua Kelas --</option>
                                    <?php while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>
                                        <option value="<?= $kelas['id']; ?>" <?= $kelas_id == $kelas['id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($kelas['nama']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Siswa</label>
                                <select name="siswa_id" class="form-select">
                                    <option value="">-- Semua Siswa --</option>
                                    <?php while ($siswa = mysqli_fetch_assoc($query_siswa)) { ?>
                                        <option value="<?= $siswa['id']; ?>" <?= $siswa_id == $siswa['id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($siswa['nama']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Tampilkan</button>
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
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Guru</th>
                                    <th>Tindakan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total_poin = 0;

                                while ($data = mysqli_fetch_assoc($query)) {
                                    $total_poin += $data['poin'];
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                                        <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
                                        <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                                        <td><?= htmlspecialchars($data['nama_pelanggaran']); ?></td>
                                        <td><?= $data['poin']; ?></td>
                                        <td><?= htmlspecialchars($data['nama_guru']); ?></td>
                                        <td><?= htmlspecialchars($data['tindakan']); ?></td>
                                        <td>
                                            <?php if ($data['status'] == 'selesai') { ?>
                                                <span class="badge bg-success">Selesai</span>
                                            <?php } else { ?>
                                                <span class="badge bg-warning text-dark"><?= htmlspecialchars($data['status']); ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if (mysqli_num_rows($query) == 0) { ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data pelanggaran.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <?php if (mysqli_num_rows($query) > 0) { ?>
                                <tfoot>
                                    <tr class="table-light fw-bold">
                                        <td colspan="5" class="text-end">Total Poin</td>
                                        <td><?= $total_poin; ?></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>