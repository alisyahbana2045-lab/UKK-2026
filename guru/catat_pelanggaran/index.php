
<?php

require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = $_SESSION['user_id'];

$query_guru = mysqli_query($conn, "
    SELECT id, nama
    FROM t_guru
    WHERE user_id = '$user_id'
    AND status_aktif = 1
");

if (!$query_guru || mysqli_num_rows($query_guru) == 0) {
    die("Data guru tidak ditemukan.");
}

$guru = mysqli_fetch_assoc($query_guru);

// Pencarian
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$cari_esc = mysqli_real_escape_string($conn, $cari);

// Pagination
$per_page = 10;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

// Query dasar untuk mengambil kelas dari penempatan siswa
$query_dasar = "
    SELECT
        ps.*,
        COALESCE(
            (
                SELECT k.nama
                FROM t_kelas_siswa ks
                INNER JOIN t_kelas k ON ks.kelas_id = k.id
                WHERE ks.siswa_id = ps.siswa_id
                AND ks.tahun_ajaran_id = ps.tahun_ajaran_id
                AND ks.status_aktif = 1
                ORDER BY ks.id DESC
                LIMIT 1
            ),
            NULLIF(ps.nama_kelas, '')
        ) AS kelas_tampil
    FROM t_pelanggaran_siswa ps
";

// Kondisi pencarian
$where = "";

if ($cari !== '') {
    $where = "WHERE
        nama_siswa LIKE '%$cari_esc%'
        OR nama_pelanggaran LIKE '%$cari_esc%'
        OR nama_guru LIKE '%$cari_esc%'
        OR kelas_tampil LIKE '%$cari_esc%'";
}

// Hitung jumlah data
$query_jumlah = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM ($query_dasar) AS data_pelanggaran
    $where
");

if (!$query_jumlah) {
    die("Query jumlah gagal: " . mysqli_error($conn));
}

$total_data = mysqli_fetch_assoc($query_jumlah)['total'];

$total_halaman = ceil($total_data / $per_page);

if ($total_halaman > 0 && $page > $total_halaman) {
    $page = $total_halaman;
    $offset = ($page - 1) * $per_page;
}

// Ambil data pelanggaran
$query = mysqli_query($conn, "
    SELECT *
    FROM ($query_dasar) AS data_pelanggaran
    $where
    ORDER BY id DESC
    LIMIT $offset, $per_page
");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catat Pelanggaran</title>

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

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="fw-bold mb-1">
                        Catat Pelanggaran
                    </h1>

                    <p class="text-muted mb-0">
                        Mencatat pelanggaran siswa
                    </p>
                </div>

                <a href="tambah.php" class="btn btn-primary">
                    + Catat Pelanggaran
                </a>

            </div>

            <!-- PENCARIAN -->
            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <form method="GET" class="d-flex gap-2">
                    
                        <input
                            type="text"
                            name="cari"
                            class="form-control"
                            placeholder="Cari nama siswa, pelanggaran, Guru atau kelas..."
                            value="<?= htmlspecialchars($cari); ?>"
                        >

                        <button type="submit" class="btn btn-primary">
                            Cari
                        </button>

                        <a href="index.php" class="btn btn-secondary">
                            Reset
                        </a>

                    </form>

                </div>

            </div>

            <!-- TABEL -->
            <div class="card shadow-sm">

                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-1">
                    Riwayat Pelanggaran
                    </h2>

                </div>
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover align-middle">

                            <thead class="table-dark">

                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Tanggal Kejadian</th>
                                    <th>Tanggal Dicatat</th>
                                    <th>Guru</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $no = $offset + 1;

                                if (mysqli_num_rows($query) > 0) {

                                    while ($data = mysqli_fetch_assoc($query)) {

                                ?>

                                    <tr>

                                        <!-- Nomor -->
                                        <td>
                                            <?= $no++; ?>
                                        </td>

                                        <!-- Nama Siswa -->
                                        <td>
                                            <?= htmlspecialchars($data['nama_siswa']); ?>
                                        </td>

                                        <!-- Kelas -->
                                        <td>
                                            <?= htmlspecialchars($data['kelas_tampil'] ?? '-'); ?>
                                        </td>

                                        <!-- Pelanggaran -->
                                        <td>
                                            <?= htmlspecialchars($data['nama_pelanggaran']); ?>
                                        </td>

                                        <!-- Poin -->
                                        <td>
                                            <?= htmlspecialchars($data['poin']); ?>
                                        </td>

                                        <!-- Tanggal Kejadian -->
                                        <td>
                                            <?= !empty($data['tanggal'])
                                                ? date('d-m-Y', strtotime($data['tanggal']))
                                                : '-'; ?>
                                        </td>

                                        <!-- Tanggal Dicatat -->
                                        <td>
                                            <?= !empty($data['created_at'])
                                                ? date('d-m-Y H:i', strtotime($data['created_at']))
                                                : '-'; ?>
                                        </td>

                                        <!-- Guru -->
                                        <td>
                                            <?= htmlspecialchars($data['nama_guru']); ?>
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span class="badge bg-primary">
                                                <?= htmlspecialchars($data['status']); ?>
                                            </span>
                                        </td>

                                    </tr>

                                <?php

                                    }

                                } else {

                                ?>

                                    <tr>
                                        <td colspan="9" class="text-center">
                                            Belum ada data pelanggaran.
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- PAGINATION -->
                    <?php if ($total_halaman > 1) { ?>

                        <div class="d-flex justify-content-end mt-3">

                            <nav>

                                <ul class="pagination mb-0">

                                    <!-- Sebelumnya -->
                                    <?php if ($page > 1) { ?>

                                        <li class="page-item">

                                            <a class="page-link"
                                                href="?page=<?= $page - 1; ?>&cari=<?= urlencode($cari); ?>">

                                                Sebelumnya

                                            </a>

                                        </li>

                                    <?php } else { ?>

                                        <li class="page-item disabled">

                                            <span class="page-link">
                                                Sebelumnya
                                            </span>

                                        </li>

                                    <?php } ?>

                                    <!-- Nomor Halaman -->
                                    <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>

                                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">

                                            <a class="page-link"
                                                href="?page=<?= $i; ?>&cari=<?= urlencode($cari); ?>">

                                                <?= $i; ?>

                                            </a>

                                        </li>

                                    <?php } ?>

                                    <!-- Berikutnya -->
                                    <?php if ($page < $total_halaman) { ?>

                                        <li class="page-item">

                                            <a class="page-link"
                                                href="?page=<?= $page + 1; ?>&cari=<?= urlencode($cari); ?>">

                                                Berikutnya

                                            </a>

                                        </li>

                                    <?php } else { ?>

                                        <li class="page-item disabled">

                                            <span class="page-link">
                                                Berikutnya
                                            </span>

                                        </li>

                                    <?php } ?>

                                </ul>

                            </nav>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>
