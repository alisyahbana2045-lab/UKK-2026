<?php

require_once "config/session.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Sistem Pelanggaran Siswa</title>
</head>

<body>

    <h1>Sistem Pelanggaran Siswa</h1>

    <p>
        Selamat Datang,
        <strong><?php echo $_SESSION['user_name']; ?></strong>
    </p>

    <p>
        Anda Login Sebagai:
        <strong><?php echo $_SESSION['user_role']; ?></strong>
    </p>

    <hr>

    <?php if ($_SESSION['user_role'] == 'admin') { ?>

        <h2>Menu Admin</h2>

        <ul>
            <li>
                <a href="admin/menu1/index.php">Menu 1</a>
            </li>

            <li>
                <a href="admin/menu2/index.php">Menu 2</a>
            </li>

            <li>
                <a href="admin/menu3/index.php">Menu 3</a>
            </li>

            <li>
                <a href="admin/menu4/index.php">Menu 4</a>
            </li>
        </ul>

    <?php } elseif ($_SESSION['user_role'] == 'guru') { ?>

        <h2>Menu Guru</h2>

        <ul>
            <li>
                <a href="guru/menu3/index.php">Menu 3</a>
            </li>

            <li>
                <a href="guru/menu4/index.php">Menu 4</a>
            </li>

            <li>
                <a href="guru/menu5/index.php">Menu 5</a>
            </li>
        </ul>

    <?php } ?>

    <hr>

    <a href="logout.php">Logout</a>

</body>

</html>