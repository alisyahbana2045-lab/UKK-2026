<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM t_guru");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Kelola Guru</title>
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
            <h1>Kelola Guru</h1>

            <a href="tambah.php">
                Tambah Guru
            </a>

            <br><br>
        
            <table border="1" cellpadding="8">

                <tr>

                    <th>No</th>
                    <th>Nip</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>User ID</th>
                    <th>Aksi</th>

                </tr>
            
                <?php

                $no = 1;

                while ($guru = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($guru['nip']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($guru['email']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($guru['nama']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($guru['status_aktif']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($guru['user_id']); ?>
                        </td>

                        <td>

                            <a href="edit.php?id=<?= $guru['id']; ?>">
                                Edit
                            </a>

                            |

                            <a href="hapus.php?id=<?= $guru['id']; ?>">
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