<?php

require_once "config/session.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Sistem Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
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

    @media (max-width: 991.98px) {
        .main-content {
            margin-left: 25%;
        }
    }
</style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
         <div class="col-md-3 col-lg-2 sidebar">

            <?php require_once "layout/sidebar.php"; ?>

        </div>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4 main-content">


    <h2>Sistem Pelanggaran Siswa</h2>
    <hr>

    <p>
        Selamat Datang,
        <strong><?php echo $_SESSION['user_name']; ?></strong>
    </p>
    <p>
        Anda Login Sebagai:
        <strong><?php echo $_SESSION['user_role']; ?></strong>
    </p>

            <div class="row">


            <?php if ($_SESSION['user_role'] == 'admin') {
                echo "";
            } else {
                echo ""; } ?>

                <!-- CARD DATA SISWA -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">

                        <div class="card-body ">

                            <h5 class="card-title">
                                Data Siswa
                            </h5>

                            <h2>
                                <a href="admin/kelola_siswa/index.php">
                                    <button type="submit" class="btn btn-outline-success ">Lihat</button>
                                </a>
                            </h2>

                        </div>

                    </div>
                </div>


                <!-- CARD DATA GURU -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">

                        <div class="card-body">

                            <h5 class="card-title">
                                Data Guru
                            </h5>

                            <h2>
                                <button type="submit" class="btn btn-outline-success ">Lihat</button>
                            </h2>

                        </div>

                    </div>
                </div>


                <!-- CARD KELAS -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">

                        <div class="card-body">

                            <h5 class="card-title">
                                Kelas
                            </h5>

                            <h2>
                                <button type="submit" class="btn btn-outline-success ">Lihat</button>
                            </h2>

                        </div>

                    </div>
                </div>

            </div>

        </main>

    </div>
</div>


</body>

</html>