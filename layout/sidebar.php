<?php
require_once __DIR__ . "/../config/session.php";
require_once __DIR__ . "/../config/koneksi.php";

$current_page = $_SERVER['REQUEST_URI'];

$is_wali_kelas = false;

if ($_SESSION['user_role'] == 'guru') {
    $user_id = (int) $_SESSION['user_id'];

    $query_wali = mysqli_query($conn, "
        SELECT wk.id
        FROM t_wali_kelas wk
        INNER JOIN t_guru g ON wk.guru_id = g.id
        WHERE g.user_id = $user_id
        AND wk.status_aktif = 1
        LIMIT 1
    ");

    if (mysqli_num_rows($query_wali) > 0) {
        $is_wali_kelas = true;
    }
}
?>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        overflow-y: auto;
        z-index: 1000;
        padding: 20px !important;
    }

    .sidebar-brand {
        color: white;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 5px;
    }

    .sidebar-subtitle {
        color: #adb5bd;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .sidebar hr {
        border-color: rgba(255, 255, 255, 0.2);
        margin: 15px 0;
    }

    .menu-sidebar {
        display: flex;
        align-items: center;
        gap: 12px;
        color: white !important;
        background-color: transparent;
        border-radius: 8px;
        padding: 10px 12px;
        transition: 0.2s;
        font-size: 14px;
    }

    .menu-sidebar i {
        font-size: 18px;
        width: 22px;
        text-align: center;
    }

    .menu-sidebar:hover {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.12);
        transform: translateX(3px);
    }

    .menu-sidebar.active {
        color: white !important;
        background-color: #0d6efd;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }

    .logout-sidebar {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #dc3545 !important;
        border-radius: 8px;
        padding: 10px 12px;
        transition: 0.2s;
    }

    .logout-sidebar i {
        font-size: 18px;
        width: 22px;
        text-align: center;
    }

    .logout-sidebar:hover {
        color: white !important;
        background-color: rgba(220, 53, 69, 0.2);
    }

    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.25);
        border-radius: 10px;
    }
</style>

<div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3 sidebar">

    <h4 class="sidebar-brand">
        <i class="bi bi-mortarboard-fill me-2"></i>
        SPSMU
    </h4>

    <div class="sidebar-subtitle">
        Sistem Pelanggaran Siswa
    </div>

    <hr>

    <?php if ($_SESSION['user_role'] == 'admin') { ?>

        <ul class="nav nav-pills flex-column">

            <li class="nav-item mb-2">
                <a href="/UKK-2026/dashboard.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/dashboard.php') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_siswa/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/kelola_siswa/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-people-fill"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>


            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_guru/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/kelola_guru/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Kelola Guru</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/wali_kelas/index.php"
                    class="nav-link menu-sidebar <?= strpos($current_page, '/admin/wali_kelas/') !== false ? 'active' : ''; ?>">
                     <i class="bi bi-person-check-fill"></i>
                    <span>Kelola Wali Kelas</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_kelas/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/kelola_kelas/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-easel2-fill"></i>
                    <span>Kelola Kelas</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_tahun_ajaran/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/kelola_tahun_ajaran/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-calendar3"></i>
                    <span>Kelola Tahun Ajaran</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/penempatan_siswa/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/penempatan_siswa/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-person-workspace"></i>
                    <span>Penempatan Siswa</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kategori_pelanggaran/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/kategori_pelanggaran/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-folder-fill"></i>
                    <span>Kategori Pelanggaran</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/jenis_pelanggaran/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/jenis_pelanggaran/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>Jenis Pelanggaran</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/laporan/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/admin/laporan/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/about.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/about.php') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>About</span>
                </a>
            </li>

            <hr>

            <li class="nav-item">
                <a href="/UKK-2026/logout.php"
                   class="nav-link logout-sidebar">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    <?php } elseif ($_SESSION['user_role'] == 'guru') { ?>

        <ul class="nav nav-pills flex-column">

            <li class="nav-item mb-2">
                <a href="/UKK-2026/dashboard.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/dashboard.php') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/guru/catat_pelanggaran/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/guru/catat_pelanggaran/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-clipboard2-plus-fill"></i>
                    <span>Catat Pelanggaran</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/guru/tindakan/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/guru/tindakan/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-hammer"></i>
                    <span>Tindakan</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/guru/rekap_poin/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/guru/rekap_poin/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Rekap Poin</span>
                </a>
            </li>

            <?php if ($is_wali_kelas) { ?>
                <li class="nav-item mb-2">
                    <a href="/UKK-2026/guru/laporan/index.php"
                       class="nav-link menu-sidebar <?= strpos($current_page, '/guru/laporan/') !== false ? 'active' : ''; ?>">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php } ?>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/guru/riwayat/index.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/guru/riwayat/') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/about.php"
                   class="nav-link menu-sidebar <?= strpos($current_page, '/about.php') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>About</span>
                </a>
            </li>

            <hr>

            <li class="nav-item">
                <a href="/UKK-2026/logout.php"
                   class="nav-link logout-sidebar">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    <?php } ?>

</div>