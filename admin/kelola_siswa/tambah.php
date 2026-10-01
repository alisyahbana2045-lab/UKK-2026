<?php

require_once "../../config/admin.php";
require_once "../../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $status_aktif = $_POST['status_aktif'];

    $query = mysqli_query($conn, "INSERT INTO t_siswa
        (nis, nisn, nama, jenis_kelamin, tanggal_lahir, alamat, status_aktif)
        VALUES
        ('$nis', '$nisn', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$status_aktif')
    ");

    if ($query) {

        header("Location: index.php");
        exit;

    } else {

        echo "Data gagal disimpan: " . mysqli_error($conn);

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Tambah Siswa</title>

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

            <h1>Tambah Siswa</h1>

            <form method="POST">

                <table>

                    <tr>

                        <td>NIS</td>

                        <td>
                            <input type="text" name="nis" required>
                        </td>

                    </tr>

                    <tr>

                        <td>NISN</td>

                        <td>
                            <input type="text" name="nisn" required>
                        </td>

                    </tr>

                    <tr>

                        <td>Nama</td>

                        <td>
                            <input type="text" name="nama" required>
                        </td>

                    </tr>

                    <tr>

                        <td>Jenis Kelamin</td>

                        <td>

                            <select name="jenis_kelamin" required>

                                <option value="">
                                    -- Pilih --
                                </option>

                                <option value="L">
                                    Laki-laki
                                </option>

                                <option value="P">
                                    Perempuan
                                </option>

                            </select>

                        </td>

                    </tr>

                    <tr>

                        <td>Tanggal Lahir</td>

                        <td>
                            <input type="date" name="tanggal_lahir" required>
                        </td>

                    </tr>

                    <tr>

                        <td>Alamat</td>

                        <td>
                            <textarea name="alamat" required></textarea>
                        </td>

                    </tr>

                    <tr>

                        <td>Status</td>

                        <td>

                            <select name="status_aktif" required>

                                <option value="1">
                                    Aktif
                                </option>

                                <option value="0">
                                    Tidak Aktif
                                </option>

                            </select>

                        </td>

                    </tr>

                    <tr>

                        <td></td>

                        <td>

                            <button type="submit" name="simpan">
                                Simpan
                            </button>

                            <a href="index.php">
                                Kembali
                            </a>

                        </td>

                    </tr>

                </table>

            </form>

        </td>

    </tr>

</table>

</body>

</html>