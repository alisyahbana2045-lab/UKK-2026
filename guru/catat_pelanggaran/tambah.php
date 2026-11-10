<?php
require_once __DIR__ . "/../../config/session.php";
require_once __DIR__ . "/../../config/koneksi.php";

$user_id = (int) $_SESSION['user_id'];

// Mengambil data guru yang sedang login
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

// Mengambil data siswa aktif
$siswa = mysqli_query($conn, "
    SELECT id, nis, nisn, nama
    FROM t_siswa
    WHERE status_aktif = 1
    ORDER BY nama ASC
");

// Mengambil tahun ajaran aktif
$tahun = mysqli_query($conn, "
    SELECT id, nama
    FROM t_tahun_ajaran
    WHERE status_aktif = 1
    ORDER BY id DESC
");

// Mengambil jenis pelanggaran
$pelanggaran = mysqli_query($conn, "
    SELECT
        p.id,
        p.pelanggaran_kategori_id,
        p.nama,
        p.poin
    FROM t_pelanggaran p
    WHERE p.status_aktif = 1
    ORDER BY p.nama ASC
");

$pesan_error = "";

if (isset($_POST['simpan'])) {

    $tahun_ajaran_id = (int) $_POST['tahun_ajaran_id'];
    $siswa_id = (int) $_POST['siswa_id'];
    $pelanggaran_id = (int) $_POST['pelanggaran_id'];

    $tanggal = mysqli_real_escape_string(
        $conn,
        $_POST['tanggal']
    );

    $keterangan = mysqli_real_escape_string(
        $conn,
        $_POST['keterangan']
    );

    // Mengambil data siswa beserta kelasnya
    $query_siswa = mysqli_query($conn, "
        SELECT
            s.id,
            s.nama AS nama_siswa,
            ks.kelas_id,
            k.nama AS nama_kelas
        FROM t_siswa s
        INNER JOIN t_kelas_siswa ks
            ON s.id = ks.siswa_id
        INNER JOIN t_kelas k
            ON ks.kelas_id = k.id
        WHERE s.id = '$siswa_id'
        AND s.status_aktif = 1
        AND ks.tahun_ajaran_id = '$tahun_ajaran_id'
        AND ks.status_aktif = 1
        ORDER BY ks.id DESC
        LIMIT 1
    ");

    $data_siswa = mysqli_fetch_assoc($query_siswa);

    // Mengambil data pelanggaran
    $query_pelanggaran = mysqli_query($conn, "
        SELECT
            id,
            pelanggaran_kategori_id,
            nama AS nama_pelanggaran,
            poin
        FROM t_pelanggaran
        WHERE id = '$pelanggaran_id'
        AND status_aktif = 1
    ");

    $data_pelanggaran = mysqli_fetch_assoc($query_pelanggaran);

    // Validasi
    if (!$data_siswa) {

        $pesan_error = "Data siswa atau kelas tidak ditemukan.";

    } elseif (!$data_pelanggaran) {

        $pesan_error = "Data pelanggaran tidak ditemukan.";

    } elseif (
        !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal) ||
        !strtotime($tanggal)
    ) {

        $pesan_error = "Tanggal kejadian tidak valid.";

    } else {

        $nama_siswa = mysqli_real_escape_string(
            $conn,
            $data_siswa['nama_siswa']
        );

        $kelas_id = (int) $data_siswa['kelas_id'];

        $nama_kelas = mysqli_real_escape_string(
            $conn,
            $data_siswa['nama_kelas']
        );

        $nama_pelanggaran = mysqli_real_escape_string(
            $conn,
            $data_pelanggaran['nama_pelanggaran']
        );

        $pelanggaran_kategori_id = (int)
            $data_pelanggaran['pelanggaran_kategori_id'];

        $poin = (int) $data_pelanggaran['poin'];

        $guru_id = (int) $guru['id'];

        $nama_guru = mysqli_real_escape_string(
            $conn,
            $guru['nama']
        );

        $status = "Belum Ditindak";
        $tindakan = "";

        // Menyimpan data pelanggaran
        $query = mysqli_query($conn, "
            INSERT INTO t_pelanggaran_siswa (
                tahun_ajaran_id,
                siswa_id,
                nama_siswa,
                kelas_id,
                nama_kelas,
                pelanggaran_id,
                nama_pelanggaran,
                pelanggaran_kategori_id,
                guru_id,
                nama_guru,
                tanggal,
                keterangan,
                poin,
                tindakan,
                status,
                created_at
            ) VALUES (
                '$tahun_ajaran_id',
                '$siswa_id',
                '$nama_siswa',
                '$kelas_id',
                '$nama_kelas',
                '$pelanggaran_id',
                '$nama_pelanggaran',
                '$pelanggaran_kategori_id',
                '$guru_id',
                '$nama_guru',
                '$tanggal',
                '$keterangan',
                '$poin',
                '$tindakan',
                '$status',
                NOW()
            )
        ");

        if ($query) {
            header("Location: index.php");
            exit;
        } else {
            $pesan_error = "Data gagal disimpan: " . mysqli_error($conn);
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
                <p class="text-muted mb-0">
                    Tambah data pelanggaran siswa
                </p>
            </div>

            <?php if ($pesan_error != "") { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($pesan_error); ?>
                </div>
            <?php } ?>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="POST">

<!-- Pencarian Siswa -->
<div class="mb-3">

    <label class="form-label">Cari Siswa</label>

    <input
        type="text"
        id="cari_siswa"
        class="form-control"
        placeholder="Cari berdasarkan nama, NIS, atau NISN..."
        autocomplete="off"
        required
    >

    <!-- Hasil pencarian siswa -->
    <div
        id="hasil_siswa"
        class="list-group mt-1"
        style="display: none; max-height: 250px; overflow-y: auto;"
    ></div>

    <!-- ID siswa yang dipilih -->
    <input
        type="hidden"
        name="siswa_id"
        id="siswa_id"
    >

    <div class="form-text">
        Ketik nama, NIS, atau NISN kemudian pilih siswa.
    </div>

</div>

                        <!-- Tahun Ajaran Otomatis -->
                        <div class="mb-3">

                            <label class="form-label">Tahun Ajaran</label>

                            <select
                                name="tahun_ajaran_id"
                                id="tahun_ajaran_id"
                                class="form-select"
                                required
                            >

                                <option value="">-- Pilih Siswa Terlebih Dahulu --</option>

                                <?php while ($data_tahun = mysqli_fetch_assoc($tahun)) { ?>

                                    <option
                                        value="<?= $data_tahun['id']; ?>"
                                        <?= (isset($_POST['tahun_ajaran_id']) && $_POST['tahun_ajaran_id'] == $data_tahun['id']) ? 'selected' : ''; ?>
                                    >
                                        <?= htmlspecialchars($data_tahun['nama']); ?>
                                    </option>

                                <?php } ?>

                            </select>

                            <div class="form-text">
                                Tahun ajaran otomatis mengikuti penempatan siswa.
                            </div>

                        </div>

                        <!-- Kelas Otomatis -->
                        <div class="mb-3">

                            <label class="form-label">Kelas Siswa</label>

                            <input
                                type="text"
                                id="kelas_tampil"
                                class="form-control"
                                placeholder="Kelas muncul otomatis"
                                readonly
                            >

                        </div>

                        <!-- Jenis Pelanggaran -->
                        <div class="mb-3">

                            <label class="form-label">Jenis Pelanggaran</label>

                            <select
                                name="pelanggaran_id"
                                class="form-select"
                                required
                            >

                                <option value="">-- Pilih Pelanggaran --</option>

                                <?php while ($data_pelanggaran = mysqli_fetch_assoc($pelanggaran)) { ?>

                                    <option
                                        value="<?= $data_pelanggaran['id']; ?>"
                                        <?= (isset($_POST['pelanggaran_id']) && $_POST['pelanggaran_id'] == $data_pelanggaran['id']) ? 'selected' : ''; ?>
                                    >
                                        <?= htmlspecialchars($data_pelanggaran['nama']); ?>
                                        -
                                        <?= htmlspecialchars($data_pelanggaran['poin']); ?>
                                        poin
                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <!-- Tanggal Kejadian -->
                        <div class="mb-3">

                            <label class="form-label">Tanggal Kejadian</label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= htmlspecialchars($_POST['tanggal'] ?? date('Y-m-d')); ?>"
                                required
                            >

                            <div class="form-text">
                                Tanggal ketika siswa melakukan pelanggaran.
                            </div>

                        </div>

                        <!-- Tanggal Dicatat -->
                        <div class="mb-3">

                            <label class="form-label">Tanggal Dicatat</label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= date('d-m-Y H:i:s'); ?>"
                                readonly
                            >

                            <div class="form-text">
                                Tanggal dan waktu pencatatan disimpan otomatis.
                            </div>

                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">

                            <label class="form-label">Keterangan</label>

                            <textarea
                                name="keterangan"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan keterangan pelanggaran"
                            ><?= htmlspecialchars($_POST['keterangan'] ?? ''); ?></textarea>

                        </div>

                        <button
                            type="submit"
                            name="simpan"
                            class="btn btn-primary"
                        >
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

<script>

// Elemen HTML
const inputCari = document.getElementById('cari_siswa');
const hasilSiswa = document.getElementById('hasil_siswa');
const siswaId = document.getElementById('siswa_id');

const tahunAjaran = document.getElementById('tahun_ajaran_id');
const kelas = document.getElementById('kelas_tampil');

// Mengambil seluruh data siswa dari database
const semuaSiswa = <?= json_encode(
    (function () use ($siswa) {
        $data = [];

        while ($row = mysqli_fetch_assoc($siswa)) {
            $data[] = [
                'id' => $row['id'],
                'nis' => $row['nis'],
                'nisn' => $row['nisn'],
                'nama' => $row['nama']
            ];
        }

        return $data;
    })(),
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
); ?>;


// Pencarian berdasarkan nama, NIS, atau NISN
inputCari.addEventListener('input', function () {

    const keyword = this.value.toLowerCase().trim();

    // Reset pilihan siswa sebelumnya
    siswaId.value = '';
    tahunAjaran.value = '';
    kelas.value = '';

    hasilSiswa.innerHTML = '';

    if (keyword === '') {
        hasilSiswa.style.display = 'none';
        return;
    }

    // Filter data siswa
    const hasil = semuaSiswa.filter(function (item) {

        return (
            String(item.nama).toLowerCase().includes(keyword) ||
            String(item.nis).toLowerCase().includes(keyword) ||
            String(item.nisn).toLowerCase().includes(keyword)
        );

    });

    // Jika siswa tidak ditemukan
    if (hasil.length === 0) {

        const pesan = document.createElement('div');
        pesan.className = 'list-group-item text-danger';
        pesan.textContent = 'Siswa tidak ditemukan.';

        hasilSiswa.appendChild(pesan);

    } else {

        // Menampilkan hasil pencarian
        hasil.forEach(function (item) {

            const tombol = document.createElement('button');

            tombol.type = 'button';
            tombol.className = 'list-group-item list-group-item-action';

            tombol.textContent =
                item.nama +
                ' | NIS: ' + item.nis +
                ' | NISN: ' + item.nisn;

            tombol.addEventListener('click', function () {
                pilihSiswa(item);
            });

            hasilSiswa.appendChild(tombol);

        });

    }

    hasilSiswa.style.display = 'block';

});


// Memilih siswa
async function pilihSiswa(item) {

    inputCari.value = item.nama + ' - NIS: ' + item.nis;

    siswaId.value = item.id;

    hasilSiswa.style.display = 'none';

    tahunAjaran.value = '';
    kelas.value = 'Memuat data...';

    try {

        const response = await fetch(
            'get_kelas_siswa.php?siswa_id=' +
            encodeURIComponent(item.id)
        );

        if (!response.ok) {
            throw new Error('HTTP error: ' + response.status);
        }

        const data = await response.json();

        if (data.success) {

            tahunAjaran.value = data.tahun_ajaran_id;
            kelas.value = data.nama_kelas;

        } else {

            siswaId.value = '';
            inputCari.value = '';
            kelas.value = '';

            alert(data.message);

        }

    } catch (error) {

        console.error(error);

        siswaId.value = '';
        inputCari.value = '';
        kelas.value = '';

        alert('Gagal mengambil data penempatan siswa.');

    }

}


// Menutup hasil pencarian jika klik di luar
document.addEventListener('click', function (event) {

    if (
        !inputCari.contains(event.target) &&
        !hasilSiswa.contains(event.target)
    ) {
        hasilSiswa.style.display = 'none';
    }

});


// Validasi sebelum menyimpan
document.getElementById('form_pelanggaran').addEventListener('submit', function (event) {

    if (!siswaId.value || !tahunAjaran.value) {

        event.preventDefault();

        alert('Cari dan pilih siswa terlebih dahulu.');

        inputCari.focus();

    }

});

</script>

</body>
</html>