<?php
$user_role = $_SESSION['user_role'];
$user_id = (int) $_SESSION['user_id'];

$guru_id = null;
$wali_kelas_id = null;
$kelas_id = null;
$tahun_ajaran_id = null;
$is_wali_kelas = false;

if ($user_role == 'guru') {

    $query_akses = mysqli_prepare($conn, "
        SELECT
            g.id,
            wk.id,
            wk.kelas_id,
            wk.tahun_ajaran_id
        FROM t_guru g
        INNER JOIN t_wali_kelas wk
            ON wk.guru_id = g.id
        INNER JOIN t_tahun_ajaran ta
            ON ta.id = wk.tahun_ajaran_id
        WHERE g.user_id = ?
        AND g.status_aktif = 1
        AND wk.status_aktif = 1
        AND ta.status_aktif = 1
        AND CURDATE() BETWEEN wk.tanggal_mulai
        AND wk.tanggal_selesai
        ORDER BY wk.id DESC
        LIMIT 1
    ");

    mysqli_stmt_bind_param($query_akses, "i", $user_id);
    mysqli_stmt_execute($query_akses);

    mysqli_stmt_bind_result(
        $query_akses,
        $guru_id,
        $wali_kelas_id,
        $kelas_id,
        $tahun_ajaran_id
    );

    if (mysqli_stmt_fetch($query_akses)) {
        $is_wali_kelas = true;
    }

    mysqli_stmt_close($query_akses);
}
