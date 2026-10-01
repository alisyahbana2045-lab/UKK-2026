<?php

require_once __DIR__ . "/../config/session.php";

?>

<div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3 sidebar">

    <h4 class="text-white mb-4">
        SMK MUHAMMADIYAH
    </h4>

    <hr class="text-secondary">

    <?php if ($_SESSION['user_role'] == 'admin') { ?>

        <ul class="nav nav-pills flex-column">

            <li class="nav-item mb-2">
                <a href="/UKK-2026/dashboard.php"
                   class="nav-link menu-sidebar">
                    Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_siswa/index.php"
                   class="nav-link menu-sidebar">
                    Kelola Siswa
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_guru/index.php"
                   class="nav-link menu-sidebar">
                    Kelola Guru
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_kelas/index.php"
                   class="nav-link menu-sidebar">
                    Kelola Kelas
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/admin/kelola_tahun_ajaran/index.php"
                   class="nav-link menu-sidebar">
                    Kelola Tahun Ajaran
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/about.php"
                   class="nav-link menu-sidebar">
                    About
                </a>
            </li>

            <hr class="text-secondary">

            <li class="nav-item">
                <a href="/UKK-2026/logout.php"
                   class="nav-link text-danger">
                    Logout
                </a>
            </li>

        </ul>

    <?php } elseif ($_SESSION['user_role'] == 'guru') { ?>

        <ul class="nav nav-pills flex-column">

            <li class="nav-item mb-2">
                <a href="/UKK-2026/dashboard.php"
                   class="nav-link menu-sidebar">
                    Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/guru/catat_pelanggaran/index.php"
                   class="nav-link menu-sidebar">
                    Catat Pelanggaran
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/guru/tindakan/index.php"
                   class="nav-link menu-sidebar">
                    Tindakan
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="/UKK-2026/about.php"
                   class="nav-link menu-sidebar">
                    About
                </a>
            </li>

            <hr class="text-secondary">

            <li class="nav-item">
                <a href="/UKK-2026/logout.php"
                   class="nav-link text-danger">
                    Logout
                </a>
            </li>

        </ul>

    <?php } ?>

</div>