<?php
require_once "../../config/admin.php";
require_once "../../config/koneksi.php";

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? $_GET['tahun_ajaran_id'] : '';
$kelas_id = isset($_GET['kelas_id']) ? $_GET['kelas_id'] : '';
$siswa_id = isset($_GET['siswa_id']) ? $_GET['siswa_id'] : '';

$where = "WHERE 1=1";

if ($tahun_ajaran_id != '') {
    $tahun_ajaran_id = mysqli_real_escape_string($conn, $tahun_ajaran_id);
    $where .= " AND tahun_ajaran_id = '$tahun_ajaran_id'";
}

if ($kelas_id != '') {
    $kelas_id = mysqli_real_escape_string($conn, $kelas_id);
    $where .= " AND kelas_id = '$kelas_id'";
}

if ($siswa_id != '') {
    $siswa_id = mysqli_real_escape_string($conn, $siswa_id);
    $where .= " AND siswa_id = '$siswa_id'";
}

$query = mysqli_query($conn, "SELECT * FROM t_pelanggaran_siswa $where ORDER BY tanggal ASC, id ASC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

$total_poin = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pelanggaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop h2,
        .kop h3,
        .kop p {
            margin: 3px 0;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th,
        table td {
            border: 1px solid #000;
            padding: 7px;
            font-size: 12px;
        }
        table th {
            text-align: center;
        }
        .total {
            font-weight: bold;
        }
        .tanggal {
            text-align: right;
            margin-top: 30px;
        }
        @media print {
            body {
                margin: 10px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="no-print" style="margin-bottom:20px;">
    <button onclick="window.print()">🖨 Cetak</button>
</div>

<div class="kop">
    <h2>SMK MUHAMMADIYAH</h2>
    <h3>SISTEM PELANGGARAN SISWA</h3>
    <p>LAPORAN DATA PELANGGARAN SISWA</p>
</div>

<h3>LAPORAN PELANGGARAN SISWA</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Pelanggaran</th>
            <th>Poin</th>
            <th>Guru</th>
            <th>Tindakan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
            $total_poin += $data['poin'];
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
                <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
                <td><?= htmlspecialchars($data['nama_pelanggaran']); ?></td>
                <td><?= $data['poin']; ?></td>
                <td><?= htmlspecialchars($data['nama_guru']); ?></td>
                <td><?= htmlspecialchars($data['tindakan']); ?></td>
                <td><?= htmlspecialchars($data['status']); ?></td>
            </tr>
        <?php } ?>

        <?php if (mysqli_num_rows($query) == 0) { ?>
            <tr>
                <td colspan="9" style="text-align:center;">Tidak ada data pelanggaran.</td>
            </tr>
        <?php } ?>

        <tr class="total">
            <td colspan="5" style="text-align:right;">Total Poin</td>
            <td><?= $total_poin; ?></td>
            <td colspan="3"></td>
        </tr>
    </tbody>
</table>

<div class="tanggal">
    <p>........................, <?= date('d-m-Y'); ?></p>
    <br><br><br>
    <p><b>Guru / Petugas</b></p>
</div>

</body>
</html>