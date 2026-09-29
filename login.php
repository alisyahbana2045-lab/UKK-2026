<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Pelanggaran Siswa</title>
</head>
<body>

<h1>Sistem Pelanggaran Siswa</h1>
<h2>Login</h2>

<?php

if (isset($_GET['pesan'])) {

    if ($_GET['pesan'] == 'gagal') {
        echo "<p>Username atau password salah!</p>";
    }

    if ($_GET['pesan'] == 'belum_login') {
        echo "<p>Silakan login terlebih dahulu!</p>";
    }

    if ($_GET['pesan'] == 'logout') {
        echo "<p>Anda berhasil logout.</p>";
    }

}

?>

<form action="proses_login.php" method="POST">

    <label>Email</label><br>
    <input type="email" name="email" required>

    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Login</button>

</form>

</body>
</html>