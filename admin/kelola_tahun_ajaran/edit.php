
<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

date_default_timezone_set('Asia/Jakarta');

$hari_ini = date('Y-m-d');

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data tahun ajaran
$query = mysqli_query($conn, "
    SELECT *
    FROM t_tahun_ajaran
    WHERE id = $id
");

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data tahun ajaran tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

// Cek apakah tahun ajaran masih dalam rentang tanggal
$boleh_aktif = (
    $hari_ini >= $data['tanggal_mulai'] &&
    $hari_ini <= $data['tanggal_selesai']
);

// Proses update
if (isset($_POST['update'])) {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $status_aktif = (int) $_POST['status_aktif'];

    // Validasi tanggal
    if ($tanggal_selesai < $tanggal_mulai) {

        $error = "Tanggal selesai tidak boleh lebih awal dari tanggal mulai.";

    } elseif (
        $status_aktif == 1 &&
        ($hari_ini < $tanggal_mulai || $hari_ini > $tanggal_selesai)
    ) {

        $error = "Tahun ajaran tidak bisa diaktifkan karena belum dimulai atau sudah melewati tanggal selesai.";

    } else {

        $update = mysqli_query($conn, "
            UPDATE t_tahun_ajaran SET
                nama = '$nama',
                tanggal_mulai = '$tanggal_mulai',
                tanggal_selesai = '$tanggal_selesai',
                status_aktif = '$status_aktif'
            WHERE id = $id
        ");

        if ($update) {

            header("Location: index.php");
            exit;

        } else {

            $error = "Data gagal diubah: " . mysqli_error($conn);

        }

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Tahun Ajaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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

            <div class="mb-4">

                <h1 class="fw-bold mb-1">
                    Edit Tahun Ajaran
                </h1>

                <p class="text-muted mb-0">
                    Edit data tahun ajaran.
                </p>

            </div>

            <div class="card shadow-sm">

                <div class="card-body">

                    <?php if (isset($error)) : ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error); ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Tahun Ajaran
                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                value="<?= htmlspecialchars($data['nama']); ?>"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control"
                                value="<?= htmlspecialchars($data['tanggal_mulai']); ?>"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control"
                                value="<?= htmlspecialchars($data['tanggal_selesai']); ?>"
                                required
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status_aktif" class="form-select" required>

                                <option
                                    value="1"
                                    <?= $data['status_aktif'] == 1 ? 'selected' : ''; ?>
                                    <?= !$boleh_aktif ? 'disabled' : ''; ?>
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    <?= $data['status_aktif'] == 0 ? 'selected' : ''; ?>
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                            <?php if (!$boleh_aktif) : ?>

                                <small class="text-danger">
                                    Tahun ajaran ini belum dimulai atau sudah melewati tanggal selesai sehingga tidak dapat diaktifkan.
                                </small>

                            <?php endif; ?>

                        </div>

                        <button type="submit" name="update" class="btn btn-primary">

                            <i class="bi bi-save"></i>
                            Simpan Perubahan

                        </button>

                        <a href="index.php" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
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
