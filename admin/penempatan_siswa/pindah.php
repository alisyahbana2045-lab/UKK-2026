
<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

// ================================
// AMBIL ID PENEMPATAN
// ================================

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// ================================
// AMBIL DATA PENEMPATAN SISWA
// ================================

$stmt = mysqli_prepare($conn, "
    SELECT
        ks.id,
        ks.siswa_id,
        ks.tahun_ajaran_id,
        ks.kelas_id,
        ks.tanggal_mulai,
        ks.tanggal_selesai,
        ks.status_aktif,
        s.nis,
        s.nama AS nama_siswa,
        s.status_aktif AS status_siswa,
        k.nama AS nama_kelas,
        ta.nama AS tahun_ajaran
    FROM t_kelas_siswa ks
    JOIN t_siswa s ON ks.siswa_id = s.id
    JOIN t_kelas k ON ks.kelas_id = k.id
    JOIN t_tahun_ajaran ta ON ks.tahun_ajaran_id = ta.id
    WHERE ks.id = ?
    LIMIT 1
");

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$data || $data['status_aktif'] != 1) {
    echo "<script>
        alert('Data penempatan tidak ditemukan atau sudah tidak aktif.');
        window.location='index.php';
    </script>";
    exit;
}

if ($data['status_siswa'] != 1) {
    echo "<script>
        alert('Siswa sedang tidak aktif.');
        window.location='index.php';
    </script>";
    exit;
}

// ================================
// DATA KELAS TUJUAN
// ================================

