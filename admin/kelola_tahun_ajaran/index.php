<?php
require_once "../../config/admin.php";
?>
<?php

require_once "../../config/admin.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>Kelola Siswa</title>

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

    <div class="row">

        <!-- SIDEBAR -->
        <?php require_once "../../layout/sidebar.php"; ?>


        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4 main-content">

            <h2>Kelola Siswa</h2>

            <hr>

            <p>
                Ini adalah halaman Kelola Siswa.
            </p>

        </main>

    </div>

</div>

</body>

</html>
