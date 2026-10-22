<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $pelanggaran_kategori_id = $_POST['pelanggaran_kategori_id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $poin = $_POST['poin'];
    $deskripsi = $_POST['deskripsi'];
    $status_aktif = $_POST['status_aktif'];

    $query = mysqli_query($conn, "
        INSERT INTO t_pelanggaran (
            pelanggaran_kategori_id,
            kode,
            nama,
            poin,
            deskripsi,
            status_aktif
        ) VALUES (
            '$pelanggaran_kategori_id',
            '$kode',
            '$nama',
            '$poin',
            '$deskripsi',
            '$status_aktif'
        )
    ");

    if ($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($conn);
    }
}

$query_kategori = mysqli_query($conn, "
    SELECT id, nama
    FROM t_pelanggaran_kategori
    WHERE status_aktif = 1
    ORDER BY nama ASC
");

if (!$query_kategori) {
    die("Query kategori gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Pelanggaran</title>

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

        <!-- SIDEBAR -->
        <?php require_once "../../layout/sidebar.php"; ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 main-content">

            <div class="mb-4">
                <h1 class="mb-1">Tambah Jenis Pelanggaran</h1>
                <p class="text-muted mb-0">Tambahkan data jenis pelanggaran baru</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="POST">

                        <!-- KATEGORI -->
                        <div class="mb-3">
                            <label class="form-label">Kategori Pelanggaran</label>
                            <select name="pelanggaran_kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>

                                <?php while ($kategori = mysqli_fetch_assoc($query_kategori)) { ?>
                                    <option value="<?= $kategori['id']; ?>">
                                        <?= htmlspecialchars($kategori['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- KODE -->
                        <div class="mb-3">
                            <label class="form-label">Kode</label>
                            <input
                                type="text"
                                name="kode"
                                class="form-control"
                                placeholder="Contoh: PLG001"
                                required
                            >
                        </div>

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggaran</label>
                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan nama pelanggaran"
                                required
                            >
                        </div>

                        <!-- POIN -->
                        <div class="mb-3">
                            <label class="form-label">Poin</label>
                            <input
                                type="number"
                                name="poin"
                                class="form-control"
                                placeholder="Masukkan poin"
                                min="0"
                                required
                            >
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan deskripsi pelanggaran"
                            ></textarea>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- TOMBOL -->
                        <div class="mt-3">
                            <button type="submit" name="simpan" class="btn btn-primary">
                                Simpan
                            </button>

                            <a href="index.php" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>