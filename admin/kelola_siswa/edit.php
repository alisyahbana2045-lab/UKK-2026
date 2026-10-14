<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

/* Ambil data siswa */
$query = mysqli_query($conn, "SELECT * FROM t_siswa WHERE id = '$id'");

if (!$query || mysqli_num_rows($query) == 0) {
    echo "Data siswa tidak ditemukan.";
    exit;
}

$siswa = mysqli_fetch_assoc($query);


/* Proses update */
if (isset($_POST['update'])) {

    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $status_aktif = $_POST['status_aktif'];

    $update = mysqli_query($conn, "UPDATE t_siswa SET
        nis = '$nis',
        nisn = '$nisn',
        nama = '$nama',
        jenis_kelamin = '$jenis_kelamin',
        tanggal_lahir = '$tanggal_lahir',
        alamat = '$alamat',
        status_aktif = '$status_aktif'
        WHERE id = '$id'
    ");

    if ($update) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Siswa</title>
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

<table width="100%" border="0">

    <tr>

        <!-- MENU -->

        <td width="200" valign="top">

            <?php require_once "../../layout/sidebar.php"; ?>

        </td>


        <!-- KONTEN -->

        <td class="col-md-9 col-lg-10 p-4 main-content">

            <h1>Edit Siswa</h1>

            <form method="POST">

                <table>

                    <tr>
                        <td>NIS</td>
                        <td>
                            <input
                                type="text"
                                name="nis"
                                value="<?= htmlspecialchars($siswa['nis']); ?>"
                                required
                            >
                        </td>
                    </tr>

                    <tr>
                        <td>NISN</td>
                        <td>
                            <input
                                type="text"
                                name="nisn"
                                value="<?= htmlspecialchars($siswa['nisn']); ?>"
                                required
                            >
                        </td>
                    </tr>

                    <tr>
                        <td>Nama</td>
                        <td>
                            <input
                                type="text"
                                name="nama"
                                value="<?= htmlspecialchars($siswa['nama']); ?>"
                                required
                            >
                        </td>
                    </tr>

                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>

                            <select name="jenis_kelamin" required>

                                <option value="">
                                    -- Pilih --
                                </option>

                                <option value="L"
                                    <?= $siswa['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>
                                    Laki-laki
                                </option>

                                <option value="P"
                                    <?= $siswa['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>
                                    Perempuan
                                </option>

                            </select>

                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>
                            <input
                                type="date"
                                name="tanggal_lahir"
                                value="<?= htmlspecialchars($siswa['tanggal_lahir']); ?>"
                                required
                            >
                        </td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>
                            <textarea
                                name="alamat"
                                required
                            ><?= htmlspecialchars($siswa['alamat']); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>

                            <select name="status_aktif" required>

                                <option value="1"
                                    <?= $siswa['status_aktif'] == 1 ? 'selected' : ''; ?>>
                                    Aktif
                                </option>

                                <option value="0"
                                    <?= $siswa['status_aktif'] == 0 ? 'selected' : ''; ?>>
                                    Tidak Aktif
                                </option>

                            </select>

                        </td>
                    </tr>

                    <tr>

                        <td></td>

                        <td>

                            <button type="submit" name="update">
                                Update
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