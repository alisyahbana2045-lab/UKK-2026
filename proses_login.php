<?php

session_start();

require_once "config/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM t_users WHERE email = '$email'"
);

$user = mysqli_fetch_assoc($query);

if ($user) {

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: dashboard.php");
        exit;

    }
}

header("Location: login.php?pesan=gagal");
exit;

?>