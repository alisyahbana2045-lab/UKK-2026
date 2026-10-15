<?php

require_once "config/session.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Pelanggaran Siswa</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">

    <style>

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
        }


        /* MENU SIDEBAR */

        .menu-sidebar {
            color: white;
            background-color: transparent;
            transition: 0.3s;
        }

        .menu-sidebar:hover {
            color: white;
            background-color: #0d6efd;
        }

        .menu-sidebar.active {
            color: white;
            background-color: #0d6efd;
        }


        /* KONTEN */

        .main-content {
            margin-left: 16.666667%;
            padding: 30px;
        }


        /* WELCOME */

        .welcome-card {
            border: none;
            border-radius: 12px;
            background-color: #00A1DB;;
            color: white;
        }


        /* CARD DATA */

        .data-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .data-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
        }

        .data-card .card-body {
            padding: 25px;
        }


        /* BUTTON */

        .btn {
            border-radius: 8px;
        }


        /* RESPONSIVE */

        @media (max-width: 991.98px) {

            .main-content {
                margin-left: 25%;
            }

        }

    </style>

</head>


<body>

<div class="container-fluid">

    <div class="row">


        <!-- SIDEBAR -->

        <div class="col-md-3 col-lg-2 sidebar">

            <?php require_once "layout/sidebar.php"; ?>

        </div>


        <!-- KONTEN -->

        <main class="col-md-9 col-lg-10 p-4 main-content">


            <!-- HEADER -->

            <div class="mb-4">

                <h2 class="fw-bold mb-1">
                    Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Sistem Pelanggaran Siswa
                </p>

            </div>


            <!-- SELAMAT DATANG -->

            <div class="card welcome-card shadow-sm mb-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-2">
                        Selamat Datang,
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>!
                    </h4>

                    <p class="mb-0">

                        Anda login sebagai

                        <span class="badge bg-light text-primary">
                            <?php echo htmlspecialchars($_SESSION['user_role']); ?>
                        </span>

                    </p>

                </div>

            </div>


            <!-- DATA CARD -->

            <div class="row">


                <!-- SISWA -->

                <div class="col-md-4 mb-4">

                    <div class="card data-card shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">


                                <div>

                                    <h5 class="card-title fw-bold mb-1">
                                        Data Siswa
                                    </h5>

                                    <small class="text-muted">
                                        Kelola data siswa
                                    </small>

                                </div>

                            </div>

                            <p class="text-muted">
                                Tambah, edit, dan kelola data siswa yang terdaftar.
                            </p>

                            <a
                                href="admin/kelola_siswa/index.php"
                                class="btn btn-primary"
                            >
                                Lihat Data
                            </a>

                        </div>

                    </div>

                </div>


                <!-- GURU -->

                <div class="col-md-4 mb-4">

                    <div class="card data-card shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">


                                <div>

                                    <h5 class="card-title fw-bold mb-1">
                                        Data Guru
                                    </h5>

                                    <small class="text-muted">
                                        Kelola data guru
                                    </small>

                                </div>

                            </div>

                            <p class="text-muted">
                                Tambah, edit, dan kelola data guru sekolah.
                            </p>

                            <a
                                href="admin/kelola_guru/index.php"
                                class="btn btn-primary"
                            >
                                Lihat Data
                            </a>

                        </div>

                    </div>

                </div>


                <!-- KELAS -->

                <div class="col-md-4 mb-4">

                    <div class="card data-card shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">


                                <div>

                                    <h5 class="card-title fw-bold mb-1">
                                        Data Kelas
                                    </h5>

                                    <small class="text-muted">
                                        Kelola data kelas
                                    </small>

                                </div>

                            </div>

                            <p class="text-muted">
                                Kelola data kelas dan informasi pembagian kelas.
                            </p>

                            <a
                                href="admin/kelola_kelas/index.php"
                                class="btn btn-primary"
                            >
                                Lihat Data
                            </a>

                        </div>

                    </div>

                </div>


            </div>


        </main>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>