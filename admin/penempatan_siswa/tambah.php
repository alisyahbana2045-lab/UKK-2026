<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

// ================================
// PROSES SIMPAN
// ================================

if (isset($_POST['simpan'])) {
    $siswa_id = $_POST['siswa_id'];
    $tahun_ajaran_id = $_POST['tahun_ajaran_id'];
    $kelas_id = $_POST['kelas_id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $status_aktif = $_POST['status_aktif'];

    if ($tanggal_selesai < $tanggal_mulai) {
        $error = "Tanggal selesai tidak boleh lebih awal dari tanggal mulai.";
    } else {
        // CEK PENEMPATAN SISWA
        if ($status_aktif == 1) {
            $cek = mysqli_prepare($conn, "
                SELECT siswa_id
                FROM t_kelas_siswa
                WHERE siswa_id = ?
                AND tahun_ajaran_id = ?
                AND status_aktif = 1
                LIMIT 1
            ");

            mysqli_stmt_bind_param(
                $cek,
                "ii",
                $siswa_id,
                $tahun_ajaran_id
            );

            mysqli_stmt_execute($cek);
            mysqli_stmt_store_result($cek);

            if (mysqli_stmt_num_rows($cek) > 0) {
                $error = "Siswa sudah memiliki penempatan aktif pada tahun ajaran tersebut.";
            }

            mysqli_stmt_close($cek);
        }

        // SIMPAN DATA JIKA TIDAK ADA DUPLIKAT
        if (!isset($error)) {
            $query_simpan = mysqli_prepare($conn, "
                INSERT INTO t_kelas_siswa
                (siswa_id, tahun_ajaran_id, kelas_id, tanggal_mulai, tanggal_selesai, status_aktif)
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            mysqli_stmt_bind_param(
                $query_simpan,
                "iiissi",
                $siswa_id,
                $tahun_ajaran_id,
                $kelas_id,
                $tanggal_mulai,
                $tanggal_selesai,
                $status_aktif
            );

            if (mysqli_stmt_execute($query_simpan)) {
                header("Location: index.php");
                exit;
            } else {
                $error = "Data gagal disimpan: " . mysqli_stmt_error($query_simpan);
            }

            mysqli_stmt_close($query_simpan);
        }
    }
}

// ================================
// DATA SISWA
// ================================

$query_siswa = mysqli_query($conn, "
    SELECT id, nis, nama
    FROM t_siswa
    WHERE status_aktif = 1
    ORDER BY nama ASC
");

if (!$query_siswa) {
    die("Query siswa gagal: " . mysqli_error($conn));
}

// ================================
// DATA TAHUN AJARAN
// ================================

$query_tahun = mysqli_query($conn, "
    SELECT id, nama
    FROM t_tahun_ajaran
    WHERE status_aktif = 1
    ORDER BY id DESC
");

if (!$query_tahun) {
    die("Query tahun ajaran gagal: " . mysqli_error($conn));
}

// ================================
// DATA KELAS
// ================================

$query_kelas = mysqli_query($conn, "
    SELECT id, nama
    FROM t_kelas
    WHERE status_aktif = 1
    ORDER BY nama ASC
");

if (!$query_kelas) {
    die("Query kelas gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penempatan Siswa</title>
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
        }
        .menu-sidebar {
            color: white;
            background-color: transparent;
            transition: 0.3s;
        }
        .menu-sidebar:hover {
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
        <main class="col-md-9 col-lg-10 p-4 main-content">
            <div class="mb-4">
                <h1>Tambah Penempatan Siswa</h1>
                <p class="text-muted">Tambahkan siswa ke dalam kelas</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            <?= htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <!-- SISWA -->
                        <div class="mb-3">
                            <label class="form-label">Siswa</label>
                            <select name="siswa_id" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php while ($siswa = mysqli_fetch_assoc($query_siswa)) { ?>
                                    <option value="<?= $siswa['id']; ?>"
                                        <?= (isset($siswa_id) && $siswa_id == $siswa['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($siswa['nis']); ?> -
                                        <?= htmlspecialchars($siswa['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- TAHUN AJARAN -->
                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-select" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <?php while ($tahun = mysqli_fetch_assoc($query_tahun)) { ?>
                                    <option value="<?= $tahun['id']; ?>"
                                        <?= (isset($tahun_ajaran_id) && $tahun_ajaran_id == $tahun['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($tahun['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- KELAS -->
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>
                                    <option value="<?= $kelas['id']; ?>"
                                        <?= (isset($kelas_id) && $kelas_id == $kelas['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kelas['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- TANGGAL MULAI -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="<?= htmlspecialchars($tanggal_mulai ?? ''); ?>" required>
                        </div>

                        <!-- TANGGAL SELESAI -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control"
                                value="<?= htmlspecialchars($tanggal_selesai ?? ''); ?>" required>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" class="form-select" required>
                                <option value="1" <?= (isset($status_aktif) && $status_aktif == 1) ? 'selected' : ''; ?>>
                                    Aktif
                                </option>
                                <option value="0" <?= (isset($status_aktif) && $status_aktif == 0) ? 'selected' : ''; ?>>
                                    Tidak Aktif
                                </option>
                            </select>
                        </div>

                        <!-- TOMBOL -->
                        <div>
                            <button type="submit" name="simpan" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>