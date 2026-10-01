<?php

require_once __DIR__ . "/session.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: /UKK-2026/dashboard.php");
    exit;
}