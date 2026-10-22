<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = $_SESSION['user_id'];

$query_guru = mysqli_query($conn, "SELECT id, nama FROM t_guru WHERE user_id = '$user_id' AND status_aktif = 1");

if (!$query_guru || mysqli_num_rows($query_guru) == 0) {
    die("Data guru tidak ditemukan.");
}

$guru = mysqli_fetch_assoc($query_guru);

$siswa = mysqli_query($conn, "SELECT id, nis, nama FROM t_siswa WHERE status_aktif = 1 ORDER BY nama ASC");

$pelanggaran = mysqli_query($conn, "SELECT
    p.id,
    p.pelanggaran_kategori_id,
    p.nama,
    p.poin,
    k.nama AS nama_kategori
    FROM t_pelanggaran p
    LEFT JOIN t_pelanggaran_kategori k
    ON p.pelanggaran_kategori_id = k.id
    WHERE p.status_aktif = 1
    ORDER BY p.nama ASC");

$tahun = mysqli_query($conn, "SELECT id, nama FROM t_tahun_ajaran WHERE status_aktif = 1 ORDER BY id DESC");

if (isset($_POST['simpan'])) {
    $tahun_ajaran_id = $_POST['tahun_ajaran_id'];
    $siswa_id = $_POST['siswa_id'];
    $pelanggaran_id = $_POST['pelanggaran_id'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    $query_siswa = mysqli_query($conn, "SELECT
        s.id,
        s.nama AS nama_siswa,
        ks.kelas_id,
        k.nama AS nama_kelas
        FROM t_siswa s
        LEFT JOIN t_kelas_siswa ks
        ON s.id = ks.siswa_id
        AND ks.tahun_ajaran_id = '$tahun_ajaran_id'
        AND ks.status_aktif = 1
        LEFT JOIN t_kelas k
        ON ks.kelas_id = k.id
        WHERE s.id = '$siswa_id'
        LIMIT 1");

    $data_siswa = mysqli_fetch_assoc($query_siswa);

    $query_pelanggaran = mysqli_query($conn, "SELECT
        p.id,
        p.pelanggaran_kategori_id,
        p.nama AS nama_pelanggaran,
        p.poin
        FROM t_pelanggaran p
        WHERE p.id = '$pelanggaran_id'
        AND p.status_aktif = 1");

    $data_pelanggaran = mysqli_fetch_assoc($query_pelanggaran);

    if (!$data_siswa) {
        echo "Data siswa atau kelas tidak ditemukan.";
    } elseif (!$data_pelanggaran) {
        echo "Data pelanggaran tidak ditemukan.";
    } else {
        $nama_siswa = $data_siswa['nama_siswa'];
        $kelas_id = $data_siswa['kelas_id'];
        $nama_kelas = $data_siswa['nama_kelas'];
        $nama_pelanggaran = $data_pelanggaran['nama_pelanggaran'];
        $pelanggaran_kategori_id = $data_pelanggaran['pelanggaran_kategori_id'];
        $poin = $data_pelanggaran['poin'];
        $guru_id = $guru['id'];
        $nama_guru = $guru['nama'];
        $status = "Belum Ditindak";
        $tindakan = "";

        $query = mysqli_query($conn, "INSERT INTO t_pelanggaran_siswa
            (tahun_ajaran_id, siswa_id, nama_siswa, kelas_id, nama_kelas,
            pelanggaran_id, nama_pelanggaran, pelanggaran_kategori_id,
            guru_id, nama_guru, tanggal, keterangan, poin, tindakan, status)
            VALUES
            ('$tahun_ajaran_id', '$siswa_id', '$nama_siswa', '$kelas_id', '$nama_kelas',
            '$pelanggaran_id', '$nama_pelanggaran', '$pelanggaran_kategori_id',
            '$guru_id', '$nama_guru', '$tanggal', '$keterangan', '$poin',
            '$tindakan', '$status')");

        if ($query) {
            header("Location: index.php");
            exit;
        } else {
            echo "Data gagal disimpan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Pelanggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <h1 class="fw-bold mb-1">Catat Pelanggaran</h1>
                <p class="text-muted mb-0">Tambah data pelanggaran siswa</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-select" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <?php while ($data_tahun = mysqli_fetch_assoc($tahun)) { ?>
                                    <option value="<?= $data_tahun['id']; ?>">
                                        <?= htmlspecialchars($data_tahun['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Siswa</label>
                            <select name="siswa_id" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php while ($data_siswa = mysqli_fetch_assoc($siswa)) { ?>
                                    <option value="<?= $data_siswa['id']; ?>">
                                        <?= htmlspecialchars($data_siswa['nis']); ?> -
                                        <?= htmlspecialchars($data_siswa['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Pelanggaran</label>
                            <select name="pelanggaran_id" class="form-select" required>
                                <option value="">-- Pilih Pelanggaran --</option>
                                <?php while ($data_pelanggaran = mysqli_fetch_assoc($pelanggaran)) { ?>
                                    <option value="<?= $data_pelanggaran['id']; ?>">
                                        <?= htmlspecialchars($data_pelanggaran['nama']); ?>
                                        - <?= htmlspecialchars($data_pelanggaran['poin']); ?> poin
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control"
                                   value="<?= date('Y-m-d'); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="4"
                                      placeholder="Masukkan keterangan pelanggaran"></textarea>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
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