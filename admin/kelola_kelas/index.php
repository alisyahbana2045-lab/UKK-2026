<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_kelas");

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
            <h1>Kelola Kelas</h1>

            <a href="tambah.php">
                Tambah Kelas
            </a>

            <br><br>
        
            <table border="1" cellpadding="8">

                <tr>

                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Tingkat</th>
                    <th>Jurusan</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>
            
                <?php

                $no = 1;

                while ($kelas = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($kelas['nama']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($kelas['tingkat']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($kelas['jurusan']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($kelas['status_aktif']); ?>
                        </td>
      
                        <td>

                            <a href="edit.php?id=<?= $kelas['id']; ?>">
                                Edit
                            </a>

                            |

                            <a href="hapus.php?id=<?= $kelas['id']; ?>">
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