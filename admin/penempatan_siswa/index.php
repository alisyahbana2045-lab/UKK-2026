
<?php

require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

// Kondisi pencarian
$where = "";

if ($cari !== '') {

    $nis_esc = mysqli_real_escape_string($conn, $cari);
    $nama_esc = mysqli_real_escape_string($conn, $cari);
    $kelas_esc = mysqli_real_escape_string($conn, $cari);
    $ta_esc = mysqli_real_escape_string($conn, $cari);

    $where = "WHERE s.nis LIKE '%$nis_esc%'
        OR s.nama LIKE '%$nama_esc%'
        OR REPLACE(k.nama, ' ', '') LIKE REPLACE('%$kelas_esc%', ' ', '')
        OR ta.nama LIKE '%$ta_esc%'";
}

// Hitung total data unik berdasarkan NIS siswa
$query_jumlah = mysqli_query($conn, "
    SELECT COUNT(DISTINCT s.nis) AS total
    FROM t_kelas_siswa ks
    LEFT JOIN t_siswa s ON ks.siswa_id = s.id
    LEFT JOIN t_kelas k ON ks.kelas_id = k.id
    LEFT JOIN t_tahun_ajaran ta ON ks.tahun_ajaran_id = ta.id
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

// Ambil data penempatan siswa
// Tanggal diambil langsung dari tabel t_tahun_ajaran
$query = mysqli_query($conn, "
    SELECT
        ks.id,
        ks.siswa_id,
        ks.tahun_ajaran_id,
        ks.kelas_id,
        ks.status_aktif,
        s.nis,
        s.nama AS nama_siswa,
        k.nama AS nama_kelas,
        ta.nama AS tahun_ajaran,
        ta.tanggal_mulai AS tanggal_mulai,
        ta.tanggal_selesai AS tanggal_selesai
    FROM t_kelas_siswa ks
    LEFT JOIN t_siswa s ON ks.siswa_id = s.id
    LEFT JOIN t_kelas k ON ks.kelas_id = k.id
    LEFT JOIN t_tahun_ajaran ta ON ks.tahun_ajaran_id = ta.id
    $where
    GROUP BY s.nis
    ORDER BY ks.id DESC
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

    <title>Penempatan Siswa</title>

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

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="fw-bold mb-1">Penempatan Siswa</h1>
                    <p class="text-muted mb-0">Data penempatan siswa</p>
                </div>

                <a href="tambah.php" class="btn btn-primary">
                    + Tambah Penempatan
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
                            placeholder="Cari NIS, nama siswa, kelas, atau tahun ajaran..."
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

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="table-dark">

                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $no = $offset + 1;

                                if (mysqli_num_rows($query) > 0) {

                                    while ($siswa = mysqli_fetch_assoc($query)) {

                                ?>

                                    <tr>

                                        <td><?= $no++; ?></td>

                                        <td>
                                            <?= htmlspecialchars($siswa['nis']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($siswa['nama_siswa']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($siswa['tahun_ajaran']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($siswa['nama_kelas']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($siswa['tanggal_mulai']); ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($siswa['tanggal_selesai']); ?>
                                        </td>

                                        <td>
                                            <?php if ($siswa['status_aktif'] == 1) { ?>
                                                <span class="badge bg-success">
                                                    Aktif
                                                </span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">
                                                    Tidak Aktif
                                                </span>
                                            <?php } ?>
                                        </td>

                                    </tr>

                                <?php

                                    }

                                } else {

                                ?>

                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Belum ada data penempatan siswa.
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- PAGINATION -->
                    <?php if ($total_halaman > 1) { ?>

                        <nav>

                            <ul class="pagination justify-content-end">

                                <!-- Previous -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">

                                    <a class="page-link"
                                        href="?cari=<?= urlencode($cari); ?>&page=<?= $page - 1; ?>">

                                        Sebelumnya

                                    </a>

                                </li>

                                <!-- Nomor Halaman -->
                                <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>

                                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">

                                        <a class="page-link"
                                            href="?cari=<?= urlencode($cari); ?>&page=<?= $i; ?>">

                                            <?= $i; ?>

                                        </a>

                                    </li>

                                <?php } ?>

                                <!-- Next -->
                                <li class="page-item <?= ($page >= $total_halaman) ? 'disabled' : ''; ?>">

                                    <a class="page-link"
                                        href="?cari=<?= urlencode($cari); ?>&page=<?= $page + 1; ?>">

                                        Berikutnya

                                    </a>

                                </li>

                            </ul>

                        </nav>

                    <?php } ?>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>
