<?php
require_once "config/session.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f1f3f5;
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

        .dashboard-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
        }

        .welcome-box {
            background-color: #212529;
            color: white;
            border-radius: 12px;
            padding: 30px;
        }

        .welcome-box span {
            color: #0d6efd;
        }

        .role-badge {
            background-color: #0d6efd;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
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
        <?php require_once "layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">
            <div class="welcome-box shadow-sm mb-4">
                <h1 class="fw-bold mb-2">Sistem Pelanggaran Siswa</h1>
                <p class="mb-3">
                    Selamat datang, <span><?= htmlspecialchars($_SESSION['user_name']); ?></span>!
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card dashboard-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold">Data Siswa</h5>
                            <p class="text-muted">
                                Kelola data siswa yang terdaftar di sekolah.
                            </p>
                            <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                <a href="/UKK-2026/admin/kelola_siswa/index.php" class="btn btn-primary">
                                    Kelola Siswa
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card dashboard-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold">Pelanggaran</h5>
                            <p class="text-muted">
                                Catat dan kelola data pelanggaran siswa.
                            </p>
                            <?php if ($_SESSION['user_role'] == 'guru') { ?>
                                <a href="/UKK-2026/guru/catat_pelanggaran/index.php" class="btn btn-primary">
                                    Catat Pelanggaran
                                </a>
                            <?php } else { ?>
                                <a href="/UKK-2026/admin/laporan/index.php" class="btn btn-primary">
                                    Lihat Laporan
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card dashboard-card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold">Laporan</h5>
                            <p class="text-muted">
                                Lihat dan cetak laporan pelanggaran siswa.
                            </p>
                            <a href="/UKK-2026/admin/laporan/index.php" class="btn btn-primary">
                                Lihat Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
</body>
</html>