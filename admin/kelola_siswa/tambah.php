<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Siswa</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

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

        .form-card {
            border: none;
            border-radius: 12px;
        }

        .form-card .card-header {
            background-color: #00A1DB;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 18px 22px;
        }

        .form-card .card-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        .btn {
            border-radius: 8px;
            padding: 9px 18px;
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

            <!-- JUDUL -->

            <div class="mb-4">

                <h1 class="fw-bold mb-1">
                    Tambah Siswa
                </h1>

                <p class="text-muted mb-0">
                    Tambahkan data siswa baru ke dalam sistem.
                </p>

            </div>


            <!-- FORM -->

            <div class="card shadow-sm form-card">

                <div class="card-header">

                    <h5 class="mb-0">
                        Form Data Siswa
                    </h5>

                </div>


                <div class="card-body">

                    <form method="POST">

                        <div class="row">

                            <!-- NIS -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    NIS
                                </label>

                                <input
                                    type="text"
                                    name="nis"
                                    class="form-control"
                                    placeholder="Masukkan NIS"
                                    required
                                >

                            </div>


                            <!-- NISN -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    NISN
                                </label>

                                <input
                                    type="text"
                                    name="nisn"
                                    class="form-control"
                                    placeholder="Masukkan NISN"
                                    required
                                >

                            </div>


                            <!-- NAMA -->

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    placeholder="Masukkan nama lengkap siswa"
                                    required
                                >

                            </div>


                            <!-- JENIS KELAMIN -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Jenis Kelamin
                                </label>

                                <select
                                    name="jenis_kelamin"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        -- Pilih Jenis Kelamin --
                                    </option>

                                    <option value="L">
                                        Laki-laki
                                    </option>

                                    <option value="P">
                                        Perempuan
                                    </option>

                                </select>

                            </div>


                            <!-- TANGGAL LAHIR -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Tanggal Lahir
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <!-- ALAMAT -->

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Alamat
                                </label>

                                <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat lengkap siswa" required>
                                </textarea>

                            </div>


                            <!-- STATUS -->

                            <div class="col-md-6 mb-4">

                                <label class="form-label">
                                    Status Siswa
                                </label>

                                <select name="status_aktif" class="form-select" required>

                                    <option value="1">
                                        Aktif
                                    </option>

                                    <option value="0">
                                        Tidak Aktif
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- TOMBOL -->

                        <div class="d-flex gap-2">

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

        </td>

    </tr>

</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>