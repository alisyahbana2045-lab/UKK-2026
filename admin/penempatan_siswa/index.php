<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$query = mysqli_query($conn, "

    SELECT
        t_kelas_siswa.id,
        t_siswa.nis,
        t_siswa.nama AS nama_siswa,
        t_tahun_ajaran.nama AS tahun_ajaran,
        t_kelas.nama AS nama_kelas,
        t_kelas_siswa.tanggal_mulai,
        t_kelas_siswa.tanggal_selesai,
        t_kelas_siswa.status_aktif

    FROM t_kelas_siswa

    INNER JOIN t_siswa
        ON t_kelas_siswa.siswa_id = t_siswa.id

    INNER JOIN t_tahun_ajaran
        ON t_kelas_siswa.tahun_ajaran_id = t_tahun_ajaran.id

    INNER JOIN t_kelas
        ON t_kelas_siswa.kelas_id = t_kelas.id

    ORDER BY t_kelas_siswa.id DESC

");

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