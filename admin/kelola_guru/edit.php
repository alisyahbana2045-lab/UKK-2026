<?php
require_once __DIR__."/../../config/admin.php";
require_once __DIR__."/../../config/koneksi.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID guru tidak valid.");
}

$id = (int) $_GET['id'];

$query = mysqli_query($conn, "SELECT
    g.*,
    u.email AS user_email
    FROM t_guru g
    LEFT JOIN t_users u ON g.user_id = u.id
    WHERE g.id = $id");

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data guru tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status_aktif = (int) $_POST['status_aktif'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($password !== $konfirmasi_password) {
        die("Konfirmasi password tidak sesuai.");
    }

    $cek = mysqli_query($conn, "SELECT id FROM t_users
        WHERE email = '$email'
        AND id != " . (int) $data['user_id']);

    if (mysqli_num_rows($cek) > 0) {
        die("Email sudah digunakan oleh akun lain.");
    }

    mysqli_begin_transaction($conn);

    try {
        if ($password != '') {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query_user = mysqli_query($conn, "UPDATE t_users SET
                name = '$nama',
                email = '$email',
                password = '$password_hash'
                WHERE id = " . (int) $data['user_id']);
        } else {
            $query_user = mysqli_query($conn, "UPDATE t_users SET
                name = '$nama',
                email = '$email'
                WHERE id = " . (int) $data['user_id']);
        }

        if (!$query_user) {
            throw new Exception(mysqli_error($conn));
        }

        $query_guru = mysqli_query($conn, "UPDATE t_guru SET
            nip = '$nip',
            nama = '$nama',
            email = '$email',
            status_aktif = $status_aktif
            WHERE id = $id");

        if (!$query_guru) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);

        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        die("Data guru gagal diubah: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guru - Sistem Pelanggaran Siswa</title>
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
                    <h3 class="fw-bold mb-4">Edit Guru</h3>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text"
                                name="nip"
                                class="form-control"
                                maxlength="30"
                                value="<?= htmlspecialchars($data['nip']); ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Guru</label>
                            <input type="text"
                                name="nama"
                                class="form-control"
                                maxlength="150"
                                value="<?= htmlspecialchars($data['nama']); ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                maxlength="150"
                                value="<?= htmlspecialchars($data['user_email']); ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password"
                                name="password"
                                class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password"
                                name="konfirmasi_password"
                                class="form-control"
                                placeholder="Ulangi password baru">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" class="form-select" required>
                                <option value="1" <?= $data['status_aktif'] == 1 ? 'selected' : ''; ?>>
                                    Aktif
                                </option>
                                <option value="0" <?= $data['status_aktif'] == 0 ? 'selected' : ''; ?>>
                                    Nonaktif
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
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