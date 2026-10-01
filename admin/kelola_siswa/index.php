<?php

require_once "../../config/admin.php";
require_once "../../config/koneksi.php";

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

</head>

<body>

<table width="100%" border="0">

    <tr>

        <!-- MENU -->

        <td width="200" valign="top">

            <?php require_once "../../layout/sidebar.php"; ?>

        </td>


        <!-- KONTEN -->

        <td valign="top">

            <h1>Kelola Siswa</h1>

            <a href="tambah.php">
                Tambah Siswa
            </a>

            <br><br>

            <table border="1" cellpadding="8">

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
                            <?= htmlspecialchars($siswa['status_aktif']); ?>
                        </td>

                        <td>

                            <a href="edit.php?id=<?= $siswa['id']; ?>">
                                Edit
                            </a>

                            |

                            <a href="hapus.php?id=<?= $siswa['id']; ?>">
                                Hapus
                            </a>

                        </td>

                    </tr>

                <?php

                }

                ?>

            </table>

        </td>

    </tr>

</table>

</body>

</html>