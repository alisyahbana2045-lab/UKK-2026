
<?php
require_once __DIR__ . "/../../config/admin.php";
require_once __DIR__ . "/../../config/koneksi.php";

$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? (int) $_GET['tahun_ajaran_id'] : 0;
$kelas_id = isset($_GET['kelas_id']) ? (int) $_GET['kelas_id'] : 0;
$siswa_id = isset($_GET['siswa_id']) ? (int) $_GET['siswa_id'] : 0;

$tanggal_mulai = isset($_GET['tanggal_mulai']) ? trim($_GET['tanggal_mulai']) : '';
$tanggal_selesai = isset($_GET['tanggal_selesai']) ? trim($_GET['tanggal_selesai']) : '';

// Validasi tanggal
if ($tanggal_mulai != '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_mulai)) {
    $tanggal_mulai = '';
}

if ($tanggal_selesai != '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_selesai)) {
    $tanggal_selesai = '';
}

if (
    $tanggal_mulai != '' &&
    $tanggal_selesai != '' &&
    $tanggal_mulai > $tanggal_selesai
) {
    $tanggal_mulai = '';
    $tanggal_selesai = '';
}

// Filter laporan
$where = "WHERE 1=1";

if ($tahun_ajaran_id > 0) {
    $where .= " AND ps.tahun_ajaran_id = $tahun_ajaran_id";
}

if ($kelas_id > 0) {
    $where .= " AND ps.kelas_id = $kelas_id";
}

if ($siswa_id > 0) {
    $where .= " AND ps.siswa_id = $siswa_id";
}

if ($tanggal_mulai != '') {
    $mulai_sql = mysqli_real_escape_string($conn, $tanggal_mulai);
    $where .= " AND DATE(ps.tanggal) >= '$mulai_sql'";
}

if ($tanggal_selesai != '') {
    $selesai_sql = mysqli_real_escape_string($conn, $tanggal_selesai);
    $where .= " AND DATE(ps.tanggal) <= '$selesai_sql'";
}

// Ambil data laporan
$query = mysqli_query($conn, "
    SELECT
        ps.*,
        ta.nama AS nama_tahun_ajaran,
        k.nama AS nama_kelas,
        s.nama AS nama_siswa,
        g.nama AS nama_guru
    FROM t_pelanggaran_siswa ps
    LEFT JOIN t_tahun_ajaran ta ON ps.tahun_ajaran_id = ta.id
    LEFT JOIN t_kelas k ON ps.kelas_id = k.id
    LEFT JOIN t_siswa s ON ps.siswa_id = s.id
    LEFT JOIN t_guru g ON ps.guru_id = g.id
    $where
    ORDER BY ps.tanggal DESC, ps.id DESC
");

if (!$query) {
    die("Query laporan gagal: " . mysqli_error($conn));
}

$total_data = mysqli_num_rows($query);
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
            color: #000;
            margin: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0 0 5px;
            font-size: 22px;
        }

        .header p {
            margin: 3px 0;
            font-size: 13px;
        }

        .info {
            margin-bottom: 15px;
            font-size: 13px;
            line-height: 1.7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            background: #e9e9e9;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            margin-top: 15px;
            font-size: 13px;
            font-weight: bold;
        }

        .signature {
            width: 250px;
            margin-left: auto;
            margin-top: 50px;
            text-align: center;
            font-size: 13px;
        }

        .signature .space {
            height: 70px;
        }

        .buttons {
            margin-bottom: 20px;
        }

        @media print {
            body {
                margin: 10mm;
            }

            .buttons {
                display: none;
            }

            table th {
                background: #e9e9e9 !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

<div class="buttons">
    <button onclick="window.print()">Cetak Laporan</button>
    <button onclick="window.close()">Tutup</button>
</div>

<div class="header">
    <h2>LAPORAN PELANGGARAN SISWA</h2>
    <p>SISTEM PELANGGARAN SISWA</p>
    <p>Dokumen Laporan Data Pelanggaran Siswa</p>
</div>

<div class="info">
    <strong>Tanggal Cetak:</strong> <?= date('d-m-Y'); ?>
    <br>

    <strong>Tahun Ajaran:</strong>
    <?php
    if ($tahun_ajaran_id > 0) {
        $ta = mysqli_query($conn, "SELECT nama FROM t_tahun_ajaran WHERE id = $tahun_ajaran_id");
        $data_ta = mysqli_fetch_assoc($ta);
        echo htmlspecialchars($data_ta['nama'] ?? '-');
    } else {
        echo "Semua Tahun Ajaran";
    }
    ?>
    <br>

    <strong>Kelas:</strong>
    <?php
    if ($kelas_id > 0) {
        $k = mysqli_query($conn, "SELECT nama FROM t_kelas WHERE id = $kelas_id");
        $data_k = mysqli_fetch_assoc($k);
        echo htmlspecialchars($data_k['nama'] ?? '-');
    } else {
        echo "Semua Kelas";
    }
    ?>
    <br>

    <strong>Siswa:</strong>
    <?php
    if ($siswa_id > 0) {
        $s = mysqli_query($conn, "SELECT nama FROM t_siswa WHERE id = $siswa_id");
        $data_s = mysqli_fetch_assoc($s);
        echo htmlspecialchars($data_s['nama'] ?? '-');
    } else {
        echo "Semua Siswa";
    }
    ?>
    <br>

    <strong>Rentang Tanggal:</strong>
    <?= $tanggal_mulai != '' ? date('d-m-Y', strtotime($tanggal_mulai)) : 'Awal'; ?>
    sampai
    <?= $tanggal_selesai != '' ? date('d-m-Y', strtotime($tanggal_selesai)) : 'Sekarang'; ?>
</div>

<table>
    <thead>
        <tr>
            <th width="35">No</th>
            <th>Tanggal</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Pelanggaran</th>
            <th>Poin</th>
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
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                    <td><?= htmlspecialchars($data['nama_siswa'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($data['nama_kelas'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($data['nama_pelanggaran'] ?? '-'); ?></td>
                    <td class="text-center"><?= (int) $data['poin']; ?></td>
                    <td><?= htmlspecialchars($data['keterangan'] ?: '-'); ?></td>
                    <td><?= htmlspecialchars($data['tindakan'] ?: '-'); ?></td>
                </tr>
            <?php } ?>

        <?php } else { ?>
            <tr>
                <td colspan="8" class="text-center">
                    Tidak ada data laporan.
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="summary">
    Total Pelanggaran: <?= $total_data; ?><br>
    Total Poin: <?= $total_poin; ?>
</div>

<div class="signature">
    <p>Mengetahui,</p>
    <p>Admin</p>
    <div class="space"></div>
    <p><strong>(................................)</strong></p>
</div>

</body>
</html>
