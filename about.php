<?php

require_once "config/session.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Me - Sistem Pelanggaran Siswa</title>

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

        .menu-sidebar.active {
            color: white;
            background-color: #0d6efd;
        }

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
        <?php require_once "layout/sidebar.php"; ?>


        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4 main-content">

            <h2>Sistem Pelanggaran Siswa</h2>

            <hr>

            <div class="card shadow mx-auto" style="max-width: 600px;">

                <div class="card-body text-center p-5">

                    <h1 class="mb-4">
                        About Me
                    </h1>

                    <h3>
                        Ali Syahbana
                    </h3>

                    <p class="text-muted">
                        Siswa SMK Rekayasa Perangkat Lunak
                    </p>

                    <hr>

                    <p>
                        Halo, saya adalah seorang siswa yang sedang belajar
                        membuat aplikasi berbasis web menggunakan PHP,
                        MySQL, HTML, CSS, dan Bootstrap.
                    </p>

                    <div class="row mt-4">

                        <div class="col-md-6 mb-3">

                            <strong>Nama</strong>

                            <p>
                                Mohammad Atalarik Ali Syahbana
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Kelas</strong>

                            <p>
                                XII RPL 2
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Jurusan</strong>

                            <p>
                                Rekayasa Perangkat Lunak
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Hobi</strong>

                            <p>
                                Futsal
                            </p>

                        </div>

                    </div>

                    <a href="dashboard.php" class="btn btn-primary">
                        Kembali ke Dashboard
                    </a>

                </div>

            </div>

        </main>

    </div>

</div>
</body>
</html>