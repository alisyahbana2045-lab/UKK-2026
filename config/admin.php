<?php

require_once __DIR__ . "/session.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}