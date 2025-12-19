<?php
require 'auth.php';

/* Hitung data */
$totalKeluhan = $conn->query("SELECT COUNT(*) AS total FROM keluhan")->fetch_assoc();
$before = $conn->query("SELECT COUNT(*) AS total FROM keluhan WHERE id_status=1")->fetch_assoc();
$process = $conn->query("SELECT COUNT(*) AS total FROM keluhan WHERE id_status=2")->fetch_assoc();
$done = $conn->query("SELECT COUNT(*) AS total FROM keluhan WHERE id_status=3")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <span>Dashboard Admin</span>
    <div>
        <a href="keluhan_list.php">List Keluhan</a>
        <a href="rekap.php">Rekap</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Selamat datang, <?= $_SESSION['nama']; ?></h2>

    <div class="cards">

        <a href="keluhan_list.php" class="card-link">
            <div class="card">
                <h3>Total Keluhan</h3>
                <p><?= $totalKeluhan['total']; ?></p>
            </div>
        </a>

        <a href="keluhan_list.php?status=1" class="card-link">
            <div class="card">
                <h3>Before</h3>
                <p><?= $before['total']; ?></p>
            </div>
        </a>

        <a href="keluhan_list.php?status=2" class="card-link">
            <div class="card">
                <h3>Process</h3>
                <p><?= $process['total']; ?></p>
            </div>
        </a>

        <a href="keluhan_list.php?status=3" class="card-link">
            <div class="card">
                <h3>Done</h3>
                <p><?= $done['total']; ?></p>
            </div>
        </a>

    </div>
</div>

</body>
</html>
