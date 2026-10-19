<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM t_guru WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data guru tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $status_aktif = $_POST['status_aktif'];

    $query = mysqli_query($conn, "UPDATE t_guru SET
        nip = '$nip',
        nama = '$nama',
        email = '$email',
        status_aktif = '$status_aktif'
        WHERE id = '$id'");

    if ($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guru</title>
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
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require_once "../../layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">
            <div class="mb-4">
                <h1 class="fw-bold mb-1">Edit Guru</h1>
                <p class="text-muted mb-0">Edit data guru.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($data['nip']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Guru</label>
                                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Status</label>
                                <select name="status_aktif" class="form-select" required>
                                    <option value="1" <?= $data['status_aktif'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="0" <?= $data['status_aktif'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>