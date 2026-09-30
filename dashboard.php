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
</style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3">

            <h4 class="text-white mb-4">
                SMK MUHAMMADIYAH
            </h4>
            <hr class="text-secondary">

    <?php if ($_SESSION['user_role'] == 'admin') { ?>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-2">
                    <a href="admin/menu1/" class="nav-link menu-sidebar ">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="admin/menu1/" class="nav-link menu-sidebar ">
                        Data Siswa
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="admin/menu2" class="nav-link menu-sidebar">
                        Data Guru
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="admin/menu3" class="nav-link menu-sidebar">
                        Kelas
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="admin/menu4" class="nav-link menu-sidebar">
                        Laporan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="about.php" class="nav-link menu-sidebar">
                        About
                    </a>
                <hr class="text-secondary">

                <li class="nav-item">
                    <a href="logout.php" class="nav-link text-danger">
                        Logout
                    </a>
                </li>
            </ul>

    <?php } elseif ($_SESSION['user_role'] == 'guru') { ?>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link menu-sidebar">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="guru/menu3/index.php" class="nav-link menu-sidebar">
                        Menu 3
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="guru/menu4/index.php" class="nav-link menu-sidebar">
                        Menu 4
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="guru/menu5/index.php" class="nav-link menu-sidebar">
                        Menu 5
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="about.php" class="nav-link menu-sidebar">
                        About 
                    </a>
                </li>
                <hr class="text-secondary">

                <li class="nav-item">
                    <a href="logout.php" class="nav-link text-danger">
                        Logout
                    </a>
                </li>
            </ul>
        <?php } ?>
        </div>


        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">


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

                        <div class="card-body">

                            <h5 class="card-title">
                                Data Siswa
                            </h5>

                            <h2>
                                <button type="submit" class="btn btn-outline-success ">Lihat</button>
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