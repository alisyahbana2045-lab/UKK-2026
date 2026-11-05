<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$pesan = "";
$jenis_pesan = "";

if (isset($_POST['simpan'])) {
    $nama = trim($_POST['nama']);
    $tingkat = $_POST['tingkat'];
    $jurusan = trim($_POST['jurusan']);
    $status_aktif = (int) $_POST['status_aktif'];

    if ($nama == "" || $tingkat == "" || $jurusan == "") {
        $pesan = "Semua data kelas wajib diisi.";
        $jenis_pesan = "danger";
    } else {
        // Cek apakah kelas sudah ada
        $stmt_cek = mysqli_prepare($conn, "
            SELECT id FROM t_kelas
            WHERE LOWER(TRIM(nama)) = LOWER(?)
            AND tingkat = ?
            AND LOWER(TRIM(jurusan)) = LOWER(?)
            LIMIT 1
        ");

        mysqli_stmt_bind_param($stmt_cek, "sss", $nama, $tingkat, $jurusan);
        mysqli_stmt_execute($stmt_cek);
        $hasil_cek = mysqli_stmt_get_result($stmt_cek);

        if (mysqli_num_rows($hasil_cek) > 0) {
            $pesan = "Kelas tersebut sudah terdaftar. Silakan gunakan data kelas yang berbeda.";
            $jenis_pesan = "danger";
        } else {
            $stmt = mysqli_prepare($conn, "
                INSERT INTO t_kelas (nama, tingkat, jurusan, status_aktif)
                VALUES (?, ?, ?, ?)
            ");

            mysqli_stmt_bind_param($stmt, "sssi", $nama, $tingkat, $jurusan, $status_aktif);

            if (mysqli_stmt_execute($stmt)) {
                $pesan = "Data kelas berhasil ditambahkan.";
                $jenis_pesan = "success";
                $_POST = [];
            } else {
                $pesan = "Data gagal disimpan: " . mysqli_error($conn);
                $jenis_pesan = "danger";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($stmt_cek);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>

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
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php require_once "../../layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">
            <div class="mb-4">
                <h1 class="fw-bold mb-1">Tambah Kelas</h1>
                <p class="text-muted mb-0">Tambahkan data kelas baru.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <?php if ($pesan != "") { ?>
                        <div class="alert alert-<?= $jenis_pesan; ?> alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($pesan); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Kelas</label>
                                <input type="text" name="nama" class="form-control"
                                       placeholder="Contoh: RPL 1"
                                       value="<?= htmlspecialchars($_POST['nama'] ?? ''); ?>"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tingkat</label>
                                <select name="tingkat" class="form-select" required>
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="X" <?= (($_POST['tingkat'] ?? '') == 'X') ? 'selected' : ''; ?>>X</option>
                                    <option value="XI" <?= (($_POST['tingkat'] ?? '') == 'XI') ? 'selected' : ''; ?>>XI</option>
                                    <option value="XII" <?= (($_POST['tingkat'] ?? '') == 'XII') ? 'selected' : ''; ?>>XII</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control"
                                       placeholder="Contoh: RPL"
                                       value="<?= htmlspecialchars($_POST['jurusan'] ?? ''); ?>"
                                       required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Status</label>
                                <select name="status_aktif" class="form-select" required>
                                    <option value="1" <?= (($_POST['status_aktif'] ?? '1') == '1') ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="0" <?= (($_POST['status_aktif'] ?? '') == '0') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>

                        <a href="index.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
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