<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = trim($_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if (!preg_match('/^[0-9]{1,18}$/', $nip)) {
        die("NIP harus berupa angka dan maksimal 18 digit.");
    }

    $nip = mysqli_real_escape_string($conn, $nip);

    if ($password == '') {
        die("Password wajib diisi.");
    }

    if ($password !== $konfirmasi_password) {
        die("Konfirmasi password tidak sesuai.");
    }

    $cek = mysqli_query($conn, "SELECT id FROM t_users WHERE email = '$email'");

    if (mysqli_num_rows($cek) > 0) {
        die("Email sudah digunakan.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_begin_transaction($conn);

    try {
        $query_user = mysqli_query($conn, "INSERT INTO t_users
            (name, email, password, role)
            VALUES
            ('$nama', '$email', '$password_hash', 'guru')");

        if (!$query_user) {
            throw new Exception(mysqli_error($conn));
        }

        $user_id = mysqli_insert_id($conn);

        $query_guru = mysqli_query($conn, "INSERT INTO t_guru
            (nip, nama, email, status_aktif, user_id)
            VALUES
            ('$nip', '$nama', '$email', 1, $user_id)");

        if (!$query_guru) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);

        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        die("Data guru gagal disimpan: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru - Sistem Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <?php require_once "../../layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4">Tambah Guru</h3>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text"
                                name="nip"
                                class="form-control"
                                maxlength="18"
                                pattern="[0-9]{1,18}"
                                inputmode="numeric"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Guru</label>
                            <input type="text" name="nama" class="form-control" maxlength="150" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" maxlength="150" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>