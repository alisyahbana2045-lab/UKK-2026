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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center" "
style="background-color: #4b9eaa;">

<div class="card p-4 shadow" style="width: 350px;">

    <h3 class="text-center mb-4">Login</h3>
        <?php
    if (isset($_GET['pesan'])) {

        if ($_GET['pesan'] == 'gagal') {
            echo "<div class='alert alert-danger text-center'>
            Username atau Password salah.
          </div>";
        }

        if ($_GET['pesan'] == 'belum_login') {
            echo "<div class='alert alert-danger text-center'>
            Silikan Login terlebih dahulu.
          </div>";;
        }

        if ($_GET['pesan'] == 'logout') {
            echo "<div class='alert alert-danger text-center'>
            Anda berhasil logout.
          </div>";
    }
    }
    ?>
    <form action="proses_login.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

            <button type="submit" class="btn btn-outline-success ">Login</button>

</div>
</div>

    </form>

</body>
</html>