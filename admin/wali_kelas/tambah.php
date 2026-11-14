
<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$error = '';
$tahun_ajaran_id = 0;
$kelas_id = 0;
$guru_id = 0;
$tanggal_mulai = '';
$tanggal_selesai = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tahun_ajaran_id = (int) $_POST['tahun_ajaran_id'];
    $kelas_id = (int) $_POST['kelas_id'];
    $guru_id = (int) $_POST['guru_id'];

    $tanggal_mulai = mysqli_real_escape_string($conn, $_POST['tanggal_mulai']);
    $tanggal_selesai = mysqli_real_escape_string($conn, $_POST['tanggal_selesai']);

    // VALIDASI DATA
    if ($tahun_ajaran_id <= 0 || $kelas_id <= 0 || $guru_id <= 0) {

        $error = "Tahun ajaran, kelas, dan guru wajib dipilih.";

    } elseif ($tanggal_mulai == '' || $tanggal_selesai == '') {

        $error = "Tanggal mulai dan tanggal selesai wajib diisi.";

    } elseif ($tanggal_selesai < $tanggal_mulai) {

        $error = "Tanggal selesai tidak boleh lebih awal dari tanggal mulai.";

    } else {

        // CEK APAKAH KELAS SUDAH MEMILIKI WALI KELAS
        $cek_kelas = mysqli_query($conn, "
            SELECT id
            FROM t_wali_kelas
            WHERE tahun_ajaran_id = $tahun_ajaran_id
            AND kelas_id = $kelas_id
            AND status_aktif = 1
            LIMIT 1
        ");

        if (!$cek_kelas) {

            $error = "Pengecekan kelas gagal: " . mysqli_error($conn);

        } elseif (mysqli_num_rows($cek_kelas) > 0) {

            $error = "Kelas tersebut sudah memiliki wali kelas aktif pada tahun ajaran yang dipilih. Silakan pilih kelas lain.";

        } else {

            // CEK APAKAH GURU SUDAH MENJADI WALI KELAS
            $cek_guru = mysqli_query($conn, "
                SELECT id
                FROM t_wali_kelas
                WHERE tahun_ajaran_id = $tahun_ajaran_id
                AND guru_id = $guru_id
                AND status_aktif = 1
                LIMIT 1
            ");

            if (!$cek_guru) {

                $error = "Pengecekan guru gagal: " . mysqli_error($conn);

            } elseif (mysqli_num_rows($cek_guru) > 0) {

                $error = "Guru tersebut sudah ditugaskan sebagai wali kelas pada tahun ajaran ini. Silakan pilih guru lain.";

            } else {

                // SIMPAN DATA WALI KELAS
                $query = mysqli_query($conn, "
                    INSERT INTO t_wali_kelas
                    (
                        tahun_ajaran_id,
                        kelas_id,
                        guru_id,
                        tanggal_mulai,
                        tanggal_selesai,
                        status_aktif
                    )
                    VALUES
                    (
                        $tahun_ajaran_id,
                        $kelas_id,
                        $guru_id,
                        '$tanggal_mulai',
                        '$tanggal_selesai',
                        1
                    )
                ");

                if (!$query) {

                    $error = "Data wali kelas gagal disimpan: " . mysqli_error($conn);

                } else {

                    header("Location: index.php");
                    exit;

                }
            }
        }
    }
}

// DATA TAHUN AJARAN
$query_tahun = mysqli_query($conn, "
    SELECT id, nama
    FROM t_tahun_ajaran
    WHERE status_aktif = 1
    ORDER BY id DESC
");

if (!$query_tahun) {
    die("Query tahun ajaran gagal: " . mysqli_error($conn));
}

// DATA KELAS
$query_kelas = mysqli_query($conn, "
    SELECT id, nama, tingkat, jurusan
    FROM t_kelas
    WHERE status_aktif = 1
    ORDER BY tingkat ASC, nama ASC
");

if (!$query_kelas) {
    die("Query kelas gagal: " . mysqli_error($conn));
}

// DATA GURU
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

    <title>Tambah Wali Kelas</title>

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

        <!-- SIDEBAR -->
        <?php require_once "../../layout/sidebar.php"; ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 main-content">

            <div class="mb-4">
                <h1 class="fw-bold mb-1">Tambah Wali Kelas</h1>
                <p class="text-muted mb-0">
                    Tambahkan data wali kelas baru
                </p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- PESAN ERROR -->
                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                                <div>
                                    <strong>Penugasan Gagal!</strong>
                                    <div><?= htmlspecialchars($error); ?></div>
                                </div>
                            </div>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close">
                            </button>

                        </div>
                    <?php } ?>

                    <form method="POST">

                        <!-- TAHUN AJARAN -->
                        <div class="mb-3">
                            <label class="form-label">
                                Tahun Ajaran
                            </label>

                            <select name="tahun_ajaran_id" class="form-select" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>

                                <?php while ($tahun = mysqli_fetch_assoc($query_tahun)) { ?>
                                    <option
                                        value="<?= $tahun['id']; ?>"
                                        <?= ($tahun_ajaran_id == $tahun['id']) ? 'selected' : ''; ?>>

                                        <?= htmlspecialchars($tahun['nama']); ?>

                                    </option>
                                <?php } ?>

                            </select>
                        </div>

                        <!-- KELAS -->
                        <div class="mb-3">
                            <label class="form-label">
                                Kelas
                            </label>

                            <select name="kelas_id" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>

                                <?php while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>
                                    <option
                                        value="<?= $kelas['id']; ?>"
                                        <?= ($kelas_id == $kelas['id']) ? 'selected' : ''; ?>>

                                        <?= htmlspecialchars($kelas['nama']); ?>
                                        - <?= htmlspecialchars($kelas['tingkat']); ?>
                                        <?= !empty($kelas['jurusan']) ? ' - ' . htmlspecialchars($kelas['jurusan']) : ''; ?>

                                    </option>
                                <?php } ?>

                            </select>
                        </div>

                        <!-- GURU -->
                        <div class="mb-3">
                            <label class="form-label">
                                Guru / Wali Kelas
                            </label>

                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>

                                <?php while ($guru = mysqli_fetch_assoc($query_guru)) { ?>
                                    <option
                                        value="<?= $guru['id']; ?>"
                                        <?= ($guru_id == $guru['id']) ? 'selected' : ''; ?>>

                                        <?= htmlspecialchars($guru['nama']); ?>
                                        - NIP <?= htmlspecialchars($guru['nip']); ?>

                                    </option>
                                <?php } ?>

                            </select>
                        </div>

                        <!-- TANGGAL -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Tanggal Mulai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    class="form-control"
                                    value="<?= htmlspecialchars($tanggal_mulai); ?>"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    class="form-control"
                                    value="<?= htmlspecialchars($tanggal_selesai); ?>"
                                    required>
                            </div>

                        </div>

                        <!-- TOMBOL -->
                        <div class="d-flex gap-2">

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Simpan
                            </button>

                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
