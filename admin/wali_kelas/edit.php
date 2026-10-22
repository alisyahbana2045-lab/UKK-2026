<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("ID wali kelas tidak valid.");
}

$query_data = mysqli_query($conn, "
    SELECT *
    FROM t_walikelas
    WHERE id = $id
");

if (!$query_data) {
    die("Query data gagal: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query_data);

if (!$data) {
    die("Data wali kelas tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tahun_ajaran_id = (int) $_POST['tahun_ajaran_id'];
    $kelas_id = (int) $_POST['kelas_id'];
    $guru_id = (int) $_POST['guru_id'];
    $tanggal_mulai = mysqli_real_escape_string($conn, $_POST['tanggal_mulai']);
    $tanggal_selesai = mysqli_real_escape_string($conn, $_POST['tanggal_selesai']);

    if ($tahun_ajaran_id <= 0 || $kelas_id <= 0 || $guru_id <= 0) {
        die("Data tahun ajaran, kelas, dan guru wajib dipilih.");
    }

    if ($tanggal_mulai == '' || $tanggal_selesai == '') {
        die("Tanggal mulai dan tanggal selesai wajib diisi.");
    }

    if ($tanggal_selesai < $tanggal_mulai) {
        die("Tanggal selesai tidak boleh lebih awal dari tanggal mulai.");
    }

    $cek = mysqli_query($conn, "
        SELECT id
        FROM t_walikelas
        WHERE tahun_ajaran_id = $tahun_ajaran_id
        AND kelas_id = $kelas_id
        AND status_aktif = 1
        AND id != $id
        LIMIT 1
    ");

    if (!$cek) {
        die("Query pengecekan gagal: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($cek) > 0) {
        die("Kelas tersebut sudah memiliki wali kelas aktif pada tahun ajaran yang dipilih.");
    }

    $query = mysqli_query($conn, "
        UPDATE t_walikelas SET
            tahun_ajaran_id = $tahun_ajaran_id,
            kelas_id = $kelas_id,
            guru_id = $guru_id,
            tanggal_mulai = '$tanggal_mulai',
            tanggal_selesai = '$tanggal_selesai'
        WHERE id = $id
    ");

    if (!$query) {
        die("Data wali kelas gagal diperbarui: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}

$query_tahun = mysqli_query($conn, "
    SELECT id, nama
    FROM t_tahun_ajaran
    WHERE status_aktif = 1
    ORDER BY id DESC
");

if (!$query_tahun) {
    die("Query tahun ajaran gagal: " . mysqli_error($conn));
}

$query_kelas = mysqli_query($conn, "
    SELECT id, nama, tingkat, jurusan
    FROM t_kelas
    WHERE status_aktif = 1
    ORDER BY tingkat ASC, nama ASC
");

if (!$query_kelas) {
    die("Query kelas gagal: " . mysqli_error($conn));
}

$query_guru = mysqli_query($conn, "
    SELECT id, nip, nama
    FROM t_guru
    WHERE status_aktif = 1
    ORDER BY nama ASC
");

if (!$query_guru) {
    die("Query guru gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wali Kelas</title>

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
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <?php require_once "../../layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 main-content">

            <div class="mb-4">
                <h1 class="fw-bold mb-1">Edit Wali Kelas</h1>
                <p class="text-muted mb-0">
                    Perbarui Data Wali Kelas
                </p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Tahun Ajaran
                            </label>

                            <select name="tahun_ajaran_id" class="form-select" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>

                                <?php while ($tahun = mysqli_fetch_assoc($query_tahun)) { ?>

                                    <option value="<?= $tahun['id']; ?>"
                                        <?= ($tahun['id'] == $data['tahun_ajaran_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($tahun['nama']); ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Kelas
                            </label>

                            <select name="kelas_id" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>

                                <?php while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>

                                    <option value="<?= $kelas['id']; ?>"
                                        <?= ($kelas['id'] == $data['kelas_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kelas['nama']); ?>
                                        - <?= htmlspecialchars($kelas['tingkat']); ?>
                                        <?= !empty($kelas['jurusan']) ? ' - ' . htmlspecialchars($kelas['jurusan']) : ''; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Guru / Wali Kelas
                            </label>

                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>

                                <?php while ($guru = mysqli_fetch_assoc($query_guru)) { ?>

                                    <option value="<?= $guru['id']; ?>"
                                        <?= ($guru['id'] == $data['guru_id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($guru['nama']); ?>
                                        - NIP <?= htmlspecialchars($guru['nip']); ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Tanggal Mulai
                                </label>

                                <input type="date"
                                       name="tanggal_mulai"
                                       class="form-control"
                                       value="<?= htmlspecialchars($data['tanggal_mulai']); ?>"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Tanggal Selesai
                                </label>

                                <input type="date"
                                       name="tanggal_selesai"
                                       class="form-control"
                                       value="<?= htmlspecialchars($data['tanggal_selesai']); ?>"
                                       required>
                            </div>

                        </div>

                        <div class="d-flex gap-2">

                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </main>

    </div>
</div>

</body>
</html>