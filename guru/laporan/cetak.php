<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = (int) $_SESSION['user_id'];

$guru_query = mysqli_query($conn, "
    SELECT id, nama
    FROM t_guru
    WHERE user_id = $user_id
    LIMIT 1
");

$guru = mysqli_fetch_assoc($guru_query);

if (!$guru) {
    die("Data guru tidak ditemukan.");
}

$guru_id = (int) $guru['id'];

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? (int) $_GET['tahun_ajaran_id'] : 0;
$kelas_id = isset($_GET['kelas_id']) ? (int) $_GET['kelas_id'] : 0;
$siswa_id = isset($_GET['siswa_id']) ? (int) $_GET['siswa_id'] : 0;

$where = "WHERE ps.guru_id = $guru_id";

if ($tahun_ajaran_id > 0) {
    $where .= " AND ps.tahun_ajaran_id = $tahun_ajaran_id";
}

if ($kelas_id > 0) {
    $where .= " AND ps.kelas_id = $kelas_id";
}

if ($siswa_id > 0) {
    $where .= " AND ps.siswa_id = $siswa_id";
}

$query = mysqli_query($conn, "
    SELECT
        ps.*,
        ta.nama AS nama_tahun_ajaran,
        k.nama AS nama_kelas,
        s.nama AS nama_siswa
    FROM t_pelanggaran_siswa ps
    LEFT JOIN t_tahun_ajaran ta ON ps.tahun_ajaran_id = ta.id
    LEFT JOIN t_kelas k ON ps.kelas_id = k.id
    LEFT JOIN t_siswa s ON ps.siswa_id = s.id
    $where
    ORDER BY ps.tanggal DESC, ps.id DESC
");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

$total_data = mysqli_num_rows($query);
$total_poin = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Pelanggaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .header h3 {
            margin: 5px 0;
            font-size: 18px;
        }

        .header p {
            margin: 3px 0;
            font-size: 14px;
        }

        .line {
            border-bottom: 2px solid #000;
            margin-top: 15px;
        }

        .info {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .info table {
            border: none;
        }

        .info td {
            border: none;
            padding: 3px 10px 3px 0;
        }

        table.laporan {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table.laporan th,
        table.laporan td {
            border: 1px solid #000;
            padding: 7px;
        }

        table.laporan th {
            background-color: #212529;
            color: white;
            text-align: center;
        }

        table.laporan td {
            vertical-align: top;
        }

        .total {
            margin-top: 15px;
            font-weight: bold;
            font-size: 14px;
        }

        .ttd {
            width: 250px;
            margin-left: auto;
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
        }

        .ttd .nama {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }

        @media print {
            body {
                margin: 15px;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="no-print" style="margin-bottom: 20px;">
    <button onclick="window.print()">Cetak Laporan</button>
    <button onclick="window.close()">Tutup</button>
</div>

<div class="header">
    <h2>SISTEM PELANGGARAN SISWA</h2>
    <h3>LAPORAN PELANGGARAN SISWA</h3>
    <p>SMK MUHAMMADIYAH</p>
    <div class="line"></div>
</div>

<div class="info">
    <table>
        <tr>
            <td><strong>Nama Guru</strong></td>
            <td>: <?= htmlspecialchars($guru['nama']); ?></td>
        </tr>
        <tr>
            <td><strong>Total Data</strong></td>
            <td>: <?= $total_data; ?> pelanggaran</td>
        </tr>
    </table>
</div>

<table class="laporan">
    <thead>
        <tr>
            <th width="40">No</th>
            <th width="80">Tanggal</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Pelanggaran</th>
            <th width="50">Poin</th>
            <th>Keterangan</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($total_data > 0) { ?>
            <?php $no = 1; ?>
            <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                <?php $total_poin += (int) $data['poin']; ?>
                <tr>
                    <td style="text-align:center;"><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                    <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
                    <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                    <td><?= htmlspecialchars($data['nama_pelanggaran']); ?></td>
                    <td style="text-align:center;"><?= (int) $data['poin']; ?></td>
                    <td><?= htmlspecialchars($data['keterangan'] ?: '-'); ?></td>
                    <td><?= htmlspecialchars($data['tindakan'] ?: '-'); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="8" style="text-align:center;">
                    Tidak ada data pelanggaran.
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="total">
    Total Poin: <?= $total_poin; ?>
</div>

<div class="ttd">
    <p>Guru yang mencatat,</p>
    <p class="nama"><?= htmlspecialchars($guru['nama']); ?></p>
</div>

<script>
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>