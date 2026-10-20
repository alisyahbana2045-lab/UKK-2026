<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$query = mysqli_query($conn, "SELECT
    ks.*,
    s.nis,
    s.nama AS nama_siswa,
    k.nama AS nama_kelas,
    ta.nama AS tahun_ajaran
    FROM t_kelas_siswa ks
    LEFT JOIN t_siswa s ON ks.siswa_id = s.id
    LEFT JOIN t_kelas k ON ks.kelas_id = k.id
    LEFT JOIN t_tahun_ajaran ta ON ks.tahun_ajaran_id = ta.id
    WHERE s.nis LIKE '%$cari%'
    OR s.nama LIKE '%$cari%'
    OR k.nama LIKE '%$cari%'
    OR ta.nama LIKE '%$cari%'
    ORDER BY ks.siswa_id DESC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Penempatan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

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

    <div class="row">

        <!-- SIDEBAR -->

        <?php require_once "../../layout/sidebar.php"; ?>


        <!-- KONTEN -->

        <main class="col-md-9 col-lg-10 p-4 main-content">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="fw-bold mb-1">
                        Penempatan Siswa
                    </h1>
                    <p class="text-muted mb-0">
                        Data penempatan siswa
                    </p>
                </div>
                <a href="tambah.php" class="btn btn-primary">
                    + Tambah Penempatan
                </a>

            </div>
            <div class="card shadow-sm mb-4">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="cari" class="form-control"
                    placeholder="Cari NIS, nama siswa, kelas, atau tahun ajaran..."
                    value="<?= htmlspecialchars($cari); ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </form>
            </div>


            <!-- TABEL -->

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="table-dark">

                                <tr>

                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>

                                </tr>

                            </thead>
                            <tbody>

                                <?php

                                $no = 1;

                                if (mysqli_num_rows($query) > 0) {

                                    while ($data = mysqli_fetch_assoc($query)) {

                                ?>

                                    <tr>

                                        <td>
                                            <?= $no++; ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($data['nis']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($data['nama_siswa']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($data['tahun_ajaran']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($data['nama_kelas']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($data['tanggal_mulai']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($data['tanggal_selesai']); ?>
                                        </td>
                                        <td>

                                            <?php if ($data['status_aktif'] == 1) { ?>

                                                <span class="badge bg-success">
                                                    Aktif
                                                </span>

                                            <?php } else { ?>

                                                <span class="badge bg-danger">
                                                    Tidak Aktif
                                                </span>

                                            <?php } ?>

                                        </td>

                                    </tr>

                                <?php } } else { ?>

                                    <tr>

                                        <td colspan="8" class="text-center">
                                            Belum ada data penempatan siswa.
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