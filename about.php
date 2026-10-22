<?php
require_once "config/session.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me - Sistem Pelanggaran Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f1f3f5;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 40px;
        }

        .about-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .about-header {
            background: #212529;
            height: 150px;
        }

        .profile-wrapper {
            margin-top: -100px;
            text-align: center;
        }

        .profile-img {
            width: 190px;
            height: 190px;
            object-fit: cover;
            border-radius: 50%;
            border: 7px solid #fff;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .profile-name {
            font-size: 30px;
            font-weight: bold;
            margin-top: 20px;
            color: #212529;
        }

        .profile-role {
            color: #6c757d;
            font-size: 16px;
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 14px;
            padding: 20px;
            height: 100%;
            border: 1px solid #e9ecef;
        }

        .info-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #212529;
            color: #fff;
            border-radius: 12px;
            font-size: 20px;
        }

        .about-description {
            color: #6c757d;
            line-height: 1.8;
        }

        .skill-badge {
            display: inline-block;
            background: #212529;
            color: #fff;
            padding: 8px 14px;
            border-radius: 20px;
            margin: 4px;
            font-size: 14px;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #212529;
            color: #fff;
            text-decoration: none;
            margin: 4px;
            transition: 0.3s;
        }

        .social-btn:hover {
            background: #0d6efd;
            color: #fff;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .about-header {
                height: 120px;
            }

            .profile-img {
                width: 150px;
                height: 150px;
            }

            .profile-wrapper {
                margin-top: -75px;
            }

            .profile-name {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<?php include "layout/sidebar.php"; ?>

<div class="main-content">
    <div class="container-fluid">

        <div class="mb-4">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-person-circle"></i> About Me
            </h2>
            <p class="text-muted mb-0">
                Tentang pembuat Sistem Pelanggaran Siswa
            </p>
        </div>

        <div class="about-card">

            <div class="about-header"></div>

            <div class="profile-wrapper px-4 pb-4">
                <img src="assets/png/Ustadz Muda.png" alt="Foto Profil" class="profile-img">

                <h1 class="profile-name">Ali Syahbana</h1>
                <p class="profile-role">
                    <i class="bi bi-mortarboard-fill"></i>
                    Siswa SMK Rekayasa Perangkat Lunak
                </p>

                <p class="about-description mx-auto mt-3" style="max-width: 750px;">
                    Saya merupakan siswa SMK jurusan Rekayasa Perangkat Lunak
                    yang sedang mempelajari pengembangan aplikasi berbasis web.
                    Saya memiliki ketertarikan dalam membuat website menggunakan
                    PHP, MySQL, HTML, CSS, dan Bootstrap.
                </p>

                <div class="mt-3">
                    <a href="#" class="social-btn">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-btn">
                        <i class="bi bi-github"></i>
                    </a>
                    <a href="#" class="social-btn">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>

            <div class="px-4 px-md-5 pb-5">
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="info-icon">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Nama</small>
                                    <h5 class="mb-0 fw-bold">Ali Syahbana</h5>
                                </div>
                            </div>
                            <p class="text-muted mb-0">
                                Siswa SMK MUHAMMADIYAH Jurusan Rekayasa Perangkat Lunak yang sedang
                                mengembangkan kemampuan di bidang pemrograman web.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="info-icon">
                                    <i class="bi bi-code-slash"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Keahlian</small>
                                    <h5 class="mb-0 fw-bold">Web Development</h5>
                                </div>
                            </div>
                            <p class="text-muted mb-0">
                                Mempelajari pembuatan aplikasi web dengan teknologi
                                front-end dan back-end.
                            </p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-box">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-tools"></i> Teknologi yang Dipelajari
                            </h5>

                            <div>
                                <span class="skill-badge">
                                    <i class="bi bi-filetype-html"></i> HTML
                                </span>

                                <span class="skill-badge">
                                    <i class="bi bi-filetype-css"></i> CSS
                                </span>

                                <span class="skill-badge">
                                    <i class="bi bi-filetype-php"></i> PHP
                                </span>

                                <span class="skill-badge">
                                    <i class="bi bi-database-fill"></i> MySQL
                                </span>

                                <span class="skill-badge">
                                    <i class="bi bi-bootstrap-fill"></i> Bootstrap
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-box">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-laptop"></i> Tentang Project
                            </h5>

                            <p class="about-description mb-0">
                                <strong>Sistem Pelanggaran Siswa</strong> merupakan
                                aplikasi berbasis web yang dibuat untuk membantu
                                sekolah dalam mengelola data siswa, data guru,
                                kelas, tahun ajaran, jenis pelanggaran, kategori
                                pelanggaran, serta pencatatan pelanggaran siswa.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="text-center text-muted mt-4">
            <small>
                &copy; 2026 Sistem Pelanggaran Siswa
            </small>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>