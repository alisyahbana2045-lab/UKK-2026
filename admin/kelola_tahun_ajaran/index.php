<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_tahun_ajaran");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Kelola Kelas</title>
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
            <h1>Kelola Tahun Ajaran</h1>

            <a href="tambah.php">
                Tambah Tahun Ajaran
            </a>

            <br><br>
        
            <table border="1" cellpadding="8">

                <tr>

                    <th>No</th>
                    <th>Tahun Ajaran</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>
            
                <?php

                $no = 1;

                while ($tahun_ajaran = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>


                        <td>
                            <?= htmlspecialchars($tahun_ajaran['nama']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($tahun_ajaran['tanggal_mulai']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($tahun_ajaran['tanggal_selesai']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($tahun_ajaran['status_aktif']); ?>
                        <td>

                            <a href="edit.php?id=<?= $tahun_ajaran['id']; ?>">
                                Edit
                            </a>

                            |

                            <a href="hapus.php?id=<?= $tahun_ajaran['id']; ?>">
                                Nonaktifkan
                            </a>

                        </td>

                    </tr>
                
                <?php } ?>

            </table>
</td>
    </tr>

</table>
</div>
</body>
</html>