$query_kelas = mysqli_prepare($conn, "
    SELECT id, nama
    FROM t_kelas
    WHERE status_aktif = 1
    AND id != ?
    ORDER BY nama ASC
");

mysqli_stmt_bind_param($query_kelas, "i", $data['kelas_id']);
mysqli_stmt_execute($query_kelas);

$result_kelas = mysqli_stmt_get_result($query_kelas);

// ================================
// PROSES PINDAH KELAS
// ================================

if (isset($_POST['pindah'])) {

    $kelas_baru = (int) $_POST['kelas_id'];
    $tanggal_pindah = $_POST['tanggal_pindah'];

    if ($kelas_baru <= 0 || empty($tanggal_pindah)) {

        $error = "Kelas tujuan dan tanggal pindah wajib diisi.";

    } elseif ($kelas_baru == $data['kelas_id']) {

        $error = "Kelas tujuan tidak boleh sama dengan kelas saat ini.";

    } elseif ($tanggal_pindah < $data['tanggal_mulai']) {

        $error = "Tanggal pindah tidak boleh lebih awal dari tanggal mulai penempatan.";

    } elseif (
        !empty($data['tanggal_selesai']) &&
        $tanggal_pindah > $data['tanggal_selesai']
    ) {

        $error = "Tanggal pindah tidak boleh melewati tanggal selesai penempatan.";

    } else {

        mysqli_begin_transaction($conn);

        try {

            // CEK KELAS TUJUAN
            $cek_kelas = mysqli_prepare($conn, "
                SELECT id
                FROM t_kelas
                WHERE id = ?
                AND status_aktif = 1
                LIMIT 1
            ");

            mysqli_stmt_bind_param($cek_kelas, "i", $kelas_baru);
            mysqli_stmt_execute($cek_kelas);
            mysqli_stmt_store_result($cek_kelas);

            if (mysqli_stmt_num_rows($cek_kelas) == 0) {
                throw new Exception("Kelas tujuan tidak ditemukan atau tidak aktif.");
            }

            mysqli_stmt_close($cek_kelas);

            // CEK PENEMPATAN AKTIF LAIN
            $cek_aktif = mysqli_prepare($conn, "
                SELECT id
                FROM t_kelas_siswa
                WHERE siswa_id = ?
                AND tahun_ajaran_id = ?
                AND status_aktif = 1
                AND id != ?
                LIMIT 1
            ");

            mysqli_stmt_bind_param(
                $cek_aktif,
                "iii",
                $data['siswa_id'],
                $data['tahun_ajaran_id'],
                $id
            );

            mysqli_stmt_execute($cek_aktif);
            mysqli_stmt_store_result($cek_aktif);

            if (mysqli_stmt_num_rows($cek_aktif) > 0) {
                throw new Exception("Siswa sudah memiliki penempatan aktif lain pada tahun ajaran ini.");
            }

            mysqli_stmt_close($cek_aktif);

            // NONAKTIFKAN KELAS LAMA
            $update = mysqli_prepare($conn, "
                UPDATE t_kelas_siswa
                SET tanggal_selesai = ?,
                    status_aktif = 0
                WHERE id = ?
                AND status_aktif = 1
            ");

            mysqli_stmt_bind_param(
                $update,
                "si",
                $tanggal_pindah,
                $id
            );

            if (!mysqli_stmt_execute($update)) {
                throw new Exception("Gagal memperbarui kelas lama.");
            }

            if (mysqli_stmt_affected_rows($update) != 1) {
                throw new Exception("Penempatan lama sudah berubah. Silakan muat ulang halaman.");
            }

            mysqli_stmt_close($update);

            // TAMBAHKAN PENEMPATAN KELAS BARU
            $tanggal_selesai_baru = $data['tanggal_selesai'];

            $insert = mysqli_prepare($conn, "
                INSERT INTO t_kelas_siswa
                (
                    siswa_id,
                    tahun_ajaran_id,
                    kelas_id,
                    tanggal_mulai,
                    tanggal_selesai,
                    status_aktif
                )
                VALUES (?, ?, ?, ?, ?, 1)
            ");

            mysqli_stmt_bind_param(
                $insert,
                "iiiss",
                $data['siswa_id'],
                $data['tahun_ajaran_id'],
                $kelas_baru,
                $tanggal_pindah,
                $tanggal_selesai_baru
            );

            if (!mysqli_stmt_execute($insert)) {
                throw new Exception("Gagal menyimpan penempatan kelas baru.");
            }

            mysqli_stmt_close($insert);

            // SIMPAN TRANSAKSI
            mysqli_commit($conn);

            echo "<script>
                alert('Siswa berhasil dipindahkan ke kelas baru.');
                window.location='index.php';
            </script>";
            exit;

        } catch (Exception $e) {

            mysqli_rollback($conn);
            $error = $e->getMessage();

        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pindah Kelas Siswa</title>

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
        <main class="col-md-9 col-lg-10 p-4 main-content">

            <div class="mb-4">
                <h1 class="fw-bold">Pindah Kelas Siswa</h1>
                <p class="text-muted">Pindahkan siswa ke kelas yang baru</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            <?= htmlspecialchars($error); ?>
                        </div>
                    <?php } ?>

                    <!-- INFORMASI SISWA -->
                    <div class="alert alert-info">
                        <h5 class="fw-bold mb-3">Informasi Siswa</h5>

                        <div class="row mb-2">
                            <div class="col-md-3 fw-semibold">NIS</div>
                            <div class="col-md-9">
                                <?= htmlspecialchars($data['nis']); ?>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 fw-semibold">Nama Siswa</div>
                            <div class="col-md-9">
                                <?= htmlspecialchars($data['nama_siswa']); ?>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 fw-semibold">Tahun Ajaran</div>
                            <div class="col-md-9">
                                <?= htmlspecialchars($data['tahun_ajaran']); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 fw-semibold">Kelas Saat Ini</div>
                            <div class="col-md-9">
                                <?= htmlspecialchars($data['nama_kelas']); ?>
                            </div>
                        </div>
                    </div>

                    <form method="POST">

                        <!-- KELAS TUJUAN -->
                        <div class="mb-3">
                            <label class="form-label">Kelas Tujuan</label>

                            <select name="kelas_id" class="form-select" required>
                                <option value="">-- Pilih Kelas Tujuan --</option>

                                <?php while ($kelas = mysqli_fetch_assoc($result_kelas)) { ?>
                                    <option
                                        value="<?= $kelas['id']; ?>"
                                        <?= (isset($kelas_baru) && $kelas_baru == $kelas['id']) ? 'selected' : ''; ?>
                                    >
                                        <?= htmlspecialchars($kelas['nama']); ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>

                        <!-- TANGGAL PINDAH -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pindah</label>

                            <input
                                type="date"
                                name="tanggal_pindah"
                                class="form-control"
                                value="<?= htmlspecialchars($tanggal_pindah ?? date('Y-m-d')); ?>"
                                min="<?= htmlspecialchars($data['tanggal_mulai']); ?>"
                                max="<?= htmlspecialchars($data['tanggal_selesai'] ?? ''); ?>"
                                required
                            >
                        </div>

                        <!-- TOMBOL -->
                        <div>
                            <button type="submit" name="pindah" class="btn btn-warning">
                                <i class="bi bi-arrow-left-right"></i>
                                Pindahkan Siswa
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

</body>
</html>
