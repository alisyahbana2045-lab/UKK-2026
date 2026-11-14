<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $nama = trim($_POST['nama']);
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $status_aktif = $_POST['status_aktif'];

    // 1. Cek apakah nama tahun ajaran sudah ada di database
    $cek_duplikasi = mysqli_query($conn, "SELECT * FROM t_tahun_ajaran WHERE nama = '$nama'");

    if ($tanggal_selesai < $tanggal_mulai) {
        $error = "Tanggal selesai tidak boleh lebih awal dari tanggal mulai.";
    } elseif (mysqli_num_rows($cek_duplikasi) > 0) {
        // 2. Jika sudah ada, tampilkan pesan error
        $error = "Gagal! Tahun ajaran $nama sudah terdaftar.";
    } else {
        // 3. Jika aman, jalankan insert
        $query = mysqli_query($conn, "INSERT INTO t_tahun_ajaran
            (nama, tanggal_mulai, tanggal_selesai, status_aktif)
            VALUES
            ('$nama', '$tanggal_mulai', '$tanggal_selesai', '$status_aktif')");

        if ($query) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Data gagal disimpan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tahun Ajaran</title>
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
                <h1 class="fw-bold mb-1">Tambah Tahun Ajaran</h1>
                <p class="text-muted mb-0">Tambahkan data tahun ajaran baru.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger">
                            <?= $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Tahun Ajaran</label>
                            <input type="text" name="nama" class="form-control"
                                placeholder="Contoh: 2026/2027" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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
</body>
</html>