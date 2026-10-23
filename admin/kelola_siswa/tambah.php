<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$pesan = '';
$tipe_pesan = '';

$nis = '';
$nisn = '';
$nama = '';
$jenis_kelamin = '';
$tanggal_lahir = '';
$alamat = '';
$status_aktif = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $status_aktif = mysqli_real_escape_string($conn, $_POST['status_aktif']);

    if (!preg_match('/^[0-9]{1,10}$/', $nis)) {
        $pesan = "NIS harus berupa angka dan maksimal 10 digit.";
        $tipe_pesan = "danger";
    } elseif (!preg_match('/^[0-9]{1,10}$/', $nisn)) {
        $pesan = "NISN harus berupa angka dan maksimal 10 digit.";
        $tipe_pesan = "danger";
    } else {
        $cek_nis = mysqli_query($conn, "
            SELECT id FROM t_siswa
            WHERE nis = '$nis'
        ");

        $cek_nisn = mysqli_query($conn, "
            SELECT id FROM t_siswa
            WHERE nisn = '$nisn'
        ");

        $nis_terdaftar = mysqli_num_rows($cek_nis) > 0;
        $nisn_terdaftar = mysqli_num_rows($cek_nisn) > 0;

        if ($nis_terdaftar && $nisn_terdaftar) {
            $pesan = "NIS dan NISN sudah terdaftar. Silakan gunakan NIS dan NISN yang berbeda.";
            $tipe_pesan = "danger";
        } elseif ($nis_terdaftar) {
            $pesan = "NIS sudah terdaftar. Silakan gunakan NIS yang berbeda.";
            $tipe_pesan = "danger";
        } elseif ($nisn_terdaftar) {
            $pesan = "NISN sudah terdaftar. Silakan gunakan NISN yang berbeda.";
            $tipe_pesan = "danger";
        } else {
            $query = mysqli_query($conn, "
                INSERT INTO t_siswa
                (nis, nisn, nama, jenis_kelamin, tanggal_lahir, alamat, status_aktif)
                VALUES
                ('$nis', '$nisn', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$status_aktif')
            ");

            if (!$query) {
                $pesan = "Data gagal disimpan: " . mysqli_error($conn);
                $tipe_pesan = "danger";
            } else {
                header("Location: index.php");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
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
            <div class="mb-4">
                <h1 class="fw-bold mb-1">Tambah Siswa</h1>
                <p class="text-muted mb-0">Tambahkan data siswa baru.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if ($pesan != '') { ?>
                        <div class="alert alert-<?= $tipe_pesan; ?> alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            <?= htmlspecialchars($pesan); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text"
                                       name="nis"
                                       class="form-control"
                                       maxlength="10"
                                       pattern="[0-9]{1,10}"
                                       inputmode="numeric"
                                       value="<?= htmlspecialchars($nis); ?>"
                                       required>
                                <small class="text-muted">Maksimal 10 digit.</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text"
                                       name="nisn"
                                       class="form-control"
                                       maxlength="10"
                                       pattern="[0-9]{1,10}"
                                       inputmode="numeric"
                                       value="<?= htmlspecialchars($nisn); ?>"
                                       required>
                                <small class="text-muted">Maksimal 10 digit.</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text"
                                       name="nama"
                                       class="form-control"
                                       value="<?= htmlspecialchars($nama); ?>"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" <?= ($jenis_kelamin == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?= ($jenis_kelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date"
                                       name="tanggal_lahir"
                                       class="form-control"
                                       value="<?= htmlspecialchars($tanggal_lahir); ?>"
                                       required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($alamat); ?></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Status</label>
                                <select name="status_aktif" class="form-select" required>
                                    <option value="1" <?= ($status_aktif == 1) ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="0" <?= ($status_aktif == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="bi bi-save"></i>
                            Simpan
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>