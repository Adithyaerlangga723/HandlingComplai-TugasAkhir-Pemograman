<?php
require 'auth.php';

$rekap = $conn->query("
    SELECT 
        COUNT(*) AS total_keluhan,
        SUM(estimasi_biaya) AS total_biaya,
        SUM(estimasi_waktu_jam) AS total_waktu,
        SUM(nilai_kerugian) AS total_kerugian
    FROM keluhan
")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rekap Keluhan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <span>Rekap Biaya & Waktu</span>
    <a href="dashboard.php">Dashboard</a>
</div>

<div class="container">
    <div class="cards">
        <div class="card">
            <h3>Total Keluhan</h3>
            <p><?= $rekap['total_keluhan']; ?></p>
        </div>
        <div class="card">
            <h3>Total Biaya</h3>
            <p>Rp <?= number_format($rekap['total_biaya']); ?></p>
        </div>
        <div class="card">
            <h3>Total Waktu</h3>
            <p><?= $rekap['total_waktu']; ?> Jam</p>
        </div>
        <div class="card">
            <h3>Total Kerugian</h3>
            <p>Rp <?= number_format($rekap['total_kerugian']); ?></p>
        </div>
    </div>
</div>

</body>
</html>
