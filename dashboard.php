<?php
require_once "config/session.php";
require_once "config/koneksi.php";

function hitung($conn, $query) {
    $result = mysqli_query($conn, $query);
    if (!$result) return 0;
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

$total_siswa = hitung($conn, "SELECT COUNT(*) AS total FROM t_siswa WHERE status_aktif = 1");
$total_guru = hitung($conn, "SELECT COUNT(*) AS total FROM t_guru WHERE status_aktif = 1");
$total_pelanggaran = hitung($conn, "SELECT COUNT(*) AS total FROM t_pelanggaran_siswa");
$total_kelas = hitung($conn, "SELECT COUNT(*) AS total FROM t_kelas");
$total_jenis = hitung($conn, "SELECT COUNT(*) AS total FROM t_pelanggaran WHERE status_aktif = 1");

$tahun_aktif = mysqli_query($conn, "
    SELECT nama
    FROM t_tahun_ajaran
    WHERE status_aktif = 1
    ORDER BY id DESC
    LIMIT 1
");

$data_tahun = mysqli_fetch_assoc($tahun_aktif);
$nama_tahun = $data_tahun ? $data_tahun['nama'] : '-';

$chart_labels = [];
$chart_data = [];

for ($i = 6; $i >= 0; $i--) {
    $tanggal = date('Y-m-d', strtotime("-$i days"));
    $chart_labels[] = date('d M', strtotime($tanggal));

    $query_chart = mysqli_query($conn, "
        SELECT COUNT(*) AS total
        FROM t_pelanggaran_siswa
        WHERE tanggal = '$tanggal'
    ");

    $data_chart = mysqli_fetch_assoc($query_chart);
    $chart_data[] = (int)$data_chart['total'];
}

$pelanggaran_terbanyak = mysqli_query($conn, "
    SELECT nama_pelanggaran, COUNT(*) AS jumlah
    FROM t_pelanggaran_siswa
    GROUP BY nama_pelanggaran
    ORDER BY jumlah DESC
    LIMIT 5
");

$aktivitas = mysqli_query($conn, "
    SELECT nama_siswa, nama_pelanggaran, tanggal, nama_guru
    FROM t_pelanggaran_siswa
    ORDER BY id DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: #f1f3f5;
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

        .welcome-box {
            background: #212529;
            color: white;
            border-radius: 12px;
            padding: 25px 30px;
        }

        .welcome-box h1 {
            font-size: 32px;
        }

        .welcome-box span {
            color: #0d6efd;
        }

        .role-badge {
            display: inline-block;
            background: #0d6efd;
            color: white;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 13px;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #212529;
            color: white;
            border-radius: 12px;
            font-size: 23px;
        }

        .stat-title {
            color: #6c757d;
            font-size: 14px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #212529;
        }

        .dashboard-box {
            background: white;
            border-radius: 12px;
            border: none;
        }

        .dashboard-title {
            font-size: 18px;
            font-weight: bold;
            color: #212529;
        }

        .chart-container {
            height: 280px;
        }

        .table thead th {
            background: #f8f9fa;
            color: #212529;
            border-bottom: 1px solid #dee2e6;
        }

        .activity-item {
            padding: 12px 5px;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #212529;
            color: white;
            border-radius: 50%;
        }

        .quick-menu {
            text-decoration: none;
            color: #212529;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px 10px;
            display: block;
            text-align: center;
            transition: 0.3s;
        }

        .quick-menu:hover {
            background: #0d6efd;
            color: white;
            transform: translateY(-3px);
        }

        .quick-menu i {
            font-size: 25px;
            display: block;
            margin-bottom: 8px;
        }

        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 25%;
            }
        }

        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .welcome-box h1 {
                font-size: 25px;
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
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="fw-bold mb-2">Sistem Pelanggaran Siswa</h1>
                        <p class="mb-2">
                            Selamat datang,
                            <span><?= htmlspecialchars($_SESSION['user_name']); ?></span>!
                        </p>
                        <span>
                            <i class="bi bi-person-fill"></i>
                            <?= htmlspecialchars(ucfirst($_SESSION['user_role'])); ?>
                        </span>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i  style="font-size:75px;"></i>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="stat-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <div class="stat-title">Total Siswa</div>
                                <div class="stat-number"><?= $total_siswa; ?></div>
                                <small class="text-muted">Siswa aktif</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="stat-icon">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <div>
                                <div class="stat-title">Total Guru</div>
                                <div class="stat-number"><?= $total_guru; ?></div>
                                <small class="text-muted">Guru aktif</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="stat-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div>
                                <div class="stat-title">Total Pelanggaran</div>
                                <div class="stat-number"><?= $total_pelanggaran; ?></div>
                                <small class="text-muted">Data pelanggaran</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="stat-icon">
                                <i class="bi bi-calendar-event-fill"></i>
                            </div>
                            <div>
                                <div class="stat-title">Tahun Ajaran Aktif</div>
                                <div class="stat-number" style="font-size:22px;">
                                    <?= htmlspecialchars($nama_tahun); ?>
                                </div>
                                <small class="text-muted">Tahun ajaran</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row g-4 mb-4">

                <div class="col-lg-8">
                    <div class="card dashboard-box shadow-sm h-100">
                        <div class="card-body">
                            <div class="dashboard-title mb-3">
                                <i class="bi bi-bar-chart-fill me-2"></i>
                                Grafik Pelanggaran 7 Hari Terakhir
                            </div>
                            <div class="chart-container">
                                <canvas id="grafikPelanggaran"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card dashboard-box shadow-sm h-100">
                        <div class="card-body">
                            <div class="dashboard-title mb-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Pelanggaran Terbanyak
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (mysqli_num_rows($pelanggaran_terbanyak) > 0) {
                                            while ($row = mysqli_fetch_assoc($pelanggaran_terbanyak)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($row['nama_pelanggaran']); ?></td>
                                                <td><?= $row['jumlah']; ?></td>
                                            </tr>
                                        <?php
                                            }
                                        } else {
                                        ?>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">
                                                    Belum ada data
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row g-4">

                <div class="col-lg-8">
                    <div class="card dashboard-box shadow-sm">
                        <div class="card-body">
                            <div class="dashboard-title mb-3">
                                <i class="bi bi-clock-history me-2"></i>
                                Aktivitas Terbaru
                            </div>

                            <?php if (mysqli_num_rows($aktivitas) > 0) { ?>
                                <?php while ($row = mysqli_fetch_assoc($aktivitas)) { ?>
                                    <div class="activity-item d-flex align-items-center gap-3">
                                        <div class="activity-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <strong><?= htmlspecialchars($row['nama_siswa']); ?></strong>
                                                melakukan pelanggaran:
                                                <?= htmlspecialchars($row['nama_pelanggaran']); ?>
                                            </div>
                                            <small class="text-muted">
                                                Guru: <?= htmlspecialchars($row['nama_guru']); ?>
                                            </small>
                                        </div>
                                        <small class="text-muted">
                                            <?= date('d M Y', strtotime($row['tanggal'])); ?>
                                        </small>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="text-center text-muted py-4">
                                    Belum ada aktivitas pelanggaran.
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card dashboard-box shadow-sm">
                        <div class="card-body">
                            <div class="dashboard-title mb-3">
                                <i class="bi bi-lightning-fill me-2"></i>
                                Menu Cepat
                            </div>

                            <div class="row g-3">

                                <?php if ($_SESSION['user_role'] == 'admin') { ?>

                                    <div class="col-6">
                                        <a href="/UKK-2026/admin/kelola_siswa/tambah.php" class="quick-menu">
                                            <i class="bi bi-person-plus-fill"></i>
                                            Tambah Siswa
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="/UKK-2026/admin/kelola_guru/tambah.php" class="quick-menu">
                                            <i class="bi bi-person-badge-fill"></i>
                                            Tambah Guru
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="/UKK-2026/admin/kelola_kelas/index.php" class="quick-menu">
                                            <i class="bi bi-building-fill"></i>
                                            Kelola Kelas
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="/UKK-2026/admin/laporan/index.php" class="quick-menu">
                                            <i class="bi bi-file-earmark-text-fill"></i>
                                            Lihat Laporan
                                        </a>
                                    </div>

                                <?php } else { ?>

                                    <div class="col-6">
                                        <a href="/UKK-2026/guru/catat_pelanggaran/index.php" class="quick-menu">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            Catat Pelanggaran
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="/UKK-2026/guru/tindakan/index.php" class="quick-menu">
                                            <i class="bi bi-hammer"></i>
                                            Tindakan
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="/UKK-2026/guru/rekap_poin/index.php" class="quick-menu">
                                            <i class="bi bi-bar-chart-fill"></i>
                                            Rekap Poin
                                        </a>
                                    </div>

                                    <div class="col-6">
                                        <a href="/UKK-2026/guru/laporan/index.php" class="quick-menu">
                                            <i class="bi bi-file-earmark-text-fill"></i>
                                            Lihat Laporan
                                        </a>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

<script>
const ctx = document.getElementById('grafikPelanggaran');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_labels); ?>,
        datasets: [{
            label: 'Pelanggaran',
            data: <?= json_encode($chart_data); ?>,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.15)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: '#0d6efd'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>