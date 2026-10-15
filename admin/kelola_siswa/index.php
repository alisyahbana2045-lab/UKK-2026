<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_siswa");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Kelola Siswa</title>
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
<table width="100%" border="0">

    <tr>

        <!-- MENU -->

        <td width="200" valign="top">

            <?php require_once "../../layout/sidebar.php"; ?>

        </td>


        <!-- KONTEN -->

        <td class="col-md-9 col-lg-10 p-4 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">


                    <h1 class="fw-bold mb-1">
                         Kelola Siswa
                    </h1>

                <a href="tambah.php" class="btn btn-primary">
                    + Tambah Siswa
                </a>

            </div>
        
        <div class="card shadow-sm">
            <div class="card-body">

            <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>

                    <th>No</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>
            </thead>
                <?php

                $no = 1;

                while ($siswa = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($siswa['nis']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($siswa['nisn']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($siswa['nama']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($siswa['jenis_kelamin']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($siswa['tanggal_lahir']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($siswa['alamat']); ?>
                        </td>

                        <td>

                <?php if ($siswa['status_aktif'] == 1) { ?>

                    <span class="badge bg-success">
                        Aktif
                    </span>

                <?php } else { ?>

                    <span class="badge bg-danger">
                        Tidak Aktif
                    </span>

                <?php } ?>

                        </td>


                        <td>

                            <a href="edit.php?id=<?= $siswa['id']; ?>">
                                Edit
                            </a>

                            |

                            <a href="hapus.php?id=<?= $siswa['id']; ?>">
                                Nonaktifkan
                            </a>

                        </td>                        

                    </tr>
                
                <?php } ?>

            </table>
            </div>
        </div>
    </td>
    </tr>

</table>
</div>
</body>
</html>