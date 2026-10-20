<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM t_kelas WHERE id = $id");

if (!$query || mysqli_num_rows($query) == 0) {
    echo "Data kelas tidak ditemukan.";
    exit;
}

$kelas = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $tingkat = $_POST['tingkat'];
    $jurusan = $_POST['jurusan'];
    $status_aktif = $_POST['status_aktif'];

    $update = mysqli_query($conn, "UPDATE t_kelas SET
        nama = '$nama',
        tingkat = '$tingkat',
        jurusan = '$jurusan',
        status_aktif = '$status_aktif'
        WHERE id = $id
    ");

    if ($update) {
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
    <title>Edit Kelas</title>
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
                <h1 class="fw-bold mb-1">Edit Kelas</h1>
                <p class="text-muted mb-0">Edit data kelas.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Kelas</label>
                                <input type="text" name="nama" class="form-control"
                                    value="<?= htmlspecialchars($kelas['nama']); ?>" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tingkat</label>
                                <select name="tingkat" class="form-select" required>
                                    <option value="X" <?= $kelas['tingkat'] == 'X' ? 'selected' : ''; ?>>X</option>
                                    <option value="XI" <?= $kelas['tingkat'] == 'XI' ? 'selected' : ''; ?>>XI</option>
                                    <option value="XII" <?= $kelas['tingkat'] == 'XII' ? 'selected' : ''; ?>>XII</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control"
                                    value="<?= htmlspecialchars($kelas['jurusan']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Status</label>
                                <select name="status_aktif" class="form-select" required>
                                    <option value="1" <?= $kelas['status_aktif'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="0" <?= $kelas['status_aktif'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>