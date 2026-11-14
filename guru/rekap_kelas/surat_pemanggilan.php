
<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../dashboard.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$siswa_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$tahun_ajaran_id = isset($_GET['tahun_ajaran_id']) ? (int) $_GET['tahun_ajaran_id'] : 0;

if ($siswa_id <= 0 || $tahun_ajaran_id <= 0) {
    die("Parameter tidak valid.");
}

// Ambil data guru
$stmt = mysqli_prepare($conn, "
    SELECT id, nama
    FROM t_guru
    WHERE user_id = ? AND status_aktif = 1
    LIMIT 1
");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result_guru = mysqli_stmt_get_result($stmt);
$guru = mysqli_fetch_assoc($result_guru);
mysqli_stmt_close($stmt);

if (!$guru) {
    die("Data guru tidak ditemukan.");
}

$guru_id = (int) $guru['id'];

// Pastikan guru merupakan wali kelas pada tahun ajaran tersebut
$stmt = mysqli_prepare($conn, "
    SELECT wk.kelas_id, k.nama AS nama_kelas, ta.nama AS nama_tahun_ajaran
    FROM t_wali_kelas wk
    JOIN t_kelas k ON wk.kelas_id = k.id
    JOIN t_tahun_ajaran ta ON wk.tahun_ajaran_id = ta.id
    WHERE wk.guru_id = ?
      AND wk.tahun_ajaran_id = ?
      AND wk.status_aktif = 1
    LIMIT 1
");
mysqli_stmt_bind_param($stmt, "ii", $guru_id, $tahun_ajaran_id);
mysqli_stmt_execute($stmt);
$result_wali = mysqli_stmt_get_result($stmt);
$wali = mysqli_fetch_assoc($result_wali);
mysqli_stmt_close($stmt);

if (!$wali) {
    die("Anda tidak memiliki akses sebagai wali kelas pada tahun ajaran ini.");
}

$kelas_id = (int) $wali['kelas_id'];

// Ambil data siswa berdasarkan penempatan kelas
$stmt = mysqli_prepare($conn, "
    SELECT s.id, s.nis, s.nisn, s.nama, s.jenis_kelamin,
           k.nama AS nama_kelas
    FROM t_siswa s
    JOIN t_kelas_siswa ks ON ks.siswa_id = s.id
    JOIN t_kelas k ON k.id = ks.kelas_id
    WHERE s.id = ?
      AND ks.kelas_id = ?
      AND ks.tahun_ajaran_id = ?
      AND ks.status_aktif = 1
    LIMIT 1
");
mysqli_stmt_bind_param($stmt, "iii", $siswa_id, $kelas_id, $tahun_ajaran_id);
mysqli_stmt_execute($stmt);
$result_siswa = mysqli_stmt_get_result($stmt);
$siswa = mysqli_fetch_assoc($result_siswa);
mysqli_stmt_close($stmt);

if (!$siswa) {
    die("Data siswa tidak ditemukan atau bukan bagian dari kelas Anda.");
}

// Hitung total poin dan jumlah pelanggaran
$stmt = mysqli_prepare($conn, "
    SELECT COALESCE(SUM(poin), 0) AS total_poin,
           COUNT(*) AS jumlah_pelanggaran
    FROM t_pelanggaran_siswa
    WHERE siswa_id = ?
      AND tahun_ajaran_id = ?
      AND kelas_id = ?
");
mysqli_stmt_bind_param($stmt, "iii", $siswa_id, $tahun_ajaran_id, $kelas_id);
mysqli_stmt_execute($stmt);
$result_poin = mysqli_stmt_get_result($stmt);
$data_poin = mysqli_fetch_assoc($result_poin);
mysqli_stmt_close($stmt);

$total_poin = (int) $data_poin['total_poin'];

if ($total_poin < 50) {
    die("Surat pemanggilan hanya dapat dibuat untuk siswa dengan minimal 50 poin.");
}

// Ambil riwayat pelanggaran
// Nama pelanggaran sudah tersimpan langsung di t_pelanggaran_siswa
$stmt = mysqli_prepare($conn, "
    SELECT tanggal, nama_pelanggaran, poin, keterangan
    FROM t_pelanggaran_siswa
    WHERE siswa_id = ?
      AND tahun_ajaran_id = ?
      AND kelas_id = ?
    ORDER BY tanggal ASC
");
mysqli_stmt_bind_param($stmt, "iii", $siswa_id, $tahun_ajaran_id, $kelas_id);
mysqli_stmt_execute($stmt);
$result_riwayat = mysqli_stmt_get_result($stmt);

$riwayat = [];
while ($row = mysqli_fetch_assoc($result_riwayat)) {
    $riwayat[] = $row;
}
mysqli_stmt_close($stmt);

// Proses data pertemuan
$error = "";
$tanggal_pertemuan = "";
$waktu_pertemuan = "";
$tempat_pertemuan = "SMK Muhammadiyah Kota Tasikmalaya";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal_pertemuan = trim($_POST['tanggal_pertemuan'] ?? '');
    $waktu_pertemuan = trim($_POST['waktu_pertemuan'] ?? '');
    $tempat_pertemuan = trim($_POST['tempat_pertemuan'] ?? '');

    $tanggal_valid = DateTime::createFromFormat('!Y-m-d', $tanggal_pertemuan);
    $hari_ini = date('Y-m-d');

    if (!$tanggal_valid || $tanggal_valid->format('Y-m-d') !== $tanggal_pertemuan) {
        $error = "Tanggal pertemuan tidak valid.";
    } elseif ($tanggal_pertemuan < $hari_ini) {
        $error = "Tanggal pertemuan tidak boleh sebelum hari ini.";
    } elseif (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $waktu_pertemuan)) {
        $error = "Waktu pertemuan tidak valid.";
    } elseif ($tempat_pertemuan === '') {
        $error = "Tempat pertemuan wajib diisi.";
    }
}

function tanggalIndonesia($tanggal)
{
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    $pecah = explode('-', $tanggal);
    return (int) $pecah[2] . ' ' . $bulan[(int) $pecah[1]] . ' ' . $pecah[0];
}

function hariIndonesia($tanggal)
{
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    return $hari[date('l', strtotime($tanggal))];
}

$tanggal_surat = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pemanggilan Orang Tua</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .main-content {
            margin-left: 260px;
            padding: 25px;
        }

        .form-card {
            max-width: 750px;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
        }

        .surat {
            max-width: 850px;
            margin: 25px auto;
            padding: 45px 55px;
            background: white;
            color: #000;
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .kop-surat h3 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
        }

        .kop-surat p {
            margin: 3px 0;
        }

        .identitas {
            margin-left: 25px;
        }

        .identitas td {
            padding: 2px 8px 2px 0;
            vertical-align: top;
        }

        .tabel-riwayat {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        .tabel-riwayat th,
        .tabel-riwayat td {
            border: 1px solid #000;
            padding: 6px;
        }

        .tabel-riwayat th {
            text-align: center;
        }

        .ttd {
            width: 100%;
            margin-top: 55px;
            text-align: center;
        }

        .ttd td {
            width: 50%;
            vertical-align: top;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 12px;
            }

            .surat {
                padding: 25px 18px;
            }
        }

        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }

            body {
                background: white;
            }

            .no-print,
            .sidebar {
                display: none !important;
            }

            .main-content {
                margin: 0 !important;
                padding: 0 !important;
            }

            .surat {
                max-width: none;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .tabel-riwayat {
                page-break-inside: auto;
            }

            .tabel-riwayat tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="no-print">
    <?php include __DIR__ . "/../../layout/sidebar.php"; ?>
</div>

<div class="main-content">

    <div class="no-print">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Surat Pemanggilan Orang Tua</h4>
                <p class="text-muted mb-0">Atur jadwal pertemuan sebelum mencetak surat.</p>
            </div>
            <a href="index.php?tahun_ajaran_id=<?= $tahun_ajaran_id; ?>"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="form-card">
            <h5 class="fw-bold mb-3">Data Pertemuan</h5>

            <?php if ($error !== "") { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" class="form-control"
                       value="<?= htmlspecialchars($siswa['nama']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Poin</label>
                <input type="text" class="form-control"
                       value="<?= $total_poin; ?> poin" readonly>
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Tanggal Pertemuan</label>
                    <input type="date" name="tanggal_pertemuan"
                           class="form-control"
                           min="<?= date('Y-m-d'); ?>"
                           value="<?= htmlspecialchars($tanggal_pertemuan); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Pertemuan</label>
                    <input type="time" name="waktu_pertemuan"
                           class="form-control"
                           value="<?= htmlspecialchars($waktu_pertemuan); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Pertemuan</label>
                    <input type="text" name="tempat_pertemuan"
                           class="form-control"
                           value="<?= htmlspecialchars($tempat_pertemuan); ?>"
                           required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-file-earmark-text"></i>
                    Buat Surat Pemanggilan
                </button>
            </form>
        </div>
    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error === '') { ?>

        <div class="no-print text-center mb-3">
            <button onclick="window.print()" class="btn btn-danger">
                <i class="bi bi-printer"></i> Cetak / Simpan PDF
            </button>
        </div>

        <div class="surat">

            <div class="kop-surat">
                <h3>SMK MUHAMMADIYAH KOTA TASIKMALAYA</h3>
                <p>Jl. Rumah Sakit No. 29, Empangsari, Kec. Tawang,</p>
                <p>Kota Tasikmalaya, Jawa Barat 46113</p>
            </div>

            <div class="text-end mb-3">
                Tasikmalaya, <?= tanggalIndonesia($tanggal_surat); ?>
            </div>

            <table>
                <tr>
                    <td>Nomor</td>
                    <td>: ....../SMK-M/....../<?= date('Y'); ?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>: -</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>: <strong>Pemanggilan Orang Tua/Wali Siswa</strong></td>
                </tr>
            </table>

            <br>

            Kepada Yth.<br>
            Bapak/Ibu Orang Tua/Wali dari:

            <table class="identitas">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($siswa['nama']); ?></td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($siswa['nis']); ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($siswa['nama_kelas']); ?></td>
                </tr>
            </table>

            <p class="mt-3" style="text-align: justify;">
                Dengan hormat,
            </p>

            <p style="text-align: justify;">
                Sehubungan dengan hasil pemantauan kedisiplinan siswa,
                kami informasikan bahwa putra/putri Bapak/Ibu telah
                memperoleh total <strong><?= $total_poin; ?> poin pelanggaran</strong>.
                Oleh karena itu, kami bermaksud mengundang Bapak/Ibu
                untuk hadir ke sekolah guna membicarakan perkembangan
                kedisiplinan siswa tersebut.
            </p>

            <p>Adapun pertemuan akan dilaksanakan pada:</p>

            <table class="identitas">
                <tr>
                    <td>Hari</td>
                    <td>:</td>
                    <td><?= hariIndonesia($tanggal_pertemuan); ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?= tanggalIndonesia($tanggal_pertemuan); ?></td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($waktu_pertemuan); ?> WIB</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($tempat_pertemuan); ?></td>
                </tr>
            </table>

            <p class="mt-3" style="text-align: justify;">
                Demikian surat pemanggilan ini kami sampaikan.
                Besar harapan kami Bapak/Ibu dapat hadir tepat waktu
                demi pembinaan dan perkembangan kedisiplinan siswa.
                Atas perhatian dan kerja samanya, kami ucapkan terima kasih.
            </p>

            <table class="ttd">
                <tr>
                    <td>
                        Mengetahui,<br>
                        Kepala Sekolah
                        <br><br><br><br>
                        <strong>(....................................)</strong>
                    </td>
                    <td>
                        Tasikmalaya,<br>
                        Wali Kelas
                        <br><br><br><br>
                        <strong>(<?= htmlspecialchars($guru['nama']); ?>)</strong>
                    </td>
                </tr>
            </table>

            <div style="page-break-before: always;">
                <h4 class="text-center mt-4 mb-3">
                    LAMPIRAN RIWAYAT PELANGGARAN SISWA
                </h4>

                <p>
                    Nama: <strong><?= htmlspecialchars($siswa['nama']); ?></strong><br>
                    Kelas: <?= htmlspecialchars($siswa['nama_kelas']); ?>
                </p>

                <table class="tabel-riwayat">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Poin</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($riwayat) > 0) { ?>
                            <?php foreach ($riwayat as $i => $item) { ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1; ?></td>
                                    <td><?= tanggalIndonesia($item['tanggal']); ?></td>
                                    <td><?= htmlspecialchars($item['nama_pelanggaran']); ?></td>
                                    <td class="text-center"><?= (int) $item['poin']; ?></td>
                                    <td><?= htmlspecialchars($item['keterangan'] ?? '-'); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    Tidak ada riwayat pelanggaran.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Poin</th>
                            <th class="text-center"><?= $total_poin; ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    <?php } ?>

</div>

</body>
</html>
